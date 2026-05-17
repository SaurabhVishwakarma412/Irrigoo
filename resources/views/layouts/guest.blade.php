<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased relative min-h-screen overflow-x-hidden bg-gradient-to-br from-green-900 via-emerald-800 to-teal-900">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-emerald-500/20 blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[20%] right-[10%] w-[30%] h-[30%] rounded-full bg-teal-400/20 blur-[80px]"></div>
        </div>

        <div class="min-h-screen flex flex-col">
            <main class="flex-1 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-12">
                <div class="mt-8 mb-4">
                    <a href="/" class="flex items-center gap-2 group">
                        <svg class="w-12 h-12 text-emerald-400 group-hover:text-emerald-300 transition-colors duration-300 drop-shadow-[0_0_15px_rgba(52,211,153,0.5)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                        </svg>
                        <span class="text-3xl font-bold text-white tracking-tight drop-shadow-md">Irrigoo</span>
                    </a>
                </div>

                <div class="w-full sm:max-w-xl px-8 py-8 bg-white/90 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] sm:rounded-3xl border border-white/20 transform transition-all hover:scale-[1.01] duration-500">
                    {{ $slot }}
                </div>
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>
