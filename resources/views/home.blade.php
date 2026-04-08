@extends('main')

@section('content')
@include('component.loadingScreen')

<div class="relative overflow-hidden">
    <video autoplay muted loop playsinline preload="metadata"
        src="{{ asset('Videos/IMG_9552.MOV') }}"
        class="hidden md:block w-full h-screen object-cover">
    </video>

    <video autoplay muted loop playsinline preload="metadata"
        src="{{ asset('Videos/IMG_9486.MOV') }}"
        class="block md:hidden w-full h-screen object-cover">
    </video>

    <div class="absolute inset-0 flex flex-col items-center justify-center px-6 text-white text-center animate-fadeIn">

        <div class="absolute left-0 right-0 bottom-12 md:bottom-30 flex flex-col items-center gap-6">

            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                <a href="/Tour"
                    class="group bg-[#BFA46F]/50 hover:bg-[#a89258] text-black font-bold tracking-wide px-10 py-3 rounded-xl shadow-xl transition-all duration-300 uppercase flex items-center gap-2">
                    <span>Explore My Journey</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform group-hover:translate-x-1"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>

                <!-- SECONDARY -->
                <a href="/Custom-Form"
                    class="group bg-[#1A1A1D]/40 hover:bg-[#242428] text-sm text-white tracking-wide px-10 py-3 rounded-xl border border-[#BFA46F]/40 shadow-lg transition-all duration-300 uppercase flex items-center gap-2">
                    <span>Design My Journey</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform group-hover:translate-x-1"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- PREMIUM MARATHON EVENT --}}
<section class="relative bg-[#0b0f14] text-white py-24 overflow-hidden">

    <!-- BACKGROUND LAYERS -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0b0f14] via-[#111827] to-[#020617]"></div>
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,rgba(191,164,111,0.25),transparent_60%)]"></div>

    <div class="relative container mx-auto px-6 md:px-20">

        <!-- HEADER -->
        <div class="max-w-3xl mb-16">

            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tight mb-6">
                Bossku Marathon <span class="text-[#BFA46F]">2026</span>
            </h2>

            <p class="text-gray-300 text-lg leading-relaxed">
                A long term commitment to health, discipline, and collective growth.
                Not a race of speed but a statement of consistency.
            </p>
        </div>

        <!-- MAIN GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-stretch">

            <!-- LEFT : EVENT DETAIL -->
            <div class="lg:col-span-2 bg-white/5 backdrop-blur-xl rounded-3xl p-10 border border-white/10 shadow-2xl">

                <div class="grid md:grid-cols-2 gap-8 mb-10">

                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Event Period</p>
                        <p class="text-2xl font-semibold text-[#BFA46F]">June 13 - 14, 2026</p>
                        <p class="text-gray-400 text-sm mt-1">Start • Finish • Celebrate</p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Location</p>
                        <p class="text-2xl font-semibold">Jakarta</p>
                        <p class="text-gray-400 text-sm mt-1">Monas - GBK Jogging Track</p>
                    </div>

                </div>

                <!-- TIMELINE -->
                <div class="border-t border-white/10 pt-8">
                    <p class="text-sm uppercase tracking-widest text-gray-400 mb-6">Event Flow</p>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="rounded-xl bg-white/5 p-5 border border-white/10">
                            <p class="text-[#BFA46F] font-semibold mb-1">Warm Up</p>
                            <p class="text-sm text-gray-400">Preparation & briefing</p>
                        </div>

                        <div class="rounded-xl bg-white/5 p-5 border border-white/10">
                            <p class="text-[#BFA46F] font-semibold mb-1">Marathon Run</p>
                            <p class="text-sm text-gray-400">Endurance & pacing</p>
                        </div>

                        <div class="rounded-xl bg-white/5 p-5 border border-white/10">
                            <p class="text-[#BFA46F] font-semibold mb-1">Celebration</p>
                            <p class="text-sm text-gray-400">Recognition & bonding</p>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="/form-event"
                        class="bg-[#BFA46F] text-black font-semibold px-8 py-4 rounded-full shadow-lg hover:scale-105 transition">
                        View Program Detail
                    </a>
                </div>

            </div>

            <!-- RIGHT : STATS -->
            <div class="bg-gradient-to-b from-white/10 to-white/5 backdrop-blur-2xl 
            rounded-3xl p-10 border border-white/10 shadow-[0_20px_60px_rgba(0,0,0,0.6)] 
            flex flex-col justify-between">

                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-gray-400 mb-8">
                        Event Overview
                    </p>

                    <!-- PARTICIPANTS -->
                    <div class="mb-10">
                        <p class="text-5xl font-light text-[#E6D5A3] leading-none">30.000+</p>
                        <p class="text-gray-400 text-sm mt-3 tracking-wide">
                            Estimated Participants
                        </p>
                    </div>

                    <!-- RACE CATEGORIES -->
                    <div>
                        <p class="text-xs uppercase tracking-[0.35em] text-gray-400 mb-6">
                            Race Categories
                        </p>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                                <p class="text-lg font-light text-white">5K</p>
                            </div>

                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                                <p class="text-lg font-light text-white">10K</p>
                            </div>

                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                                <p class="text-lg font-light text-white">Half Marathon</p>
                            </div>

                            <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                                <p class="text-lg font-light text-white">Full Marathon</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COUNTDOWN -->
                <div class="mt-12 pt-8 border-t border-white/10 text-center">
                    <p class="text-xs uppercase tracking-[0.35em] text-gray-400 mb-3">
                        Event Countdown
                    </p>
                    <p id="countdown"
                        class="text-2xl font-light tracking-[0.3em] text-[#E6D5A3]">
                        -- : -- : -- : --
                    </p>
                </div>

            </div>


        </div>
    </div>
</section>

<div class="container mx-auto max-w-xl py-12 px-4 md:px-12">
    <div class="flex flex-col items-center text-center">
        <h2 class="text-xl md:text-4xl font-extrabold text-gray-800 mb-2 leading-tight tracking-tight">
            More Than Just a Journey
        </h2>

        <p class="text-sm md:text-base text-gray-600 mb-4 text-pretty leading-relaxed tracking-wide">
            Maybe what you need isn’t another vacation. Maybe it’s a pause. A breath. A moment to feel something real again.
        </p>

        <p class="text-sm md:text-base text-gray-600 mb-4 text-pretty leading-relaxed tracking-wide">
            At Bossku, travel is not an escape. It is a return. To meaning. To gratitude. To the parts of you time quietly set aside.
        </p>


        <div class="my-6">
            <a href="contact.php"
                class="inline-block border border-[#02335B] text-[#02335B] hover:bg-[#FFCA10] hover:text-[#02335B] font-semibold px-8 py-3 rounded-full shadow-sm transition-all duration-300 text-lg tracking-wide">
                Find The Journey That Calls You
            </a>
        </div>

    </div>
</div>


<section class="relative bg-gradient-to-br from-[#0a0a0a] via-[#111] to-[#1a1a1a] text-white py-8 overflow-hidden">

    <div class="relative container mx-auto px-6 md:px-16 text-center space-y-8">
        <h2 class="text-3xl md:text-4xl font-semibold tracking-tight">
            The Soul Behind <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#bfa76b] via-[#d8c27a] to-[#f5e7b0]">Bossku</span>
        </h2>

        <p class="max-w-2xl mx-auto text-gray-300 leading-relaxed">
            Born from 15 years of travel legacy, Bossku bridges heart and horizon — crafting journeys across Indonesia that reach deeper than distance.
        </p>

        <div>
            <a href="/About"
                class="inline-block bg-gradient-to-r from-[#a89258] to-[#E3EFFB] text-[#0a0a0a] font-medium px-8 py-3 rounded-full shadow-lg hover:shadow-[#E3EFFB]/40 transition-all duration-300">
                Meet Our Story
            </a>
        </div>


        <div class="pt-4 border-t border-white/10">
            <p class="text-sm text-gray-400 leading-relaxed text-pretty">
                Designed By Bossku, Curated By Meaning.
            </p>
        </div>
    </div>
</section>

<script>
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
</script>


<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 1.2s ease-out both;
    }
</style>

<script>
    (function() {

        const targetDate = new Date("June 13, 2026 00:00:00").getTime();
        const countdownEl = document.getElementById("countdown");

        if (!countdownEl) return;

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance <= 0) {
                countdownEl.innerHTML = "00 : 00 : 00 : 00";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.innerHTML =
                String(days).padStart(2, '0') + " : " +
                String(hours).padStart(2, '0') + " : " +
                String(minutes).padStart(2, '0') + " : " +
                String(seconds).padStart(2, '0');
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);

    })();
</script>


@endsection