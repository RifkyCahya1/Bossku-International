@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="min-h-screen bg-[#0E0E10] relative overflow-hidden text-white">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute w-[620px] h-[620px] bg-purple-600/20 rounded-full blur-[160px] -top-32 -left-32"></div>
        <div class="absolute w-[620px] h-[620px] bg-blue-500/20 rounded-full blur-[180px] bottom-0 right-0"></div>
    </div>

    @include('admin.Layout.topbar')

    <div class="flex mx-auto mt-10 px-6 gap-8" x-data="bookingApp()" x-init="fetchData()">

        @include('admin.Layout.sidebar')

        <div class="flex-1">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-semibold">Booking List</h1>
                    <p class="text-sm text-gray-400">Data pemesanan masuk</p>
                </div>
            </div>

            {{-- Tab Button --}}
            <div class="flex gap-2 mb-6 bg-white/5 p-1 rounded-xl w-fit">
                <button
                    @click="switchTab('all')"
                    :class="activeTab === 'all'
                        ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/20'
                        : 'text-gray-400 hover:text-white hover:bg-white/10'"
                    class="px-6 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    All
                </button>
                <button
                    @click="switchTab('tour')"
                    :class="activeTab === 'tour'
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20'
                        : 'text-gray-400 hover:text-white hover:bg-white/10'"
                    class="px-6 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    🧳 Tour
                </button>
                <button
                    @click="switchTab('event')"
                    :class="activeTab === 'event'
                        ? 'bg-purple-600 text-white shadow-lg shadow-purple-500/20'
                        : 'text-gray-400 hover:text-white hover:bg-white/10'"
                    class="px-6 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                    🏃 Event
                </button>
            </div>

            {{-- Table --}}
            <div class="bg-white/5 backdrop-blur rounded-xl border border-white/10 overflow-hidden relative">

                {{-- Loading overlay --}}
                <div x-show="loading" x-transition class="absolute inset-0 bg-black/40 backdrop-blur-sm z-10 flex items-center justify-center rounded-xl">
                    <div class="flex items-center gap-3 text-sm text-gray-300">
                        <svg class="animate-spin w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                        Memuat data...
                    </div>
                </div>

                <table class="w-full text-sm">
                    <thead class="bg-white/10 text-gray-300">
                        <tr>
                            <th class="px-6 py-4 text-left">Customer</th>
                            <th class="px-6 py-4">Invoice / ID</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/5">
                        <template x-for="item in rows" :key="item._type + '-' + item.id">
                            <tr class="hover:bg-white/5 transition">

                                <td class="px-6 py-4">
                                    <div class="font-medium" x-text="item.name || item.runner_name"></div>
                                    <div class="text-xs text-gray-400" x-text="item.email"></div>
                                </td>

                                <td class="px-6 py-4 text-center text-gray-300"
                                    x-text="item.invoice_number || item.doku_invoice_number || item.booking_id || '-'">
                                </td>

                                <td class="px-6 py-4 text-center text-gray-300"
                                    x-text="new Date(item.date || item.checkin_date).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' })">
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium ring-1"
                                        :class="item._type === 'tour'
                                            ? 'bg-blue-500/20 text-blue-400 ring-blue-500/30'
                                            : 'bg-purple-500/20 text-purple-400 ring-purple-500/30'"
                                        x-text="item._type === 'tour' ? '🧳 Tour' : '🏃 Event'">
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center font-semibold"
                                    x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.total || item.total_price || 0)">
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium ring-1"
                                        :class="{
                                            'bg-yellow-500/20 text-yellow-400 ring-yellow-500/30': ['PENDING','pending'].includes(item.status || item.payment_status),
                                            'bg-green-500/20 text-green-400 ring-green-500/30':   ['PAID','success'].includes(item.status || item.payment_status),
                                            'bg-red-500/20 text-red-400 ring-red-500/30':         ['FAILED','failed','expired'].includes(item.status || item.payment_status)
                                        }"
                                        x-text="(item.status || item.payment_status || '-').toUpperCase()">
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button
                                        @click="openDetail(item)"
                                        class="px-4 py-2 rounded-lg bg-indigo-600/80 hover:bg-indigo-600 active:scale-95 transition-all duration-150 text-sm font-medium">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        </template>

                        {{-- Empty state --}}
                        <tr x-show="!loading && rows.length === 0">
                            <td colspan="7" class="px-6 py-16 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="text-3xl">📭</span>
                                    <span>Tidak ada data booking untuk kategori ini.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-5 mb-10 space-y-3 text-sm">

                {{-- Tour Pagination --}}
                <div x-show="activeTab === 'tour' || activeTab === 'all'" class="flex items-center justify-between">
                    <span class="text-gray-400">
                        Tour:
                        <span class="text-white font-medium" x-text="tourMeta.from"></span>–<span class="text-white font-medium" x-text="tourMeta.to"></span>
                        dari <span class="text-white font-medium" x-text="tourMeta.total"></span>
                    </span>
                    <div class="flex items-center gap-1">
                        <button
                            @click="goToPage('tour', tourMeta.current_page - 1)"
                            :disabled="tourMeta.current_page <= 1"
                            :class="tourMeta.current_page <= 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white/20'"
                            class="px-3 py-1.5 rounded-lg bg-white/10 transition text-xs">
                            ‹ Prev
                        </button>
                        <template x-for="p in pageRange(tourMeta.current_page, tourMeta.last_page)" :key="'t-' + p">
                            <button
                                @click="goToPage('tour', p)"
                                :class="p === tourMeta.current_page
                                    ? 'bg-blue-600 text-white'
                                    : 'bg-white/10 hover:bg-white/20'"
                                class="w-8 h-8 rounded-lg text-xs font-medium transition"
                                x-text="p">
                            </button>
                        </template>
                        <button
                            @click="goToPage('tour', tourMeta.current_page + 1)"
                            :disabled="tourMeta.current_page >= tourMeta.last_page"
                            :class="tourMeta.current_page >= tourMeta.last_page ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white/20'"
                            class="px-3 py-1.5 rounded-lg bg-white/10 transition text-xs">
                            Next ›
                        </button>
                    </div>
                </div>

                {{-- Event Pagination --}}
                <div x-show="activeTab === 'event' || activeTab === 'all'" class="flex items-center justify-between">
                    <span class="text-gray-400">
                        Event:
                        <span class="text-white font-medium" x-text="eventMeta.from"></span>–<span class="text-white font-medium" x-text="eventMeta.to"></span>
                        dari <span class="text-white font-medium" x-text="eventMeta.total"></span>
                    </span>
                    <div class="flex items-center gap-1">
                        <button
                            @click="goToPage('event', eventMeta.current_page - 1)"
                            :disabled="eventMeta.current_page <= 1"
                            :class="eventMeta.current_page <= 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white/20'"
                            class="px-3 py-1.5 rounded-lg bg-white/10 transition text-xs">
                            ‹ Prev
                        </button>
                        <template x-for="p in pageRange(eventMeta.current_page, eventMeta.last_page)" :key="'e-' + p">
                            <button
                                @click="goToPage('event', p)"
                                :class="p === eventMeta.current_page
                                    ? 'bg-purple-600 text-white'
                                    : 'bg-white/10 hover:bg-white/20'"
                                class="w-8 h-8 rounded-lg text-xs font-medium transition"
                                x-text="p">
                            </button>
                        </template>
                        <button
                            @click="goToPage('event', eventMeta.current_page + 1)"
                            :disabled="eventMeta.current_page >= eventMeta.last_page"
                            :class="eventMeta.current_page >= eventMeta.last_page ? 'opacity-30 cursor-not-allowed' : 'hover:bg-white/20'"
                            class="px-3 py-1.5 rounded-lg bg-white/10 transition text-xs">
                            Next ›
                        </button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Modal Detail --}}
        <div
            x-show="open"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">

            <div
                @click.outside="open=false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="w-full max-w-lg bg-[#121216] rounded-2xl p-8 border border-white/10 shadow-2xl">

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-semibold">Detail Booking</h2>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium ring-1"
                            :class="bookingType === 'tour'
                                ? 'bg-blue-500/20 text-blue-400 ring-blue-500/30'
                                : 'bg-purple-500/20 text-purple-400 ring-purple-500/30'"
                            x-text="bookingType === 'tour' ? '🧳 Tour' : '🏃 Event'">
                        </span>
                    </div>
                    <button @click="open=false" class="text-gray-500 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-2.5 text-sm text-gray-300">

                    <template x-if="bookingType === 'tour'">
                        <div class="space-y-2.5">
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Nama</span>
                                <span class="font-medium" x-text="booking.name"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Email</span>
                                <span x-text="booking.email"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Paket Tour</span>
                                <span class="font-medium text-blue-400" x-text="booking.tour_name"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Invoice</span>
                                <span x-text="booking.invoice_number"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Tanggal</span>
                                <span x-text="new Date(booking.date).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' })"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Pax</span>
                                <span x-text="booking.guests + ' pax'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Total</span>
                                <span class="font-semibold text-white" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(booking.total)"></span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-gray-400">Status</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium ring-1"
                                    :class="{
                                        'bg-yellow-500/20 text-yellow-400 ring-yellow-500/30': booking.status === 'PENDING',
                                        'bg-green-500/20 text-green-400 ring-green-500/30':   booking.status === 'PAID',
                                        'bg-red-500/20 text-red-400 ring-red-500/30':         booking.status === 'FAILED'
                                    }"
                                    x-text="booking.status">
                                </span>
                            </div>
                        </div>
                    </template>

                    <template x-if="bookingType === 'event'">
                        <div class="space-y-2.5">
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Runner</span>
                                <span class="font-medium" x-text="booking.runner_name"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Email</span>
                                <span x-text="booking.email"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Event</span>
                                <span class="font-medium text-purple-400" x-text="booking.event_name"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Paket</span>
                                <span x-text="booking.package_name + ' (' + booking.package_type + ')'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Check-in</span>
                                <span x-text="booking.checkin_date"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Check-out</span>
                                <span x-text="booking.checkout_date"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Hotel</span>
                                <span x-text="booking.hotel_star + ' bintang, ' + booking.night_count + ' malam'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Invoice</span>
                                <span x-text="booking.doku_invoice_number || booking.booking_id || '-'"></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-gray-400">Total</span>
                                <span class="font-semibold text-white" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(booking.total_price)"></span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-gray-400">Status</span>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium ring-1"
                                    :class="{
                                        'bg-yellow-500/20 text-yellow-400 ring-yellow-500/30': ['pending'].includes(booking.payment_status),
                                        'bg-green-500/20 text-green-400 ring-green-500/30':   ['success'].includes(booking.payment_status),
                                        'bg-red-500/20 text-red-400 ring-red-500/30':         ['failed','expired'].includes(booking.payment_status)
                                    }"
                                    x-text="(booking.payment_status || '').toUpperCase()">
                                </span>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex justify-end items-center gap-3 mt-8 pt-6 border-t border-white/10">

                    <template x-if="bookingType === 'tour'">
                        <div class="flex gap-3">
                            <form :action="`/admin/booking/${booking.id}/paid`" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg bg-green-600/80 hover:bg-green-600 active:scale-95 transition-all duration-150 text-sm font-medium">
                                    ✅ Tandai PAID
                                </button>
                            </form>
                            <form :action="`/admin/booking/${booking.id}/failed`" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600/80 hover:bg-red-600 active:scale-95 transition-all duration-150 text-sm font-medium">
                                    ❌ FAILED
                                </button>
                            </form>
                        </div>
                    </template>

                    <template x-if="bookingType === 'event'">
                        <div class="flex gap-3">
                            <form :action="`/admin/event-booking/${booking.id}/success`" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg bg-green-600/80 hover:bg-green-600 active:scale-95 transition-all duration-150 text-sm font-medium">
                                    ✅ Tandai SUCCESS
                                </button>
                            </form>
                            <form :action="`/admin/event-booking/${booking.id}/failed`" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600/80 hover:bg-red-600 active:scale-95 transition-all duration-150 text-sm font-medium">
                                    ❌ FAILED
                                </button>
                            </form>
                        </div>
                    </template>

                    <button @click="open=false"
                        class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 active:scale-95 transition-all duration-150 text-sm font-medium">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function bookingApp() {
        return {
            open: false,
            booking: null,
            bookingType: 'tour',
            activeTab: 'all',
            loading: false,

            rows: [],
            tourData: [],
            eventData: [],

            tourMeta: {
                current_page: 1,
                last_page: 1,
                total: 0,
                from: 0,
                to: 0
            },
            eventMeta: {
                current_page: 1,
                last_page: 1,
                total: 0,
                from: 0,
                to: 0
            },

            async fetchData(tourPage = 1, eventPage = 1) {
                this.loading = true;

                const params = new URLSearchParams({
                    type: this.activeTab
                });

                if (this.activeTab === 'tour') params.set('page', tourPage);
                if (this.activeTab === 'event') params.set('page', eventPage);
                if (this.activeTab === 'all') {
                    params.set('tour_page', tourPage);
                    params.set('event_page', eventPage);
                }

                try {
                    const res = await fetch(`/admin/booking/data?${params}`);
                    const json = await res.json();

                    if (json.tour) {
                        this.tourData = json.tour.data.map(d => ({
                            ...d,
                            _type: 'tour'
                        }));
                        this.tourMeta = {
                            current_page: json.tour.current_page,
                            last_page: json.tour.last_page,
                            total: json.tour.total,
                            from: json.tour.from ?? 0,
                            to: json.tour.to ?? 0,
                        };
                    }

                    if (json.event) {
                        this.eventData = json.event.data.map(d => ({
                            ...d,
                            _type: 'event'
                        }));
                        this.eventMeta = {
                            current_page: json.event.current_page,
                            last_page: json.event.last_page,
                            total: json.event.total,
                            from: json.event.from ?? 0,
                            to: json.event.to ?? 0,
                        };
                    }

                    this.buildRows();
                } catch (e) {
                    console.error('Gagal fetch data booking:', e);
                } finally {
                    this.loading = false;
                }
            },

            buildRows() {
                if (this.activeTab === 'all') this.rows = [...this.tourData, ...this.eventData];
                if (this.activeTab === 'tour') this.rows = this.tourData;
                if (this.activeTab === 'event') this.rows = this.eventData;
            },

            switchTab(tab) {
                this.activeTab = tab;
                this.fetchData(1, 1);
            },

            goToPage(type, page) {
                if (type === 'tour') {
                    if (page < 1 || page > this.tourMeta.last_page) return;
                    this.fetchData(page, this.eventMeta.current_page);
                } else {
                    if (page < 1 || page > this.eventMeta.last_page) return;
                    this.fetchData(this.tourMeta.current_page, page);
                }
            },

            // Angka halaman: max 5 page di sekitar halaman aktif
            pageRange(current, last) {
                const delta = 2;
                const start = Math.max(1, current - delta);
                const end = Math.min(last, current + delta);
                const range = [];
                for (let i = start; i <= end; i++) range.push(i);
                return range;
            },

            openDetail(item) {
                this.booking = item;
                this.bookingType = item._type;
                this.open = true;
            },
        };
    }
</script>

@endsection