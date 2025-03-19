<?php

namespace App\Livewire\Pages\Auth;

use App\Services\Auth\AuthService;
use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';
    public bool $is_loading = false;
    private $auth_service;


    public function __construct()
    {

        $this->auth_service = new AuthService('user');
    }


    public function sendPasswordResetLink(): void
    {


    }

    public function render()
    {
        return view('livewire.pages.auth.forgot-password')->layout('layouts.guest');
    }
}
