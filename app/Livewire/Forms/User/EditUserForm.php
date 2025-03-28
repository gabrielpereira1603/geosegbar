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
    public string $sex = '';

    #[Validate('required|string')]
    public string $phone = '';

    #[Validate('required|string')]
    public string $status = '';

    public function getSexLabel()
    {
        return match ($this->sex) {
            '1' => 'Masculino',
            '2' => 'Feminino',
            '3' => 'Outro',
            default => 'Não informado',
        };
    }

    public function getStatusLabel()
    {
        return match ($this->status) {
            '1' => 'Ativo',
            '2' => 'Inativo',
            default => 'Não informado',
        };
    }
}

