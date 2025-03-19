<?php

namespace App\Livewire\Components\Modals\Users;

use App\Services\User\UserService;
use Livewire\Component;

class DeleteUserModal extends Component
{
    protected UserService $userService;

    public function mount($user)
    {
        $this->userService = new UserService('user');
    }

    public function deleteUser()
    {
        if ($this->userId) {
            dd($this->userId);
        }
    }
    public function render()
    {
        return view('livewire.components.modals.users.delete-user-modal');
    }
}
