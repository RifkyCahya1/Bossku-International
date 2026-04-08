<!-- Overlay untuk sidebar mobile -->
<div id="sidebarOverlay"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<!-- Sidebar untuk semua device -->
<aside id="sidebar"
    class="fixed lg:sticky top-0 left-0 z-50
    w-64 h-screen
    -translate-x-full lg:translate-x-0
    transition-transform duration-300 ease-in-out
    bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900
    border-r border-white/10
    shadow-2xl
    p-6">

    <!-- Close button untuk mobile (hanya tampil di mobile) -->
    <button id="closeSidebar" class="absolute top-4 right-4 lg:hidden text-gray-400 hover:text-white p-2">
        <i class="fa-solid fa-times text-lg"></i>
    </button>

    <!-- Logo/Brand section -->
    <div class="mb-8 pb-4 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-gradient-to-br from-[#0ABFA3] to-[#05796A] rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <div>
                <h2 class="text-white font-bold text-sm tracking-wide">Admin Panel</h2>
                <p class="text-gray-400 text-[10px]">Tour Management</p>
            </div>
        </div>
    </div>

    <h2 class="text-gray-400 text-xs uppercase tracking-wider mb-4 font-semibold">
        Main Navigation
    </h2>

    <nav class="space-y-1.5">
        <a href="/admin"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition-all duration-200 group
            {{ request()->is('admin') ? 'bg-gradient-to-r from-[#0ABFA3]/20 to-[#05796A]/20 text-white border-l-2 border-[#0ABFA3]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
            <i class="fa-solid fa-gauge-high w-5 h-5 text-center {{ request()->is('admin') ? 'text-[#0ABFA3]' : 'text-gray-400 group-hover:text-[#0ABFA3]' }}"></i>
            <span class="text-sm font-medium">Dashboard</span>
            @if(request()->is('admin'))
            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-[#0ABFA3]"></span>
            @endif
        </a>

        <a href="/admin/itinerary-builder"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition-all duration-200 group
            {{ request()->is('admin/itinerary-builder*') ? 'bg-gradient-to-r from-[#0ABFA3]/20 to-[#05796A]/20 text-white border-l-2 border-[#0ABFA3]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
            <i class="fa-solid fa-book w-5 h-5 text-center {{ request()->is('admin/itinerary-builder*') ? 'text-[#0ABFA3]' : 'text-gray-400 group-hover:text-[#0ABFA3]' }}"></i>
            <span class="text-sm font-medium">Itinerary Builder</span>
        </a>

        <a href="/admin/users"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition-all duration-200 group
            {{ request()->is('admin/users') ? 'bg-gradient-to-r from-[#0ABFA3]/20 to-[#05796A]/20 text-white border-l-2 border-[#0ABFA3]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
            <i class="fa-solid fa-users w-5 h-5 text-center {{ request()->is('admin/users') ? 'text-[#0ABFA3]' : 'text-gray-400 group-hover:text-[#0ABFA3]' }}"></i>
            <span class="text-sm font-medium">Account Info</span>
        </a>

        <a href="/admin/leads"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition-all duration-200 group
            {{ request()->is('admin/leads') ? 'bg-gradient-to-r from-[#0ABFA3]/20 to-[#05796A]/20 text-white border-l-2 border-[#0ABFA3]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
            <x-carbon-user-service-desk class="h-5 w-5 {{ request()->is('admin/leads') ? 'text-[#0ABFA3]' : 'text-gray-400 group-hover:text-[#0ABFA3]' }}" />
            <span class="text-sm font-medium">Leads</span>
        </a>

        <a href="/admin/booking"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition-all duration-200 group
            {{ request()->is('admin/booking') ? 'bg-gradient-to-r from-[#0ABFA3]/20 to-[#05796A]/20 text-white border-l-2 border-[#0ABFA3]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
            <x-heroicon-s-ticket class="h-5 w-5 {{ request()->is('admin/booking') ? 'text-[#0ABFA3]' : 'text-gray-400 group-hover:text-[#0ABFA3]' }}" />
            <span class="text-sm font-medium">Bookings</span>
        </a>

        <a href="/admin/settings"
            class="flex items-center gap-3 rounded-xl px-4 py-2.5 transition-all duration-200 group
            {{ request()->is('admin/settings') ? 'bg-gradient-to-r from-[#0ABFA3]/20 to-[#05796A]/20 text-white border-l-2 border-[#0ABFA3]' : 'text-gray-300 hover:text-white hover:bg-white/5' }}">
            <i class="fa-solid fa-gear w-5 h-5 text-center {{ request()->is('admin/settings') ? 'text-[#0ABFA3]' : 'text-gray-400 group-hover:text-[#0ABFA3]' }}"></i>
            <span class="text-sm font-medium">Settings</span>
        </a>
    </nav>

    <!-- Divider -->
    <div class="my-6 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

    <!-- Quick Stats di Sidebar -->
    <div class="space-y-3">
        <h3 class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Quick Stats</h3>

        <div class="bg-white/5 rounded-xl p-3 backdrop-blur-sm">
            <div class="flex items-center justify-between mb-2">
                <span class="text-gray-400 text-xs">Total Users</span>
                <span class="text-[#0ABFA3] text-xs font-bold">{{ number_format($totalUsers ?? 0) }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-xs">Active Tours</span>
                <span class="text-[#0ABFA3] text-xs font-bold">{{ $activeTours ?? 0 }}</span>
            </div>
        </div>
    </div>

    <!-- User info untuk mobile (opsional) -->
    <div class="absolute bottom-6 left-6 right-6 lg:hidden">
        <div class="pt-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-[#0ABFA3] to-[#05796A] rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const closeBtn = document.getElementById('closeSidebar');

    // Fungsi untuk membuka sidebar
    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Mencegah scroll
    }

    // Fungsi untuk menutup sidebar
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Mengembalikan scroll
    }

    // Event listeners
    if (closeBtn) {
        closeBtn.addEventListener('click', closeSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close dengan Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });

    // Close sidebar ketika link diklik (untuk mobile)
    document.querySelectorAll('#sidebar nav a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) { // Hanya di mobile
                closeSidebar();
            }
        });
    });
</script>