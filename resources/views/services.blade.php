@extends('main')

@section('content')

<div
    x-data='tourApp(@json($tours))'
    x-init="init()"
    class="min-h-screen text-gray-800 font-sans py-24">

    <div class="mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-10">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-semibold tracking-wide text-[#0B1D26]">
                Explore Indonesia
            </h1>

            <p class="mt-4 text-sm sm:text-base md:text-lg text-gray-600 max-w-2xl mx-auto px-4">
                Exclusive journeys curated with precision, taste, and quiet luxury.
            </p>

            <div class="mt-6 w-24 h-[2px] bg-gradient-to-r from-transparent via-[#C9A24D] to-transparent mx-auto"></div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Desktop Sidebar Filter (hidden on mobile/tablet) -->
            <aside
                class="hidden lg:block relative
                w-full lg:max-w-xs
                bg-gradient-to-b from-[#FAF9F6] to-white
                border border-[#E6D8A8]/40
                rounded-2xl lg:rounded-[28px]
                p-6 lg:p-8
                shadow-[0_20px_60px_-25px_rgba(201,162,77,0.35)]
                backdrop-blur-xl
                space-y-6 lg:space-y-8
                h-fit top-24
                sticky">

                <!-- Header -->
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-base lg:text-lg font-semibold tracking-wide text-[#0B1D26]">
                            Refine Your Journey
                        </h2>
                        <div class="mt-1 w-10 lg:w-12 h-[1px] bg-[#C9A24D]"></div>
                    </div>

                    <!-- Active filters indicator -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500"
                            x-show="activeFilterCount() > 0">
                            <span x-text="activeFilterCount()"></span> active
                        </span>
                        <button
                            @click="resetFilters()"
                            class="text-xs uppercase tracking-[0.25em]
                            text-[#9E7C32] hover:text-[#0B1D26] transition">
                            Reset
                        </button>
                    </div>
                </div>

                <!-- Destination -->
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-widest text-gray-500">
                        Destination
                    </label>
                    <input
                        type="text"
                        x-model="filters.destination"
                        placeholder="Bali, Flores, Raja Ampat"
                        class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white
                        focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]
                        placeholder:text-gray-400">
                </div>

                <!-- Duration -->
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-widest text-gray-500">
                        Duration
                    </label>
                    <select
                        x-model="filters.duration"
                        class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white
                        focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]">
                        <option value="">Any duration</option>
                        <option value="weekend">Weekend Escape (2-3 days)</option>
                        <option value="short">Short Break (4-6 days)</option>
                        <option value="week">One Week (7-9 days)</option>
                        <option value="extended">Extended Journey (10+ days)</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="space-y-3">
                    <label class="block text-xs uppercase tracking-widest text-gray-500">
                        Investment Range
                    </label>

                    <div class="flex items-center gap-3">
                        <input type="range"
                            min="200000"
                            max="20000000"
                            step="100000"
                            x-model="filters.harga_final"
                            class="flex-1 h-2 accent-[#C9A24D]">
                    </div>

                    <div class="text-sm font-medium text-[#0B1D26]">
                        Up to IDR <span x-text="Number(filters.harga_final).toLocaleString('id-ID')"></span>
                    </div>
                </div>

                <!-- Departure -->
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-widest text-gray-500">
                        Departure
                    </label>

                    <select
                        x-model="filters.departure"
                        class="w-full rounded-full px-4 lg:px-5 py-2.5 lg:py-3 text-sm
                        border border-[#E6D8A8]/60 bg-white
                        focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]">
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
                    <label class="block text-xs uppercase tracking-widest text-gray-500">
                        Signature Themes
                    </label>

                    <div class="grid grid-cols-1 gap-3">
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

            <!-- Tablet Filter Bar (hidden on mobile and desktop) -->
            <div class="lg:hidden">
                <div class="flex flex-wrap gap-2 mb-6 p-3 bg-white rounded-xl border border-[#E6D8A8]/40">
                    <!-- Filter Toggle Button for Tablet -->
                    <button
                        @click="openFilter = true"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full
                        bg-[#0B1D26] text-white text-sm font-medium
                        hover:bg-opacity-90 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter
                        <template x-if="activeFilterCount() > 0">
                            <span class="ml-1 px-1.5 py-0.5 text-xs bg-[#C9A24D] rounded-full"
                                x-text="activeFilterCount()"></span>
                        </template>
                    </button>

                    <!-- Active Filter Chips -->
                    <template x-if="filters.destination">
                        <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#FAF9F6] rounded-full text-sm">
                            <span class="text-[#0B1D26]" x-text="filters.destination"></span>
                            <button @click="filters.destination = ''" class="text-gray-400 hover:text-red-500">
                                ×
                            </button>
                        </div>
                    </template>

                    <template x-if="filters.duration">
                        <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#FAF9F6] rounded-full text-sm">
                            <span class="text-[#0B1D26]" x-text="getDurationLabel(filters.duration)"></span>
                            <button @click="filters.duration = ''" class="text-gray-400 hover:text-red-500">
                                ×
                            </button>
                        </div>
                    </template>

                    <template x-if="filters.themes.length > 0">
                        <div class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#FAF9F6] rounded-full text-sm">
                            <span class="text-[#0B1D26]">
                                <span x-text="filters.themes.length"></span> themes
                            </span>
                            <button @click="filters.themes = []" class="text-gray-400 hover:text-red-500">
                                ×
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Mobile Filter Modal -->
            <div
                x-show="openFilter"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-full"
                x-transition:enter-end="translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full"
                @click.away="openFilter = false"
                x-cloak
                class="fixed inset-0 z-50 lg:hidden"
                style="background-color: rgba(0,0,0,0.5);">

                <div class="absolute bottom-0 inset-x-0
                    bg-gradient-to-b from-[#FAF9F6] to-white
                    rounded-t-3xl
                    max-h-[85vh] overflow-y-auto
                    p-5 space-y-6 shadow-2xl">

                    <!-- drag handle -->
                    <div class="w-12 h-1.5 bg-gray-300 rounded-full mx-auto mb-2"></div>

                    <!-- header -->
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-[#0B1D26]">
                            Refine Your Journey
                        </h2>
                        <div class="flex items-center gap-3">
                            <button
                                @click="resetFilters()"
                                class="text-sm text-[#9E7C32] hover:text-[#0B1D26]">
                                Reset
                            </button>
                            <button
                                @click="openFilter = false"
                                class="text-sm text-gray-500 hover:text-[#0B1D26]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Filter Content -->
                    <div class="space-y-5 pb-6">
                        <!-- Destination -->
                        <div class="space-y-2">
                            <label class="block text-xs uppercase tracking-widest text-gray-500">
                                Destination
                            </label>
                            <input
                                type="text"
                                x-model="filters.destination"
                                placeholder="Bali, Flores, Raja Ampat"
                                class="w-full rounded-full px-4 py-3 text-sm
                                border border-[#E6D8A8]/60 bg-white
                                focus:ring-2 focus:ring-[#C9A24D]/40 focus:border-[#C9A24D]">
                        </div>

                        <!-- Duration -->
                        <div class="space-y-2">
                            <label class="block text-xs uppercase tracking-widest text-gray-500">
                                Duration
                            </label>
                            <select
                                x-model="filters.duration"
                                class="w-full rounded-full px-4 py-3 text-sm
                                border border-[#E6D8A8]/60 bg-white">
                                <option value="">Any duration</option>
                                <option value="weekend">Weekend Escape (2-3 days)</option>
                                <option value="short">Short Break (4-6 days)</option>
                                <option value="week">One Week (7-9 days)</option>
                                <option value="extended">Extended Journey (10+ days)</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="space-y-3">
                            <label class="block text-xs uppercase tracking-widest text-gray-500">
                                Investment Range
                            </label>

                            <input type="range"
                                min="200000"
                                max="20000000"
                                step="100000"
                                x-model="filters.harga_final"
                                class="w-full h-2 accent-[#C9A24D]">

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">IDR 200K</span>
                                <span class="font-medium text-[#0B1D26]">
                                    IDR <span x-text="Number(filters.harga_final).toLocaleString('id-ID')"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Departure -->
                        <div class="space-y-2">
                            <label class="block text-xs uppercase tracking-widest text-gray-500">
                                Departure
                            </label>

                            <select
                                x-model="filters.departure"
                                class="w-full rounded-full px-4 py-3 text-sm
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
                                class="w-full mt-2 rounded-full px-4 py-3 text-sm
                                border border-[#E6D8A8]/60 bg-white">
                        </div>

                        <!-- Themes -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs uppercase tracking-widest text-gray-500">
                                    Signature Themes
                                </label>
                                <button
                                    @click="filters.themes = []"
                                    class="text-xs text-[#9E7C32] hover:text-[#0B1D26]">
                                    Clear
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <template x-for="theme in themes" :key="theme.key">
                                    <label class="flex gap-3 items-start text-sm cursor-pointer p-3 rounded-lg border border-[#E6D8A8]/40 hover:border-[#C9A24D] transition">
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

                        <!-- Action Buttons -->
                        <div class="flex gap-3 pt-4 border-t border-[#E6D8A8]/40">
                            <button
                                @click="resetFilters()"
                                class="flex-1 rounded-full px-4 py-3 text-sm
                                border border-[#E6D8A8] text-[#9E7C32]
                                hover:bg-[#FAF9F6]">
                                Reset Filters
                            </button>
                            <button
                                @click="openFilter = false"
                                class="flex-1 rounded-full px-4 py-3 text-sm
                                bg-[#0B1D26] text-white
                                hover:bg-opacity-90">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 space-y-8">
                <!-- Search Bar with Filter Button (Mobile) -->
                <div class="relative">
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="relative flex-1 w-full">
                            <input
                                type="text"
                                x-model="search"
                                placeholder="Search destinations or journeys..."
                                class="w-full rounded-full px-6 py-4 text-sm sm:text-base
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

                        <!-- Results Count and Filter Button (Mobile) -->
                        <div class="flex items-center justify-between w-full sm:w-auto gap-4">
                            <div class="text-sm text-gray-600 whitespace-nowrap">
                                <span x-text="filteredTours().length"></span> journeys found
                            </div>

                            <!-- Mobile Filter Button (only on mobile) -->
                            <button
                                @click="openFilter = true"
                                class="sm:hidden flex items-center gap-2
                                px-4 py-2 rounded-full
                                bg-[#0B1D26] text-white text-sm font-medium
                                hover:bg-opacity-90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                </svg>
                                Filter
                                <template x-if="activeFilterCount() > 0">
                                    <span class="ml-1 px-1.5 py-0.5 text-xs bg-[#C9A24D] rounded-full"
                                        x-text="activeFilterCount()"></span>
                                </template>
                            </button>
                        </div>
                    </div>

                    <!-- Active Filters for Mobile -->
                    <div class="mt-3 flex flex-wrap gap-2" x-show="activeFilterCount() > 0">
                        <template x-if="filters.destination">
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#FAF9F6] rounded-full text-sm">
                                Destination: <span x-text="filters.destination" class="font-medium"></span>
                                <button @click="filters.destination = ''" class="text-gray-400 hover:text-red-500 ml-1">
                                    ×
                                </button>
                            </span>
                        </template>
                        <template x-if="filters.duration">
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#FAF9F6] rounded-full text-sm">
                                Duration: <span x-text="getDurationLabel(filters.duration)" class="font-medium"></span>
                                <button @click="filters.duration = ''" class="text-gray-400 hover:text-red-500 ml-1">
                                    ×
                                </button>
                            </span>
                        </template>
                        <template x-if="filters.harga_final < 20000000">
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-[#FAF9F6] rounded-full text-sm">
                                Max: IDR <span x-text="Number(filters.harga_final).toLocaleString('id-ID')" class="font-medium"></span>
                                <button @click="filters.harga_final = 20000000" class="text-gray-400 hover:text-red-500 ml-1">
                                    ×
                                </button>
                            </span>
                        </template>
                    </div>
                </div>

                <!-- No Results -->
                <template x-if="filteredTours().length === 0">
                    <div class="text-center py-16">
                        <div class="text-gray-300 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-lg text-gray-400 mb-2">No journeys match your preferences</p>
                        <button
                            @click="resetFilters()"
                            class="text-sm text-[#C9A24D] hover:text-[#0B1D26] underline">
                            Reset filters to see all journeys
                        </button>
                    </div>
                </template>

                <!-- Tours Grid -->
                <div class="space-y-6 sm:space-y-8">
                    <template x-for="(tour, i) in paginatedTours()" :key="tour.id + '-' + i">
                        <div
                            class="group bg-white rounded-2xl md:rounded-[28px] overflow-hidden
                            shadow-lg hover:shadow-2xl
                            hover:-translate-y-1 transition-all duration-500
                            flex flex-col md:flex-row">

                            <div class="relative w-full md:w-2/5 lg:w-1/3 h-64 sm:h-72 md:h-auto">
                                <img
                                    :src="tour.image"
                                    :alt="tour.name"
                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>

                                <div class="absolute top-4 left-4
                                    bg-gradient-to-r from-[#9E7C32] via-[#C9A24D] to-[#F5E6B8]
                                    text-[#0B1D26] text-xs font-semibold
                                    rounded-full px-3 py-1 shadow">
                                    <span x-text="tour.negara"></span>
                                </div>

                                <div class="absolute bottom-4 right-4
                                    bg-[#0B1D26] text-[#F5E6B8]
                                    rounded-xl sm:rounded-2xl px-3 sm:px-4 py-1.5 sm:py-2 
                                    text-xs sm:text-sm font-medium">
                                    IDR <span x-text="Number(tour.harga_final).toLocaleString('id-ID')"></span>
                                </div>
                            </div>

                            <div class="flex-1 p-6 md:p-8 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl sm:text-2xl font-semibold text-[#0B1D26]"
                                        x-text="tour.name"></h3>

                                    <div class="text-xs tracking-wide text-gray-400 mt-1">
                                        <span x-text="'#' + tour.kode"></span>
                                        <span class="mx-2">•</span>
                                        <span x-text="tour.duration_days + ' days'"></span>
                                    </div>

                                    <div class="mt-3 text-sm text-gray-500">
                                        Tour Type:
                                        <span class="font-medium text-[#9E7C32]"
                                            x-text="tour.type"></span>
                                    </div>

                                    <div class="mt-3 text-sm text-gray-600 line-clamp-2"
                                        x-text="tour.description"></div>
                                </div>

                                <!-- Action -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-6 gap-4">

                                    <div class="text-right md:order-2">
                                        <div class="text-xs text-gray-400">Starting from</div>
                                        <div class="text-lg font-semibold text-[#0B1D26]">
                                            IDR <span x-text="Number(tour.harga_final).toLocaleString('id-ID')"></span>
                                        </div>
                                        <div class="text-xs text-gray-400">per person</div>
                                    </div>

                                    <a
                                        :href="`/tour/detail/${tour.kode}`"
                                        class="inline-flex items-center justify-center rounded-full px-6 py-3
                                        border border-[#C9A24D]
                                        bg-[#0B1D26]
                                        text-[#C9A24D] text-sm tracking-wide
                                        hover:bg-[#C9A24D] hover:text-[#0B1D26]
                                        transition text-center">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Pagination -->
                <template x-if="totalPages() > 1">
                    <div class="flex flex-wrap justify-center mt-12 gap-2 sm:gap-3 items-center select-none">

                        <button
                            @click="prevPage()"
                            :disabled="currentPage === 1"
                            class="px-3 sm:px-4 py-2 rounded-full text-sm
                            border border-[#E6D8A8] text-[#0B1D26]
                            hover:bg-[#FAF9F6] disabled:opacity-40 disabled:cursor-not-allowed">
                            ← Prev
                        </button>

                        <button
                            @click="goToPage(1)"
                            :class="currentPage === 1
                            ? 'bg-[#0B1D26] text-[#F5E6B8]'
                            : 'bg-white border border-[#E6D8A8] text-[#0B1D26]'"
                            class="px-3 sm:px-4 py-2 rounded-full text-sm transition min-w-[40px]">
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
                                class="px-3 sm:px-4 py-2 rounded-full text-sm transition min-w-[40px]">
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
                            class="px-3 sm:px-4 py-2 rounded-full text-sm transition min-w-[40px]">
                            <span x-text="totalPages()"></span>
                        </button>

                        <button
                            @click="nextPage()"
                            :disabled="currentPage === totalPages()"
                            class="px-3 sm:px-4 py-2 rounded-full text-sm
                            border border-[#E6D8A8] text-[#0B1D26]
                            hover:bg-[#FAF9F6] disabled:opacity-40 disabled:cursor-not-allowed">
                            Next →
                        </button>
                    </div>
                </template>

            </main>

        </div>
    </div>
</div>

<script>
    function tourApp(serverData) {
        return {
            openFilter: false,
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
                    // Hitung jumlah hari dari itinerary
                    let days = 0;

                    if (Array.isArray(t.itinerary)) {
                        days = t.itinerary.length;
                    } else if (typeof t.itinerary === 'string') {
                        const matches = t.itinerary.match(/day\s*\d+/gi);
                        days = matches ? matches.length : 0;
                    }

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
                this.openFilter = false;
            },

            // New helper methods
            activeFilterCount() {
                let count = 0;
                if (this.filters.destination) count++;
                if (this.filters.duration) count++;
                if (this.filters.harga_final < 20000000) count++;
                if (this.filters.departure) count++;
                if (this.filters.themes.length > 0) count++;
                return count;
            },

            getDurationLabel(value) {
                const labels = {
                    'weekend': 'Weekend Escape',
                    'short': 'Short Break',
                    'week': 'One Week',
                    'extended': 'Extended Journey'
                };
                return labels[value] || value;
            },

            filteredTours() {
                return this.filtered.filter(t => {
                    // Search filter
                    if (this.search) {
                        const q = this.search.toLowerCase();
                        const searchable = (t.name + t.kota + t.negara + t.description).toLowerCase();
                        if (!searchable.includes(q)) return false;
                    }

                    // Destination filter
                    if (this.filters.destination) {
                        const d = this.filters.destination.toLowerCase();
                        if (!(t.kota.toLowerCase().includes(d) || t.negara.toLowerCase().includes(d))) return false;
                    }

                    // Price filter
                    if (t.harga_final > this.filters.harga_final) return false;

                    // Duration filter
                    if (this.filters.duration) {
                        const d = Number(t.duration_days || 0);
                        if (this.filters.duration === 'weekend' && !(d >= 2 && d <= 3)) return false;
                        if (this.filters.duration === 'short' && !(d >= 4 && d <= 6)) return false;
                        if (this.filters.duration === 'week' && !(d >= 7 && d <= 9)) return false;
                        if (this.filters.duration === 'extended' && d < 10) return false;
                    }

                    // Departure filter
                    if (this.filters.departure === 'soon' && t.departure_date) {
                        const diff = (new Date(t.departure_date) - new Date()) / 86400000;
                        if (diff < 0 || diff > 30) return false;
                    }

                    if (this.filters.departure === 'specific' && this.filters.departure_date) {
                        if (t.departure_date !== this.filters.departure_date) return false;
                    }

                    // Themes filter
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
            }
        }
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Prevent body scroll when modal is open */
    body.modal-open {
        overflow: hidden;
    }

    /* Custom scrollbar for modal */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #c9a24d;
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #9e7c32;
    }
</style>

@endsection