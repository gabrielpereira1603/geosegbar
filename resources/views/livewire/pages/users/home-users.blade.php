<div>
    <div class="flex flex-col gap-6 bg-white shadow-xl shadow-gray-400 rounded-[10px] p-6 sm:mr-10 sm:ml-10">

        <div class="flex items-center flex-col gap-5 justify-center p-5 sm:p5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px]">
            <h1 class="font-ubuntu flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg font-bold">
                Minha Conta

                <div class="w-[100%] sm:w-[400px] h-[1.5px] bg-[#003D60]"></div>
            </h1>

            <ul class="flex gap-6 flex-col sm:flex-row sm:items-center">
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
                    <button class="font-ubuntu inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-password-icon widht="16px" height="16px" color="currentColor"/>
                        Alterar a minha senha
                    </button>
                </li>

                <li>
                    <button class="font-ubuntu inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-email-icon widht="16px" height="16px" color="currentColor"/>
                        Alterar o meu e-mail
                    </button>
                </li>
            </ul>
        </div>

        <div class="relative flex items-center flex-col gap-5 justify-center p-5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px] overflow-auto">
            <div class="w-full sm-w-auto sm:absolute top-4 left-6 flex items-center">
                <a href="javascript:void(0)" @click="$dispatch('open-modal', 'create-user')">
                    <button class="w-full sm:w-auto font-ubuntu justify-center inline-flex items-center gap-1 px-4 py-2 bg-transparent border border-[#003D60] rounded-md font-semibold text-xs text-[#003D60] uppercase tracking-widest hover:bg-[#003D60] hover:text-white focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-add-icon widht="16px" height="16px" color="currentColor"/>
                        Novo Usuario
                    </button>
                </a>

                <livewire:components.modals.users.create-user-modal/>
            </div>

            <h1 class="flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg text-[16px] font-ubuntu font-bold mb-3">
                Outros Usuários
                <div class="sm:w-[400] w-[200px] h-[1.5px] bg-[#003D60]"></div>
            </h1>

            <div class="overflow-x-auto w-full rounded-[10px]">
                <table class="sm:max-h-[400px] w-full border-separate border-spacing-y-6 min-w-[600px]">
                    <thead>
                    <tr class="text-lg text-[#003D60] font-bold font-ubuntu">
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Nome</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Email</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Telefone</th>
                        <th class="text-[20px] font-bold leading-none tracking-normal text-center align-middle px-4 py-2">Ações</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr class="shadow-xl shadow-gray-300/50 rounded-[10px] bg-white">
                        <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">Maria Helena Pereira da Silva</td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">maria.helena@email.com</td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">(11) 99999-9999</td>
                        <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                            <ul class="flex items-center justify-center gap-5">
                                <li><x-user-edit-icon width="20px" height="20px" color="#003D60"/></li>
                                <li><x-cancel-icon width="20px" height="20px" color="red"/></li>
                                <li><x-trash-icon width="20px" height="20px" color="red"/></li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
