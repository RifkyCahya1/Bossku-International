@php
$excludeNavbar = true;
@endphp

@extends('main')

@section('content')
<div class="relative bg-gradient-to-br from-slate-50 via-amber-50/20 to-slate-100 text-slate-800 min-h-screen">

    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-gradient-to-br from-amber-200/10 to-orange-300/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -right-40 w-[500px] h-[500px] bg-gradient-to-br from-sky-200/5 to-blue-300/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-40 left-1/4 w-72 h-72 bg-gradient-to-br from-emerald-200/5 to-teal-300/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- HEADER -->
        <div class="text-center mb-12">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 sm:mb-10">
                <a href="/" class="group inline-flex items-center gap-2 sm:gap-3 text-neutral-400 hover:text-amber-400 transition-all duration-300">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border border-neutral-700 group-hover:border-amber-500/50 flex items-center justify-center transition-all duration-300">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </div>
                    <span class="text-xs sm:text-sm font-light tracking-wider">RETURN HOME</span>
                </a>
                <div class="flex items-center gap-2 text-xs text-neutral-500">
                    <span>SECURE FORM</span>
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                </div>
            </div>

            <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full bg-gradient-to-r from-black to-slate-800 text-white text-xs tracking-widest uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Booking Form
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Marathon <span class="text-amber-600">Booking</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Complete the form below to secure your marathon experience
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- FORM SECTION -->
            <div class="lg:col-span-2">
                <form id="bookingForm" class="space-y-8" novalidate>

                    <!-- GENERAL & RUNNER INFORMATION -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-white/30 p-6 md:p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold">General & Runner Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Event Name -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">Event Name *</label>
                                <select name="event_name" id="eventName" required
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition">
                                    <option value="">Select Event</option>
                                    <option value="Jakarta Marathon 2026">Jakarta Marathon 2026</option>
                                    <option value="Jogja Marathon 2026" disabled>Jogja Marathon 2026</option>
                                    <option value="Bali Marathon 2026" disabled>-- Coming Soon --</option>
                                </select>
                                <div class="hidden text-sm text-red-600 mt-1" id="eventNameError">Please select an event</div>
                            </div>

                            <!-- Full Name -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">Full Name *</label>
                                <input type="text" name="runner_name" id="runnerName" required minlength="3" maxlength="100"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition"
                                    placeholder="Enter your full name">
                                <div class="hidden text-sm text-red-600 mt-1" id="runnerNameError">Full name must be at least 3 characters</div>
                            </div>

                            <!-- WhatsApp Number -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">WhatsApp Number *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-slate-500">+62</span>
                                    </div>
                                    <input type="tel" name="whatsapp_number" id="whatsappNumber" required pattern="[0-9]{9,13}"
                                        class="w-full pl-12 pr-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition"
                                        placeholder="81234567890">
                                </div>
                                <div class="hidden text-sm text-red-600 mt-1" id="whatsappNumberError">Please enter a valid WhatsApp number (9-13 digits)</div>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">Email *</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition"
                                    placeholder="your.email@example.com">
                                <div class="hidden text-sm text-red-600 mt-1" id="emailError">Please enter a valid email address</div>
                            </div>

                            <!-- City of Origin -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">City of Origin</label>
                                <input type="text" name="origin_city" id="originCity"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition"
                                    placeholder="Your city">
                            </div>

                            <!-- Referral Code -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-slate-700">Referral Code</label>
                                <input type="text" name="referral_code" id="referralCode" maxlength="20"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition"
                                    placeholder="Enter referral code (if any)">
                            </div>

                            <!-- ✅ PAX — Number of Participants -->
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700">Number of Participants (Pax) *</label>
                                <div class="flex items-center gap-3">
                                    <button type="button" id="paxDecrement"
                                        class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-600 hover:border-amber-400 hover:text-amber-600 transition text-xl font-bold select-none">−</button>
                                    <input type="number" name="pax_count" id="paxCount"
                                        value="1" min="1" max="20" required readonly
                                        class="w-20 text-center px-4 py-3 border border-slate-200 rounded-xl font-semibold text-lg focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition">
                                    <button type="button" id="paxIncrement"
                                        class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-600 hover:border-amber-400 hover:text-amber-600 transition text-xl font-bold select-none">+</button>
                                    <span class="text-sm text-slate-500">runner(s)</span>
                                </div>
                                <p class="text-xs text-slate-400">Package price will be multiplied by number of participants.</p>
                                <div class="hidden text-sm text-red-600 mt-1" id="paxCountError">Minimum 1 participant required</div>
                            </div>
                        </div>
                    </div>

                    <!-- STAY & LOGISTICS -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-white/30 p-6 md:p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold">Stay & Logistics</h3>
                        </div>

                        <div class="space-y-8">
                            <!-- Night Selection -->
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-slate-700">Length of Stay *</label>
                                <div class="flex flex-wrap gap-3">
                                    <label class="night-option relative flex-1 min-w-[80px] cursor-pointer group">
                                        <input type="radio" name="night_count" value="1" required class="sr-only peer">
                                        <div class="p-4 border-2 border-slate-200 rounded-xl peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300 transition-all text-center">
                                            <span class="text-lg font-semibold text-slate-800">1N</span>
                                            <span class="block text-xs text-slate-500 mt-1">1 Night</span>
                                        </div>
                                    </label>
                                    <label class="night-option relative flex-1 min-w-[80px] cursor-pointer group">
                                        <input type="radio" name="night_count" value="2" required class="sr-only peer">
                                        <div class="p-4 border-2 border-slate-200 rounded-xl peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300 transition-all text-center">
                                            <span class="text-lg font-semibold text-slate-800">2N</span>
                                            <span class="block text-xs text-slate-500 mt-1">2 Nights</span>
                                        </div>
                                    </label>
                                    <label class="night-option relative flex-1 min-w-[80px] cursor-pointer group">
                                        <input type="radio" name="night_count" value="3" required class="sr-only peer">
                                        <div class="p-4 border-2 border-slate-200 rounded-xl peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300 transition-all text-center">
                                            <span class="text-lg font-semibold text-slate-800">3N</span>
                                            <span class="block text-xs text-slate-500 mt-1">3 Nights</span>
                                        </div>
                                    </label>
                                </div>
                                <div class="hidden text-sm text-red-600 mt-1" id="nightCountError">Please select length of stay</div>
                            </div>

                            <!-- Hotel Star -->
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-slate-700">Hotel Star Rating *</label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="hotel_star" value="3" required class="w-5 h-5 text-amber-600 border-slate-300 focus:ring-amber-200" id="hotelStar3">
                                        <span class="text-slate-700 group-hover:text-amber-600 transition">★★★ (3 Star Hotel)</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="hotel_star" value="4" required class="w-5 h-5 text-amber-600 border-slate-300 focus:ring-amber-200" id="hotelStar4">
                                        <span class="text-slate-700 group-hover:text-amber-600 transition">★★★★ (4 Star Hotel)</span>
                                    </label>
                                </div>
                                <div class="hidden text-sm text-red-600 mt-1" id="hotelStarError">Please select hotel star rating</div>
                            </div>

                            <!-- Package Selection -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <label class="block text-sm font-medium text-slate-700">Hotel Package *</label>
                                    <span id="packageAvailabilityBadge" class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700 hidden">
                                        <span id="availablePackagesCount">0</span> packages available
                                    </span>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="packageOptions"></div>
                                <div class="hidden text-sm text-red-600 mt-1" id="packageTypeError">Please select a package</div>
                            </div>

                            <!-- Room Type -->
                            <div class="space-y-4" id="roomTypeSection" style="display: none;">
                                <label class="block text-sm font-medium text-slate-700">Room Type *</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="room-option cursor-pointer group" id="twinRoomLabel">
                                        <input type="radio" name="room_type" value="twin" required class="sr-only peer">
                                        <div class="p-5 border-2 border-slate-200 rounded-xl peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300 transition-all">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <div class="text-lg font-semibold text-slate-800">Twin Room</div>
                                                    <div class="text-xs text-slate-500 mt-1">Share with another runner</div>
                                                </div>
                                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">Popular</span>
                                            </div>
                                            <div class="flex justify-between items-center mt-3">
                                                <span class="text-sm text-slate-600">Per person</span>
                                                <span class="text-xl font-bold text-amber-600" id="twinPrice">IDR 0</span>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="room-option cursor-pointer group" id="singleRoomLabel">
                                        <input type="radio" name="room_type" value="single" required class="sr-only peer">
                                        <div class="p-5 border-2 border-slate-200 rounded-xl peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300 transition-all">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <div class="text-lg font-semibold text-slate-800">Single Room</div>
                                                    <div class="text-xs text-slate-500 mt-1">Private room for 1 person</div>
                                                </div>
                                                <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">Private</span>
                                            </div>
                                            <div class="flex justify-between items-center mt-3">
                                                <span class="text-sm text-slate-600">Per person</span>
                                                <span class="text-xl font-bold text-amber-600" id="singlePrice">IDR 0</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="hidden text-sm text-red-600 mt-1" id="roomTypeError">Please select a room type</div>
                            </div>

                            <!-- Dates -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-slate-700">Check-in Date *</label>
                                    <div class="relative">
                                        <input type="date" name="checkin_date" id="checkinDate" required readonly
                                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition custom-datepicker">
                                    </div>
                                    <div class="hidden text-sm text-red-600 mt-1" id="checkinDateError">Please select check-in date</div>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-slate-700">Check-out Date *</label>
                                    <div class="relative">
                                        <input type="date" name="checkout_date" id="checkoutDate" required readonly
                                            class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-600 cursor-not-allowed custom-datepicker">
                                    </div>
                                    <div class="hidden text-sm text-red-600 mt-1" id="checkoutDateError">Please select check-out date</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-white/30 p-6 md:p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold">Add-ons</h3>
                        </div>

                        <div class="space-y-6">
                            <!-- Airport Transfer Note -->
                            <!-- Airport Transfer Schedule Note -->
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-5 shadow-sm">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Airport Transfer Schedule</p>
                                        <p class="text-xs text-amber-600 font-medium">Every 2 hours · 09.00 – 21.00 WIB</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-7 gap-1.5">
                                    @foreach (['09.00', '11.00', '13.00', '15.00', '17.00', '19.00', '21.00'] as $time)
                                    <div class="flex flex-col items-center gap-1 bg-white border border-amber-100 rounded-xl py-2 px-1 shadow-sm">
                                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-xs font-bold text-slate-700">{{ $time }}</span>
                                    </div>
                                    @endforeach
                                </div>

                                <p class="text-xs text-slate-500 mt-3 flex items-start gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-amber-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pastikan jadwal kedatangan Anda sesuai dengan slot penjemputan yang tersedia. Tim kami akan standby di area kedatangan.
                                </p>
                            </div>
                            <!-- Flight Booking -->
                            <div class="p-4 border border-slate-200 rounded-xl hover:border-amber-200 transition">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" name="flight_booking" id="flightBooking"
                                        class="w-6 h-6 mt-1 text-amber-600 rounded border-slate-300 focus:ring-amber-200">
                                    <div class="flex-1">
                                        <span class="text-slate-700 font-medium">Flight Booking Assistance</span>
                                        <p class="text-sm text-slate-500 mt-1">Let us help you find and book the best flights. You will be contacted via WhatsApp to proceed.</p>
                                    </div>
                                </label>
                            </div>

                            <!-- Hydration Pack -->
                            <div class="p-4 border border-slate-200 rounded-xl hover:border-amber-200 transition">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" name="hydration_pack" id="hydrationPack"
                                        class="w-6 h-6 mt-1 text-amber-600 rounded border-slate-300 focus:ring-amber-200"
                                        data-price="250000">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <span class="text-slate-700 font-medium">Premium Hydration Pack</span>
                                            <span class="text-amber-600 font-bold">+IDR 250K</span>
                                        </div>
                                        <div class="mt-2 text-sm text-slate-600 bg-slate-50 p-3 rounded-lg">
                                            <p class="font-medium mb-1">Includes:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Isotonic drinks during race</li>
                                                <li>Mineral water supply</li>
                                                <li>Premium race towel</li>
                                                <li>Energy gels (2 packs)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Additional Services -->
                            <div class="p-4 border border-slate-200 rounded-xl hover:border-amber-200 transition">
                                <label class="block text-sm font-medium text-slate-700 mb-3">Additional Services</label>
                                <div class="space-y-3">
                                    <label class="flex items-center justify-between gap-3 cursor-pointer p-3 hover:bg-slate-50 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="late_checkout" id="lateCheckout"
                                                class="w-5 h-5 text-amber-600 rounded border-slate-300 focus:ring-amber-200"
                                                data-price="300000">
                                            <div>
                                                <span class="text-slate-700">Late Check-out</span>
                                                <p class="text-xs text-slate-500 mt-1">Subject to hotel availability on race day</p>
                                            </div>
                                        </div>
                                        <span class="text-amber-600 font-semibold">+IDR 300K</span>
                                    </label>
                                    <label class="flex items-center justify-between gap-3 cursor-pointer p-3 hover:bg-slate-50 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="early_checkin" id="earlyCheckin"
                                                class="w-5 h-5 text-amber-600 rounded border-slate-300 focus:ring-amber-200"
                                                data-price="300000">
                                            <div>
                                                <span class="text-slate-700">Early Check-in</span>
                                                <p class="text-xs text-slate-500 mt-1">Subject to hotel availability on race day</p>
                                            </div>
                                        </div>
                                        <span class="text-amber-600 font-semibold">+IDR 300K</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="hiddenSubmit" style="display: none;">Submit</button>
                </form>
            </div>

            <!-- SIDEBAR -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-24 space-y-4">

                    <!-- PRICE SUMMARY -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-white/30 p-6 shadow-xl hover:shadow-2xl transition-all">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold">Price Summary</h3>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-slate-600">Package</span>
                                <span class="font-semibold" id="summaryPackagePrice">IDR 0</span>
                            </div>

                            <div class="flex justify-between items-center py-1" id="paxBreakdownRow" style="display:none !important;">
                                <span class="text-slate-400 text-xs">× <span id="summaryPaxCount">1</span> peserta</span>
                                <span class="text-xs text-slate-400" id="summaryPricePerPax"></span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-slate-100"
                                id="summaryDiscountRow" style="display:none;">
                                <span class="text-green-600">Referral Discount</span>
                                <span class="font-semibold text-green-600" id="summaryDiscount">-IDR 0</span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-slate-600">Add-ons</span>
                                <span class="font-semibold" id="summaryAddons">IDR 0</span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-lg font-bold text-slate-800">Total</span>
                                <span class="text-2xl font-bold text-amber-600" id="summaryTotal">IDR 0</span>
                            </div>
                        </div>

                        <!-- Booking Button -->
                        <div class="mt-4">
                            <button type="button"
                                onclick="document.getElementById('bookingForm').requestSubmit()"
                                class="relative w-full group overflow-hidden rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 px-6 py-4 text-white font-semibold tracking-wide shadow-lg shadow-amber-500/20 transition-all duration-300 hover:shadow-2xl hover:shadow-amber-500/40 hover:-translate-y-0.5 active:scale-[0.98]">
                                <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out"></span>
                                <span class="relative flex items-center justify-center gap-2">
                                    <!-- WhatsApp icon -->
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                    </svg>
                                    Confirm & Book via WhatsApp
                                </span>
                            </button>
                            <p class="text-xs text-center text-slate-400 mt-3">
                                You'll be redirected to WhatsApp to complete your booking.
                            </p>
                        </div>
                    </div>

                    <!-- BOOKING DETAILS -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-3xl border border-white/30 p-6 shadow-xl hover:shadow-2xl transition-all">
                        <h3 class="text-xl font-bold mb-4">Booking Details</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-2 text-sm">
                                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <div>
                                    <span class="text-slate-500">Package:</span>
                                    <span class="font-semibold text-slate-800 block" id="summaryPackageName">-</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-2 text-sm">
                                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-slate-500">Participants:</span>
                                    <span class="font-semibold text-slate-800 block" id="summaryPaxDisplay">1 runner</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-2 text-sm">
                                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <span class="text-slate-500">Stay:</span>
                                    <span class="font-semibold text-slate-800 block" id="summaryStayDetails">-</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-2 text-sm">
                                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-slate-500">Room:</span>
                                    <span class="font-semibold text-slate-800 block" id="summaryRoomType">-</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-2 text-sm">
                                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-slate-500">Benefits:</span>
                                    <span class="text-slate-600 block mt-1" id="summaryBenefits">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SUCCESS MODAL -->
<div id="successModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50 backdrop-blur-sm"></div>
        <div class="relative bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all max-w-md w-full">
            <div class="relative p-8 text-center">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 mb-6">
                    <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Booking Submitted!</h3>
                <p class="text-gray-600 mb-6">Redirecting you to WhatsApp to complete your booking...</p>
                <div class="space-y-3">
                    <div class="text-left bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Booking ID</p>
                        <p class="font-mono font-bold text-lg" id="modalBookingId"></p>
                    </div>
                    <div class="text-left bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Package</p>
                        <p class="font-bold text-lg" id="modalPackageType"></p>
                    </div>
                    <div class="text-left bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500">Total Amount</p>
                        <p class="text-2xl font-bold text-amber-600" id="modalTotalAmount"></p>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="button" id="modalWaBtn"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold hover:from-green-600 hover:to-emerald-700 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Open WhatsApp Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FLOATING WA BUTTON -->
<a href="https://wa.me/6285727767777" target="_blank" class="fixed bottom-6 right-6 z-50 group">
    <div class="relative flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-110">
        <span class="absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-30 animate-ping"></span>
        <svg class="w-7 h-7 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
        </svg>
    </div>
    <span class="absolute right-16 bottom-1/2 translate-y-1/2 bg-black text-white text-xs px-3 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">Need Help?</span>
</a>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ── Hotel price database (+350.000 dari harga lama) ────────────────────────
        const hotelPrices = {
            '1-3': {
                'paket1': {
                    twin: 1350000, // was 1000000
                    single: 1750000, // was 1400000
                    name: 'Paket 1 - Basic'
                },
                'paket2': {
                    twin: 1600000, // was 1250000
                    single: 2000000, // was 1650000
                    name: 'Paket 2 - Comfort'
                },
                'paket3': {
                    twin: 2400000, // was 2050000
                    single: 4100000, // was 3750000
                    name: 'Paket 3 - Premium'
                }
            },
            '1-4': {
                'paket1': {
                    twin: 1900000, // was 1550000
                    single: 2900000, // was 2550000
                    name: 'Paket 1 - Basic'
                },
                'paket2': {
                    twin: 2200000, // was 1850000
                    single: 3100000, // was 2750000
                    name: 'Paket 2 - Comfort'
                },
                'paket3': {
                    twin: 2950000, // was 2600000
                    single: 5300000, // was 4950000
                    name: 'Paket 3 - Premium'
                }
            },
            '2-3': {
                'paket1': {
                    twin: 1600000, // was 1250000
                    single: 2300000, // was 1950000
                    name: 'Paket 1 - Basic'
                },
                'paket2': {
                    twin: 2000000, // was 1650000
                    single: 2800000, // was 2450000
                    name: 'Paket 2 - Comfort'
                },
                'paket3': {
                    twin: 3950000, // was 3600000
                    single: 7100000, // was 6750000
                    name: 'Paket 3 - Premium'
                }
            },
            '2-4': {
                'paket1': {
                    twin: 2900000, // was 2550000
                    single: 4900000, // was 4550000
                    name: 'Paket 1 - Basic'
                },
                'paket2': {
                    twin: 3150000, // was 2800000
                    single: 5150000, // was 4800000
                    name: 'Paket 2 - Comfort'
                },
                'paket3': {
                    twin: 5050000, // was 4700000
                    single: 9250000, // was 8900000
                    name: 'Paket 3 - Premium'
                }
            },
            '3-3': {
                'paket1': {
                    twin: 1950000, // was 1600000
                    single: 2950000, // was 2600000
                    name: 'Paket 1 - Basic'
                },
                'paket2': {
                    twin: 2450000, // was 2100000
                    single: 3600000, // was 3250000
                    name: 'Paket 2 - Comfort'
                },
                'paket3': {
                    twin: 5550000, // was 5200000
                    single: 10100000, // was 9750000
                    name: 'Paket 3 - Premium'
                }
            },
            '3-4': {
                'paket1': {
                    twin: 3900000, // was 3550000
                    single: 6950000, // was 6600000
                    name: 'Paket 1 - Basic'
                },
                'paket2': {
                    twin: 4100000, // was 3750000
                    single: 7250000, // was 6900000
                    name: 'Paket 2 - Comfort'
                },
                'paket3': {
                    twin: 7150000, // was 6800000
                    single: 13250000, // was 12900000
                    name: 'Paket 3 - Premium'
                }
            }
        };

        const packageBenefits = {
            'paket1': ['Standard room accommodation', 'Daily breakfast', 'Airport shuttle (schedule)', 'Race bib pick-up assistance', '24/7 reception service'],
            'paket2': ['Superior room accommodation', 'Enhanced breakfast buffet', 'Private airport transfer', 'Race bib delivery to hotel', 'Race day transport', 'Welcome snack'],
            'paket3': ['Deluxe room accommodation', 'Premium breakfast & dinner', 'VIP airport transfer (private car)', 'Personal race assistant', 'Priority race transport', 'Post-race recovery package', 'Late check-out (subject to availability)']
        };

        // ── State ──────────────────────────────────────────────────────────────────
        let selectedNight = null;
        let selectedHotelStar = null;
        let selectedPackageId = null;
        let selectedRoomType = null;
        let currentPax = 1;
        let pendingWaUrl = null;

        // ── DOM refs ───────────────────────────────────────────────────────────────
        const bookingForm = document.getElementById('bookingForm');
        const nightInputs = document.querySelectorAll('input[name="night_count"]');
        const hotelStarInputs = document.querySelectorAll('input[name="hotel_star"]');
        const packageOptionsContainer = document.getElementById('packageOptions');
        const roomTypeSection = document.getElementById('roomTypeSection');
        const twinPriceEl = document.getElementById('twinPrice');
        const singlePriceEl = document.getElementById('singlePrice');
        const addonCheckboxes = document.querySelectorAll('input[type="checkbox"][data-price]');
        const charCount = document.getElementById('charCount');
        const summaryPackagePrice = document.getElementById('summaryPackagePrice');
        const summaryAddons = document.getElementById('summaryAddons');
        const summaryTotal = document.getElementById('summaryTotal');
        const summaryPackageName = document.getElementById('summaryPackageName');
        const summaryStayDetails = document.getElementById('summaryStayDetails');
        const summaryRoomType = document.getElementById('summaryRoomType');
        const summaryBenefits = document.getElementById('summaryBenefits');
        const summaryPaxDisplay = document.getElementById('summaryPaxDisplay');
        const paxBreakdownRow = document.getElementById('paxBreakdownRow');
        const summaryPaxCount = document.getElementById('summaryPaxCount');
        const summaryPricePerPaxEl = document.getElementById('summaryPricePerPax');
        const packageAvailabilityBadge = document.getElementById('packageAvailabilityBadge');
        const availablePackagesCount = document.getElementById('availablePackagesCount');
        const paxCountInput = document.getElementById('paxCount');

        // ── Helpers ────────────────────────────────────────────────────────────────
        function formatCurrency(amount) {
            return 'IDR ' + amount.toLocaleString('id-ID');
        }

        function getHotelPriceKey() {
            return (selectedNight && selectedHotelStar) ? `${selectedNight}-${selectedHotelStar}` : null;
        }

        function calculateAddons() {
            let total = 0;
            document.querySelectorAll('input[type="checkbox"][data-price]').forEach(cb => {
                if (cb.checked) total += parseInt(cb.dataset.price);
            });
            return total;
        }

        function showError(id) {
            const el = document.getElementById(id);
            if (el) el.classList.remove('hidden');
        }

        function resetErrors() {
            document.querySelectorAll('[id$="Error"]').forEach(el => el.classList.add('hidden'));
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        // ── Pax increment / decrement ──────────────────────────────────────────────
        document.getElementById('paxIncrement').addEventListener('click', function() {
            const val = parseInt(paxCountInput.value);
            if (val < 20) {
                paxCountInput.value = val + 1;
                currentPax = val + 1;
                updateSummary();
            }
        });

        document.getElementById('paxDecrement').addEventListener('click', function() {
            const val = parseInt(paxCountInput.value);
            if (val > 1) {
                paxCountInput.value = val - 1;
                currentPax = val - 1;
                updateSummary();
            }
        });

        // ── Load packages ──────────────────────────────────────────────────────────
        function loadPackages() {
            const key = getHotelPriceKey();
            if (!key) {
                packageOptionsContainer.innerHTML = '<div class="col-span-3 text-center py-8 text-slate-500">Please select night stay and hotel star rating first</div>';
                return;
            }
            const packages = hotelPrices[key];
            if (!packages) {
                packageOptionsContainer.innerHTML = '<div class="col-span-3 text-center py-8 text-slate-500">No packages available for this combination</div>';
                return;
            }

            packageOptionsContainer.innerHTML = '';
            const packageKeys = Object.keys(packages);
            availablePackagesCount.textContent = packageKeys.length;
            packageAvailabilityBadge.classList.remove('hidden');

            packageKeys.forEach(pkgId => {
                const pkg = packages[pkgId]
                const benefits = packageBenefits[pkgId] || [];

                const el = document.createElement('label');
                el.className = 'cursor-pointer group';
                el.innerHTML = `
                <input type="radio" name="package_type" value="${pkgId}" required class="sr-only peer"
                    data-twin="${pkg.twin}" data-single="${pkg.single}" data-name="${pkg.name}">
                <div class="h-full p-5 border-2 border-slate-200 rounded-2xl peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300 hover:bg-amber-50/50 transition-all">
                    <div class="text-center mb-4">
                        <h4 class="text-lg font-bold text-slate-800">${pkg.name}</h4>
                        <div class="text-sm text-slate-500 mt-1">Starting from</div>
                        <div class="text-2xl font-bold text-amber-600 mt-1">${formatCurrency(pkg.twin)}</div>
                    </div>
                    <ul class="space-y-2 text-xs text-slate-600">
                        ${benefits.slice(0, 3).map(b => `
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>${b}</span>
                            </li>`).join('')}
                        ${benefits.length > 3 ? '<li class="text-amber-600 text-xs mt-1">+ more benefits</li>' : ''}
                    </ul>
                </div>`;
                packageOptionsContainer.appendChild(el);
            });

            packageOptionsContainer.querySelectorAll('input[name="package_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    selectedPackageId = this.value;
                    updateRoomPrices(this);
                    updateSummary();
                    roomTypeSection.style.display = 'block';
                });
            });

            if (window.pendingPackageData) {
                setTimeout(() => selectPackageFromData(window.pendingPackageData), 100);
            }
        }

        function updateRoomPrices(selectedPackage) {
            if (selectedPackage) {
                twinPriceEl.textContent = formatCurrency(parseInt(selectedPackage.dataset.twin));
                singlePriceEl.textContent = formatCurrency(parseInt(selectedPackage.dataset.single));
            }
        }

        // ── Update summary (with pax × price) ─────────────────────────────────────
        function updateSummary() {
            const selectedPackage = document.querySelector('input[name="package_type"]:checked');
            const selectedRoom = document.querySelector('input[name="room_type"]:checked');
            const addonsTotal = calculateAddons();
            let packagePrice = 0;
            let totalPrice = 0;

            if (selectedPackage && selectedRoom) {
                const pricePerPax = selectedRoom.value === 'twin' ?
                    parseInt(selectedPackage.dataset.twin) :
                    parseInt(selectedPackage.dataset.single);

                packagePrice = pricePerPax * currentPax;

                // Hitung diskon referral
                const discountTotal = referralDiscount * currentPax;
                totalPrice = packagePrice + addonsTotal - discountTotal;

                const discountRow = document.getElementById('summaryDiscountRow');
                if (discountTotal > 0) {
                    discountRow.style.display = 'flex';
                    document.getElementById('summaryDiscount').textContent = '-' + formatCurrency(discountTotal);
                } else {
                    discountRow.style.display = 'none';
                }

                summaryPackagePrice.textContent = formatCurrency(packagePrice);
                summaryPackageName.textContent = selectedPackage.dataset.name;

                const nightText = selectedNight ? `${selectedNight} Night${selectedNight > 1 ? 's' : ''}` : '-';
                const starText = selectedHotelStar ? `${selectedHotelStar} Star Hotel` : '-';
                summaryStayDetails.textContent = `${nightText} • ${starText}`;
                summaryRoomType.textContent = selectedRoom.value === 'twin' ? 'Twin Room (Sharing)' : 'Single Room (Private)';

                if (selectedPackageId && packageBenefits[selectedPackageId]) {
                    summaryBenefits.innerHTML = packageBenefits[selectedPackageId].slice(0, 2).join(' • ');
                }

                // Pax breakdown
                if (currentPax > 1) {
                    paxBreakdownRow.style.cssText = 'display:flex !important';
                    summaryPaxCount.textContent = currentPax;
                    summaryPricePerPaxEl.textContent = formatCurrency(pricePerPax) + '/orang';
                } else {
                    paxBreakdownRow.style.cssText = 'display:none !important';
                }
            } else {
                summaryPackagePrice.textContent = 'IDR 0';
                summaryPackageName.textContent = '-';
                summaryStayDetails.textContent = '-';
                summaryRoomType.textContent = '-';
                summaryBenefits.innerHTML = '-';
                paxBreakdownRow.style.cssText = 'display:none !important';
            }

            summaryPaxDisplay.textContent = currentPax + ' runner' + (currentPax > 1 ? 's' : '');
            summaryAddons.textContent = formatCurrency(addonsTotal);
            summaryTotal.textContent = formatCurrency(totalPrice);
        }

        // ── Reset ──────────────────────────────────────────────────────────────────
        function resetPackageAndRoom() {
            document.querySelectorAll('input[name="package_type"]').forEach(r => r.checked = false);
            document.querySelectorAll('input[name="room_type"]').forEach(r => r.checked = false);
            selectedPackageId = null;
            selectedRoomType = null;
            roomTypeSection.style.display = 'none';
        }

        // ── Date handling ──────────────────────────────────────────────────────────
        const defaultDate = '2026-06-12';
        const today = new Date().toISOString().split('T')[0];
        const minDate = today > defaultDate ? today : defaultDate;

        document.getElementById('checkinDate').min = minDate;
        document.getElementById('checkinDate').value = defaultDate;

        function calculateCheckoutDate(checkinDate, nightCount) {
            if (!checkinDate || !nightCount) return '';
            const d = new Date(checkinDate);
            d.setDate(d.getDate() + parseInt(nightCount));
            return d.toISOString().split('T')[0];
        }

        function updateCheckoutDate() {
            const checkin = document.getElementById('checkinDate').value;
            const nightCount = selectedNight || '2';
            if (checkin && nightCount) {
                document.getElementById('checkoutDate').value = calculateCheckoutDate(checkin, nightCount);
            }
        }

        updateCheckoutDate();

        document.getElementById('checkinDate').addEventListener('change', updateCheckoutDate);

        // ── Auto-select package from URL params ────────────────────────────────────
        function selectPackageFromData(packageData) {
            if (!packageData) return;
            const packageRadio = document.querySelector(`input[name="package_type"][value="${packageData.type}"]`);
            if (packageRadio) {
                packageRadio.checked = true;
                selectedPackageId = packageData.type;
                updateRoomPrices(packageRadio);
                packageRadio.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
                roomTypeSection.style.display = 'block';

                setTimeout(() => {
                    const twinRadio = document.querySelector('input[name="room_type"][value="twin"]');
                    if (twinRadio) {
                        twinRadio.checked = true;
                        selectedRoomType = 'twin';
                        twinRadio.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                    updateCheckoutDate();
                    updateSummary();
                }, 200);
                window.pendingPackageData = null;
            }
        }

        // ── Event listeners ────────────────────────────────────────────────────────
        nightInputs.forEach(input => {
            input.addEventListener('change', function() {
                selectedNight = this.value;
                loadPackages();
                resetPackageAndRoom();
                updateSummary();
                updateCheckoutDate();
            });
        });

        hotelStarInputs.forEach(input => {
            input.addEventListener('change', function() {
                selectedHotelStar = this.value;
                loadPackages();
                resetPackageAndRoom();
                updateSummary();
            });
        });

        document.querySelectorAll('input[name="room_type"]').forEach(input => {
            input.addEventListener('change', function() {
                selectedRoomType = this.value;
                updateSummary();
            });
        });

        addonCheckboxes.forEach(cb => cb.addEventListener('change', updateSummary));
        document.getElementById('lateCheckout')?.addEventListener('change', updateSummary);
        document.getElementById('earlyCheckin')?.addEventListener('change', updateSummary);

        // ── Form submit ────────────────────────────────────────────────────────────
        bookingForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            resetErrors();

            let isValid = true;

            if (!document.getElementById('eventName').value) {
                showError('eventNameError');
                isValid = false;
            }
            const runnerName = document.getElementById('runnerName').value;
            if (!runnerName || runnerName.length < 3) {
                showError('runnerNameError');
                isValid = false;
            }
            const whatsapp = document.getElementById('whatsappNumber').value;
            if (!whatsapp || !/^[0-9]{9,13}$/.test(whatsapp)) {
                showError('whatsappNumberError');
                isValid = false;
            }
            const email = document.getElementById('email').value;
            if (!email || !isValidEmail(email)) {
                showError('emailError');
                isValid = false;
            }
            if (!selectedNight) {
                showError('nightCountError');
                isValid = false;
            }
            if (!selectedHotelStar) {
                showError('hotelStarError');
                isValid = false;
            }
            if (!selectedPackageId) {
                showError('packageTypeError');
                isValid = false;
            }
            if (!document.getElementById('checkinDate').value) {
                showError('checkinDateError');
                isValid = false;
            }
            if (!document.getElementById('checkoutDate').value) {
                showError('checkoutDateError');
                isValid = false;
            }
            if (!document.querySelector('input[name="room_type"]:checked')) {
                showError('roomTypeError');
                isValid = false;
            }

            if (!isValid) return;

            const submitBtn = document.querySelector('button[onclick*="requestSubmit"]');
            const originalHtml = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="flex items-center justify-center gap-2">Processing... <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg></span>';
            submitBtn.disabled = true;

            try {
                const selectedPackage = document.querySelector('input[name="package_type"]:checked');
                const selectedRoom = document.querySelector('input[name="room_type"]:checked');

                const pricePerPax = selectedRoom.value === 'twin' ?
                    parseInt(selectedPackage.dataset.twin) :
                    parseInt(selectedPackage.dataset.single);
                const packagePrice = pricePerPax * currentPax;
                const addonsTotal = calculateAddons();
                const totalPrice = packagePrice + addonsTotal;

                const formData = new FormData(bookingForm);
                formData.set('package_name', selectedPackage.dataset.name);
                formData.set('package_type', selectedPackageId);
                formData.set('package_price', packagePrice);
                formData.set('addons_total', addonsTotal);
                formData.set('total_price', totalPrice);
                formData.set('night_count', selectedNight);
                formData.set('hotel_star', selectedHotelStar);
                formData.set('room_type', selectedRoom.value === 'twin' ? 'sharing' : 'single');
                formData.set('twin_price', selectedPackage.dataset.twin);
                formData.set('single_price', selectedPackage.dataset.single);
                formData.set('pax_count', currentPax);
                formData.set('hydration_pack', document.getElementById('hydrationPack')?.checked ? '1' : '0');
                formData.set('late_checkout', document.getElementById('lateCheckout')?.checked ? '1' : '0');
                formData.set('early_checkin', document.getElementById('earlyCheckin')?.checked ? '1' : '0');
                formData.set('flight_booking', document.getElementById('flightBooking')?.checked ? '1' : '0');

                const response = await fetch('/booking/submit', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    pendingWaUrl = result.wa_url;

                    // Tampilkan modal dulu
                    document.getElementById('modalBookingId').textContent = result.booking_id;
                    document.getElementById('modalPackageType').textContent = selectedPackage.dataset.name;
                    document.getElementById('modalTotalAmount').textContent = formatCurrency(totalPrice);
                    document.getElementById('successModal').classList.remove('hidden');

                    // Tombol di modal
                    document.getElementById('modalWaBtn').onclick = function() {
                        window.location.href = pendingWaUrl;
                    };

                    // Auto redirect ke WA setelah 2 detik
                    setTimeout(() => {
                        if (pendingWaUrl) window.location.href = pendingWaUrl;
                    }, 2000);
                } else {
                    alert('Failed to create booking: ' + (result.message || 'Unknown error'));
                    submitBtn.innerHTML = originalHtml;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                submitBtn.innerHTML = originalHtml;
                submitBtn.disabled = false;
            }
        });

        // Referral code validation
        const referralInput = document.getElementById('referralCode');
        let referralTimeout = null;
        let referralDiscount = 0;

        referralInput.addEventListener('input', function() {
            clearTimeout(referralTimeout);
            const code = this.value.trim().toUpperCase();

            // Hapus badge sebelumnya
            const existing = document.getElementById('referralBadge');
            if (existing) existing.remove();

            if (!code) {
                referralDiscount = 0;
                updateSummary();
                return;
            }

            referralTimeout = setTimeout(async () => {
                try {
                    const res = await fetch(`/api/referral/validate?code=${code}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();

                    const badge = document.createElement('div');
                    badge.id = 'referralBadge';

                    if (data.valid) {
                        referralDiscount = data.discount_per_pax;
                        badge.className = 'mt-2 text-sm text-green-600 flex items-center gap-1';
                        badge.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Kode valid — diskon <strong>IDR 150.000/pax</strong> diterapkan
                `;
                    } else {
                        referralDiscount = 0;
                        badge.className = 'mt-2 text-sm text-red-500 flex items-center gap-1';
                        badge.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Kode referral tidak valid atau belum aktif
                `;
                    }

                    referralInput.parentElement.appendChild(badge);
                    updateSummary();
                } catch (e) {
                    console.error('Referral check failed', e);
                }
            }, 600); // debounce 600ms
        });

        // ── URL params auto-fill ───────────────────────────────────────────────────
        const urlParams = new URLSearchParams(window.location.search);
        const packageParam = urlParams.get('package');
        if (packageParam) {
            try {
                const packageData = JSON.parse(decodeURIComponent(packageParam));
                window.pendingPackageData = packageData;

                if (packageData.night_count) {
                    const nightRadio = document.querySelector(`input[name="night_count"][value="${packageData.night_count}"]`);
                    if (nightRadio) {
                        nightRadio.checked = true;
                        selectedNight = packageData.night_count;
                        nightRadio.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                }
                if (packageData.hotel_star) {
                    const starRadio = document.querySelector(`input[name="hotel_star"][value="${packageData.hotel_star}"]`);
                    if (starRadio) {
                        starRadio.checked = true;
                        selectedHotelStar = packageData.hotel_star;
                        starRadio.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));
                    }
                }
                setTimeout(() => {
                    if (window.pendingPackageData) {
                        selectPackageFromData(window.pendingPackageData);
                        window.pendingPackageData = null;
                    }
                }, 3000);
            } catch (e) {
                console.error('Error parsing package data:', e);
            }
        }

        // Initial render
        updateSummary();
    });
</script>

<style>
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .animate-shimmer {
        animation: shimmer 2s infinite;
    }

    input[type="date"].custom-datepicker {
        -webkit-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.25rem;
        padding-right: 3rem;
    }

    #packageOptions label {
        transition: all 0.3s ease;
    }

    #packageOptions label:hover>div {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(245, 158, 11, .1);
    }

    #packageOptions .peer:checked~div {
        border-color: #f59e0b;
        background: linear-gradient(to bottom right, #fffbeb, #fff);
        box-shadow: 0 20px 30px -10px rgba(245, 158, 11, .2);
    }

    .room-option:hover>div {
        border-color: #f59e0b;
        background-color: #fffbeb;
        transform: translateY(-2px);
    }

    .room-option .peer:checked~div {
        border-color: #f59e0b;
        background: linear-gradient(to bottom right, #fffbeb, #fff);
        box-shadow: 0 10px 20px -5px rgba(245, 158, 11, .15);
    }

    .night-option:hover>div {
        border-color: #f59e0b;
        background-color: #fffbeb;
    }

    .night-option .peer:checked~div {
        border-color: #f59e0b;
        background: linear-gradient(to bottom right, #fffbeb, #fff);
    }

    #summaryTotal {
        transition: all 0.3s ease;
    }

    input[type="checkbox"]:checked {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }

    input[type="radio"]:checked {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    *:focus-visible {
        outline: 2px solid #f59e0b;
        outline-offset: 2px;
    }

    select:disabled,
    input:disabled,
    button:disabled {
        opacity: .5;
        cursor: not-allowed;
    }
</style>
@endsection