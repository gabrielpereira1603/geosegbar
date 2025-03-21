<?php

namespace App\Livewire\Pages\Structures;

use Livewire\Component;

class HomeStructures extends Component
{
    public function render()
    {
        return view('livewire.pages.structures.home-structures')->layout('layouts.app');
    }
}
