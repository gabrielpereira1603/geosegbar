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
        <div class="relative mt-6" x-data="{ show: false }">
            <input
                :type="show ? 'text' : 'password'"
                id="password"
                name="password"
                wire:model="form.password"
                required
                autocomplete="none"
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600 pr-10"
                placeholder="Digite a sua Senha"
                onfocus="this.placeholder=''"
                onblur="this.placeholder='Digite a sua Senha'"
            />

            <template x-if="$wire.form.password">
                <button type="button" @click="show = !show" class="absolute right-2 top-3 text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>

                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"
                         width="18px" height="18px" fill="currentColor">
                        <path d="M23.271,9.419A15.866,15.866,0,0,0,19.9,5.51l2.8-2.8a1,1,0,0,0-1.414-1.414L18.241,4.345A12.054,12.054,0,0,0,12,2.655C5.809,2.655,2.281,6.893.729,9.419a4.908,4.908,0,0,0,0,5.162A15.866,15.866,0,0,0,4.1,18.49l-2.8,2.8a1,1,0,1,0,1.414,1.414l3.052-3.052A12.054,12.054,0,0,0,12,21.345c6.191,0,9.719-4.238,11.271-6.764A4.908,4.908,0,0,0,23.271,9.419ZM2.433,13.534a2.918,2.918,0,0,1,0-3.068C3.767,8.3,6.782,4.655,12,4.655A10.1,10.1,0,0,1,16.766,5.82L14.753,7.833a4.992,4.992,0,0,0-6.92,6.92l-2.31,2.31A13.723,13.723,0,0,1,2.433,13.534ZM15,12a3,3,0,0,1-3,3,2.951,2.951,0,0,1-1.285-.3L14.7,10.715A2.951,2.951,0,0,1,15,12ZM9,12a3,3,0,0,1,3-3,2.951,2.951,0,0,1,1.285.3L9.3,13.285A2.951,2.951,0,0,1,9,12Zm12.567,1.534C20.233,15.7,17.218,19.345,12,19.345A10.1,10.1,0,0,1,7.234,18.18l2.013-2.013a4.992,4.992,0,0,0,6.92-6.92l2.31-2.31a13.723,13.723,0,0,1,3.09,3.529A2.918,2.918,0,0,1,21.567,13.534Z"/></svg>

                </button>
            </template>

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

    @script
    <script>
        $wire.on('user-success', (event) => {
            console.log(event)
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: event.title,
                confirmButtonText: 'Ok'
            });
            $wire.dispatch('load-users');
        });

        $wire.on('user-error', (event) => {
            console.log(event)
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: event.title,
                confirmButtonText: 'Ok'
            });
            $wire.dispatch('load-users');
        });

        $wire.on('load-table-users', () => {
            $wire.dispatch('load-users');
        });
    </script>
    @endscript
</div>
