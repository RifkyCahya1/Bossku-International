<div x-data="{ tab: 'general info' }" class="min-h-screen p-6 transition-colors duration-500">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-semibold tracking-wide text-[#bfa46f]">General Information</h2>
        <span class="px-3 py-1 text-xs font-semibold bg-[#bfa46f]/10 text-[#bfa46f] rounded-full">Reference Data Center</span>
    </div>

    <p class="text-sm dark:text-gray-500 text-gray-400 mb-6">Manage reference information used for generating itineraries and travel reminders.</p>

    <!-- Tabs -->
    <div class="flex flex-wrap border-b dark:border-gray-200 border-gray-700 mb-6 space-x-4">
        <button @click="tab = 'general info'" :class="tab === 'general info' ? 'text-[#bfa46f] border-b-2 border-[#bfa46f]' : 'dark:text-gray-500 text-gray-400 hover:text-[#bfa46f]'"
            class="pb-2 text-sm font-medium transition">Country Info</button>
        <button @click="tab = 'bank'" :class="tab === 'bank' ? 'text-[#bfa46f] border-b-2 border-[#bfa46f]' : 'dark:text-gray-500 text-gray-400 hover:text-[#bfa46f]'"
            class="pb-2 text-sm font-medium transition">Bank List</button>
        <button @click="tab = 'tl'" :class="tab === 'tl' ? 'text-[#bfa46f] border-b-2 border-[#bfa46f]' : 'dark:text-gray-500 text-gray-400 hover:text-[#bfa46f]'"
            class="pb-2 text-sm font-medium transition">TL Database</button>
        <button @click="tab = 'packing'" :class="tab === 'packing' ? 'text-[#bfa46f] border-b-2 border-[#bfa46f]' : 'dark:text-gray-500 text-gray-400 hover:text-[#bfa46f]'"
            class="pb-2 text-sm font-medium transition">Packing List</button>
    </div>

    <!-- Content -->
    <div class="dark:bg-white/80 bg-white/5 rounded-2xl shadow-sm p-6 border dark:border-gray-100 border-gray-800 transition">

        <!-- Country Info -->
        <div x-show="tab === 'general info'" x-transition>
            <h3 class="text-xl font-semibold text-[#bfa46f] mb-4">🌍 Country Info</h3>
            <p class="text-sm dark:text-gray-500 text-gray-400 mb-4">Weather & Etiquette references for each destination.</p>

            <table class="w-full text-sm border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-left dark:text-gray-600 text-gray-300">
                        <th class="py-2">Country</th>
                        <th class="py-2">Weather</th>
                        <th class="py-2">Etiquette Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="dark:bg-gray-50/50 bg-gray-900/30 dark:hover:bg-gray-100 hover:bg-gray-800 transition">
                        <td contenteditable="true" class="py-2 px-3 rounded-l-xl">Japan</td>
                        <td contenteditable="true" class="py-2 px-3">Spring: Cool, bring light jacket</td>
                        <td contenteditable="true" class="py-2 px-3 rounded-r-xl">Always bow when greeting</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Bank List -->
        <div x-show="tab === 'bank'" x-transition>
            <h3 class="text-xl font-semibold text-[#bfa46f] mb-4">🏦 Bank List</h3>
            <p class="text-sm dark:text-gray-500 text-gray-400 mb-4">Reference for travel payments & refunds.</p>

            <table class="w-full text-sm border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-left dark:text-gray-300 text-gray-600">
                        <th class="py-2">Bank Name</th>
                        <th class="py-2">Swift Code</th>
                        <th class="py-2">Country</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="dark:bg-gray-50/50 bg-gray-900/30 dark:hover:bg-gray-100 hover:bg-gray-800 transition">
                        <td contenteditable="true" class="py-2 px-3 rounded-l-xl">BCA</td>
                        <td contenteditable="true" class="py-2 px-3">CENAIDJA</td>
                        <td contenteditable="true" class="py-2 px-3 rounded-r-xl">Indonesia</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- TL Database -->
        <div x-show="tab === 'tl'" x-transition>
            <h3 class="text-xl font-semibold text-[#bfa46f] mb-4">🧳 TL Database</h3>
            <p class="text-sm dark:text-gray-500 text-gray-400 mb-4">Travel Leaders contact list for assigned tours.</p>

            <table class="w-full text-sm border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-left dark:text-gray-300 text-gray-600">
                        <th class="py-2">Name</th>
                        <th class="py-2">Phone</th>
                        <th class="py-2">Country</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="dark:bg-gray-50/50 bg-gray-900/30 dark:hover:bg-gray-100 hover:bg-gray-800 transition">
                        <td contenteditable="true" class="py-2 px-3 rounded-l-xl">Andi Putra</td>
                        <td contenteditable="true" class="py-2 px-3">+62 812 3456 7890</td>
                        <td contenteditable="true" class="py-2 px-3 rounded-r-xl">Japan</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Packing List -->
        <div x-show="tab === 'packing'" x-transition>
            <h3 class="text-xl font-semibold text-[#bfa46f] mb-4">🎒 Packing List</h3>
            <p class="text-sm dark:text-gray-500 text-gray-400 mb-4">Destination-specific packing recommendations.</p>

            <table class="w-full text-sm border-separate border-spacing-y-2">
                <thead>
                    <tr class="text-left dark:text-gray-300 text-gray-600">
                        <th class="py-2">Destination</th>
                        <th class="py-2">Item</th>
                        <th class="py-2">Note</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="dark:bg-gray-50/50 bg-gray-900/30 dark:hover:bg-gray-100 hover:bg-gray-800 transition">
                        <td contenteditable="true" class="py-2 px-3 rounded-l-xl">Japan</td>
                        <td contenteditable="true" class="py-2 px-3">Power Adapter Type A</td>
                        <td contenteditable="true" class="py-2 px-3 rounded-r-xl">110V only</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>