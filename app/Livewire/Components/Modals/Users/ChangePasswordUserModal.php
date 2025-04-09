<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\ChangePasswordUserForm;
use App\Livewire\Forms\User\EditPhoneUserForm;
use App\Services\User\UserService;
use Livewire\Component;

class ChangePasswordUserModal extends Component
{
    public ChangePasswordUserForm $form;

    private UserService $user_service;

    public $logged_user;

    public bool $is_loading = false;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function mount(): void
    {
        $this->logged_user = session('user');
    }

    public function changePassword(): void
    {
        $this->form->validate();

        $response = $this->user_service->changePassword($this->logged_user['id'],[
            'currentPassword' => $this->form->current_password,
            'newPassword' => $this->form->password
        ]);

        if ($response['success']) {
            $this->dispatch('user-success', title: $response['message']);
            $this->dispatch('close-modal', ['change-password-user']);
        } else{

            $this->dispatch('user-error', title: $response['message']);
        }
    }


    public function closeModal(){
        $this->dispatch('close-modal', ['change-password-user']);
        $this->form->reset();
    }
    public function render()
    {
        return view('livewire.components.modals.users.change-password-user-modal');
    }
}
