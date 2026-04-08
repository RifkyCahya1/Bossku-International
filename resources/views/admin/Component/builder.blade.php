@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #F2F4F8;
    }

    #map {
        height: 500px;
        width: 100%;
        border-radius: 16px;
        z-index: 1;
    }

    .leaflet-popup-content {
        min-width: 200px;
    }

    .place-marker {
        cursor: pointer;
    }

    .selected-place {
        background: linear-gradient(135deg, #0ABFA3 0%, #05796A 100%);
        color: white;
    }

    .draggable-place {
        cursor: move;
        transition: all 0.2s ease;
    }

    .draggable-place:hover {
        transform: translateX(5px);
        background: #f3f4f6;
    }

    .dragging {
        opacity: 0.5;
    }

    .drop-zone {
        border: 2px dashed #0ABFA3;
        background: #D4F5EE;
    }
</style>

<div class="flex min-h-screen">

    @include('admin.Layout.sidebar')

    <main class="flex-1 overflow-x-hidden px-5 py-6 sm:px-7 sm:py-7 lg:px-9 lg:py-8">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                    {{ isset($itinerary) ? 'Edit Itinerary' : 'Itinerary Builder' }}
                </h1>
                <p class="text-sm text-gray-500 mt-0.5">Buat rencana perjalanan langkah demi langkah</p>
            </div>
            <a href="{{ route('admin.itinerary-builder.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-xl text-gray-700 text-sm font-medium hover:bg-gray-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>

        {{-- Step Indicator --}}
        <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-5 mb-6">
            <div id="stepIndicator" class="flex items-center gap-0"></div>
        </div>

        {{-- STEP 0: Info Dasar --}}
        <div id="step-0" class="step-panel">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 space-y-4">
                    <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#0ABFA3]"></span>
                        Informasi Dasar
                    </h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Itinerary *</label>
                        <input type="text" id="title" value="{{ isset($itinerary) ? $itinerary->title : '' }}"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0ABFA3]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="description" rows="3"
                            class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0ABFA3] resize-none">{{ isset($itinerary) ? $itinerary->description : '' }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari) *</label>
                            <input type="number" id="duration" min="1" max="30"
                                value="{{ isset($itinerary) ? $itinerary->duration_days : '2' }}"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0ABFA3]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota Keberangkatan</label>
                            <select id="start_location" onchange="onAirportSelected(this)"
                                class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0ABFA3] text-sm">
                                <option value="">-- Pilih Kota --</option>
                                <option value="CGK|-6.1256|106.6559|Jakarta">✈ Jakarta</option>
                                <option value="SUB|-7.3798|112.7871|Surabaya">✈ Surabaya</option>
                                <option value="DPS|-8.7482|115.1672|Bali / Denpasar">✈ Bali / Denpasar</option>
                                <option value="JOG|-7.7900|110.4317|Yogyakarta">✈ Yogyakarta</option>
                                <option value="SOC|-7.5160|110.7571|Solo">✈ Solo</option>
                                <option value="SRG|-6.9727|110.3742|Semarang">✈ Semarang</option>
                                <option value="MLG|-7.9266|112.7145|Malang">✈ Malang</option>
                                <option value="MES|3.5592|98.6712|Medan">✈ Medan</option>
                                <option value="PLM|-2.8983|104.6999|Palembang">✈ Palembang</option>
                                <option value="PKU|0.4608|101.4449|Pekanbaru">✈ Pekanbaru</option>
                                <option value="BTH|1.1213|104.1192|Batam">✈ Batam</option>
                                <option value="PDG|-0.8787|100.3516|Padang">✈ Padang</option>
                                <option value="TKG|-5.2424|105.1763|Lampung">✈ Lampung</option>
                                <option value="BPN|-1.2683|116.8942|Balikpapan">✈ Balikpapan</option>
                                <option value="BDJ|-3.4424|114.7631|Banjarmasin">✈ Banjarmasin</option>
                                <option value="PNK|-0.1507|109.4037|Pontianak">✈ Pontianak</option>
                                <option value="UPG|-5.0616|119.5540|Makassar">✈ Makassar</option>
                                <option value="MDC|1.5493|124.9260|Manado">✈ Manado</option>
                                <option value="LOP|-8.7574|116.2767|Lombok">✈ Lombok</option>
                                <option value="LBJ|-8.4867|119.8881|Labuan Bajo">✈ Labuan Bajo</option>
                                <option value="AMQ|-3.7103|128.0881|Ambon">✈ Ambon</option>
                                <option value="DJJ|-2.5769|140.5164|Jayapura">✈ Jayapura</option>
                            </select>
                            <input type="hidden" id="start_location_text">
                        </div>
                    </div>
                </div>

                {{-- Preview Info --}}
                <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6">
                    <h2 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#5B5BD6]"></span>
                        Ringkasan Rencana
                    </h2>
                    <div id="dayPreviewCards" class="space-y-2">
                        <p class="text-sm text-gray-400">Isi durasi untuk melihat rencana per hari.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button onclick="goToStep(1)" class="px-6 py-2.5 bg-[#0ABFA3] text-white rounded-xl font-medium hover:bg-[#05796A] transition flex items-center gap-2">
                    Lanjut — Tambah Tempat Wisata
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="step-days-container"></div>

        <div id="step-meal" class="step-panel hidden">
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 mb-6">
                <h2 class="text-base font-bold text-gray-900 mb-1 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#FFBA08]"></span>
                    Pilih Paket Makan
                </h2>
                <p class="text-sm text-gray-400 mb-5">B = Breakfast · L = Lunch · D = Dinner</p>
                <div id="mealGrid" class="space-y-4"></div>
            </div>
            <div class="flex justify-between mt-4">
                <button onclick="goToPrevDayStep()" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </button>
                <button onclick="goToStep('hotel')" class="px-6 py-2.5 bg-[#0ABFA3] text-white rounded-xl font-medium hover:bg-[#05796A] transition flex items-center gap-2">
                    Lanjut — Pilih Hotel
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- STEP HOTEL --}}
        <div id="step-hotel" class="step-panel hidden">
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 mb-6">
                <h2 class="text-base font-bold text-gray-900 mb-1 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#5B5BD6]"></span>
                    Pilih Bintang Hotel
                </h2>
                <p class="text-sm text-gray-400 mb-5">Pilih kategori hotel per malam selama perjalanan</p>
                <div id="hotelGrid" class="space-y-4"></div>
            </div>
            <div class="flex justify-between mt-4">
                <button onclick="goToStep('meal')" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </button>
                <button onclick="goToStep('review')" class="px-6 py-2.5 bg-[#0ABFA3] text-white rounded-xl font-medium hover:bg-[#05796A] transition flex items-center gap-2">
                    Lanjut — Review & Simpan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- STEP REVIEW --}}
        <div id="step-review" class="step-panel hidden">
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 mb-6">
                <h2 class="text-base font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#0ABFA3]"></span>
                    Review Itinerary
                </h2>
                <div id="reviewContent" class="space-y-4"></div>
            </div>

            {{-- Peta di review --}}
            <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-6 mb-6">
                <h2 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#FF6B6B]"></span>
                    Peta Rute
                    <span class="text-xs text-gray-400 ml-auto" id="routeStats"></span>
                </h2>
                <div id="map"></div>
            </div>

            <div class="flex justify-between mt-4">
                <button onclick="goToStep('hotel')" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </button>
                <button onclick="saveItinerary()" class="px-6 py-2.5 bg-gradient-to-r from-[#0ABFA3] to-[#05796A] text-white rounded-xl font-medium hover:shadow-lg transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Itinerary
                </button>
            </div>
        </div>
    </main>
</div>

<script>
    var ITINERARY_DATA = {
        id: '{{ isset($itinerary) ? $itinerary->id : "" }}',
        waypoints: @json(isset($itinerary) && $itinerary->waypoints ? $itinerary->waypoints : [])
    };
</script>

<script>
    // ── State ─────────────────────────────────────────────────────
    let map, markers = [],
        previewMarkers = [],
        routingControl = null;
    let currentItineraryId = ITINERARY_DATA.id || null;
    let searchDebounce = null;
    let allPreviewPlaces = [];
    let currentStep = 0;
    let totalDays = 2;
    let activeSearchDay = 1;
    let dayData = [];
    let airportWaypoint = null;
    let dayMaps = {};

    // ── Step Config ───────────────────────────────────────────────
    const STEP_LABELS = (days) => {
        const steps = [{
            id: 0,
            label: 'Info Dasar'
        }];
        for (let i = 1; i <= days; i++) steps.push({
            id: i,
            label: `Hari ${i}`
        });
        steps.push({
            id: 'meal',
            label: 'Makan'
        });
        steps.push({
            id: 'hotel',
            label: 'Hotel'
        });
        steps.push({
            id: 'review',
            label: 'Review'
        });
        return steps;
    };

    function renderStepIndicator() {
        const steps = STEP_LABELS(totalDays);
        const container = document.getElementById('stepIndicator');
        container.innerHTML = steps.map((s, i) => {
            const isActive = s.id === currentStep;
            const stepIds = steps.map(x => x.id);
            const currentIdx = stepIds.indexOf(currentStep);
            const isDone = i < currentIdx;
            let circleClass = 'w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold border-2 transition ';
            circleClass += isActive ?
                'bg-[#0ABFA3] border-[#0ABFA3] text-white' :
                isDone ?
                'bg-[#0ABFA3]/20 border-[#0ABFA3] text-[#0ABFA3]' :
                'bg-gray-100 border-gray-200 text-gray-400';
            const labelClass = 'text-xs mt-1 ' + (isActive ? 'text-[#0ABFA3] font-bold' : isDone ? 'text-[#0ABFA3]' : 'text-gray-400');
            const connector = i < steps.length - 1 ?
                `<div class="flex-1 h-0.5 mx-1 mb-3 ${isDone ? 'bg-[#0ABFA3]' : 'bg-gray-200'}"></div>` :
                '';
            return `
            <div class="flex flex-col items-center">
                <div class="${circleClass}">${isDone ? '✓' : i + 1}</div>
                <span class="${labelClass} whitespace-nowrap">${s.label}</span>
            </div>
            ${connector}`;
        }).join('');
    }

    function goToStep(stepId) {
        // Validasi step 0
        if (currentStep === 0 && stepId !== 0) {
            const title = document.getElementById('title').value.trim();
            if (!title) {
                showToast('Judul itinerary harus diisi', 'error');
                return;
            }
        }

        // Sembunyikan semua panel
        document.querySelectorAll('.step-panel').forEach(p => p.classList.add('hidden'));
        document.querySelectorAll('[id^="step-day-"]').forEach(p => p.classList.add('hidden'));

        currentStep = stepId;
        renderStepIndicator();

        if (stepId === 0) {
            document.getElementById('step-0').classList.remove('hidden');
        } else if (typeof stepId === 'number') {
            document.getElementById(`step-day-${stepId}`)?.classList.remove('hidden');
            setTimeout(() => {
                if (!dayMaps[stepId]) initDayMap(stepId);
                else dayMaps[stepId].map.invalidateSize();
            }, 100);
        } else if (stepId === 'meal') {
            renderMealStep();
            document.getElementById('step-meal').classList.remove('hidden');
        } else if (stepId === 'hotel') {
            renderHotelStep();
            document.getElementById('step-hotel').classList.remove('hidden');
        } else if (stepId === 'review') {
            renderReviewStep();
            document.getElementById('step-review').classList.remove('hidden');
            // Init map setelah element visible
            setTimeout(() => {
                if (!map) initMap();
                else map.invalidateSize();
                drawAllMarkersAndRoute();
            }, 100);
        }

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function goToPrevDayStep() {
        goToStep(totalDays);
    }

    function initDayMap(day) {
        if (dayMaps[day]) return;
        const m = L.map(`day-map-${day}`).setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OSM &copy; CartoDB',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(m);
        dayMaps[day] = {
            map: m,
            markers: [],
            routeLayer: null
        };
    }

    function updateDayMapMarkers(day, searchResults) {
        if (!dayMaps[day]) initDayMap(day);
        const {
            map: m
        } = dayMaps[day];

        // Hapus marker lama
        dayMaps[day].markers.forEach(mk => m.removeLayer(mk));
        dayMaps[day].markers = [];

        // Hapus polyline rute lama
        if (dayMaps[day].routeLayer) {
            m.removeLayer(dayMaps[day].routeLayer);
            dayMaps[day].routeLayer = null;
        }

        const dayPlaces = dayData[day - 1]?.places || [];
        const validPlaces = searchResults.filter(p => p.lat && p.lng);

        if (!validPlaces.length) return;

        // ── Render semua marker hasil pencarian ──
        validPlaces.forEach(p => {
            const isAdded = dayPlaces.some(x => x.id === p.id);

            // Marker hijau + nomor urut jika sudah dipilih, abu-abu jika belum
            const orderNum = dayPlaces.findIndex(x => x.id === p.id) + 1;
            const icon = L.divIcon({
                className: '',
                html: `<div style="
                width:30px;height:30px;
                background:${isAdded
                    ? 'linear-gradient(135deg,#0ABFA3,#05796A)'
                    : 'linear-gradient(135deg,#9CA3AF,#4B5563)'};
                border:2.5px solid white;border-radius:50%;
                box-shadow:0 2px 8px rgba(0,0,0,0.3);
                display:flex;align-items:center;justify-content:center;
                color:white;font-weight:700;font-size:12px;">
                ${isAdded ? orderNum : '·'}
            </div>`,
                iconSize: [30, 30],
                iconAnchor: [15, 15]
            });

            const mk = L.marker([p.lat, p.lng], {
                    icon
                })
                .addTo(m)
                .bindPopup(`
                <div style="font-family:'Plus Jakarta Sans',sans-serif;min-width:180px;">
                    <p style="font-weight:700;font-size:13px;margin:0 0 2px;">${escapeHtml(p.name)}</p>
                    <p style="font-size:11px;color:#6B7280;margin:0 0 8px;">
                        ${escapeHtml(p.city || '')} • ${escapeHtml(p.category || '')}
                    </p>
                    ${isAdded
                        ? `<span style="padding:3px 10px;background:#D1FAF4;color:#05796A;border-radius:20px;font-size:11px;font-weight:600;">✓ Sudah ditambahkan</span>`
                        : `<button onclick="addPlaceToDay(${day}, ${JSON.stringify(p).replace(/"/g, '&quot;')})"
                            style="padding:5px 12px;background:#0ABFA3;color:white;border:none;border-radius:8px;font-size:11px;cursor:pointer;font-weight:600;width:100%;">
                            + Tambah ke Hari ${day}
                           </button>`
                    }
                </div>`);
            dayMaps[day].markers.push(mk);
        });

        // Fit bounds ke hasil pencarian
        const group = L.featureGroup(dayMaps[day].markers);
        m.flyToBounds(group.getBounds().pad(0.25), {
            duration: 0.8
        });

        const statsEl = document.getElementById(`day-map-stats-${day}`);
        if (statsEl) statsEl.textContent = `${validPlaces.length} lokasi ditemukan`;

        // ── Gambar rute OSRM hanya untuk tempat yang sudah dipilih ──
        if (dayPlaces.length >= 2) {
            drawDayRouteOSRM(day, dayPlaces);
        }
    }

    // ── Init Day Steps ────────────────────────────────────────────
    function initDaySteps() {
        totalDays = parseInt(document.getElementById('duration').value) || 2;

        // Reset dayData sesuai jumlah hari
        while (dayData.length < totalDays) {
            dayData.push({
                day: dayData.length + 1,
                places: [],
                meals: {
                    B: false,
                    L: false,
                    D: false
                },
                hotel: 0
            });
        }
        dayData = dayData.slice(0, totalDays);

        // Render day preview cards di step 0
        const preview = document.getElementById('dayPreviewCards');
        preview.innerHTML = Array.from({
            length: totalDays
        }, (_, i) => `
        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#0ABFA3] to-[#05796A] text-white flex items-center justify-center text-xs font-bold">${i + 1}</div>
            <div>
                <p class="text-sm font-semibold text-gray-800">Hari ${i + 1}</p>
                <p class="text-xs text-gray-400" id="day-preview-count-${i + 1}">Belum ada tempat</p>
            </div>
        </div>`).join('');

        // Generate day panels
        const container = document.getElementById('step-days-container');
        container.innerHTML = '';

        for (let d = 1; d <= totalDays; d++) {
            const panel = document.createElement('div');
            panel.id = `step-day-${d}`;
            panel.className = 'step-panel hidden';
            panel.innerHTML = `
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Kiri: Search --}}
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-5">
                        <h2 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#5B5BD6]"></span>
                            Cari Tempat — Hari ${d}
                        </h2>
                        <div class="space-y-3">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" id="searchPlaces-${d}" placeholder="Cari tempat wisata..."
                                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0ABFA3]"
                                    oninput="onSearchInput(${d})"
                                    onkeypress="if(event.key==='Enter') searchPlaces(${d})">
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <select id="cityFilter-${d}" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                                    <option value="">Semua Kota</option>
                                </select>
                                <select id="categoryFilter-${d}" class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                                    <option value="">Semua Negara</option>
                                </select>
                            </div>
                            <button onclick="searchPlaces(${d})" id="searchBtn-${d}"
                                class="w-full py-2 bg-[#0ABFA3] text-white rounded-xl font-medium hover:bg-[#05796A] transition">
                                Cari Tempat
                            </button>
                        </div>
                        <div id="searchResults-${d}" class="mt-4 max-h-80 overflow-y-auto space-y-2 custom-scrollbar" style="overflow-y:auto;max-height:320px;"></div>
                    </div>
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#FFBA08]"></span>
                                Tempat Wisata Hari ${d}
                            </h2>
                            <span class="text-xs text-gray-400" id="day-count-badge-${d}">0 tempat</span>
                        </div>
                        <div id="dayPlacesList-${d}" class="space-y-2 max-h-48 overflow-y-auto custom-scrollbar">
                            <div class="text-center text-gray-400 text-sm py-6">Belum ada tempat dipilih</div>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Selected + Peta --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- PETA BARU --}}
                    <div class="bg-white rounded-2xl border border-black/5 shadow-sm p-5">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#FF6B6B]"></span>
                                Peta Lokasi Wisata
                            </h2>
                            <span class="text-xs text-gray-400" id="day-map-stats-${d}">—</span>
                        </div>
                        <div id="day-map-${d}" style="height:380px;border-radius:12px;z-index:1;"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-6">
                <button onclick="goToStep(${d - 1})"
                    class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    ${d === 1 ? 'Kembali ke Info' : 'Hari ' + (d - 1)}
                </button>
                <button onclick="goToStep(${d < totalDays ? d + 1 : "'meal'"})"
                    class="px-6 py-2.5 bg-[#0ABFA3] text-white rounded-xl font-medium hover:bg-[#05796A] transition flex items-center gap-2">
                    ${d < totalDays ? 'Lanjut Hari ' + (d + 1) : 'Lanjut — Pilih Makan'}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>`;
            container.appendChild(panel);
        }

        // Copy filter options ke tiap hari
        loadFiltersForAllDays();
        renderStepIndicator();
    }

    // ── Duration change ───────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('duration').addEventListener('change', initDaySteps);
        document.getElementById('duration').addEventListener('input', () => {
            clearTimeout(searchDebounce);
            searchDebounce = setTimeout(initDaySteps, 600);
        });
        initDaySteps();
        renderStepIndicator();
        goToStep(0);
    });

    // ── Search per Hari ───────────────────────────────────────────
    let daySearchDebounce = {};

    function onSearchInput(day) {
        clearTimeout(daySearchDebounce[day]);
        const val = document.getElementById(`searchPlaces-${day}`).value.trim();
        if (val.length < 2) {
            document.getElementById(`searchResults-${day}`).innerHTML =
                `<div class="text-center text-gray-400 text-sm py-6">Ketik minimal 2 karakter...</div>`;
            return;
        }
        daySearchDebounce[day] = setTimeout(() => searchPlaces(day), 400);
    }

    async function searchPlaces(day) {
        const search = document.getElementById(`searchPlaces-${day}`).value.trim();
        const kota = document.getElementById(`cityFilter-${day}`).value;
        const kategori = document.getElementById(`categoryFilter-${day}`).value;

        const btn = document.getElementById(`searchBtn-${day}`);
        if (btn) btn.textContent = 'Mencari...';

        let url = "{{ route('admin.itinerary-builder.api.places') }}?";
        if (search) url += `search=${encodeURIComponent(search)}&`;
        if (kota) url += `kota=${encodeURIComponent(kota)}&`;
        if (kategori) url += `kategori=${encodeURIComponent(kategori)}&`;

        try {
            const res = await fetch(url);
            const places = await res.json();
            renderDaySearchResults(day, places);
        } catch (e) {
            document.getElementById(`searchResults-${day}`).innerHTML =
                `<div class="text-red-400 text-sm py-4 text-center">Gagal memuat: ${e.message}</div>`;
        } finally {
            if (btn) btn.textContent = 'Cari Tempat';
        }
    }

    function renderDaySearchResults(day, places) {
        const container = document.getElementById(`searchResults-${day}`);
        if (!places.length) {
            container.innerHTML = `<div class="text-center text-gray-400 text-sm py-6">Tidak ada tempat ditemukan</div>`;
            return;
        }
        const dayPlaces = dayData[day - 1]?.places || [];
        container.innerHTML = `<div class="text-xs text-gray-400 mb-2 px-1">${places.length} tempat ditemukan</div>` +
            places.map(p => {
                const isAdded = dayPlaces.some(x => x.id === p.id);
                return `
            <div class="flex items-start gap-2 p-3 rounded-xl hover:bg-gray-50 transition">
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm truncate">${escapeHtml(p.name)}</h4>
                    <p class="text-xs text-gray-500">${escapeHtml(p.city || '')} • ${escapeHtml(p.category || '')}</p>
                </div>
                <button onclick="${isAdded ? `showToast('Sudah ditambahkan','warning')` : `addPlaceToDay(${day}, ${JSON.stringify(p).replace(/"/g, '&quot;')})`}"
                    class="shrink-0 px-2.5 py-1 text-xs rounded-lg font-medium transition
                    ${isAdded ? 'bg-gray-100 text-gray-400' : 'bg-[#0ABFA3] text-white hover:bg-[#05796A]'}">
                    ${isAdded ? '✓' : '+ Tambah'}
                </button>
            </div>`;
            }).join('');
        updateDayMapMarkers(day, places);
    }

    // ── Add Place to Day ──────────────────────────────────────────
    function addPlaceToDay(day, place) {
        const d = dayData[day - 1];
        if (d.places.some(p => p.id === place.id)) {
            showToast('Sudah ada di hari ini', 'warning');
            return;
        }
        d.places.push(place);
        renderDayPlacesList(day);
        updateDayPreviewCount(day);
        showToast(`${place.name} ditambahkan ke Hari ${day}`, 'success');

        // Refresh search results agar badge berubah
        const search = document.getElementById(`searchPlaces-${day}`)?.value.trim();
        if (search && search.length >= 2) {
            searchPlaces(day);
        }
    }

    function removePlaceFromDay(day, placeId) {
        dayData[day - 1].places = dayData[day - 1].places.filter(p => p.id !== placeId);
        renderDayPlacesList(day);
        updateDayPreviewCount(day);

        const lastSearch = document.getElementById(`searchPlaces-${day}`)?.value.trim();
        if (lastSearch?.length >= 2) {
            searchPlaces(day);
        }
    }

    function renderDayPlacesList(day) {
        const container = document.getElementById(`dayPlacesList-${day}`);
        const badge = document.getElementById(`day-count-badge-${day}`);
        const places = dayData[day - 1]?.places || [];

        if (badge) badge.textContent = `${places.length} tempat`;

        if (!places.length) {
            container.innerHTML = `<div class="text-center text-gray-400 text-sm py-6">Belum ada tempat dipilih</div>`;
            return;
        }
        container.innerHTML = places.map((p, i) => `
        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
            <div class="w-6 h-6 shrink-0 rounded-full bg-gradient-to-br from-[#0ABFA3] to-[#05796A] text-white flex items-center justify-center text-xs font-bold">${i + 1}</div>
            <div class="flex-1 min-w-0">
                <h4 class="font-semibold text-gray-900 text-sm truncate">${escapeHtml(p.name)}</h4>
                <p class="text-xs text-gray-500">${escapeHtml(p.city || '')}</p>
            </div>
            <button onclick="removePlaceFromDay(${day}, ${p.id})" class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>`).join('');
    }

    function updateDayPreviewCount(day) {
        const el = document.getElementById(`day-preview-count-${day}`);
        const count = dayData[day - 1]?.places?.length || 0;
        if (el) el.textContent = count ? `${count} tempat dipilih` : 'Belum ada tempat';
    }

    // ── Meal Step ─────────────────────────────────────────────────
    const MEAL_OPTIONS = [{
            key: 'B',
            label: 'Breakfast',
            icon: '🌅',
            desc: 'Sarapan pagi'
        },
        {
            key: 'L',
            label: 'Lunch',
            icon: '☀️',
            desc: 'Makan siang'
        },
        {
            key: 'D',
            label: 'Dinner',
            icon: '🌙',
            desc: 'Makan malam'
        },
    ];

    function renderMealStep() {
        const grid = document.getElementById('mealGrid');
        grid.innerHTML = dayData.map((d, idx) => `
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-sm font-bold text-gray-800 mb-3">Hari ${d.day}</p>
            <div class="flex gap-3">
                ${MEAL_OPTIONS.map(m => {
                    const isOn = d.meals[m.key];
                    return `
                    <button onclick="toggleMeal(${idx}, '${m.key}')" id="meal-${idx}-${m.key}"
                        class="flex-1 py-3 rounded-xl border-2 text-center transition font-medium text-sm
                        ${isOn ? 'border-[#0ABFA3] bg-[#0ABFA3]/10 text-[#05796A]' : 'border-gray-200 bg-white text-gray-500 hover:border-gray-300'}">
                        <div class="text-lg mb-0.5">${m.icon}</div>
                        <div class="font-bold">${m.key}</div>
                        <div class="text-xs">${m.label}</div>
                    </button>`;
                }).join('')}
            </div>
        </div>`).join('');
    }

    function toggleMeal(dayIdx, key) {
        dayData[dayIdx].meals[key] = !dayData[dayIdx].meals[key];
        const btn = document.getElementById(`meal-${dayIdx}-${key}`);
        const isOn = dayData[dayIdx].meals[key];
        btn.className = `flex-1 py-3 rounded-xl border-2 text-center transition font-medium text-sm
        ${isOn ? 'border-[#0ABFA3] bg-[#0ABFA3]/10 text-[#05796A]' : 'border-gray-200 bg-white text-gray-500 hover:border-gray-300'}`;
    }

    // ── Hotel Step ────────────────────────────────────────────────
    const HOTEL_OPTIONS = [{
            stars: 0,
            label: 'Tanpa Hotel',
            desc: 'Tidak menginap / sudah punya akomodasi',
            icon: '—'
        },
        {
            stars: 2,
            label: 'Budget ★★',
            desc: 'Hotel bintang 2, harga terjangkau',
            icon: '★★'
        },
        {
            stars: 3,
            label: 'Standard ★★★',
            desc: 'Hotel bintang 3, nyaman dan terjangkau',
            icon: '★★★'
        },
        {
            stars: 4,
            label: 'Superior ★★★★',
            desc: 'Hotel bintang 4, fasilitas lengkap',
            icon: '★★★★'
        },
        {
            stars: 5,
            label: 'Luxury ★★★★★',
            desc: 'Hotel bintang 5, kelas premium',
            icon: '★★★★★'
        },
    ];

    function renderHotelStep() {
        const grid = document.getElementById('hotelGrid');
        // Hotel per malam = duration - 1 malam (malam terakhir tidak menginap)
        const nights = totalDays - 1;
        if (nights < 1) {
            grid.innerHTML = `<p class="text-sm text-gray-400 text-center py-6">Perjalanan 1 hari tidak memerlukan hotel.</p>`;
            return;
        }
        grid.innerHTML = Array.from({
            length: nights
        }, (_, i) => {
            const malam = i + 1;
            const current = dayData[i]?.hotel ?? 0;
            return `
        <div class="p-4 bg-gray-50 rounded-xl">
            <p class="text-sm font-bold text-gray-800 mb-3">Malam ke-${malam} (setelah Hari ${malam})</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                ${HOTEL_OPTIONS.map(h => {
                    const isOn = current === h.stars;
                    return `
                    <button onclick="selectHotel(${i}, ${h.stars})" id="hotel-${i}-${h.stars}"
                        class="p-3 rounded-xl border-2 text-left transition
                        ${isOn ? 'border-[#5B5BD6] bg-[#5B5BD6]/10' : 'border-gray-200 bg-white hover:border-gray-300'}">
                        <div class="text-sm font-bold ${isOn ? 'text-[#5B5BD6]' : 'text-gray-700'} mb-0.5">${h.icon}</div>
                        <div class="text-xs font-semibold ${isOn ? 'text-[#5B5BD6]' : 'text-gray-700'}">${h.label}</div>
                        <div class="text-xs text-gray-400 mt-0.5 leading-tight">${h.desc}</div>
                    </button>`;
                }).join('')}
            </div>
        </div>`;
        }).join('');
    }

    function selectHotel(nightIdx, stars) {
        dayData[nightIdx].hotel = stars;
        renderHotelStep(); // re-render untuk update UI
    }

    // ── Review Step ───────────────────────────────────────────────
    function renderReviewStep() {
        const container = document.getElementById('reviewContent');
        const title = document.getElementById('title').value.trim();
        const desc = document.getElementById('description').value;
        const start = document.getElementById('start_location_text').value;

        let html = `
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-500">Judul</p>
                <p class="font-bold text-gray-900 text-sm mt-0.5">${escapeHtml(title) || '—'}</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-500">Durasi</p>
                <p class="font-bold text-gray-900 text-sm mt-0.5">${totalDays} Hari</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-500">Dari</p>
                <p class="font-bold text-gray-900 text-sm mt-0.5">${escapeHtml(start) || '—'}</p>
            </div>
        </div>`;

        dayData.forEach((d, i) => {
            const mealStr = Object.entries(d.meals).filter(([, v]) => v).map(([k]) => k).join(', ') || 'Tidak ada';
            const hotelOpt = HOTEL_OPTIONS.find(h => h.stars === d.hotel);
            const nights = totalDays - 1;

            html += `
        <div class="border border-gray-100 rounded-xl overflow-hidden mb-3">
            <div class="bg-gradient-to-r from-[#0ABFA3]/10 to-transparent px-4 py-3 flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-[#0ABFA3] text-white flex items-center justify-center text-xs font-bold">${d.day}</div>
                <span class="font-bold text-gray-900 text-sm">Hari ${d.day}</span>
                <span class="text-xs text-gray-400 ml-auto">${d.places.length} tempat</span>
            </div>
            <div class="px-4 py-3 space-y-2">
                ${d.places.length
                    ? d.places.map((p, j) => `
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <span class="w-5 h-5 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs">${j + 1}</span>
                            ${escapeHtml(p.name)}
                            <span class="text-xs text-gray-400">${escapeHtml(p.city || '')}</span>
                        </div>`).join('')
                    : '<p class="text-sm text-gray-400">Tidak ada tempat wisata</p>'}
                <div class="flex gap-4 mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs text-gray-500">🍽 Makan: <strong>${mealStr}</strong></span>
                    ${i < nights
                        ? `<span class="text-xs text-gray-500">🏨 Hotel: <strong>${hotelOpt?.label || '—'}</strong></span>`
                        : ''}
                </div>
            </div>
        </div>`;
        });

        container.innerHTML = html;
    }

    // ── Map ───────────────────────────────────────────────────────
    function initMap() {
        map = L.map('map').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; OSM &copy; CartoDB',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
    }

    function drawAllMarkersAndRoute() {
        // Hapus semua marker lama
        markers.forEach(m => map.removeLayer(m.marker));
        markers = [];
        if (routingControl?.polyline) {
            map.removeLayer(routingControl.polyline);
            routingControl = null;
        }

        const allWaypoints = [];
        if (airportWaypoint) allWaypoints.push(airportWaypoint);
        dayData.forEach(d => d.places.forEach(p => allWaypoints.push(p)));

        if (!allWaypoints.length) return;

        allWaypoints.forEach((wp, i) => {
            if (!wp.lat || !wp.lng) return;
            const isAirport = wp.isAirport;
            const icon = isAirport ?
                L.divIcon({
                    className: '',
                    html: `<div style="width:38px;height:38px;background:linear-gradient(135deg,#3B82F6,#1D4ED8);border:3px solid white;border-radius:50%;box-shadow:0 3px 12px rgba(59,130,246,0.5);display:flex;align-items:center;justify-content:center;font-size:16px;">✈</div>`,
                    iconSize: [38, 38],
                    iconAnchor: [19, 19]
                }) :
                L.divIcon({
                    className: '',
                    html: `<div style="width:34px;height:34px;background:linear-gradient(135deg,#0ABFA3,#05796A);border:2.5px solid white;border-radius:50%;box-shadow:0 3px 10px rgba(10,191,163,0.5);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:white;">${i + 1}</div>`,
                    iconSize: [34, 34],
                    iconAnchor: [17, 17]
                });

            const marker = L.marker([wp.lat, wp.lng], {
                    icon
                })
                .addTo(map)
                .bindPopup(`<strong>${escapeHtml(wp.name)}</strong><br><small>${escapeHtml(wp.city || '')}</small>`);
            markers.push({
                id: wp.id,
                marker
            });
        });

        if (allWaypoints.length > 1) drawRouteOSRM(allWaypoints);

        const group = L.featureGroup(markers.map(m => m.marker));
        map.flyToBounds(group.getBounds().pad(0.2), {
            duration: 1
        });
    }

    async function drawRouteOSRM(wps) {
        const valid = wps.filter(wp => wp.lat && wp.lng);
        if (valid.length < 2) return;
        const coords = valid.map(wp => `${wp.lng},${wp.lat}`).join(';');
        try {
            const res = await fetch(`https://router.project-osrm.org/route/v1/driving/${coords}?overview=full&geometries=geojson`);
            const data = await res.json();
            if (data.code === 'Ok' && data.routes?.length) {
                const polyline = L.geoJSON(data.routes[0].geometry, {
                    style: {
                        color: '#0ABFA3',
                        weight: 5,
                        opacity: 0.85
                    }
                }).addTo(map);
                routingControl = {
                    polyline
                };
                const dist = (data.routes[0].distance / 1000).toFixed(1);
                document.getElementById('routeStats').textContent = `${valid.length} titik • ${dist} km`;
            }
        } catch (e) {
            console.warn('OSRM error', e);
        }
    }

    async function drawDayRouteOSRM(day, places) {
        if (!dayMaps[day]) return;
        const {
            map: m
        } = dayMaps[day];

        // Hapus rute lama dulu
        if (dayMaps[day].routeLayer) {
            m.removeLayer(dayMaps[day].routeLayer);
            dayMaps[day].routeLayer = null;
        }

        const valid = places.filter(p => p.lat && p.lng);
        if (valid.length < 2) return;

        const coords = valid.map(p => `${p.lng},${p.lat}`).join(';');

        try {
            const res = await fetch(
                `https://router.project-osrm.org/route/v1/driving/${coords}?overview=full&geometries=geojson`
            );
            const data = await res.json();

            if (data.code === 'Ok' && data.routes?.length) {
                const routeLayer = L.geoJSON(data.routes[0].geometry, {
                    style: {
                        color: '#0ABFA3',
                        weight: 4,
                        opacity: 0.85,
                        dashArray: null // solid line mengikuti jalan
                    }
                }).addTo(m);

                dayMaps[day].routeLayer = routeLayer;

                // Update stats dengan jarak
                const dist = (data.routes[0].distance / 1000).toFixed(1);
                const dur = Math.round(data.routes[0].duration / 60);
                const statsEl = document.getElementById(`day-map-stats-${day}`);
                if (statsEl) statsEl.textContent = `${valid.length} titik • ${dist} km • ±${dur} menit`;
            }
        } catch (e) {
            console.warn(`OSRM day ${day} error:`, e);
        }
    }

    // ── Airport ───────────────────────────────────────────────────
    function onAirportSelected(select) {
        const val = select.value;
        if (!val) {
            airportWaypoint = null;
            return;
        }
        const [code, lat, lng, name] = val.split('|');
        document.getElementById('start_location_text').value = name;
        airportWaypoint = {
            id: `airport_${code}`,
            name,
            lat: parseFloat(lat),
            lng: parseFloat(lng),
            city: name,
            category: 'Bandara',
            isAirport: true
        };
        showToast(`✈ Keberangkatan dari ${name}`, 'success');
    }

    // ── Filters ───────────────────────────────────────────────────
    async function loadFiltersForAllDays() {
        try {
            const [cr, nr] = await Promise.all([
                fetch("{{ route('admin.itinerary-builder.api.cities') }}"),
                fetch("{{ route('admin.itinerary-builder.api.categories') }}")
            ]);
            const cities = await cr.json();
            const cats = await nr.json();

            for (let d = 1; d <= totalDays; d++) {
                const cs = document.getElementById(`cityFilter-${d}`);
                const ns = document.getElementById(`categoryFilter-${d}`);
                if (!cs || !ns) continue;
                cities.forEach(c => {
                    if (!c.city) return;
                    const o = new Option(c.city, c.city);
                    cs.appendChild(o);
                });
                cats.forEach(c => {
                    if (!c.negara) return;
                    const o = new Option(c.negara, c.negara);
                    ns.appendChild(o);
                });
            }
        } catch (e) {
            console.error('Filter error', e);
        }
    }

    // ── Save ──────────────────────────────────────────────────────
    async function saveItinerary() {
        const title = document.getElementById('title').value.trim();
        if (!title) {
            showToast('Judul harus diisi', 'error');
            return;
        }

        const allPlaces = [];
        dayData.forEach(d => d.places.forEach(p => allPlaces.push(p)));
        if (airportWaypoint) allPlaces.unshift(airportWaypoint);

        const payload = {
            title,
            description: document.getElementById('description').value,
            duration_days: totalDays,
            start_location: document.getElementById('start_location_text').value,
            end_location: allPlaces.at(-1)?.name || '',
            waypoints: allPlaces,
            selected_places: allPlaces,
            day_data: dayData,
            total_distance: 0,
            total_duration: 0,
        };

        try {
            const url = currentItineraryId ?
                `/admin/itinerary-builder/${currentItineraryId}` :
                "{{ route('admin.itinerary-builder.store') }}";
            const method = currentItineraryId ? 'PUT' : 'POST';
            const res = await fetch(url, {
                method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            });
            const result = await res.json();
            if (result.success) {
                showToast(result.message, 'success');
                setTimeout(() => window.location.href = "{{ route('admin.itinerary-builder.index') }}", 1500);
            } else {
                showToast(result.message || 'Gagal menyimpan', 'error');
            }
        } catch (e) {
            showToast('Gagal menyimpan', 'error');
        }
    }

    // ── Toast + Escape ────────────────────────────────────────────
    function showToast(msg, type = 'info') {
        const colors = {
            success: '#0ABFA3',
            error: '#EF4444',
            warning: '#F59E0B',
            info: '#6B7280'
        };
        const toast = document.createElement('div');
        toast.style.cssText = `position:fixed;bottom:24px;right:24px;z-index:9999;padding:12px 20px;background:${colors[type]};color:white;border-radius:12px;font-size:13px;font-weight:600;box-shadow:0 4px 20px rgba(0,0,0,0.15);animation:slideUp .3s ease;max-width:300px`;
        toast.textContent = msg;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2800);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [m]));
    }
</script>

<style>
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #0ABFA3 transparent;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #0ABFA3;
        border-radius: 99px;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(12px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }
</style>

@endsection