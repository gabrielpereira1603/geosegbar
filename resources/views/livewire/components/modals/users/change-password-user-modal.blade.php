<x-modal name="change-password-user" wire:ignore.self wire:key="change-password-user">
    <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px]">
        <h2 class="flex items-center gap-1 text-lg font-bold text-[#003D60]">
            <x-password-icon widht="22px" height="22px" color="currentColor"/>
            {{ __('Alterar minha senha') }}
        </h2>
        <form wire:submit.prevent="changePassword" class="bg-white">
            @csrf
            @error('form.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            @error('form.current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="w-full mt-4 flex flex-col gap-2">
                <label class="text-gray-700 text-sm font-medium">Senha Atual:</label>
                <div class="flex w-full justify-center items-center relative">
                    <input type="password" wire:model="form.current_password" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" required/>
                </div>
                <label class="text-gray-700 text-sm font-medium">Nova Senha:</label>
                <div class="flex w-full justify-center items-center relative">
                    <input type="password" wire:model="form.password" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" required/>
                </div>
            </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Fechar
                    </button>
                    <button type="submit" wire:target="changePassword"
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
