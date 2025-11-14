<div x-data="{ filter: 'All', openDetail: false, selected: null }" 
     class="mt-6 transition-colors duration-300 dark:text-gray-800 text-gray-100">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-3xl font-semibold text-[#bfa46f] tracking-wide">Bookings</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">All bookings and management tools.</p>
        </div>

        <div class="flex gap-2">
            <button 
                @click="filter = 'All'" 
                :class="filter === 'All' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
                class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300">
                All
            </button>
            <button 
                @click="filter = 'Pending'"
                :class="filter === 'Pending' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
                class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300">
                Pending
            </button>
            <button 
                @click="filter = 'Ready'"
                :class="filter === 'Ready' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
                class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300">
                Ready
            </button>
            <button 
                @click="filter = 'Completed'"
                :class="filter === 'Completed' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
                class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300">
                Completed
            </button>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl shadow-lg border dark:border-gray-300 border-gray-700 dark:bg-white bg-gray-900">
        <table class="min-w-full divide-y dark:divide-gray-200 divide-gray-700">
            <thead class="dark:bg-gray-100 bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Booking ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Customer</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Package</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Total INV</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Paid</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold">Balance</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">PIC</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-gray-200 divide-gray-700">
                <template x-for="booking in [
                    {id: 'INV-001', name: 'John Doe', package: 'Bali Escape', total: '12,000,000', paid: '8,000,000', balance: '4,000,000', pic: 'Rina', status: 'Pending'},
                    {id: 'INV-002', name: 'Sarah Tan', package: 'Japan Delight', total: '18,500,000', paid: '18,500,000', balance: '0', pic: 'Andre', status: 'Completed'},
                    {id: 'INV-003', name: 'Michael Lee', package: 'Singapore Express', total: '9,500,000', paid: '5,000,000', balance: '4,500,000', pic: 'Rina', status: 'Ready'}
                ].filter(b => filter === 'All' || b.status === filter)" :key="booking.id">
                    <tr @click="selected = booking; openDetail = true" 
                        class="cursor-pointer dark:hover:bg-gray-100 hover:bg-gray-800 transition-all duration-200">
                        <td class="px-4 py-3 text-sm font-medium" x-text="booking.id"></td>
                        <td class="px-4 py-3 text-sm" x-text="booking.name"></td>
                        <td class="px-4 py-3 text-sm" x-text="booking.package"></td>
                        <td class="px-4 py-3 text-sm text-right" x-text="booking.total"></td>
                        <td class="px-4 py-3 text-sm text-right" x-text="booking.paid"></td>
                        <td class="px-4 py-3 text-sm text-right" x-text="booking.balance"></td>
                        <td class="px-4 py-3 text-sm" x-text="booking.pic"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div 
        x-show="openDetail" 
        x-transition 
        class="fixed inset-0 dark:bg-black/40 bg-black/60 backdrop-blur-sm flex justify-end z-50">
        <div class="w-full sm:w-[420px] dark:bg-white bg-gray-900 h-full shadow-2xl rounded-l-2xl p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-[#bfa46f]">Booking Details</h3>
                <button @click="openDetail = false" class="text-gray-500 hover:text-[#bfa46f] transition">✕</button>
            </div>

            <template x-if="selected">
                <div>
                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Customer Info</h4>
                        <p><strong>Name:</strong> <span x-text="selected.name"></span></p>
                        <p><strong>Contact:</strong> +62 812-3456-7890</p>
                        <a href="#" class="text-[#bfa46f] hover:underline text-sm">View Full Profile →</a>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Package Info</h4>
                        <p><strong>Package:</strong> <span x-text="selected.package"></span></p>
                        <p><strong>Departure:</strong> 15 Dec 2025</p>
                        <p><strong>Duration:</strong> 5D4N</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Pax Breakdown</h4>
                        <ul class="text-sm list-disc ml-5">
                            <li>2 Adults</li>
                            <li>1 Child</li>
                        </ul>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Payment Summary</h4>
                        <p><strong>Total:</strong> Rp <span x-text="selected.total"></span></p>
                        <p><strong>Paid:</strong> Rp <span x-text="selected.paid"></span></p>
                        <p><strong>Balance:</strong> Rp <span x-text="selected.balance"></span></p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-lg mb-2">Document Checklist</h4>
                        <div class="space-y-2 text-sm">
                            <label class="flex items-center gap-2"><input type="checkbox" class="accent-[#bfa46f]"> Paspor</label>
                            <label class="flex items-center gap-2"><input type="checkbox" class="accent-[#bfa46f]"> Visa</label>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 mt-8">
                        <button class="px-4 py-2 rounded-lg bg-[#bfa46f] text-white hover:bg-[#bfa46f]/90 transition">Mark Complete</button>
                        <button class="px-4 py-2 rounded-lg border border-[#bfa46f] text-[#bfa46f] hover:bg-[#bfa46f]/10 transition">Send Reminder</button>
                        <button class="px-4 py-2 rounded-lg border dark:border-gray-500 border-gray-600 dark:hover:bg-gray-200 hover:bg-gray-800 transition">Generate Invoice (PDF)</button>
                        <button class="px-4 py-2 rounded-lg border dark:border-gray-500 border-gray-600 dark:hover:bg-gray-200 hover:bg-gray-800 transition">Open in Sheets</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
