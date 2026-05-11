<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verification Pending') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="text-sm font-semibold uppercase text-amber-600">Admin approval required</div>
                    <h3 class="mt-2 text-2xl font-bold text-gray-900">Your participant account is waiting for verification.</h3>
                    <p class="mt-3 text-gray-600">
                        Farmers, irrigation service providers, and device manufacturers must be verified before accessing platform tools.
                        Please contact the administrator if this takes longer than expected.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
