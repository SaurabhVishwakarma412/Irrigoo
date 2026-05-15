<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Administrator Console') }}</h2>
            <p class="text-sm text-gray-500">Verify participants and connect verified farms with published IoT solutions.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-7 gap-4 mb-6">
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-blue-500"><div class="text-xs uppercase font-semibold text-gray-500">Users</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</div></div>
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-amber-500"><div class="text-xs uppercase font-semibold text-gray-500">Pending</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['unverified_users'] }}</div></div>
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-emerald-500"><div class="text-xs uppercase font-semibold text-gray-500">Devices</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['total_devices'] }}</div></div>
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-cyan-500"><div class="text-xs uppercase font-semibold text-gray-500">Services</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</div></div>
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-indigo-500"><div class="text-xs uppercase font-semibold text-gray-500">Requests</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['total_requests'] }}</div></div>
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-purple-500"><div class="text-xs uppercase font-semibold text-gray-500">Readings</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['total_readings'] }}</div></div>
                <div class="bg-white shadow-sm rounded-lg p-5 border-l-4 border-rose-500"><div class="text-xs uppercase font-semibold text-gray-500">Assignments</div><div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['assigned_devices'] }}</div></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[0.9fr_1.1fr] gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Assign Device to Farmer</h3>
                        <p class="mt-1 text-sm text-gray-500">Connect a verified farmer with a published IoT irrigation solution.</p>
                        <form method="POST" action="{{ route('admin.device-assignments.store') }}" class="mt-5 space-y-4">
                            @csrf
                            <div>
                                <label for="farmer_id" class="block text-sm font-medium text-gray-700">Farmer</label>
                                <select id="farmer_id" name="farmer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Select farmer</option>
                                    @foreach($farmers as $farmer)
                                        <option value="{{ $farmer->id }}">{{ $farmer->name }} - {{ $farmer->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="device_id" class="block text-sm font-medium text-gray-700">IoT Device</label>
                                <select id="device_id" name="device_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Select device</option>
                                    @foreach($devices as $device)
                                        <option value="{{ $device->id }}">{{ $device->name }} - {{ $device->manufacturer->organization ?? $device->manufacturer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="installation_date" class="block text-sm font-medium text-gray-700">Installation date</label>
                                <input id="installation_date" name="installation_date" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <button type="submit" class="rounded-md bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Assign Device</button>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Recent Device Assignments</h3>
                        <div class="mt-4 space-y-3">
                            @forelse($assignments as $assignment)
                                <div class="rounded-lg border border-gray-200 p-4">
                                    <div class="font-semibold text-gray-900">{{ $assignment->device->name }}</div>
                                    <div class="mt-1 text-sm text-gray-600">{{ $assignment->farmer->name }} · {{ $assignment->farmer->location }}</div>
                                    <div class="mt-1 text-xs text-gray-500">Manufacturer: {{ $assignment->device->manufacturer->organization ?? $assignment->device->manufacturer->name }}</div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No devices assigned yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Participant Verification</h3>
                            <p class="text-sm text-gray-500">Approve farmers, irrigation service providers, and IoT device manufacturers.</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-left text-gray-600">
                                    <th class="py-3 px-4 border-b">Name</th>
                                    <th class="py-3 px-4 border-b">Role</th>
                                    <th class="py-3 px-4 border-b">Location</th>
                                    <th class="py-3 px-4 border-b">Crop / Company</th>
                                    <th class="py-3 px-4 border-b">Contact</th>
                                    <th class="py-3 px-4 border-b">Status</th>
                                    <th class="py-3 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="align-top">
                                        <td class="py-3 px-4 border-b"><div class="font-semibold text-gray-900">{{ $user->name }}</div><div class="text-gray-500">{{ $user->email }}</div></td>
                                        <td class="py-3 px-4 border-b capitalize">{{ $user->role }}</td>
                                        <td class="py-3 px-4 border-b">{{ $user->location ?? '-' }}</td>
                                        <td class="py-3 px-4 border-b"><div>{{ $user->crop_type ?? '-' }}</div><div class="text-gray-500">{{ $user->organization ?? '' }}</div></td>
                                        <td class="py-3 px-4 border-b">{{ $user->phone ?? '-' }}</td>
                                        <td class="py-3 px-4 border-b">
                                            @if($user->is_verified)
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Verified</span>
                                            @else
                                                <span class="px-2 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-semibold">Pending</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 border-b">
                                            @if(!$user->is_verified)
                                                <form action="{{ route('admin.users.verify', $user) }}" method="POST">@csrf<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-2 rounded-md font-semibold">Verify</button></form>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
