<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EditEmailUserForm extends Form
{
    #[Validate('required')]
    public $email;

    public array $user = [];
}
