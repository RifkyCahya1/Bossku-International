<div
    id="customers-panel"
    x-data="{
        customers: [
            { id: 1, name: 'John Doe', wa: '+628123456789', email: 'john@example.com', status: 'Active', membership: 'Gold', notes: 'Prefers Bali packages', bookings: 12 },
            { id: 2, name: 'Jane Smith', wa: '+628987654321', email: 'jane@example.com', status: 'Inactive', membership: 'Silver', notes: 'Loves cruises', bookings: 5 },
        ],
        search: '',
        filterStatus: '',
        filterMembership: '',
        showProfile: false,
        activeCustomer: null,
        showForm: false,
        newCustomer: { name: '', wa: '', email: '', status: '', membership: '' },
        showDuplicateAlert: false,

        filteredCustomers() {
            return this.customers.filter(c => 
            (!this.search || c.name.toLowerCase().includes(this.search.toLowerCase())) &&
            (!this.filterStatus || c.status === this.filterStatus) &&
            (!this.filterMembership || c.membership === this.filterMembership)
            );
        },

        checkDuplicate() {
            const dup = this.customers.find(c => 
            c.wa === this.newCustomer.wa || c.email === this.newCustomer.email
            );
            this.showDuplicateAlert = !!dup;
        },

        openProfile(customer) {
            this.activeCustomer = customer;
            this.showProfile = true;
        }
    }">
    <div class="flex items-center gap-4 mb-6">
        <input x-model="search" type="text" placeholder="Search name..."
            class="px-4 py-2 rounded-xl bg-white/10 dark:bg-gray-800/10 border border-white/10 dark:border-gray-800/10 focus:ring-2 focus:ring-[#bfa46f] outline-none w-64" />
        <select x-model="filterStatus"
            class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 dark:bg-gray-800/10  dark:border-gray-800/10 focus:ring-2 focus:ring-[#bfa46f]">
            <option value="">All Status</option>
            <option>Active</option>
            <option>Inactive</option>
        </select>
        <select x-model="filterMembership"
            class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 dark:bg-gray-800/10  dark:border-gray-800/10 focus:ring-2 focus:ring-[#bfa46f]">
            <option value="">All Membership</option>
            <option>Gold</option>
            <option>Silver</option>
            <option>Bronze</option>
        </select>

        <div class="ml-auto flex items-center">
            <button @click="showForm = true"
                class="px-4 py-2 rounded-xl font-semibold bg-gradient-to-r from-[#bfa46f] to-[#a38c58] hover:opacity-90 transition">
                + Add New
            </button>
        </div>  
    </div>

    <div class="overflow-x-auto border border-white/10 rounded-2xl shadow-lg">
        <table class="w-full text-left">
            <thead class="bg-white/10">
                <tr>
                    <th class="p-3 font-medium">Name</th> 
                    <th class="p-3 font-medium">WhatsApp</th>
                    <th class="p-3 font-medium">Email</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Membership</th>
                    <th class="p-3 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="customer in filteredCustomers()" :key="customer.id">
                    <tr class="border-t border-white/10 hover:bg-white/5 transition">
                        <td class="p-3" x-text="customer.name"></td>
                        <td class="p-3" x-text="customer.wa"></td>
                        <td class="p-3" x-text="customer.email"></td>
                        <td class="p-3">
                            <span x-text="customer.status"
                                :class="customer.status === 'Active' ? 'text-green-400' : 'text-red-400'"></span>
                        </td>
                        <td class="p-3" x-text="customer.membership"></td>
                        <td class="p-3 text-right">
                            <button @click="openProfile(customer)"
                                class="px-3 py-1 bg-gradient-to-r from-[#bfa46f] to-[#a38c58] rounded-lg text-sm hover:opacity-90">
                                View
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Profile Modal -->
    <div x-show="showProfile" x-transition class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 w-full max-w-2xl relative">
            <button @click="showProfile = false" class="absolute top-3 right-3 text-white/70 hover:text-white">✕</button>
            <h3 class="text-2xl font-semibold mb-4" x-text="activeCustomer.name"></h3>
            <p class="text-gray-300"><strong>WA:</strong> <span x-text="activeCustomer.wa"></span></p>
            <p class="text-gray-300"><strong>Email:</strong> <span x-text="activeCustomer.email"></span></p>
            <p class="text-gray-300"><strong>Status:</strong> <span x-text="activeCustomer.status"></span></p>
            <p class="text-gray-300"><strong>Membership:</strong> <span x-text="activeCustomer.membership"></span></p>

            <div class="mt-6 border-t border-white/10 pt-4">
                <h4 class="font-semibold text-lg mb-2">Booking History</h4>
                <p class="text-gray-400" x-text="`Total Bookings: ${activeCustomer.bookings}`"></p>
            </div>

            <div class="mt-6 border-t border-white/10 pt-4">
                <h4 class="font-semibold text-lg mb-2">Notes</h4>
                <textarea x-model="activeCustomer.notes"
                    class="w-full rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f] p-3 text-white"
                    rows="3"></textarea>
            </div>
        </div>
    </div>

    <!-- Add New Customer Modal -->
    <div x-show="showForm" x-transition class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 w-full max-w-lg relative">
            <button @click="showForm = false" class="absolute top-3 right-3 text-white/70 hover:text-white">✕</button>
            <h3 class="text-2xl font-semibold mb-4">Add New Customer</h3>

            <div class="grid gap-4">
                <input x-model="newCustomer.name" type="text" placeholder="Full Name"
                    class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f] outline-none" />
                <input x-model="newCustomer.wa" @input="checkDuplicate" type="text" placeholder="WhatsApp Number"
                    class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f]" />
                <input x-model="newCustomer.email" @input="checkDuplicate" type="email" placeholder="Email Address"
                    class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f]" />
                <select x-model="newCustomer.status"
                    class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f]">
                    <option value="">Select Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <select x-model="newCustomer.membership"
                    class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f]">
                    <option value="">Membership Level</option>
                    <option>Gold</option>
                    <option>Silver</option>
                    <option>Bronze</option>
                </select>
            </div>

            <div class="mt-6 flex justify-end">
                <button @click="showForm = false"
                    class="px-4 py-2 mr-3 rounded-xl border border-white/20 hover:bg-white/10 transition">Cancel</button>
                <button class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#bfa46f] to-[#a38c58] hover:opacity-90">Save</button>
            </div>

            <!-- Duplicate Alert -->
            <div x-show="showDuplicateAlert" x-transition
                class="mt-4 p-3 bg-red-500/20 border border-red-400/30 text-sm rounded-lg text-red-300">
                ⚠️ Existing record found with same WhatsApp or Email!
            </div>
        </div>
    </div>
</div>