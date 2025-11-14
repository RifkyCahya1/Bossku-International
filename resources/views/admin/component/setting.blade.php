<div x-data="settingsPage()" class="min-h-screen p-6 transition-colors duration-500">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-semibold tracking-wide text-[#bfa46f]">System Settings</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400 mt-1">Manage configurations, accounts, and integrations.</p>
        </div>
        <button @click="saveSettings" class="px-5 py-2 bg-[#bfa46f] hover:bg-[#a38c5b] text-white font-medium rounded-xl shadow-lg transition-all duration-300 hover:scale-[1.02]">
            💾 Save Changes
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex border-b dark:border-gray-200 border-gray-700 mb-6 space-x-8">
        <template x-for="tab in tabs" :key="tab">
            <button @click="activeTab = tab"
                :class="activeTab === tab 
                    ? 'pb-2 border-b-2 border-[#bfa46f] text-[#bfa46f] font-semibold' 
                    : 'pb-2 dark:text-gray-500 text-gray-400 hover:text-[#bfa46f] transition'">
                <span x-text="tab"></span>
            </button>
        </template>
    </div>

    <!-- Tab Panels -->
    <div class="space-y-6">
        <!-- Staff Accounts -->
        <div x-show="activeTab === 'Staff Accounts'" class="dark:bg-white/80 bg-white/5 p-6 rounded-2xl border dark:border-gray-200 border-gray-800 shadow-sm">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">👥 Staff Accounts & Permissions</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b dark:border-gray-200 border-gray-800 text-[#bfa46f]">
                        <th class="py-2">Name</th>
                        <th class="py-2">Role</th>
                        <th class="py-2">Email</th>
                        <th class="py-2 text-center">Active</th>
                        <th class="py-2 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-100 divide-gray-800">
                    <template x-for="user in staff" :key="user.email">
                        <tr>
                            <td class="py-2 font-medium" x-text="user.name"></td>
                            <td class="py-2" x-text="user.role"></td>
                            <td class="py-2" x-text="user.email"></td>
                            <td class="py-2 text-center">
                                <input type="checkbox" class="accent-[#bfa46f]" x-model="user.active">
                            </td>
                            <td class="py-2 text-right">
                                <button @click="removeStaff(user.email)" class="text-red-500 hover:text-red-400 text-xs">Remove</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div class="mt-4 flex gap-2">
                <input type="text" placeholder="New Staff Email" x-model="newStaffEmail"
                    class="w-1/2 px-3 py-2 rounded-lg dark:bg-gray-100 bg-gray-800 border dark:border-gray-200 border-gray-700 text-sm focus:ring-1 focus:ring-[#bfa46f]">
                <button @click="addStaff" class="px-4 py-2 bg-[#bfa46f] text-white rounded-lg text-sm">Add Staff</button>
            </div>
        </div>

        <!-- API Keys -->
        <div x-show="activeTab === 'API Keys'" class="dark:bg-white/80 bg-white/5 p-6 rounded-2xl border dark:border-gray-200 border-gray-800 shadow-sm">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">🔗 API Integrations</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Google Sheet API Key</label>
                    <input type="text" x-model="settings.googleKey" placeholder="Enter your Google API Key"
                        class="w-full px-3 py-2 rounded-lg dark:bg-gray-100 bg-gray-800 border dark:border-gray-200 border-gray-700 text-sm focus:ring-1 focus:ring-[#bfa46f]">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">BalesOtomatis API Key</label>
                    <input type="text" x-model="settings.balesKey" placeholder="Enter your BalesOtomatis API Key"
                        class="w-full px-3 py-2 rounded-lg dark:bg-gray-100 bg-gray-800 border dark:border-gray-200 border-gray-700 text-sm focus:ring-1 focus:ring-[#bfa46f]">
                </div>
            </div>
        </div>

        <!-- Company Profile -->
        <div x-show="activeTab === 'Company Profile'" class="dark:bg-white/80 bg-white/5 p-6 rounded-2xl border dark:border-gray-200 border-gray-800 shadow-sm">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">🏢 Company Profile</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium mb-1">Company Name</label>
                    <input type="text" x-model="settings.companyName"
                        class="w-full px-3 py-2 rounded-lg dark:bg-gray-100 bg-gray-800 border dark:border-gray-200 border-gray-700 text-sm focus:ring-1 focus:ring-[#bfa46f]">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Contact Number</label>
                    <input type="text" x-model="settings.contact"
                        class="w-full px-3 py-2 rounded-lg dark:bg-gray-100 bg-gray-800 border dark:border-gray-200 border-gray-700 text-sm focus:ring-1 focus:ring-[#bfa46f]">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Upload Logo</label>
                    <input type="file" class="w-full px-3 py-2 text-sm text-gray-600 dark:text-gray-300">
                </div>
            </div>
        </div>

        <!-- Backup & Restore -->
        <div x-show="activeTab === 'Backup & Restore'" class="dark:bg-white/80 bg-white/5 p-6 rounded-2xl border dark:border-gray-200 border-gray-800 shadow-sm text-center">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">💾 Backup & Restore</h3>
            <p class="text-sm dark:text-gray-500 text-gray-400 mb-4">Securely backup or sync system data with Google Drive.</p>
            <div class="flex justify-center gap-4">
                <button @click="backupData" class="px-4 py-2 bg-[#bfa46f] text-white rounded-lg text-sm hover:bg-[#a38c5b] transition">Backup Now</button>
                <button @click="restoreData" class="px-4 py-2 border border-[#bfa46f] text-[#bfa46f] rounded-lg text-sm hover:bg-[#bfa46f]/10 transition">Restore</button>
            </div>
        </div>

        <!-- Notifications -->
        <div x-show="activeTab === 'Notifications'" class="dark:bg-white/80 bg-white/5 p-6 rounded-2xl border dark:border-gray-200 border-gray-800 shadow-sm">
            <h3 class="text-lg font-semibold text-[#bfa46f] mb-4">🔔 Notification Preferences</h3>
            <div class="space-y-3">
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-[#bfa46f]" x-model="settings.notifyPayment">
                    <span class="text-sm">Notify for Payment Updates</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-[#bfa46f]" x-model="settings.notifyTravel">
                    <span class="text-sm">Notify for Travel Schedule Changes</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" class="accent-[#bfa46f]" x-model="settings.notifyDocs">
                    <span class="text-sm">Notify for Document Expiry</span>
                </label>
            </div>
        </div>
    </div>
</div>

<script>
    function settingsPage() {
        return {
            activeTab: 'Staff Accounts',
            tabs: ['Staff Accounts', 'API Keys', 'Company Profile', 'Backup & Restore', 'Notifications'],
            staff: [{
                    name: 'Rifky Cahya',
                    role: 'Admin',
                    email: 'rifky@bosskutour.id',
                    active: true
                },
                {
                    name: 'Sarah Lee',
                    role: 'Manager',
                    email: 'sarah@bosskutour.id',
                    active: true
                },
            ],
            newStaffEmail: '',
            settings: {
                googleKey: '',
                balesKey: '',
                companyName: 'Bossku Tour & Travel',
                contact: '+62 812-3456-7890',
                notifyPayment: true,
                notifyTravel: true,
                notifyDocs: false,
            },
            addStaff() {
                if (this.newStaffEmail.trim() !== '') {
                    this.staff.push({
                        name: 'New Staff',
                        role: 'Staff',
                        email: this.newStaffEmail,
                        active: true
                    });
                    this.newStaffEmail = '';
                }
            },
            removeStaff(email) {
                this.staff = this.staff.filter(s => s.email !== email);
            },
            backupData() {
                alert('✅ Backup completed and synced with Google Drive!');
            },
            restoreData() {
                alert('♻️ System data restored successfully.');
            },
            saveSettings() {
                alert('💾 Settings saved successfully!');
            }
        }
    }
</script>