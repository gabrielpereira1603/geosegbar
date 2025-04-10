<div class="relative m-5" style="">
    <div class="relative z-[1]">
        <div class="flex items-center relative flex-row">
            <button class="absolute top-10 flex justify-between items-center bg-[#003D60] px-5 py-2">
                <p class="text-ls font-medium text-white">Adicionar nova estrutura</p>

                <div class="absolute -right-10 p-3 bg-gray-200 rounded-[4px]">
                    <x-arrow-icon widht="30px" height="30px" color="#003D60" />
                </div>
            </button>


        </div>
    </div>

    <div
        id="map"
        x-data='{ dams: @json($damns) }'
        x-init="initMap(dams)"
        class="w-[102%] h-[calc(105vh-100px)] rounded-[8px] shadow-lg overflow-hidden -z-0"
    ></div>
</div>
