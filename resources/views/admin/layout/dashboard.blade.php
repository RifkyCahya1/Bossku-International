<div x-data="dashboardData()" class="min-h-screen p-6 text-white">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-semibold text-[#bfa46f] tracking-wide">Dashboard Overview</h2>
        <button @click="refreshData"
            class="px-4 py-2 bg-[#bfa46f] hover:bg-[#a38c58] rounded-lg shadow transition">
            Refresh Data
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <template x-for="(card, index) in cards" :key="index">
            <div
                class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow hover:scale-105 transition transform duration-300 cursor-pointer">
                <p class="text-sm text-gray-400" x-text="card.title"></p>
                <h2 class="text-3xl font-bold mt-2 text-[#bfa46f]" x-text="card.value"></h2>
                <p class="text-xs mt-1 text-gray-500" x-text="card.sub"></p>
            </div>
        </template>
    </div>

    <div x-data="chartHandler()" x-init="initDestinationChart(); initRevenueChart();"
        class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <div class="lg:col-span-2">
            <div class="h-[450px] backdrop-blur-md border dark:border-gray-200 border-gray-800 rounded-xl p-6 hover:shadow-[0_0_35px_rgba(191,164,111,0.2)] transition-all duration-500">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-[#bfa46f]">Top Destinations</h3>
                    <div class="space-x-2">
                        <button @click="updateDestinationChart('viewed')"
                            class="px-3 py-1 rounded-lg text-sm bg-[#bfa46f]/20 hover:bg-[#bfa46f]/40">
                            Viewed
                        </button>
                        <button @click="updateDestinationChart('booked')"
                            class="px-3 py-1 rounded-lg text-sm bg-[#bfa46f]/20 hover:bg-[#bfa46f]/40">
                            Booked
                        </button>
                    </div>
                </div>
                <canvas id="destinationChart" class="h-[280px]"></canvas>
            </div>
        </div>

        <div>
            <div class="h-[450px] backdrop-blur-md border dark:border-gray-200 border-gray-800 rounded-xl p-6 hover:shadow-[0_0_35px_rgba(191,164,111,0.2)] transition-all duration-500">
                <h3 class="text-xl font-semibold mb-4 text-[#bfa46f]">Revenue Per Month</h3>
                <canvas id="revenueChart" class="h-[280px]"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-10 bg-white/5 border border-white/10 rounded-2xl p-6 shadow-lg">
        <h3 class="font-semibold text-[#bfa46f] mb-4">Alerts</h3>
        <template x-for="alert in alerts" :key="alert.id">
            <div :class="alert.type === 'warning'
                    ? 'bg-yellow-500/10 border-yellow-500/30'
                    : 'bg-red-500/10 border-red-500/30'"
                class="border rounded-lg p-3 mb-2 flex items-center justify-between">
                <p x-text="alert.message" class="text-sm"></p>
                <button @click="dismissAlert(alert.id)"
                    class="text-xs text-gray-400 hover:text-white transition">Dismiss</button>
            </div>
        </template>
    </div>
 
    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 mt-10 overflow-auto">
        <h3 class="text-lg font-semibold text-[#bfa46f]">Upcoming Departures</h3>
        <table class="w-full mt-4 text-sm">
            <thead class="text-gray-400 border-b border-white/10">
                <tr>
                    <th class="py-3 text-left">Package</th>
                    <th class="py-3 text-left">Date</th>
                    <th class="py-3 text-left">TL</th>
                    <th class="py-3 text-left">Pax</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="trip in departures" :key="trip.id">
                    <tr class="border-b border-white/10 hover:bg-white/10 transition">
                        <td class="py-3" x-text="trip.package"></td>
                        <td class="py-3" x-text="trip.date"></td>
                        <td class="py-3" x-text="trip.tl"></td>
                        <td class="py-3" x-text="trip.pax"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function dashboardData() {
        return {
            cards: [
                { title: 'Total Customers', value: '1,245', sub: '+5% growth' },
                { title: 'Total Bookings (month)', value: '82', sub: '+12% this month' },
                { title: 'Pending Payments', value: '7', sub: 'Check finance tab' },
                { title: 'Departures this Week', value: '4', sub: '2 today' },
            ],
            alerts: [
                { id: 1, type: 'warning', message: '⚠️ Visa Required – 24 days to departure (Japan Group Tour)' },
                { id: 2, type: 'danger', message: '💰 Payment pending – 5 days before travel (Bali Escape)' },
            ],
            departures: [
                { id: 1, package: 'Dubai Luxury Tour', date: 'Nov 3, 2025', tl: 'Sarah Lee', pax: 12 },
                { id: 2, package: 'Tokyo Autumn Trip', date: 'Nov 5, 2025', tl: 'Hiro Tanaka', pax: 18 },
            ],
            refreshData() {
                alert('🔄 Data refreshed successfully!');
            },
            dismissAlert(id) {
                this.alerts = this.alerts.filter(a => a.id !== id);
            }
        };
    }

    function chartHandler() {
        return {
            destinationChart: null,
            revenueChart: null,

            initDestinationChart() {
                const ctx = document.getElementById('destinationChart').getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, '#bfa46f');
                gradient.addColorStop(1, '#8b7e49');

                this.destinationChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Bali', 'Tokyo', 'Paris'],
                        datasets: [{
                            label: 'Views',
                            data: [9200, 8700, 8200],
                            backgroundColor: gradient,
                            borderRadius: 10,
                            borderSkipped: false
                        }]
                    },
                    options: this.chartOptions()
                });
            },

            updateDestinationChart(mode) {
                if (!this.destinationChart) return;
                if (mode === 'viewed') {
                    this.destinationChart.data.labels = ['Bali', 'Tokyo', 'Paris'];
                    this.destinationChart.data.datasets[0].data = [9200, 8700, 8200];
                    this.destinationChart.data.datasets[0].label = 'Views';
                } else {
                    this.destinationChart.data.labels = ['Bangkok', 'Dubai', 'Singapore'];
                    this.destinationChart.data.datasets[0].data = [450, 380, 360];
                    this.destinationChart.data.datasets[0].label = 'Bookings';
                }
                this.destinationChart.update();
            },

            initRevenueChart() {
                const ctx2 = document.getElementById('revenueChart').getContext('2d');
                const gradient = ctx2.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, '#bfa46f');
                gradient.addColorStop(1, '#a38c58');

                this.revenueChart = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Revenue',
                            data: [12000, 18000, 15500, 24000, 30000, 26000, 32000, 41000, 38000, 46000, 52000, 57000],
                            borderColor: gradient,
                            backgroundColor: 'rgba(191,164,111,0.15)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 3,
                            pointHoverRadius: 5,
                            pointBackgroundColor: '#bfa46f',
                            pointBorderColor: '#fff'
                        }]
                    },
                    options: this.chartOptions()
                });
            },

            chartOptions() {
                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: { color: '#d1d5db' },
                            grid: { display: false }
                        },
                        y: {
                            ticks: { color: '#9ca3af', beginAtZero: true },
                            grid: { color: 'rgba(255,255,255,0.05)' }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            titleColor: '#bfa46f',
                            bodyColor: '#f5f5f5',
                            borderWidth: 1,
                            borderColor: '#bfa46f'
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                };
            }
        }
    }
</script>
