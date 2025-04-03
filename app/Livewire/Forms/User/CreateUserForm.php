<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateUserForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|in:1,2,3')]
    public string $sex = '1';

    #[Validate('required|string')]
    public string $phone = '';

    #[Validate('required|string')]
    public string $status = '1';

    #[Validate('required|string')]
    public string $role;

    #[Validate('required|string|min:6')]
    public string $password = '';
}
