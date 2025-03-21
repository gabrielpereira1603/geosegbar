<x-modal name="change-password-user" wire:ignore.self wire:key="edit-phone-modal">
    <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px]">
        <h2 class="text-lg font-bold text-[#003D60]">
            {{ __('Alterar minha senha') }}
        </h2>
        @if($step === 1)
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Para alterar a senha, primeiro confirme o código que vamos enviar no e-mail abaixo.') }}
            </p>

            <form wire:submit.prevent="startEditing" class="bg-white">
                @csrf
                @error('form.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="w-full mt-4 flex flex-col gap-2">
                    <label class="text-gray-700 text-sm font-medium">E-mail atual:</label>
                    <div class="flex w-full justify-center items-center relative">
                        <div class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800">
                            {{ $this->form->user['email'] }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'change-password-user')"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Fechar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">

                    <span wire:loading.remove wire:target="startEditing" class="font-ubuntu">
                        {{ __('Enviar Código') }}
                    </span>
                        <span wire:loading wire:target="startEditing">
                        Carregando...
                    </span>
                    </button>
                </div>
            </form>
        @elseif($step === 2)
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Confirme o código enviado no seu e-mail.') }}
            </p>

            <form wire:submit.prevent="nextStep" class="bg-white">
                @csrf
                @error('form.token') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="w-full mt-4 flex flex-col gap-2">
                    <label class="text-gray-700 text-sm font-medium">Código:</label>
                    <div class="flex w-full justify-center items-center relative">
                            <input type="text" wire:model="form.token" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'change-password-user')"
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Fechar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">

                    <span wire:loading.remove wire:target="nextStep" class="font-ubuntu">
                        {{ __('Enviar Código') }}
                    </span>
                        <span wire:loading wire:target="nextStep">
                        Carregando...
                    </span>
                    </button>
                </div>
            </form>
        @elseif($step === 3)
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Digite a sua nova senha.') }}
            </p>

            <form wire:submit.prevent="changePassword" class="bg-white">
                @csrf
                @error('form.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @error('form.password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @error('form.current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="w-full mt-4 flex flex-col gap-2">
                    <label class="text-gray-700 text-sm font-medium">Senha Atual:</label>
                    <div class="flex w-full justify-center items-center relative">
                        <input type="password" wire:model="form.current_password" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" />
                    </div>
                    <label class="text-gray-700 text-sm font-medium">Nova Senha:</label>
                    <div class="flex w-full justify-center items-center relative">
                        <input type="password" wire:model="form.password" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" />
                    </div>
                    <label class="text-gray-700 text-sm font-medium">Confirme a Nova Senha:</label>
                    <div class="flex w-full justify-center items-center relative">
                        <input type="password" wire:model="form.password_confirmation" class="w-full p-3 bg-gray-100 rounded-md text-lg font-semibold text-gray-800" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'change-password-user')"
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
        @endif

    </div>
</x-modal>
