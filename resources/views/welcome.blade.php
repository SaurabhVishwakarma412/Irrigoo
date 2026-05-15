<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Smart Irrigation') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    <div class="min-h-screen overflow-hidden">
        <header class="relative isolate">
            <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(16,185,129,0.22),_transparent_32%),radial-gradient(circle_at_80%_20%,_rgba(14,165,233,0.18),_transparent_28%)]"></div>
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-6 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-400/15 ring-1 ring-emerald-300/30">SI</span>
                    <span>
                        <span class="block text-lg font-bold">Smart Irrigation</span>
                        <span class="block text-xs text-slate-400">IoT farm operations platform</span>
                    </span>
                </a>
                <div class="flex items-center gap-3 text-sm font-semibold">
                    <a href="{{ route('about') }}" class="hidden text-slate-300 transition hover:text-white sm:block">About</a>
                    <a href="{{ route('contact') }}" class="hidden text-slate-300 transition hover:text-white sm:block">Contact</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-full bg-white px-4 py-2 text-slate-950">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-300 transition hover:text-white">Login</a>
                        <a href="{{ route('register') }}" class="rounded-full bg-emerald-400 px-4 py-2 text-slate-950 transition hover:bg-emerald-300">Register</a>
                    @endauth
                </div>
            </nav>

            <section class="mx-auto grid max-w-7xl gap-10 px-4 pb-20 pt-8 sm:px-6 lg:grid-cols-[1.02fr_0.98fr] lg:px-8 lg:pb-28 lg:pt-14">
                <div>
                    <p class="inline-flex rounded-full border border-emerald-300/20 bg-emerald-300/10 px-4 py-2 text-sm font-semibold text-emerald-200">Farmers · Providers · Manufacturers · Admins</p>
                    <h1 class="mt-6 max-w-4xl text-4xl font-bold tracking-tight text-white sm:text-6xl">Run irrigation like a living system, not a guessing game.</h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-300">Monitor water usage, control IoT irrigation devices, discover nearby service providers, and publish irrigation solutions from one verified platform.</p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('register') }}" class="rounded-2xl bg-emerald-400 px-6 py-3 text-center font-semibold text-slate-950 transition hover:bg-emerald-300">Create participant account</a>
                        <a href="{{ route('about') }}" class="rounded-2xl border border-white/15 px-6 py-3 text-center font-semibold text-white transition hover:bg-white/10">See how it works</a>
                    </div>
                </div>

                <div class="rounded-3xl border border-white/10 bg-white/10 p-5 shadow-2xl shadow-emerald-950/30 backdrop-blur">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-900/80 p-5">
                            <p class="text-sm text-slate-400">Soil moisture</p>
                            <p class="mt-4 text-4xl font-bold text-white">42%</p>
                            <p class="mt-2 text-sm text-emerald-300">Optimal range</p>
                        </div>
                        <div class="rounded-2xl bg-slate-900/80 p-5">
                            <p class="text-sm text-slate-400">Water flow</p>
                            <p class="mt-4 text-4xl font-bold text-white">3.8 L/min</p>
                            <p class="mt-2 text-sm text-sky-300">Live device feed</p>
                        </div>
                        <div class="rounded-2xl bg-slate-900/80 p-5 sm:col-span-2">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-slate-400">Platform workflow</p>
                                <span class="rounded-full bg-emerald-400/15 px-3 py-1 text-xs font-semibold text-emerald-200">Verified</span>
                            </div>
                            <div class="mt-5 grid gap-3 text-sm sm:grid-cols-3">
                                <div class="rounded-xl bg-white/5 p-4">1. Register role</div>
                                <div class="rounded-xl bg-white/5 p-4">2. Admin approves</div>
                                <div class="rounded-xl bg-white/5 p-4">3. Operate smarter</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>

        <main class="bg-slate-50 text-slate-900">
            <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
                <div class="rounded-3xl bg-emerald-950 px-6 py-8 text-white shadow-sm sm:px-8">
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-300">Project statement</p>
                    <h2 class="mt-3 text-2xl font-bold">IoT-based smart irrigation management platform</h2>
                    <p class="mt-4 max-w-5xl leading-7 text-emerald-50/90">This platform helps farmers manage irrigation through IoT technology. Farmers, irrigation service providers, and device manufacturers register on the platform, administrators verify participants, manufacturers propose IoT irrigation solutions, and farmers track water usage while finding local services based on location and crop type.</p>
                </div>
            </section>

            <section class="mx-auto grid max-w-7xl gap-5 px-4 py-14 sm:px-6 md:grid-cols-3 lg:px-8">
                <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-emerald-700">Farmers</p>
                    <h2 class="mt-3 text-xl font-bold">Track and control</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">View moisture, temperature, water flow, toggle irrigation, and request nearby services matched to location and crop type.</p>
                </article>
                <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-sky-700">Providers</p>
                    <h2 class="mt-3 text-xl font-bold">Offer local support</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Publish installation, maintenance, repair, and consultation services, then manage incoming farmer requests.</p>
                </article>
                <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-amber-700">Manufacturers</p>
                    <h2 class="mt-3 text-xl font-bold">Propose IoT solutions</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600">Show device capabilities, pricing, connectivity, crops, and features so admins can connect solutions to farms.</p>
                </article>
            </section>
        </main>
    </div>
</body>
</html>

