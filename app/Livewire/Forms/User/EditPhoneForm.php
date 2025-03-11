<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EditPhoneForm extends Form
{
    #[Validate('required|max:4')]
    public $phone;
}
