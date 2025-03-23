<div>
    <form wire:submit="sendLink" class="mr-14 ml-14">
        <x-auth-session-status class="mb-4 flex items-center justify-center" :status="session('status')" />
        @if(session()->has('error'))
            <div class="flex items-center justify-center bg-red-500 text-white p-3 rounded mb-2 text-center">
                {{ session('error') }}
            </div>
        @endif


        <p class="text-sm text-gray-600 text-center">
            {{ __('Para alterar a senha, primeiro digite seu e-mail para que possamos enviar o código de alteração.') }}
        </p>

        <div class="relative mt-4">
            <input
                type="email"
                id="email"
                name="email"
                wire:model.blur="email"
                required
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                placeholder="Digite Seu E-mail"
                onfocus="this.placeholder=''"
                onblur="this.placeholder='Digite Seu E-mail'"
            />

            <div>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="block mt-6">
            @if (Route::is('recover_password'))
                <a class="font-ubuntu text-sm text-[#003D60] hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('login') }}" wire:navigate>
                    {{ __('Voltar para o login') }}
                </a>

            @endif
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button type="submit" class="w-full flex items-center justify-center p-6 hover:bg-[#003D60]/85 bg-[#003D60] rounded-[10px] uppercase font-bold text-white">
                <span wire:loading.remove wire:target="sendLink" class="font-ubuntu">
                    {{ __('Enviar Código') }}
                </span>
                <span wire:loading wire:target="sendLink">
                    Enviando E-mail...
                </span>
            </button>
        </div>
    </form>
</div>
