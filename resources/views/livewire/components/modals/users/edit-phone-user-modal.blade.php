<x-modal name="edit-phone-user" wire:ignore.self wire:key="edit-phone-modal">
    <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px]">
        <h2 class="text-lg font-bold text-[#003D60]">
            {{ __('Alterar meu número de telefone') }}
        </h2>

        @if ($step === 1)
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Para alterar o telefone, primeiro confirme seu número atual preenchendo os dígitos ocultos.') }}
            </p>

            <form wire:submit.prevent="confirmPhoneNumber" class="bg-white">
                @csrf
                @error('form.photos') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="mt-4 flex flex-col gap-2">
                    <label class="text-gray-700 text-sm font-medium">Número atual:</label>
                    <div class="p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800">
                        {{ $this->form->phone_formated }}
                    </div>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <label for="phone" class="text-gray-700 text-sm font-medium">Complete os dígitos ocultos:</label>
                    <input type="text" id="phone" wire:model.defer="form.phone" maxlength="4"
                           class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900"
                           placeholder="Digite os números faltantes" required>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-phone-user')"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">
                        Confirmar
                    </button>
                </div>
            </form>
        @elseif ($step === 2)
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Um código de verificação foi enviado para o seu e-mail. Digite abaixo para confirmar a alteração.') }}
            </p>

            <form>
                <div class="mt-4 flex flex-col gap-2">
                    <label for="token" class="text-gray-700 text-sm font-medium">Código de Verificação:</label>
                    <input type="text" id="token" wire:model.defer="token" maxlength="6"
                           class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900"
                           placeholder="Digite o código recebido" required>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-phone-user')"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">
                        Confirmar Código
                    </button>
                </div>
            </form>
        @endif
    </div>
</x-modal>

