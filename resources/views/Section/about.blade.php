<section x-data="{ step: 1 }" x-cloak class="relative overflow-hidden py-4">
    <div class="container mx-auto px-4 sm:px-6 md:px-16 lg:px-20 relative z-10">

        <!-- Card utama -->
        <div class="bg-white/80 backdrop-blur-md border border-gray-200 rounded-2xl p-6 sm:p-10 md:p-14 flex flex-col lg:flex-row items-center gap-8 shadow-xl transition-all duration-700">

            <!-- Text -->
            <div class="flex-1 space-y-5 text-gray-700 order-2 lg:order-1 text-center lg:text-left">
                <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-4 tracking-tight text-gray-900">
                    Bossku Journey Over the Years
                </h2>

                <!-- Step Content (x-show + x-transition untuk smooth) -->
                <div x-show="step === 1"
                     x-transition:enter="transition transform ease-out duration-500"
                     x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition transform ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="animate-fadeIn">
                    <h3 class="text-lg sm:text-xl font-semibold text-[#071F35] mb-2">Feb 2025 — The Digital Leap</h3>
                    <p class="leading-relaxed text-gray-700 text-sm sm:text-base">
                        Bossku Tour & Travel officially entered the digital era — launching our AI-powered trip planner designed to personalize experiences, simplify booking, and deliver real-time itinerary updates.
                    </p>
                </div>

                <div x-show="step === 2"
                     x-transition:enter="transition transform ease-out duration-500"
                     x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition transform ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="animate-fadeIn">
                    <h3 class="text-lg sm:text-xl font-semibold text-[#071F35] mb-2">Jun 2025 — Expanding Experiences</h3>
                    <p class="leading-relaxed text-gray-700 text-sm sm:text-base">
                        Bossku collaborated with international partners to craft premium travel experiences across Asia and Europe, blending cultural authenticity with modern luxury.
                    </p>
                </div>

                <div x-show="step === 3"
                     x-transition:enter="transition transform ease-out duration-500"
                     x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition transform ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="animate-fadeIn">
                    <h3 class="text-lg sm:text-xl font-semibold text-[#071F35] mb-2">Sep 2025 — Premium Redefined</h3>
                    <p class="leading-relaxed text-gray-700 text-sm sm:text-base">
                        The introduction of Bossku Premium marked a milestone — offering bespoke journeys curated for travelers who value elegance, comfort, and personalized service above all.
                    </p>
                </div>

                <div x-show="step === 4"
                     x-transition:enter="transition transform ease-out duration-500"
                     x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition transform ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                     class="animate-fadeIn">
                    <h3 class="text-lg sm:text-xl font-semibold text-[#071F35] mb-2">Dec 2025 — The Global Vision</h3>
                    <p class="leading-relaxed text-gray-700 text-sm sm:text-base">
                        Closing the year, Bossku established its global footprint, showcasing Indonesia’s hospitality to the world while continuing to lead in digital innovation and premium travel experiences.
                    </p>
                </div>
            </div>

            <!-- Gambar (stacked + x-show + x-transition.opacity untuk crossfade) -->
            <div class="flex-1 order-1 lg:order-2 transition-all duration-700 ease-in-out w-full">
                <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 bg-white relative h-48 sm:h-64 md:h-80 lg:h-96">
                    <img x-cloak x-show="step === 1" x-transition:enter="transition-opacity duration-600"
                         x-transition:leave="transition-opacity duration-400"
                         class="absolute inset-0 w-full h-full object-cover will-change-transform will-change-opacity"
                         src="https://source.unsplash.com/1000x650/?ai,travel" alt="Feb 2025">
                    <img x-cloak x-show="step === 2" x-transition:enter="transition-opacity duration-600"
                         x-transition:leave="transition-opacity duration-400"
                         class="absolute inset-0 w-full h-full object-cover will-change-transform will-change-opacity"
                         src="https://source.unsplash.com/1000x650/?europe,journey" alt="Jun 2025">
                    <img x-cloak x-show="step === 3" x-transition:enter="transition-opacity duration-600"
                         x-transition:leave="transition-opacity duration-400"
                         class="absolute inset-0 w-full h-full object-cover will-change-transform will-change-opacity"
                         src="https://source.unsplash.com/1000x650/?luxury,hotel" alt="Sep 2025">
                    <img x-cloak x-show="step === 4" x-transition:enter="transition-opacity duration-600"
                         x-transition:leave="transition-opacity duration-400"
                         class="absolute inset-0 w-full h-full object-cover will-change-transform will-change-opacity"
                         src="https://source.unsplash.com/1000x650/?world,travel" alt="Dec 2025">
                </div>
            </div>
        </div>

        <!-- Timeline Navigation -->
        <div class="mt-8 sm:mt-10 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex flex-wrap justify-center lg:justify-start gap-3 overflow-x-auto pb-1">
                <template x-for="(item, index) in ['Feb 2025', 'Jun 2025', 'Sep 2025', 'Dec 2025']" :key="index">
                    <button
                        @click="step = index + 1"
                        :class="step === index + 1 
              ? 'bg-[#071F35] text-white shadow-md' 
              : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200'"
                        class="px-4 sm:px-6 py-2 rounded-full text-sm sm:text-base font-medium transition-all duration-300 whitespace-nowrap">
                        <span x-text="item"></span>
                    </button>
                </template>
            </div>

            <!-- Prev / Next -->
            <div class="flex w-full sm:w-auto justify-center lg:justify-end gap-3">
                <button
                    @click="if (step > 1) step--"
                    :disabled="step === 1"
                    :class="step === 1 
            ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
            : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200'"
                    class="px-5 py-2 rounded-full text-sm sm:text-base font-medium transition duration-200">
                    ← Prev
                </button>

                <button
                    @click="if (step < 4) step++"
                    :disabled="step === 4"
                    :class="step === 4 
            ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
            : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200'"
                    class="px-5 py-2 rounded-full text-sm sm:text-base font-medium transition duration-200">
                    Next →
                </button>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.45s ease-in-out; }

        /* scrollbar kecil untuk timeline buttons */
        .overflow-x-auto::-webkit-scrollbar { height: 6px; }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.08);
            border-radius: 999px;
        }
    </style>
</section>