<footer class="relative bg-gradient-to-bl from-[#1a1a1a] via-[#111] to-[#0a0a0a]  text-gray-300 overflow-hidden">

    <div class="relative container mx-auto px-4 md:px-24 py-16">

        <!-- GRID UTAMA -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-start">

            <!-- Kolom 1 : Subscribe -->
            <div class="lg:col-span-2">
                <img src="{{ asset('img/Bossku.tours.png') }}"
                    alt="BOSSKU"
                    class="w-40 mb-10">

                <h4 class="text-sm uppercase tracking-[0.35em] text-gray-500 mb-4">
                    Stay in the Loop
                </h4>

                <h3 class="text-2xl md:text-3xl font-light text-white leading-tight mb-4 max-w-2xl">
                    Journeys worth remembering. <br>
                    Stories worth opening.
                </h3>

                <p class="text-base md:text-lg text-gray-400 leading-relaxed mb-12 max-w-xl">
                    No spam. No noise. Just thoughtfully curated travel inspiration,
                    exclusive routes, and rare departures delivered when it actually matters.
                </p>

                <form class="flex flex-col sm:flex-row gap-5 max-w-xl">
                    <input
                        type="email"
                        placeholder="Your email address"
                        class="w-full px-4 py-3 md:px-6 md:py-5 rounded-md bg-white/5 border border-white/15 text-base text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500/70 focus:bg-white/10 transition">

                    <button
                        type="submit"
                        class="p-4 md:px-6 md:py-5 rounded-md bg-white text-black text-base font-semibold hover:bg-gray-200 transition whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
            </div>

            <!-- Kolom 2 : Explore -->
            <div>
                <h4 class="text-[11px] uppercase tracking-[0.25em] text-gray-500 mb-4 mt-2">
                    Explore
                </h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/Tour" class="hover:text-white transition">Tour Packages</a></li>
                    <li><a href="/Custom-Form" class="hover:text-white transition">Custom My Trip</a></li>
                    <li><a href="/Explore" class="hover:text-white transition">Destinations Map</a></li>
                </ul>
            </div>

            <!-- Kolom 3 : Information -->
            <div>
                <h4 class="text-[11px] uppercase tracking-[0.25em] text-gray-500 mb-4 mt-2">
                    Information
                </h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/About" class="hover:text-white transition">About Us</a></li>
                    <li><a href="/FAQ" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Sponsorship</a></li>
                    <li><a href="/terms" class="hover:text-white transition">Terms & Conditions</a></li>
                    <li><a href="/privacy" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Kolom 4 : Associated By -->
            <div>
                <h4 class="text-[11px] uppercase tracking-[0.25em] text-gray-500 mb-8">
                    Associated By
                </h4>

                <div class="space-y-6">
                    <img src="{{ asset('img/Asita.png') }}"
                        alt="ASITA"
                        class="w-24 opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition">

                    <img src="{{ asset('img/Astindo.png') }}"
                        alt="ASTINDO"
                        class="w-24 opacity-70 grayscale hover:grayscale-0 hover:opacity-100 transition">
                </div>
            </div>

        </div>

        <!-- BOTTOM BAR -->
        <div class="mt-24 pt-10 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
            <p>
                © 2024–2025 BOSSKU.TOURS. Crafted with intention.
            </p>
            <div class="flex gap-6">
                <a href="/terms" class="hover:text-white transition">Terms</a>
                <a href="/privacy" class="hover:text-white transition">Privacy</a>
            </div>
        </div>

    </div>
</footer>