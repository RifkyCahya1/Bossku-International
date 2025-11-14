<div x-data="documentsPage()" class="min-h-screen p-6 bg-gradient-to-b dark:from-gray-50 dark:to-gray-100  transition-colors duration-500">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-semibold text-[#bfa46f] tracking-wide">Documents</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400 mt-1">Manage travel documents and uploads.</p>
        </div>
        <button @click="sendReminder" class="px-5 py-2 bg-[#bfa46f] hover:bg-[#d4af37] text-white font-medium rounded-xl shadow-lg transition-all duration-300 hover:scale-[1.02]">
            Send Doc Reminder
        </button>
    </div>

    <div class="flex flex-wrap gap-3 mb-6">
        <button
            @click="filter = 'Incomplete'"
            :class="filter === 'Incomplete' ? activeFilter : inactiveFilter">Incomplete</button>

        <button
            @click="filter = 'Expiring Soon'"
            :class="filter === 'Expiring Soon' ? activeFilter : inactiveFilter">Expiring Soon</button>

        <button
            @click="filter = 'Complete'"
            :class="filter === 'Complete' ? activeFilter : inactiveFilter">Complete</button>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl shadow-xl border dark:border-gray-200 border-gray-800 dark:bg-white/60 bg-gray-900/60 backdrop-blur-lg">
        <table class="min-w-full text-sm">
            <thead class="dark:bg-[#bfa46f]/10 bg-[#d4af37]/10 dark:text-[#bfa46f] text-[#d4af37]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Booking ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Customer</th>
                    <th class="px-6 py-3 text-left font-semibold">Passport OK</th>
                    <th class="px-6 py-3 text-left font-semibold">Visa OK</th>
                    <th class="px-6 py-3 text-left font-semibold">Expiry Date</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-gray-200 divide-gray-800 dark:text-gray-700 text-gray-300">
                <template x-for="doc in filteredDocuments" :key="doc.id">
                    <tr class="dark:hover:bg-gray-50/50 hover:bg-gray-800/40 transition-colors duration-200">
                        <td class="px-6 py-4" x-text="doc.bookingId"></td>
                        <td class="px-6 py-4 font-medium" x-text="doc.customer"></td>
                        <td class="px-6 py-4">
                            <span :class="doc.passport ? 'text-green-500' : 'text-red-500'">
                                <i :class="doc.passport ? 'fa-solid fa-check-circle' : 'fa-solid fa-times-circle'"></i>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span :class="doc.visa ? 'text-green-500' : 'text-red-500'">
                                <i :class="doc.visa ? 'fa-solid fa-check-circle' : 'fa-solid fa-times-circle'"></i>
                            </span>
                        </td>
                        <td class="px-6 py-4" x-text="doc.expiry"></td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                :class="{
                                    'bg-red-500/20 text-red-600': doc.status === 'Missing',
                                    'bg-yellow-500/20 text-yellow-600': doc.status === 'Expiring',
                                    'bg-green-500/20 text-green-600': doc.status === 'Complete'
                                }"
                                x-text="doc.status">
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Empty State -->
        <div x-show="filteredDocuments.length === 0" class="p-8 text-center dark:text-gray-400 text-gray-500">
            <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
            <p>No documents uploaded yet.</p>
        </div>
    </div>
</div>

<script>
    function documentsPage() {
        return {
            filter: 'Incomplete',
            activeFilter: 'px-4 py-2 rounded-xl bg-[#bfa46f] text-white shadow-md transition',
            inactiveFilter: 'px-4 py-2 rounded-xl border border-[#bfa46f]/30 text-[#bfa46f] dark:text-[#d4af37] hover:bg-[#bfa46f]/10 transition',
            documents: [{
                    id: 1,
                    bookingId: 'BK001',
                    customer: 'John Doe',
                    passport: true,
                    visa: false,
                    expiry: '2025-11-20',
                    status: 'Missing'
                },
                {
                    id: 2,
                    bookingId: 'BK002',
                    customer: 'Sarah Lee',
                    passport: true,
                    visa: true,
                    expiry: '2025-12-10',
                    status: 'Complete'
                },
                {
                    id: 3,
                    bookingId: 'BK003',
                    customer: 'Rizky Putra',
                    passport: true,
                    visa: true,
                    expiry: '2025-11-08',
                    status: 'Expiring'
                },
            ],
            get filteredDocuments() {
                if (this.filter === 'Incomplete') return this.documents.filter(d => d.status === 'Missing');
                if (this.filter === 'Expiring Soon') return this.documents.filter(d => d.status === 'Expiring');
                if (this.filter === 'Complete') return this.documents.filter(d => d.status === 'Complete');
                return this.documents;
            },
            sendReminder() {
                alert('✅ Nina Reminder created successfully for pending documents.');
            }
        }
    }
</script>