<?php

namespace App\Livewire\Components\Modals\Users;

use App\Services\User\UserService;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteUserModal extends Component
{
    public bool $is_loading = false;
    private UserService $user_service;

    public $user;
    public $user_id;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    #[On('delete-user')]
    public function deleteUserModalOpen($id): void
    {
        $this->user_id = $id;

        $this->dispatch('open-modal', 'delete-user-modal');
    }

    public function deleteUser()
    {
        $response = $this->user_service->deleteUser($this->user_id);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'delete-user-modal');
            $this->dispatch('user-error', title: $response['message']);

            return;
        }

        session()->flash('success', 'Usuário atualizado com sucesso!');
        $this->dispatch('close-modal', 'delete-user-modal');
        $this->dispatch('user-success', title: $response['message']);
    }

    public function render()
    {
        return view('livewire.components.modals.users.delete-user-modal');
    }
}
