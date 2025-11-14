<div
    x-data="{ activeTab: 'packages' }"
    class="text-white dark:text-gray-800">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-white dark:text-gray-800 capitalize" x-text="activeTab"></h2>
    </div>

    <!-- Tabs -->
    <div class="mt-4 p-6">
        <div class="flex space-x-2" role="tablist" aria-label="Insights tabs">
            <button
                type="button"
                @click="activeTab = 'packages'"
                class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300"
                :class="activeTab === 'packages' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'">
                Packages
            </button>

            <button
                type="button"
                @click="activeTab = 'customers'"
                class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300"
                :class="activeTab === 'customers' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'">
                Customers
            </button>
        </div>

        <!-- Panels -->
        <div class="mt-6">
            <div
                id="packages-panel"
                x-show="activeTab === 'packages'"
                x-transition
                class="tab-panel">
                @include('admin.component.packages')
            </div>
            <div
                id="customers-panel"
                x-show="activeTab === 'customers'"
                x-transition
                class="tab-panel">

                @include('admin.component.customer')

            </div>
        </div>
    </div>