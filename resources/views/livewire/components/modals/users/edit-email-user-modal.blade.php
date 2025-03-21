<x-modal name="edit-email-user" wire:ignore.self wire:key="edit-phone-modal">
    <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px]">
        <h2 class="text-lg font-bold text-[#003D60]">
            {{ __('Alterar meu endereço de e-mail') }}
        </h2>

        <form wire:submit.prevent="save" class="bg-white">
            @csrf
            @error('form.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="w-full mt-4 flex flex-col gap-2">
                <label class="text-gray-700 text-sm font-medium">E-mail atual:</label>
                <div class="flex w-full justify-center items-center relative">
                    @if (!$isEditing)
                        <div class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800">
                            {{ $this->form->email }}
                        </div>
                        <div class="absolute top-0 right-0 p-4">
                            <a href="javascript:void(0)" wire:click="startEditing()">
                                <x-edit-icon width="16px" height="16px" color="currentColor"/>
                            </a>
                        </div>
                    @else
                        <input type="text" wire:model="form.email" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" />
                    @endif

                </div>
            </div>

            @if(!$isEditing)
                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-email-user')"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Fechar
                    </button>
                </div>
            @else
                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" wire:click="cancelEditing()"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Descartar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">

                        <span wire:loading.remove wire:target="save" class="font-ubuntu">
                            {{ __('Salvar Alterações') }}
                        </span>
                        <span wire:loading wire:target="save">
                            Carregando...
                        </span>
                    </button>
                </div>
            @endif
        </form>
    </div>
</x-modal>
