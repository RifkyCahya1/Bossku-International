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

  <nav class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] sm:w-auto px-2 sm:px-6">
    <div class="backdrop-blur-xl bg-white/80 border border-white/20 rounded-2xl shadow-lg shadow-black/5 
              px-4 sm:px-6 py-3 flex gap-4 sm:gap-8 
              overflow-x-auto scrollbar-hide text-sm">
      <a href="#hero" class="whitespace-nowrap hover:text-amber-600">Home</a>
      <a href="#events" class="whitespace-nowrap hover:text-amber-600">Events</a>
      <a href="#packages" class="whitespace-nowrap hover:text-amber-600">Packages</a>
      <a href="#why" class="whitespace-nowrap hover:text-amber-600">Why Us</a>
      <a href="#contact" class="whitespace-nowrap hover:text-amber-600">Contact</a>
    </div>
  </nav>


  <!-- HERO SECTION -->
  <section id="hero" class="relative z-10 min-h-screen flex items-center justify-center px-6">

    <div class="max-w-6xl mx-auto text-center">
      <!-- ANIMATED BADGE -->
      <div class="inline-flex items-center gap-2 mb-8 px-4 py-2 rounded-full bg-gradient-to-r from-black to-slate-800 text-white text-xs tracking-widest uppercase animate-fade-in-up mt-24">
        <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
        Marathon Travel Specialist
      </div>

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
        Fokus lari. Urusan hotel, transport, dan koordinasi — kami yang mikir.
        <br>
        <span class="text-sm text-slate-500">Experience seamless marathon preparation with premium support.</span>
      </p>

      <!-- ANIMATED BUTTONS -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in" style="animation-delay: 1s">
        <button onclick="smoothScroll('#packages')"
          class="group relative px-10 py-4 rounded-2xl bg-gradient-to-r from-black to-slate-800 text-white font-semibold overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl">
          <span class="relative z-10">Explore Packages</span>
          <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-600 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 to-orange-500 blur group-hover:opacity-30 transition-opacity duration-500"></div>
        </button>

        <button onclick="smoothScroll('#events')"
          class="group px-10 py-4 rounded-2xl border-2 border-black/20 font-semibold hover:bg-black hover:text-white transition-all duration-300 hover:scale-[1.02]">
          <span class="flex items-center justify-center gap-2">
            View Events
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
          </span>
        </button>
      </div>

      <!-- STATS BAR -->
      <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 1.2s">
        <div class="text-center p-6 backdrop-blur-sm bg-white/50 rounded-2xl border border-white/20">
          <div class="text-3xl font-bold text-amber-600 mb-2">50+</div>
          <div class="text-sm text-slate-600">Marathons Supported</div>
        </div>
        <div class="text-center p-6 backdrop-blur-sm bg-white/50 rounded-2xl border border-white/20">
          <div class="text-3xl font-bold text-amber-600 mb-2">2K+</div>
          <div class="text-sm text-slate-600">Happy Runners</div>
        </div>
        <div class="text-center p-6 backdrop-blur-sm bg-white/50 rounded-2xl border border-white/20">
          <div class="text-3xl font-bold text-amber-600 mb-2">100%</div>
          <div class="text-sm text-slate-600">Satisfaction Rate</div>
        </div>
        <div class="text-center p-6 backdrop-blur-sm bg-white/50 rounded-2xl border border-white/20">
          <div class="text-3xl font-bold text-amber-600 mb-2">24/7</div>
          <div class="text-sm text-slate-600">Support</div>
        </div>
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
                <span class="text-xs font-semibold text-slate-400">Oct 27, 2024</span>
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
                  <span>Urban City Route</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>42.195 KM Full Marathon</span>
                </div>
              </div>

              <button class="event-detail-btn w-full py-3 rounded-xl border border-slate-200 text-slate-700 font-medium hover:bg-black hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group">
                View Details
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
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
                <span class="text-xs font-semibold text-slate-400">Nov 10, 2024</span>
              </div>

              <h3 class="text-2xl font-bold mb-4">Jogja Marathon</h3>

              <p class="text-slate-600 mb-6">
                Cultural heritage meets endurance through Yogyakarta's historical routes with royal treatment.
              </p>

              <div class="space-y-3 mb-8">
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                  </svg>
                  <span>Cultural Heritage Route</span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-500">
                  <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>42.195 KM Full Marathon</span>
                </div>
              </div>

              <button class="event-detail-btn w-full py-3 rounded-xl border border-slate-200 text-slate-700 font-medium hover:bg-black hover:text-white transition-all duration-300 flex items-center justify-center gap-2 group">
                View Details
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
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
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
          <!-- Package 1 - Basic -->
          <div class="package-card relative group" data-package="basic">
            <div class="relative rounded-3xl bg-white border border-slate-200 p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full flex flex-col">
              <div class="mb-6">
                <h3 class="text-2xl font-bold mb-2">Basic Stay</h3>
                <div class="text-sm text-slate-500">
                  Simple marathon base for independent runners
                </div>
              </div>

              <div class="mb-8">
                <div class="text-4xl font-bold mb-2">
                  IDR 2.5M<span class="text-lg text-slate-500">/pax</span>
                </div>
                <div class="text-sm text-slate-400">2 nights minimum</div>
              </div>

              <ul class="space-y-4 mb-8 flex-grow">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Strategic hotel (2 nights)</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Airport shuttle (roundtrip)</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Runner kit & info pack</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-red-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                  </svg>
                  <span class="text-sm text-slate-400">No race-day assistance</span>
                </li>
              </ul>

              <button class="package-select-btn w-full py-4 rounded-xl border-2 border-slate-200 text-slate-700 font-semibold hover:bg-slate-800 hover:text-white transition">
                Choose Basic
              </button>
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
                <h3 class="text-2xl font-bold text-white mb-2">Comfort Logistics</h3>
                <div class="text-sm text-slate-300">
                  Stress-free race morning logistics
                </div>
              </div>

              <div class="mb-8">
                <div class="text-4xl font-bold text-white mb-2">
                  IDR 4.2M<span class="text-lg text-slate-300">/pax</span>
                </div>
                <div class="text-sm text-slate-400">Best for first-timers</div>
              </div>

              <ul class="space-y-4 mb-8 flex-grow">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Hotel near official drop point</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Scheduled race-day shuttle</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">Timing & walking route briefing</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-300">WhatsApp coordination support</span>
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
                <h3 class="text-2xl font-bold mb-2">Premium Assist</h3>
                <div class="text-sm text-slate-500">
                  Priority coordination & personal planning
                </div>
              </div>

              <div class="mb-8">
                <div class="text-4xl font-bold mb-2">
                  IDR 6.8M<span class="text-lg text-slate-500">/pax</span>
                </div>
                <div class="text-sm text-red-500">Limited slots</div>
              </div>

              <ul class="space-y-4 mb-8 flex-grow">
                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Dedicated coordinator</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Personalized departure plan</span>
                </li>

                <li class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                  </svg>
                  <span class="text-sm text-slate-600">Priority response window</span>
                </li>
              </ul>

              <button class="package-select-btn w-full py-4 rounded-xl border-2 border-slate-200 hover:bg-slate-800 hover:text-white transition">
                Choose Premium
              </button>
            </div>
          </div>
          <!-- Comparison Table -->
          <div class="lg:col-span-1">
            <div class="rounded-3xl bg-gradient-to-b from-slate-50 to-white border border-slate-200 p-8 shadow-lg h-full">
              <h4 class="text-xl font-bold mb-6">Package Comparison</h4>

              <div class="space-y-6">
                <div>
                  <div class="text-sm font-semibold text-slate-700 mb-2">Best For</div>
                  <div class="space-y-2">
                    <div class="text-sm text-slate-600">• Basic: Solo travelers</div>
                    <div class="text-sm text-slate-600">• Comfort: Serious runners</div>
                    <div class="text-sm text-slate-600">• Premium: Corporate/VIP</div>
                  </div>
                </div>

                <div>
                  <div class="text-sm font-semibold text-slate-700 mb-2">Support Level</div>
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <div class="w-2 h-2 bg-slate-300 rounded-full"></div>
                      <span class="text-sm text-slate-600">Basic: Standard</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <div class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></div>
                      <span class="text-sm text-slate-600">Comfort: Priority</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                      <span class="text-sm text-slate-600">Premium: 24/7 VIP</span>
                    </div>
                  </div>
                </div>

                <div class="pt-6 border-t border-slate-200">
                  <div class="text-sm text-slate-500 mb-4">Need custom package?</div>
                  <button onclick="openContactModal()" class="w-full py-3 rounded-xl border-2 border-dashed border-slate-300 text-slate-700 hover:border-slate-400 hover:bg-slate-50 transition-all duration-300 text-sm font-medium">
                    Request Custom Quote
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- WHY CHOOSE US -->
  <section id="why" class="relative py-32 px-6">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-20">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full bg-gradient-to-r from-black to-slate-800 text-white text-xs tracking-widest uppercase">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          Why BossKu
        </div>
        <h2 class="text-5xl md:text-6xl font-bold mb-6">
          Excellence in <span class="text-amber-600">Every Detail</span>
        </h2>
        <p class="text-lg text-slate-600 max-w-2xl mx-auto">
          Karena runner butuh ketenangan, bukan ribet. Kami urus detail kecil,
          supaya kamu fokus finish strong.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Feature 1 -->
        <div class="feature-card group">
          <div class="relative rounded-3xl bg-white/80 backdrop-blur-sm border border-white/30 p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
              <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Proven Experience</h3>
            <p class="text-slate-600">
              Over 50+ marathons successfully managed with 100% runner satisfaction.
            </p>
          </div>
        </div>

        <!-- Feature 2 -->
        <div class="feature-card group">
          <div class="relative rounded-3xl bg-white/80 backdrop-blur-sm border border-white/30 p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-100 to-sky-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
              <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Strategic Planning</h3>
            <p class="text-slate-600">
              Every detail from transport to recovery is meticulously planned and executed.
            </p>
          </div>
        </div>

        <!-- Feature 3 -->
        <div class="feature-card group">
          <div class="relative rounded-3xl bg-white/80 backdrop-blur-sm border border-white/30 p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
              <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Personal Coordinator</h3>
            <p class="text-slate-600">
              Dedicated support person for every runner, available throughout your journey.
            </p>
          </div>
        </div>

        <!-- Feature 4 -->
        <div class="feature-card group">
          <div class="relative rounded-3xl bg-white/80 backdrop-blur-sm border border-white/30 p-8 shadow-lg hover:shadow-2xl transition-all duration-500 h-full">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-100 to-violet-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
              <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Secure & Reliable</h3>
            <p class="text-slate-600">
              Your safety and comfort are our top priority with verified partners and services.
            </p>
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
        <a href="https://wa.me/628112557728"
          target="_blank"
          class="group relative px-12 py-5 rounded-2xl bg-gradient-to-r from-amber-500 to-orange-600 text-white font-semibold text-lg hover:scale-[1.03] transition-all duration-300 shadow-2xl hover:shadow-amber-500/25 overflow-hidden">
          <span class="relative z-10 flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411" />
            </svg>
            Book via WhatsApp
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-orange-700 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <button onclick="openBookingModal()"
          class="px-12 py-5 rounded-2xl bg-white/10 backdrop-blur-sm border-2 border-white/20 text-white font-semibold text-lg hover:bg-white/20 transition-all duration-300">
          Request Callback
        </button>
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
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <span class="text-sm">24/7 Support</span>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection