@extends('main')

@section('content')
<section class="relative min-h-[100svh] w-full overflow-hidden">

    <video autoplay muted loop playsinline
        class="absolute inset-0 w-full h-full object-cover scale-105 md:scale-110">
        <source src="{{ asset('Videos/IMG_9945.MOV') }}" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black/30"></div>

    <div class="relative z-10 flex min-h-[100svh] flex-col justify-center px-5 sm:px-8 md:px-16 lg:px-24 mx-auto">
        <p class="text-white/60 text-[10px] sm:text-xs tracking-[0.35em] uppercase mb-6 sm:mb-8">
            Curated Experiences
        </p>

        <h1 class="text-white font-extralight leading-tight text-3xl sm:text-4xl md:text-5xl lg:text-6xl max-w-xl md:max-w-3xl lg:max-w-4xl">
            Every journey has its own rhythm.<br>
            <span class="text-white/70">Some slow you down.</span><br>
            <span class="italic">Some wake you up.</span>
        </h1>

        <p class="text-white/60 mt-5 sm:mt-6 text-sm sm:text-base max-w-md md:max-w-lg leading-relaxed">
            Experiences designed with intention — not to rush you,
            but to let moments breathe.
        </p>

        <div class="mt-8 sm:mt-10">
            <a href="#experiences" class="inline-flex items-center gap-3 text-xs sm:text-sm tracking-widest uppercase text-white/80 hover:text-white transition">
                Explore Experiences
                <span class="block w-10 sm:w-12 h-[1px] bg-white/40"></span>
            </a>
        </div>
    </div>

    <div class="absolute bottom-6 sm:bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-pulse">
        <span class="text-[10px] sm:text-[11px] tracking-[0.3em] uppercase text-white/60">
            Scroll
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-4 h-4 sm:w-5 sm:h-5 text-white/70">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M19 9l-7 7-7-7" />
        </svg>
    </div>
</section>

<section id="experiences" class="relative bg-gradient-to-b from-white to-neutral-50 py-28 sm:py-32 md:py-40 overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-amber-50/20 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -left-40 w-96 h-96 bg-gradient-to-tr from-stone-50/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-64 h-64 bg-gradient-to-t from-neutral-100/20 to-transparent rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 md:px-12 space-y-36 md:space-y-44">
        <!-- ITEM 1 - Slow & Soulful -->
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -left-4 md:left-10 -top-10 md:top-auto md:-left-12 text-[180px] md:text-[220px] font-serif font-bold text-amber-900/5 leading-none select-none z-0">
                01
            </div>
            
            <div class="relative z-10 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-amber-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1512438248247-f0f2a5a8b7f0?q=80&w=764&auto=format&fit=crop"
                        alt="Slow & Soulful"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/15 to-transparent opacity-80 group-hover:opacity-70 transition-opacity duration-500"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-tr from-amber-900/0 via-transparent to-amber-900/0 group-hover:from-amber-900/5 group-hover:to-amber-900/5 transition-all duration-700"></div>
                </div>
                
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                    <p class="text-xs font-medium text-amber-900 tracking-widest">MINDFUL LUXURY</p>
                </div>
            </div>

            <div class="relative z-10 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-amber-700 to-amber-700/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-amber-700">
                        Mindful Escapes
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Slow & Soulful
                    <span class="block text-amber-900/40 font-serif text-2xl mt-2">Serenity Found</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Quiet mornings, gentle days, and moments meticulously designed to slow the world down. An intimate journey inward through tranquil landscapes and mindful presence.
                </p>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-amber-700"></div>
                        <p class="text-sm text-neutral-700">Private meditation sessions</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-amber-700"></div>
                        <p class="text-sm text-neutral-700">Forest bathing with certified guides</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-amber-700"></div>
                        <p class="text-sm text-neutral-700">Custom wellness itineraries</p>
                    </div>
                </div>
                
                <div class="mt-12">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-amber-900 to-amber-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-amber-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Explore This Journey</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-800 to-amber-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-900/20 to-amber-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>
        </div>

        <!-- ITEM 2 - Nature & Silence -->
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -right-4 md:right-10 -top-10 md:top-auto md:-right-12 text-[180px] md:text-[220px] font-serif font-bold text-emerald-900/5 leading-none select-none z-0 text-right">
                02
            </div>
            
            <div class="relative z-10 md:order-2 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-emerald-700 to-emerald-700/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-emerald-700">
                        Wilderness Retreats
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Nature & Silence
                    <span class="block text-emerald-900/40 font-serif text-2xl mt-2">Eternal Quiet</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Mountains, ancient forests, and expansive horizons where silence becomes the ultimate luxury. Disconnect to reconnect in untouched natural sanctuaries.
                </p>
                
                <div class="grid grid-cols-3 gap-6 mb-10">
                    <div class="text-center">
                        <div class="text-2xl font-light text-emerald-900 mb-1">72h</div>
                        <div class="text-xs text-neutral-500 tracking-wider">DIGITAL DETOX</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-light text-emerald-900 mb-1">100%</div>
                        <div class="text-xs text-neutral-500 tracking-wider">PRIVACY GUARANTEED</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-light text-emerald-900 mb-1">24/7</div>
                        <div class="text-xs text-neutral-500 tracking-wider">EXPERT GUIDANCE</div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-emerald-900 to-emerald-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-emerald-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Discover Solitude</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-800 to-emerald-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-900/20 to-emerald-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>

            <div class="relative z-10 md:order-1 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-emerald-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1433086966358-54859d0ed716?q=80&w=1200&auto=format&fit=crop"
                        alt="Nature & Silence"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    
                    <div class="absolute top-6 right-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 max-w-[200px] shadow-2xl shadow-black/20">
                        <div class="text-white font-light text-sm leading-relaxed">
                            "The silence here speaks louder than any city."
                        </div>
                        <div class="text-white/70 text-xs mt-3">— Guest Review</div>
                    </div>
                </div>
                
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                    <p class="text-xs font-medium text-emerald-900 tracking-widest">EXCLUSIVE ACCESS</p>
                </div>
            </div>
        </div>

        <!-- ITEM 3 - Culture & Depth -->
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -left-4 md:left-10 -top-10 md:top-auto md:-left-12 text-[180px] md:text-[220px] font-serif font-bold text-amber-900/5 leading-none select-none z-0">
                03
            </div>
            
            <div class="relative z-10 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-amber-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1623026989633-fd0f1978c48f?q=80&w=729&auto=format&fit=crop"
                        alt="Culture & Depth"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-tr from-amber-900/10 via-transparent to-amber-900/10 group-hover:from-amber-900/20 group-hover:to-amber-900/20 transition-all duration-1000"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>
                </div>
            </div>

            <div class="relative z-10 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-amber-900 to-amber-900/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-amber-900">
                        Immersive Encounters
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Culture & Depth
                    <span class="block text-amber-900/40 font-serif text-2xl mt-2">Authentic Connections</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Traditions, rituals, and stories shared authentically — never staged. Engage with local communities through meaningful exchanges and immersive cultural experiences.
                </p>
                
                <div class="space-y-6 mb-10">
                    <div class="flex items-start gap-4 group/feature">
                        <div class="mt-1 flex-shrink-0 w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center group-hover/feature:bg-amber-100 transition-colors duration-300">
                            <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-neutral-800 mb-1">Private Artisan Workshops</h4>
                            <p class="text-sm text-neutral-600">Learn traditional crafts from master artisans in intimate settings.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 group/feature">
                        <div class="mt-1 flex-shrink-0 w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center group-hover/feature:bg-amber-100 transition-colors duration-300">
                            <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-neutral-800 mb-1">Culinary Heritage Tours</h4>
                            <p class="text-sm text-neutral-600">Explore local food traditions through private kitchen visits and tastings.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-amber-900 to-amber-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-amber-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Discover Heritage</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-800 to-amber-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-900/20 to-amber-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>
        </div>

        <!-- ITEM 4 - Island Escapes -->
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -right-4 md:right-10 -top-10 md:top-auto md:-right-12 text-[180px] md:text-[220px] font-serif font-bold text-blue-900/5 leading-none select-none z-0 text-right">
                04
            </div>
            
            <div class="relative z-10 md:order-2 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-blue-600 to-blue-600/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-blue-600">
                        Coastal Sanctuaries
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Island Escapes
                    <span class="block text-blue-900/40 font-serif text-2xl mt-2">Horizon Chaser</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Salt air, barefoot days, and endless horizons that soften everything. Experience the rhythm of island life in secluded paradises where time moves with the tides.
                </p>
                
                <div class="grid grid-cols-2 gap-8 mb-10">
                    <div class="text-center">
                        <div class="text-2xl font-light text-blue-900 mb-1">Private</div>
                        <div class="text-xs text-neutral-500 tracking-wider">BEACHFRONT VILLAS</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-light text-blue-900 mb-1">Secluded</div>
                        <div class="text-xs text-neutral-500 tracking-wider">COVES & BAYS</div>
                    </div>
                </div>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                        <p class="text-sm text-neutral-700">Private yacht excursions to hidden islands</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                        <p class="text-sm text-neutral-700">Underwater dining experiences</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                        <p class="text-sm text-neutral-700">Traditional fishing with local communities</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-blue-900 to-blue-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-blue-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Explore Islands</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-800 to-blue-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-900/20 to-blue-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>

            <div class="relative z-10 md:order-1 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-blue-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1729673766457-13ab5fc16dcf?q=80&w=1170&auto=format&fit=crop"
                        alt="Island Escapes"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-blue-900/20 to-transparent"></div>
                    
                    <div class="absolute bottom-6 right-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 max-w-[200px] shadow-2xl shadow-black/20">
                        <div class="text-white font-light text-sm leading-relaxed">
                            "Where the ocean whispers secrets to the shore."
                        </div>
                    </div>
                </div>
                
                <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                    <p class="text-xs font-medium text-blue-900 tracking-widest">OCEANFRONT RETREAT</p>
                </div>
            </div>
        </div>

        <!-- ITEM 5 - Adventure & Movement -->
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -left-4 md:left-10 -top-10 md:top-auto md:-left-12 text-[180px] md:text-[220px] font-serif font-bold text-emerald-900/5 leading-none select-none z-0">
                05
            </div>
            
            <div class="relative z-10 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-emerald-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1695750281868-8b78212d0ef9?q=80&w=628&auto=format&fit=crop"
                        alt="Adventure & Movement"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-emerald-900/20 to-transparent"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-900/0 via-transparent to-emerald-900/0 group-hover:from-emerald-900/5 group-hover:to-emerald-900/5 transition-all duration-700"></div>
                </div>
                
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                    <p class="text-xs font-medium text-emerald-900 tracking-widest">ACTIVE EXPEDITION</p>
                </div>
            </div>

            <div class="relative z-10 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-emerald-700 to-emerald-700/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-emerald-700">
                        Active Journeys
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Adventure & Movement
                    <span class="block text-emerald-900/40 font-serif text-2xl mt-2">Peak Experiences</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Trails, tides, climbs, and moments that stay with you forever. Challenge yourself in breathtaking landscapes with expert guidance and premium equipment.
                </p>
                
                <div class="grid grid-cols-2 gap-8 mb-10">
                    <div class="text-center">
                        <div class="text-3xl font-light text-emerald-900 mb-1">Heli-Hiking</div>
                        <div class="text-xs text-neutral-500 tracking-wider">MOUNTAIN ACCESS</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-light text-emerald-900 mb-1">Deep Sea</div>
                        <div class="text-xs text-neutral-500 tracking-wider">DIVING EXPEDITIONS</div>
                    </div>
                </div>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-700"></div>
                        <p class="text-sm text-neutral-700">Via ferrata climbing with professional guides</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-700"></div>
                        <p class="text-sm text-neutral-700">Multi-day trekking with luxury camp setups</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-emerald-900 to-emerald-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-emerald-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Start Adventure</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-800 to-emerald-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-900/20 to-emerald-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>
        </div>

        <!-- ITEM 6 - Luxury & Comfort -->
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -right-4 md:right-10 -top-10 md:top-auto md:-right-12 text-[180px] md:text-[220px] font-serif font-bold text-amber-900/5 leading-none select-none z-0 text-right">
                06
            </div>
            
            <div class="relative z-10 md:order-2 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-amber-800 to-amber-800/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-amber-800">
                        Refined Stays
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Luxury & Comfort
                    <span class="block text-amber-900/40 font-serif text-2xl mt-2">Elevated Living</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Thoughtful stays, seamless flow, and space to exhale completely. Experience accommodation that feels less like a hotel and more like a personal sanctuary.
                </p>
                
                <div class="grid grid-cols-3 gap-6 mb-10">
                    <div class="text-center">
                        <div class="text-2xl font-light text-amber-900 mb-1">24/7</div>
                        <div class="text-xs text-neutral-500 tracking-wider">PERSONAL BUTLER</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-light text-amber-900 mb-1">Private</div>
                        <div class="text-xs text-neutral-500 tracking-wider">SPA & WELLNESS</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-light text-amber-900 mb-1">Michelin</div>
                        <div class="text-xs text-neutral-500 tracking-wider">DINING EXPERIENCE</div>
                    </div>
                </div>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-amber-800"></div>
                        <p class="text-sm text-neutral-700">Private villa with infinity pool and panoramic views</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-amber-800"></div>
                        <p class="text-sm text-neutral-700">Customized aromatherapy and sleep programs</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-amber-900 to-amber-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-amber-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Experience Luxury</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-amber-800 to-amber-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-900/20 to-amber-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>

            <div class="relative z-10 md:order-1 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-amber-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1630587148265-761cbd139043?q=80&w=687&auto=format&fit=crop"
                        alt="Luxury & Comfort"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-amber-900/10 to-transparent"></div>
                    
                    <div class="absolute top-6 right-6 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 max-w-[200px] shadow-2xl shadow-black/20">
                        <div class="text-white font-light text-sm leading-relaxed">
                            "Every detail considered, every comfort anticipated."
                        </div>
                    </div>
                </div>
                
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                    <p class="text-xs font-medium text-amber-900 tracking-widest">FIVE-STAR SANCTUARY</p>
                </div>
            </div>
        </div>
        
        <div class="group relative grid md:grid-cols-2 gap-16 md:gap-28 items-center">
            <div class="absolute -left-4 md:left-10 -top-10 md:top-auto md:-left-12 text-[180px] md:text-[220px] font-serif font-bold text-rose-900/5 leading-none select-none z-0">
                07
            </div>
            
            <div class="relative z-10 overflow-hidden rounded-3xl md:rounded-[2.5rem] shadow-2xl shadow-black/5 group-hover:shadow-rose-900/10 transition-all duration-700">
                <div class="relative overflow-hidden rounded-3xl md:rounded-[2.5rem]">
                    <img
                        src="https://images.unsplash.com/photo-1559734840-f9509ee5677f?q=80&w=687&auto=format&fit=crop"
                        alt="Family & Shared Journeys"
                        class="w-full h-[320px] sm:h-[400px] md:h-[520px]
                               object-cover transition-all duration-1000 ease-out
                               group-hover:scale-110 group-hover:brightness-110" />
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-rose-900/20 to-transparent"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-tr from-rose-900/0 via-transparent to-rose-900/0 group-hover:from-rose-900/5 group-hover:to-rose-900/5 transition-all duration-700"></div>
                </div>
                
                <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                    <p class="text-xs font-medium text-rose-900 tracking-widest">MULTI-GENERATIONAL</p>
                </div>
            </div>

            <div class="relative z-10 max-w-lg md:max-w-xl">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-px bg-gradient-to-r from-rose-600 to-rose-600/40"></div>
                    <p class="uppercase tracking-[0.3em] text-xs font-medium text-rose-600">
                        Bonding Experiences
                    </p>
                </div>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-light tracking-tight text-neutral-900 mb-8 leading-tight">
                    Family & Shared Journeys
                    <span class="block text-rose-900/40 font-serif text-2xl mt-2">Together Moments</span>
                </h2>

                <p class="text-neutral-600 text-base md:text-lg leading-relaxed mb-10">
                    Create lasting memories with loved ones through thoughtfully curated experiences that cater to all ages while maintaining the highest standards of luxury and comfort.
                </p>
                
                <div class="grid grid-cols-2 gap-8 mb-10">
                    <div class="text-center">
                        <div class="text-2xl font-light text-rose-900 mb-1">Custom</div>
                        <div class="text-xs text-neutral-500 tracking-wider">FAMILY ITINERARIES</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-light text-rose-900 mb-1">Private</div>
                        <div class="text-xs text-neutral-500 tracking-wider">EDUTAINMENT GUIDES</div>
                    </div>
                </div>
                
                <div class="space-y-4 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-rose-600"></div>
                        <p class="text-sm text-neutral-700">Private family villas with dedicated staff</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-rose-600"></div>
                        <p class="text-sm text-neutral-700">Interactive cultural workshops for all ages</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-rose-600"></div>
                        <p class="text-sm text-neutral-700">Child-friendly adventure activities with expert supervision</p>
                    </div>
                </div>
                
                <div class="mt-8">
                    <button class="group/btn relative px-8 py-4 bg-gradient-to-r from-rose-900 to-rose-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-rose-900/30">
                        <span class="relative z-10 font-medium tracking-wide">Plan Family Trip</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-rose-800 to-rose-700 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-rose-900/20 to-rose-800/20 rounded-full blur-md opacity-0 group-hover/btn:opacity-100 transition-opacity duration-700"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 md:px-12 mt-36 md:mt-44">
        <div class="border-t border-neutral-200 pt-16">
            <h3 class="text-2xl font-light text-neutral-900 mb-10 text-center">Explore By Interest</h3>
            
            <div class="flex flex-wrap justify-center gap-4 md:gap-6 mb-20">
                <button class="px-6 py-3 rounded-full border border-amber-200 text-amber-900 bg-amber-50 hover:bg-amber-100 transition-all duration-300 hover:scale-105 font-medium">
                    Wellness & Mindfulness
                </button>
                <button class="px-6 py-3 rounded-full border border-emerald-200 text-emerald-900 bg-emerald-50 hover:bg-emerald-100 transition-all duration-300 hover:scale-105 font-medium">
                    Nature & Wildlife
                </button>
                <button class="px-6 py-3 rounded-full border border-amber-200 text-amber-900 bg-amber-50 hover:bg-amber-100 transition-all duration-300 hover:scale-105 font-medium">
                    Cultural Immersion
                </button>
                <button class="px-6 py-3 rounded-full border border-blue-200 text-blue-900 bg-blue-50 hover:bg-blue-100 transition-all duration-300 hover:scale-105 font-medium">
                    Coastal & Island
                </button>
                <button class="px-6 py-3 rounded-full border border-emerald-200 text-emerald-900 bg-emerald-50 hover:bg-emerald-100 transition-all duration-300 hover:scale-105 font-medium">
                    Adventure & Sports
                </button>
                <button class="px-6 py-3 rounded-full border border-amber-200 text-amber-900 bg-amber-50 hover:bg-amber-100 transition-all duration-300 hover:scale-105 font-medium">
                    Luxury Stays
                </button>
                <button class="px-6 py-3 rounded-full border border-rose-200 text-rose-900 bg-rose-50 hover:bg-rose-100 transition-all duration-300 hover:scale-105 font-medium">
                    Family Travel
                </button>
            </div>
        </div>
    </div>
    
    <div class="max-w-4xl mx-auto px-5 sm:px-8 md:px-12 mt-20 md:mt-28 text-center">
        <div class="relative bg-gradient-to-br from-white to-neutral-50 border border-neutral-200 rounded-3xl md:rounded-[2.5rem] p-12 md:p-16 shadow-2xl shadow-black/5">
            <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-amber-900 text-white px-8 py-2 rounded-full text-sm font-medium tracking-wider">
                LIMITED AVAILABILITY
            </div>
            
            <h3 class="text-3xl md:text-4xl font-light text-neutral-900 mb-6">
                Begin Your Curated Journey
            </h3>
            <p class="text-neutral-600 text-lg mb-10 max-w-2xl mx-auto">
                Connect with our experience designers to craft a personalized journey that reflects your deepest aspirations and creates memories that last a lifetime.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="Custom-Form" class="group/cta relative px-10 py-5 bg-gradient-to-r from-neutral-900 to-neutral-800 text-white rounded-full overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-neutral-900/30">
                    <span class="relative z-10 font-medium tracking-wide text-lg">Schedule Your Journey</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-neutral-800 to-neutral-700 opacity-0 group-hover/cta:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-neutral-900/20 to-neutral-800/20 rounded-full blur-xl opacity-0 group-hover/cta:opacity-100 transition-opacity duration-700"></div>
                </a>
                
                <a href="Tour" class="group/cta2 relative px-10 py-5 bg-white border border-neutral-300 text-neutral-900 rounded-full overflow-hidden transition-all duration-500 hover:border-neutral-400">
                    <span class="relative z-10 font-medium tracking-wide text-lg">View All Journey</span>
                    <div class="absolute inset-0 bg-neutral-50 opacity-0 group-hover/cta2:opacity-100 transition-opacity duration-500"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Menambahkan interaksi scroll-triggered animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observasi setiap item experience
        document.querySelectorAll('#experiences .group').forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            el.style.transitionDelay = `${index * 0.15}s`;
            
            observer.observe(el);
        });

        // Tambahkan efek hover yang lebih smooth untuk gambar
        document.querySelectorAll('#experiences img').forEach(img => {
            img.parentElement.addEventListener('mouseenter', () => {
                img.style.transform = 'scale(1.05) translateZ(0)';
            });
            
            img.parentElement.addEventListener('mouseleave', () => {
                img.style.transform = 'scale(1) translateZ(0)';
            });
        });

        // Animasi untuk tombol
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Filter category interaction
        const filterButtons = document.querySelectorAll('.flex-wrap button');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-amber-100', 'bg-emerald-100', 'bg-blue-100', 'bg-rose-100');
                    btn.classList.add('bg-amber-50', 'bg-emerald-50', 'bg-blue-50', 'bg-rose-50');
                });
                
                // Add active class to clicked button
                if (this.classList.contains('border-amber-200')) {
                    this.classList.remove('bg-amber-50');
                    this.classList.add('bg-amber-100');
                } else if (this.classList.contains('border-emerald-200')) {
                    this.classList.remove('bg-emerald-50');
                    this.classList.add('bg-emerald-100');
                } else if (this.classList.contains('border-blue-200')) {
                    this.classList.remove('bg-blue-50');
                    this.classList.add('bg-blue-100');
                } else if (this.classList.contains('border-rose-200')) {
                    this.classList.remove('bg-rose-50');
                    this.classList.add('bg-rose-100');
                }
                
                // Scroll to experiences section
                document.getElementById('experiences').scrollIntoView({ behavior: 'smooth' });
            });
        });
    });

    // Efek scroll progress
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        
        document.querySelectorAll('#experiences .group').forEach((group, index) => {
            if (group.getBoundingClientRect().top < window.innerHeight * 0.8) {
                const parallaxValue = scrolled * 0.03 * (index + 1);
                group.style.transform = `translateY(${Math.min(parallaxValue, 40)}px)`;
            }
        });
    });
</script>

<style>
    /* Animasi untuk elemen saat masuk viewport */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: fadeInUp 0.8s ease forwards;
    }

    /* Efek hover yang lebih halus dengan 3D transform */
    #experiences .group {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
        perspective: 1000px;
    }

    #experiences .group:hover {
        transform: translateY(-8px) translateZ(20px);
    }

    /* Gradient border effect yang lebih smooth */
    #experiences .relative.overflow-hidden.rounded-3xl::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: inherit;
        padding: 2px;
        background: linear-gradient(45deg, transparent, rgba(120, 53, 15, 0.1), transparent);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.6s ease;
        z-index: 1;
        pointer-events: none;
    }

    #experiences .group:hover .relative.overflow-hidden.rounded-3xl::before {
        opacity: 1;
    }

    /* Efek glow untuk angka dekoratif */
    #experiences .absolute.font-serif {
        text-shadow: 0 0 40px rgba(120, 53, 15, 0.1);
    }

    /* Custom scrollbar untuk section */
    #experiences {
        scroll-behavior: smooth;
        scroll-margin-top: 100px;
    }

    /* Efek glassmorphism yang lebih refined */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    /* Smooth image scaling */
    #experiences img {
        transform: translateZ(0);
        backface-visibility: hidden;
        will-change: transform;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #experiences .group {
            transform: none !important;
        }
        
        #experiences .group:hover {
            transform: translateY(-4px) !important;
        }
    }
</style>

@endsection