<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\CreateUserForm;
use App\Livewire\Forms\User\EditUserForm;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Livewire\Component;

class CreateUserModal extends Component
{
    public CreateUserForm $form;
    public bool $is_loading = false;

    private UserService $user_service;
    private RoleService $roleService;

    public $user;
    public $roles;

    public function __construct()
    {
        $this->user_service = new UserService('user');
        $this->roleService = New RoleService('role');
    }

    public function create()
    {
        $this->form->validate();

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
            'role' => [
                'id'=> $this->form->role
            ],
        ];

        $response = $this->user_service->createUser($payload);
        if (!$response['success']) {
            $this->dispatch('open-modal', 'create-user-modal');
            $this->dispatch('user-error', title: $response['message']);

            return;
        }

        $this->dispatch('close-modal', 'create-user-modal');
        $this->dispatch('user-success', title: $response['message']);

    }

    public function mount()
    {
        $response = $this->roleService->getAllRoles();

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'create-user-modal');
            $this->dispatch('user-error', title: $response['message']);
            $this->roles = [];

            return;
        }
        $this->roles = $response['data'];
    }

    public function render()
    {
        return view('livewire.components.modals.users.create-user-modal');
    }
}
