<div x-data="{ activeTab: 'bookings' }" class="min-h-screen">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-white dark:text-gray-800 capitalize" x-text="activeTab"></h2>
    </div>

    <div class="mt-4 flex space-x-4">
        <button
            class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300"
            :class="activeTab === 'bookings' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
            @click="activeTab = 'bookings'">Bookings</button>

        <button
            class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300"
            :class="activeTab === 'document' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
            @click="activeTab = 'document'">Document</button>

        <button
            class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300"
            :class="activeTab === 'payment' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
            @click="activeTab = 'payment'">Payment</button>

        <button
            class="pb-2 tab-btn px-4 py-2 rounded-lg text-sm transition-colors duration-300"
            :class="activeTab === 'travel' ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold' : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
            @click="activeTab = 'travel'">Travel</button>
    </div>

    <div x-show="activeTab === 'bookings'" class="mt-6">
        @include('admin.component.booking')
    </div>
 
    <div x-show="activeTab === 'document'" class="mt-6">
        @include('admin.component.document')
    </div>
 
    <div x-show="activeTab === 'payment'" class="mt-6">
        @include('admin.component.payment')
    </div>

    <div x-show="activeTab === 'travel'" class="mt-6">
        @include('admin.component.travel')
    </div>
</div>