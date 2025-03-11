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
        $this->form->email = session('two_factor_email');
        if (!$this->form->email) {
            return redirect()->route('login')->with('status', 'Sessão expirada, faça login novamente!');
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
                $user = User::fromApiResponse($authResponse['data']);

                session([
                    'user' => $user,
                    'token' => $user->token
                ]);

                return redirect()->route('users');
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            session()->flash('status', 'Erro ao autenticar: ' . $e->getMessage());
        } finally {
            $this->is_loading = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.two-factor-auth')->layout('layouts.guest');
    }
}
