<?php

namespace App\Livewire\Components\Modals\Auth;

use App\Livewire\Forms\Auth\ChangePasswordFirstLoginForm;
use App\Livewire\Forms\User\ChangePasswordUserForm;
use App\Services\User\UserService;
use Livewire\Component;

class ChangePasswordFirstLoginModal extends Component
{
    public ChangePasswordFirstLoginForm $form;

    private UserService $user_service;

    public bool $is_loading = false;

    public $logged_user;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function mount()
    {
        $this->logged_user = session('user');
    }

    public function changePassword() {
        $this->validate();

        $payload = [
            'currentPassword' => $this->form->current_password,
            'newPassword' => $this->form->new_password,
        ];

        $response = $this->user_service->changePassword($this->logged_user['id'],$payload,);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'first-access-modal');
            $this->dispatch('user-error', title: $response['message']);
            return;
        }

        $user = session('user');
        $user['isFirstAccess'] = false;
        session(['user' => $user]);

        $this->dispatch('close-modal', 'first-access-modal');
        $this->dispatch('user-success', title: $response['message']);
    }


    public function render()
    {
        return view('livewire.components.modals.auth.change-password-first-login-modal');
    }
}
