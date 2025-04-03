<div>

    <form wire:submit="verifyToken" class="mr-14 ml-14">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-center text-lg font-semibold mb-4">Autenticação de Dois Fatores</h2>

        <div class="relative">
            <input
                type="text"
                id="code"
                name="code"
                wire:model="form.code"
                required
                autofocus
                autocomplete="none"
                class="font-ubuntu block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center focus:outline-none focus:ring-0 focus:border-gray-600"
                placeholder="Digite o Código"
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button type="submit" class="w-full flex items-center justify-center p-6 bg-[#003D60] rounded-[10px] uppercase font-bold text-white">
                <span wire:loading.remove wire:target="verifyToken">
                    {{ __('Validar Código') }}
                </span>
                <span wire:loading wire:target="verifyToken">
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
