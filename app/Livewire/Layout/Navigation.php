<?php

namespace App\Livewire\Layout;

use App\Http\Controllers\ProfileController;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{

    #[On('logout-event')]
    public function logout()
    {
        session()->forget(['user', 'token']);
        $this->dispatch('user-error', title: 'Você foi desconectado!');

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
