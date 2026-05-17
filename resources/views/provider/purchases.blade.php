@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Purchase Products</h2>
            <p class="text-gray-500 mt-1">Browse manufacturer products and purchase what you need for your service work.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-xl font-bold text-gray-900">Available Products</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($devices as $device)
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

                            <form action="{{ route('provider.devices.purchase', $device) }}" method="POST" class="mt-5 flex items-center gap-3">
                                @csrf
                                <input type="number" min="1" name="quantity" value="1" class="w-24 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-sm transition-colors">
                                    Purchase
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
                    <h3 class="text-xl font-bold text-gray-900">Your Purchases</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($purchases as $purchase)
                        <div class="p-5">
                            <h4 class="font-bold text-gray-900">{{ $purchase->device->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $purchase->device->manufacturer->organization ?? $purchase->device->manufacturer->name }}</p>
                            <div class="mt-2 flex justify-between text-sm">
                                <span class="text-gray-500">Qty {{ $purchase->quantity }}</span>
                                <span class="font-bold text-emerald-600">${{ number_format($purchase->total_price, 2) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            You have not purchased any products yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
