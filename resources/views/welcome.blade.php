<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Ketinggian Air & Curah Hujan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #fafafa;
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInDown 1s ease-out;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .header p {
            font-size: 1.1rem;
            color: #666;
            font-weight: 400;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        @media (min-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .chart-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
            animation: fadeInUp 0.6s ease-out;
            position: relative;
        }

        .chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #e5e7eb;
            border-radius: 12px 12px 0 0;
        }

        .chart-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .chart-container:nth-child(1) {
            animation-delay: 0.2s;
        }

        .chart-container:nth-child(2) {
            animation-delay: 0.4s;
        }

        .chart-container:nth-child(1)::before {
            background: #3b82f6;
        }

        .chart-container:nth-child(2)::before {
            background: #ef4444;
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .water-icon {
            background: #3b82f6;
            color: white;
        }

        .rain-icon {
            background: #ef4444;
            color: white;
        }

        .chart-wrapper {
            position: relative;
            height: 400px;
            margin-top: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
            color: #666;
            font-size: 1rem;
        }

        .spinner {
            width: 32px;
            height: 32px;
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 12px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            padding: 20px;
            color: #888;
            font-size: 0.85rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }

            .header p {
                font-size: 1rem;
            }

            .chart-container {
                padding: 20px;
            }

            .chart-title {
                font-size: 1.5rem;
            }

            .chart-wrapper {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>SIAGA</h1>
            <p>Grafik Real-time Ketinggian Air & Curah Hujan</p>
        </div>

        <div class="charts-grid">
            <div class="chart-container">
                <div class="chart-title">
                    <div class="chart-icon water-icon">💧</div>
                    Ketinggian Air
                </div>
                <div class="chart-wrapper">
                    <div class="loading" id="waterLoading">
                        <div class="spinner"></div>
                        Memuat data...
                    </div>
                    <canvas id="waterLevelChart" style="display: none;"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-title">
                    <div class="chart-icon rain-icon">🌧️</div>
                    Curah Hujan
                </div>
                <div class="chart-wrapper">
                    <div class="loading" id="rainLoading">
                        <div class="spinner"></div>
                        Memuat data...
                    </div>
                    <canvas id="rainfallChart" style="display: none;"></canvas>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value" id="avgWaterLevel">-</div>
                <div class="stat-label">Rata-rata Ketinggian Air (cm)</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="maxWaterLevel">-</div>
                <div class="stat-label">Ketinggian Air Maksimum (cm)</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="totalRainfall">-</div>
                <div class="stat-label">Total Curah Hujan (mm)</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="maxRainfall">-</div>
                <div class="stat-label">Curah Hujan Maksimum (mm)</div>
            </div>
        </div>

        <div class="footer">
            <p>Data diperbarui secara real-time • Sistem Monitoring Hidrologi</p>
        </div>
    </div>

    <script>
        // Sample data - replace with your actual data
        const measurements = [{
                created_at: '2024-01-01 08:00:00',
                water_level_cm: 15.5,
                rainfall_mm: 2.3
            },
            {
                created_at: '2024-01-01 09:00:00',
                water_level_cm: 16.2,
                rainfall_mm: 1.8
            },
            {
                created_at: '2024-01-01 10:00:00',
                water_level_cm: 18.7,
                rainfall_mm: 4.2
            },
            {
                created_at: '2024-01-01 11:00:00',
                water_level_cm: 22.1,
                rainfall_mm: 6.5
            },
            {
                created_at: '2024-01-01 12:00:00',
                water_level_cm: 25.4,
                rainfall_mm: 3.1
            },
            {
                created_at: '2024-01-01 13:00:00',
                water_level_cm: 23.8,
                rainfall_mm: 2.7
            },
            {
                created_at: '2024-01-01 14:00:00',
                water_level_cm: 21.2,
                rainfall_mm: 1.9
            },
            {
                created_at: '2024-01-01 15:00:00',
                water_level_cm: 19.6,
                rainfall_mm: 0.8
            }
        ];

        // Process data
        const labels = measurements.map(m => {
            const date = new Date(m.created_at);
            return date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        });
        const waterLevels = measurements.map(m => m.water_level_cm);
        const rainfalls = measurements.map(m => m.rainfall_mm);

        // Calculate statistics
        const avgWaterLevel = (waterLevels.reduce((a, b) => a + b, 0) / waterLevels.length).toFixed(1);
        const maxWaterLevel = Math.max(...waterLevels).toFixed(1);
        const totalRainfall = rainfalls.reduce((a, b) => a + b, 0).toFixed(1);
        const maxRainfall = Math.max(...rainfalls).toFixed(1);

        // Update statistics
        document.getElementById('avgWaterLevel').textContent = avgWaterLevel;
        document.getElementById('maxWaterLevel').textContent = maxWaterLevel;
        document.getElementById('totalRainfall').textContent = totalRainfall;
        document.getElementById('maxRainfall').textContent = maxRainfall;

        // Chart configuration
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        color: '#374151'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#374151',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    cornerRadius: 8,
                    padding: 12,
                    displayColors: true,
                    usePointStyle: true,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(229, 231, 235, 0.8)',
                        drawBorder: false,
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(229, 231, 235, 0.8)',
                        drawBorder: false,
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    }
                }
            },
            elements: {
                point: {
                    radius: 3,
                    hoverRadius: 6,
                    borderWidth: 2,
                },
                line: {
                    tension: 0.3,
                    borderWidth: 2,
                }
            }
        };

        // Simulate loading delay
        setTimeout(() => {
            // Hide loading indicators
            document.getElementById('waterLoading').style.display = 'none';
            document.getElementById('rainLoading').style.display = 'none';

            // Show charts
            document.getElementById('waterLevelChart').style.display = 'block';
            document.getElementById('rainfallChart').style.display = 'block';

            // Create Water Level Chart
            new Chart(document.getElementById('waterLevelChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ketinggian Air (cm)',
                        data: waterLevels,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    ...chartOptions,
                    scales: {
                        ...chartOptions.scales,
                        y: {
                            ...chartOptions.scales.y,
                            title: {
                                display: true,
                                text: 'Ketinggian Air (cm)',
                                color: '#374151',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        }
                    }
                }
            });

            // Create Rainfall Chart
            new Chart(document.getElementById('rainfallChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Curah Hujan (mm)',
                        data: rainfalls,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.05)',
                        pointBackgroundColor: '#ef4444',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    ...chartOptions,
                    scales: {
                        ...chartOptions.scales,
                        y: {
                            ...chartOptions.scales.y,
                            title: {
                                display: true,
                                text: 'Curah Hujan (mm)',
                                color: '#374151',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        }
                    }
                }
            });
        }, 1500);
    </script>
</body>

</html>
