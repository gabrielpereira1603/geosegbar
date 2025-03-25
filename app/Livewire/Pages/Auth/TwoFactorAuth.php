<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\Auth\VerifyTokenForm;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class TwoFactorAuth extends Component
{
    public bool $is_loading = false;

    private $auth_service;

    public VerifyTokenForm $form;

    public function __construct()
    {
        $this->auth_service = new AuthService('user');
    }

    public function mount()
    {
        $authMessage = session('auth_message');

        if ($authMessage) {
            $this->dispatch('user-success', title: $authMessage);
        }

        $this->form->email = session('two_factor_email');
        if (!$this->form->email) {
            $this->dispatch('user-error', title: 'Sessão expirada, faça login novamente!');

            return redirect()->route('login');
        }
    }

    public function verifyToken()
    {
        try{
            $this->validate();

            $this->is_loading = true;

            $credentials = [
                'email' => $this->form->email,
                'code' => $this->form->code,
            ];

            $authResponse = $this->auth_service->tokenVerify($credentials);

            if (isset($authResponse['success']) && $authResponse['success'] === true) {
                $user = $authResponse['data'];
                session([
                    'user' => $user,
                    'token' => $user['token']
                ]);

                session()->forget('two_factor_email');
                session()->forget('auth_message');
                session()->forget('two_factor_start');

                $this->dispatch('user-success', title: $authResponse['message']);
                return redirect()->route('users');
            }
            $this->dispatch('user-error', title: $authResponse['message']);

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            $this->dispatch('user-error', title:  $e->getMessage());
        } finally {
            $this->is_loading = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.two-factor-auth')->layout('layouts.guest');
    }
}
