<div>
    <form wire:submit="verifyToken" class="mr-14 ml-14">
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
            {{ __('Para alterar a senha, primeiro confirme o código que enviamos no seu e-mail.') }}
        </p>

        <div class="relative mt-4">
            <input
                type="text"
                id="code"
                name="code"
                wire:model.blur="code"
                required
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                placeholder="Digite o código enviado no seu e-mail"
                onfocus="this.placeholder=''"
                onblur="this.placeholder='Digite o código enviado no seu e-mail'"
            />
            <div>
                @error('code') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button type="submit" class="w-full flex items-center justify-center p-6 hover:bg-[#003D60]/85 bg-[#003D60] rounded-[10px] uppercase font-bold text-white">
                <span wire:loading.remove wire:target="sendLink" class="font-ubuntu">
                    {{ __('Verificar Código') }}
                </span>
                <span wire:loading wire:target="sendLink">
                    Verificando Código...
                </span>
            </button>
        </div>
    </form>
</div>
