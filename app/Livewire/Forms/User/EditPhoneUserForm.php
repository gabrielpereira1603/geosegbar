<?php

namespace App\Livewire\Forms\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditPhoneUserForm extends Form
{
    #[Validate('required|max:16')]
    public $phone;

    public array $user = [];


}
