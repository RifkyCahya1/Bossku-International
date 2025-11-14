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

        <!-- Swiper -->
        <div class="swiper attraction-slider">
            <div class="swiper-wrapper">

                <!-- Bali -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?bali" alt="Bali" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Tropical Escape</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                Surfing, beach relaxation, coastal walks, and world-class spa treatments.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bromo -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?bromo" alt="Bromo" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Mountain Adventure</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                Hike to sunrise viewpoints, explore volcanic landscapes, and capture breathtaking moments.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Raja Ampat -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?raja-ampat" alt="Raja Ampat" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Underwater Paradise</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                World-class diving and snorkeling amid vibrant coral reefs and rich marine life.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Labuan Bajo -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?labuan-bajo" alt="Labuan Bajo" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Island Expedition</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                Explore Komodo Island, dive with manta rays, and trek through scenic island trails.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Yogyakarta -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?yogyakarta" alt="Yogyakarta" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Cultural Heritage</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                Discover ancient temples, heritage sites, and immersive cultural experiences.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Danau Toba -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?toba" alt="Danau Toba" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Serenity & Nature</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                Enjoy serene boat rides and hiking adventures around the world’s largest volcanic lake.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Belitung -->
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <img src="https://source.unsplash.com/600x400/?belitung" alt="Belitung" class="w-full h-60 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-800">Coastal Discovery</h3>
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                Snorkel, swim, and explore unique granite islands in crystal-clear waters.
                            </p>
                        </div>
                    </div>
                </div>
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
</section>