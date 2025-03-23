<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Navigation extends Component
{
    public function logout()
    {
        // Limpa a sessão do usuário
        session()->forget(['user', 'token']);

        // Redireciona para a página de login
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
