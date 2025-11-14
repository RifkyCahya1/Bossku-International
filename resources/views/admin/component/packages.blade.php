<div
    id="packages-panel"
    x-data="{
      sortDesc: false,
      filterDestination: '',
      filterDate: '',
      showDetail: false,
      activePackage: null,
      packages: [
        {
          id: 1,
          name: 'Bali Luxury Getaway',
          destination: 'Bali',
          start_date: '2025-11-20',
          end_date: '2025-11-25',
          adult_price: 12000000,
          child_price: 8500000,
          single_price: 15000000,
          visa_required: false,
          revenue: 72000000,
          hotel_link: '#',
          visa_link: '#',
          itinerary_link: '#',
          booking_dates: ['2025-11-20', '2025-11-25'],
        },
        {
          id: 2,
          name: 'Japan Autumn Experience',
          destination: 'Tokyo',
          start_date: '2025-11-10',
          end_date: '2025-11-17',
          adult_price: 24000000,
          child_price: 19000000,
          single_price: 28000000,
          visa_required: true,
          revenue: 168000000,
          hotel_link: '#',
          visa_link: '#',
          itinerary_link: '#',
          booking_dates: ['2025-11-10', '2025-11-17'],
        }
      ],

      get totalRevenue() {
        return this.packages.reduce((sum, p) => sum + p.revenue, 0);
      },

      filteredPackages() {
        return this.packages
          .filter(p => !this.filterDestination || p.destination.toLowerCase().includes(this.filterDestination.toLowerCase()))
          .filter(p => !this.filterDate || p.start_date === this.filterDate)
          .sort((a, b) => this.sortDesc 
              ? new Date(b.start_date) - new Date(a.start_date)
              : new Date(a.start_date) - new Date(b.start_date)
          );
      },

      openDetail(pkg) {
        this.activePackage = pkg;
        this.showDetail = true;
      },

      daysUntil(date) {
        const diff = (new Date(date) - new Date()) / (1000 * 60 * 60 * 24);
        return Math.ceil(diff);
      }
  }"
    class="p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-semibold tracking-wide bg-gradient-to-r from-[#d4af37] to-[#bfa46f] bg-clip-text text-transparent">Packages</h2>
        <button
            class="px-4 py-2 rounded-xl bg-gradient-to-r from-[#bfa46f] to-[#a38c58] hover:opacity-90 transition">
            + Create New Package
        </button>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-6">
        <input x-model="filterDestination" type="text" placeholder="Filter by Destination..."
            class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f] outline-none w-64" />
        <input x-model="filterDate" type="date"
            class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 focus:ring-2 focus:ring-[#bfa46f]" />
        <button @click="sortDesc = !sortDesc"
            class="px-4 py-2 rounded-xl border border-white/20 hover:bg-white/10 transition">
            Sort by Date <span x-text="sortDesc ? '▼' : '▲'"></span>
        </button>
    </div>

    <!-- Revenue Summary -->
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 mb-6">
        <h3 class="text-xl font-semibold mb-2">Revenue Summary</h3>
        <p class="text-3xl font-bold text-[#d4af37]" x-text="`Rp ${totalRevenue.toLocaleString('id-ID')}`"></p>
        <p class="text-sm text-gray-400 mt-1">Total revenue from all active packages</p>
    </div>

    <!-- Packages Table -->
    <div class="overflow-x-auto border border-white/10 rounded-2xl shadow-lg">
        <table class="w-full text-left">
            <thead class="bg-white/10">
                <tr>
                    <th class="p-3 font-medium">Package Name</th>
                    <th class="p-3 font-medium">Destination</th>
                    <th class="p-3 font-medium">Start Date</th>
                    <th class="p-3 font-medium">Price (Adult)</th>
                    <th class="p-3 font-medium">Price (Child)</th>
                    <th class="p-3 font-medium">Price (Single)</th>
                    <th class="p-3 font-medium">Revenue</th>
                    <th class="p-3 font-medium text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="pkg in filteredPackages()" :key="pkg.id">
                    <tr
                        class="border-t border-white/10 hover:bg-white/5 transition"
                        :class="pkg.visa_required && daysUntil(pkg.start_date) < 30 ? 'bg-red-900/40 border-red-500/40' : ''">
                        <td class="p-3 font-medium" x-text="pkg.name"></td>
                        <td class="p-3" x-text="pkg.destination"></td>
                        <td class="p-3" x-text="pkg.start_date"></td>
                        <td class="p-3 text-[#d4af37]" x-text="`Rp ${pkg.adult_price.toLocaleString('id-ID')}`"></td>
                        <td class="p-3 text-gray-400" x-text="`Rp ${pkg.child_price.toLocaleString('id-ID')}`"></td>
                        <td class="p-3 text-gray-400" x-text="`Rp ${pkg.single_price.toLocaleString('id-ID')}`"></td>
                        <td class="p-3 text-green-400 font-semibold" x-text="`Rp ${pkg.revenue.toLocaleString('id-ID')}`"></td>
                        <td class="p-3 text-right">
                            <button @click="openDetail(pkg)"
                                class="px-3 py-1 bg-gradient-to-r from-[#bfa46f] to-[#a38c58] rounded-lg text-sm hover:opacity-90">
                                Details
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Package Detail Modal -->
    <div x-show="showDetail" x-transition class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 w-full max-w-2xl relative">
            <button @click="showDetail = false" class="absolute top-3 right-3 text-white/70 hover:text-white">✕</button>

            <h3 class="text-2xl font-semibold mb-2" x-text="activePackage.name"></h3>
            <p class="text-gray-300 mb-4" x-text="`Destination: ${activePackage.destination}`"></p>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p><strong>Start Date:</strong> <span x-text="activePackage.start_date"></span></p>
                    <p><strong>End Date:</strong> <span x-text="activePackage.end_date"></span></p>
                </div>
                <div>
                    <p><strong>Visa Required:</strong>
                        <span :class="activePackage.visa_required ? 'text-red-400' : 'text-green-400'"
                            x-text="activePackage.visa_required ? 'Yes' : 'No'"></span>
                    </p>
                    <p><strong>Days Left:</strong> <span x-text="daysUntil(activePackage.start_date) + ' days'"></span></p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 text-center border-t border-white/10 pt-4">
                <div>
                    <p class="text-gray-400 text-sm">Adult</p>
                    <p class="text-[#d4af37] font-semibold" x-text="`Rp ${activePackage.adult_price.toLocaleString('id-ID')}`"></p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Child</p>
                    <p class="text-[#d4af37] font-semibold" x-text="`Rp ${activePackage.child_price.toLocaleString('id-ID')}`"></p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Single</p>
                    <p class="text-[#d4af37] font-semibold" x-text="`Rp ${activePackage.single_price.toLocaleString('id-ID')}`"></p>
                </div>
            </div>

            <div class="mt-6 border-t border-white/10 pt-4">
                <h4 class="font-semibold mb-2">Quick Links</h4>
                <div class="flex flex-wrap gap-3">
                    <a :href="activePackage.itinerary_link" target="_blank"
                        class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 transition">Itinerary</a>
                    <a :href="activePackage.visa_link" target="_blank"
                        class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 transition">Visa Info</a>
                    <a :href="activePackage.hotel_link" target="_blank"
                        class="px-3 py-1 rounded-lg bg-white/10 hover:bg-white/20 transition">Hotel List</a>
                </div>
            </div>

            <div class="mt-6 border-t border-white/10 pt-4">
                <h4 class="font-semibold mb-2">Revenue Calculation</h4>
                <p class="text-green-400 text-lg font-semibold" x-text="`Rp ${activePackage.revenue.toLocaleString('id-ID')}`"></p>
                <p class="text-gray-400 text-sm">Auto-synced from payment records</p>
            </div>
        </div>
    </div>

</div>