<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Smart Irrigation Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">IoT-Based Smart Irrigation Control System</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Use the navigation to manage irrigation devices, local services, farmer requests, and participant verification.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
