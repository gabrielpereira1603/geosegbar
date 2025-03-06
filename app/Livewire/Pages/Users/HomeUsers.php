<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;

class HomeUsers extends Component
{
    public function render()
    {
        return view('livewire.pages.users.home-users')->layout('layouts.app');
    }
}
