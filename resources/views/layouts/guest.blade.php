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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900
                        bg-cover bg-fixed bg-center"
             style="background-image: url({{ asset('images/login/background-login.png') }});">

            <div class="relative w-full flex justify-center items-center">
                <div class="absolute top-[38vw] sm:-top-[1.4vw] bg-white p-2 w-72 h-auto rounded-[10px] z-50  flex justify-center items-center shadow-lg">
                    <a href="/" wire:navigate>
                        <x-application-logo
                            width="120"
                            height="120"
                            alt="Logo GeoSegBar"/>
                    </a>
                </div>

                <div class="w-full mt-60 sm:mt-12 sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg z-10 pt-[22vw] sm:pt-[14vw] md:pt-[6vw]">
                    <div class="-z-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 sm:right-0 sm:left-2/2 transform sm:translate-x-0 -translate-x-1/2 mb-4 sm:mr-8 sm:mb-8">
                <x-application-logo-geometrisa
                    width="200"
                    height="100"
                    alt="Logo Geometrisa"/>
            </div>
        </div>
    </body>
</html>
