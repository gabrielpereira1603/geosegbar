<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        @if(session()->has('error'))
            <div class="bg-red-500 text-white p-3 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="relative" x-data="{ placeholder: 'Digite o seu Email' }">
            <input
                type="email"
                id="email"
                name="email"
                wire:model="email"
                required
                autocomplete="username"
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                x-bind:placeholder="placeholder"
                @focus="placeholder = ''"
                @blur="placeholder = 'Digite o seu E-mail'"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 font-ubuntu" />

        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button type="submit" class="w-full flex items-center justify-center p-6 hover:bg-[#003D60]/85 bg-[#003D60] rounded-[10px] uppercase font-bold text-white">
                <span wire:loading.remove wire:target="sendPasswordResetLink" class="font-ubuntu">
                    {{ __('Enviar Link') }}
                </span>
                <span wire:loading wire:target="login">
                    Carregando...
                </span>
            </button>
        </div>
    </form>
</div>
