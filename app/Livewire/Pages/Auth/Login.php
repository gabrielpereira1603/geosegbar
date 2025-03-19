<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\Auth\LoginForm;
use App\Services\Auth\AuthService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public bool $is_loading = false;
    private $auth_service;

    public LoginForm $form;

    public function __construct()
    {
        $this->auth_service = new AuthService('user');
    }

    public function login()
    {
        try {
            $this->validate();

            $this->is_loading = true;

            $credentials = [
                'email' => $this->form->email,
                'password' => $this->form->password,
            ];

            $authResponse = $this->auth_service->login($credentials);

            if (isset($authResponse['success']) && $authResponse['success'] === true) {
                session()->flash('status', $authResponse['message']);
                session(['two_factor_start' => Carbon::now()]);
                session(['two_factor_email' => $this->form->email]);
                return $this->redirect('/token-two-factor');
            }
        } catch (\Throwable $e) {
            session()->flash('error', $e->getMessage());
        } finally {
            $this->is_loading = false;
        }
    }
    public function render()
    {
        return view('livewire.pages.auth.login')->layout('layouts.guest');
    }
}
