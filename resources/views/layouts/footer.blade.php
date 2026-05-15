<footer class="border-t border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-900">Smart Irrigation Control System</p>
                <p class="mt-1 text-sm text-gray-500">
                    Connecting farmers, service providers, and device manufacturers.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-gray-500">
                <a href="{{ route('about') }}" class="transition hover:text-emerald-700">About</a>
                <a href="{{ route('contact') }}" class="transition hover:text-blue-700">Contact</a>
                <span>&copy; {{ date('Y') }} All rights reserved.</span>
            </div>
        </div>
    </div>
</footer>
