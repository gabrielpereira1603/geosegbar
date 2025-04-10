<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Sistema de Segurança de Barragem">
    <link rel="shortcut icon" href="{{ asset('images/logo-quadrada.png') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .leaflet-touch .leaflet-control-layers, .leaflet-touch .leaflet-bar{
        display: flex;
        flex-direction: column;
        gap: 12px;
        border: none !important;
    }
</style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" >
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                openSideMenu: true,
                toggle() {
                    this.openSideMenu = !this.openSideMenu;
                }
            });
        });
    </script>
    <div class="min-h-screen bg-gray-200" x-data="{ openSideMenu: true }">
        <livewire:layout.navigation />

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow"
                    :class="$store.sidebar.openSideMenu ? 'ml-20 sm:ml-64' : 'ml-20 sm:ml-14'">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <main
            class="transition-all duration-300 ease-in-out flex-1 p-4"
            :class="$store.sidebar.openSideMenu ? 'ml-20 sm:ml-64' : 'ml-20 sm:ml-14'"
        >

            <div class="m-2">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
