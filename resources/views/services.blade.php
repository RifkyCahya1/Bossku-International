@extends('main')
@section('content')
<div
    x-data='tourApp(@json($itineraries))'
    x-init="init()"
    class="min-h-screen bg-gray-50/50 py-12">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Section --}}
        <header class="mb-12 border-b border-gray-100 pb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-[10px] font-bold tracking-[0.2em] text-emerald-700 uppercase block mb-2">Explore Destinations</span>
                    <h1 class="text-3xl font-light text-slate-900 tracking-tight">Rencana Perjalanan</h1>
                    <p class="text-sm text-slate-500 mt-2 font-light" x-text="filteredList().length + ' pilihan rute tersedia untuk Anda'"></p>
                </div>

                <div class="flex items-center gap-3 bg-white p-1.5 rounded-full border border-gray-200 shadow-sm">
                    <span class="text-[11px] text-slate-400 ml-3 font-medium uppercase tracking-wider">Urutkan</span>
                    <select x-model="sortBy" class="bg-transparent border-none text-sm font-medium text-slate-700 focus:ring-0 cursor-pointer pr-8">
                        <option value="newest">Terbaru</option>
                        <option value="price_asc">Harga Terendah</option>
                        <option value="price_desc">Harga Tertinggi</option>
                        <option value="dur_asc">Durasi Singkat</option>
                    </select>
                </div>
            </div>
        </header>

        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Sidebar Filter --}}
            <aside class="w-full lg:w-72 flex-shrink-0">
                <div class="sticky top-24 bg-white border border-slate-200/60 rounded-3xl p-6 shadow-sm shadow-slate-100/50 space-y-8">

                    {{-- Search --}}
                    <div>
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em] block mb-3 ml-1">Cari Itinerary</label>
                        <div class="relative group">
                            <input type="text" x-model="search" placeholder="Cari destinasi..."
                                class="w-full bg-slate-50 border-transparent rounded-2xl text-sm py-3 pl-11 focus:bg-white focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/5 transition-all outline-none placeholder:text-slate-400">
                            <svg class="absolute left-4 top-3.5 w-4 h-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Location Filters --}}
                    <div class="space-y-4">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em] block ml-1">Lokasi & Rute</label>

                        <div class="space-y-3">
                            <div class="relative">
                                <select x-model="filterNegara" class="appearance-none w-full bg-slate-50 border-transparent rounded-2xl text-sm py-3 px-4 focus:bg-white focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/5 transition-all cursor-pointer text-slate-700">
                                    <option value="">Semua Negara</option>
                                    <template x-for="n in negaraList()" :key="n">
                                        <option :value="n" x-text="n"></option>
                                    </template>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select x-model="filterStart" class="appearance-none w-full bg-slate-50 border-transparent rounded-2xl text-sm py-3 px-4 focus:bg-white focus:border-emerald-500/30 focus:ring-4 focus:ring-emerald-500/5 transition-all cursor-pointer text-slate-700">
                                    <option value="">Titik Keberangkatan</option>
                                    <template x-for="s in startList()" :key="s">
                                        <option :value="s" x-text="s"></option>
                                    </template>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Price Slider --}}
                    <div>
                        <div class="flex justify-between items-center mb-5">
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em] block ml-1">Budget Maks.</label>
                            <span class="text-[11px] font-bold text-emerald-700 bg-emerald-100/50 px-2.5 py-1 rounded-lg" x-text="'Rp ' + Number(priceMax).toLocaleString('id-ID')"></span>
                        </div>
                        <div class="px-1">
                            <input type="range" :min="priceMin" :max="priceAbsMax" step="50000" x-model="priceMax"
                                class="w-full h-1.5 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-emerald-600">
                            <div class="flex justify-between mt-3 px-0.5">
                                <span class="text-[9px] font-medium text-slate-400">Rp 0</span>
                                <span class="text-[9px] font-medium text-slate-400" x-text="'Rp ' + Number(priceAbsMax/1000000).toFixed(0) + 'jt+'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button @click="resetFilters()" class="w-full py-3 text-[11px] font-bold uppercase tracking-widest text-slate-400 hover:text-rose-600 border border-slate-200 border-dashed rounded-2xl hover:border-rose-200 hover:bg-rose-50/50 transition-all duration-300">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </aside>

            {{-- Main Grid --}}
            <main class="flex-1">
                {{-- Empty State --}}
                <template x-if="paginatedList().length === 0">
                    <div class="py-20 text-center bg-white rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-slate-400 font-light">Tidak menemukan itinerary yang sesuai rute Anda.</p>
                        <button @click="resetFilters()" class="mt-4 text-emerald-600 text-sm font-medium hover:underline">Lihat semua rencana</button>
                    </div>
                </template>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <template x-for="item in paginatedList()" :key="item.id">
                        <a :href="`/itinerary/${item.code}`" class="group flex flex-col bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-2xl hover:shadow-emerald-900/5 transition-all duration-500 hover:-translate-y-1">

                            {{-- Image Container --}}
                            <div class="relative h-52 overflow-hidden">
                                <img :src="item.image || '/images/default-itinerary.jpg'" :alt="item.title"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                                <span class="absolute bottom-4 left-4 bg-white/95 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-slate-800 shadow-sm" x-text="item.duration_days + ' HARI'"></span>
                            </div>

                            {{-- Card Content --}}
                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-[9px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded tracking-tighter" x-text="item.code"></span>
                                    <span class="text-[10px] text-slate-400" x-text="item.start_location"></span>
                                </div>

                                <h3 class="text-base font-semibold text-slate-800 mb-2 group-hover:text-emerald-700 transition-colors line-clamp-1" x-text="item.title"></h3>
                                <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-6 font-light" x-text="item.description"></p>

                                {{-- Meta Info --}}
                                <div class="mt-auto pt-5 border-t border-gray-50 flex items-center justify-between">
                                    <div>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-medium">Mulai dari</p>
                                        <p class="text-sm font-bold text-slate-900">Rp <span x-text="Number(item.price || 0).toLocaleString('id-ID')"></span></p>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-emerald-600 transition-colors">
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>

                {{-- Pagination --}}
                <template x-if="totalPages() > 1">
                    <nav class="mt-16 flex justify-center items-center gap-2">
                        <button @click="prevPage()" :disabled="currentPage === 1"
                            class="p-2 rounded-lg border border-gray-200 hover:bg-white disabled:opacity-20 transition-all text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-1">
                            <template x-for="p in pageNumbers()" :key="p">
                                <button @click="typeof p === 'number' && goToPage(p)"
                                    :class="p === currentPage ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-500 hover:bg-white'"
                                    class="w-10 h-10 rounded-lg text-sm font-medium transition-all"
                                    x-text="p">
                                </button>
                            </template>
                        </div>

                        <button @click="nextPage()" :disabled="currentPage === totalPages()"
                            class="p-2 rounded-lg border border-gray-200 hover:bg-white disabled:opacity-20 transition-all text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </nav>
                </template>
            </main>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }

    /* Smooth transition for range input */
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background: #059669;
        cursor: pointer;
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        transition: all 0.2s ease-in-out;
    }

    input[type=range]::-webkit-slider-thumb:hover {
        box-shadow: 0 0 0 8px rgba(5, 150, 105, 0.1);
        transform: scale(1.1);
    }
</style>

<script>
    function tourApp(raw) {
        return {
            search: '',
            activeDur: '',
            sortBy: 'newest',
            currentPage: 1,
            filterNegara: '',
            filterKota: '',
            filterStart: '',
            priceMin: 0,
            priceMax: 0,
            priceAbsMax: 0,

            durationChips: [{
                    val: '',
                    label: 'Semua durasi'
                },
                {
                    val: 'weekend',
                    label: '2–3 hari'
                },
                {
                    val: 'short',
                    label: '4–6 hari'
                },
                {
                    val: 'week',
                    label: '7–9 hari'
                },
                {
                    val: 'ext',
                    label: '10+ hari'
                },
            ],

            allItems: [],

            init() {
                this.allItems = (Array.isArray(raw) ? raw : [raw]).flat().map(t => ({
                    id: t.id,
                    code: t.code || t.title?.slice(0, 8),
                    title: t.title || '',
                    description: t.description || '',
                    duration_days: Number(t.duration_days || 1),
                    waypoints: t.waypoints || [],
                    status: t.status || 'draft',
                    price: Number(t.price || t.harga_final || 0),
                    image: t.image || null,
                    negara: t.negara || t.country || '',
                    kota: t.kota || t.city || '',
                    start_location: t.start_location || '',
                }));

                const prices = this.allItems.map(t => t.price).filter(p => p > 0);
                this.priceMin = 0;
                this.priceAbsMax = prices.length ? Math.max(...prices) : 10000000;
                this.priceMax = this.priceAbsMax;

                ['search', 'activeDur', 'sortBy', 'filterNegara', 'filterKota', 'filterStart', 'priceMax'].forEach(k => {
                    this.$watch(k, () => this.currentPage = 1);
                });
            },

            setDur(val) {
                this.activeDur = val;
            },

            getDurType(d) {
                if (d >= 10) return 'Panjang';
                if (d >= 7) return 'Menengah';
                if (d >= 4) return 'Standar';
                return 'Singkat';
            },

            negaraList() {
                return [...new Set(this.allItems.map(t => t.negara).filter(Boolean))].sort();
            },

            kotaList() {
                let items = this.allItems;
                if (this.filterNegara) items = items.filter(t => t.negara === this.filterNegara);
                return [...new Set(items.map(t => t.kota).filter(Boolean))].sort();
            },

            startList() {
                return [...new Set(this.allItems.map(t => t.start_location).filter(Boolean))].sort();
            },

            filteredList() {
                const q = this.search.toLowerCase();
                let list = this.allItems.filter(t => {
                    if (q && !(t.title + t.description).toLowerCase().includes(q)) return false;
                    const d = t.duration_days;
                    if (this.activeDur === 'weekend' && !(d >= 2 && d <= 3)) return false;
                    if (this.activeDur === 'short' && !(d >= 4 && d <= 6)) return false;
                    if (this.activeDur === 'week' && !(d >= 7 && d <= 9)) return false;
                    if (this.activeDur === 'ext' && d < 10) return false;
                    if (this.filterNegara && t.negara !== this.filterNegara) return false;
                    if (this.filterKota && t.kota !== this.filterKota) return false;
                    if (this.filterStart && t.start_location !== this.filterStart) return false;
                    if (t.price > 0 && t.price > Number(this.priceMax)) return false;
                    return true;
                });
                if (this.sortBy === 'dur_asc') list.sort((a, b) => a.duration_days - b.duration_days);
                else if (this.sortBy === 'dur_desc') list.sort((a, b) => b.duration_days - a.duration_days);
                else if (this.sortBy === 'price_asc') list.sort((a, b) => a.price - b.price);
                else if (this.sortBy === 'price_desc') list.sort((a, b) => b.price - a.price);
                return list;
            },

            paginatedList() {
                const per = 9;
                const start = (this.currentPage - 1) * per;
                return this.filteredList().slice(start, start + per);
            },

            totalPages() {
                return Math.max(1, Math.ceil(this.filteredList().length / 9));
            },

            pageNumbers() {
                const total = this.totalPages();
                const cur = this.currentPage;
                if (total <= 7) return Array.from({
                    length: total
                }, (_, i) => i + 1);
                const pages = [1];
                if (cur > 3) pages.push('…');
                for (let i = Math.max(2, cur - 1); i <= Math.min(total - 1, cur + 1); i++) pages.push(i);
                if (cur < total - 2) pages.push('…');
                pages.push(total);
                return pages;
            },

            prevPage() {
                if (this.currentPage > 1) this.currentPage--;
            },
            nextPage() {
                if (this.currentPage < this.totalPages()) this.currentPage++;
            },
            goToPage(p) {
                this.currentPage = p;
            },

            resetFilters() {
                this.search = '';
                this.activeDur = '';
                this.sortBy = 'newest';
                this.filterNegara = '';
                this.filterKota = '';
                this.filterStart = '';
                this.priceMax = this.priceAbsMax;
            },
        }
    }
</script>
@endsection