@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')

<div
    x-data='tourApp(@json($tours))'
    x-init="init()"
    class="min-h-screen text-gray-800 font-sans py-24">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-[#03293E] tracking-tight drop-shadow-sm">Explore Indonesia</h1>
            <p class="text-gray-500 text-sm md:text-lg mt-3 max-w-2xl mx-auto">Premium, handpicked itineraries across the archipelago — curated with elegance and expertise.</p>
        </div>

        <div class="flex flex-col md:flex-row gap-10">
            <aside class="hidden md:block w-full md:w-80 bg-white/70 backdrop-blur-md border border-gray-100 rounded-2xl p-6 space-y-6 shadow-lg sticky top-28 h-fit">

                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-[#0B0B0B]">Refine Your Journey</h2>
                    <button
                        @click="resetFilters()"
                        class="text-sm text-[#3B5BDB] hover:underline">
                        Reset
                    </button>
                </div>

                <!-- DESTINATION -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-600">
                        Where in Indonesia
                        <span class="block text-xs text-gray-400">Regions that call you</span>
                    </label>
                    <input
                        type="text"
                        x-model="filters.destination"
                        placeholder="Bali, Flores, Raja Ampat…"
                        class="w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-[#3B5BDB]" />
                </div>

                <!-- DURATION -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-600">Duration</label>
                    <select x-model="filters.duration"
                        class="w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                        <option value="">Any</option>
                        <option value="weekend">Weekend Escape (2–3 days)</option>
                        <option value="short">Short Breaks (4–6 days)</option>
                        <option value="week">One-Week Journeys (7–9 days)</option>
                        <option value="extended">Extended Trips (10+ days)</option>
                    </select>
                </div>

                <!-- PRICE -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-600">Your Comfort Range</label>
                    <input type="range"
                        min="200000"
                        max="20000000"
                        step="100000"
                        x-model="filters.harga_final"
                        class="w-full accent-[#3B5BDB]">
                    <p class="text-xs text-gray-500">
                        IDR <span x-text="Number(filters.harga_final).toLocaleString('id-ID')"></span>
                    </p>
                </div>

                <!-- DEPARTURE -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-600">Departure Flexibility</label>
                    <select x-model="filters.departure"
                        class="w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                        <option value="">Any Day (Recommended)</option>
                        <option value="soon">Soon (within 30 days)</option>
                        <option value="season">This Season</option>
                        <option value="next">Next Season</option>
                        <option value="specific">Choose Specific Date…</option>
                    </select>

                    <input
                        x-show="filters.departure === 'specific'"
                        type="date"
                        x-model="filters.departure_date"
                        class="w-full mt-2 border rounded-xl py-2 px-3 text-sm" />
                </div>

                <!-- SIGNATURE THEMES -->
                <div class="space-y-3">
                    <label class="text-sm font-semibold text-gray-700">
                        SIGNATURE BOSSKU THEMES
                        <span class="block text-xs text-gray-400">Curated journeys</span>
                    </label>

                    <template x-for="theme in themes" :key="theme.key">
                        <label class="flex items-start gap-2 text-sm">
                            <input
                                type="checkbox"
                                x-model="filters.themes"
                                :value="theme.key"
                                class="mt-1 rounded">
                            <div>
                                <div class="font-medium" x-text="theme.label"></div>
                                <div class="text-xs text-gray-400" x-text="theme.desc"></div>
                            </div>
                        </label>
                    </template>
                </div>
            </aside>


            <div x-show="mobileOpen" x-cloak class="fixed inset-0 z-40 md:hidden">
                <div class="absolute inset-0 bg-black/40" @click="mobileOpen=false"></div>

                <aside x-show="mobileOpen" x-transition class="absolute left-0 top-0 bottom-0 w-80 bg-white/95 backdrop-blur-md border-r border-gray-100 p-6 overflow-auto">

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold">Filters</h2>
                        <button @click="mobileOpen=false" class="text-gray-600 p-1 rounded hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Max harga_final (IDR)</label>
                            <input type="range" min="200" max="20000000" step="100" x-model="filters.harga_final" class="w-full accent-[#3B5BDB] mt-2">
                            <p class="text-sm text-gray-500 mt-1">
                                <span class="mr-1">IDR</span>
                                <span x-text="Number(filters.harga_final || 0).toLocaleString('id-ID')"></span>
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">kota</label>
                            <select x-model="filters.kota" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                                <option value="">All</option>
                                <template x-for="country in availableCountries()" :key="country">
                                    <option x-text="country"></option>
                                </template>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-sm font-medium text-gray-600">Category</label>
                                <select x-model="filters.category" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                                    <option value="">All</option>
                                    <option>Adventure</option>
                                    <option>Culture</option>
                                    <option>Religious</option>
                                    <option>Nature</option>
                                    <option>Luxury</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-600">Tour Type</label>
                                <select x-model="filters.type" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                                    <option value="">All</option>
                                    <option>Private</option>
                                    <option>Group</option>
                                    <option>Custom</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Start</label>
                            <input type="text" x-model="filters.start" placeholder="e.g. Jakarta" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">End</label>
                            <input type="text" x-model="filters.end" placeholder="e.g. Bali" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                        </div>

                        <div class="flex justify-between items-center mt-2"> <button @click="filters = { kota:'', category:'', type:'', harga_final:4000, start:'', end:'' }, search='', currentPage=1" class="px-4 py-2 rounded-lg bg-gray-100 text-sm">Reset</button> <button @click="mobileOpen=false" class="px-4 py-2 rounded-lg bg-[#3B5BDB] text-white text-sm">Apply</button> </div>

                    </div>
                </aside>
            </div>

            <main class="flex-1 space-y-6">
                <div class="relative">
                    <div class="flex gap-3 items-center">
                        <input type="text" x-model="search" placeholder="Search kotas or tours..." class="flex-1 bg-white border border-gray-200 rounded-2xl py-3 px-4 text-sm shadow-sm focus:ring-2 focus:ring-[#3B5BDB]">

                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hidden sm:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35m1.35-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>

                            <span class="text-xs text-gray-400 hidden sm:inline">Press Enter to search</span>

                            <button @click="mobileOpen = true" class="md:hidden p-2 bg-white border rounded-lg shadow-sm" aria-label="Open filters"> <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-1.447.894L9 17l-4.26 2.894A1 1 0 013 19V4z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <template x-if="filteredTours().length === 0">
                    <p class="text-gray-500 text-center mt-10">No tours match your filters.</p>
                </template>

                <template x-for="(tour, i) in paginatedTours()" :key="tour.id + '-' + i">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col md:flex-row transition-all duration-500 hover:-translate-y-2 hover:shadow-xl group">

                        <div class="relative w-full md:w-1/3 h-64 md:h-auto flex-shrink-0">
                            <img :src="tour.image" :alt="tour.name" loading="lazy" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute left-4 top-4 bg-gradient-to-r from-red-700 via-red-600 to-white/30 text-xs text-white rounded-xl px-3 py-1 font-bold flex items-center gap-1 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-shadow-md">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                                <span x-text="tour.negara" class="text-shadow-lg"></span>
                            </div>
                            <div class="absolute right-4 bottom-4 bg-gradient-to-r from-[#3B5BDB] to-[#2E49B0] text-white text-sm font-semibold rounded-2xl px-4 py-2 shadow-lg">
                                <span class="text-xs mr-1">From</span>
                                IDR
                                <span x-text="Number(tour.harga_final).toLocaleString('id-ID')"></span>
                            </div>
                        </div>

                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex flex-col md:flex-row justify-between items-start gap-2">
                                    <div class="flex-1">
                                        <h3 class="text-xl md:text-2xl font-semibold text-[#0B0B0B]" x-text="tour.name"></h3>
                                        <p class="text-xs text-gray-500 mt-0 flex items-center gap-2">
                                            <span class="inline-flex items-center gap-1">
                                                <span class="bg-[#071F35] text-white px-3 py-[2px] rounded-xl text-xs"
                                                    x-text="tour.pax"></span>

                                                <!-- Separator titik / dot -->
                                                <span class="mx-1">·</span>

                                                <span x-text="'#' + tour.kode"></span>
                                            </span>
                                        </p>

                                    </div>
                                    <div class="text-right mt-3 md:mt-0">
                                        <div class="text-sm text-gray-500">Type</div>
                                        <div class="mt-1 text-sm font-medium text-[#3B5BDB]" x-text="tour.type"></div>
                                    </div>
                                </div>
                                <div class="mt-4 flex flex-wrap gap-3 text-xs text-gray-500">

                                </div>
                            </div>
                            <div class="flex items-center gap-3 mt-6">
                                <a :href="`/tour/detail/${tour.kode}`"
                                    class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-[#3B5BDB] to-[#2E49B0] text-white font-semibold hover:opacity-90 transition">
                                    View Details
                                </a>

                                <div class="ml-auto text-right text-xs text-gray-400">
                                    <div class="font-semibold text-gray-700">
                                        IDR
                                        <span x-text="Number(tour.harga_final).toLocaleString('id-ID')"></span>
                                    </div>
                                    <div class="text-[11px]">per person</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="flex flex-wrap justify-center mt-10 gap-2 items-center select-none">
                    <button
                        @click="prevPage()"
                        :disabled="currentPage === 1"
                        class="px-4 py-2 rounded-xl font-medium border bg-white text-gray-600 hover:bg-indigo-50 transition disabled:opacity-40 disabled:cursor-not-allowed">
                        ← Prev
                    </button>

                    <button
                        @click="goToPage(1)"
                        :class="currentPage === 1  ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-gray-700 border'"
                        class="px-4 py-2 rounded-xl font-medium transition">
                        1
                    </button>

                    <template x-if="showLeftEllipsis()">
                        <span class="px-3 py-2 text-gray-400">...</span>
                    </template>

                    <template x-for="page in middlePages()" :key="page">
                        <button
                            @click="goToPage(page)"
                            :class="currentPage === page  ? 'bg-indigo-600 text-white shadow-md'  : 'bg-white text-gray-700 border'"
                            class="px-4 py-2 rounded-xl font-medium transition">
                            <span x-text="page"></span>
                        </button>
                    </template>

                    <template x-if="showRightEllipsis()">
                        <span class="px-3 py-2 text-gray-400">...</span>
                    </template>

                    <button
                        @click="goToPage(totalPages())"
                        :class="currentPage === totalPages()  ? 'bg-indigo-600 text-white shadow-md'  : 'bg-white text-gray-700 border'"
                        class="px-4 py-2 rounded-xl font-medium transition">
                        <span x-text="totalPages()"></span>
                    </button>

                    <button
                        @click="nextPage()"
                        :disabled="currentPage === totalPages()"
                        class="px-4 py-2 rounded-xl font-medium border bg-white text-gray-600 hover:bg-indigo-50 transition disabled:opacity-40 disabled:cursor-not-allowed">
                        Next →
                    </button>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    function tourApp(serverData) {
        return {
            mobileOpen: false,
            search: "",
            currentPage: 1,

            allTours: [],
            filtered: [],

            themes: [{
                    key: 'sunrise',
                    label: 'Chasing Sunrises',
                    desc: 'Introvert & nature-seekers'
                },
                {
                    key: 'island',
                    label: 'Island & Sea',
                    desc: '43% wisata bahari'
                },
                {
                    key: 'volcano',
                    label: 'Volcano Journeys',
                    desc: 'Adventure seekers'
                },
                {
                    key: 'hidden',
                    label: 'Hidden Gems Collection',
                    desc: 'Culture & immersive trips'
                },
                {
                    key: 'premium',
                    label: 'Premium Stays Only',
                    desc: 'Age 25–44 comfort-driven'
                },
                {
                    key: 'photo',
                    label: 'Photogenic Routes',
                    desc: '80% visual-driven travelers'
                },
            ],

            filters: {
                destination: "",
                duration: "",
                harga_final: 20000000,
                departure: "",
                departure_date: "",
                themes: []
            },

            init() {
                let sd = serverData || [];
                if (!Array.isArray(sd)) sd = [sd];

                this.allTours = sd.flat();
                this.filtered = this.allTours.map(t => {

                    // ===== HITUNG JUMLAH HARI DARI ITINERARY =====
                    let days = 0;

                    // CASE 1: itinerary berupa ARRAY
                    if (Array.isArray(t.itinerary)) {
                        days = t.itinerary.length;
                    }

                    // CASE 2: itinerary berupa STRING (HTML / TEXT)
                    else if (typeof t.itinerary === 'string') {
                        const matches = t.itinerary.match(/day\s*\d+/gi);
                        days = matches ? matches.length : 0;
                    }

                    // FALLBACK: minimal 1 hari
                    if (!days || days < 1) days = 1;

                    return {
                        id: t.itinerary_id ?? t.id,
                        name: (t.judul || '').toString(),
                        kota: (t.kota || '').toString(),
                        negara: (t.negara || '').toString(),
                        harga_final: Number(t.harga_final || 0),
                        kode: (t.landtour || '').toString(),
                        duration_days: days,
                        pax: (t.pax ? (t.pax + " pax") : ''),   
                        type: (t.tour_type || 'Group'),
                        departure_date: t.departure_date || null,
                        themes: t.themes || [],
                        image: t.image || '/images/default.png',
                        description: t.deskripsi || ''
                    }
                });


                this.$watch('filters', () => this.currentPage = 1, {
                    deep: true
                });
                this.$watch('search', () => this.currentPage = 1);
            },

            resetFilters() {
                this.filters = {
                    destination: "",
                    duration: "",
                    harga_final: 20000000,
                    departure: "",
                    departure_date: "",
                    themes: []
                };
                this.search = "";
                this.currentPage = 1;
            },

            filteredTours() {
                return this.filtered.filter(t => {

                    if (this.search) {
                        const q = this.search.toLowerCase();
                        if (!(t.name + t.kota + t.negara).toLowerCase().includes(q)) return false;
                    }

                    if (this.filters.destination) {
                        const d = this.filters.destination.toLowerCase();
                        if (!(t.kota.toLowerCase().includes(d) || t.negara.toLowerCase().includes(d))) return false;
                    }

                    if (t.harga_final > this.filters.harga_final) return false;

                    if (this.filters.duration) {
                        const d = Number(t.duration_days || 0);

                        if (this.filters.duration === 'weekend' && !(d >= 2 && d <= 3)) return false;
                        if (this.filters.duration === 'short' && !(d >= 4 && d <= 6)) return false;
                        if (this.filters.duration === 'week' && !(d >= 7 && d <= 9)) return false;
                        if (this.filters.duration === 'extended' && d < 10) return false;
                    }


                    if (this.filters.departure === 'soon' && t.departure_date) {
                        const diff = (new Date(t.departure_date) - new Date()) / 86400000;
                        if (diff < 0 || diff > 30) return false;
                    }

                    if (this.filters.departure === 'specific' && this.filters.departure_date) {
                        if (t.departure_date !== this.filters.departure_date) return false;
                    }

                    if (this.filters.themes.length) {
                        if (!this.filters.themes.some(th => t.themes.includes(th))) return false;
                    }

                    return true;
                });
            },

            paginatedTours() {
                const perPage = 6;
                const start = (this.currentPage - 1) * perPage;
                return this.filteredTours().slice(start, start + perPage);
            },

            totalPages() {
                return Math.max(1, Math.ceil(this.filteredTours().length / 6));
            },

            nextPage() {
                if (this.currentPage < this.totalPages()) this.currentPage++;
            },

            prevPage() {
                if (this.currentPage > 1) this.currentPage--;
            },

            goToPage(page) {
                const p = Number(page);
                if (p >= 1 && p <= this.totalPages()) {
                    this.currentPage = p;
                }
            },

            // === PAGINATION LOGIC ===
            showLeftEllipsis() {
                return this.totalPages() > 5 && this.currentPage > 3;
            },

            showRightEllipsis() {
                return this.totalPages() > 5 && this.currentPage < this.totalPages() - 2;
            },

            middlePages() {
                const pages = [];
                const total = this.totalPages();

                if (total <= 5) {
                    for (let i = 2; i < total; i++) pages.push(i);
                    return pages;
                }

                let start = Math.max(2, this.currentPage - 1);
                let end = Math.min(total - 1, this.currentPage + 1);

                if (this.currentPage <= 3) {
                    start = 2;
                    end = 4;
                }

                if (this.currentPage >= total - 2) {
                    start = total - 3;
                    end = total - 1;
                }

                for (let i = start; i <= end; i++) pages.push(i);
                return pages;
            },

            // === OPTIONAL (BIAR MOBILE FILTER GA ERROR) ===
            availableCountries() {
                return [...new Set(this.filtered.map(t => t.kota).filter(Boolean))];
            },


        }
    }
</script>



@endsection