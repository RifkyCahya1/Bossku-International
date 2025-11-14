<div
    x-data="{ 
        search: '', 
        logs: [
            { date: '2025-11-05 09:21', user: 'Admin', action: 'Updated', module: 'Booking', oldValue: 'Pending', newValue: 'Confirmed' },
            { date: '2025-11-05 08:45', user: 'Nina', action: 'Deleted', module: 'Lead', oldValue: 'Contacted', newValue: '—' },
            { date: '2025-11-04 20:14', user: 'Rizky', action: 'Added', module: 'Customer', oldValue: '—', newValue: 'John Doe' },
        ],
        get filteredLogs() {
            if (this.search === '') return this.logs;
            return this.logs.filter(l => 
                Object.values(l).some(v => 
                    String(v).toLowerCase().includes(this.search.toLowerCase())
                )
            );
        }
    }"
    class="min-h-screen p-6 transition-colors duration-500 ">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-semibold text-[#bfa46f]">Audit Log</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400 mt-1">Track every action performed by your team.</p>
        </div>
        <div class="flex items-center space-x-3">
            <input
                x-model="search"
                type="text"
                placeholder="Search logs..."
                class="px-4 py-2 rounded-xl border dark:border-gray-300 border-gray-700 dark:bg-white/70 bg-gray-900/60 focus:ring-2 focus:ring-[#bfa46f] outline-none transition w-64">
        </div>
    </div>

    <div class="dark:bg-white/80 bg-gray-900/60 border dark:border-gray-200 border-gray-800 rounded-2xl shadow-lg overflow-hidden transition">
        <table class="min-w-full text-sm">
            <thead class="dark:bg-[#bfa46f]/10 bg-[#bfa46f]/20 text-[#bfa46f] uppercase tracking-wider">
                <tr>
                    <th class="py-3 px-4 text-left">Date</th>
                    <th class="py-3 px-4 text-left">User</th>
                    <th class="py-3 px-4 text-left">Action</th>
                    <th class="py-3 px-4 text-left">Module</th>
                    <th class="py-3 px-4 text-left">Old Value</th>
                    <th class="py-3 px-4 text-left">New Value</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(log, i) in filteredLogs" :key="i">
                    <tr class="border-t dark:border-gray-100 border-gray-800 dark:hover:bg-[#bfa46f]/10 hover:bg-[#bfa46f]/20 transition">
                        <td class="py-3 px-4" x-text="log.date"></td>
                        <td class="py-3 px-4 font-medium" x-text="log.user"></td>
                        <td class="py-3 px-4">
                            <span x-text="log.action"
                                :class="{
                                      'text-green-500': log.action === 'Added',
                                      'text-yellow-500': log.action === 'Updated',
                                      'text-red-500': log.action === 'Deleted'
                                  }">
                            </span>
                        </td>
                        <td class="py-3 px-4" x-text="log.module"></td>
                        <td class="py-3 px-4 dark:text-gray-500 text-gray-400 italic" x-text="log.oldValue"></td>
                        <td class="py-3 px-4 dark:text-gray-300 text-gray-200 font-semibold" x-text="log.newValue"></td>
                    </tr>
                </template>

                <tr x-show="filteredLogs.length === 0">
                    <td colspan="6" class="text-center py-6 dark:text-gray-400 text-gray-500">
                        No audit records found.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-between items-center text-sm dark:text-gray-500 text-gray-400">
        <p>Total Records: <span x-text="logs.length"></span></p>
        <button class="px-4 py-2 bg-[#bfa46f] hover:bg-[#c5b06d] text-white font-medium rounded-xl transition shadow-md hover:shadow-lg">
            Export Logs (CSV)
        </button>
    </div>
</div>