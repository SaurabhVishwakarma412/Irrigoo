<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Device Manufacturer Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500">Offer IoT irrigation solutions for smart farms.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Add IoT Device Solution</h3>
                        <form method="POST" action="{{ route('manufacturer.devices.store') }}" class="mt-4 space-y-4">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Device Name')" />
                                <x-text-input id="name" name="name" class="block mt-1 w-full" required />
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="connectivity" :value="__('Connectivity')" />
                                    <x-text-input id="connectivity" name="connectivity" class="block mt-1 w-full" placeholder="Wi-Fi, GSM, LoRa" required />
                                </div>
                                <div>
                                    <x-input-label for="power_source" :value="__('Power Source')" />
                                    <x-text-input id="power_source" name="power_source" class="block mt-1 w-full" placeholder="Solar, battery" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="coverage_area" :value="__('Coverage Area')" />
                                    <x-text-input id="coverage_area" name="coverage_area" class="block mt-1 w-full" placeholder="Up to 5 acres" />
                                </div>
                                <div>
                                    <x-input-label for="target_crops" :value="__('Target Crops')" />
                                    <x-text-input id="target_crops" name="target_crops" class="block mt-1 w-full" placeholder="Rice, sugarcane" />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" class="block mt-1 w-full" type="number" min="0" step="0.01" />
                            </div>
                            <div>
                                <x-input-label for="features" :value="__('Features')" />
                                <x-text-input id="features" name="features" class="block mt-1 w-full" placeholder="Soil sensor, water valve, flow meter" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                            </div>
                            <x-primary-button>{{ __('Add Device') }}</x-primary-button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Published IoT Solutions</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($devices as $device)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-semibold text-gray-900">{{ $device->name }}</h4>
                                    <p class="mt-1 text-sm text-gray-600">{{ $device->description }}</p>
                                    <dl class="mt-3 text-xs text-gray-500 space-y-1">
                                        <div>Connectivity: {{ $device->connectivity }}</div>
                                        <div>Power: {{ $device->power_source }}</div>
                                        <div>Coverage: {{ $device->coverage_area ?? 'Not specified' }}</div>
                                        <div>Crops: {{ $device->target_crops ?? 'All crops' }}</div>
                                        <div>Price: {{ $device->price ? 'Rs. '.number_format($device->price, 2) : 'Quote based' }}</div>
                                    </dl>
                                    @if($device->features)
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach($device->features as $feature)
                                                <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs">{{ $feature }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No device solutions published yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
