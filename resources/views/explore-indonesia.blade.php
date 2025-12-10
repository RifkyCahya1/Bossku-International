@extends('main')
@section('content')

<style>
    .ExploreSlider .swiper-slide {
        opacity: 0.4;
        transform: scale(0.9);
        transition: all .35s ease;
    }

    .ExploreSlider .swiper-slide.is-center {
        opacity: 1;
        transform: scale(1);
    }
</style>

<div class="relative w-full">
    <img src="img/ExploreIndonesia.jpg" alt="Gambar Hotel" class="w-full h-screen object-cover">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-22 py-10">
        <h1 class="text-white mx-auto text-3xl md:text-8xl text-pretty font-bold drop-shadow-md mb-2 tracking-wider text-center uppercase">
            EXPLORE INDONESIA
        </h1>
    </div>
</div>

<div class="container relative z-10 px-6 md:px-16 mx-auto mt-12">
    <section class="text-center">
        <p class="text-[#8A8A8A] text-xs md:text-base font-medium tracking-[0.25em] uppercase">
            Interactive Map
        </p>

        <h2 class="text-[#0B0B0B] text-3xl md:text-5xl font-semibold leading-snug tracking-tight mb-2">
            Explore Indonesia’s Beauty
        </h2>

        <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto font-normal leading-relaxed">
            Discover the timeless charm of Indonesia through our interactive map
            from tropical beaches to misty highlands, each island awaits your exploration.
        </p>
    </section>

    <div id="map" style="height: 600px; width: 100%;"></div>

    <div id="modalOverlay"
        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm justify-center items-center z-[9999] transition-opacity duration-300 opacity-0">

        <div id="modalContent"
            class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 p-6 relative transform scale-95 transition-all duration-300 ease-out">

            <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold transition-transform hover:scale-110">
                &times;
            </button>

            <img id="modalImage" src="" alt="Province Image" class="w-full h-64 object-cover rounded-xl mb-4">

            <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-2"></h2>
            <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
        </div>
    </div>
</div>

<section class="relative text-white py-12 md:py-20 overflow-hidden">

    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1604973104381-870c92f10343?q=80&w=1170&auto=format&fit=crop"
            alt="Background Indonesia"
            class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-br from-[#f9f7f3]/0 via-black/60 to-black/80"></div>
    </div>

    <div class="relative max-w-screen-xl mx-auto px-4 md:px-10">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-16 text-center md:text-left">

            <div>
                <p class="uppercase tracking-widest text-sm text-[#CB0001] font-semibold">Tour</p>
                <h2 class="text-3xl md:text-6xl font-bold leading-tight">
                    Interesting Place of <span class="text-[#FF0000]">Indonesia</span>
                </h2>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center md:justify-end gap-4">

                <div class="flex items-end font-semibold gap-1">
                    <span id="currentSlide" class="text-2xl sm:text-3xl text-[#CB0001] font-bold">01</span>
                    <span class="text-gray-500 text-base sm:text-lg">/</span>
                    <span id="totalSlide" class="text-gray-200 text-base sm:text-lg">03</span>
                </div>

                <div class="w-full h-2 bg-white/10 rounded-full overflow-hidden">
                    <div id="progressBar" class="h-full bg-[#CB0001] transition-all duration-500 w-0"></div>
                </div>

                <div class="flex justify-between md:justify-end items-center gap-2">
                    <button id="prevBtn"
                        class="p-2.5 sm:p-3 border border-gray-400 rounded-full text-white hover:bg-[#CB0001] hover:border-[#CB0001] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button id="nextBtn"
                        class="p-2.5 sm:p-3 border border-gray-400 rounded-full text-white hover:bg-[#CB0001] hover:border-[#CB0001] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>

        <div x-data="tourCategories" class="relative mt-10">
            <div class="swiper ExploreSlider overflow-visible">
                <div class="swiper-wrapper">

                    <template x-for="(item, index) in categories" :key="index">
                        <div class="swiper-slide">
                            <div class="relative rounded-2xl overflow-hidden group">

                                <img :src="item.image"
                                    class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                    :alt="item.title">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                    <h3 class="text-lg sm:text-xl font-semibold mb-1" x-text="item.title"></h3>
                                    <p class="text-gray-300 text-xs sm:text-sm" x-text="item.description"></p>
                                </div>

                            </div>
                        </div>
                    </template>

                </div>

                <div class="swiper-pagination mt-4 md:hidden"></div>
            </div>
        </div>

    </div>
</section>


<script src="JS/SwiperExplore.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('tourCategories', () => ({
            categories: [{
                    title: "Culinary Tourism",
                    image: "https://images.unsplash.com/photo-1613653739328-e86ebd77c9c8?q=80&w=1170&auto=format&fit=crop",
                    description: "Dive into Indonesia’s rich culinary scene, from sizzling street snacks to authentic traditional dishes."
                },
                {
                    title: "Marine Tourism",
                    image: "https://images.unsplash.com/photo-1587015539194-a95a49797b66?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    description: "Discover crystal-clear waters, vibrant coral reefs, and stunning tropical coastlines perfect for snorkeling and diving."
                },
                {
                    title: "Adventure Tourism",
                    image: "https://images.unsplash.com/photo-1624731798627-6cea0017de7c?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    description: "Experience thrilling outdoor adventures from mountains and forests to waterfalls and extreme activities."
                },
                {
                    title: "Arts & Culture",
                    image: "https://images.unsplash.com/photo-1679141435935-7d8ff9659c9a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    description: "Explore traditional dances, spiritual rituals, heritage crafts, and Indonesia’s diverse artistic expressions."
                },
                {
                    title: "Cultural Heritage",
                    image: "https://images.unsplash.com/photo-1738245671004-ac736a44a134?q=80&w=1169&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    description: "Journey through ancient temples, heritage sites, and historical landmarks that tell Indonesia’s timeless stories."
                },
                {
                    title: "Religious Tourism",
                    image: "https://images.unsplash.com/photo-1671811805878-a587da969fa7?q=80&w=1161&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    description: "Visit sacred sites, spiritual landmarks, and religious destinations rich with cultural meaning."
                },
                {
                    title: "Village Tourism",
                    image: "https://i.pinimg.com/1200x/f9/6a/9a/f96a9a98eaacbeffa2c29028a290d527.jpg",
                    description: "Experience authentic rural life, local traditions, and community-based tourism in Indonesia’s charming villages."
                },
            ]
        }));
    });
</script>

<script src="JS/map.js"></script>
@endsection