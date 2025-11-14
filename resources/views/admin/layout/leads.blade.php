<div x-data="leadPage()" class="min-h-screen p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold dark:text-gray-900 text-white">Leads</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400 mt-1">Manage all potential clients and conversions.</p>
        </div>
        <button @click="addLead()" class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white hover:opacity-90 transition-all">
            + New Lead
        </button>
    </div>

    <div class="overflow-hidden rounded-2xl shadow border dark:border-gray-200 border-gray-700 dark:bg-white bg-gray-800">
        <table class="min-w-full divide-y dark:divide-gray-200  divide-gray-700">
            <thead class="dark:bg-gray-50 bg-gray-700/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-gray-500 text-gray-300">Lead ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-gray-500 text-gray-300">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-gray-500 text-gray-300">WA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-gray-500 text-gray-300">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-gray-500 text-gray-300">Booking ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider dark:text-gray-500 text-gray-300">Status</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                <template x-for="(lead, index) in leads" :key="lead.id">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-200 dark:text-gray-700" x-text="lead.id"></td>
                        <td class="px-6 py-4 text-sm text-gray-300 dark:text-gray-600" x-text="lead.name"></td>
                        <td class="px-6 py-4 text-sm text-gray-300 dark:text-gray-600" x-text="lead.wa"></td>
                        <td class="px-6 py-4 text-sm text-gray-300 dark:text-gray-600" x-text="lead.email"></td>
                        <td class="px-6 py-4 text-sm text-gray-300 dark:text-gray-600" x-text="lead.booking_id || '-'"></td>
                        <td class="px-6 py-4">
                            <select x-model="lead.status" @change="updateStatus(index)" class="text-sm rounded-lg dark:border-gray-300 border-gray-700 dark:bg-gray-50 bg-gray-800 dark:text-gray-800 text-gray-200 focus:ring-[#bfa46f] focus:border-[#bfa46f]">
                                <option>New</option>
                                <option>Contacted</option>
                                <option>Converted</option>
                                <option>Closed</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button @click="deleteLead(index)" class="text-red-500 hover:text-red-600 text-sm font-semibold">Delete</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div x-show="showModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-[9999]">
        <div class="bg-gray-800 dark:bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
            <h3 class="text-lg font-semibold text-white dark:text-gray-900 mb-4">Add New Lead</h3>
            <div class="space-y-3">
                <input x-model="newLead.name" type="text" placeholder="Full Name" class="w-full p-2 border rounded-lg bg-gray-700 dark:bg-white text-white dark:text-gray-900" />
                <input x-model="newLead.wa" type="text" placeholder="WhatsApp Number" class="w-full p-2 border rounded-lg bg-gray-700 dark:bg-white text-white dark:text-gray-900" />
                <input x-model="newLead.email" type="email" placeholder="Email" class="w-full p-2 border rounded-lg bg-gray-700 dark:bg-white text-white dark:text-gray-900" />
            </div>
            <div class="flex justify-end gap-3 mt-5">
                <button @click="showModal=false" class="px-4 py-2 rounded-lg bg-gray-700 dark:bg-gray-200 text-white dark:text-gray-800">Cancel</button>
                <button @click="saveLead()" class="px-4 py-2 rounded-lg bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    function leadPage() {
        return {
            leads: [{
                    id: 'L-1001',
                    name: 'John Doe',
                    wa: '+628123456789',
                    email: 'john@example.com',
                    booking_id: '',
                    status: 'New'
                },
                {
                    id: 'L-1002',
                    name: 'Anna Sari',
                    wa: '+628987654321',
                    email: 'anna@example.com',
                    booking_id: 'B-221',
                    status: 'Converted'
                },
            ],
            showModal: false,
            newLead: {
                name: '',
                wa: '',
                email: ''
            },

            addLead() {
                this.showModal = true
            },
            saveLead() {
                if (!this.newLead.name) return;
                const id = 'L-' + Math.floor(Math.random() * 9000 + 1000);
                this.leads.push({
                    id,
                    ...this.newLead,
                    booking_id: '',
                    status: 'New'
                });
                this.newLead = {
                    name: '',
                    wa: '',
                    email: ''
                };
                this.showModal = false;
            },
            deleteLead(index) {
                this.leads.splice(index, 1)
            },

            updateStatus(index) {
                const lead = this.leads[index];
                // Automation: if converted, create booking
                if (lead.status === 'Converted' && !lead.booking_id) {
                    lead.booking_id = 'B-' + Math.floor(Math.random() * 900 + 100);
                    alert(`Booking record created for ${lead.name} (${lead.booking_id})`);
                }
            }
        }
    }
</script>