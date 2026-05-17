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
                        <div class="text-xs font-semibold uppercase text-gray-500">Admins</div>
                        <p class="mt-2 text-sm text-gray-600">Verify users and assign devices safely.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
