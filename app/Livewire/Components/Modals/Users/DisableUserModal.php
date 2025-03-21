<?php

namespace App\Livewire\Components\Modals\Users;

use App\Services\User\UserService;
use Livewire\Attributes\On;
use Livewire\Component;

class DisableUserModal extends Component
{
    public bool $is_loading = false;

    private UserService $user_service;

    public $user;
    public $user_id;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    #[On('disable-user')]
    public function disableUserModalOpen($id): void
    {
        $this->user_id = $id;
        $this->dispatch('open-modal', 'disable-user-modal');
    }

    public function disableUser()
    {

    }

    public function render()
    {
        return view('livewire.components.modals.users.disable-user-modal');
    }
}
