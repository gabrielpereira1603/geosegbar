<?php

namespace App\Livewire\Pages\Auth;

use App\Services\User\UserService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RecoverPassword extends Component
{
    private UserService $user_service;

    public bool $is_loading = false;

    #[Validate('required|string|email')]
    public string $email = '';

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function sendLink()
    {
        $this->validate();

        $payload = [
            'email' => $this->email,
        ];

        $response = $this->user_service->forgotPassword($payload);
        if ($response['success']) {
            session()->put('email_recovery', $this->email);
            session()->put('email_recovery_expires_at', now()->addMinutes(10));

            return redirect()->route('verify_token')->with('success', $response['message']);
        }

        return redirect()->route('recover_password')->with('error', $response['message']);
    }

    public function render()
    {
        return view('livewire.pages.auth.recover-password')->layout('layouts.guest');
    }
}
