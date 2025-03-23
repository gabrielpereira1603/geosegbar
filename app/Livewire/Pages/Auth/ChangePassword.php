<?php

namespace App\Livewire\Pages\Auth;

use App\Services\User\UserService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChangePassword extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string|max:6')]
    public string $code = '';

    #[Validate('required|string|min:6')]
    public string $new_password = '';

    private UserService $user_service;

    public bool $is_loading = false;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function mount()
    {
        $email = session('email_recovery');
        $code = session('code');
        $expiresAt = session('email_recovery_expires_at');

        if (!$email || ($expiresAt && now()->greaterThan($expiresAt))) {
            session()->forget(['email_recovery', 'email_recovery_expires_at']);
            return redirect()->route('recover_password')->with('error', 'O link expirou ou você não iniciou a recuperação de senha.');
        }
        $this->code = $code;
        $this->email = $email;
    }

    public function changePassword(){
        $this->validate();

        $payload = [
            'email' => $this->email,
            'code' => $this->code,
            'newPassword' => $this->new_password,
        ];

        $response = $this->user_service->resetPassword($payload);

        if ($response['success']) {
            session()->forget(['email_recovery', 'email_recovery_expires_at', 'code']);
            return redirect()->route('login')->with('success', $response['message']);
        }

        session()->forget(['email_recovery', 'email_recovery_expires_at', 'code']);
        return redirect()->route('recover_password')->with('error', $response['message']);
    }
    public function render()
    {
        return view('livewire.pages.auth.change-password')->layout('layouts.guest');
    }
}
