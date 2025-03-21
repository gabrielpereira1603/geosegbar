<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\CreateUserForm;
use App\Livewire\Forms\User\EditUserForm;
use App\Services\User\UserService;
use Livewire\Component;

class CreateUserModal extends Component
{
    public CreateUserForm $form;
    public bool $is_loading = false;

    private UserService $user_service;

    public $user;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function create()
    {
        $this->validate();

        $payload = [
            'email' => $this->form->email,
            'name' => $this->form->name,
            'phone' => $this->form->phone,
            'password' => $this->form->password,
            'sex' => [
                'id'  => $this->form->sex,
            ],
            'status' => [
                'id'=> $this->form->status
            ],
        ];

        $response = $this->user_service->createUser($payload);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'create-user-modal');
            $this->dispatch('user-error', title: $response['message']);

            return;
        }

        session()->flash('success', 'Usuário criado com sucesso!');
        $this->dispatch('close-modal', 'create-user-modal');
        $this->dispatch('user-success', title: $response['message']);

    }

    public function render()
    {
        return view('livewire.components.modals.users.create-user-modal');
    }
}
