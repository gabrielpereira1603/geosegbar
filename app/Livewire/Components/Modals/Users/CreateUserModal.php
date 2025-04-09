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
    public $collaborators = [];

    public $logged_user;

    public function __construct()
    {
        $this->user_service = new UserService('user');
        $this->roleService = New RoleService('role');
    }

    public function mount()
    {
        $response = $this->roleService->getAllRoles();
        $this->logged_user = session('user');

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'create-user-modal');
            $this->dispatch('user-error', title: $response['message']);
            $this->roles = [];
            return;
        }

        $roles = $response['data'];

        if (strtolower($this->logged_user['role']) === 'collaborator') {
            $roles = array_filter($roles, function ($role) {
                return strtolower($role['name']) !== 'admin';
            });
        }

        $this->roles = array_values($roles);
    }

    public function updatedFormRole($roleId)
    {
        $role = collect($this->roles)->firstWhere('id', (int) $roleId);

        if ($role && strtolower($role['name']) === 'collaborator') {
            $response = $this->user_service->filterGetAllUsers([
                'role_id' => $role['id'],
            ]);

            $this->collaborators = $response['success'] ? $response['data'] : [];
        } else {
            $this->collaborators = [];
        }
    }


    public function create()
    {
        $this->form->validate();

        $payload = [
            'email' => $this->form->email,
            'name' => $this->form->name,
            'phone' => $this->form->phone ?? '',
            'sex' => [
                'id'  => 1,
            ],
            'status' => [
                'id'=> 1
            ],
            'role' => [
                'id'=> $this->form->role
            ],
            'createdById' => $this->logged_user['id'],
            'sourceUserId' => $this->form->collaborator_id,
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


    public function render()
    {
        return view('livewire.components.modals.users.create-user-modal');
    }
}
