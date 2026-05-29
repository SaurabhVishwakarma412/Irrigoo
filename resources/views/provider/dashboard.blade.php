@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Provider Dashboard</h2>
                <p class="text-gray-500 mt-1">Manage installation, repair, maintenance, and sensor calibration requests.</p>
            </div>
            
            <button x-data @click="$dispatch('open-add-service-modal')" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all hover:shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add New Service
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

        <div id="overview" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Stat Cards -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Pending Requests</h3>
                    <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ $pendingRequests }}</div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Completed Jobs</h3>
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ $completedJobs }}</div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 font-medium">Total Services</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalServices }}</div>
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

        <div id="services" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Incoming Requests -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Service Requests</h3>
                </div>
                <div class="p-0 flex-1 overflow-y-auto max-h-[600px]">
                    @forelse($serviceRequests->whereIn('status', ['pending', 'accepted']) as $req)
                        <div class="p-6 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start gap-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h4 class="font-bold text-gray-900">{{ $req->service->name }}</h4>
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $req->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $req->status }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">Farmer: <span class="font-medium text-gray-900">{{ $req->farmer->name }}</span></p>
                                    <p class="text-sm text-gray-600">Location: {{ $req->farmer->location }}</p>
                                    <p class="text-sm text-gray-600">Scheduled: {{ $req->scheduled_date ? \Carbon\Carbon::parse($req->scheduled_date)->format('M d, Y') : 'Flexible' }}</p>
                                </div>
                                
                                <div x-data="{ status: '{{ $req->status }}' }">
                                    <form action="{{ route('provider.requests.update', $req) }}" method="POST" class="flex flex-col gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm pr-8" onchange="this.form.submit()">
                                            <option value="pending" @selected($req->status === 'pending')>Pending</option>
                                            <option value="accepted" @selected($req->status === 'accepted')>Accept Request</option>
                                            <option value="completed" @selected($req->status === 'completed')>Mark Completed</option>
                                            <option value="rejected" @selected($req->status === 'rejected')>Reject</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500 flex flex-col items-center justify-center h-full">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p>No active service requests right now.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Published Services -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Your Published Services</h3>
                </div>
                <div class="p-0 max-h-[600px] overflow-y-auto">
                    @forelse($services as $service)
                        <div class="p-6 border-b border-gray-100 hover:bg-gray-50 transition-colors flex justify-between items-center group">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $service->name }}</h4>
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-md text-xs font-medium uppercase tracking-wider">{{ $service->type }}</span>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-1 mb-2">{{ $service->description }}</p>
                                <div class="flex items-center gap-3 text-xs text-gray-500 font-medium">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        ${{ number_format($service->base_price, 2) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $service->service_area }}
                                    </span>
                                </div>
                            </div>
                            <form action="{{ route('provider.services.destroy', $service) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            You haven't published any services yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Add Service Modal -->
<div x-data="{ show: false }" @open-add-service-modal.window="show = true" @keydown.escape.window="show = false" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="show = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div x-show="show" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Add New Service</h3>
                <button @click="show = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('provider.services.store') }}" method="POST">
                @csrf
                <div class="px-6 py-5 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="e.g. Drip Irrigation Installation">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Service Type</label>
                            <select name="type" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <option value="installation">Installation</option>
                                <option value="repair">Repair</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="sensor_calibration">Sensor calibration</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Base Price ($)</label>
                            <input type="number" step="0.01" name="base_price" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="100.00">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Service Area / Location</label>
                        <input type="text" name="service_area" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" value="{{ auth()->user()->providerProfile?->service_area ?? auth()->user()->location }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3" required class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Describe what the service includes..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
                    <button type="button" @click="show = false" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm transition-colors">Publish Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
