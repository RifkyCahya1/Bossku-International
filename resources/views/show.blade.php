@extends('main')

@section('content')

@php
$img = $attraction->summer_img ?? $attraction->autumn_img ?? $attraction->winter_img;
@endphp

<div class="relative w-full h-[420px] md:h-[520px] overflow-hidden">
    <img src="{{ $img }}" class="w-full h-full object-cover" alt="{{ trim(str_replace('WNA', '', $attraction->name)) }}">
    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>

    <div class="absolute bottom-10 left-0 right-0 px-6 md:px-16">
        <h1 class="text-white text-3xl md:text-5xl font-bold drop-shadow-lg leading-tight">
            {{{ trim(str_replace('WNA', '', $attraction->name)) }}}
        </h1>
        <p class="text-white/80 text-sm md:text-base mt-2 flex items-center gap-2">
            <i class="ph-map-pin"></i> {{ $attraction->city }}
        </p>
    </div>
</div>

<div class="px-6 md:px-16 py-12 grid grid-cols-1 md:grid-cols-3 gap-10">

    <div class="md:col-span-2">

        <div class="bg-white/70 backdrop-blur-lg border border-gray-200 rounded-2xl p-6 shadow-md">
            <h2 class="text-xl font-semibold text-[#071F35]">Overview</h2>
            <p class="mt-2 text-gray-600 leading-relaxed">
                {{ $attraction->keterangan }}
            </p>
        </div>

        <div class="mt-10">
            <h3 class="text-lg font-semibold text-[#071F35] mb-3">Highlights</h3>

            <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <li class="flex gap-3 bg-white/60 backdrop-blur-xl p-4 rounded-xl border border-gray-200">
                    <i class="ph-sun-bold text-[#d6c08a] text-xl"></i>
                    <span class="text-gray-700 text-sm">Cocok untuk keluarga dan anak-anak</span>
                </li>

                <li class="flex gap-3 bg-white/60 backdrop-blur-xl p-4 rounded-xl border border-gray-200">
                    <i class="ph-ticket-bold text-[#d6c08a] text-xl"></i>
                    <span class="text-gray-700 text-sm">Tiket langsung masuk, tanpa antre</span>
                </li>

                <li class="flex gap-3 bg-white/60 backdrop-blur-xl p-4 rounded-xl border border-gray-200">
                    <i class="ph-camera-bold text-[#d6c08a] text-xl"></i>
                    <span class="text-gray-700 text-sm">Spot foto aesthetic</span>
                </li>

                <li class="flex gap-3 bg-white/60 backdrop-blur-xl p-4 rounded-xl border border-gray-200">
                    <i class="ph-map-trifold-bold text-[#d6c08a] text-xl"></i>
                    <span class="text-gray-700 text-sm">Lokasi strategis</span>
                </li>
            </ul>
        </div>

        <div class="mt-10">
            <h3 class="text-lg font-semibold text-[#071F35] mb-3">Description</h3>

            <div class="bg-white/70 backdrop-blur-lg p-6 rounded-2xl border border-gray-200 shadow">
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                    {{ $attraction->keterangan }}
                </p>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-lg font-semibold text-[#071F35] mb-3">Gallery</h3>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @if($attraction->summer_img)
                <img src="{{ $attraction->summer_img }}" class="rounded-xl shadow-md h-40 object-cover">
                @endif
                @if($attraction->autumn_img)
                <img src="{{ $attraction->autumn_img }}" class="rounded-xl shadow-md h-40 object-cover">
                @endif
                @if($attraction->winter_img)
                <img src="{{ $attraction->winter_img }}" class="rounded-xl shadow-md h-40 object-cover">
                @endif
            </div>
        </div>

    </div>

    {{-- RIGHT: BOOKING CARD --}}
    <div>
        <div class="sticky top-28 bg-white/80 backdrop-blur-xl border border-gray-200 shadow-xl p-6 rounded-2xl">

            <h3 class="text-xl font-semibold text-[#071F35]">Ticket Price</h3>
            <p class="text-2xl font-bold text-[#d6c08a] mt-2">
                Rp {{ number_format($attraction->price, 0, ',', '.') }}
            </p>

            <p class="text-gray-600 text-sm mt-2">Per person</p>

            <hr class="my-4 border-gray-300">

            <a href="/booking/{{ $attraction->id }}"
                class="block text-center w-full bg-[#071F35] text-white py-3 rounded-xl font-semibold
                       hover:bg-[#0a2d4f] transition-all tracking-wide">
                Book Now →
            </a>

        </div>
    </div>
</div>


{{-- MOBILE CTA BOTTOM --}}
<div class="fixed bottom-0 left-0 right-0 bg-white/80 backdrop-blur-xl p-4 shadow-xl md:hidden border-t border-gray-200">
    <div class="flex justify-between items-center">
        <div>
            <div class="text-sm text-gray-600">Price</div>
            <div class="text-lg font-bold text-[#071F35]">
                Rp {{ number_format($attraction->price, 0, ',', '.') }}
            </div>
        </div>

        <a href="/booking/{{ $attraction->id }}"
            class="px-5 py-3 bg-[#071F35] text-white rounded-xl font-semibold hover:bg-[#0a2d4f] transition">
            Book
        </a>
    </div>
</div>

@endsection