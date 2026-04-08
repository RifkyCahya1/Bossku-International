<nav
    id="navbar"
    x-data="{ scrolled: false, mobileOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
    :class="scrolled ? 'bg-white text-black shadow-lg' : 'bg-transparent text-white'"
    class="py-3 fixed top-0 left-0 w-full z-50 transition-all duration-300">


    <div class="px-4">
        <div class="flex items-center justify-between h-12 sm:h-14 lg:h-12 lg:px-12">
            <div class="hidden lg:flex flex-1 justify-start space-x-4">
                <a href="/Experience" class="text-sm font-medium relative group">
                    Experiences
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/Explore" class="text-sm font-medium relative group">
                    Travel In Indonesia
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
                <a href="/About" class="text-sm font-medium relative group">
                    About
                    <span
                        class="absolute left-0 -bottom-1 w-[75%] h-0.5 bg-[#02335B] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                </a>
            </div>
            <div class="flex-shrink-0 flex justify-center">
                <a href="/">
                    <img class="h-auto w-32 lg:w-48"
                        :src="scrolled ? '{{ asset('img/Bossku.tours.png') }}' : '{{ asset('img/BosskuWhite.png') }}'"
                        class="transition-all duration-300" alt="Logo">
                </a>
            </div>

            <div class="hidden lg:flex flex-1 justify-end items-center space-x-4">

                <a href="/Custom-Form"
                    :class="scrolled 
                    ? 'bg-gradient-to-r from-[#a89258] via-[#c8b375] to-[#f5e7b0] text-black' 
                    : 'bg-white text-black'"
                    class="text-sm font-medium px-6 py-2 rounded-sm transition-colors duration-200 hover:opacity-90">
                    Design My Journey
                </a>

                @auth
                <div x-data="{ open: false }" class="relative">
                    <!-- Avatar button -->
                    <button @click="open = !open"
                        class="flex items-center gap-2 focus:outline-none">
                        <img
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D2B45&color=fff"
                            alt="Avatar"
                            class="w-9 h-9 rounded-full ring-2 ring-white/40 hover:ring-white transition">
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-3 w-44 bg-white rounded-md shadow-xl border border-neutral-200 overflow-hidden z-50">

                        <a href="/Profile"
                            class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100">
                            Profile
                        </a>

                        <a href="/Dashboard"
                            class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-100">
                            Dashboard
                        </a>

                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="/login"
                    :class="scrolled 
                    ? 'bg-gradient-to-br from-[#0a0a0a] via-[#111] to-[#1a1a1a] text-white' 
                    : 'bg-gradient-to-r from-[#a89258] via-[#c8b375] to-[#f5e7b0] text-black'"
                    class="text-sm font-medium px-6 py-2 rounded-sm transition-colors duration-200 hover:opacity-90">
                    Login
                </a>
                @endauth


            </div>

            <div class="lg:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen" class="focus:outline-none">

                    <svg :class="{ 'text-black': scrolled, 'text-white': !scrolled }" class="w-7 h-7" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': mobileOpen, 'block': !mobileOpen }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'block': mobileOpen, 'hidden': !mobileOpen }" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div
            x-show="mobileOpen"
            x-transition
            @click.outside="mobileOpen = false"
            class="lg:hidden absolute left-0 top-full w-full bg-white shadow-lg text-black">

            <a href="/Experience" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Experiences</a>
            <a href="/Explore" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Travel In
                Indonesia</a>
            <a href="/Tour" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Tour Package</a>
            <a href="/About" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">About</a>
            <a href="/login" class="block px-4 py-2 text-sm font-medium hover:bg-gray-100">Login</a>
            <a href="/Custom-Form" class="block px-4 py-2 text-sm font-medium rounded bg-[#FFCA10] text-black mt-2">Design My Journey</a>
        </div>
    </div>
</nav>