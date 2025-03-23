<div>
    <form wire:submit="changePassword" class="mr-14 ml-14">
        <x-auth-session-status class="mb-4 flex items-center justify-center" :status="session('status')" />
        @if(session()->has('error'))
            <div class="flex items-center justify-center bg-red-500 text-white p-3 rounded mb-2">
                {{ session('error') }}
            </div>
        @endif
        @if(session()->has('success'))
            <div class="flex items-center justify-center bg-green-500 text-white p-3 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif

        <p class="text-sm text-gray-600 text-center">
            {{ __('Digite sua nova senha e clique em alterar senha para alterar.') }}
        </p>

        <div class="relative mt-4">
            <input
                type="password"
                id="new_password"
                name="new_password"
                wire:model.blur="new_password"
                required
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                placeholder="Digite sua nova senha"
                onfocus="this.placeholder=''"
                onblur="this.placeholder='Digite sua nova senha'"
            />
            <div>
                @error('code') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button type="submit" class="w-full flex items-center justify-center p-6 hover:bg-[#003D60]/85 bg-[#003D60] rounded-[10px] uppercase font-bold text-white">
                <span wire:loading.remove wire:target="changePassword" class="font-ubuntu">
                    {{ __('Alterar Senha') }}
                </span>
                <span wire:loading wire:target="changePassword">
                    Alterando a senha...
                </span>
            </button>
        </div>
    </form>
</div>
