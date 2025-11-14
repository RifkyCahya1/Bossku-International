<div
    x-data="{ 
        type: 'All', 
        status: 'All', 
        reminders: [
            { id: 1, date: '2025-10-31', name: 'John Doe', package: 'Bali Adventure', type: 'Payment', channel: 'WhatsApp', status: 'Sent', response: '✅ Confirmed' },
            { id: 2, date: '2025-10-30', name: 'Sarah Lim', package: 'Tokyo Discovery', type: 'Doc', channel: 'Email', status: 'Pending', response: '-' },
            { id: 3, date: '2025-10-29', name: 'Ali Akbar', package: 'Paris Delight', type: 'Feedback', channel: 'WhatsApp', status: 'Failed', response: '❌ No reply' },
        ],
        get filteredReminders() {
            return this.reminders.filter(r => 
                (this.type === 'All' || r.type === this.type) &&
                (this.status === 'All' || r.status === this.status)
            );
        }
    }"
    class="b dark:text-gray-900 text-gray-100 font-sans p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h2 class="text-3xl font-semibold dark:text-[#8a6b35]  text-[#f2e3a8]">Nina Reminder</h2>
            <p class="text-sm dark:text-gray-600  text-gray-400 mt-2">Track and manage all automation messages.</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <button class="px-4 py-2 rounded-xl bg-gradient-to-r dark:from-[#e6cf7b] dark:to-[#bfa46f] dark:text-black font-semibold from-[#bfa46f] to-[#a38c58] text-white shadow-lg hover:shadow-xl transition-all">
                Create New Reminder Manually
            </button>
            <button class="px-4 py-2 rounded-xl dark:bg-white/90 bg-black/80 border border-[#bfa46f]/40 dark:text-[#8a6b35] text-[#f2e3a8] dark:hover:bg-[#f7f1df]/80 hover:bg-[#bfa46f]/10 transition-all">
                Sync Now (BalesOtomatis)
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-6">
        <div>
            <label class="block text-sm dark:text-gray-600 text-gray-400 mb-1">Filter by Type</label>
            <select x-model="type" class="px-3 py-2 rounded-lg border dark:border-gray-300  border-white/10 dark:bg-white  bg-black/60 dark:text-gray-900  text-gray-100 focus:ring-2 focus:ring-[#bfa46f] transition">
                <option>All</option>
                <option>Payment</option>
                <option>Doc</option>
                <option>Prep</option>
                <option>Feedback</option>
            </select>
        </div>
        <div>
            <label class="block text-sm dark:text-gray-600 text-gray-400 mb-1">Filter by Status</label>
            <select x-model="status" class="px-3 py-2 rounded-lg border border-white/10 dark:border-gray-300 dark:bg-white  bg-black/60 dark:text-gray-900 text-gray-100 focus:ring-2 focus:ring-[#bfa46f] transition">
                <option>All</option>
                <option>Pending</option>
                <option>Sent</option>
                <option>Failed</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl shadow-xl border dark:border-gray-200/40 border-white/10 dark:bg-white/50 bg-black/20 backdrop-blur-xl">
        <table class="w-full text-sm">
            <thead class="bg-gradient-to-r dark:from-[#f7f4e6] dark:to-white from-[#2a2a2a] to-[#111111] dark:text-[#8a6b35] text-[#f2e3a8] uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Date Sent</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Package</th>
                    <th class="px-6 py-3 text-left">Message Type</th>
                    <th class="px-6 py-3 text-left">Channel</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Response</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="r in filteredReminders" :key="r.id">
                    <tr class="border-t border-gray-200/40 dark:border-white/10 hover:bg-gray-50 dark:hover:bg-white/5 transition-all duration-300">
                        <td class="px-6 py-3 dark:text-gray-700 text-gray-300" x-text="r.date"></td>
                        <td class="px-6 py-3 font-medium dark:text-gray-900 text-gray-100" x-text="r.name"></td>
                        <td class="px-6 py-3 dark:text-gray-700 text-gray-300" x-text="r.package"></td>
                        <td class="px-6 py-3 dark:text-gray-600 text-gray-400" x-text="r.type"></td>
                        <td class="px-6 py-3 dark:text-gray-700 text-gray-300" x-text="r.channel"></td>
                        <td class="px-6 py-3">
                            <span
                                :class="{
                                    'px-3 py-1 rounded-full text-xs font-semibold': true,
                                    'dark:bg-green-500/20 dark:text-green-700 text-green-300 bg-green-800/30': r.status === 'Sent',
                                    'dark:bg-yellow-500/20 dark:text-yellow-700 text-yellow-300 bg-yellow-900/20': r.status === 'Pending',
                                    'dark:bg-red-500/20 dark:text-red-700 text-red-300 bg-red-900/20': r.status === 'Failed'
                                }"
                                x-text="r.status"></span>
                        </td>
                        <td class="px-6 py-3 dark:text-gray-700 text-gray-300" x-text="r.response"></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>