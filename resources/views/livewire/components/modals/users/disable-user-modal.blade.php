<div>
    <x-modal name="disable-user-modal">
        <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px] bg-white">
            <h2 class="flex items-center text-lg font-bold text-[#003D60] gap-2">
                <x-cancel-icon width="20px" height="20px" color="currentColor"/>
                Confirmar Desativação
            </h2>

            <div class="w-full h-[1.5px] bg-[#003D60] mt-2"></div>

            <p class="text-gray-700 mt-4">
                Tem certeza de que deseja desativar este usuário?
            </p>

            <div class="flex justify-end gap-4 mt-6">
                <button
                    @click="$dispatch('close-modal', 'disable-user-modal')"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md font-semibold text-sm uppercase tracking-wider hover:bg-gray-400 transition ease-in-out duration-150">
                    Cancelar
                </button>

                <button
                    wire:click="disableUser"
                    class="px-4 py-2 bg-red-600 text-white rounded-md font-semibold text-sm uppercase tracking-wider hover:bg-red-700 transition ease-in-out duration-150">
                    Desativar
                </button>
            </div>
        </div>
    </x-modal>
</div>
