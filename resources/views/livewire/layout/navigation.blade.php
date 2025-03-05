<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="flex">
    <div class="p-4">
        <button
            @click="open = true"
            class="bg-blue-500 text-white p-2 rounded transition-all duration-300 ease-in-out"
            x-show="!open"
            x-transition.opacity
        >
            <x-menu-icon widht="30px" height="30px" color="#003D60" />
        </button>
    </div>
    <div
        class="bg-white text-white fixed h-full top-0 left-0 w-72 transition-all duration-300 ease-in-out transform z-50 shadow-gray-700 shadow-lg"
        :class="open ? 'translate-x-0' : '-translate-x-72'"
    >
        <div class="flex justify-around items-center relative">
            <div class="text-xl font-bold">
                <img src="{{ asset('images/logo-quadrada.png') }}" width="150px" height="150px">
            </div>

            <button @click="open = false" class="bg-transparent p-2 rounded text-white absolute right-4 top-3">
                 <x-arrow-icon widht="30px" height="30px" color="none" />
            </button>
        </div>

        <div class="w-full flex justify-center items-center text-center flex-col pl-5 pr-5">
            <h1 class="text-black font-sans text-lg font-bold text-center">Olá, João</h1>

            <div class="w-full bg-gray-900 h-[1px]"></div>
        </div>

        <ul class="">
            <li class="p-2 m-4 px-4 hover:bg-[#003D60] cursor-pointer rounded-[10px] group">
                <p class="flex items-center justify-start gap-10 text-black font-bold group-hover:text-white">
                    <x-dashboard-icon width="30px" height="30px" color="currentColor"/>
                    Dashboard
                </p>
            </li>

            <li
                class="p-2 m-4 px-4 hover:bg-[#003D60] cursor-pointer rounded-[10px] group relative"
                x-data="{ open: true, estruturas: ['Barragem 1', 'Barragem 2', 'Barragem 3', 'Barragem 4', 'Barragem 5'] }"
            >
                <p
                    class="flex items-center justify-start gap-10 text-black font-bold group-hover:text-white cursor-pointer"
                >
                    <x-structure-icon width="30px" height="30px" color="currentColor"/>
                    Estruturas
                </p>

                <!-- Campo de Input e Lista de Estruturas -->
                <div
                    x-show="open"
                    x-transition
                    class="mt-5 bg-white border-transparent w-full absolute left-0 z-10 transition-all duration-300"
                    :style="open ? 'max-height: 300px;' : 'max-height: 0;'"
                >
                    <div class="relative w-full">
                        <input
                            type="text"
                            placeholder="Buscar estrutura..."
                            class="p-2 pl-10 w-full border rounded-lg focus:outline-none"
                            x-model="search"
                        />
                        <svg
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M21 21L15 15"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <circle
                                cx="10"
                                cy="10"
                                r="7"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>

                    <ul class="mt-2 max-h-40 overflow-y-auto">
                        <template x-for="estrutura in estruturas" :key="estrutura">
                            <li
                                class="p-2 text-center text-black hover:bg-[#003D60] hover:text-white cursor-pointer rounded-lg"
                                x-text="estrutura"
                                @click="open = true"
                            ></li>
                        </template>
                    </ul>
                </div>
            </li>

            <li class="p-2 px-4 hover:bg-[#003D60] cursor-pointer rounded-[10px] group mt-60 ml-4 mr-4">
                <p class="flex items-center justify-start gap-10 text-black font-bold group-hover:text-white">
                    <x-user-icon width="30px" height="30px" color="currentColor"/>
                    Usuários
                </p>
            </li>

            <li class="p-2 m-4 px-4 hover:bg-[#003D60] cursor-pointer rounded-[10px] group">
                <p class="flex items-center justify-start gap-10 text-black font-bold group-hover:text-white">
                    <x-suport-icon width="30px" height="30px" color="currentColor"/>
                    Suporte
                </p>
            </li>

            <li class="p-2 m-4 px-4 hover:bg-red-500 cursor-pointer rounded-[10px] group">
                <p class="flex items-center justify-start gap-10 text-black font-bold group-hover:text-white">
                    <x-logout-icon width="30px" height="30px" color="currentColor"/>
                    Sair
                </p>
            </li>
        </ul>

        <small class="text-black flex items-center justify-center mt-16">
            Powered by Somos Dev's
        </small>
    </div>
</div>
