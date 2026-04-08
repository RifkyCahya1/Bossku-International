@php
$excludeNavbar = true;
@endphp

@extends('main')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-br 
  from-slate-50 via-amber-50/20 to-slate-100
  text-slate-800 min-h-screen">

  <!-- ANIMATED BACKGROUND ELEMENTS -->
  <div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gradient-to-br from-amber-200/10 to-orange-300/5 rounded-full blur-3xl"></div>
    <div class="absolute top-1/3 -right-40 w-[500px] h-[500px] bg-gradient-to-br from-sky-200/5 to-blue-300/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-40 left-1/4 w-72 h-72 bg-gradient-to-br from-emerald-200/5 to-teal-300/5 rounded-full blur-3xl"></div>

    <!-- ANIMATED PARTICLES -->
    <div class="particles-container"></div>
  </div>

  <!-- HERO SECTION -->
  <section id="hero" class="relative z-10 min-h-screen flex items-center justify-center px-6">
    <div class="max-w-6xl mx-auto text-center">
      <!-- ANIMATED HEADLINE -->
      <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold mb-8 leading-tight">
        <span class="block animate-slide-up" style="animation-delay: 0.1s">
          Race Day
        </span>
        <span class="block animate-slide-up" style="animation-delay: 0.3s">
          Logistics,
        </span>
        <span class="block animate-slide-up text-transparent bg-clip-text bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600" style="animation-delay: 0.5s">
          Perfected.
        </span>
      </h1>

      <!-- ANIMATED DESCRIPTION -->
      <p class="max-w-2xl mx-auto text-base sm:text-lg md:text-xl text-slate-600 mb-12 animate-fade-in" style="animation-delay: 0.8s">
        Fokus lari. Urusan hotel, transport, dan koordinasi kami yang mikir.
        <br>
        <span class="text-sm text-slate-500">Experience seamless marathon preparation with premium support.</span>
      </p>

      <!-- ANIMATED BUTTONS -->
      <div class="flex flex-col sm:flex-row gap-5 justify-center items-center mt-10">

        <!-- PRIMARY CTA -->
        <a href="/booking"
          class="group relative inline-flex items-center justify-center gap-3
            px-10 py-4 rounded-2xl
            bg-gradient-to-r from-amber-500 to-orange-600
            text-white font-semibold text-lg
            shadow-xl hover:shadow-amber-500/40
            transition-all duration-300
            hover:-translate-y-1 hover:scale-[1.02]">

          <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6 transition-transform duration-300 group-hover:rotate-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
          </svg>

          <span>Book Your Spot</span>

          <!-- subtle shine -->
          <span class="absolute inset-0 rounded-2xl bg-white/10 opacity-0 group-hover:opacity-100 transition"></span>
        </a>


        <!-- SECONDARY CTA -->
        <a href="https://wa.me/6285727767777"
          target="_blank"
          class="group inline-flex items-center justify-center gap-3
            px-10 py-4 rounded-2xl
            border border-white/20
            bg-gradient-to-r from-slate-800 to-slate-900 backdrop-blur-sm
            text-white font-medium text-lg
            transition-all duration-300
            hover:-translate-y-1">

          <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6 transition duration-300 group-hover:scale-110">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
          </svg>

          <span>Ask via WhatsApp</span>
        </a>

      </div>

    </div>
  </section>

  <!-- EVENTS SECTION -->
  <section id="events" class="relative py-32 px-6">
    <div class="max-w-7xl mx-auto">
      <!-- SECTION HEADER -->
      <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full bg-gradient-to-r from-black to-slate-800 text-white text-xs tracking-widest uppercase">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          Race Calendar
        </div>
        <h2 class="text-5xl md:text-6xl font-bold mb-6">
          Premium <span class="text-amber-600">Events</span>
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
          Carefully selected marathon events with complete runner-ready support.
        </p>
      </div>

      <!-- EVENT CARDS -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="event-cards">
        <!-- Event Card 1 -->
        <div class="event-card group relative cursor-pointer" data-event="jakarta">
          <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-amber-500/20 to-orange-600/10 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative rounded-3xl bg-white/90 backdrop-blur-sm border border-white/30 p-8 shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-400/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>

            <div class="relative">
              <div class="flex items-center justify-between mb-6">
                <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-xs font-medium">
                  Indonesia
                </span>
                <span class="text-xs font-semibold text-slate-400">Jun 13, 2026</span>
              </div>

              <h3 class="text-2xl font-bold mb-4">Jakarta Marathon</h3>

              <p class="text-slate-600 mb-6">
                Experience a world-class urban marathon through Jakarta's iconic landmarks with premium support.
              </p>

              <div class="space-y-3 mb-8">
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>Monas - GBK Jogging Track</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>Full Marathon</span>
                </div>
              </div>

              <button class="event-detail-btn w-full py-3 rounded-xl border border-slate-200 text-slate-700 font-medium hover:bg-black hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group">
                Available
              </button>
            </div>
          </div>
        </div>

        <!-- Event Card 2 -->
        <div class="event-card group relative cursor-pointer" data-event="jogja">
          <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-sky-500/20 to-blue-600/10 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative rounded-3xl bg-white/90 backdrop-blur-sm border border-white/30 p-8 shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-sky-400/10 to-transparent rounded-full -translate-y-16 translate-x-16"></div>

            <div class="relative">
              <div class="flex items-center justify-between mb-6">
                <span class="px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-xs font-medium">
                  Indonesia
                </span>
                <span class="text-xs font-semibold text-slate-400">-</span>
              </div>

              <h3 class="text-2xl font-bold mb-4">Jogja Marathon</h3>

              <p class="text-slate-600 mb-6">
                Cultural heritage meets endurance through Yogyakarta's historical routes with royal treatment.
              </p>

              <div class="space-y-3 mb-8">
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>--</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>-- KM Full Marathon</span>
                </div>
              </div>

              <button class="event-detail-btn w-full py-3 rounded-xl border border-slate-200 text-slate-400 font-medium bg-slate-50 cursor-not-allowed transition-all duration-300 flex items-center justify-center gap-2 group" disabled>
                Coming Soon
                <i class="fa-solid fa-lock"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Coming Soon Card -->
        <div class="group relative">
          <div class="h-full rounded-3xl border-2 border-dashed border-slate-300/50 hover:border-slate-400 transition-all duration-500 p-8 flex flex-col items-center justify-center text-center bg-gradient-to-br from-white/50 to-transparent backdrop-blur-sm">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-slate-200 to-slate-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
              <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-slate-700 mb-3">More Premium Events</h3>
            <p class="text-slate-500 text-sm mb-6">
              We're constantly adding new exclusive marathon destinations to our portfolio.
            </p>
            <div class="text-xs text-slate-400 font-medium">
              COMING SOON
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PACKAGES SECTION -->
  <section id="packages" class="relative py-32 px-6 bg-gradient-to-b from-white via-slate-50 to-white">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full bg-gradient-to-r from-black to-slate-800 text-white text-xs tracking-widest uppercase">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
          </svg>
          Marathon Packages
        </div>
        <h2 class="text-5xl md:text-6xl font-bold mb-6">
          Jakarta <span class="text-amber-600">Marathon Week</span>
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
          Choose from our curated packages designed for every type of runner.
        </p>
      </div>

      <!-- PACKAGE COMPARISON TABLE -->
      <div class="mb-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Package 1 - Basic -->
          <div class="package-card relative group" data-package="basic">
            <div class="relative rounded-3xl bg-white border border-slate-200 p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full flex flex-col">

              <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">Runner Basic Stay</h3>
                <div class="text-sm text-slate-500">
                  For independent runners who only need a solid base
                </div>
                <div class="text-xs text-slate-400 mt-1">
                  Regular price · No slot limitation
                </div>
              </div>

              <div class="mb-8">
                <div class="space-y-3">
                  <div>
                    <div class="text-sm text-slate-500 mb-1">Standard</div>
                    <div class="text-3xl font-bold mb-1">
                      IDR 1.6M<span class="text-base text-slate-500">/pax</span>
                    </div>
                  </div>
                </div>
                <div class="text-sm text-slate-400 mb-2">Best for:</div>
                <div class="text-sm text-slate-400 mt-4">
                  <ul class="list-disc pl-5">
                    <li>Experienced runners</li>
                    <li>Running communities</li>
                    <li>Own transport</li>
                  </ul>
                </div>
              </div>

              <ul class="space-y-4 mb-8 flex-grow">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Airport Shuttle</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Welcome Kit</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Hotel ★★★</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-400">1 Pre-Race Dinner</span>
                </li>
              </ul>

              <div class="flex gap-3">
                <button class="package-select-btn flex-1 py-4 rounded-xl border-2 border-slate-200 text-slate-700 font-semibold hover:bg-slate-800 hover:text-white transition">
                  Choose Basic
                </button>
              </div>
            </div>
          </div>

          <!-- Package 2 - Comfort -->
          <div class="package-card relative group lg:scale-105 lg:-translate-y-4" data-package="comfort">
            <div class="absolute -top-5 left-1/2 -translate-x-1/2 z-20">
              <div class="px-4 py-2 rounded-full bg-gradient-to-r from-amber-500 to-orange-600 text-white text-xs font-semibold shadow-lg">
                MOST POPULAR
              </div>
            </div>

            <div class="relative rounded-3xl bg-gradient-to-br from-slate-900 to-black border-2 border-amber-500/30 p-8 shadow-2xl h-full flex flex-col">
              <div class="mb-6">
                <h3 class="text-2xl font-bold text-white mb-2">Runner Comfort Logistics</h3>
                <div class="text-sm text-slate-300">
                  For first-timers & out-of-town runners
                </div>
              </div>

              <div class="mb-8">
                <div class="text-4xl font-bold text-white mb-2">
                  IDR 1.85M<span class="text-lg text-slate-300">/pax</span>
                </div>
                <div class="text-sm text-slate-400 mb-2">Best for:</div>
                <ul class="list-disc pl-5 text-sm text-slate-400">
                  <li>First-time marathoners</li>
                  <li>Runners new to the city</li>
                  <li>Stress-free planners</li>
                </ul>
              </div>

              <ul class="space-y-4 mb-8 flex-grow">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Airport Shuttle</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Welcome Kit</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Transport Drop Point (Motorbike)</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Hotel</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">1 Pre Race Dinner</span>
                </li>
              </ul>

              <button class="package-select-btn w-full py-4 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold hover:opacity-90">
                Choose Comfort
              </button>
            </div>
          </div>

          <!-- Package 3 - Premium -->
          <div class="package-card relative group" data-package="premium">
            <div class="relative rounded-3xl bg-white border border-slate-200 p-8 shadow-lg hover:shadow-2xl transition h-full flex flex-col">
              <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">Runner Premium Assist</h3>
                <div class="text-sm text-slate-500">
                  For runners who need higher coordination certainty
                </div>
              </div>

              <div class="mb-8">
                <div class="text-4xl font-bold mb-2">
                  IDR 3.95M<span class="text-lg text-slate-500">/pax</span>
                </div>
                <div class="text-sm text-slate-400 mb-2">Best for:</div>
                <ul class="list-disc pl-5 text-sm text-slate-400">
                  <li>Elite athletes</li>
                  <li>VIP runners</li>
                  <li>Public figures</li>
                  <li>Time-sensitive schedules</li>
                </ul>

                <div class="text-sm text-red-500">Limited slots</div>
              </div>


              <ul class="space-y-4 mb-8 flex-grow">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm">All Runner Comfort Logistics</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm">Priority coordination & faster response window</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm">Personalized departure timing plan based on: race schedule · hotel location · road restriction patterns</span>
                </li>
              </ul>

              <button class="package-select-btn w-full py-4 rounded-xl border-2 border-slate-200 hover:bg-slate-800 hover:text-white transition">
                Choose Premium
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section id="contact" class="relative py-32 px-6 overflow-hidden">
    <!-- Background Effect -->
    <div class="absolute inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%239C92AC" fill-opacity="0.05" %3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

    <div class="relative max-w-6xl mx-auto text-center">
      <div class="inline-block mb-8 px-6 py-2 rounded-full bg-gradient-to-r from-amber-500 to-orange-600 text-white text-sm font-semibold">
        Limited Slots Available
      </div>

      <h2 class="text-5xl md:text-6xl font-bold text-white mb-8">
        Ready to <span class="text-amber-400">Race?</span>
      </h2>

      <p class="text-xl text-gray-300 mb-12 max-w-2xl mx-auto">
        Join thousands of runners who've experienced stress-free marathon preparation.
        Secure your spot with a 30% deposit today.
      </p>

      <div class="flex flex-col sm:flex-row gap-6 justify-center mb-16">
        <a href="/booking" class="group relative px-12 py-5 rounded-2xl bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold text-lg hover:scale-[1.03] transition-all duration-300 shadow-2xl hover:shadow-amber-500/25 overflow-hidden">
          <span class="relative z-10 flex items-center justify-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            Book Now
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-700 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="https://wa.me/6285727767777" target="_blank" class="px-12 py-5 rounded-2xl bg-white/10 backdrop-blur-sm border-2 border-white/20 text-white font-semibold text-lg hover:bg-white/20 transition-all duration-300">
          <span class="relative z-10 flex items-center justify-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
            Chat WA
          </span>
        </a>
      </div>

      <!-- Trust Badges -->
      <div class="flex flex-wrap items-center justify-center gap-8 text-gray-400">
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <span class="text-sm">Verified Partner</span>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <span class="text-sm">Secure Payment</span>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  @keyframes slide-up {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-slide-up {
    animation: slide-up 0.8s ease-out forwards;
    opacity: 0;
  }

  @keyframes fade-in {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  .animate-fade-in {
    animation: fade-in 0.8s ease-out forwards;
    opacity: 0;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle package card clicks
    const packageCards = document.querySelectorAll('.package-card');

    packageCards.forEach(card => {
      card.addEventListener('click', function(e) {
        // Prevent click if clicking on button inside card
        if (e.target.closest('button')) {
          return;
        }

        const packageType = this.dataset.package;
        redirectToBooking(packageType);
      });

      // Handle button clicks separately
      const packageBtn = card.querySelector('.package-select-btn');
      if (packageBtn) {
        packageBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          const packageType = this.closest('.package-card').dataset.package;
          redirectToBooking(packageType);
        });
      }
    });

    function redirectToBooking(packageType) {
      // Get package details based on type
      let packageDetails = {
        basic: {
          name: 'Runner Basic Stay',
          type: 'paket1',
          night_count: '1', // Ubah dari '2' menjadi '1'
          hotel_star: '3',
          price_twin: 1250000,
          price_single: 1950000
        },
        comfort: {
          name: 'Runner Comfort Logistics',
          type: 'paket2',
          night_count: '1', // Ubah dari '2' menjadi '1'
          hotel_star: '3',
          price_twin: 1650000,
          price_single: 2450000
        },
        premium: {
          name: 'Runner Premium Assist',
          type: 'paket3',
          night_count: '1', // Ubah dari '2' menjadi '1'
          hotel_star: '3',
          price_twin: 4700000,
          price_single: 8900000
        }
      };

      const selectedPackage = packageDetails[packageType];

      if (selectedPackage) {
        // Log untuk debugging
        console.log('Selected package:', selectedPackage);

        // Encode package data for URL
        const packageData = encodeURIComponent(JSON.stringify(selectedPackage));

        // Redirect to booking page with package data
        window.location.href = `/booking?package=${packageData}`;
      } else {
        console.error('Package type not found:', packageType);
      }
    }
  });
</script>
@endsection