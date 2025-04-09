<x-modal name="first-access-modal">
    <div class="p-4">
        <h2 class="text-lg font-bold text-[#003D60]">
            {{ __('Troque sua senha') }}
        </h2>

        <p class="mt-2 text-sm text-red-600">
            Recomendamos que para prosseguir, você altere sua senha!
        </p>

        <form wire:submit.prevent="changePassword" class="bg-white">
            @csrf
            @error('form.new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @error('form.current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="w-full mt-4 flex flex-col gap-2">
                <label class="text-gray-700 text-sm font-medium">Senha atual:</label>
                <div class="relative" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'"
                           wire:model="form.current_password"
                           class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800 pr-10"
                           placeholder="Digite sua senha atual" />

                    <button type="button" @click="show = !show"
                            class="absolute right-3 top-3 text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                             width="18px" height="18px" fill="currentColor">
                            <path d="M23.271,9.419A15.866,15.866,0,0,0,19.9,5.51l2.8-2.8a1,1,0,0,0-1.414-1.414L18.241,4.345A12.054,12.054,0,0,0,12,2.655C5.809,2.655,2.281,6.893.729,9.419a4.908,4.908,0,0,0,0,5.162A15.866,15.866,0,0,0,4.1,18.49l-2.8,2.8a1,1,0,1,0,1.414,1.414l3.052-3.052A12.054,12.054,0,0,0,12,21.345c6.191,0,9.719-4.238,11.271-6.764A4.908,4.908,0,0,0,23.271,9.419ZM2.433,13.534a2.918,2.918,0,0,1,0-3.068C3.767,8.3,6.782,4.655,12,4.655A10.1,10.1,0,0,1,16.766,5.82L14.753,7.833a4.992,4.992,0,0,0-6.92,6.92l-2.31,2.31A13.723,13.723,0,0,1,2.433,13.534ZM15,12a3,3,0,0,1-3,3,2.951,2.951,0,0,1-1.285-.3L14.7,10.715A2.951,2.951,0,0,1,15,12ZM9,12a3,3,0,0,1,3-3,2.951,2.951,0,0,1,1.285.3L9.3,13.285A2.951,2.951,0,0,1,9,12Zm12.567,1.534C20.233,15.7,17.218,19.345,12,19.345A10.1,10.1,0,0,1,7.234,18.18l2.013-2.013a4.992,4.992,0,0,0,6.92-6.92l2.31-2.31a13.723,13.723,0,0,1,3.09,3.529A2.918,2.918,0,0,1,21.567,13.534Z"/></svg>

                    </button>
                </div>

                <label class="text-gray-700 text-sm font-medium">Nova senha:</label>
                <div class="relative" x-data="{ show: false }">
                    <input :type="show ? 'text' : 'password'"
                           wire:model="form.new_password"
                           class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800 pr-10"
                           placeholder="Digite sua nova senha" />

                    <button type="button" @click="show = !show"
                            class="absolute right-3 top-3 text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                             width="18px" height="18px" fill="currentColor">
                            <path d="M23.271,9.419A15.866,15.866,0,0,0,19.9,5.51l2.8-2.8a1,1,0,0,0-1.414-1.414L18.241,4.345A12.054,12.054,0,0,0,12,2.655C5.809,2.655,2.281,6.893.729,9.419a4.908,4.908,0,0,0,0,5.162A15.866,15.866,0,0,0,4.1,18.49l-2.8,2.8a1,1,0,1,0,1.414,1.414l3.052-3.052A12.054,12.054,0,0,0,12,21.345c6.191,0,9.719-4.238,11.271-6.764A4.908,4.908,0,0,0,23.271,9.419ZM2.433,13.534a2.918,2.918,0,0,1,0-3.068C3.767,8.3,6.782,4.655,12,4.655A10.1,10.1,0,0,1,16.766,5.82L14.753,7.833a4.992,4.992,0,0,0-6.92,6.92l-2.31,2.31A13.723,13.723,0,0,1,2.433,13.534ZM15,12a3,3,0,0,1-3,3,2.951,2.951,0,0,1-1.285-.3L14.7,10.715A2.951,2.951,0,0,1,15,12ZM9,12a3,3,0,0,1,3-3,2.951,2.951,0,0,1,1.285.3L9.3,13.285A2.951,2.951,0,0,1,9,12Zm12.567,1.534C20.233,15.7,17.218,19.345,12,19.345A10.1,10.1,0,0,1,7.234,18.18l2.013-2.013a4.992,4.992,0,0,0,6.92-6.92l2.31-2.31a13.723,13.723,0,0,1,3.09,3.529A2.918,2.918,0,0,1,21.567,13.534Z"/></svg>
                    </button>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" @click="$dispatch('close-modal', 'first-access-modal')"
                        class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                    Fechar
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">

                    <span wire:loading.remove wire:target="changePassword" class="font-ubuntu">
                        {{ __('Alterar Senha') }}
                    </span>
                    <span wire:loading wire:target="changePassword">
                        Carregando...
                    </span>
                </button>
            </div>
        </form>
    </div>
</x-modal>
