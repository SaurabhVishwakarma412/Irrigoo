<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Smart Irrigation Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500">A single place to monitor farms, devices, services, and irrigation activity.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="overflow-hidden rounded-2xl bg-slate-900 p-8 text-white shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-300">IoT Smart Irrigation</p>
                    <h3 class="mt-3 text-3xl font-bold">Make every drop work harder.</h3>
                    <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-300">
                        Track irrigation devices, monitor soil conditions, connect farmers with service providers,
                        and keep the whole system visible from one clean dashboard.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('login') }}" class="rounded-md bg-emerald-500 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-600">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="rounded-md border border-white/20 px-4 py-2 text-sm font-semibold text-white hover:bg-white/10">
                            Register
                        </a>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-white p-5 shadow-sm">
                        <div class="text-xs font-semibold uppercase text-gray-500">Farmers</div>
                        <p class="mt-2 text-sm text-gray-600">Monitor moisture, water flow, and service requests.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-5 shadow-sm">
                        <div class="text-xs font-semibold uppercase text-gray-500">Providers</div>
                        <p class="mt-2 text-sm text-gray-600">Publish services and manage farmer jobs.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-5 shadow-sm">
                        <div class="text-xs font-semibold uppercase text-gray-500">Manufacturers</div>
                        <p class="mt-2 text-sm text-gray-600">Offer connected irrigation devices.</p>
                    </div>
                    <div class="rounded-2xl bg-white p-5 shadow-sm">
                        <div class="text-xs font-semibold uppercase text-gray-500">Devices</div>
                        <p class="mt-2 text-sm text-gray-600">Keep connected equipment visible across farms.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Section -->
<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900">Quick Stats</h2>
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Active Devices</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">120</p>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Service Requests</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">45</p>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Farmers Registered</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">300</p>
            </div>
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Providers Registered</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">50</p>
            </div>
        </div>
    </div>
</section>

<!-- Recent Activity Section -->
<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900">Recent Activity</h2>
        <div class="mt-6 space-y-4">
            <div class="rounded-lg bg-gray-50 p-4 shadow-sm">
                <p class="text-sm text-gray-600">Farmer John added a new device to their farm.</p>
                <p class="mt-1 text-xs text-gray-400">2 hours ago</p>
            </div>
            <div class="rounded-lg bg-gray-50 p-4 shadow-sm">
                <p class="text-sm text-gray-600">Provider Jane completed a service request for irrigation setup.</p>
                <p class="mt-1 text-xs text-gray-400">5 hours ago</p>
            </div>
            <div class="rounded-lg bg-gray-50 p-4 shadow-sm">
                <p class="text-sm text-gray-600">Manufacturer Smith updated device firmware for Model X.</p>
                <p class="mt-1 text-xs text-gray-400">1 day ago</p>
            </div>
        </div>
    </div>
</section>
</x-app-layout>
