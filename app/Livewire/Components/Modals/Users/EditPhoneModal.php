<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\EditPhoneForm;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditPhoneModal extends Component
{
    public EditPhoneForm $form;
    public $step = 1;
    public $token;

    public function save()
    {
        $this->form->validate();
        Log::debug('Valor digitado no telefone:', ['phone' => $this->form->phone]);
        dd($this->form->phone);
    }

    public function render()
    {
        return view('livewire.components.modals.users.edit-phone-modal');
    }
}
