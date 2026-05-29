<footer class="border-t border-slate-800 bg-slate-950 text-slate-300">
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[1.3fr_2fr]">
            <div>
                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="inline-flex items-center gap-3">
                    <x-application-logo class="h-11 w-auto" />
                    <div>
                        <p class="text-lg font-bold tracking-wide text-white">Irrigoo</p>
                        <p class="text-sm text-emerald-300">AG Smart Irrigation</p>
                    </div>
                </a>

                <p class="m-6 max-w-md text-sm leading-6 text-slate-400">
                    Smart irrigation support for farmers, service providers, and manufacturers. Monitor field conditions,
                    coordinate services, and manage connected irrigation devices from one practical platform.
                </p>
            </div>

            <div class="grid m-4 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-white">Platform</h2>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><a href="{{ route('about') }}" class="transition hover:text-emerald-300">About Irrigoo</a></li>
                        <li><a href="{{ route('contact') }}" class="transition hover:text-emerald-300">Contact team</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="transition hover:text-emerald-300">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('home') }}" class="transition hover:text-emerald-300">Home</a></li>
                        @endauth
                    </ul>
                </div>

                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-white">For Users</h2>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><span class="text-slate-400">Farmers</span></li>
                        <li><span class="text-slate-400">Service providers</span></li>
                        <li><span class="text-slate-400">Manufacturers</span></li>
                        @guest
                            <li><a href="{{ route('register') }}" class="transition hover:text-emerald-300">Create account</a></li>
                        @endguest
                    </ul>
                </div>

                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-white">Help</h2>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li><a href="{{ route('contact') }}" class="transition hover:text-emerald-300">Device support</a></li>
                        <li><a href="{{ route('contact') }}" class="transition hover:text-emerald-300">Service requests</a></li>
                        <li><a href="{{ route('contact') }}" class="transition hover:text-emerald-300">Account help</a></li>
                        @guest
                            <li><a href="{{ route('login') }}" class="transition hover:text-emerald-300">Login</a></li>
                        @endguest
                    </ul>
                </div>

                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-white">Contact</h2>
                    <ul class="mt-4 space-y-3 text-sm">
                        <li>
                            <a href="mailto:support@example.com" class="transition hover:text-emerald-300">
                                support@example.com
                            </a>
                        </li>
                        <li>
                            <a href="tel:+911234567890" class="transition hover:text-emerald-300">
                                +91 12345 67890
                            </a>
                        </li>
                        <li class="text-slate-400">India</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-4 border-t border-slate-800 pt-6 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>&copy; {{ date('Y') }} Irrigoo. All rights reserved.</p>
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                <span>Water-smart farming tools</span>
                <span class="hidden h-1 w-1 rounded-full bg-slate-700 md:inline-block"></span>
                <span>Built for connected agriculture</span>
            </div>
        </div>
    </div>
</footer>
