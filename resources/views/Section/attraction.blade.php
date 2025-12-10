<section class="relative py-12 overflow-hidden">
    <div class="container mx-auto px-6 md:px-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 tracking-tight">
                Top Attractions in Indonesia
            </h2>
            <p class="text-gray-500 mt-3 max-w-2xl mx-auto text-sm md:text-base">
                Discover Indonesia’s most captivating destinations — where culture, nature, and adventure blend in perfect harmony.
            </p>
        </div>

        <div class="swiper attraction-slider">
            <div class="swiper-wrapper">
                @foreach($attractions as $item)
                <div class="swiper-slide">
                    <div class="group relative rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.1)] 
                    hover:shadow-[0_12px_40px_rgb(0,0,0,0.2)] transition-all duration-500">

                        <img
                            src="{{ $item->summer_img ?? 'https://images.unsplash.com/photo-1533805994737-558461dcb28e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                            alt="{{ trim(str_replace('WNA', '', $item->name)) }}"
                            class="w-full h-72 object-cover transition-all duration-700 group-hover:scale-110">

                        <!-- OVERLAY GRADIENT -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/60"></div>

                        <!-- TEXT CONTENT ON IMAGE -->
                        <div class="absolute px-5 bottom-5 left-5 right-5 text-white space-y-1">

                            <h3 class="text-xl font-semibold drop-shadow-md tracking-tight">
                                {{ trim(str_replace('WNA', '', $item->name)) }}

                            </h3>

                            <p class="text-sm text-gray-200 drop-shadow-sm">
                                {{ $item->location }}
                            </p>

                            <p class="text-[#E5D3A5] font-semibold text-lg drop-shadow-lg">
                                IDR {{ number_format($item->price) }}
                            </p>

                        </div>
                    </div>

                </div>
                @endforeach

            </div>
            <div class="absolute left-0 right-0 top-1/2 transform -translate-y-1/2 flex items-center justify-between z-10 px-6 pointer-events-none">
                <button id="prevBtn" class="pointer-events-auto p-2.5 sm:p-3 border border-gray-400 rounded-full text-black hover:text-white hover:bg-[#CB0001] hover:border-[#CB0001] transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button id="nextBtn"
                    class="pointer-events-auto p-2.5 sm:p-3 border border-gray-400 rounded-full text-black hover:text-white hover:bg-[#CB0001] hover:border-[#CB0001] transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="swiper-pagination"></div>

</section>

<script src="JS/SwiperAttraction.js"></script>