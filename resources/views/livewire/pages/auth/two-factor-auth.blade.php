<div>

    <form wire:submit="login" class="mr-14 ml-14">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-center text-lg font-semibold mb-4">Autenticação de Dois Fatores</h2>

        <div class="relative">
            <input
                type="string"
                id="token"
                name="token"
                wire:model="form.token"
                required
                autofocus
                autocomplete="none"
                class="block border-b-2 border-t-0 border-l-0 border-r-0 w-full mt-1 px-0 py-2 border-gray-400 text-center"
                placeholder="Digite o Token"
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="w-full mt-6 mb-4 flex items-center">
            <button class="w-full flex items-center justify-center p-6 bg-[#003D60] rounded-[10px] uppercase text-g font-bold text-white">
                {{ __('Acessar') }}
            </button>
        </div>

    </form>

</div>
