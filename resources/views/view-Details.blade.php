@extends('main')

@section('content')
<div x-data="tourDetailApp()" x-init="init()" class="bg-[#FAFAFA] text-gray-800 font-sans">

    <section class="relative h-[70vh] overflow-hidden">
        <template x-if="gallery.length">
            <div class="absolute inset-0">
                <img :src="gallery[currentImage]" alt="" class="absolute inset-0 w-full h-full object-cover transform transition-transform duration-700" :class="`scale-105`">
                <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/25 to-black/60"></div>
            </div>
        </template>

        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center text-white px-6">
            <div class="inline-flex items-center gap-3 mb-4">
                <span class="inline-block px-3 py-1 rounded-full bg-white/10 text-[#E6C068] font-semibold">Premium</span>
                <div class="flex items-center gap-1 text-sm text-yellow-300">
                    <template x-for="i in 5" :key="i">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" :class="i <= tour.rating ? 'text-[#E6C068]' : 'text-white/60'">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.962a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.962c.3.922-.755 1.688-1.538 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.783.57-1.838-.196-1.538-1.118l1.287-3.962a1 1 0 00-.364-1.118L2.063 9.389c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.962z" />
                        </svg>
                    </template>
                </div>
            </div>

            <h1 class="text-4xl md:text-6xl font-semibold mb-4 text-[#E6C068]" x-text="tour.name"></h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl" x-text="tour.destination + ' • ' + tour.duration"></p>
            <p class="mt-4 text-3xl font-bold text-white bg-clip-text" x-html="formattedPrice"></p>

            <div class="mt-6 flex gap-4">
                <button @click="openGallery = true" class="px-6 py-3 rounded-lg border border-white/20 bg-white/10 text-white hover:bg-white/20 transition">View Photos</button>
                <button @click="openModal = true" class="px-6 py-3 rounded-lg bg-[#E6C068] text-white font-semibold hover:brightness-95 transition">Book Now</button>
            </div>
        </div>

        <div class="absolute left-6 bottom-6 z-20 flex gap-2">
            <template x-for="(img, i) in gallery" :key="i">
                <button @click="currentImage = i" :class="currentImage === i ? 'ring-2 ring-[#E6C068]/60' : ''" class="w-14 h-10 overflow-hidden rounded-lg border border-white/10">
                    <img :src="img" class="w-full h-full object-cover">
                </button>
            </template>
        </div>
    </section>

    <section class="max-w-6xl mx-auto py-16 px-6">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <h2 class="text-2xl font-semibold mb-4 text-[#0B0B0B]">Tour Overview</h2>
                <p class="text-gray-600 leading-relaxed mb-6" x-text="tour.description"></p>

                <div class="mt-8 grid sm:grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="font-semibold text-[#E6C068]" x-text="tour.category"></p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500">Type</p>
                        <p class="font-semibold" x-text="tour.type"></p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500">Start Location</p>
                        <p class="font-semibold" x-text="tour.start"></p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500">End Location</p>
                        <p class="font-semibold" x-text="tour.end"></p>
                    </div>
                </div>

                <section class="bg-white rounded-2xl mt-10 p-6 border border-gray-100">
                    <h3 class="text-xl font-semibold text-[#0B0B0B] mb-4">Itinerary</h3>
                    <div class="space-y-6">
                        <template x-for="(item, index) in tour.itinerary" :key="index">
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-9 h-9 rounded-full bg-[#E6C068] text-white flex items-center justify-center font-semibold" x-text="index+1"></div>
                                    <div class="w-px bg-gray-200 h-full mt-2" :class="index === tour.itinerary.length-1 ? 'opacity-0' : ''"></div>
                                </div>
                                <div class="flex-1">
                                    <button @click="toggleDay(index)" class="w-full text-left">
                                        <div class="flex justify-between items-center">
                                            <h4 class="text-lg font-semibold text-[#3B5BDB]" x-text="item.title"></h4>
                                            <svg :class="openDay === index ? 'rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </button>
                                    <div x-show="openDay === index" x-transition class="mt-2 text-gray-600" x-text="item.detail"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </section>

                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h4 class="text-lg font-semibold mb-3 text-[#0B0B0B]">Included</h4>
                        <ul class="space-y-2 text-gray-600">
                            <template x-for="item in tour.include" :key="item">
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-[#E6C068] mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span x-text="item"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <h4 class="text-lg font-semibold mb-3 text-[#0B0B0B]">Excluded</h4>
                        <ul class="space-y-2 text-gray-600">
                            <template x-for="item in tour.exclude" :key="item">
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red-500 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span x-text="item"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            <aside class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 md:sticky md:top-20">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Price / Person</p>
                        <div class="text-2xl font-bold text-[#E6C068]" x-text="'$' + tour.price"></div>
                        <p class="text-sm text-gray-400">Next: <span x-text="tour.departure"></span></p>
                    </div>
                    <div class="text-right">
                        <button @click="decrement()" class="w-9 h-9 rounded-md border border-gray-200 hover:bg-gray-50">−</button>
                        <div class="text-center py-1 font-semibold" x-text="guests + ' guest(s)'"></div>
                        <button @click="increment()" class="w-9 h-9 rounded-md border border-gray-200 hover:bg-gray-50">+</button>
                    </div>
                </div>

                <div class="mt-5">
                    <label class="text-sm text-gray-500">Select Date</label>
                    <input type="date" x-model="date" class="w-full mt-2 p-2 border rounded-md border-gray-200">
                </div>

                <div class="mt-6">
                    <p class="text-sm text-gray-500">Total</p>
                    <div class="text-2xl font-bold text-[#3B5BDB]" x-text="totalPrice"></div>
                </div>

                <button @click="openModal = true" class="w-full mt-6 py-3 rounded-lg bg-[#E6C068] text-white font-semibold hover:brightness-95 transition">Reserve Now</button>

                <button @click="openInquiry = true" class="w-full mt-3 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition">Ask a Question</button>
            </aside>
        </div>
    </section>

    <section class="bg-gradient-to-r from-[#E6C068]/10 via-white to-[#E6C068]/10 text-center py-16 px-6">
        <h2 class="text-3xl font-semibold mb-4 text-[#0B0B0B]">Ready to Explore <span class="text-[#E6C068]" x-text="tour.destination"></span>?</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8">Nikmati pengalaman liburan terbaik bersama Bossku.Tours dengan pelayanan profesional, harga transparan, dan jadwal fleksibel.</p>
        <button @click="openModal = true" class="px-8 py-3 rounded-lg bg-[#E6C068] text-white font-semibold hover:brightness-95 transition">Book This Tour Now</button>
    </section>

    <div x-show="openGallery" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/70">
        <div class="relative w-full max-w-4xl bg-white rounded-xl overflow-hidden">
            <button @click="openGallery = false" class="absolute top-4 right-4 z-20 bg-white/80 rounded-full p-2">✕</button>
            <div class="flex items-center gap-4 p-6">
                <button @click="prevImage()" class="p-2 rounded-md bg-gray-100">‹</button>
                <div class="flex-1">
                    <img :src="gallery[currentImage]" class="w-full h-96 object-cover rounded-md">
                </div>
                <button @click="nextImage()" class="p-2 rounded-md bg-gray-100">›</button>
            </div>
            <div class="p-4 flex gap-2 overflow-auto">
                <template x-for="(img, i) in gallery" :key="i">
                    <button @click="currentImage = i" :class="currentImage === i ? 'ring-2 ring-[#E6C068]' : ''" class="w-24 h-16 overflow-hidden rounded-md border">
                        <img :src="img" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <div
        x-show="openModal"
        x-cloak
        x-trap.noscroll="openModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-md transition-all duration-500 ease-out">
        <div
            @click.away="openModal = false"
            class="w-full max-w-4xl mx-4 bg-white dark:bg-[#161616] rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.3)] overflow-hidden transform transition-all duration-500 scale-95 hover:scale-100">
            <!-- Header Banner -->
            <div class="relative h-56">
                <img
                    :src="tour.image"
                    alt="Tour Preview"
                    class="w-full h-full object-cover brightness-[.75]">
                <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/60 via-black/20 to-transparent p-6">
                    <h3 class="text-3xl font-bold text-white drop-shadow-lg">
                        Reserve <span class="text-[#E6C068]" x-text="tour.name"></span>
                    </h3>
                    <p class="text-sm text-gray-200 mt-1">Plan your next unforgettable journey</p>
                </div>
                <button
                    @click="openModal = false"
                    class="absolute top-4 right-4 text-white/90 hover:text-[#E6C068] text-2xl font-light transition-all">✕</button>
            </div>

            <!-- Body -->
            <form @submit.prevent="book()" class="grid md:grid-cols-2 gap-6 p-8 bg-gradient-to-b from-[#faf7f2] to-white dark:from-[#1b1b1b] dark:to-[#0f0f0f]">

                <!-- Left Section -->
                <div class="space-y-5">
                    <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                        <span class="inline-block w-2 h-2 bg-[#E6C068] rounded-full"></span>
                        Traveler Information
                    </h4>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <input type="text" x-model="form.name" placeholder="Full Name" required
                                @blur="validateName()"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-[#1f1f1f] focus:ring-2 focus:ring-[#E6C068] outline-none transition"
                                :class="{'border-red-500': errors.name}">
                            <div x-show="errors.name" class="text-red-500 text-xs mt-1" x-text="errors.name"></div>
                        </div>
                        <div>
                            <input type="email" x-model="form.email" placeholder="Email" required
                                @blur="validateEmail()"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-[#1f1f1f] focus:ring-2 focus:ring-[#E6C068] outline-none transition"
                                :class="{'border-red-500': errors.email}">
                            <div x-show="errors.email" class="text-red-500 text-xs mt-1" x-text="errors.email"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <input type="tel" x-model="form.phone" placeholder="Phone" required
                                @blur="validatePhone()"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-[#1f1f1f] focus:ring-2 focus:ring-[#E6C068] outline-none transition"
                                :class="{'border-red-500': errors.phone}">
                            <div x-show="errors.phone" class="text-red-500 text-xs mt-1" x-text="errors.phone"></div>
                        </div>
                        <div>
                            <input type="date" x-model="form.date" :min="tour.minDate" required
                                @blur="validateDate()"
                                class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white/80 dark:bg-[#1f1f1f] focus:ring-2 focus:ring-[#E6C068] outline-none transition"
                                :class="{'border-red-500': errors.date}">
                            <div x-show="errors.date" class="text-red-500 text-xs mt-1" x-text="errors.date"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Guests</p>
                            <div class="flex items-center gap-3 mt-2">
                                <button type="button" @click="decFormGuests()" class="px-3 py-1.5 border rounded-lg text-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">−</button>
                                <div class="px-4 text-lg font-semibold text-gray-800 dark:text-white" x-text="form.guests"></div>
                                <button type="button" @click="incFormGuests()" class="px-3 py-1.5 border rounded-lg text-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total</p>
                            <div class="text-3xl font-bold text-[#3B5BDB]" x-text="'$' + (tour.price * form.guests)"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="flex flex-col justify-between border-l border-gray-200 dark:border-gray-700 pl-6">
                    <div class="space-y-5">
                        <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 bg-[#E6C068] rounded-full"></span>
                            Booking Summary
                        </h4>
                        <div class="rounded-xl bg-white/70 dark:bg-[#1f1f1f]/70 p-5 shadow-sm space-y-3">
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Tour Package</span>
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="tour.name"></span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Date</span>
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="form.date || '-'"></span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Guests</span>
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="form.guests"></span>
                            </div>
                            <div class="border-t dark:border-gray-700 pt-3 flex justify-between font-semibold text-gray-800 dark:text-white">
                                <span>Total</span>
                                <span class="text-[#3B5BDB]" x-text="'$' + (tour.price * form.guests)"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" @click="openModal = false"
                            class="px-5 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-lg bg-[#E6C068] text-white font-semibold hover:bg-[#d4aa4c] transition shadow-lg hover:shadow-xl">
                            Confirm Reservation
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openInquiry" x-cloak x-transition class="fixed inset-x-0 top-16 bottom-0 z-40 flex justify-end">
        <div @click="openInquiry = false" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        <aside x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative w-full sm:w-[520px] max-h-[calc(100vh-4rem)] overflow-auto bg-white rounded-l-2xl shadow-2xl border-l-4 border-[#E6C068] p-6 z-10">

            <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                    <h4 class="text-lg font-semibold text-[#0B0B0B]">Ask a Question</h4>
                    <p class="text-sm text-gray-500 mt-1">Tim kami akan membalas secepatnya dengan informasi lengkap.</p>
                </div>
                <button @click="openInquiry = false" aria-label="Close" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form @submit.prevent="sendInquiry()" class="space-y-4">
                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide">Name</label>
                    <div class="mt-2">
                        <input x-model="inquiry.name" type="text" placeholder="Full name" required
                            class="w-full p-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E6C068]/30" />
                    </div>
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide">Email</label>
                    <div class="mt-2">
                        <input x-model="inquiry.email" type="email" placeholder="you@domain.com" required
                            class="w-full p-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E6C068]/30" />
                    </div>
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide">Message</label>
                    <div class="mt-2">
                        <textarea x-model="inquiry.message" placeholder="Write your question or request details" rows="6"
                            class="w-full p-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E6C068]/30"></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-3 pt-2">
                    <button type="button" @click="openInquiry = false"
                        class="w-1/3 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>

                    <button type="submit"
                        class="w-2/3 py-2 rounded-lg bg-[#E6C068] text-white font-semibold shadow hover:brightness-95">
                        Send Inquiry
                    </button>
                </div>

                <p class="text-xs text-gray-400 mt-2">Dengan mengirim, Anda setuju untuk dihubungi oleh tim Bossku.Tours.</p>
            </form>
        </aside>
    </div>

</div>

<script>
    function tourDetailApp() {
        return {
            // UI
            openDay: null,
            openModal: false,
            openGallery: false,
            openInquiry: false,
            currentImage: 0,
            gallery: [
                "https://images.unsplash.com/photo-1553514029-1318c9127859?auto=format&fit=crop&w=1600&q=80",
                "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80",
                "https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1600&q=80"
            ],

            // tour data
            tour: {
                name: "Bali Paradise Experience",
                destination: "Bali",
                duration: "5D4N",
                price: 450,
                rating: 5,
                category: "Culture",
                type: "Leisure",
                start: "Denpasar",
                end: "Ubud",
                departure: "12 November 2025",
                minDate: new Date().toISOString().split('T')[0],
                description: "Nikmati pesona Pulau Dewata dengan kunjungan ke Uluwatu, Tanah Lot, dan pengalaman spa mewah di resort terbaik.",
                itinerary: [{
                        title: "Arrival & Uluwatu Temple",
                        detail: "Tiba di Bandara Ngurah Rai, langsung menuju Uluwatu Temple dan menikmati sunset Kecak Dance."
                    },
                    {
                        title: "Full Day Ubud Tour",
                        detail: "Mengunjungi Monkey Forest, Sawah Tegalalang, dan makan siang di tepi sungai Ayung."
                    },
                    {
                        title: "Nusa Penida Trip",
                        detail: "Trip ke Kelingking Beach dan Angel’s Billabong dengan kapal cepat."
                    },
                    {
                        title: "Spa & Shopping",
                        detail: "Nikmati pijat relaksasi di spa mewah dan berbelanja di Seminyak."
                    },
                    {
                        title: "Departure",
                        detail: "Transfer ke bandara, perjalanan berakhir dengan kenangan indah."
                    }
                ],
                include: [
                    "Akomodasi hotel 4 malam",
                    "Makan pagi dan siang",
                    "Transportasi selama tour",
                    "Guide lokal profesional",
                    "Tiket masuk objek wisata"
                ],
                exclude: [
                    "Tiket pesawat PP",
                    "Asuransi perjalanan",
                    "Makan malam",
                    "Pengeluaran pribadi",
                    "Tip untuk guide & driver"
                ]
            },

            // booking states
            guests: 2,
            date: null,

            // forms
            form: {
                name: '',
                email: '',
                phone: '',
                date: '',
                guests: 2
            },
            inquiry: {
                name: '',
                email: '',
                message: ''
            },

            init() {
                this.date = this.tour.minDate;
                this.form.date = this.tour.minDate;
            },

            // gallery controls
            nextImage() {
                this.currentImage = (this.currentImage + 1) % this.gallery.length;
            },
            prevImage() {
                this.currentImage = (this.currentImage - 1 + this.gallery.length) % this.gallery.length;
            },

            // itinerary
            toggleDay(index) {
                this.openDay = this.openDay === index ? null : index;
            },

            // guests
            increment() {
                this.guests++;
                this.form.guests = this.guests;
            },
            decrement() {
                if (this.guests > 1) this.guests--;
                this.form.guests = this.guests;
            },

            incFormGuests() {
                this.form.guests++;
                this.guests = this.form.guests;
            },
            decFormGuests() {
                if (this.form.guests > 1) {
                    this.form.guests--;
                    this.guests = this.form.guests;
                }
            },

            // computed
            get totalPrice() {
                return '$' + (this.tour.price * this.guests);
            },
            get formattedPrice() {
                return `<span class="text-white/80">From</span> <span class="text-[#E6C068]">$${this.tour.price}</span> <span class="text-white/60 text-sm">/ person</span>`;
            },

            // actions
            book() {
                // Simulate booking success and close modal; in real app send to backend
                alert('Reservation confirmed for ' + this.form.name + ' — Total: $' + (this.tour.price * this.form.guests));
                this.openModal = false;
            },

            sendInquiry() {
                alert('Inquiry sent. Kami akan menghubungi Anda di ' + this.inquiry.email);
                this.openInquiry = false;
                this.inquiry = {
                    name: '',
                    email: '',
                    message: ''
                };
            }
        }
    }
</script>
@endsection