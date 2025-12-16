@extends('main')

@section('content')

<!-- HERO : CINEMATIC EXPERIENCE -->
<section class="relative h-[90vh] w-full overflow-hidden">
    <video autoplay muted loop playsinline
        class="absolute inset-0 w-full h-full object-cover">
        <source src="/videos/experience-loop.mp4" type="video/mp4">
    </video>

    <!-- overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-black/10"></div>

    <!-- content -->
    <div class="relative z-10 h-full flex flex-col justify-center px-6 md:px-24">
        <p class="text-white/70 text-xs tracking-[0.35em] uppercase mb-6">
            Curated Experiences
        </p>

        <h1 class="text-white text-3xl md:text-5xl font-light leading-tight max-w-3xl">
            Every journey carries a different rhythm.<br>
            Some slow you down. Some wake you up.
        </h1>

        <p class="text-white/70 mt-8 max-w-xl leading-relaxed text-[15px]">
            Here are the experiences we design — gently, intentionally.
        </p>
    </div>
</section>

<!-- EXPERIENCES -->
<section class="py-32 bg-white">
    <div class="max-w-6xl mx-auto px-6 space-y-40">

        <!-- Slow & Soulful -->
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <img src="/images/slow-soulful.jpg"
                alt="Slow & Soulful"
                class="w-full h-[420px] object-cover rounded-2xl
                shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">

            <div>
                <p class="uppercase tracking-[0.3em] text-xs text-neutral-400 mb-4">
                    Experience Type
                </p>

                <h2 class="text-2xl font-light tracking-wide text-neutral-900 mb-6">
                    Slow & Soulful
                </h2>

                <p class="text-neutral-500 text-[15px] leading-relaxed max-w-md">
                    Quiet mornings. Gentle days. Time that stretches instead of rushes.
                </p>
            </div>
        </div>

        <!-- Nature & Silence -->
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <div class="md:order-2">
                <p class="uppercase tracking-[0.3em] text-xs text-neutral-400 mb-4">
                    Experience Type
                </p>

                <h2 class="text-2xl font-light tracking-wide text-neutral-900 mb-6">
                    Nature & Silence
                </h2>

                <p class="text-neutral-500 text-[15px] leading-relaxed max-w-md">
                    Mountains, forests, and spaces where words become unnecessary.
                </p>
            </div>

            <img src="/images/nature-silence.jpg"
                alt="Nature & Silence"
                class="md:order-1 w-full h-[420px] object-cover rounded-2xl
                shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">
        </div>

        <!-- Culture & Depth -->
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <img src="/images/culture-depth.jpg"
                alt="Culture & Depth"
                class="w-full h-[420px] object-cover rounded-2xl
                shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">

            <div>
                <p class="uppercase tracking-[0.3em] text-xs text-neutral-400 mb-4">
                    Experience Type
                </p>

                <h2 class="text-2xl font-light tracking-wide text-neutral-900 mb-6">
                    Culture & Depth
                </h2>

                <p class="text-neutral-500 text-[15px] leading-relaxed max-w-md">
                    Traditions, rituals, and stories shared — not staged.
                </p>
            </div>
        </div>

        <!-- Island Escapes -->
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <div class="md:order-2">
                <p class="uppercase tracking-[0.3em] text-xs text-neutral-400 mb-4">
                    Experience Type
                </p>

                <h2 class="text-2xl font-light tracking-wide text-neutral-900 mb-6">
                    Island Escapes
                </h2>

                <p class="text-neutral-500 text-[15px] leading-relaxed max-w-md">
                    Salt air, barefoot days, and horizons that soften everything.
                </p>
            </div>

            <img src="/images/island-escape.jpg"
                alt="Island Escapes"
                class="md:order-1 w-full h-[420px] object-cover rounded-2xl
                shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">
        </div>

        <!-- Adventure & Movement -->
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <img src="/images/adventure.jpg"
                alt="Adventure & Movement"
                class="w-full h-[420px] object-cover rounded-2xl
                shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">

            <div>
                <p class="uppercase tracking-[0.3em] text-xs text-neutral-400 mb-4">
                    Experience Type
                </p>

                <h2 class="text-2xl font-light tracking-wide text-neutral-900 mb-6">
                    Adventure & Movement
                </h2>

                <p class="text-neutral-500 text-[15px] leading-relaxed max-w-md">
                    Trails, tides, climbs, and moments that stay with you.
                </p>
            </div>
        </div>

        <!-- Luxury & Comfort -->
        <div class="grid md:grid-cols-2 gap-20 items-center">
            <div class="md:order-2">
                <p class="uppercase tracking-[0.3em] text-xs text-neutral-400 mb-4">
                    Experience Type
                </p>

                <h2 class="text-2xl font-light tracking-wide text-neutral-900 mb-6">
                    Luxury & Comfort
                </h2>

                <p class="text-neutral-500 text-[15px] leading-relaxed max-w-md">
                    Thoughtful stays, seamless flow, and space to exhale.
                </p>
            </div>

            <img src="/images/luxury.jpg"
                alt="Luxury & Comfort"
                class="md:order-1 w-full h-[420px] object-cover rounded-2xl
                shadow-[0_30px_60px_-20px_rgba(0,0,0,0.25)]">
        </div>

    </div>
</section>

@endsection