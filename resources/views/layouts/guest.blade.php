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
    <body class="font-sans text-slate-900 antialiased min-h-screen overflow-x-hidden bg-[#f5f8f2]">
        <div class="min-h-screen flex flex-col bg-[radial-gradient(circle_at_12%_16%,rgba(16,185,129,0.18),transparent_28%),radial-gradient(circle_at_88%_12%,rgba(20,184,166,0.14),transparent_26%),linear-gradient(135deg,#f7fbf3_0%,#eef7ed_48%,#e5f3ef_100%)]">
            <main class="flex-1 grid place-items-center px-4 py-10 sm:px-6 lg:px-8">
                <div class="w-full max-w-5xl overflow-hidden rounded-[2rem] border border-white/80 bg-white/85 shadow-2xl shadow-emerald-950/10 backdrop-blur">
                    <div class="grid lg:grid-cols-[0.82fr_1fr]">
                        <section class="hidden min-h-full bg-emerald-700 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                            <div>
                                <a href="/" class="inline-flex items-center gap-3">
                                    <x-application-logo class="h-11 w-11 bg-white text-emerald-700 shadow-sm" />
                                    <span class="text-lg font-semibold">AG Smart Irrigation</span>
                                </a>
                            </div>

                            <div class="space-y-6">
                                <div class="inline-flex rounded-full bg-emerald-600 px-4 py-2 text-sm font-medium text-emerald-50">
                                    Smart water decisions start here
                                </div>
                                <div>
                                    <h1 class="text-4xl font-bold leading-tight">Manage irrigation, devices, and services from one calm workspace.</h1>
                                    <p class="mt-4 max-w-sm text-sm leading-6 text-emerald-50">
                                        Sign in to monitor farms, connect providers, and keep every field closer to the right amount of water.
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3 text-sm">
                                <div class="rounded-2xl bg-emerald-600 p-4">
                                    <p class="text-2xl font-bold">24/7</p>
                                    <p class="mt-1 text-emerald-50">Sensor access</p>
                                </div>
                                <div class="rounded-2xl bg-emerald-600 p-4">
                                    <p class="text-2xl font-bold">3</p>
                                    <p class="mt-1 text-emerald-50">User roles</p>
                                </div>
                                <div class="rounded-2xl bg-emerald-600 p-4">
                                    <p class="text-2xl font-bold">Low</p>
                                    <p class="mt-1 text-emerald-50">Water waste</p>
                                </div>
                            </div>
                        </section>

                        <section class="px-5 py-8 sm:px-10 lg:px-12">
                            <div class="mb-8 flex items-center justify-between lg:hidden">
                                <a href="/" class="inline-flex items-center gap-3">
                                    <x-application-logo />
                                    <span class="font-semibold text-slate-900">AG Smart Irrigation</span>
                                </a>
                            </div>

                            {{ $slot }}
                        </section>
                    </div>
                </div>
            </main>

            @include('layouts.footer')
        </div>
    </body>
</html>
