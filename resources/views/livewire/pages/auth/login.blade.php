<div>
    <form wire:submit="login" class="mr-14 ml-14">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4 flex items-center justify-center" :status="session('status')" />
        @if(session()->has('error'))
            <div class="flex items-center justify-center bg-red-500 text-white p-3 rounded">
                {{ session('error') }}
            </div>
        @endif
        @if(session()->has('success'))
            <div class="flex items-center justify-center bg-green-500 text-white p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="relative">
            <input
                type="email"
                id="email"
                name="email"
                wire:model="form.email"
                required
                autocomplete="username"
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                placeholder="Digite o seu E-mail"
                onfocus="this.placeholder=''"
                onblur="this.placeholder='Digite o seu E-mail'"
            />

            <x-input-error :messages="$errors->get('form.email')" class="mt-2 font-ubuntu" />
        </div>

        <!-- Password -->
        <div class="relative mt-6">
            <input
                type="password"
                id="password"
                name="password"
                wire:model="form.password"
                required
                autocomplete="none"
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                placeholder="Digite a sua Senha"
                onfocus="this.placeholder=''"
                onblur="this.placeholder='Digite a sua Senha'"
            />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 font-ubuntu" />

        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            @if (Route::has('recover_password'))
                <a class="font-ubuntu text-sm text-[#003D60] hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('recover_password') }}" wire:navigate>
                    {{ __('Recuperar minha senha') }}
                </a>

            @endif
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button type="submit" class="w-full flex items-center justify-center p-6 hover:bg-[#003D60]/85 bg-[#003D60] rounded-[10px] uppercase font-bold text-white">
                <span wire:loading.remove wire:target="login" class="font-ubuntu">
                    {{ __('Entrar') }}
                </span>
                <span wire:loading wire:target="login">
                    Carregando...
                </span>
            </button>
        </div>
    </form>
</div>
