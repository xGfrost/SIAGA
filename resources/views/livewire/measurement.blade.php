<div wire:poll.30s="refreshData" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-6">
    <div class="max-w-7xl mx-auto space-y-10">
        <!-- Header Section -->
        <div class="text-center relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl opacity-10 blur-3xl">
            </div>
            <div class="relative z-10 py-8">
                <h1
                    class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-4 tracking-tight">
                    SIAGA
                </h1>
                <p class="text-gray-600 text-lg font-medium">Grafik Real-time Ketinggian Air & Curah Hujan</p>
                <div class="mt-4 flex justify-center">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full shadow-lg border border-white/20">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></div>
                        <span class="text-sm font-medium text-gray-700">Insert Data: {{ $insertCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Water Level Chart -->
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-2xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                </div>
                <div
                    class="relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div
                                class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl w-12 h-12 flex items-center justify-center mr-4 shadow-lg">
                                <span class="text-lg">💧</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Ketinggian Air</h3>
                                <p class="text-gray-500 text-sm">Monitoring Level Air</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-blue-600">{{ $this->stats['maxWaterLevel'] }}</div>
                            <div class="text-xs text-gray-500">Max (cm)</div>
                        </div>
                    </div>
                    <div class="relative">
                        <canvas id="waterChart" height="300" class="rounded-lg"></canvas>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-blue-50/20 to-transparent rounded-lg pointer-events-none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rainfall Chart -->
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-red-400 to-pink-400 rounded-2xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                </div>
                <div
                    class="relative bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div
                                class="bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl w-12 h-12 flex items-center justify-center mr-4 shadow-lg">
                                <span class="text-lg">🌧️</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Curah Hujan</h3>
                                <p class="text-gray-500 text-sm">Monitoring Rainfall</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-red-600">{{ $this->stats['maxRainfall'] }}</div>
                            <div class="text-xs text-gray-500">Max (mm)</div>
                        </div>
                    </div>
                    <div class="relative">
                        <canvas id="rainChart" height="300" class="rounded-lg"></canvas>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-red-50/20 to-transparent rounded-lg pointer-events-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Average Water Level -->
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                </div>
                <div
                    class="relative bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white text-lg">📊</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2">{{ $this->stats['avgWaterLevel'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Rata-rata Ketinggian Air</div>
                    <div class="text-xs text-gray-500 mt-1">(cm)</div>
                </div>
            </div>

            <!-- Max Water Level -->
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                </div>
                <div
                    class="relative bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white text-lg">🔺</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2">{{ $this->stats['maxWaterLevel'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Ketinggian Air Maksimum</div>
                    <div class="text-xs text-gray-500 mt-1">(cm)</div>
                </div>
            </div>

            <!-- Total Rainfall -->
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-purple-400 to-violet-400 rounded-xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                </div>
                <div
                    class="relative bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-purple-500 to-violet-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white text-lg">💧</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2">{{ $this->stats['totalRainfall'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Total Curah Hujan</div>
                    <div class="text-xs text-gray-500 mt-1">(mm)</div>
                </div>
            </div>

            <!-- Max Rainfall -->
            <div class="group relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-400 rounded-xl blur opacity-20 group-hover:opacity-30 transition-opacity duration-300">
                </div>
                <div
                    class="relative bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <span class="text-white text-lg">⚡</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2">{{ $this->stats['maxRainfall'] }}</div>
                    <div class="text-sm text-gray-600 font-medium">Curah Hujan Maksimum</div>
                    <div class="text-xs text-gray-500 mt-1">(mm)</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center py-8">
            <div
                class="inline-flex items-center px-6 py-3 bg-white/60 backdrop-blur-sm rounded-full shadow-lg border border-white/20">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-3"></div>
                <span class="text-gray-700 font-medium">Data diperbarui secara real-time</span>
                <span class="mx-2 text-gray-400">•</span>
                <span class="text-gray-600">Sistem Monitoring Hidrologi</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let waterChart = null;
        let rainChart = null;

        function renderCharts(measurements) {
            const lastMeasurements = measurements.slice(-7);
            const labels = lastMeasurements.map(m => {
                const date = new Date(m.created_at);
                return date.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            });

            const waterLevels = lastMeasurements.map(m => m.water_level_cm);
            const rainfalls = lastMeasurements.map(m => m.rainfall_mm);

            const waterCtx = document.getElementById('waterChart').getContext('2d');
            const rainCtx = document.getElementById('rainChart').getContext('2d');

            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#374151',
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x',
                        },
                        zoom: {
                            pinch: {
                                enabled: true
                            },
                            wheel: {
                                enabled: true
                            },
                            mode: 'x',
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        },
                        grid: {
                            color: 'rgba(229,231,235,0.5)',
                            drawBorder: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#6b7280',
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        },
                        grid: {
                            color: 'rgba(229,231,235,0.5)',
                            drawBorder: false
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 4,
                        hoverRadius: 8,
                        borderWidth: 3,
                        hoverBorderWidth: 4
                    },
                    line: {
                        borderWidth: 3,
                        tension: 0.4
                    }
                }
            };

            if (waterChart) waterChart.destroy();
            waterChart = new Chart(waterCtx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Ketinggian Air (cm)',
                        data: waterLevels,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.1)',
                        fill: true,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointHoverBackgroundColor: '#2563eb',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 4
                    }]
                },
                options: commonOptions
            });

            if (rainChart) rainChart.destroy();
            rainChart = new Chart(rainCtx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Curah Hujan (mm)',
                        data: rainfalls,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239,68,68,0.1)',
                        fill: true,
                        pointBackgroundColor: '#ef4444',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointHoverBackgroundColor: '#dc2626',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 4
                    }]
                },
                options: commonOptions
            });
        }

        Livewire.on('dataUpdated', (data) => {
            renderCharts(data);
        });

        document.addEventListener('DOMContentLoaded', () => {
            Livewire.emit('refreshData');
        });
    </script>
@endpush
