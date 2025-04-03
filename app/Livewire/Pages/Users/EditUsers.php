<?php
namespace App\Livewire\Pages\Users;

use App\Livewire\Forms\User\EditPermissionsUserForm;
use App\Livewire\Forms\User\EditUserForm;
use App\Services\Permissions\PermissionsService;
use App\Services\Role\RoleService;
use App\Services\Sex\SexService;
use App\Services\User\UserService;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditUsers extends Component
{
    public EditUserForm $form;
    public EditPermissionsUserForm $permissions_form;

    private UserService $user_service;
    private PermissionsService $permissions_service;
    private RoleService $role_service;
    private SexService $sex_service;

    public array $user = [];
    public int $user_id;
    public array $sexes = [];
    public array $roles = [];
    public bool $hasChanges = false;
    public bool $hasPermissionChanges = false;
    public bool $is_loading = false;

    public $instrumentationLabels = [
        'viewGraphs' => 'Visualizar Gráficos',
        'editGraphsLocal' => 'Editar Gráficos Local',
        'editGraphsDefault' => 'Editar Gráficos Padrão',
        'viewRead' => 'Visualizar Leituras',
        'editRead' => 'Editar Leituras',
        'viewSections' => 'Visualizar Seções',
        'editSections' => 'Editar Seções',
    ];
    public $documentationLabels = [
        'viewPSB' => 'Visualizar PSB',
        'editPSB' => 'Editar PSB',
        'sharePSB' => 'Compartilhar PSB',

    ];
    public $routineInspectionLabels = [
        'isFillWeb' => 'Prenchimento Web',
        'isFillMobile' => 'Preenchimento Mobile',
    ];
    public $attributionsLabels = [
        'editUser' => 'Editar Usuário',
        'editDam' => 'Editar Estruturas',
        'editGeralData' => 'Editar dados gerais',
    ];

    public function __construct()
    {
        $this->user_service = new UserService('user');
        $this->permissions_service = new PermissionsService('user-permissions');
        $this->role_service = new RoleService('role');
        $this->sex_service = new SexService('sex');
    }

    public function updated($property)
    {
        if (str_starts_with($property, 'form.')) {
            $this->hasChanges = true;
        }

        if (str_starts_with($property, 'permissions_form.')) {
            $this->hasPermissionChanges = true;
        }
    }

    public function saveChanges()
    {
        $this->form->validate();

        $payload = [
            'email' => $this->form->email,
            'name' => $this->form->name,
            'phone' => $this->form->phone,
            'sex' => [
                'id'  => $this->form->sex,
            ],
            'status' => [
                'id'=> $this->form->status
            ],
            'role' => [
                'id'=> $this->form->role
            ],
        ];

        $response = $this->user_service->updateUser($payload, $this->user_id);

        if (!$response['success']) {
            session()->flash('error', $response['message']);
            $this->dispatch('user-errors', title: $response['message']);
            return;
        }

        $this->hasChanges = false;
        session()->flash('success', 'Usuário criado com sucesso!');
        $this->dispatch('user-success', title: $response['message']);
    }

    public function resetForm()
    {
        if (!empty($this->user)) {
            $this->form->fill([
                'email' => $this->user['email'] ?? '',
                'name' => $this->user['name'] ?? '',
                'phone' => $this->user['phone'] ?? '',
                'sex' => $this->user['sex']['id'] ?? '',
                'status' => $this->user['status']['id'] ?? '',
                'role' => $this->user['role']['id'] ?? '',
            ]);
        }
        $this->hasChanges = false;
    }

    public function resetPermissionsForm()
    {
        $permissionsData = $this->permissions_service->getPermissionsByUserId($this->user_id)['data'] ?? [];
        $this->permissions_form->fill([
            'documentation_permission' => $permissionsData['documentationPermission'] ?? [],
            'attributions_permission' => $permissionsData['attributionsPermission'] ?? [],
            'instrumentation_permission' => $permissionsData['instrumentationPermission'] ?? [],
            'routine_inspection_permission' => $permissionsData['routineInspectionPermission'] ?? [],
            'dam_permission' => array_map(fn ($dam) => [
                'id' => $dam['id'] ?? null,
                'name' => $dam['dam']['name'] ?? 'Sem Nome',
                'hasAccess' => $dam['hasAccess'] ?? false,
            ], $permissionsData['damPermissions'] ?? []),
        ]);


        $this->hasChanges = false;
    }

    public function savePermissionChanges()
    {
        $payload = [
            'userId' => $this->user_id,
            'documentationPermission' => [
                'viewPSB' => $this->permissions_form->documentation_permission['viewPSB'] ?? false,
                'editPSB' => $this->permissions_form->documentation_permission['editPSB'] ?? false,
                'sharePSB' => $this->permissions_form->documentation_permission['sharePSB'] ?? false,
            ],
            'attributionsPermission' => [
                'editUser' => $this->permissions_form->attributions_permission['editUser'] ?? false,
                'editDam' => $this->permissions_form->attributions_permission['editDam'] ?? false,
                'editGeralData' => $this->permissions_form->attributions_permission['editGeralData'] ?? false,
            ],
            'instrumentationPermission' => [
                'viewGraphs' => $this->permissions_form->instrumentation_permission['viewGraphs'] ?? false,
                'editGraphsLocal' => $this->permissions_form->instrumentation_permission['editGraphsLocal'] ?? false,
                'editGraphsDefault' => $this->permissions_form->instrumentation_permission['editGraphsDefault'] ?? false,
                'viewRead' => $this->permissions_form->instrumentation_permission['viewRead'] ?? false,
                'editRead' => $this->permissions_form->instrumentation_permission['editRead'] ?? false,
                'viewSections' => $this->permissions_form->instrumentation_permission['viewSections'] ?? false,
                'editSections' => $this->permissions_form->instrumentation_permission['editSections'] ?? false,
            ],
            'routineInspectionPermission' => [
                'isFillWeb' => $this->permissions_form->routine_inspection_permission['isFillWeb'] ?? false,
                'isFillMobile' => $this->permissions_form->routine_inspection_permission['isFillMobile'] ?? false,
            ],
            'damIds' => collect($this->permissions_form->dam_permission)
                ->where('hasAccess', true)
                ->pluck('id')
                ->toArray(),
        ];
        $response = $this->permissions_service->updatePermissionsByUserId($payload);

        if (!$response['success']) {
            $this->dispatch('user-errors', title: $response['message']);
            return;
        }

        $this->hasChanges = false;
        $this->dispatch('user-success', title: $response['message']);
    }

    public function mount($user_id)
    {
        $this->user_id = $user_id;

        try {
            $responseUser = $this->user_service->getUserById($this->user_id);
            if (!empty($responseUser['success'])) {
                $this->user = $responseUser['data'] ?? [];
                $this->resetForm();
            } else {
                session()->flash('error', 'Erro ao carregar os dados do usuário.');
            }
        } catch (\Exception $e) {
            Log::error('Erro ao buscar usuário: ' . $e->getMessage());
        }

        $this->resetPermissionsForm();

        $this->sexes = $this->sex_service->getAllSexs()['data'] ?? [];
        $this->roles = $this->role_service->getAllRoles()['data'] ?? [];
    }

    public function render()
    {
        return view('livewire.pages.users.edit-users')->layout('layouts.app');
    }
}
