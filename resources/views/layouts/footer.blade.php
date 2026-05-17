<footer class="border-t border-slate-800 bg-slate-950 text-slate-300">
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500 text-sm font-black tracking-wide text-white">
                        AG
                    </div>
                    <div>
                        <p class="text-base font-semibold text-white">AG Smart Irrigation</p>
                        <p class="text-sm text-slate-400">Connected farming, clearer decisions, less wasted water.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm">
                <a href="{{ route('about') }}" class="transition hover:text-emerald-300">About</a>
                <a href="{{ route('contact') }}" class="transition hover:text-emerald-300">Contact</a>
                @guest
                    <a href="{{ route('login') }}" class="transition hover:text-emerald-300">Login</a>
                @endguest
                <span class="text-slate-500">&copy; {{ date('Y') }} AG Smart Irrigation</span>
            </div>
        </div>
    </div>
</footer>
