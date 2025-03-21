<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\EditEmailUserForm;
use App\Livewire\Forms\User\EditPhoneUserForm;
use App\Services\User\UserService;
use Livewire\Component;

class EditEmailUserModal extends Component
{
    public EditEmailUserForm $form;

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
        $this->form->email = $this->form->user['email'];
    }

    public function startEditing(): void
    {
        $this->isEditing = true;
    }

    public function cancelEditing(): void
    {
        $user = session('user');
        $this->form->email = $this->form->user['email'];
        $this->isEditing = false;
    }

    public function save()
    {
        $this->validate();

        $payload = [
            'name' => $this->form->user['name'],
            'phone' => $this->form->user['phone'],
            'email' => $this->form->email,
            'sex' => [
                'id' => $this->form->user['sex']['id']
            ],
            'status' => [
                'id' => '1'
            ],
        ];

        $response = $this->user_service->updateUser($payload, $this->form->user['id']);
        if (!$response['success']) {
            $this->dispatch('open-modal', 'edit-email-user');
            $this->dispatch('user-error', title: $response['message']);
            $this->form->email = $response['data']['email'];
            return;
        }

        $this->dispatch('close-modal', 'edit-email-user');

        $this->dispatch('user-success', title: 'Email do ' . $response['message']);
    }

    public function render()
    {
        return view('livewire.components.modals.users.edit-email-user-modal');
    }
}
