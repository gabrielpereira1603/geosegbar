<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\EditPhoneUserForm;
use Livewire\Component;

class EditPhoneUserModal extends Component
{
    public EditPhoneUserForm $form;

    public $step = 1;

    public function mount()
    {
        $user = session('user');
        $this->form->user = $user ? $user->toArray() : [];
        $this->form->phone_formated = $this->maskPhone($user->phone);

    }

    function maskPhone($phone)
    {
        return preg_replace('/(\d{2})(\d{2})\d{4}(\d{3})/', '($1) $2 **** $3', $phone);
    }


    public function confirmPhoneNumber()
    {
        $this->step = 2;
        $this->form->sendToken();
    }

    public function render()
    {
        return view('livewire.components.modals.users.edit-phone-user-modal');
    }
}
