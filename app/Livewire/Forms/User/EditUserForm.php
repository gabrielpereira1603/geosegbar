<?php

namespace App\Livewire\Forms\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditUserForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|in:1,2,3')]
    public $sex;

    #[Validate('required|string')]
    public string $phone = '';

    #[Validate('required|string')]
    public string $status = '';

    #[Validate('required|string')]
    public string $role = '1';
}

