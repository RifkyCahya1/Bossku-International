@extends('main')

@section('content')
<section class="relative min-h-[100svh] w-full overflow-hidden">

    <video autoplay muted loop playsinline
        class="absolute inset-0 w-full h-full object-cover scale-105 md:scale-110">
        <source src="{{ asset('Videos/IMG_9945.MOV') }}" type="video/mp4">
    </video>

    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black/30"></div>
    <div class="absolute inset-0 bg-[url('/images/noise.png')] opacity-[0.04] mix-blend-overlay pointer-events-none"></div>

    <div
        class="relative z-10 flex min-h-[100svh] flex-col justify-center
               px-5 sm:px-8 md:px-16 lg:px-24
            mx-auto">

        <p class="text-white/60 text-[10px] sm:text-xs tracking-[0.35em] uppercase mb-6 sm:mb-8">
            Curated Experiences
        </p>

        <h1
            class="text-white font-extralight leading-tight
                   text-3xl sm:text-4xl md:text-5xl lg:text-6xl
                   max-w-xl md:max-w-3xl lg:max-w-4xl">
            Every journey has its own rhythm.<br>
            <span class="text-white/70">Some slow you down.</span><br>
            <span class="italic">Some wake you up.</span>
        </h1>

        <p
            class="text-white/60 mt-5 sm:mt-6
                   text-sm sm:text-base
                   max-w-md md:max-w-lg leading-relaxed">
            Experiences designed with intention — not to rush you,
            but to let moments breathe.
        </p>

        <div class="mt-8 sm:mt-10">
            <a href="#experiences"
                class="inline-flex items-center gap-3
                       text-xs sm:text-sm tracking-widest uppercase
                       text-white/80 hover:text-white transition">
                Explore Experiences
                <span class="block w-10 sm:w-12 h-[1px] bg-white/40"></span>
            </a>
        </div>
    </div>

    <div
        class="absolute bottom-6 sm:bottom-10 left-1/2 -translate-x-1/2
               flex flex-col items-center gap-2 animate-pulse">
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

<section class="bg-white py-20 sm:py-24 md:py-32">
    <div class="max-w-6xl mx-auto px-5 sm:px-8 md:px-12 space-y-24 sm:space-y-28 md:space-y-40">

        <!-- ITEM -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            <img src="/images/slow-soulful.jpg"
                alt="Slow & Soulful"
                class="w-full h-[260px] sm:h-[320px] md:h-[420px]
                       object-cover rounded-2xl
                       shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">

            <div class="max-w-md">
                <p class="uppercase tracking-[0.25em] text-[10px] sm:text-xs text-neutral-400 mb-3 sm:mb-4">
                    Experience Type
                </p>

                <h2 class="text-xl sm:text-2xl font-light tracking-wide text-neutral-900 mb-4 sm:mb-6">
                    Slow & Soulful
                </h2>

                <p class="text-neutral-500 text-sm sm:text-[15px] leading-relaxed">
                    Quiet mornings. Gentle days. Time that stretches instead of rushes.
                </p>
            </div>
        </div>

        <!-- ITEM (REVERSE) -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            <div class="md:order-2 max-w-md">
                <p class="uppercase tracking-[0.25em] text-[10px] sm:text-xs text-neutral-400 mb-3 sm:mb-4">
                    Experience Type
                </p>

                <h2 class="text-xl sm:text-2xl font-light tracking-wide text-neutral-900 mb-4 sm:mb-6">
                    Nature & Silence
                </h2>

                <p class="text-neutral-500 text-sm sm:text-[15px] leading-relaxed">
                    Mountains, forests, and spaces where words become unnecessary.
                </p>
            </div>

            <img src="/images/nature-silence.jpg"
                alt="Nature & Silence"
                class="md:order-1 w-full h-[260px] sm:h-[320px] md:h-[420px]
                       object-cover rounded-2xl
                       shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">
        </div>

        <!-- ITEM -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            <img src="/images/culture-depth.jpg"
                alt="Culture & Depth"
                class="w-full h-[260px] sm:h-[320px] md:h-[420px]
                       object-cover rounded-2xl
                       shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">

            <div class="max-w-md">
                <p class="uppercase tracking-[0.25em] text-[10px] sm:text-xs text-neutral-400 mb-3 sm:mb-4">
                    Experience Type
                </p>

                <h2 class="text-xl sm:text-2xl font-light tracking-wide text-neutral-900 mb-4 sm:mb-6">
                    Culture & Depth
                </h2>

                <p class="text-neutral-500 text-sm sm:text-[15px] leading-relaxed">
                    Traditions, rituals, and stories shared — not staged.
                </p>
            </div>
        </div>

        <!-- ITEM (REVERSE) -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            <div class="md:order-2 max-w-md">
                <p class="uppercase tracking-[0.25em] text-[10px] sm:text-xs text-neutral-400 mb-3 sm:mb-4">
                    Experience Type
                </p>

                <h2 class="text-xl sm:text-2xl font-light tracking-wide text-neutral-900 mb-4 sm:mb-6">
                    Island Escapes
                </h2>

                <p class="text-neutral-500 text-sm sm:text-[15px] leading-relaxed">
                    Salt air, barefoot days, and horizons that soften everything.
                </p>
            </div>

            <img src="/images/island-escape.jpg"
                alt="Island Escapes"
                class="md:order-1 w-full h-[260px] sm:h-[320px] md:h-[420px]
                       object-cover rounded-2xl
                       shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">
        </div>

        <!-- ITEM -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            <img src="/images/adventure.jpg"
                alt="Adventure & Movement"
                class="w-full h-[260px] sm:h-[320px] md:h-[420px]
                       object-cover rounded-2xl
                       shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">

            <div class="max-w-md">
                <p class="uppercase tracking-[0.25em] text-[10px] sm:text-xs text-neutral-400 mb-3 sm:mb-4">
                    Experience Type
                </p>

                <h2 class="text-xl sm:text-2xl font-light tracking-wide text-neutral-900 mb-4 sm:mb-6">
                    Adventure & Movement
                </h2>

                <p class="text-neutral-500 text-sm sm:text-[15px] leading-relaxed">
                    Trails, tides, climbs, and moments that stay with you.
                </p>
            </div>
        </div>

        <!-- ITEM (REVERSE) -->
        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center">
            <div class="md:order-2 max-w-md">
                <p class="uppercase tracking-[0.25em] text-[10px] sm:text-xs text-neutral-400 mb-3 sm:mb-4">
                    Experience Type
                </p>

                <h2 class="text-xl sm:text-2xl font-light tracking-wide text-neutral-900 mb-4 sm:mb-6">
                    Luxury & Comfort
                </h2>

                <p class="text-neutral-500 text-sm sm:text-[15px] leading-relaxed">
                    Thoughtful stays, seamless flow, and space to exhale.
                </p>
            </div>

            <img src="/images/luxury.jpg"
                alt="Luxury & Comfort"
                class="md:order-1 w-full h-[260px] sm:h-[320px] md:h-[420px]
                       object-cover rounded-2xl
                       shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">
        </div>

    </div>
</section>


@endsection