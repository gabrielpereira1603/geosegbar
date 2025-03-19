<?php

namespace App\Livewire\Components\Modals\Users;

use AllowDynamicProperties;
use App\Livewire\Forms\User\EditUserForm;
use App\Services\User\UserService;
use Livewire\Component;
use Livewire\Attributes\On;

#[AllowDynamicProperties] class EditUserModal extends Component
{
    public EditUserForm $form;
    public bool $is_loading = false;
    private UserService $user_service;

    public $user;

    public $user_id;

    public function __construct()
    {
        $this->user_service = new UserService('user');
    }


    public function mount()
    {

    }

    #[On('update-user')]
    public function updatePostList($id): void
    {
        $this->user_service = new UserService('user');

        $this->user_id = $id;
        $response = $this->user_service->getUserById($id);

        if ($response['success']) {
            $this->user = $response['data'];
            $this->form->email = $this->user['email'];
            $this->form->name = $this->user['name'];
            $this->form->phone = $this->user['phone'];
            $this->form->sex = (string) $this->user['sex']['id'];

        }

        $this->dispatch('open-modal', 'edit-user-modal');
    }

    public function edit()
    {
        $this->validate();

        $payload = [
            'email' => $this->form->email,
            'name' => $this->form->name,
            'phone' => $this->form->phone,
            'sex' => $this->form->sex,
        ];

        $response = $this->user_service->updateUser($payload, $this->user_id);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('open-modal', 'edit-user-modal'); // Mantém o modal aberto
            return;
        }

        session()->flash('success', 'Usuário atualizado com sucesso!');
        $this->dispatch('close-modal', 'edit-user-modal');
    }



    public function render()
    {
        return view('livewire.components.modals.users.edit-user-modal', [
            'user' => $this->user
        ]);
    }
}
