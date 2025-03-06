<div>
    <div class="flex flex-col gap-6 bg-white shadow-xl shadow-gray-400 rounded-[10px] p-6 mr-10 ml-10">

        <div class="flex items-center flex-col gap-5 justify-center p-5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px]">
            <h1 class="flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg font-bold font-sans">
                Minha Conta

                <div class="w-[400px] h-[1.5px] bg-[#003D60]"></div>
            </h1>

            <ul class="flex gap-6">
                <li>
                    <button class="inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-phone-icon widht="16px" height="16px" color="currentColor"/>
                        Alterar meu telefone
                    </button>
                </li>

                <li>
                    <button class="inline-flex items-center gap-1 px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-password-icon widht="16px" height="16px" color="currentColor"/>
                        Alterar minha senha
                    </button>
                </li>

                <li>
                    <button class="inline-flex items-center px-4 py-2 bg-[#003D60] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900  focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-email-icon widht="16px" height="16px" color="currentColor"/>
                        Alterar meu e-mail
                    </button>
                </li>

            </ul>
        </div>

        <div class="relative flex items-center flex-col gap-5 justify-center p-5 bg-gray-100 shadow-xl shadow-gray-400 rounded-[10px] overflow-auto">
            <div class="absolute top-4 left-6 flex items-center">
                <button class="inline-flex items-center gap-1 px-4 py-2 bg-transparent border border-[#003D60] rounded-md font-semibold text-xs text-[#003D60] uppercase tracking-widest hover:bg-[#003D60] hover:text-white focus:bg-[#003D60] focus:outline-none focus:ring-2 focus:ring-[#003D60] focus:ring-offset-2 transition ease-in-out duration-150">
                    <x-add-icon widht="16px" height="16px" color="currentColor"/>
                    Novo Usuario
                </button>

            </div>

            <h1 class="flex items-center justify-center gap-4 flex-col w-full text-[#003D60] text-lg font-bold font-sans mb-3">
                Outros Usuários
                <div class="w-[400px] h-[1.5px] bg-[#003D60]"></div>
            </h1>
            <div class="overflow-y-auto max-h-[400px] w-full">

            </div>
            <table class="overflow-y-auto max-h-[400px] w-full border-separate border-spacing-y-6">
                <thead>
                    <tr class="text-lg text-[#003D60] font-bold font-sans">
                        <th class="text-center">Nome</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Telefone</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="shadow-xl shadow-gray-300 rounded-[10px] bg-white">
                        <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">
                            Maria Helena Pereira da Silva
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            maria.helena@email.com
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            (11) 99999-9999
                        </td>
                        <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                            <ul class="flex items-center justify-center gap-5">
                                <li>
                                    <x-user-edit-icon widht="20px" height="20px" color="#003D60"/>
                                </li>
                                <li>
                                    <x-cancel-icon widht="20px" height="20px" color="red"/>
                                </li>
                                <li>
                                    <x-trash-icon widht="20px" height="20px" color="red"/>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="shadow-xl shadow-gray-300 rounded-[10px] bg-white">
                        <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">
                            Maria Helena Pereira da Silva
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            maria.helena@email.com
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            (11) 99999-9999
                        </td>
                        <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                            <ul class="flex items-center justify-center gap-5">
                                <li>
                                    <x-user-edit-icon widht="20px" height="20px" color="#003D60"/>
                                </li>
                                <li>
                                    <x-cancel-icon widht="20px" height="20px" color="red"/>
                                </li>
                                <li>
                                    <x-trash-icon widht="20px" height="20px" color="red"/>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="shadow-xl shadow-gray-300 rounded-[10px] bg-white">
                        <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">
                            Maria Helena Pereira da Silva
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            maria.helena@email.com
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            (11) 99999-9999
                        </td>
                        <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                            <ul class="flex items-center justify-center gap-5">
                                <li>
                                    <x-user-edit-icon widht="20px" height="20px" color="#003D60"/>
                                </li>
                                <li>
                                    <x-cancel-icon widht="20px" height="20px" color="red"/>
                                </li>
                                <li>
                                    <x-trash-icon widht="20px" height="20px" color="red"/>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="shadow-xl shadow-gray-300 rounded-[10px] bg-white">
                        <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">
                            Maria Helena Pereira da Silva
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            maria.helena@email.com
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            (11) 99999-9999
                        </td>
                        <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                            <ul class="flex items-center justify-center gap-5">
                                <li>
                                    <x-user-edit-icon widht="20px" height="20px" color="#003D60"/>
                                </li>
                                <li>
                                    <x-cancel-icon widht="20px" height="20px" color="red"/>
                                </li>
                                <li>
                                    <x-trash-icon widht="20px" height="20px" color="red"/>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr class="shadow-xl shadow-gray-300 rounded-[10px] bg-white">
                        <td class="text-center p-6 rounded-l-[10px] text-lg text-gray-950 font-light font-sans">
                            Maria Helena Pereira da Silva
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            maria.helena@email.com
                        </td>
                        <td class="text-center p-6 text-lg text-gray-950 font-light font-sans">
                            (11) 99999-9999
                        </td>
                        <td class="p-6 rounded-r-[10px] text-lg text-gray-950 font-light font-sans">
                            <ul class="flex items-center justify-center gap-5">
                                <li>
                                    <x-user-edit-icon widht="20px" height="20px" color="#003D60"/>
                                </li>
                                <li>
                                    <x-cancel-icon widht="20px" height="20px" color="red"/>
                                </li>
                                <li>
                                    <x-trash-icon widht="20px" height="20px" color="red"/>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
