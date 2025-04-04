<?php

namespace App\Livewire\Pages\Auth;

use App\Services\User\UserService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class VerifyToken extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string|max:6')]
    public string $code = '';

    private UserService $user_service;

    public bool $is_loading = false;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function mount()
    {
        $email = session('email_recovery');
        $expiresAt = session('email_recovery_expires_at');

        if (!$email || ($expiresAt && now()->greaterThan($expiresAt))) {
            session()->forget(['email_recovery', 'email_recovery_expires_at']);
            return redirect()->route('recover_password')->with('error', 'O link expirou ou você não iniciou a recuperação de senha.');
        }

         $this->email = $email;
    }

    public function verifyToken(){
        $this->is_loading = true;
        $this->validate();

        $payload = [
            'email' => $this->email,
            'code' => $this->code,
        ];

        $response = $this->user_service->verifyResetCode($payload);

        if ($response['success']) {
            session()->put('email_recovery', $this->email);
            session()->put('code', $this->code);
            session()->put('email_recovery_expires_at', now()->addMinutes(10));

            return redirect()->route('change_password')->with('success', $response['message']);
        }

        $this->dispatch('user-error', title: $response['message']);
    }

    public function render()
    {
        return view('livewire.pages.auth.verify-token')->layout('layouts.guest');
    }
}
