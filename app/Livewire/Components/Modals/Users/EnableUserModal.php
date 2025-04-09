<?php

namespace App\Livewire\Components\Modals\Users;

use App\Services\User\UserService;
use Livewire\Attributes\On;
use Livewire\Component;

class EnableUserModal extends Component
{
    public bool $is_loading = false;

    private UserService $user_service;

    public $user;
    public $user_id;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    #[On('enable-user')]
    public function enableUserModalOpen($id): void
    {
        $this->user_id = $id;

        $userResponse = $this->user_service->getUserById($this->user_id);

        if (!$userResponse['success']) {
            $this->dispatch('close-modal', 'enable-user-modal');
            $this->dispatch('user-error', title: $userResponse['message']);
        }else{
            $this->user = $userResponse['data'];
            $this->dispatch('open-modal', 'enable-user-modal');
        }
    }

    public function enableUser()
    {
        $payload = [
            'email' => $this->user['email'],
            'name' => $this->user['name'],
            'phone' => $this->user['phone'],
            'sex' => [
                'id'  => $this->user['sex']['id'],
            ],
            'status' => [
                'id'=> '1',
            ],
            'role' => [
                'id'=> $this->user['role']['id'],
            ]
        ];

        $response = $this->user_service->updateUser($payload, $this->user_id);

        $this->dispatch('close-modal', 'enable-user-modal');
        if(!$response['success']) {
            $this->dispatch('user-error', title: $response['message']);
        }else{
            $this->dispatch('user-success', title: $response['message']);
        }
    }

    public function render()
    {
        return view('livewire.components.modals.users.enable-user-modal');
    }
}
