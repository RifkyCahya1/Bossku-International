<section class="relative text-white py-12 md:py-20 overflow-hidden">

    <div class="absolute inset-0">
        <img src="img/tari.jpg"
            alt="Background Indonesia"
            class="w-full h-full object-cover object-center" />
        <div class="absolute inset-0 bg-gradient-to-br from-[#f9f7f3]/40 via-black/70 to-black/90"></div>
    </div>

    <div class="relative container mx-auto px-4 md:px-16 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">

        <div class="space-y-6 text-center md:text-left order-1 md:order-1">
            <p class="uppercase tracking-widest text-sm text-[#CB0001] font-semibold">Spotlight</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                The Unique Charm of <span class="text-[#FF0000]">Indonesia</span>
            </h2>
            <p class="text-gray-100 font-medium text-sm sm:text-base md:text-lg leading-relaxed max-w-xl mx-auto md:mx-0">
                Discover Indonesia’s breathtaking beauty through its iconic destinations such as
                Bali’s tropical paradise, the mystical Mount Bromo, and many more cultural gems across the archipelago.
                Experience vibrant traditions, exquisite local crafts, and authentic flavors that capture the spirit of Indonesia.
            </p>

            <div class="flex justify-center md:justify-start">
                <button class="bg-transparent border border-white text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-full hover:bg-white hover:text-black transition-all duration-300 flex items-center gap-2 text-sm sm:text-base">
                    Discover Indonesia’s Unique Wonders
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>

            <div class="mt-8 sm:mt-10 space-y-2">
                <div class="flex items-end justify-center md:justify-start font-semibold gap-1">
                    <span id="currentSlide" class="text-2xl sm:text-3xl text-[#CB0001] font-bold tracking-tight">01</span>
                    <span class="text-gray-500 text-base sm:text-lg font-medium">/</span>
                    <span id="totalSlide" class="text-gray-200 text-base sm:text-lg font-medium">03</span>
                </div>

                <div class="w-full h-2 sm:h-3 bg-white/10 rounded-full overflow-hidden">
                    <div id="progressBar" class="h-full bg-[#CB0001]  transition-all duration-500" style="width: 0%;"></div>
                </div>

                <div class="flex items-center justify-center md:justify-end gap-2">
                    <button id="prevBtn"
                        class="p-2.5 sm:p-3 border border-gray-400 rounded-full text-white hover:bg-[#CB0001]  hover:border-[#CB0001] transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="nextBtn"
                        class="p-2.5 sm:p-3 border border-gray-400 rounded-full text-white hover:bg-[#CB0001] hover:border-[#CB0001] transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 sm:w-5 h-4 sm:h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="relative order-2">
            <div class="swiper mySwiper overflow-visible">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?bali,indonesia"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Bali" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Bali – The Island of Gods</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Immerse yourself in Bali’s tropical beauty, where golden beaches, lush rice terraces, and vibrant temple festivals create a paradise of peace and culture.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?bromo,volcano"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Bromo" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Mount Bromo – A Sea of Clouds</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Witness the breathtaking sunrise above a sea of mist as Mount Bromo reveals its majestic crater amid the mystical Tengger caldera.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?yogyakarta,borobudur"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Yogyakarta" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Yogyakarta – Heart of Javanese Culture</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Explore the royal heritage of Yogyakarta, home to the magnificent Borobudur Temple, local batik art, and the warmth of Javanese traditions.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?rajaampat,islands"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Raja Ampat" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Raja Ampat – Paradise of the East</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Dive into the crystal-clear waters of Raja Ampat, where vibrant coral reefs and marine life create one of the world’s most stunning underwater ecosystems.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?labuanbajo,komodo"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Labuan Bajo" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Labuan Bajo – Gateway to Komodo</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Sail through turquoise waters, discover hidden islands, and meet the legendary Komodo dragons in the natural wonder of Labuan Bajo.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?lake-toba,indonesia"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Lake Toba" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Lake Toba – The Highland Serenity</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Experience the tranquil charm of Lake Toba, the largest volcanic lake in the world, surrounded by Batak culture and breathtaking highland scenery.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="relative rounded-2xl overflow-hidden group">
                            <img src="https://source.unsplash.com/800x500/?belitung,beach"
                                class="object-cover w-full h-[220px] sm:h-[300px] md:h-[350px] lg:h-[420px] transition-transform duration-700 group-hover:scale-105"
                                alt="Belitung" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent p-4 sm:p-6 flex flex-col justify-end">
                                <h3 class="text-lg sm:text-xl font-semibold mb-1">Belitung – Pristine Beaches & Granite Shores</h3>
                                <p class="text-gray-300 text-xs sm:text-sm leading-snug">
                                    Discover Belitung’s crystal-clear waters, unique granite rock formations, and secluded beaches — a perfect escape for tranquillity and island exploration.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination mt-3 md:hidden"></div>
            </div>

        </div>
    </div>
</section>  