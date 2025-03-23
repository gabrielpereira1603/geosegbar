<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\ChangePasswordUserForm;
use App\Livewire\Forms\User\EditPhoneUserForm;
use App\Services\User\UserService;
use Livewire\Component;

class ChangePasswordUserModal extends Component
{
    public $step = 1;
    public ChangePasswordUserForm $form;

    private UserService $user_service;

    public $isEditing = false;

    public bool $is_loading = false;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function mount()
    {
        $user = session('user');
        $this->form->user = $user;
    }

    public function startEditing(): void
    {
        $this->step = 2;

    }

    public function cancelEditing(): void
    {
        $user = session('user');
        $this->step = 1;
        $this->isEditing = false;
    }

    public function nextStep(){
        $this->step = 3;
    }


    public function changePassword() {
        $this->validate();

        $payload = [
            'currentPassword' => $this->form->current_password,
            'newPassword' => $this->form->password,
        ];

        $response = $this->user_service->changePassword($this->form->user['id'],$payload,);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'change-password-user');
            $this->dispatch('user-error', title: $response['message']);
            return;
        }

        $this->dispatch('close-modal', 'change-password-user');
        $this->isEditing = false;
        $this->dispatch('user-success', title: $response['message']);
    }

    public function render()
    {
        return view('livewire.components.modals.users.change-password-user-modal');
    }
}
