<?php

namespace App\Livewire\Forms\User;

use Livewire\Attributes\Validate;
use Livewire\Form;


class EditPermissionsUserForm extends Form
{
    public $user_id;
    public $permissions;
    public array $documentation_permission = [];
    public array $attributions_permission = [];
    public array $instrumentation_permission = [];
    public array $routine_inspection_permission = [];
    public array $dam_permission = [];
}
