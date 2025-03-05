<?php

namespace App\Livewire\Pages\Auth;

use App\Livewire\Forms\Auth\TwoFactorAuthForm;
use Livewire\Component;

class TwoFactorAuth extends Component
{
    public TwoFactorAuthForm $form;

    public function render()
    {
        return view('livewire.pages.auth.two-factor-auth')->layout('layouts.guest');
    }
}
