<nav
    id="navbar"
    x-data="{ open: false, scrolled: false }"
    x-init="() => {
        scrolled = window.pageYOffset > 10;
        window.addEventListener('scroll', () => scrolled = window.pageYOffset > 10)
    }"
    :class="{'shadow-md bg-white': scrolled, 'bg-[#f6fff8]': !scrolled}"
    class="py-3 fixed top-0 left-0 w-full z-50 text-black transition-all duration-300">
    <div class="px-4">
        <div class="flex items-center justify-between h-12 md:px-12">
            <div class="hidden md:flex flex-1 justify-start space-x-4">
                <a href="/Destination" class="text-sm font-medium relative group">
                    Destination
                    <span class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Experience" class="text-sm font-medium relative group">
                    Experiences
                    <span class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Explore" class="text-sm font-medium relative group">
                    Travel In Indonesia
                    <span class="absolute left-0 -bottom-1 w-[75%] h-[2px] bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
            </div>

            <div class="flex-shrink-0 flex justify-center">
                <a href="/">
                    <img class="h-auto w-32 md:w-48" src="{{ asset('img/Bossku.tours.png') }}" alt="Logo">
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-end items-center space-x-4">
                <a href="/Tour" class="text-sm font-medium relative group">
                    Tour Package
                    <span class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/About" class="text-sm font-medium relative group">
                    About
                    <span class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Login"
                    class="block px-4 py-2 text-sm font-medium rounded-sm
                    bg-gradient-to-r from-[#8a743f] via-[#b69a5e] to-[#d8c38b] 
                    text-black hover:opacity-90 transition">
                    Login
                </a>

                <a href="/Custom-Form"
                    class="block px-4 py-2 text-sm font-medium rounded-sm
                    bg-gradient-to-r from-[#b79a5b] via-[#e7d49c] to-[#f5e7b0] 
                    text-black hover:opacity-90 transition">
                    Custom Trip
                </a>



            </div>

            <!-- Hamburger (Mobile) -->
            <div class="md:hidden flex items-center">
                <button
                    @click="open = !open"
                    @keydown.escape="open = false"
                    :aria-expanded="open.toString()"
                    aria-controls="mobile-menu"
                    class="focus:outline-none">
                    <svg :class="{'text-black': scrolled, 'text-black': !scrolled}" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            id="mobile-menu"
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            @click.away="open = false"
            x-cloak
            class="md:hidden mt-2 bg-white rounded shadow-lg text-black">
            <a href="/Destinastion" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Destination</a>
            <a href="/Experiences" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Experiences</a>
            <a href="/Explore" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Travel In Indonesia</a>
            <a href="/Tour" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Tour Packages</a>
            <a href="/About" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">About</a>
            <a href="/Login" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Login</a>
            <a href="/Custom-Form" class="block px-4 py-2 text-sm font-medium rounded bg-[#FFCA10] text-black mt-2">Custom Trip</a>
        </div>
    </div>
</nav>