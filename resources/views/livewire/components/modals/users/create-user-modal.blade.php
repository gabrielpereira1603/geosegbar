<x-modal name="create-user-modal">
    <div class="p-6 shadow-xl shadow-gray-400 rounded-[10px]">
        <h2 class="flex items-center text-lg font-bold text-[#003D60] gap-2">
            <x-user-add-icon widht="20px" height="20px" color="currentColor"/>
            {{ __('Criar Usuário') }}
        </h2>

        <div class="w-[100%] h-[1.5px] bg-[#003D60] mt-2"></div>


        <form wire:submit.prevent="create" class="bg-white">
            @csrf

            @error('form.name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @error('form.email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @error('form.phone')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @error('form.password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @error('form.sex')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div class="mt-4 flex flex-col gap-2">
                <label for="name" class="text-gray-700 text-sm font-medium">Nome <span class="text-red-500">*</span></label>
                <input type="text" id="name" wire:model.defer="form.name" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" placeholder="Nome do usuário" required>
            </div>

            <div class="mt-4 flex flex-col gap-2">
                <label for="email" class="text-gray-700 text-sm font-medium">Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" wire:model.defer="form.email" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" placeholder="Email do usuário" required>
            </div>

            <div class="mt-4 flex flex-col gap-2">
                <label for="phone" class="text-gray-700 text-sm font-medium">Telefone </label>
                <input type="phone" id="phone" wire:model.defer="form.phone" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" placeholder="Telefone do usuário" required>
            </div>

            <div class="mt-4 flex flex-col gap-2">
                <label for="role" class="text-gray-700 text-sm font-medium">Acesso <span class="text-red-500">*</span></label>
                <select id="role" wire:model.live="form.role" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900" required>
                    <option>Selecione um acesso:</option>
                    @foreach($roles as $role)
                        <option value="{{ $role['id'] }}">{{ $role['description'] }}</option>
                    @endforeach
                </select>
            </div>

            @if(!empty($collaborators))
                <div class="mt-4 flex flex-col gap-2">
                    <label for="collaborator" class="text-gray-700 text-sm font-medium">Selecionar Colaborador</label>
                    <select id="collaborator" wire:model.defer="form.collaborator_id" class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#003D60] text-lg text-gray-900">
                        <option value="">Selecione um colaborador:</option>
                        @foreach($collaborators as $collaborator)
                            <option value="{{ $collaborator['id'] }}">{{ $collaborator['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            @endif


            <div class="mt-6 flex justify-end gap-4">
                <button type="button" @click="$dispatch('close-modal', 'create-user-modal')" class="px-4 py-2 bg-gray-300 rounded-md text-gray-800 font-semibold hover:bg-gray-400 transition">
                    Cancelar
                </button>
                <button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 bg-[#003D60] text-white rounded-md font-semibold hover:bg-gray-900 transition">
                    <x-add-icon widht="16px" height="16px" color="currentColor"/>
                    Criar Usuário
                </button>
            </div>
        </form>
    </div>
</x-modal>
