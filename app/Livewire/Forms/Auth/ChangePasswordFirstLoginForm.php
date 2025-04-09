<?php

namespace App\Livewire\Forms\Auth;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ChangePasswordFirstLoginForm extends Form
{
    #[Validate('required|string|min:6')]
    public string $new_password = '';

    #[Validate('required|string')]
    public string $current_password = '';
}
