<div>
    <div class="flex flex-col gap-6 bg-white shadow-xl shadow-gray-400 rounded-[10px] p-6 sm:mr-10 sm:ml-10">
        <div class="flex items-center flex-col gap-2 justify-center p-5 sm:p-5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px]">
            <h1 class="font-ubuntu flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg font-bold">
                Editar Usuário
                <div id="flash-message" class="hidden p-3 rounded-md opacity-0 transition-opacity duration-500">
                    <span id="flash-message-text"></span>
                </div>

                <div class="w-[100%] sm:w-[400px] h-[1.5px] bg-[#003D60]"></div>
            </h1>

            <ul class="w-full flex gap-6 flex-col sm:flex-row sm:items-start justify-center p-5">

                <li class="w-full flex flex-col">
                    <div class="relative">
                        <label class="text-gray-700 text-sm font-medium mb-1 block">Nome</label>
                        <div class="relative">
                            <input type="text" wire:model.live="form.name" placeholder="Digite o nome"
                                   class="w-full p-3 pr-10 border border-gray-300 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#003D60]">
                            <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                <x-edit-icon width="16px" height="16px" color="currentColor"/>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="w-full flex flex-col">
                    <div class="relative">
                        <label class="text-gray-700 text-sm font-medium mb-1 block">Email</label>
                        <div class="relative">
                            <input type="email"
                                   wire:model.live.debounce.250ms="form.email"
                                   placeholder="Digite o email"
                                   class="w-full p-3 pr-10 border border-gray-300 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#003D60]">
                            <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                <x-edit-icon width="16px" height="16px" color="currentColor"/>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="w-full flex flex-col">
                    <div class="relative">
                        <label class="text-gray-700 text-sm font-medium mb-1 block">Telefone:</label>
                        <div class="relative">
                            <input type="text"
                                   wire:model.live="form.phone"
                                   placeholder="Digite o Telefone"
                                   class="w-full p-3 pr-10 border border-gray-300 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#003D60]">
                            <div class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                <x-edit-icon width="16px" height="16px" color="currentColor"/>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="w-full flex gap-6 flex-col sm:flex-row sm:items-start justify-center p-5">

                <li class="w-full flex flex-col">
                    <div class="relative">
                        <label class="text-gray-700 text-sm font-medium mb-1 block">Sexo:</label>
                        <select wire:model.live="form.sex" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900">
                            @foreach($sexes as $sex)
                                <option value="{{ $sex['id'] }}">{{ $sex['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>

                <li class="w-full flex flex-col">
                    <div class="relative">
                        <label class="text-gray-700 text-sm font-medium mb-1 block">Status</label>
                        <div class="relative">
                            <select id="status" wire:model.live="form.status" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" required>
                                <option value="1">Ativado</option>
                                <option value="2">Desativado</option>
                            </select>
                        </div>
                    </div>
                </li>

                <li class="w-full flex flex-col">
                    <div class="relative">
                        <label class="text-gray-700 text-sm font-medium mb-1 block">Papel:</label>
                        <select wire:model.live="form.role" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900">
                            @foreach($roles as $role)
                                <option value="{{ $role['id'] }}" {{ $form->role == $role['id'] ? 'selected' : '' }} >
                                    {{ $role['description'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </li>
            </ul>

            @if($hasChanges)
                <div class="flex gap-3">
                    <button wire:click="resetForm" type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                        Cancelar
                    </button>
                    <button wire:click="saveChanges" type="submit" class="bg-[#003D60] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#002a42]">
                        Salvar Alterações
                    </button>
                </div>
            @endif
        </div>

        @if($user['role']['name'] === 'COLLABORATOR')
            <div class="flex-col p-5 sm:p-5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px]">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mt-4">
                    <div class="flex flex-col gap-5">
                        <div class="bg-gray-50 shadow-md p-4 rounded-lg">
                            <h3 class="font-semibold text-[#003D60] flex flex-col items-center justify-center ">
                                Estruturas
                                <div class="w-[100%] sm:w-[50%] h-[2px] bg-[#003D60]"></div>
                            </h3>

                            <ul class="mt-2 space-y-2">
                                @foreach ($permissions_form->dam_permission as $dam)
                                    <li class="flex justify-between">
                                        <label>{{ $dam['name'] }}</label>
                                        <input type="checkbox" wire:model.live="permissions_form.dam_permission.{{ $loop->index }}.hasAccess"
                                               class="form-checkbox rounded-[3px] default:bg-[#003D60] checked:bg-[#003D60] " @if($dam['hasAccess']) checked @endif >
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="bg-gray-50 shadow-md p-4 rounded-lg">
                            <h3 class="font-semibold text-[#003D60] flex flex-col items-center justify-center">
                                Documentação
                                <div class="w-[100%] sm:w-[50%] h-[2px] bg-[#003D60]"></div>
                            </h3>
                            <ul class="mt-2 space-y-2">
                                @foreach ($permissions_form->documentation_permission as $key => $value)
                                    @if(!in_array($key, ['id', 'user']))
                                        <li class="flex justify-between">
                                            <label>{{ $documentationLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}</label>
                                            <input type="checkbox" wire:model.live="permissions_form.documentation_permission.{{ $key }}"
                                                   class="form-checkbox rounded-[3px] default:bg-[#003D60] checked:bg-[#003D60] " @if($value) checked @endif>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                        <div class="bg-gray-50 shadow-md p-4 rounded-lg">
                            <h3 class="font-semibold text-[#003D60] flex flex-col items-center justify-center ">
                                Atribuições
                                <div class="w-[100%] sm:w-[50%] h-[2px] bg-[#003D60]"></div>
                            </h3>
                            <ul class="mt-2 space-y-2">
                                @foreach ($permissions_form->attributions_permission as $key => $value)
                                    @if(!in_array($key, ['id', 'user']))
                                        <li class="flex justify-between">
                                            <label>{{ $attributionsLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}</label>
                                            <input type="checkbox" wire:model.live="permissions_form.attributions_permission.{{ $key }}"
                                                   class="form-checkbox rounded-[3px] default:bg-[#003D60] checked:bg-[#003D60] " @if($value) checked @endif>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-50 shadow-md p-4 rounded-lg h-full">
                            <h3 class="font-semibold text-blue-900 flex flex-col items-center justify-center ">
                                Instrumentação
                                <div class="w-[100%] sm:w-[80%] h-[1.5px] bg-[#003D60]"></div>
                            </h3>
                            <ul class="mt-2 space-y-2">
                                @foreach ($permissions_form->instrumentation_permission as $key => $value)
                                    @if(!in_array($key, ['id', 'user']))
                                        <li class="flex justify-between">
                                            <label>{{ $instrumentationLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}</label>
                                            <input type="checkbox" wire:model.live="permissions_form.instrumentation_permission.{{ $key }}"
                                                   class="form-checkbox rounded-[3px] default:bg-[#003D60] checked:bg-[#003D60] " @if($value) checked @endif>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-50 shadow-md p-4 rounded-lg h-full">
                            <h3 class="font-semibold text-blue-900 flex flex-col items-center justify-center ">
                                Inspeções rotineiras
                                <div class="w-[100%] sm:w-[80%] h-[1.5px] bg-[#003D60]"></div>
                            </h3>
                            <ul class="mt-2 space-y-2">
                                @foreach ($permissions_form->routine_inspection_permission as $key => $value)
                                    @if(!in_array($key, ['id', 'user']))
                                        <li class="flex justify-between">
                                            <label>{{ $routineInspectionLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}</label>
                                            <input type="checkbox" wire:model.live="permissions_form.routine_inspection_permission.{{ $key }}"
                                                   class="form-checkbox rounded-[3px] default:bg-[#003D60] checked:bg-[#003D60] " @if($value) checked @endif>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @if($hasPermissionChanges)
                    <div class="w-full flex gap-3 justify-center mt-5">
                        <button wire:click="" type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                            Descartar Alterações
                        </button>
                        <button wire:click="savePermissionChanges" type="button" class="bg-[#003D60] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-[#002a42]">
                            Salvar Permissões
                        </button>
                    </div>
                @endif
            </div>
        @endif
    </div>

    @script
    <script>
        $wire.on('user-success', (event) => {
            console.log(event)
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: event.title,
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });

        $wire.on('user-error', (event) => {
            console.log(event)
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: event.title,
                confirmButtonText: 'Ok'
            });
        });
    </script>
    @endscript
</div>
