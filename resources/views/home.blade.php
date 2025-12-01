@extends('main')
@section('content')
@include('component.loadingScreen')

<div class="relative overflow-hidden">
    <video src="videos/Cinematic1.mp4" autoplay muted loop playsinline
        class="w-full h-screen object-cover"
        style="image-rendering: crisp-edges; transform: translateZ(0);"></video>

    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-[#f4f4f4]/20 to-[#f4f4f4]/100"></div>

    <div class="absolute inset-0 flex flex-col items-center justify-center px-6 text-white text-center animate-fadeIn">

        <div class="absolute left-0 right-0 bottom-12 md:bottom-40 flex flex-col md:flex-row gap-4 justify-center items-center">
            <a href="/destinasi"
                class="group bg-[#BFA46F]/40 hover:bg-[#a89258] text-white font-semibold tracking-wide px-10 py-3 rounded-xl shadow-lg transition-all duration-300 uppercase flex items-center gap-2">
                <span>Explore All Destinations</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>

            <a href="/customized-tours"
                class="group bg-[#BFA46F]/40 hover:bg-[#a89258] text-white font-semibold tracking-wide px-10 py-3 rounded-xl border border-white/20 shadow-md transition-all duration-300 uppercase flex items-center gap-2 backdrop-blur-sm">
                <span>Create Your Custom Journey</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform group-hover:translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>

    </div>
</div>

<div class="container mx-auto max-w-lg py-4 px-4 md:px-12">
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


        <div class="mt-6">
            <a href="contact.php"
                class="inline-block border border-[#02335B] text-[#02335B] hover:bg-[#FFCA10] hover:text-[#02335B] font-semibold px-8 py-3 rounded-full shadow-sm transition-all duration-300 text-lg tracking-wide">
                Find The Journey That Calls You
            </a>
        </div>

    </div>
</div>

@include('section.attraction')
@include('section.hotel')
@include('section.destination')

<section class="relative bg-gradient-to-br from-[#0a0a0a] via-[#111] to-[#1a1a1a] text-white py-8 overflow-hidden">

    <div class="relative container mx-auto px-6 md:px-16 text-center space-y-8">
        <h2 class="text-3xl md:text-4xl font-semibold tracking-tight">
            The Soul Behind <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#bfa76b] via-[#d8c27a] to-[#f5e7b0]">Bossku</span>
        </h2>

        <p class="max-w-2xl mx-auto text-gray-300 leading-relaxed">
            Born from 15 years of travel legacy, Bossku bridges heart and horizon — crafting journeys across Indonesia that reach deeper than distance.
        </p>

        <div>
            <a href="#contact"
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

<script src="JS/SwiperAttraction.js"></script>
<script src="JS/SwiperDestination.js"></script>

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

@endsection