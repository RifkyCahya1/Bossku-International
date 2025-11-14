<div x-data="{ activeTab: 'general info' }" class="min-h-screen px-4 py-6 sm:px-6 md:px-10">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <h2 class="text-2xl font-semibold text-white dark:text-gray-800 capitalize tracking-tight" x-text="activeTab"></h2>
    </div>

    <!-- Tabs -->
    <div class="mt-6 flex flex-wrap gap-2 border-b border-gray-700 dark:border-gray-300 pb-2">
        <template x-for="tab in ['general info', 'report & analytics', 'settings', 'audit log']" :key="tab">
            <button
                class="px-4 py-2 rounded-lg text-sm capitalize transition-all duration-300"
                :class="activeTab === tab
                    ? 'bg-gradient-to-r from-[#bfa46f] to-[#a38c58] text-white font-semibold shadow'
                    : 'text-gray-400 dark:text-gray-600 hover:text-[#bfa46f] font-medium'"
                @click="activeTab = tab"
                x-text="tab">
            </button>
        </template>
    </div>

    <div x-show="activeTab === 'general info'" class="mt-6 space-y-6">
        @include('admin.component.general')
    </div>

    <!-- === TAB 2: REPORT & ANALYTICS === -->
    <div x-show="activeTab === 'report & analytics'" class="mt-6 space-y-6">
        @include('admin.component.report')
    </div>

    <!-- === TAB 3: SETTINGS === -->
    <div x-show="activeTab === 'settings'" class="mt-6 space-y-6">
        @include('admin.component.setting')
    </div>

    <!-- === TAB 4: AUDIT LOG === -->
    <div x-show="activeTab === 'audit log'" class="mt-6 space-y-6">
        @include('admin.component.audit')
    </div>
</div>