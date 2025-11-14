<div x-data="travelPage()" class="min-h-screen p-6 bg-gradient-to-b dark:from-gray-50 dark:to-gray-100  transition-colors duration-500">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-semibold text-[#bfa46f] tracking-wide">Travel Management</h2>
            <p class="text-sm dark:text-gray-500 text-gray-400 mt-1">View travel itineraries and schedules.</p>
        </div>
    </div>
    
    <!-- Table -->
    <div class="overflow-hidden rounded-2xl shadow-xl border dark:border-gray-200 border-gray-800 dark:bg-white/60 bg-gray-900/60 backdrop-blur-lg">
        <table class="min-w-full text-sm">
            <thead class="dark:bg-[#bfa46f]/10 bg-[#d4af37]/10 dark:text-[#bfa46f] text-[#d4af37]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Travel ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Package</th>
                    <th class="px-6 py-3 text-left font-semibold">Tour Leader</th>
                    <th class="px-6 py-3 text-left font-semibold">Departure</th>
                    <th class="px-6 py-3 text-left font-semibold">Pax</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y dark:divide-gray-200 divide-gray-800 dark:text-gray-700 text-gray-300">
                <template x-for="travel in travels" :key="travel.id">
                    <tr @click="openDetail(travel)" class="dark:hover:bg-gray-50/50 hover:bg-gray-800/40 cursor-pointer transition-colors duration-200">
                        <td class="px-6 py-4" x-text="travel.id"></td>
                        <td class="px-6 py-4 font-medium" x-text="travel.package"></td>
                        <td class="px-6 py-4" x-text="travel.tl"></td>
                        <td class="px-6 py-4" x-text="travel.departure"></td>
                        <td class="px-6 py-4" x-text="travel.pax"></td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full"
                                :class="{
                                    'bg-blue-500/20 text-blue-600': travel.status === 'Upcoming',
                                    'bg-yellow-500/20 text-yellow-600': travel.status === 'Ongoing',
                                    'bg-green-500/20 text-green-600': travel.status === 'Completed'
                                }"
                                x-text="travel.status">
                            </span>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- Empty State -->
        <div x-show="travels.length === 0" class="p-8 text-center text-gray-400 dark:text-gray-500">
            <i class="fa-solid fa-suitcase-rolling text-4xl mb-3"></i>
            <p>No active travels yet.</p>
        </div>
    </div>

    <!-- Drawer Detail -->
    <div x-show="showDetail"
        x-transition
        class="fixed inset-0 bg-black/40 flex justify-end z-50"
        @click.self="showDetail=false">
        <div class="w-full max-w-md dark:bg-white bg-gray-900 h-full overflow-y-auto shadow-2xl p-6 border-l dark:border-gray-200 border-gray-800">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold dark:text-[#bfa46f] text-[#d4af37]">Travel Detail</h3>
                <button @click="showDetail=false" class="text-gray-500 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <template x-if="selectedTravel">
                <div>
                    <p class="text-sm text-gray-400 mb-4">Travel ID: <span class="font-semibold dark:text-gray-700 text-gray-300" x-text="selectedTravel.id"></span></p>

                    <div class="space-y-3 mb-6">
                        <div><strong class="dark:text-gray-700 text-gray-300">Package:</strong> <span x-text="selectedTravel.package"></span></div>
                        <div><strong class="dark:text-gray-700 text-gray-300">Tour Leader:</strong> <span x-text="selectedTravel.tl"></span></div>
                        <div><strong class="dark:text-gray-700 text-gray-300">Departure:</strong> <span x-text="selectedTravel.departure"></span></div>
                        <div><strong class="dark:text-gray-700 text-gray-300">Pax:</strong> <span x-text="selectedTravel.pax"></span></div>
                    </div>

                    <div class="border-t dark:border-gray-300 border-gray-700 my-4"></div>

                    <h4 class="font-semibold text-[#bfa46f] mb-2">Travel Info</h4>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                        <li><strong>Flight:</strong> <span x-text="selectedTravel.flight"></span></li>
                        <li><strong>Hotel:</strong> <span x-text="selectedTravel.hotel"></span></li>
                        <li><strong>Transport:</strong> <span x-text="selectedTravel.transport"></span></li>
                        <li><strong>Food:</strong> <span x-text="selectedTravel.food"></span></li>
                    </ul>

                    <div class="border-t dark:border-gray-300 border-gray-700 my-4"></div>

                    <h4 class="font-semibold text-[#bfa46f] mb-2">Linked Bookings</h4>
                    <ul class="text-sm dark:text-gray-600 text-gray-400 space-y-1">
                        <template x-for="b in selectedTravel.bookings">
                            <li class="flex justify-between border-b dark:border-gray-200 border-gray-800 pb-1">
                                <span x-text="b.id"></span>
                                <span x-text="b.name"></span>
                            </li>
                        </template>
                    </ul>

                    <div class="mt-6 flex gap-3">
                        <button @click="exportManifest" class="flex-1 bg-[#bfa46f] hover:bg-[#d4af37] text-white py-2 rounded-xl transition font-medium shadow-md">
                            Export Group Manifest (PDF)
                        </button>
                        <button @click="markCompleted" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded-xl transition font-medium shadow-md">
                            Mark Completed
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
    function travelPage() {
        return {
            showDetail: false,
            selectedTravel: null,
            travels: [{
                    id: 'TRV-001',
                    package: 'Japan Autumn 7D6N',
                    tl: 'Ayu Lestari',
                    departure: '2025-11-18',
                    pax: 24,
                    status: 'Upcoming',
                    flight: 'ANA - All Nippon Airways',
                    hotel: 'Hilton Tokyo',
                    transport: 'Private Bus',
                    food: 'Japanese Local Cuisine',
                    bookings: [{
                            id: 'BK-120',
                            name: 'John Doe'
                        },
                        {
                            id: 'BK-121',
                            name: 'Sarah Lee'
                        },
                        {
                            id: 'BK-122',
                            name: 'Rizky Putra'
                        }
                    ]
                },
                {
                    id: 'TRV-002',
                    package: 'Turkey Delight 10D9N',
                    tl: 'Dewi Kusuma',
                    departure: '2025-12-02',
                    pax: 32,
                    status: 'Ongoing',
                    flight: 'Turkish Airlines',
                    hotel: 'DoubleTree Istanbul',
                    transport: 'Luxury Coach',
                    food: 'Halal Mediterranean',
                    bookings: [{
                            id: 'BK-140',
                            name: 'Agus Santoso'
                        },
                        {
                            id: 'BK-141',
                            name: 'Maria Widya'
                        }
                    ]
                }
            ],
            openDetail(travel) {
                this.selectedTravel = travel;
                this.showDetail = true;
            },
            exportManifest() {
                alert('📄 Group Manifest exported successfully as PDF.');
            },
            markCompleted() {
                alert('✅ Travel marked as completed.\n- Updated Last Travel for all customers.\n- Feedback Reminder added to Nina Reminder.');
                this.showDetail = false;
            }
        }
    }
</script>