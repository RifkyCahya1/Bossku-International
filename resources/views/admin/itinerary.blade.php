@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="flex min-h-screen bg-gray-50 font-['Plus_Jakarta_Sans',sans-serif]">

    @include('admin.Layout.sidebar')

    <main class="flex-1 overflow-x-hidden px-5 py-6 sm:px-7 sm:py-7 lg:px-9 lg:py-8">

        {{-- Mobile topbar --}}
        <div class="flex items-center gap-3 mb-6 lg:hidden">
            <button id="toggleSidebar" class="w-10 h-10 rounded-xl bg-white border border-black/5 shadow-sm flex items-center justify-center text-gray-600 hover:bg-gray-50 transition">
                <i class="fa-solid fa-bars text-sm"></i>
            </button>
            <div>
                <h1 class="text-lg font-extrabold text-gray-900 leading-tight">Itinerary Builder</h1>
                <p class="text-xs text-gray-500">Buat & kelola rencana perjalanan</p>
            </div>
        </div>

        {{-- Desktop header --}}
        <div class="hidden lg:flex items-end justify-between mb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Itinerary Builder</h1>
                <p class="text-sm text-gray-500 mt-0.5">Buat dan kelola rencana perjalanan dengan mudah</p>
            </div>
            <div class="flex items-center gap-3">
                <button id="exportItineraryBtn" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-gray-700 text-sm font-medium hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export PDF
                </button>
                <button id="newItineraryBtn" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New Itinerary
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-7">
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#D4F5EE] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#05796A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#D4F5EE] text-[#05796A] px-2 py-0.5 rounded-full">Total</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="totalItineraries">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Itinerary Aktif</p>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#EDEDFF] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#5B5BD6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#EDEDFF] text-[#5B5BD6] px-2 py-0.5 rounded-full">Bulan Ini</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="newThisMonth">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Itinerary Baru</p>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#FFF3C4] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#A07800]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#FFF3C4] text-[#A07800] px-2 py-0.5 rounded-full">Destinasi</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="totalDestinations">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Tujuan Wisata</p>
            </div>

            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/5 shadow-sm hover:shadow-md transition-all duration-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-[#FFE8E8] flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#CC3B3B]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold bg-[#FFE8E8] text-[#CC3B3B] px-2 py-0.5 rounded-full">Hari</span>
                </div>
                <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight" id="totalDays">0</p>
                <p class="text-xs text-gray-400 mt-0.5">Total Hari Perjalanan</p>
            </div>
        </div>

        {{-- Search & Filter Section --}}
        <div class="bg-white rounded-2xl border border-black/5 shadow-sm mb-7 overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" id="searchItinerary" placeholder="Cari itinerary berdasarkan judul atau destinasi..."
                            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20 transition">
                    </div>
                    <div class="flex gap-3">
                        <select id="statusFilter" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 text-sm focus:outline-none focus:border-[#0ABFA3]">
                            <option value="">All Status</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                        <button id="resetFilterBtn" class="px-4 py-2.5 bg-gray-100 rounded-xl text-gray-600 text-sm font-medium hover:bg-gray-200 transition">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Itinerary List & Builder Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">

            {{-- Left Sidebar: Itinerary List --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden sticky top-28">
                    <div class="p-5 border-b border-gray-100">
                        <h2 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#0ABFA3] shrink-0"></span>
                            Daftar Itinerary
                        </h2>
                    </div>
                    <div id="itineraryList" class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto custom-scrollbar">
                        <!-- Data akan diisi JavaScript -->
                        <div class="p-8 text-center text-gray-400 text-sm">
                            Loading...
                        </div>
                    </div>
                    <div class="p-4 border-t border-gray-100 bg-gray-50">
                        <button id="createNewBtn" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Itinerary Baru
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Side: Itinerary Builder --}}
            <div class="lg:col-span-2">
                <div id="emptyState" class="bg-white rounded-2xl border border-black/5 shadow-sm p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Itinerary Dipilih</h3>
                    <p class="text-sm text-gray-500 mb-4">Pilih itinerary dari daftar atau buat itinerary baru</p>
                    <button onclick="openItineraryModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Itinerary Baru
                    </button>
                </div>

                <div id="builderContent" class="hidden">
                    {{-- Itinerary Header --}}
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm mb-5 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gradient-to-r from-gray-50 to-white">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <h2 id="itineraryTitle" class="text-xl font-bold text-gray-900">Itinerary Title</h2>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span id="itineraryDestination" class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span id="destValue">-</span>
                                        </span>
                                        <span id="itineraryDuration" class="inline-flex items-center gap-1.5 text-sm text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span id="durationValue">0</span> hari
                                        </span>
                                        <span id="itineraryStatus" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            <span id="statusValue">Draft</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="editItineraryInfo()" class="p-2 text-gray-400 hover:text-[#0ABFA3] transition rounded-lg hover:bg-[#D4F5EE]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button id="publishItineraryBtn" class="px-4 py-2 bg-[#0ABFA3] text-white rounded-xl text-sm font-medium hover:bg-[#05796A] transition">
                                        Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Days Navigation --}}
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm mb-5 overflow-x-auto">
                        <div id="daysNav" class="flex border-b border-gray-100 min-w-max">
                            <!-- Days will be inserted here -->
                        </div>
                    </div>

                    {{-- Activities for Selected Day --}}
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-base font-bold text-gray-900">
                                    Day <span id="currentDayNum">1</span>
                                </h3>
                                <p id="currentDayTitle" class="text-sm text-gray-500 mt-0.5">Day title</p>
                            </div>
                            <button onclick="openActivityModal()" class="inline-flex items-center gap-2 px-3 py-1.5 bg-[#0ABFA3]/10 text-[#05796A] rounded-lg text-sm font-medium hover:bg-[#0ABFA3]/20 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Aktivitas
                            </button>
                        </div>
                        <div id="activitiesList" class="divide-y divide-gray-100">
                            <!-- Activities will be inserted here -->
                            <div class="p-8 text-center text-gray-400 text-sm">
                                Belum ada aktivitas. Klik "Tambah Aktivitas" untuk menambahkan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

{{-- Itinerary Form Modal --}}
<div id="itineraryModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between">
            <h3 id="itineraryModalTitle" class="text-lg font-bold text-gray-900">Buat Itinerary Baru</h3>
            <button onclick="closeItineraryModal()" class="p-1 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="itineraryForm" class="p-6 space-y-5">
            @csrf
            <input type="hidden" id="itineraryId" name="id">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Itinerary *</label>
                <input type="text" id="itineraryJudul" name="title" required
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Destinasi Utama *</label>
                    <input type="text" id="itineraryDestination" name="destination" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari) *</label>
                    <input type="number" id="itineraryDuration" name="duration" min="1" max="30" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="itineraryDescription" name="description" rows="3"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20 resize-none"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga Mulai Dari (IDR)</label>
                <input type="number" id="itineraryPrice" name="price"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeItineraryModal()"
                    class="px-4 py-2 bg-gray-100 rounded-xl text-gray-600 text-sm font-medium hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition">
                    Simpan Itinerary
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Activity Form Modal --}}
<div id="activityModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
        <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between">
            <h3 id="activityModalTitle" class="text-lg font-bold text-gray-900">Tambah Aktivitas</h3>
            <button onclick="closeActivityModal()" class="p-1 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="activityForm" class="p-6 space-y-5">
            @csrf
            <input type="hidden" id="activityId" name="id">
            <input type="hidden" id="activityDayId" name="day_id">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Aktivitas *</label>
                <input type="text" id="activityTitle" name="title" required
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="time" id="activityStartTime" name="start_time"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="time" id="activityEndTime" name="end_time"
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" id="activityLocation" name="location"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Aktivitas</label>
                <textarea id="activityDescription" name="description" rows="3"
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:border-[#0ABFA3] focus:ring-2 focus:ring-[#0ABFA3]/20 resize-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeActivityModal()"
                    class="px-4 py-2 bg-gray-100 rounded-xl text-gray-600 text-sm font-medium hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] rounded-xl text-white text-sm font-medium hover:shadow-lg transition">
                    Simpan Aktivitas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Data state
    let itineraries = [];
    let currentItinerary = null;
    let currentDayIndex = 0;
    let selectedItineraryId = null;

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadItineraries();
        setupEventListeners();

        const toggleBtn = document.getElementById('toggleSidebar');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                if (typeof openSidebar === 'function') openSidebar();
            });
        }
    });

    function setupEventListeners() {
        document.getElementById('searchItinerary')?.addEventListener('input', filterItineraries);
        document.getElementById('statusFilter')?.addEventListener('change', filterItineraries);
        document.getElementById('resetFilterBtn')?.addEventListener('click', resetFilters);
        document.getElementById('newItineraryBtn')?.addEventListener('click', () => openItineraryModal());
        document.getElementById('createNewBtn')?.addEventListener('click', () => openItineraryModal());
        document.getElementById('itineraryForm')?.addEventListener('submit', saveItinerary);
        document.getElementById('activityForm')?.addEventListener('submit', saveActivity);
        document.getElementById('publishItineraryBtn')?.addEventListener('click', publishItinerary);
        document.getElementById('exportItineraryBtn')?.addEventListener('click', exportItinerary);
    }

    function loadItineraries() {
        // Simulasi data - ganti dengan API call
        setTimeout(() => {
            itineraries = [{
                    id: 1,
                    title: "Bali Explorer",
                    destination: "Bali",
                    duration: 5,
                    description: "Explore the beauty of Bali",
                    price: 3500000,
                    status: "published",
                    days: [{
                            id: 1,
                            day: 1,
                            title: "Arrival & Kuta Beach",
                            activities: [{
                                    id: 1,
                                    title: "Check-in Hotel",
                                    start_time: "14:00",
                                    end_time: "15:00",
                                    location: "Kuta",
                                    description: "Check in at hotel"
                                },
                                {
                                    id: 2,
                                    title: "Sunset at Kuta Beach",
                                    start_time: "17:00",
                                    end_time: "19:00",
                                    location: "Kuta Beach",
                                    description: "Enjoy beautiful sunset"
                                }
                            ]
                        },
                        {
                            id: 2,
                            day: 2,
                            title: "Ubud Tour",
                            activities: []
                        }
                    ]
                },
                {
                    id: 2,
                    title: "Raja Ampat Paradise",
                    destination: "Raja Ampat",
                    duration: 7,
                    description: "Discover the underwater paradise",
                    price: 8500000,
                    status: "draft",
                    days: [{
                        id: 3,
                        day: 1,
                        title: "Arrival in Sorong",
                        activities: []
                    }]
                }
            ];
            renderItineraryList();
            updateStats();
        }, 500);
    }

    function renderItineraryList() {
        const container = document.getElementById('itineraryList');
        const searchTerm = document.getElementById('searchItinerary')?.value.toLowerCase() || '';
        const statusFilter = document.getElementById('statusFilter')?.value || '';

        const filtered = itineraries.filter(i => {
            const matchesSearch = i.title.toLowerCase().includes(searchTerm) ||
                i.destination.toLowerCase().includes(searchTerm);
            const matchesStatus = !statusFilter || i.status === statusFilter;
            return matchesSearch && matchesStatus;
        });

        if (filtered.length === 0) {
            container.innerHTML = `
                <div class="p-8 text-center text-gray-400 text-sm">
                    Tidak ada itinerary ditemukan
                </div>
            `;
            return;
        }

        container.innerHTML = filtered.map(i => `
            <div onclick="selectItinerary(${i.id})" 
                 class="p-4 hover:bg-gray-50 transition cursor-pointer ${selectedItineraryId === i.id ? 'bg-[#D4F5EE]/30 border-l-4 border-l-[#0ABFA3]' : ''}">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900 text-sm">${escapeHtml(i.title)}</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                ${escapeHtml(i.destination)}
                            </span>
                            <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                ${i.duration} hari
                            </span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium
                        ${i.status === 'published' ? 'bg-[#D4F5EE] text-[#05796A]' : ''}
                        ${i.status === 'draft' ? 'bg-gray-100 text-gray-600' : ''}
                        ${i.status === 'archived' ? 'bg-[#FFE8E8] text-[#CC3B3B]' : ''}">
                        <span class="w-1 h-1 rounded-full 
                            ${i.status === 'published' ? 'bg-[#05796A]' : ''}
                            ${i.status === 'draft' ? 'bg-gray-400' : ''}
                            ${i.status === 'archived' ? 'bg-[#CC3B3B]' : ''}"></span>
                        ${i.status === 'published' ? 'Published' : i.status === 'draft' ? 'Draft' : 'Archived'}
                    </span>
                </div>
            </div>
        `).join('');
    }

    function filterItineraries() {
        renderItineraryList();
    }

    function resetFilters() {
        document.getElementById('searchItinerary').value = '';
        document.getElementById('statusFilter').value = '';
        renderItineraryList();
    }

    function selectItinerary(id) {
        selectedItineraryId = id;
        currentItinerary = itineraries.find(i => i.id === id);
        currentDayIndex = 0;

        renderItineraryList();
        showBuilderContent();
    }

    function showBuilderContent() {
        if (!currentItinerary) return;

        document.getElementById('emptyState').classList.add('hidden');
        document.getElementById('builderContent').classList.remove('hidden');

        // Update header
        document.getElementById('itineraryTitle').textContent = currentItinerary.title;
        document.getElementById('destValue').textContent = currentItinerary.destination;
        document.getElementById('durationValue').textContent = currentItinerary.duration;
        const statusEl = document.getElementById('statusValue');
        statusEl.textContent = currentItinerary.status === 'published' ? 'Published' :
            currentItinerary.status === 'draft' ? 'Draft' : 'Archived';
        document.getElementById('itineraryStatus').className = `inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium 
            ${currentItinerary.status === 'published' ? 'bg-[#D4F5EE] text-[#05796A]' : ''}
            ${currentItinerary.status === 'draft' ? 'bg-gray-100 text-gray-600' : ''}
            ${currentItinerary.status === 'archived' ? 'bg-[#FFE8E8] text-[#CC3B3B]' : ''}`;

        // Render days navigation
        renderDaysNav();

        // Render current day activities
        renderCurrentDay();
    }

    function renderDaysNav() {
        const container = document.getElementById('daysNav');
        if (!currentItinerary) return;

        container.innerHTML = currentItinerary.days.map((day, idx) => `
            <button onclick="selectDay(${idx})" 
                    class="px-5 py-3 text-sm font-medium transition border-b-2 
                    ${currentDayIndex === idx ? 'border-[#0ABFA3] text-[#0ABFA3]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'}">
                Day ${day.day}
            </button>
        `).join('');
    }

    function selectDay(index) {
        currentDayIndex = index;
        renderDaysNav();
        renderCurrentDay();
    }

    function renderCurrentDay() {
        const day = currentItinerary.days[currentDayIndex];
        if (!day) return;

        document.getElementById('currentDayNum').textContent = day.day;
        document.getElementById('currentDayTitle').textContent = day.title || `Day ${day.day}`;

        const activitiesContainer = document.getElementById('activitiesList');

        if (!day.activities || day.activities.length === 0) {
            activitiesContainer.innerHTML = `
                <div class="p-8 text-center text-gray-400 text-sm">
                    Belum ada aktivitas. Klik "Tambah Aktivitas" untuk menambahkan.
                </div>
            `;
            return;
        }

        activitiesContainer.innerHTML = day.activities.map(act => `
            <div class="p-4 hover:bg-gray-50 transition group">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 flex-wrap">
                            <h4 class="font-semibold text-gray-900">${escapeHtml(act.title)}</h4>
                            ${act.start_time ? `<span class="text-xs text-gray-400">${act.start_time} - ${act.end_time || ''}</span>` : ''}
                        </div>
                        ${act.location ? `<p class="text-sm text-gray-500 mt-1 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg> ${escapeHtml(act.location)}</p>` : ''}
                        ${act.description ? `<p class="text-sm text-gray-500 mt-1">${escapeHtml(act.description)}</p>` : ''}
                    </div>
                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
                        <button onclick="editActivity(${act.id})" class="p-1.5 text-gray-400 hover:text-[#0ABFA3] rounded-lg hover:bg-[#D4F5EE]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button onclick="deleteActivity(${act.id})" class="p-1.5 text-gray-400 hover:text-[#CC3B3B] rounded-lg hover:bg-[#FFE8E8]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function updateStats() {
        document.getElementById('totalItineraries').textContent = itineraries.length;
        document.getElementById('newThisMonth').textContent = itineraries.filter(i => i.status === 'draft').length;
        const totalDestinations = [...new Set(itineraries.map(i => i.destination))].length;
        document.getElementById('totalDestinations').textContent = totalDestinations;
        const totalDays = itineraries.reduce((sum, i) => sum + i.duration, 0);
        document.getElementById('totalDays').textContent = totalDays;
    }

    function openItineraryModal(edit = null) {
        const modal = document.getElementById('itineraryModal');
        const title = document.getElementById('itineraryModalTitle');
        const form = document.getElementById('itineraryForm');

        if (edit) {
            title.textContent = 'Edit Itinerary';
            document.getElementById('itineraryId').value = edit.id;
            document.getElementById('itineraryJudul').value = edit.title;
            document.getElementById('itineraryDestination').value = edit.destination;
            document.getElementById('itineraryDuration').value = edit.duration;
            document.getElementById('itineraryDescription').value = edit.description || '';
            document.getElementById('itineraryPrice').value = edit.price || '';
        } else {
            title.textContent = 'Buat Itinerary Baru';
            form.reset();
            document.getElementById('itineraryId').value = '';
        }

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    function editItineraryInfo() {
        openItineraryModal(currentItinerary);
    }

    function closeItineraryModal() {
        const modal = document.getElementById('itineraryModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }

    async function saveItinerary(e) {
        e.preventDefault();

        const id = document.getElementById('itineraryId').value;
        const data = {
            title: document.getElementById('itineraryJudul').value,
            destination: document.getElementById('itineraryDestination').value,
            duration: parseInt(document.getElementById('itineraryDuration').value),
            description: document.getElementById('itineraryDescription').value,
            price: parseInt(document.getElementById('itineraryPrice').value) || null,
            _token: document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}'
        };

        if (id) {
            // Update existing
            const index = itineraries.findIndex(i => i.id === parseInt(id));
            if (index !== -1) {
                itineraries[index] = {
                    ...itineraries[index],
                    ...data
                };
                if (currentItinerary?.id === parseInt(id)) {
                    currentItinerary = itineraries[index];
                    showBuilderContent();
                }
            }
        } else {
            // Create new
            const newId = Math.max(...itineraries.map(i => i.id), 0) + 1;
            const newItinerary = {
                id: newId,
                ...data,
                status: 'draft',
                days: Array.from({
                    length: data.duration
                }, (_, i) => ({
                    id: Date.now() + i,
                    day: i + 1,
                    title: `Day ${i + 1}`,
                    activities: []
                }))
            };
            itineraries.push(newItinerary);
        }

        renderItineraryList();
        updateStats();
        closeItineraryModal();

        if (!id) {
            selectItinerary(itineraries[itineraries.length - 1].id);
        }
    }

    function openActivityModal(activity = null) {
        const day = currentItinerary.days[currentDayIndex];
        if (!day) return;

        const modal = document.getElementById('activityModal');
        const title = document.getElementById('activityModalTitle');
        const form = document.getElementById('activityForm');

        document.getElementById('activityDayId').value = day.id;

        if (activity) {
            title.textContent = 'Edit Aktivitas';
            document.getElementById('activityId').value = activity.id;
            document.getElementById('activityTitle').value = activity.title;
            document.getElementById('activityStartTime').value = activity.start_time || '';
            document.getElementById('activityEndTime').value = activity.end_time || '';
            document.getElementById('activityLocation').value = activity.location || '';
            document.getElementById('activityDescription').value = activity.description || '';
        } else {
            title.textContent = 'Tambah Aktivitas';
            form.reset();
            document.getElementById('activityId').value = '';
        }

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
    }

    function editActivity(activityId) {
        const day = currentItinerary.days[currentDayIndex];
        const activity = day.activities.find(a => a.id === activityId);
        if (activity) openActivityModal(activity);
    }

    function closeActivityModal() {
        const modal = document.getElementById('activityModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }

    async function saveActivity(e) {
        e.preventDefault();

        const dayId = parseInt(document.getElementById('activityDayId').value);
        const activityId = document.getElementById('activityId').value;
        const day = currentItinerary.days.find(d => d.id === dayId);

        const data = {
            id: activityId ? parseInt(activityId) : Date.now(),
            title: document.getElementById('activityTitle').value,
            start_time: document.getElementById('activityStartTime').value,
            end_time: document.getElementById('activityEndTime').value,
            location: document.getElementById('activityLocation').value,
            description: document.getElementById('activityDescription').value
        };

        if (activityId) {
            // Update existing
            const index = day.activities.findIndex(a => a.id === parseInt(activityId));
            if (index !== -1) {
                day.activities[index] = data;
            }
        } else {
            // Add new
            day.activities.push(data);
        }

        renderCurrentDay();
        closeActivityModal();
    }

    function deleteActivity(activityId) {
        if (!confirm('Apakah Anda yakin ingin menghapus aktivitas ini?')) return;

        const day = currentItinerary.days[currentDayIndex];
        day.activities = day.activities.filter(a => a.id !== activityId);
        renderCurrentDay();
    }

    function publishItinerary() {
        if (!currentItinerary) return;

        if (confirm('Publish itinerary ini? Itinerary akan terlihat di halaman publik.')) {
            currentItinerary.status = 'published';
            const index = itineraries.findIndex(i => i.id === currentItinerary.id);
            if (index !== -1) {
                itineraries[index] = currentItinerary;
            }
            renderItineraryList();
            showBuilderContent();
        }
    }

    function exportItinerary() {
        if (!currentItinerary) {
            alert('Pilih itinerary terlebih dahulu');
            return;
        }

        // Simulasi export PDF
        alert('Fitur export PDF akan segera tersedia');
    }

    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
</script>

@endsection