<div x-data="paymentOverviewPage()" class="min-h-screen p-6 bg-gradient-to-b dark:from-gray-50 dark:to-gray-100 transition-all duration-500">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-semibold text-[#bfa46f] tracking-wide">Payment Overview</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400 mt-1">Payment history and status overview.</p>
        </div>
        <select x-model="filter"
            class="rounded-xl border dark:border-gray-300 border-gray-700 dark:bg-white/60 bg-gray-800/60 dark:text-gray-700 text-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 dark:focus:ring-[#bfa46f] focus:ring-[#d4af37]">
            <option value="">All</option>
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Refund">Refund</option>
        </select>
    </div>

    <!-- Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Payment Table -->
        <div class="col-span-2 dark:bg-white/60 bg-gray-900/60 backdrop-blur-lg border dark:border-gray-200 border-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="dark:bg-[#bfa46f]/10 bg-[#d4af37]/10 text-[#bfa46f] ">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">Payment ID</th>
                        <th class="px-6 py-3 text-left font-semibold">Booking ID</th>
                        <th class="px-6 py-3 text-left font-semibold">Amount</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-left font-semibold">Proof</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-200 divide-gray-800 dark:text-gray-700 text-gray-300">
                    <template x-for="p in filteredPayments" :key="p.id">
                        <tr @click="openDetail(p)" class="dark:hover:bg-gray-50/50 hover:bg-gray-800/40 cursor-pointer transition-colors duration-200">
                            <td class="px-6 py-4" x-text="p.id"></td>
                            <td class="px-6 py-4" x-text="p.booking"></td>
                            <td class="px-6 py-4 font-medium" x-text="'$' + p.amount.toLocaleString()"></td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                    :class="{
                                        'bg-yellow-500/20 text-yellow-600': p.status === 'Pending',
                                        'bg-green-500/20 text-green-600': p.status === 'Confirmed',
                                        'bg-red-500/20 text-red-600': p.status === 'Refund'
                                    }"
                                    x-text="p.status">
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a :href="p.proof" class="text-[#bfa46f]  hover:underline">View</a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <!-- Empty State -->
            <div x-show="filteredPayments.length === 0" class="p-8 text-center text-gray-400 dark:text-gray-500">
                <i class="fa-solid fa-money-check text-4xl mb-3"></i>
                <p>No payment records found.</p>
            </div>
        </div>

        <div class="dark:bg-white/60 bg-gray-900/60 backdrop-blur-lg border dark:border-gray-200 border-gray-800 rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-semibold text-[#bfa46f]  mb-3">Monthly Revenue</h3>
            <canvas id="revenueChart" height="200"></canvas>
        </div>
    </div>

    <div x-show="showDetail"
        x-transition
        class="fixed inset-0 bg-black/50 flex justify-center items-center z-50"
        @click.self="showDetail=false">
        <div class="dark:bg-white bg-gray-900 rounded-2xl shadow-2xl w-full max-w-md p-6 border dark:border-gray-200 border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-semibold text-[#bfa46f] ">Payment Detail</h3>
                <button @click="showDetail=false" class="text-gray-500 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <template x-if="selectedPayment">
                <div class="space-y-3">
                    <div><strong class="dark:text-gray-700 text-gray-300">Payment ID:</strong> <span x-text="selectedPayment.id"></span></div>
                    <div><strong class="dark:text-gray-700 text-gray-300">Booking ID:</strong> <span x-text="selectedPayment.booking"></span></div>
                    <div><strong class="dark:text-gray-700 text-gray-300">Customer:</strong> <span x-text="selectedPayment.customer"></span></div>
                    <div><strong class="dark:text-gray-700 text-gray-300">Package:</strong> <span x-text="selectedPayment.package"></span></div>
                    <div><strong class="dark:text-gray-700 text-gray-300">Amount:</strong> <span x-text="'$' + selectedPayment.amount.toLocaleString()"></span></div>
                    <div><strong class="dark:text-gray-700 text-gray-300">Balance Remaining:</strong> <span class="text-red-500" x-text="'$' + selectedPayment.balance.toLocaleString()"></span></div>
                    <div><strong class="dark:text-gray-700 text-gray-300">Proof:</strong> <a :href="selectedPayment.proof" class="text-[#bfa46f] dark:text-[#d4af37] hover:underline">View Proof</a></div>
                </div>
            </template>

            <div class="flex gap-3 mt-6">
                <button @click="approvePayment" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-xl shadow-md font-medium transition">Approve</button>
                <button @click="rejectPayment" class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl shadow-md font-medium transition">Reject</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function paymentOverviewPage() {
        return {
            filter: '',
            showDetail: false,
            selectedPayment: null,
            payments: [{
                    id: 'PAY-001',
                    booking: 'BK-100',
                    amount: 1500,
                    status: 'Pending',
                    proof: '#',
                    customer: 'John Doe',
                    package: 'Japan 7D6N',
                    balance: 500
                },
                {
                    id: 'PAY-002',
                    booking: 'BK-101',
                    amount: 2500,
                    status: 'Confirmed',
                    proof: '#',
                    customer: 'Sarah Lee',
                    package: 'Korea Winter 6D5N',
                    balance: 0
                },
                {
                    id: 'PAY-003',
                    booking: 'BK-102',
                    amount: 1200,
                    status: 'Refund',
                    proof: '#',
                    customer: 'David Tan',
                    package: 'Bali Escape',
                    balance: 0
                },
            ],
            get filteredPayments() {
                if (!this.filter) return this.payments;
                return this.payments.filter(p => p.status === this.filter);
            },
            openDetail(p) {
                this.selectedPayment = p;
                this.showDetail = true;
            },
            approvePayment() {
                if (this.selectedPayment) {
                    this.selectedPayment.status = 'Confirmed';
                    this.showDetail = false;
                    alert('✅ Payment Approved & synced to Google Sheet.');
                }
            },
            rejectPayment() {
                if (this.selectedPayment) {
                    this.selectedPayment.status = 'Refund';
                    this.showDetail = false;
                    alert('❌ Payment Rejected & synced to Google Sheet.');
                }
            },
            init() {
                const ctx = document.getElementById('revenueChart');

                // Cek apakah chart sebelumnya sudah ada di elemen ini
                if (ctx._chartInstance) {
                    ctx._chartInstance.destroy();
                }

                // Buat chart baru
                const newChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Revenue ($)',
                            data: [12000, 15500, 13200, 16800, 19000, 17400, 20000, 22100, 21300, 25000, 27000, 29500],
                            borderWidth: 3,
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
                                    color: '#a3a3a3'
                                },
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                ticks: {
                                    color: '#a3a3a3'
                                },
                                grid: {
                                    color: '#2e2e2e30'
                                }
                            }
                        }
                    }
                });

                ctx._chartInstance = newChart;
            }

        }
    }
</script>