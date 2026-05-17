@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Manufacturer Dashboard</h2>
                <p class="text-gray-500 mt-1">Register new IoT devices and track your inventory on the platform.</p>
            </div>
            
            <button x-data @click="$dispatch('open-add-device-modal')" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all hover:shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Register Device
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div id="overview" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Total Registered Devices</h3>
                    <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ $devices->count() }}</div>
            </div>

            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-6 shadow-lg shadow-gray-900/20 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-400 font-medium">Total Earnings</h3>
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold">${{ number_format($totalEarnings, 2) }}</div>
            </div>
        </div>

        <div id="products" class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Your Device Catalog</h3>
            </div>
            
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($devices as $device)
                    <div class="border border-gray-200 rounded-2xl p-5 bg-white flex flex-col h-full hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ $device->name }}</h4>
                                <p class="text-xs text-gray-500 font-mono mt-1 text-purple-600">{{ $device->serial_number }}</p>
                            </div>
                        </div>
                        
                        <p class="text-sm text-gray-600 line-clamp-2 mb-4 flex-1">{{ $device->description }}</p>
                        
                        <div class="space-y-2 mb-4 text-sm">
                            <div class="flex justify-between border-b border-dashed border-gray-200 pb-1">
                                <span class="text-gray-500">Power:</span>
                                <span class="font-medium text-gray-900 capitalize">{{ $device->power_source }}</span>
                            </div>
                            <div class="flex justify-between border-b border-dashed border-gray-200 pb-1">
                                <span class="text-gray-500">Connectivity:</span>
                                <span class="font-medium text-gray-900 capitalize">{{ $device->connectivity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Price:</span>
                                <span class="font-bold text-emerald-600">${{ number_format($device->price, 2) }}</span>
                            </div>
                        </div>

                        @if($device->features && count($device->features) > 0)
                            <div class="flex flex-wrap gap-1 mt-auto pt-4 border-t border-gray-100">
                                @foreach(array_slice($device->features, 0, 3) as $feature)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md">{{ $feature }}</span>
                                @endforeach
                                @if(count($device->features) > 3)
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md">+{{ count($device->features) - 3 }}</span>
                                @endif
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <p class="mb-2">Your catalog is empty.</p>
                        <p class="text-sm">Register your first IoT device to make it available to farmers.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-xl font-bold text-gray-900">Recent Product Sales</h3>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($sales->take(6) as $sale)
                    <div class="p-5 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $sale->device->name }}</h4>
                            <p class="text-sm text-gray-500">Purchased by {{ $sale->provider->organization ?? $sale->provider->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-emerald-600">${{ number_format($sale->total_price, 2) }}</p>
                            <p class="text-xs text-gray-500">Qty {{ $sale->quantity }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        No product sales yet.
                    </div>
                @endforelse
            </div>
        </div>

        <div id="available-services" class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-xl font-bold text-gray-900">Available Services</h3>
                <p class="text-sm text-gray-500 mt-1">Services currently published by providers on the platform.</p>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($availableServices as $service)
                    <div class="border border-gray-200 rounded-2xl p-5 bg-white">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $service->name }}</h4>
                                <p class="text-sm text-purple-600 font-medium">{{ $service->provider->organization ?? $service->provider->name }}</p>
                            </div>
                            <span class="px-2 py-1 bg-purple-50 text-purple-700 rounded-md text-xs font-medium uppercase">{{ $service->type }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-3 line-clamp-3">{{ $service->description }}</p>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="text-gray-500">{{ $service->service_area }}</span>
                            <span class="font-bold text-emerald-600">${{ number_format($service->base_price, 2) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center text-gray-500">
                        No provider services are available yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Add Device Modal -->
<div x-data="{ show: false }" @open-add-device-modal.window="show = true" @keydown.escape.window="show = false" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="show = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div x-show="show" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl w-full">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Register New Device</h3>
                <button @click="show = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('manufacturer.devices.store') }}" method="POST">
                @csrf
                <div class="px-6 py-5 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Device Name</label>
                            <input type="text" name="name" required class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="e.g. Smart Valve V2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price ($)</label>
                            <input type="number" step="0.01" name="price" required class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="299.99">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Power Source</label>
                            <input type="text" name="power_source" required class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="e.g. Solar, Battery, AC">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Connectivity</label>
                            <input type="text" name="connectivity" required class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="e.g. Wi-Fi, LoRaWAN, Cellular">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Coverage Area</label>
                            <input type="text" name="coverage_area" class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="e.g. 5 Acres">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Target Crops</label>
                            <input type="text" name="target_crops" class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="e.g. Tomatoes, Corn">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Features (Comma separated)</label>
                        <input type="text" name="features" class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="e.g. Auto-shutoff, Soil moisture tracking, Weather integration">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3" required class="w-full border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 shadow-sm" placeholder="Detailed device description..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" @click="show = false" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium shadow-sm transition-colors">Register Device</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
