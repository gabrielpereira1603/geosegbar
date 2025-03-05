<div>
    <form wire:submit="login" class="mr-14 ml-14">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <div class="relative">
            <input
                type="email"
                id="email"
                name="email"
                wire:model="form.email"
                required
                autofocus
                autocomplete="username"
                class="block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center"
                placeholder="Digite o seu Email"
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <div class="relative">
                <input
                    type="password"
                    id="password"
                    name="password"
                    wire:model="form.password"
                    required
                    autofocus
                    autocomplete="none"
                    class="block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center"
                    placeholder="Digite a sua Senha"
                />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Esqueci minha senha?') }}
                </a>
            @endif
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button class="w-full flex items-center justify-center p-6 bg-[#003D60] rounded-[10px] uppercase text-g font-bold text-white">
                {{ __('Entrar') }}
            </button>
        </div>

    </form>
</div>
