<div x-data="reportAnalytics()" class="min-h-screen p-6 transition-colors duration-500">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-semibold tracking-wide text-[#bfa46f]">Reports & Analytics</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400">Comprehensive insight into business performance and trends.</p>
        </div>
        <div class="space-x-3">
            <button class="px-4 py-2 text-sm font-medium text-white bg-[#bfa46f] hover:bg-[#a38c5b] rounded-lg transition">
                Export Monthly Report (Excel)
            </button>
            <button class="px-4 py-2 text-sm font-medium border border-[#bfa46f] text-[#bfa46f] hover:bg-[#bfa46f]/10 rounded-lg transition">
                Export Summary (PDF)
            </button>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Revenue Trend -->
        <div class="dark:bg-white/80 bg-white/5 border dark:border-gray-100 border-gray-800 rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">💰 Revenue Trend</h3>
            <canvas id="revenueTrendChart" height="180"></canvas>
        </div>

        <!-- Top 10 Destinations -->
        <div class="dark:bg-white/80 bg-white/5 border dark:border-gray-100 border-gray-800 rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">🌎 Top 10 Destinations</h3>
            <canvas id="topDestinationsChart" height="180"></canvas>
        </div>

        <!-- Customer Growth -->
        <div class="dark:bg-white/80 bg-white/5 border dark:border-gray-100 border-gray-800 rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">👥 Customer Growth</h3>
            <canvas id="customerGrowthChart" height="180"></canvas>
        </div>

        <!-- Payment Status -->
        <div class="dark:bg-white/80 bg-white/5 border dark:border-gray-100 border-gray-800 rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">💳 Payment Status</h3>
            <canvas id="paymentStatusChart" height="180"></canvas>
        </div>
    </div>

    <!-- Conversion Rate -->
    <div class="dark:bg-white/80 bg-white/5 border dark:border-gray-100 border-gray-800 rounded-2xl shadow-sm p-6 mt-8">
        <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">📈 Conversion Rate (Lead → Booking)</h3>
        <canvas id="conversionChart" height="100"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function reportAnalytics() {
        return {
            init() {
                const textColor = getComputedStyle(document.documentElement).getPropertyValue('--tw-prose-body') || '#ccc';

                // Revenue Trend
                new Chart(document.getElementById('revenueTrendChart'), {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            label: 'Revenue (USD)',
                            data: [12000, 15000, 18000, 17000, 20000, 22000, 25000],
                            borderColor: '#bfa46f',
                            tension: 0.4,
                            fill: true,
                            backgroundColor: 'rgba(191,164,111,0.15)',
                            borderWidth: 2,
                            pointRadius: 4
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: textColor
                                }
                            },
                            y: {
                                ticks: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });

                // Top Destinations
                new Chart(document.getElementById('topDestinationsChart'), {
                    type: 'bar',
                    data: {
                        labels: ['Japan', 'Korea', 'Bali', 'Paris', 'Bangkok', 'Dubai', 'Istanbul', 'London', 'Singapore', 'Seoul'],
                        datasets: [{
                            label: 'Bookings',
                            data: [90, 85, 75, 65, 60, 55, 50, 45, 40, 35],
                            backgroundColor: '#bfa46f'
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: textColor
                                }
                            },
                            y: {
                                ticks: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });

                // Customer Growth
                new Chart(document.getElementById('customerGrowthChart'), {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            label: 'Customers',
                            data: [40, 60, 90, 130, 160, 200, 250],
                            borderColor: '#bfa46f',
                            fill: true,
                            backgroundColor: 'rgba(191,164,111,0.15)',
                            tension: 0.4,
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: textColor
                                }
                            },
                            y: {
                                ticks: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });

                // Payment Status (Pie)
                new Chart(document.getElementById('paymentStatusChart'), {
                    type: 'pie',
                    data: {
                        labels: ['Pending', 'Confirmed', 'Refund'],
                        datasets: [{
                            data: [20, 70, 10],
                            backgroundColor: ['#f87171', '#bfa46f', '#facc15']
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });

                // Conversion Rate
                new Chart(document.getElementById('conversionChart'), {
                    type: 'line',
                    data: {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        datasets: [{
                            label: 'Conversion %',
                            data: [30, 45, 55, 60],
                            borderColor: '#bfa46f',
                            fill: true,
                            backgroundColor: 'rgba(191,164,111,0.15)',
                            tension: 0.4,
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: textColor
                                }
                            },
                            y: {
                                ticks: {
                                    color: textColor
                                }
                            }
                        }
                    }
                });
            }
        }
    }
</script>