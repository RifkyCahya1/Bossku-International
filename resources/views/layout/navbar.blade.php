<nav id="navbar" x-data="{ scrolled: false, open: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-white text-black shadow-lg transition-colors duration-300' :
        'text-white bg-transparent transition-colors duration-300'"
    class="py-3 fixed top-0 left-0 w-full z-90 transition-all duration-300">

    <div class="px-4">
        <div class="flex items-center justify-between h-12 md:px-12">
            <div class="hidden md:flex flex-1 justify-start space-x-4">
                <a href="/Destination" class="text-sm font-medium relative group">
                    Destination
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Experience" class="text-sm font-medium relative group">
                    Experiences
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Explore-Indonesia" class="text-sm font-medium relative group">
                    Travel In Indonesia
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
            </div>
            <div class="flex-shrink-0 flex justify-center">
                <a href="/">
                    <img class="h-auto w-32 md:w-48"
                        :src="scrolled ? '{{ asset('img/Bossku.tours.png') }}' : '{{ asset('img/BosskuWhite.png') }}'"
                        class="transition-all duration-300" alt="Logo">
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-end items-center space-x-4">
                <a href="/Tour" class="text-sm font-medium relative group">
                    Tour Packages
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/About" class="text-sm font-medium relative group">
                    About
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Login"
                    :class="scrolled 
                    ? 'bg-[#02335B] text-white' 
                    : 'bg-gradient-to-r from-[#a89258] via-[#c8b375] to-[#f5e7b0] text-black'"
                    class="text-sm font-medium px-6 py-2 rounded-sm transition-colors duration-200 hover:opacity-90">
                    Login
                </a>

                <a href="/Custom-Form"
                    :class="scrolled 
                    ? 'bg-gradient-to-r from-[#a89258] via-[#c8b375] to-[#f5e7b0] text-black' 
                    : 'bg-white text-black'"
                    class="text-sm font-medium px-6 py-2 rounded-sm transition-colors duration-200 hover:opacity-90">
                    Custom Trip
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="focus:outline-none">
                    <svg :class="{ 'text-black': scrolled, 'text-white': !scrolled }" class="w-7 h-7" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'block': !open }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'block': open, 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition class="md:hidden mt-2 bg-white rounded shadow-lg text-black">
            <a href="/Destination" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Destination</a>
            <a href="/Experience" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Experiences</a>
            <a href="/Explore-Indonesia" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Travel In
                Indonesia</a>
            <a href="/Services" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Services</a>
            <a href="/About" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">About</a>
            <a href="/Login" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Login</a>
            <a href="/Custom-Form" class="block px-4 py-2 text-sm font-medium rounded bg-[#FFCA10] text-black mt-2">Custom
                Trip</a>
        </div>
    </div>
</nav>