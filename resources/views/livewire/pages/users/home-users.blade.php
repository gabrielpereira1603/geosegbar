<div>
    <div class="flex flex-col gap-6 bg-white shadow-xl shadow-gray-400 rounded-[10px] p-6 sm:mr-10 sm:ml-10">

        <div class="flex items-center flex-col gap-5 justify-center p-5 sm:p5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px]">
            <h1 class="font-ubuntu flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg font-bold">
                Minha Conta
                <div id="flash-message" class="hidden p-3 rounded-md mb-3 opacity-0 transition-opacity duration-500">
                    <span id="flash-message-text"></span>
                </div>

                <div class="w-[100%] sm:w-[400px] h-[1.5px] bg-[#003D60]"></div>
            </h1>

            <ul class="flex gap-6 flex-col sm:flex-row sm:items-center sm:justify-center items-center">
                <li>
                    <a href="javascript:void(0)" @click="$dispatch('open-modal', 'edit-phone-user')">
                        <button class="font-ubuntu inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                            <x-phone-icon widht="16px" height="16px" color="currentColor"/>
                            Alterar o meu telefone
                        </button>
                    </a>
                </li>
                <livewire:components.modals.users.edit-phone-user-modal/>

                <li>
                    <a href="javascript:void(0)" @click="$dispatch('open-modal', 'change-password-user')">
                        <button class="font-ubuntu inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                            <x-password-icon widht="16px" height="16px" color="currentColor"/>
                            Alterar a minha senha
                        </button>
                    </a>
                </li>
                <livewire:components.modals.users.change-password-user-modal/>

                <li>
                    <a href="javascript:void(0)" @click="$dispatch('open-modal', 'edit-email-user')">
                        <button class="font-ubuntu inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                            <x-email-icon widht="16px" height="16px" color="currentColor"/>
                            Alterar o meu e-mail
                        </button>
                    </a>
                </li>
                <livewire:components.modals.users.edit-email-user-modal/>
            </ul>
        </div>
        @script
        <script>

        </script>
        @endscript
        <div class="relative flex items-center flex-col gap-5 justify-center p-5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px] overflow-auto">
            <div class="w-full sm-w-auto sm:absolute top-4 left-6 flex items-center">
                <a href="javascript:void(0)" @click="$dispatch('open-modal', 'create-user-modal')">
                    <button
                        class="w-full sm:w-auto font-ubuntu justify-center inline-flex items-center gap-1 px-4 py-2 bg-transparent border border-[#003D60] rounded-md font-semibold text-xs text-[#003D60] uppercase tracking-widest hover:bg-[#003D60] hover:text-white focus:bg-[#003D60] focus:text-white focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        <x-add-icon width="16px" height="16px" color="currentColor" />
                        Novo Usuário
                    </button>
                </a>

                <livewire:components.modals.users.create-user-modal/>
            </div>

            <h1 class="flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg font-ubuntu font-bold mb-3">
                Outros Usuários
                <div class="w-[100%] sm:w-[400px] h-[1.5px] bg-[#003D60]"></div>
            </h1>

            <div class="overflow-x-auto overflow-y-auto w-full max-h-[400px] rounded-[10px]">
                <table class="sm:max-h-[400px] w-full border-separate border-spacing-y-6 min-w-[600px]">
                    <thead>
                    <tr class="text-lg text-[#003D60] font-bold font-ubuntu">
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Nome</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Email</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Telefone</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Status</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Ações</th>
                    </tr>

                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="shadow-xl shadow-gray-300/50 rounded-[10px] bg-white">
                                <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">{{ $user['name'] }}</td>
                                <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">{{ $user['email'] }}</td>
                                <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">{{ $user['phone'] }}</td>
                                <td class="text-center p-6">
                                    @if($user['status']['id'] === 1)
                                        <x-check-circle-icon width="24px" height="24px" color="green" class="inline-block"/>
                                    @else
                                        <x-cross-circle-icon width="24px" height="24px" color="red" class="inline-block"/>
                                    @endif
                                </td>

                                <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                                    <ul class="flex items-center justify-center gap-5">
                                        <li x-data="{ tooltip: false }" class="relative">
                                            <a href="{{ route('users.edit', $user['id']) }}"
                                               @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                                                <x-user-edit-icon width="20px" height="20px" color="#003D60"/>
                                            </a>
                                            <span x-show="tooltip" class="absolute top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded p-1">
                                                Editar Usuário
                                            </span>
                                        </li>
                                        <li x-data="{ tooltip: false }" class="relative">
                                            @if($user['status']['id'] === 1)
                                                <a href="javascript:void(0)"
                                                   wire:click="$dispatch('disable-user', { id: {{ $user['id'] }} });"
                                                   @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                                                    <x-cancel-icon width="20px" height="20px" color="red"/>
                                                </a>
                                                <span x-show="tooltip" class="absolute top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded p-1">
                                                    Desativar Usuário
                                                </span>
                                            @else
                                                <a href="javascript:void(0)" @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                                                    <x-active-user-icon width="20px" height="20px" color="green"/>
                                                </a>
                                                <span x-show="tooltip" class="absolute top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded p-1">
                                                    Ativar Usuário
                                                </span>
                                            @endif
                                        </li>
                                        <li x-data="{ tooltip: false }" class="relative">
                                            <a href="javascript:void(0)"
                                               wire:click="$dispatch('delete-user', { id: {{ $user['id'] }} });"
                                               @mouseenter="tooltip = true" @mouseleave="tooltip = false">
                                                <x-trash-icon width="20px" height="20px" color="red"/>
                                            </a>
                                            <span x-show="tooltip" class="absolute top-8 left-1/2 -translate-x-1/2 bg-black text-white text-xs rounded p-1">
                                                Excluir Usuário
                                            </span>
                                        </li>
                                    </ul>

                                </td>
                            </tr>
                        @endforeach
                        <livewire:components.modals.users.disable-user-modal/>
                        <livewire:components.modals.users.delete-user-modal/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @script
    <script>
        // Ouve o evento 'create-user-success' disparado pelo Livewire
        $wire.on('user-success', (event) => {
            console.log(event)
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: event.title,
                confirmButtonText: 'Ok'
            });
            $wire.dispatch('load-users');
        });

        // Ouve o evento 'create-user-error' disparado pelo Livewire
        $wire.on('user-error', (event) => {
            console.log(event)
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: event.title,
                confirmButtonText: 'Ok'
            });
            $wire.dispatch('load-users');
        });

        $wire.on('load-table-users', () => {
            $wire.dispatch('load-users');
        });
    </script>
    @endscript
</div>
