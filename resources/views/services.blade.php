@extends('main', ['excludeNavbar' => true])
@include('layout.navbarserv')

@section('content')

<div x-data="tourApp()" x-init="init()" class="min-h-screen text-gray-800 font-sans py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-5xl font-extrabold text-[#03293E] tracking-tight drop-shadow-sm">Explore Indonesia</h1>
            <p class="text-gray-500 text-sm md:text-lg mt-3 max-w-2xl mx-auto">Premium, handpicked itineraries across the archipelago — curated with elegance and expertise.</p>
        </div>
        <div class="flex flex-col md:flex-row gap-10">
            <aside class="hidden md:block w-full md:w-80 bg-white/70 backdrop-blur-md border border-gray-100 rounded-2xl p-6 space-y-6 shadow-lg sticky top-28 h-fit">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-[#0B0B0B]">Refine Packages</h2> <button @click="filters = { destination:'', category:'', type:'', price:4000, start:'', end:'' }, search='', currentPage=1" class="text-sm text-[#3B5BDB] hover:underline">Reset</button>
                </div>
                <div class="space-y-2"> 
                    <label class="text-sm font-medium text-gray-600 flex items-center gap-2"> <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM12 14c4.418 0 8 1.79 8 4v2H4v-2c0-2.21 3.582-4 8-4z" />
                        </svg> Max Price ($) </label> <input type="range" min="200" max="4000" step="100" x-model="filters.price" class="w-full accent-[#3B5BDB] mt-2">
                    <p class="text-sm text-gray-500 mt-1">$<span x-text="filters.price"></span></p>
                </div>
                <div class="space-y-2"> 
                    <label class="text-sm font-medium text-gray-600 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7l6 6-6 6M21 7l-6 6 6 6" />
                        </svg> Destination 
                    </label>
                    <select x-model="filters.destination" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-[#3B5BDB]">
                        <option value="">All</option>
                        <template x-for="country in availableCountries()" :key="country">
                            <option x-text="country"></option>
                        </template>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-sm font-medium text-gray-600">Category</label>
                        <select x-model="filters.category" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-[#3B5BDB]">
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
                        <select x-model="filters.type" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-[#3B5BDB]">
                            <option value="">All</option>
                            <option>Private</option>
                            <option>Group</option>
                            <option>Custom</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Start</label>
                    <input type="text" x-model="filters.start" placeholder="e.g. Jakarta" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-[#3B5BDB]">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">End</label>
                    <input type="text" x-model="filters.end" placeholder="e.g. Bali" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-[#3B5BDB]">
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
                        <div class="space-y-2"> <label class="text-sm font-medium text-gray-600">Max Price ($)</label> <input type="range" min="200" max="4000" step="100" x-model="filters.price" class="w-full accent-[#3B5BDB] mt-2">
                            <p class="text-sm text-gray-500 mt-1">$<span x-text="filters.price"></span></p>
                        </div>
                        <div> <label class="text-sm font-medium text-gray-600">Destination</label> <select x-model="filters.destination" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                                <option value="">All</option> <template x-for="country in availableCountries()" :key="country">
                                    <option x-text="country"></option>
                                </template>
                            </select> </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div> <label class="text-sm font-medium text-gray-600">Category</label> <select x-model="filters.category" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                                    <option value="">All</option>
                                    <option>Adventure</option>
                                    <option>Culture</option>
                                    <option>Religious</option>
                                    <option>Nature</option>
                                    <option>Luxury</option>
                                </select> </div>
                            <div> <label class="text-sm font-medium text-gray-600">Tour Type</label> <select x-model="filters.type" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm">
                                    <option value="">All</option>
                                    <option>Private</option>
                                    <option>Group</option>
                                    <option>Custom</option>
                                </select> </div>
                        </div>
                        <div> <label class="text-sm font-medium text-gray-600">Start</label> <input type="text" x-model="filters.start" placeholder="e.g. Jakarta" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm"> </div>
                        <div> <label class="text-sm font-medium text-gray-600">End</label> <input type="text" x-model="filters.end" placeholder="e.g. Bali" class="mt-2 w-full bg-white border border-gray-200 rounded-xl py-2.5 px-3 text-sm"> </div>
                        <div class="flex justify-between items-center mt-2"> <button @click="filters = { destination:'', category:'', type:'', price:4000, start:'', end:'' }, search='', currentPage=1" class="px-4 py-2 rounded-lg bg-gray-100 text-sm">Reset</button> <button @click="mobileOpen=false" class="px-4 py-2 rounded-lg bg-[#3B5BDB] text-white text-sm">Apply</button> </div>
                    </div>
                </aside>
            </div>
            <main class="flex-1 space-y-6">
                <div class="relative">
                    <div class="flex gap-3 items-center"> <input type="text" x-model="search" placeholder="Search destinations or tours..." class="flex-1 bg-white border border-gray-200 rounded-2xl py-3 px-4 text-sm shadow-sm focus:ring-2 focus:ring-[#3B5BDB]">
                        <div class="flex items-center gap-3"> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hidden sm:inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35m1.35-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg> <span class="text-xs text-gray-400 hidden sm:inline">Press Enter to search</span> <!-- Mobile filter toggle --> <button @click="mobileOpen = true" class="md:hidden p-2 bg-white border rounded-lg shadow-sm" aria-label="Open filters"> <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-1.447.894L9 17l-4.26 2.894A1 1 0 013 19V4z" />
                                </svg> </button> </div>
                    </div>
                </div> <template x-if="filteredTours().length === 0">
                    <p class="text-gray-500 text-center mt-10">No tours match your filters.</p>
                </template> <template x-for="tour in paginatedTours()" :key="tour.name">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col md:flex-row transition-all duration-500 hover:-translate-y-2 hover:shadow-xl group">
                        <div class="relative w-full md:w-1/3 h-64 md:h-auto flex-shrink-0"> <img :src="tour.image" :alt="tour.name" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute left-4 top-4 bg-white/90 text-xs text-gray-700 rounded-xl px-3 py-1 font-medium flex items-center gap-2 shadow"> <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.272 3.905a1 1 0 00.95.69h4.11c.969 0 1.371 1.24.588 1.81l-3.327 2.42a1 1 0 00-.364 1.118l1.272 3.905c.3.921-.755 1.688-1.54 1.118L10 15.347l-3.711 2.346c-.784.57-1.839-.197-1.54-1.118l1.272-3.905a1 1 0 00-.364-1.118L2.33 9.332c-.783-.57-.38-1.81.588-1.81h4.11a1 1 0 00.95-.69L9.05 2.927z" />
                                </svg> <span x-text="tour.category"></span> </div>
                            <div class="absolute right-4 bottom-4 bg-gradient-to-r from-[#3B5BDB] to-[#2E49B0] text-white text-sm font-semibold rounded-2xl px-4 py-2 shadow-lg"> <span class="text-xs mr-1">From</span> $<span x-text="tour.price"></span> </div>
                        </div>
                        <div class="flex-1 p-6 flex flex-col justify-between">
                            <div>
                                <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-xl md:text-2xl font-semibold text-[#0B0B0B]" x-text="tour.name"></h3>
                                        <p class="text-sm text-gray-500 mt-1 flex items-center gap-3"> <span class="inline-flex items-center gap-2"> <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM12 14c4.418 0 8 1.79 8 4v2H4v-2c0-2.21 3.582-4 8-4z" />
                                                </svg> <span x-text="tour.destination"></span> </span> <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs" x-text="tour.duration"></span> </p>
                                    </div>
                                    <div class="text-right mt-3 md:mt-0">
                                        <div class="text-sm text-gray-500">Type</div>
                                        <div class="mt-1 text-sm font-medium text-[#3B5BDB]" x-text="tour.type"></div>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm mt-4 leading-relaxed" x-text="tour.description"></p>
                                <div class="mt-4 flex flex-wrap gap-3 text-xs text-gray-500">
                                    <div class="flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full"> <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M8 3v4M16 3v4" />
                                        </svg> <span x-text="tour.start"></span> </div>
                                    <div class="flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full"> <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6M7 8H5a2 2 0 00-2 2v6" />
                                        </svg> <span x-text="tour.end"></span> </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 mt-6"> <a href="Details" class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-[#3B5BDB] to-[#2E49B0] text-white text-sm font-semibold hover:from-[#2E49B0] hover:to-[#243b91] transition shadow"> View Details </a> <a href="#" class="px-5 py-2.5 rounded-lg border border-[#3B5BDB] text-[#3B5BDB] text-sm font-medium hover:bg-[#3B5BDB] hover:text-white transition"> Book Now </a>
                                <div class="ml-auto text-right text-xs text-gray-400">
                                    <div class="font-semibold text-gray-700" x-text="'$' + tour.price"></div>
                                    <div class="text-[11px]">per person</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="flex flex-wrap justify-center mt-6 gap-3 items-center"> <button @click="prevPage()" :disabled="currentPage===1" class="px-4 py-2 border rounded-full text-gray-600 hover:bg-blue-50 disabled:opacity-40">← Prev</button> <template x-for="page in totalPages()" :key="page"> <button @click="goToPage(page)" :class="{'bg-[#3B5BDB] text-white': currentPage === page, 'bg-white border text-gray-600': currentPage !== page}" class="px-3 md:px-4 py-2 rounded-full font-medium shadow-sm transition"> <span x-text="page"></span> </button> </template> <button @click="nextPage()" :disabled="currentPage===totalPages().length" class="px-4 py-2 border rounded-full text-gray-600 hover:bg-blue-50 disabled:opacity-40">Next →</button> </div>
            </main>
        </div>
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tourApp', () => ({
            search: '',
            mobileOpen: false,
            filters: {
                destination: '',
                category: '',
                type: '',
                price: 4000,
                start: '',
                end: ''
            },
            currentPage: 1,
            itemsPerPage: 6,
            tours: [{
                name: "Bali Paradise Experience",
                destination: "Bali",
                duration: "5D4N",
                price: 450,
                category: "Culture",
                type: "Private",
                start: "Denpasar",
                end: "Ubud",
                description: "Nikmati pesona Pulau Dewata dengan kunjungan ke Uluwatu, Tanah Lot, dan pengalaman spa mewah di resort terbaik.",
                image: "https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
            }, {
                name: "Lombok Hidden Paradise",
                destination: "Lombok",
                duration: "4D3N",
                price: 380,
                category: "Adventure",
                type: "Group",
                start: "Lombok International Airport",
                end: "Senggigi",
                description: "Temukan keindahan Gili Trawangan, air terjun Sendang Gile, dan kehidupan lokal Sasak yang hangat dan ramah.",
                image: "https://images.unsplash.com/photo-1605752660759-2db7b7de8fa9?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070"
            }, {
                name: "Labuan Bajo Explorer",
                destination: "Labuan Bajo",
                duration: "4D3N",
                price: 620,
                category: "Adventure",
                type: "Private",
                start: "Labuan Bajo Port",
                end: "Komodo Island",
                description: "Berlayar di antara pulau-pulau eksotis, snorkeling di Pink Beach, dan menyaksikan komodo di habitat aslinya.",
                image: "https://images.unsplash.com/photo-1619880889144-d6e252999afa?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1974"
            }, {
                name: "Yogyakarta Heritage Tour",
                destination: "Yogyakarta",
                duration: "3D2N",
                price: 290,
                category: "Culture",
                type: "Group",
                start: "YIA Airport",
                end: "Malioboro",
                description: "Menelusuri Candi Borobudur, Prambanan, dan wisata batik serta kuliner khas Jogja.",
                image: "https://images.unsplash.com/photo-1596402184320-417e7178b2cd?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070"
            }, {
                name: "Raja Ampat Diving Experience",
                destination: "Raja Ampat",
                duration: "6D5N",
                price: 980,
                category: "Nature",
                type: "Private",
                start: "Sorong",
                end: "Piaynemo",
                description: "Rasakan surga bawah laut terbaik dunia di Raja Ampat dengan pengalaman diving tak terlupakan.",
                image: "https://images.unsplash.com/photo-1703769605297-cc74106244d9?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2084"
            }, {
                name: "Bandung Family Getaway",
                destination: "Bandung",
                duration: "3D2N",
                price: 240,
                category: "Culture",
                type: "Group",
                start: "Bandung",
                end: "Lembang",
                description: "Liburan keluarga ke Farm House, Dusun Bambu, dan wisata kuliner Dago serta Braga yang legendaris.",
                image: "https://images.unsplash.com/photo-1549473889-14f410d83298?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070"
            }, {
                name: "Bromo Sunrise Journey",
                destination: "Bromo",
                duration: "2D1N",
                price: 260,
                category: "Adventure",
                type: "Group",
                start: "Malang",
                end: "Bromo",
                description: "Nikmati panorama matahari terbit di lautan pasir Bromo dengan jeep safari eksklusif.",
                image: "https://images.unsplash.com/photo-1589277683134-e0fc4231addf?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070"
            }, {
                name: "Belitung Island Escape",
                destination: "Belitung",
                duration: "3D2N",
                price: 340,
                category: "Nature",
                type: "Private",
                start: "Tanjung Pandan",
                end: "Lengkuas Island",
                description: "Eksplorasi pulau-pulau granit, snorkeling, dan menikmati kuliner seafood segar khas Belitung.",
                image: "https://images.unsplash.com/photo-1584775117656-0f4477c09af2?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1931"
            }, {
                name: "Lake Toba Retreat",
                destination: "Sumatra",
                duration: "4D3N",
                price: 410,
                category: "Culture",
                type: "Private",
                start: "Medan",
                end: "Samosir",
                description: "Kunjungi Danau Toba yang megah, budaya Batak yang kaya, dan panorama alam yang menenangkan.",
                image: "https://images.unsplash.com/photo-1601058497548-f247dfe349d6?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070"
            }, {
                name: "Makassar Culinary Tour",
                destination: "Makassar",
                duration: "3D2N",
                price: 310,
                category: "Culture",
                type: "Group",
                start: "Hasanuddin Airport",
                end: "Losari Beach",
                description: "Wisata kuliner khas Makassar: Coto, Pallubasa, Konro, dan sunset di Pantai Losari.",
                image: "https://images.unsplash.com/photo-1657385503989-27ff883db33f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2012"
            }, ],
            init() {},
            availableCountries() {
                return [...new Set(this.tours.map(t => t.destination))];
            },
            filteredTours() {
                return this.tours.filter(t => t.name.toLowerCase().includes(this.search.toLowerCase()) && (!this.filters.destination || t.destination === this.filters.destination) && (!this.filters.category || t.category === this.filters.category) && (!this.filters.type || t.type === this.filters.type) && t.price <= this.filters.price && (!this.filters.start || t.start.toLowerCase().includes(this.filters.start.toLowerCase())) && (!this.filters.end || t.end.toLowerCase().includes(this.filters.end.toLowerCase())));
            },
            totalPages() {
                return Array.from({
                    length: Math.ceil(this.filteredTours().length / this.itemsPerPage)
                }, (_, i) => i + 1);
            },
            paginatedTours() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                return this.filteredTours().slice(start, start + this.itemsPerPage);
            },
            goToPage(p) {
                this.currentPage = p;
            },
            nextPage() {
                if (this.currentPage < this.totalPages().length) this.currentPage++;
            },
            prevPage() {
                if (this.currentPage > 1) this.currentPage--;
            },
        }))
    });
</script>

@endsection