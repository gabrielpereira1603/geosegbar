<?php

namespace App\Livewire\Pages\Structures;

use App\Services\Dam\DamService;
use Livewire\Component;

class HomeStructures extends Component
{
    private DamService $damService;

    public array $damns = [];
    public $logged_user;

    public function __construct()
    {
        $this->damService = new DamService('dams');
    }

    public function mount()
    {
        $this->logged_user = session('user');
        $response = $this->damService->getAllDams();
        if ($response['success']) {
            $this->damns = $response['data'];
        }
    }
    public function render()
    {
        return view('livewire.pages.structures.home-structures')->layout('layouts.app');
    }
}
