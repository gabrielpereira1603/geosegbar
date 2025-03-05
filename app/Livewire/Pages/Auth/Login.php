<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        try {
            $this->form->validate();

            // Chama o método de autenticação do LoginForm
            $this->form->authenticate();

            if (session()->has('status')) {
                return $this->redirect('/two-factor-token');
            } else {
                Session::regenerate();
                return $this->redirect('/dashboard');
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login')->layout('layouts.guest');
    }
}
