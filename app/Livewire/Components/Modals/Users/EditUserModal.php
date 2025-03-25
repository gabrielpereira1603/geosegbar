<?php

namespace App\Livewire\Components\Modals\Users;

use AllowDynamicProperties;
use App\Livewire\Forms\User\EditUserForm;
use App\Services\User\UserService;
use Livewire\Component;
use Livewire\Attributes\On;

#[AllowDynamicProperties] class EditUserModal extends Component
{
    public EditUserForm $form;
    public bool $is_loading = false;
    private UserService $user_service;

    public $user;

    public $user_id;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    #[On('update-user')]
    public function updateUserModalOpen($id): void
    {
        $this->user_service = new UserService('user');

        $this->user_id = $id;
        $response = $this->user_service->getUserById($id);

        if ($response['success']) {
            $this->user = $response['data'];
            $this->form->email = $this->user['email'];
            $this->form->name = $this->user['name'];
            $this->form->phone = $this->user['phone'];
            $this->form->sex = (string) $this->user['sex']['id'];
            $this->form->status = (string) $this->user['status']['id'];
        }

        $this->dispatch('open-modal', 'edit-user-modal');
    }

    public function edit()
    {
        $this->validate();

        $payload = [
            'email' => $this->form->email,
            'name' => $this->form->name,
            'phone' => $this->form->phone,
            'sex' => [
                'id'  => $this->form->sex,
            ],
            'status' => [
                'id'=> $this->form->status
            ],
        ];

        $response = $this->user_service->updateUser($payload, $this->user_id);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'edit-user-modal');
            $this->dispatch('user-error', title: $response['message']);

            return;
        }

        $this->dispatch('close-modal', 'edit-user-modal');
        $this->dispatch('user-success', title: $response['message']);
    }



    public function render()
    {
        return view('livewire.components.modals.users.edit-user-modal', [
            'user' => $this->user
        ]);
    }
}
