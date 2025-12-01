@extends('main')

@section('content')

<div x-data='tourDetailApp(@json($tour))' x-init="init()" class="bg-[#FAFAFA] text-gray-800 font-sans">

    <section class="relative h-[70vh] overflow-hidden">
        <div x-data="{
                currentImage: 0,
                gallery: @js($tour['gallery']),
                startSlider() {
                    setInterval(() => {
                        this.currentImage = (this.currentImage + 1) % this.gallery.length;
                    }, 3000);
                }
            }"
            x-init="startSlider()">
            <template x-if="gallery.length">
                <div class="absolute inset-0">
                    <img :src="gallery[currentImage]" alt="" class="absolute inset-0 w-full h-full object-cover transform transition-transform duration-700" :class="`scale-105`">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/25 to-black/60"></div>
                </div>
            </template>
        </div>

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
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl" x-text="tour.destination + ' • ' + tour.kota"></p>
            <p class="mt-4 text-3xl font-bold text-white bg-clip-text" x-text="formattedPrice"></p>

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
                <p class="text-gray-600 leading-relaxed mb-6">
                    Discover the best of Indonesia through a thoughtfully curated tour designed to offer comfort, excitement, and meaningful travel experiences. This package brings you to the country’s top destinations, showcasing breathtaking landscapes, rich cultural heritage, and authentic local flavors.
                    Throughout the journey, you will be accompanied by a professional team dedicated to ensuring a smooth, enjoyable, and memorable travel experience. The itinerary balances guided exploration, leisure time, and visits to signature attractions, allowing you to enjoy the trip at a comfortable pace.
                    Ideal for families, couples, and group travelers, this tour provides a complete and stress-free experience—from transportation and comfortable accommodations to curated activities that highlight the unique charm of each destination. Sit back, relax, and enjoy Indonesia’s beauty from the beginning to the end of your adventure.
                </p>


                <div class="mt-8 grid sm:grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="font-semibold text-[#E6C068]" x-text="tour.category"></p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-sm text-gray-500">Type</p>
                        <p class="font-semibold" x-text="tour.type"></p>
                    </div>
                </div>

                <section class="bg-white rounded-2xl mt-10 p-6 border border-gray-100">
                    <h3 class="text-xl font-semibold text-[#0B0B0B] mb-4">Itinerary</h3>
                    <div class="space-y-6">
                        <template x-for="(item, index) in tour.itinerary" :key="index">
                            <div class="flex items-start gap-4">
                                <!-- Bullet dan line -->
                                <div class="flex flex-col items-center">
                                    <div class="w-9 h-9 rounded-full bg-[#E6C068] text-white flex items-center justify-center font-semibold"
                                        x-text="index + 1">
                                    </div>
                                    <div class="w-px bg-gray-200 h-full mt-2"
                                        :class="index === tour.itinerary.length - 1 ? 'opacity-0' : ''">
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <!-- Header Day -->
                                    <button @click="toggleDay(index)" class="w-full text-left">
                                        <div class="flex justify-between items-center">
                                            <h4 class="text-lg font-bold "
                                                x-text="'Day ' + item.hari + ' : ' + item.judul">
                                            </h4>

                                            <svg :class="openDay === index ? 'rotate-180' : ''"
                                                class="w-5 h-5 text-gray-500 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </button>

                                    <!-- Content -->
                                    <div x-show="openDay === index" x-transition class="mt-2 text-gray-600">

                                        <!-- Tempat -->
                                        <template x-for="tp in item.tempat">
                                            <div class="mb-3">
                                                <p class="font-bold text-[#02335B]">
                                                    <span x-text="tp.nama"></span>
                                                    <span x-show="tp.optional" class="text-xs text-red-500">(Optional)</span>
                                                </p>
                                                <p class="text-gray-600 text-sm" x-text="tp.deskripsi"></p>
                                            </div>
                                        </template>

                                        <!-- Hotel -->
                                        <p class="mt-2 font-semibold text-gray-800" x-show="item.hotel">
                                            Menginap di Hotel Sesuai Itinerary
                                        </p>

                                        <!-- Meal -->
                                        <div class="mt-3 text-sm text-gray-700">
                                            <p><strong>Meal:</strong> <span x-text="item.meal"></span></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </section>

                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <!-- Included -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <div
                            x-data="{
                                include: [
                                    'Tour activities & transportation as per combined itinerary',
                                    'Hotel accommodation',
                                    'Meals as scheduled',
                                    'Entrance tickets for listed attractions',
                                    'Driver also serving as guide',
                                    'Assistance from local escort/guide',
                                    'Indonesian-speaking tour leader',
                                    'Complimentary souvenir'
                                ]
                            }">
                            <h4 class="text-lg font-semibold mb-4 text-[#0B0B0B] tracking-wide">Included</h4>

                            <ul class="space-y-3 text-gray-700">
                                <template x-for="item in include" :key="item">
                                    <li class="flex items-start gap-3">
                                        <div class="w-6 h-6 flex items-center justify-center rounded-full bg-[#E6C068]/10">
                                            <svg class="w-4 h-4 text-[#E6C068]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span class="leading-relaxed" x-text="item"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Excluded -->
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <div
                            x-data="{
                                exclude: [
                                    'International flight tickets, taxes & fuel surcharge',
                                    'Guide tipping',
                                    'Tour leader tipping',
                                    'Porter services & personal expenses',
                                    'Visa application fees',
                                    'Travel insurance',
                                    'Pocket Wi-Fi / modem rental',
                                    'Required travel documents (e.g., passport)'
                                ]
                            }">
                            <h4 class="text-lg font-semibold mb-4 text-[#0B0B0B] tracking-wide">Excluded</h4>

                            <ul class="space-y-3 text-gray-700">
                                <template x-for="item in exclude" :key="item">
                                    <li class="flex items-start gap-3">
                                        <div class="w-6 h-6 flex items-center justify-center rounded-full bg-red-100/40">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>
                                        <span class="leading-relaxed" x-text="item"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <aside
                class="bg-white rounded-3xl shadow-[0_8px_35px_-10px_rgba(0,0,0,0.15)] p-7
           border border-gray-100/80 md:sticky md:top-20 backdrop-blur-lg
           transition duration-300 hover:shadow-[0_12px_45px_-10px_rgba(0,0,0,0.20)]">

                <div class="flex items-start justify-between gap-4">

                    <div class="space-y-1">
                        <p class="text-sm text-gray-500 tracking-wide">Price / Person</p>

                        <div class="text-3xl font-extrabold text-[#E6C068] drop-shadow-sm
                        transition duration-300 hover:scale-[1.03]"
                            x-text="formattedPrice"></div>

                        <p class="text-sm text-gray-400">
                            Tour:
                            <span class="font-medium text-gray-700" x-text="tour.name"></span>
                        </p>
                    </div>

                </div>

                <div class="mt-7">
                    <label class="text-sm text-gray-700 font-semibold">Select Date</label>

                    <div class="relative mt-2">
                        <input
                            x-model="date"
                            type="date"
                            class="w-full p-3 border border-gray-200 rounded-xl bg-white text-gray-700
                            focus:ring-2 focus:ring-[#E6C068]/50 focus:border-[#E6C068]
                            transition-all cursor-pointer shadow-sm hover:shadow
                            placeholder-gray-400"
                            placeholder="Select date">
                    </div>
                </div>

                <!-- GUEST PICKER -->
                <div class="mt-7 flex flex-col space-y-2">
                    <div class="flex items-center justify-center space-x-4 bg-white rounded-2xl px-5 py-3 border border-gray-200 shadow-md hover:shadow-lg transition-all duration-300 width-full">

                        <!-- Minus Button -->
                        <button
                            @click="decrement()"
                            class="w-11 h-11 flex items-center justify-center rounded-xl 
                            border border-gray-200 bg-white text-xl font-bold
                            hover:bg-gray-100 hover:shadow-sm active:scale-95
                            transition-all duration-200">
                            -
                        </button>

                        <!-- Guest Count -->
                        <div class="min-w-[90px] text-center font-semibold text-gray-700 text-lg tracking-wide
                        transition duration-300"
                            x-text="guests + ' Guest'">
                        </div>

                        <!-- Plus Button -->
                        <button
                            @click="increment()"
                            class="w-11 h-11 flex items-center justify-center rounded-xl 
                            border border-gray-200 bg-white text-xl font-bold
                            hover:bg-gray-100 hover:shadow-sm active:scale-95
                            transition-all duration-200">
                            +
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 italic">
                        Number of guests affects the total price.
                    </p>
                </div>

                <!-- TOTAL SECTION -->
                <div class="mt-8">
                    <p class="text-sm text-gray-600">Total</p>

                    <div class="text-4xl font-extrabold text-[#3B5BDB] tracking-wide mt-1
                    drop-shadow-sm transition duration-300 hover:scale-[1.03]"
                        x-text="formattedTotalPrice"></div>
                </div>

                <!-- CTA BUTTONS -->
                <button
                    @click="openModal = true"
                    class="w-full mt-7 py-3.5 rounded-xl bg-gradient-to-r from-[#E6C068] to-[#d8b252]
                    text-white font-semibold shadow-md hover:shadow-xl hover:brightness-105
                    active:scale-[0.98] transition-all duration-300">
                    Reserve Now
                </button>

                <!-- <button
                    @click="downloadItinerary()"
                    class="w-full mt-4 py-3 rounded-xl border border-[#E6C068] text-[#E6C068] font-medium
                    bg-white hover:bg-[#E6C068]/5 hover:shadow-md active:scale-[0.98]
                    transition-all duration-300 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download Itinerary
                </button> -->

                <button
                    @click="openInquiry = true"
                    class="w-full mt-4 py-3 rounded-xl border border-gray-200 text-gray-700 font-medium
                    bg-white hover:bg-gray-50 hover:shadow-md active:scale-[0.98]
                    transition-all duration-300">
                    Ask a Question
                </button>
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
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-md transition-all duration-500 ease-out mt-12">
        <div
            @click.away="openModal = false"
            class="w-full max-w-4xl mx-4 bg-white dark:bg-[#161616] rounded-3xl shadow-[0_0_40px_rgba(0,0,0,0.3)] overflow-hidden transform transition-all duration-500 scale-95 hover:scale-100">
            <!-- Header Banner -->
            <div class="relative h-56">
                <img
                    :src="gallery[currentImage]"
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
                            <input
                                x-model="date"
                                type="date"
                                :min="tour.minDate" required
                                class="w-full p-3 border border-gray-200 rounded-xl bg-white text-gray-700
                                focus:ring-2 focus:ring-[#E6C068]/50 focus:border-[#E6C068]
                                transition-all cursor-pointer shadow-sm hover:shadow
                              placeholder-gray-400"
                                placeholder="Select date"
                                @blur="validateDate()"
                                :class="{'border-red-500': errors.date}">
                           
                            <div x-show="errors.date" class="text-red-500 text-xs mt-1" x-text="errors.date"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Guests</p>
                            <div class="flex items-center gap-3 mt-2">
                                <button type="button" @click="decrement()" class="px-3 py-1.5 border rounded-lg text-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">−</button>
                                <div class="px-4 text-lg font-semibold text-gray-800 dark:text-white" x-text="guests"></div>
                                <button type="button" @click="increment()" class="px-3 py-1.5 border rounded-lg text-lg font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 transition">+</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total</p>
                            <div class="text-3xl font-bold text-[#3B5BDB]" x-text="formattedTotalPrice"></div>
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
                        <div x-data="bookingForm()" class="rounded-xl bg-white/70 dark:bg-[#1f1f1f]/70 p-5 shadow-sm space-y-3">

                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Tour Package</span>
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="tour.name"></span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Date</span>
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="date || '-'"></span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                <span>Guests</span>
                                <span class="font-medium text-gray-800 dark:text-gray-100" x-text="guests + ' guest(s)'"></span>
                            </div>
                            <div class="border-t dark:border-gray-700 pt-3 flex justify-between font-semibold text-gray-800 dark:text-white">
                                <span>Total</span>
                                <div class="text-3xl font-bold text-[#3B5BDB]" x-text="formattedTotalPrice"></div>
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
                    <p class="text-sm text-gray-500 mt-1">Our team will get back to you as soon as possible with complete information.</p>
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
                    <div x-show="errors.name" class="text-red-500 text-xs mt-1" x-text="errors.name"></div>
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide">Email</label>
                    <div class="mt-2">
                        <input x-model="inquiry.email" type="email" placeholder="you@domain.com" required
                            class="w-full p-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E6C068]/30" />
                    </div>
                    <div x-show="errors.email" class="text-red-500 text-xs mt-1" x-text="errors.email"></div>
                </div>

                <div>
                    <label class="text-xs text-gray-500 uppercase tracking-wide">Message</label>
                    <div class="mt-2">
                        <textarea x-model="inquiry.message" placeholder="Write your question or request details" rows="6"
                            class="w-full p-3 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#E6C068]/30"></textarea>
                    </div>
                    <div x-show="errors.message" class="text-red-500 text-xs mt-1" x-text="errors.message"></div>
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

                <p class="text-xs text-gray-400 mt-2">By submitting, you agree to be contacted by the Bossku.Tours team.</p>
            </form>
        </aside>
    </div>

</div>

<script>
    function tourDetailApp(tour) {
        return {
            tour: tour,
            date: '',
            guests: 1,
            openModal: false,
            openGallery: false,
            openInquiry: false,
            gallery: tour.gallery ?? [],
            currentImage: 0,
            openDay: null,
            form: {
                name: '',
                email: '',
                phone: '',
                date: '',
                guests: 1,
            },

            errors: {
                name: '',
                email: '',
                phone: '',
                date: '',
            },

            increment() {
                this.guests++
            },

            decrement() {
                if (this.guests > 1) this.guests--
            },

            inquiry: {
                name: '',
                email: '',
                message: ''
            },

            validateInquiry() {
                this.errors = {
                    name: '',
                    email: '',
                    message: ''
                };
                let valid = true;

                // Name
                if (!this.inquiry.name.trim()) {
                    this.errors.name = "Name is required.";
                    valid = false;
                }

                // Email format
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!this.inquiry.email.trim()) {
                    this.errors.email = "Email is required.";
                    valid = false;
                } else if (!emailPattern.test(this.inquiry.email)) {
                    this.errors.email = "Please enter a valid email address.";
                    valid = false;
                }

                // Message
                if (!this.inquiry.message.trim()) {
                    this.errors.message = "Message cannot be empty.";
                    valid = false;
                }

                return valid;
            },

            async sendInquiry() {
                if (!this.validateInquiry()) return;

                // Kirim data (contoh fetch)
                console.log("Sending inquiry...", this.inquiry);

                // Reset form
                this.inquiry = {
                    name: '',
                    email: '',
                    message: ''
                };

                alert("Your inquiry has been sent!");
            },

            bookingForm() {
                console.log("Booking submitted!", this.date, this.guests, this.inquiry);
            },

            get formattedPrice() {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(this.tour.price ?? 0);
            },

            get totalPrice() {
                return (this.tour?.price ?? 0) * this.guests;
            },

            get formattedTotalPrice() {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(this.totalPrice);
            },

            nextImage() {
                if (this.gallery.length > 0) {
                    this.currentImage = (this.currentImage + 1) % this.gallery.length;
                }
            },

            prevImage() {
                if (this.gallery.length > 0) {
                    this.currentImage =
                        (this.currentImage - 1 + this.gallery.length) % this.gallery.length;
                }
            },

            toggleDay(index) {
                this.openDay = this.openDay === index ? null : index;
            },

            incGuests() {
                this.form.guests++;
            },

            decGuests() {
                if (this.form.guests > 1) this.form.guests--;
            },

            validateName() {
                this.errors.name = this.form.name.trim() === '' ? 'Name is required' : '';
            },

            validateEmail() {
                const regex = /\S+@\S+\.\S+/;
                this.errors.email = !regex.test(this.form.email) ?
                    'Invalid email' :
                    '';
            },

            validatePhone() {
                this.errors.phone =
                    this.form.phone.length < 8 ? 'Phone number too short' : '';
            },

            validateDate() {
                this.errors.date = this.form.date === '' ? 'Please select a date' : '';
            },

            book() {
                this.validateName();
                this.validateEmail();
                this.validatePhone();
                this.validateDate();

                if (this.errors.name || this.errors.email || this.errors.phone || this.errors.date) {
                    return;
                }

                alert("Booking success!");
            },

            init() {
                console.log("Tour loaded:", tour);
                console.log(this.gallery);
            }
        };
    }
</script>

@endsection