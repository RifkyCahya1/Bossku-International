<header class="w-full backdrop-blur-xl bg-white/5 border-b border-white/10 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <h1 class="text-xl font-semibold text-white">Admin Panel</h1>

        <div class="relative" x-data="{ open: false }">

            <button @click="open = !open" class="flex items-center gap-4 hover:opacity-80 transition cursor-pointer">

                <div class="text-right">
                    <p class="text-white font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-gray-400 text-xs">Administrator</p>
                </div>

                <div class="md:h-10 md:w-10 rounded-full overflow-hidden border border-white/30">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="">
                </div>
            </button>

            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-44 bg-gray-800 backdrop-blur-xl  border border-white/10 rounded-xl overflow-hidden shadow-lg">
                <a href="/admin/profile"
                    class="block px-4 py-3 text-gray-300 hover:bg-white/20 hover:text-white transition">
                    <i class="fa-solid fa-user mr-2"></i> Profile
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="w-full text-left px-4 py-3 text-gray-300 hover:bg-white/20 hover:text-white transition">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</header>