<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\Auth\VerifyTokenForm;
use App\Services\Auth\AuthService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class TwoFactorAuth extends Component
{
    public bool $is_loading = false;

    public int $resendTimer = 60;

    public bool $showResendButton = false;

    private AuthService $auth_service;

    public VerifyTokenForm $form;

    public function __construct()
    {
        $this->auth_service = new AuthService('user');
    }

    public function mount()
    {
        $this->form->email = session('two_factor_email');
        $this->form->password = session('two_factor_password');

        if (!session()->has('two_factor_email')) {
            $this->dispatch('user-error', title: 'Sessão expirada, faça login novamente!');
            return redirect()->route('login');
        }

        if ($message = session('auth_message')) {
            $this->dispatch('user-success', title: $message);
            session()->forget(['auth_message']);
        }

        $this->startResendTimer();
    }

    public function startResendTimer(): void
    {
        $this->resendTimer = 60;
        $this->showResendButton = false;
    }

    public function decrementTimer(): void
    {
        if ($this->resendTimer > 0) {
            $this->resendTimer--;
        }

        if ($this->resendTimer === 0) {
            $this->showResendButton = true;
        }
    }

    public function verifyToken()
    {
        try {
            $this->form->validate();
            $this->is_loading = true;

            $credentials = [
                'email' => $this->form->email,
                'code'  => $this->form->code,
            ];

            $authResponse = $this->auth_service->tokenVerify($credentials);

            if (!isset($authResponse['success']) || $authResponse['success'] !== true) {
                $this->dispatch('user-error', title: $authResponse['message'] ?? 'Erro desconhecido');
                return;
            }

            $user = $authResponse['data'];

            session([
                'user'  => $user,
                'token' => $user['token'],
            ]);

            session()->forget(['two_factor_email', 'auth_message', 'two_factor_start']);

            $this->dispatch('user-success', title: $authResponse['message']);

            return redirect()->route('users');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            $this->dispatch('user-error', title: $e->getMessage());
        } finally {
            $this->is_loading = false;
        }
    }

    public function resendCode()
    {
        try {
            $this->is_loading = true;

            $credentials = [
                'email' => $this->form->email,
                'password' => $this->form->password,
                ];

            $authResponse = $this->auth_service->login($credentials);

            if (isset($authResponse['success']) && $authResponse['success'] === true) {
                session(['auth_message' => $authResponse['message']]);
                session(['two_factor_start' => Carbon::now()]);
                session(['two_factor_email' => $this->form->email]);
                $this->startResendTimer();

                return $this->redirect('/token-two-factor');
            }
            $this->startResendTimer();

            $this->dispatch('start-resend-timer');
            $this->dispatch('user-error', title: $authResponse['message']);
        } catch (\Throwable $e) {
            $this->dispatch('user-error', title: $e->getMessage());
        } finally {
            $this->is_loading = false;
            $this->resendTimer = 60;
            $this->showResendButton = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.two-factor-auth')->layout('layouts.guest');
    }
}
