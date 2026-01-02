@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')



<div
    x-data='tourApp(@json($tours))'
    x-init="init()"
    class="min-h-screen text-gray-800 font-sans py-24">

    <div class="mx-auto px-6">

        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-6xl font-semibold tracking-wide text-[#0B1D26]">
                Explore Indonesia
            </h1>

            <p class="mt-4 text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                Exclusive journeys curated with precision, taste, and quiet luxury.
            </p>

            <div class="mt-6 w-24 h-[2px] bg-gradient-to-r from-transparent via-[#C9A24D] to-transparent mx-auto"></div>
        </div>

        <div class="flex flex-col md:flex-row gap-10">
            <aside
                class="hidden lg:block relative
                w-full lg:max-w-sm
                bg-gradient-to-b from-[#FAF9F6] to-white
                border border-[#E6D8A8]/40
                rounded-2xl lg:rounded-[28px]
                p-4 sm:p-6 lg:p-8
                shadow-[0_20px_60px_-25px_rgba(201,162,77,0.35)]
                backdrop-blur-xl
                space-y-6 lg:space-y-8">

                <!-- Header -->
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-base lg:text-lg font-semibold tracking-wide text-[#0B1D26]">
                            Refine Your Journey
                        </h2>
                        <div class="mt-1 w-10 lg:w-12 h-[1px] bg-[#C9A24D]"></div>
                    </div>

                    <button
                        @click="resetFilters()"
                        class="text-[10px] uppercase tracking-[0.25em]
                      text-[#9E7C32] hover:text-[#0B1D26] transition">
                        Reset
                    </button>
                </div>

                <!-- Destination -->
                <div class="space-y-2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                        Destination
                    </label>
                    <input
                        type="text"
                        x-model="filters.destination"
                        placeholder="Bali, Flores, Raja Ampat"
                        class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white
                        focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]">
                </div>

                <!-- Duration -->
                <div class="space-y-2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                        Duration
                    </label>
                    <select
                        x-model="filters.duration"
                        class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white">
                        <option value="">Any duration</option>
                        <option value="weekend">Weekend Escape</option>
                        <option value="short">Short Break</option>
                        <option value="week">One Week</option>
                        <option value="extended">Extended Journey</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="space-y-3">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                        Investment Range
                    </label>

                    <input type="range"
                        min="200000"
                        max="20000000"
                        step="100000"
                        x-model="filters.harga_final"
                        class="w-full accent-[#C9A24D]">

                    <div class="text-sm font-medium text-[#0B1D26]">
                        IDR
                        <span x-text="Number(filters.harga_final).toLocaleString('id-ID')"></span>
                    </div>
                </div>

                <!-- Departure -->
                <div class="space-y-2">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                        Departure
                    </label>

                    <select
                        x-model="filters.departure"
                        class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white">
                        <option value="">Flexible</option>
                        <option value="soon">Within 30 Days</option>
                        <option value="season">This Season</option>
                        <option value="next">Next Season</option>
                        <option value="specific">Specific Date</option>
                    </select>

                    <input
                        x-show="filters.departure === 'specific'"
                        type="date"
                        x-model="filters.departure_date"
                        class="w-full mt-2 rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white">
                </div>

                <!-- Themes -->
                <div class="space-y-4">
                    <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                        Signature Themes
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                        <template x-for="theme in themes" :key="theme.key">
                            <label class="flex gap-3 items-start text-sm cursor-pointer">
                                <input
                                    type="checkbox"
                                    x-model="filters.themes"
                                    :value="theme.key"
                                    class="mt-1 rounded accent-[#C9A24D]">

                                <div>
                                    <div class="font-medium text-[#0B1D26]"
                                        x-text="theme.label"></div>
                                    <div class="text-xs text-gray-400"
                                        x-text="theme.desc"></div>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>
            </aside>

            <div
                x-show="openFilter"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full"
                x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full"
                class="fixed bottom-0 inset-x-0 z-50 lg:hidden
                bg-gradient-to-b from-[#FAF9F6] to-white
                rounded-t-3xl
                max-h-[85vh] overflow-y-auto
                p-5 space-y-6">

                <!-- drag handle -->
                <div class="w-12 h-1.5 bg-gray-300 rounded-full mx-auto"></div>

                <!-- header -->
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-semibold text-[#0B1D26]">
                        Refine Your Journey
                    </h2>
                    <button
                        @click="openFilter = false"
                        class="text-sm text-[#9E7C32]">
                        Tutup
                    </button>
                </div>

                <aside
                    class="hidden lg:block relative
                w-full lg:max-w-sm
                bg-gradient-to-b from-[#FAF9F6] to-white
                border border-[#E6D8A8]/40
                rounded-2xl lg:rounded-[28px]
                p-4 sm:p-6 lg:p-8
                shadow-[0_20px_60px_-25px_rgba(201,162,77,0.35)]
                backdrop-blur-xl
                space-y-6 lg:space-y-8">

                    <!-- Header -->
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-base lg:text-lg font-semibold tracking-wide text-[#0B1D26]">
                                Refine Your Journey
                            </h2>
                            <div class="mt-1 w-10 lg:w-12 h-[1px] bg-[#C9A24D]"></div>
                        </div>

                        <button
                            @click="resetFilters()"
                            class="text-[10px] uppercase tracking-[0.25em]
                      text-[#9E7C32] hover:text-[#0B1D26] transition">
                            Reset
                        </button>
                    </div>

                    <!-- Destination -->
                    <div class="space-y-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                            Destination
                        </label>
                        <input
                            type="text"
                            x-model="filters.destination"
                            placeholder="Bali, Flores, Raja Ampat"
                            class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white
                        focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]">
                    </div>

                    <!-- Duration -->
                    <div class="space-y-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                            Duration
                        </label>
                        <select
                            x-model="filters.duration"
                            class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white">
                            <option value="">Any duration</option>
                            <option value="weekend">Weekend Escape</option>
                            <option value="short">Short Break</option>
                            <option value="week">One Week</option>
                            <option value="extended">Extended Journey</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="space-y-3">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                            Investment Range
                        </label>

                        <input type="range"
                            min="200000"
                            max="20000000"
                            step="100000"
                            x-model="filters.harga_final"
                            class="w-full accent-[#C9A24D]">

                        <div class="text-sm font-medium text-[#0B1D26]">
                            IDR
                            <span x-text="Number(filters.harga_final).toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    <!-- Departure -->
                    <div class="space-y-2">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                            Departure
                        </label>

                        <select
                            x-model="filters.departure"
                            class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white">
                            <option value="">Flexible</option>
                            <option value="soon">Within 30 Days</option>
                            <option value="season">This Season</option>
                            <option value="next">Next Season</option>
                            <option value="specific">Specific Date</option>
                        </select>

                        <input
                            x-show="filters.departure === 'specific'"
                            type="date"
                            x-model="filters.departure_date"
                            class="w-full mt-2 rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white">
                    </div>

                    <!-- Themes -->
                    <div class="space-y-4">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-500">
                            Signature Themes
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                            <template x-for="theme in themes" :key="theme.key">
                                <label class="flex gap-3 items-start text-sm cursor-pointer">
                                    <input
                                        type="checkbox"
                                        x-model="filters.themes"
                                        :value="theme.key"
                                        class="mt-1 rounded accent-[#C9A24D]">

                                    <div>
                                        <div class="font-medium text-[#0B1D26]"
                                            x-text="theme.label"></div>
                                        <div class="text-xs text-gray-400"
                                            x-text="theme.desc"></div>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>
                </aside>
            </div>

            <button
                @click="openFilter = true"
                class="fixed bottom-5 left-1/2 -translate-x-1/2 z-40
                            flex items-center gap-2
                            px-6 py-3 rounded-full
                            bg-[#0B1D26] text-white text-sm font-medium
                            shadow-lg lg:hidden">
                🔍 Filter Journey
            </button>

            <main class="flex-1 space-y-10">
                <div class="relative">
                    <div class="flex items-center gap-4">
                        <div class="relative flex-1">
                            <input
                                type="text"
                                x-model="search"
                                placeholder="Search destinations or journeys"
                                class="w-full rounded-full px-6 py-4 text-sm
                                bg-white border border-[#E6D8A8]/60
                                focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]
                                placeholder:text-gray-400">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="absolute right-6 top-1/2 -translate-y-1/2 h-5 w-5 text-[#C9A24D]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 21l-4.35-4.35m1.35-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <template x-if="filteredTours().length === 0">
                    <p class="text-center mt-16 text-sm tracking-wide text-gray-400">
                        No journeys match your preferences
                    </p>
                </template>

                <template x-for="(tour, i) in paginatedTours()" :key="tour.id + '-' + i">
                    <div
                        class="group bg-white rounded-[28px] overflow-hidden
                        shadow-[0_40px_100px_-40px_rgba(0,0,0,0.35)]
                        hover:-translate-y-2 transition duration-500
                        flex flex-col md:flex-row">

                        <div class="relative w-full md:w-1/3 h-72 md:h-auto">
                            <img
                                :src="tour.image"
                                :alt="tour.name"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>

                            <div class="absolute top-4 left-4
                                bg-gradient-to-r from-[#9E7C32] via-[#C9A24D] to-[#F5E6B8]
                                text-[#0B1D26] text-xs font-semibold
                                rounded-full px-4 py-1 shadow">
                                <span x-text="tour.negara"></span>
                            </div>

                            <div class="absolute bottom-4 right-4
                                bg-[#0B1D26] text-[#F5E6B8]
                                rounded-2xl px-5 py-2 text-sm font-medium">
                                IDR
                                <span x-text="Number(tour.harga_final).toLocaleString('id-ID')"></span>
                            </div>
                        </div>

                        <div class="flex-1 p-8 flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-semibold text-[#0B1D26]"
                                    x-text="tour.name"></h3>

                                <div class="text-xs tracking-wide text-gray-400">
                                    <span x-text="'#' + tour.kode"></span>
                                </div>

                                <div class="mt-2 text-sm text-gray-500">
                                    Tour Type:
                                    <span class="font-medium text-[#9E7C32]"
                                        x-text="tour.type"></span>
                                </div>
                            </div>

                            <!-- ACTION -->
                            <div class="flex items-center mt-8">
                                <a
                                    :href="`/tour/detail/${tour.kode}`"
                                    class="rounded-full px-7 py-3
                                    border border-[#C9A24D]
                                    bg-[#0B1D26]
                                    text-[#C9A24D] text-sm tracking-wide
                                    hover:bg-[#C9A24D] hover:text-[#0B1D26]
                                    transition">
                                    View Details
                                </a>

                                <div class="ml-auto text-right text-xs text-gray-400">
                                    <div class="font-medium text-[#0B1D26]">
                                        IDR
                                        <span x-text="Number(tour.harga_final).toLocaleString('id-ID')"></span>
                                    </div>
                                    per person
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- PAGINATION -->
                <div class="flex flex-wrap justify-center mt-16 gap-3 items-center select-none">

                    <button
                        @click="prevPage()"
                        :disabled="currentPage === 1"
                        class="px-4 py-2 rounded-full text-sm
                        border border-[#E6D8A8]
                        text-[#0B1D26]
                        hover:bg-[#FAF9F6]
                        disabled:opacity-40 disabled:cursor-not-allowed">
                        ← Prev
                    </button>

                    <button
                        @click="goToPage(1)"
                        :class="currentPage === 1
                        ? 'bg-[#0B1D26] text-[#F5E6B8]'
                        : 'bg-white border border-[#E6D8A8] text-[#0B1D26]'"
                        class="px-4 py-2 rounded-full text-sm transition">
                        1
                    </button>

                    <template x-if="showLeftEllipsis()">
                        <span class="px-3 py-2 text-gray-400">…</span>
                    </template>

                    <template x-for="page in middlePages()" :key="page">
                        <button
                            @click="goToPage(page)"
                            :class="currentPage === page
                            ? 'bg-[#0B1D26] text-[#F5E6B8]'
                            : 'bg-white border border-[#E6D8A8] text-[#0B1D26]'"
                            class="px-4 py-2 rounded-full text-sm transition">
                            <span x-text="page"></span>
                        </button>
                    </template>

                    <template x-if="showRightEllipsis()">
                        <span class="px-3 py-2 text-gray-400">…</span>
                    </template>

                    <button
                        @click="goToPage(totalPages())"
                        :class="currentPage === totalPages()
                        ? 'bg-[#0B1D26] text-[#F5E6B8]'
                        : 'bg-white border border-[#E6D8A8] text-[#0B1D26]'"
                        class="px-4 py-2 rounded-full text-sm transition">
                        <span x-text="totalPages()"></span>
                    </button>

                    <button
                        @click="nextPage()"
                        :disabled="currentPage === totalPages()"
                        class="px-4 py-2 rounded-full text-sm
                        border border-[#E6D8A8]
                        text-[#0B1D26]
                        hover:bg-[#FAF9F6]
                        disabled:opacity-40 disabled:cursor-not-allowed">
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