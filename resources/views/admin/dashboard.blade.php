@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Admin Dashboard</h2>
                <p class="text-gray-500 mt-1">Platform overview and participant verification.</p>
            </div>
            
            <button x-data @click="$dispatch('open-assign-device-modal')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition-all hover:shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                Assign Device to Farmer
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

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Users</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Devices</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_devices'] }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Services</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Requests</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_requests'] }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Readings</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_readings'] }}</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 text-center">
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wider mb-1">Assigned</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['assigned_devices'] }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- User Management -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">User Management & Verification</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="p-4">User</th>
                                <th class="p-4">Role</th>
                                <th class="p-4">Location</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="p-4">
                                        @php
                                            $roleColors = [
                                                'admin' => 'bg-gray-100 text-gray-800',
                                                'farmer' => 'bg-emerald-100 text-emerald-800',
                                                'provider' => 'bg-blue-100 text-blue-800',
                                                'manufacturer' => 'bg-purple-100 text-purple-800',
                                            ];
                                            $color = $roleColors[$user->role] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-md text-xs font-semibold capitalize {{ $color }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $user->location ?? 'N/A' }}
                                    </td>
                                    <td class="p-4">
                                        @if($user->is_verified)
                                            <span class="flex items-center gap-1 text-sm text-green-600 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Verified
                                            </span>
                                        @else
                                            <span class="flex items-center gap-1 text-sm text-yellow-600 font-medium">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if(!$user->is_verified && $user->role !== 'admin')
                                            <form action="{{ route('admin.users.verify', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded text-xs font-medium transition-colors">
                                                    Verify User
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    {{ $users->links() }}
                </div>
            </div>

            <!-- Recent Assignments -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Recent Device Assignments</h3>
                </div>
                <div class="p-0">
                    @forelse($assignments as $assignment)
                        <div class="p-5 border-b border-gray-50">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-bold text-gray-900 text-sm">{{ $assignment->device->name }}</h4>
                                <span class="text-xs font-mono text-gray-500">{{ $assignment->device->serial_number }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Assigned to: <span class="font-medium text-gray-900">{{ $assignment->farmer->name }}</span>
                            </div>
                            <div class="mt-2 text-xs text-gray-400">
                                Installed: {{ $assignment->installation_date ? \Carbon\Carbon::parse($assignment->installation_date)->format('M d, Y') : 'N/A' }}
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500 text-sm">
                            No devices assigned to farmers yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Assign Device Modal -->
<div x-data="{ show: false }" @open-assign-device-modal.window="show = true" @keydown.escape.window="show = false" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="show = false"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        
        <div x-show="show" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Assign Device</h3>
                <button @click="show = false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <form action="{{ route('admin.device-assignments.store') }}" method="POST">
                @csrf
                <div class="px-6 py-5 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Farmer</label>
                        <select name="farmer_id" required class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                            <option value="">-- Choose Farmer --</option>
                            @foreach($farmers as $farmer)
                                <option value="{{ $farmer->id }}">{{ $farmer->name }} ({{ $farmer->location }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Device</label>
                        <select name="device_id" required class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                            <option value="">-- Choose Device --</option>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }} [{{ $device->serial_number }}] - by {{ $device->manufacturer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Installation Date</label>
                        <input type="date" name="installation_date" value="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                    <button type="button" @click="show = false" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium shadow-sm transition-colors">Assign Device</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
