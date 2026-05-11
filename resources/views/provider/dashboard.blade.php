<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Service Provider Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500">Publish irrigation services and manage farmer requests.</p>
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
                        <h3 class="text-lg font-bold text-gray-900">Offer an Irrigation Service</h3>
                        <form method="POST" action="{{ route('provider.services.store') }}" class="mt-4 space-y-4">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Service Name')" />
                                <x-text-input id="name" name="name" class="block mt-1 w-full" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="type" :value="__('Service Type')" />
                                <select id="type" name="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="installation">Installation</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="repair">Repair</option>
                                    <option value="consultation">Consultation</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="service_area" :value="__('Service Area')" />
                                <x-text-input id="service_area" name="service_area" class="block mt-1 w-full" value="{{ auth()->user()->location }}" required />
                                <x-input-error :messages="$errors->get('service_area')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="crop_types" :value="__('Supported Crops')" />
                                <x-text-input id="crop_types" name="crop_types" class="block mt-1 w-full" placeholder="Rice, wheat, cotton" />
                            </div>
                            <div>
                                <x-input-label for="base_price" :value="__('Base Price')" />
                                <x-text-input id="base_price" name="base_price" class="block mt-1 w-full" type="number" min="0" step="0.01" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                            </div>
                            <x-primary-button>{{ __('Publish Service') }}</x-primary-button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">Your Services</h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($services as $service)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $service->name }}</h4>
                                                <p class="mt-1 text-sm text-gray-600">{{ $service->description }}</p>
                                            </div>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold capitalize">{{ $service->type }}</span>
                                        </div>
                                        <div class="mt-3 text-xs text-gray-500">Area: {{ $service->service_area }}</div>
                                        <div class="text-xs text-gray-500">Crops: {{ $service->crop_types ?? 'All crops' }}</div>
                                        <div class="text-xs text-gray-500">Price: {{ $service->base_price ? 'Rs. '.number_format($service->base_price, 2) : 'Quote based' }}</div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No services published yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">Farmer Requests</h3>
                            <div class="mt-4 overflow-x-auto">
                                <table class="min-w-full border border-gray-200 text-sm">
                                    <thead>
                                        <tr class="bg-gray-50 text-left text-gray-600">
                                            <th class="py-3 px-4 border-b">Farmer</th>
                                            <th class="py-3 px-4 border-b">Service</th>
                                            <th class="py-3 px-4 border-b">Schedule</th>
                                            <th class="py-3 px-4 border-b">Status</th>
                                            <th class="py-3 px-4 border-b">Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($serviceRequests as $request)
                                            <tr>
                                                <td class="py-3 px-4 border-b">
                                                    <div class="font-semibold">{{ $request->farmer->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $request->farmer->location }} | {{ $request->farmer->crop_type }}</div>
                                                </td>
                                                <td class="py-3 px-4 border-b">{{ $request->service->name }}</td>
                                                <td class="py-3 px-4 border-b">{{ $request->scheduled_date ?? 'Flexible' }}</td>
                                                <td class="py-3 px-4 border-b capitalize">{{ $request->status }}</td>
                                                <td class="py-3 px-4 border-b">
                                                    <form method="POST" action="{{ route('provider.requests.update', $request) }}" class="flex items-center gap-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="status" class="text-xs border-gray-300 rounded-md">
                                                            @foreach(['pending', 'accepted', 'completed', 'rejected'] as $status)
                                                                <option value="{{ $status }}" @selected($request->status === $status)>{{ ucfirst($status) }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-md text-xs font-semibold">Save</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="py-4 px-4 text-gray-500">No farmer service requests yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
