<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class
ChangePasswordUserForm extends Form
{
    #[Validate('required|string|min:6')]
    public string $current_password = '';

    #[Validate('required|string|min:6')]
    public string $password = '';
}
