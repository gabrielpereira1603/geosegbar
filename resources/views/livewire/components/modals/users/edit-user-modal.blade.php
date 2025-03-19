<div class="z-50">
    <x-modal name="edit-user-modal">
        <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px]">
            <h2 class="flex items-center text-lg font-bold text-[#003D60] gap-2">
                <x-user-edit-icon widht="20px" height="20px" color="currentColor"/>
                {{ __('Editar Usuário') }}
            </h2>

            <div class="w-[100%] h-[1.5px] bg-[#003D60] mt-2"></div>

            <div class="mt-3 flex items-center justify-start">
                @if (session()->has('error'))
                    <div class="bg-red-500 text-white p-3 rounded-md mb-3">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="bg-green-500 text-white p-3 rounded-md mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                @error('form.name')
                    <div class="bg-red-500 text-white p-3 rounded-md mb-3">{{ $message }}</div>
                @enderror
                @error('form.email')
                    <div class="bg-red-500 text-white p-3 rounded-md mb-3">{{ $message }}</div>
                @enderror
                @error('form.phone')
                    <div class="bg-red-500 text-white p-3 rounded-md mb-3">{{ $message }}</div>
                @enderror
                @error('form.sex')
                    <div class="bg-red-500 text-white p-3 rounded-md mb-3">{{ $message }}</div>
                @enderror
            </div>

            <form wire:submit.prevent="edit" class="bg-white">
                @csrf


                <div class="mt-1 flex flex-col gap-2">
                    <label for="name" class="text-gray-700 text-sm font-medium">Nome <span class="text-red-500">*</span></label>
                    <input type="text" id="name" wire:model.defer="form.name" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" placeholder="Nome do usuário" required>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <label for="email" class="text-gray-700 text-sm font-medium">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" wire:model.defer="form.email" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" placeholder="Email do usuário" required>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <label for="email" class="text-gray-700 text-sm font-medium">Email <span class="text-red-500">*</span></label>
                    <input type="text" id="email" wire:model.defer="form.phone" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" placeholder="Telefone do usuário" required>
                </div>

                <div class="mt-4 flex flex-col gap-2">
                    <label for="sex" class="text-gray-700 text-sm font-medium">Sexo <span class="text-red-500">*</span></label>
                    <select id="sex" wire:model.defer="form.sex" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" required>
                        <option value="1">Masculino</option>
                        <option value="2">Feminino</option>
                        <option value="3">Outro</option>
                    </select>
                </div>


                <div class="mt-6 flex justify-end gap-4">
                    <button type="button" @click="$dispatch('close-modal', 'edit-user-modal')" class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">
                        Salvar Alterações do Usuário
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
