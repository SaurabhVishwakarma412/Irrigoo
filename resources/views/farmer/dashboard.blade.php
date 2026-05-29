@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header & Stats -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Farmer Dashboard</h2>
                <p class="text-gray-500 mt-1">Manage your devices, track usage, and discover services.</p>
            </div>
            
            @if($weather)
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Current Weather</p>
                        <p class="text-lg font-bold text-gray-900">{{ $weather['temperature'] ?? '--' }}°C, {{ $weather['condition'] ?? 'Unknown' }}</p>
                    </div>
                </div>
            @endif
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        @if($irrigationAdvice)
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl p-6 text-white shadow-lg shadow-emerald-500/20 flex items-start gap-4">
                <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Irrigation Advice</h3>
                    <p class="text-emerald-50 mt-1">{{ $irrigationAdvice }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 transform transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Total Water Usage</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ number_format($waterUsage, 2) }} L</div>
                <div class="mt-2 text-sm text-green-600 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <span>All-time total</span>
                </div>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 transform transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Active Devices</h3>
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ $farmerDevices->count() }}</div>
                <div class="mt-2 text-sm text-gray-500">Connected to your farm</div>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 transform transition-all hover:-translate-y-1 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Pending Service Requests</h3>
                    <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ $serviceRequests->where('status', 'pending')->count() }}</div>
                <div class="mt-2 text-sm text-gray-500">Awaiting provider response</div>
            </div>
        </div>

        <div id="products" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">IoT Products</h3>
                    <p class="text-sm text-gray-500 mt-1">Buy irrigation devices published by manufacturers.</p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($availableDevices as $device)
                        <div class="border border-gray-200 rounded-2xl p-5 bg-white flex flex-col">
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $device->name }}</h4>
                                <p class="text-sm text-blue-600 font-medium">{{ $device->manufacturer->organization ?? $device->manufacturer->name }}</p>
                                <p class="text-xs text-gray-500 font-mono mt-1">{{ $device->serial_number }}</p>
                            </div>
                            <p class="text-sm text-gray-600 mt-3 line-clamp-3">{{ $device->description }}</p>
                            <div class="mt-4 flex items-center justify-between text-sm">
                                <span class="text-gray-500">{{ $device->connectivity }}</span>
                                <span class="font-bold text-emerald-600">${{ number_format($device->price, 2) }}</span>
                            </div>
                            <form action="{{ route('farmer.devices.purchase', $device) }}" method="POST" class="mt-5 flex items-center gap-3">
                                @csrf
                                <input type="number" min="1" name="quantity" value="1" class="w-24 border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
                                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium shadow-sm transition-colors">
                                    Buy Product
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="md:col-span-2 py-10 text-center text-gray-500">
                            No manufacturer products are available yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Recent Purchases</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($devicePurchases as $purchase)
                        <div class="p-5">
                            <h4 class="font-bold text-gray-900">{{ $purchase->device->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $purchase->device->manufacturer->organization ?? $purchase->device->manufacturer->name }}</p>
                            <div class="mt-2 flex justify-between text-sm">
                                <span class="text-gray-500">Qty {{ $purchase->quantity }}</span>
                                <span class="font-bold text-emerald-600">${{ number_format($purchase->total_price, 2) }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1 capitalize">Payment: {{ $purchase->payment_status }}</p>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            You have not purchased any products yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Devices Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="text-xl font-bold text-gray-900">Your Smart Devices</h3>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">{{ $farmerDevices->count() }} Devices</span>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($farmerDevices as $fd)
                    <div class="border border-gray-200 rounded-2xl p-5 hover:border-emerald-300 transition-colors bg-white relative" x-data="{ 
                        isOn: {{ $fd->irrigation_on ? 'true' : 'false' }},
                        loading: false,
                        toggle() {
                            this.loading = true;
                            fetch('{{ route('farmer.devices.toggle', $fd) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.isOn = data.irrigation_on;
                                this.loading = false;
                            });
                        }
                    }">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $fd->device->name }}</h4>
                                <p class="text-xs text-gray-500">ID: {{ $fd->device->serial_number }}</p>
                            </div>
                            <!-- Status Indicator -->
                            <div class="flex items-center gap-1.5" :class="isOn ? 'text-emerald-500' : 'text-gray-400'">
                                <span class="relative flex h-2.5 w-2.5">
                                  <span x-show="isOn" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2.5 w-2.5" :class="isOn ? 'bg-emerald-500' : 'bg-gray-400'"></span>
                                </span>
                                <span class="text-xs font-medium uppercase tracking-wider" x-text="isOn ? 'Active' : 'Offline'"></span>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-xl p-3 mb-4 text-sm text-gray-600 grid grid-cols-2 gap-2">
                            <div>
                                <span class="block text-xs text-gray-400">Last Flow Rate</span>
                                <span class="font-medium text-gray-900">{{ $fd->sensorData->first()?->water_flow ?? 0 }} L/min</span>
                            </div>
                            <div>
                                <span class="block text-xs text-gray-400">Soil Moisture</span>
                                <span class="font-medium text-gray-900">{{ $fd->sensorData->first()?->moisture_level ?? 0 }}%</span>
                            </div>
                        </div>

                        <!-- Toggle Button -->
                        <button @click="toggle()" :disabled="loading" 
                            class="w-full py-2.5 rounded-xl font-medium transition-all duration-200 flex justify-center items-center gap-2"
                            :class="isOn ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100'">
                            <svg x-show="loading" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <svg x-show="!loading && !isOn" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <svg x-show="!loading && isOn" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path></svg>
                            <span x-text="isOn ? 'Stop Irrigation' : 'Start Irrigation'"></span>
                        </button>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center text-gray-500">
                        <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <p>No devices purchased yet. Buy a product above to add it to your farm.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Local Services -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Local Providers for Your Crop</h3>
                    <p class="text-sm text-gray-500 mt-1">Recommended services near {{ auth()->user()->location }}</p>
                </div>
                <div class="p-0">
                    @forelse($services as $service)
                        <div class="p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $service->name }}</h4>
                                    <p class="text-sm text-emerald-600 font-medium">{{ $service->provider->organization ?? $service->provider->name }}</p>
                                    <p class="text-gray-600 mt-2 text-sm line-clamp-2">{{ $service->description }}</p>
                                    
                                    <div class="mt-3 flex items-center gap-4 text-xs font-medium text-gray-500">
                                        <div class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-md">
                                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            ${{ number_format($service->base_price, 2) }}
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $service->provider->providerProfile?->service_area ?? 'Local' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="shrink-0" x-data="{ open: false }">
                                    <button @click="open = true" class="px-4 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 rounded-lg font-medium text-sm transition-colors">
                                        Request
                                    </button>
                                    
                                    <!-- Request Modal -->
                                    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm" style="display: none;">
                                        <div @click.away="open = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
                                            <div class="p-6 border-b border-gray-100">
                                                <h3 class="text-lg font-bold text-gray-900">Request Service</h3>
                                                <p class="text-sm text-gray-500 mt-1">{{ $service->name }}</p>
                                            </div>
                                            <form action="{{ route('farmer.services.request', $service) }}" method="POST" class="p-6">
                                                @csrf
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Date</label>
                                                    <input type="date" name="scheduled_date" class="w-full border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 shadow-sm" required>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-6">
                                                    <button type="button" @click="open = false" class="px-4 py-2 text-gray-500 hover:text-gray-700 font-medium">Cancel</button>
                                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium shadow-sm">Submit Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            No local services found for your crop type yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Requests -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Your Service Requests</h3>
                </div>
                <div class="p-0">
                    @forelse($serviceRequests as $req)
                        <div class="p-5 border-b border-gray-50 flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $req->service->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1">Provider: {{ $req->service->provider->name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">Scheduled: {{ $req->scheduled_date ? \Carbon\Carbon::parse($req->scheduled_date)->format('M d, Y') : 'N/A' }}</p>
                                <p class="text-xs text-gray-400 mt-0.5 capitalize">Payment: {{ $req->payment_status ?? 'unpaid' }}</p>
                            </div>
                            <div>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'accepted' => 'bg-blue-100 text-blue-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                    ];
                                    $color = $statusColors[$req->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold capitalize {{ $color }}">
                                    {{ $req->status }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            You haven't requested any services yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
