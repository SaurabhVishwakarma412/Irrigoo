<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Farmer Irrigation Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500">Track devices, water usage, crop conditions, and local service options.</p>
        </div>
    </x-slot>

    <div class="py-10" x-data="irrigationDashboard()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-emerald-500">
                    <div class="text-xs uppercase font-semibold text-gray-500">Connected Devices</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $farmerDevices->count() }}</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-blue-500">
                    <div class="text-xs uppercase font-semibold text-gray-500">Water Usage</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ number_format($waterUsage, 1) }} L/min</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-amber-500">
                    <div class="text-xs uppercase font-semibold text-gray-500">Crop Type</div>
                    <div class="mt-2 text-xl font-bold text-gray-900">{{ auth()->user()->crop_type ?? 'Not set' }}</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-cyan-500">
                    <div class="text-xs uppercase font-semibold text-gray-500">Location</div>
                    <div class="mt-2 text-xl font-bold text-gray-900">{{ auth()->user()->location ?? 'Not set' }}</div>
                </div>
            </div>

            <div class="mb-6 overflow-hidden rounded-2xl bg-slate-900 text-white shadow-sm">
                <div class="grid gap-6 p-6 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wide text-emerald-300">Live Weather API</p>
                        @if($weather)
                            <h3 class="mt-2 text-2xl font-bold">{{ $weather['place']['name'] }}, {{ $weather['place']['country'] ?? '' }}</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-300">{{ $irrigationAdvice }}</p>
                        @else
                            <h3 class="mt-2 text-2xl font-bold">Weather unavailable</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-300">Add a valid location to your profile to show live local irrigation context.</p>
                        @endif
                    </div>

                    @if($weather)
                        <div class="grid gap-3 sm:grid-cols-4">
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs uppercase text-slate-300">Temperature</p>
                                <p class="mt-2 text-2xl font-bold">{{ $weather['current']['temperature_2m'] ?? '--' }}°C</p>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs uppercase text-slate-300">Rain today</p>
                                <p class="mt-2 text-2xl font-bold">{{ $weather['daily']['precipitation_sum'][0] ?? '--' }} mm</p>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs uppercase text-slate-300">Rain chance</p>
                                <p class="mt-2 text-2xl font-bold">{{ $weather['daily']['precipitation_probability_max'][0] ?? '--' }}%</p>
                            </div>
                            <div class="rounded-2xl bg-white/10 p-4">
                                <p class="text-xs uppercase text-slate-300">Surface soil</p>
                                <p class="mt-2 text-2xl font-bold">{{ isset($weather['current']['soil_moisture_0_to_1cm']) ? number_format($weather['current']['soil_moisture_0_to_1cm'], 2) : '--' }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($farmerDevices->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                    <h3 class="font-semibold text-gray-900">No IoT devices connected yet</h3>
                    <p class="mt-1 text-sm text-gray-500">After an administrator or manufacturer assigns a device, real-time irrigation controls will appear here.</p>
                </div>
            @else
                @foreach($farmerDevices as $fd)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 border-b pb-4 mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $fd->device->name }}</h3>
                                <p class="text-sm text-gray-500">
                                    {{ $fd->device->connectivity ?? 'IoT' }} device by {{ $fd->device->manufacturer->organization ?? $fd->device->manufacturer->name ?? 'Manufacturer' }}
                                </p>
                                <p class="text-sm mt-1">
                                    Status:
                                    <span class="capitalize font-semibold {{ $fd->status === 'active' ? 'text-green-600' : 'text-gray-600' }}">{{ $fd->status }}</span>
                                </p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <button @click="simulateData({{ $fd->id }})" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold">
                                    Simulate IoT Reading
                                </button>
                                <button @click="toggleIrrigation({{ $fd->id }})"
                                        :class="irrigationStatus[{{ $fd->id }}] ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'"
                                        class="text-white px-4 py-2 rounded-md text-sm font-semibold">
                                    <span x-text="irrigationStatus[{{ $fd->id }}] ? 'Turn Off Irrigation' : 'Turn On Irrigation'"></span>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-blue-50 rounded-lg p-5 border border-blue-100">
                                <p class="text-blue-700 text-xs font-semibold uppercase">Soil Moisture</p>
                                <p class="mt-2 text-3xl font-bold text-blue-950"><span x-text="latestData[{{ $fd->id }}]?.moisture_level ?? '--'"></span>%</p>
                                <p class="mt-2 text-sm font-semibold" :class="getMoistureColor(latestData[{{ $fd->id }}]?.moisture_level)" x-text="getMoistureLabel(latestData[{{ $fd->id }}]?.moisture_level)"></p>
                            </div>
                            <div class="bg-orange-50 rounded-lg p-5 border border-orange-100">
                                <p class="text-orange-700 text-xs font-semibold uppercase">Temperature</p>
                                <p class="mt-2 text-3xl font-bold text-orange-950"><span x-text="latestData[{{ $fd->id }}]?.temperature ?? '--'"></span> C</p>
                                <p class="mt-2 text-sm text-gray-600">Sensor field temperature</p>
                            </div>
                            <div class="bg-teal-50 rounded-lg p-5 border border-teal-100">
                                <p class="text-teal-700 text-xs font-semibold uppercase">Water Flow</p>
                                <p class="mt-2 text-3xl font-bold text-teal-950"><span x-text="latestData[{{ $fd->id }}]?.water_flow ?? '--'"></span> L/min</p>
                                <p class="mt-2 text-sm text-gray-600">Current irrigation flow</p>
                            </div>
                        </div>

                        <div class="border rounded-lg p-4 bg-gray-50">
                            <canvas id="chart-{{ $fd->id }}" height="100"></canvas>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Local Irrigation Services</h3>
                        <p class="text-sm text-gray-500 mb-4">Matched by your location and crop type where possible.</p>

                        <div class="space-y-4">
                            @forelse($services as $service)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $service->name }}</h4>
                                            <p class="mt-1 text-sm text-gray-600">{{ $service->description }}</p>
                                            <div class="mt-2 text-xs text-gray-500">
                                                {{ ucfirst($service->type) }} | {{ $service->service_area ?? $service->provider->location }} | Crops: {{ $service->crop_types ?? 'All crops' }}
                                            </div>
                                            <div class="mt-1 text-xs text-gray-500">Provider: {{ $service->provider->organization ?? $service->provider->name }}</div>
                                        </div>
                                        <form method="POST" action="{{ route('farmer.services.request', $service) }}" class="flex flex-col gap-2 min-w-48">
                                            @csrf
                                            <input type="datetime-local" name="scheduled_date" class="text-sm border-gray-300 rounded-md">
                                            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md font-semibold" type="submit">
                                                Request Service
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No matching service providers are available yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900">Recent Requests</h3>
                        <div class="mt-4 space-y-3">
                            @forelse($serviceRequests as $request)
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <div class="font-semibold text-sm text-gray-900">{{ $request->service->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->service->provider->organization ?? $request->service->provider->name }}</div>
                                    <div class="mt-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 capitalize">{{ $request->status }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No service requests yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.addEventListener('alpine:init', () => {
            Alpine.data('irrigationDashboard', () => ({
                irrigationStatus: {
                    @foreach($farmerDevices as $fd)
                        {{ $fd->id }}: {{ $fd->irrigation_on ? 'true' : 'false' }},
                    @endforeach
                },
                latestData: {
                    @foreach($farmerDevices as $fd)
                        {{ $fd->id }}: @json($fd->sensorData->first()),
                    @endforeach
                },
                charts: {},

                init() {
                    @foreach($farmerDevices as $fd)
                        this.initChart({{ $fd->id }});
                    @endforeach
                },

                initChart(deviceId) {
                    axios.get(`/farmer/api/sensors/${deviceId}`).then((response) => {
                        const data = response.data.reverse();
                        const canvas = document.getElementById(`chart-${deviceId}`);

                        if (!canvas || typeof Chart === 'undefined') {
                            return;
                        }

                        this.charts[deviceId] = new Chart(canvas.getContext('2d'), {
                            type: 'line',
                            data: {
                                labels: data.map((item) => new Date(item.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })),
                                datasets: [{
                                    label: 'Moisture (%)',
                                    data: data.map((item) => item.moisture_level),
                                    borderColor: 'rgb(37, 99, 235)',
                                    backgroundColor: 'rgba(37, 99, 235, 0.12)',
                                    tension: 0.35,
                                    fill: true
                                }, {
                                    label: 'Temperature (C)',
                                    data: data.map((item) => item.temperature),
                                    borderColor: 'rgb(234, 88, 12)',
                                    tension: 0.35
                                }, {
                                    label: 'Water Flow (L/min)',
                                    data: data.map((item) => item.water_flow),
                                    borderColor: 'rgb(13, 148, 136)',
                                    tension: 0.35
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: { y: { beginAtZero: true } }
                            }
                        });
                    });
                },

                updateChart(deviceId, newData) {
                    const chart = this.charts[deviceId];

                    if (!chart) {
                        return;
                    }

                    chart.data.labels.push(new Date(newData.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }));
                    chart.data.datasets[0].data.push(newData.moisture_level);
                    chart.data.datasets[1].data.push(newData.temperature);
                    chart.data.datasets[2].data.push(newData.water_flow);

                    if (chart.data.labels.length > 24) {
                        chart.data.labels.shift();
                        chart.data.datasets.forEach((dataset) => dataset.data.shift());
                    }

                    chart.update();
                },

                toggleIrrigation(deviceId) {
                    axios.post(`/farmer/devices/${deviceId}/toggle-irrigation`).then((response) => {
                        this.irrigationStatus[deviceId] = response.data.irrigation_on;
                    });
                },

                simulateData(deviceId) {
                    axios.post(`/farmer/api/sensors/${deviceId}/simulate`).then((response) => {
                        this.latestData[deviceId] = response.data.data;
                        this.irrigationStatus[deviceId] = response.data.irrigation_on;
                        this.updateChart(deviceId, response.data.data);
                    });
                },

                getMoistureLabel(level) {
                    if (level === null || level === undefined) return 'Waiting for sensor data';
                    if (level < 30) return 'Dry soil - irrigation recommended';
                    if (level > 70) return 'High moisture - irrigation can pause';
                    return 'Moisture is optimal';
                },

                getMoistureColor(level) {
                    if (level === null || level === undefined) return 'text-gray-500';
                    if (level < 30) return 'text-red-600';
                    if (level > 70) return 'text-blue-600';
                    return 'text-green-600';
                }
            }));
        });
    </script>
</x-app-layout>

