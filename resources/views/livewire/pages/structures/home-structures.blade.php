<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="flex gap-2 items-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <x-structure-icon width="30px" height="30px" color="currentColor"/>
                Estruturas
            </h2>

            <!-- Input de busca -->
            <input
                type="text"
                placeholder="Buscar estrutura..."
                class="px-4 py-2 border rounded-md text-gray-800 dark:text-gray-200 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 focus:ring focus:ring-gray-500"
            />
        </div>
    </x-slot>


    <div id="map" class="m-5 w-[98%] h-screen"></div>

</div>
