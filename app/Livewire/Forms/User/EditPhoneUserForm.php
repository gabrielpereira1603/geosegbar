<?php

namespace App\Livewire\Forms\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditPhoneUserForm extends Form
{
    #[Validate('required|max:4')]
    public $phone;

    public $phone_formated;

    public array $user = [];

    public function sendToken()
    {
    }
}
