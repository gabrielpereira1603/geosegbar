<?php

namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\Auth\LoginForm;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Livewire\Attributes\On;
use Livewire\Component;

class HomeUsers extends Component
{
    public bool $is_loading = false;
    private UserService $user_service;

    public array $users = [];

    #[On('load-users')]
    public function mount()
    {
        $this->user_service = new UserService('user');

        $response = $this->user_service->getAllUsers();
        if ($response['success']) {
            $this->users = $response['data'];
        }
    }

    public function render()
    {
        return view('livewire.pages.users.home-users', [
            'users' => $this->users
        ])->layout('layouts.app');
    }
}
