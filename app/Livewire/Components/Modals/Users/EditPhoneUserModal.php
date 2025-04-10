<?php

namespace App\Livewire\Components\Modals\Users;

use App\Livewire\Forms\User\EditPhoneUserForm;
use App\Services\User\UserService;
use Livewire\Component;

class EditPhoneUserModal extends Component
{
    public EditPhoneUserForm $form;

    private UserService $user_service;

    public $isEditing = false;

    public bool $is_loading = false;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }

    public function mount()
    {
        $user = session('user');
        $this->form->user = $user;
        $this->form->phone = $user['phone'] ?? '';
    }

    public function startEditing(): void
    {
        $this->isEditing = true;
    }

    public function cancelEditing(): void
    {
        $user = session('user');
        $this->form->phone = $this->form->user['phone'];
        $this->isEditing = false;
    }

    public function save()
    {
        $this->validate();

        $payload = [
            'name' => $this->form->user['name'],
            'phone' => $this->form->phone,
            'email' => $this->form->user['email'],
            'sex' => [
                'id' => $this->form->user['sex']['id']
            ],
            'status' => [
                'id' => '1'
            ],
        ];

        $response = $this->user_service->updateUser($payload, $this->form->user['id']);
        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'edit-phone-user');
            $this->dispatch('user-error', title: $response['message']);
            $this->form->phone = $response['data']['phone'];
            return;
        }

        session()->flash('success', 'Usuário atualizado com sucesso!');
        $this->dispatch('close-modal', 'edit-phone-user');
        $this->isEditing = false;
        $this->dispatch('user-success', title: 'Telefone do ' . $response['message']);
    }

    public function render()
    {
        return view('livewire.components.modals.users.edit-phone-user-modal');
    }
}
