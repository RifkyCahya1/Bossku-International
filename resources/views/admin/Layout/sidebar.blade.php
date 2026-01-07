<!-- Overlay untuk sidebar mobile -->
<div id="sidebarOverlay"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<!-- Sidebar untuk semua device -->
<aside id="sidebar"
    class="fixed lg:sticky top-0 lg:top-28 left-0 z-50
    w-64 h-screen lg:h-fit
    -translate-x-full lg:translate-x-0
    transition-transform duration-300 ease-in-out
    backdrop-blur-xl bg-white/5 border border-white/10
    rounded-none lg:rounded-2xl
    p-6">

    <!-- Close button untuk mobile (hanya tampil di mobile) -->
    <button id="closeSidebar" class="absolute top-4 right-4 lg:hidden text-gray-400 hover:text-white p-2">
        <i class="fa-solid fa-times text-lg"></i>
    </button>

    <h2 class="text-gray-300 text-sm uppercase tracking-widest mb-4">
        Navigation
    </h2>

    <nav class="space-y-2">
        <a href="/admin"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-gauge-high w-5 h-5 text-center"></i>
            <span class="text-sm">Dashboard</span>
        </a>

        <a href="/admin/tours"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/tours*') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-book w-5 h-5 text-center"></i>
            <span class="text-sm">Tours</span>
        </a>

        <a href="/admin/users"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/users') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-users w-5 h-5 text-center"></i>
            <span class="text-sm">Account Info</span>
        </a>

        <a href="/admin/leads"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/leads') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <x-carbon-user-service-desk class="h-5 w-5" />
            <span class="text-sm">Leads</span>
        </a>

        <a href="/admin/booking"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/booking') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <x-heroicon-s-ticket class="h-5 w-5" />
            <span class="text-sm">Bookings</span>
        </a>

        <a href="/admin/settings"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/settings') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-gear w-5 h-5 text-center"></i>
            <span class="text-sm">Settings</span>
        </a>
    </nav>

    <!-- User info untuk mobile (opsional) -->
    <div class="absolute bottom-6 left-6 right-6 lg:hidden">
        <div class="pt-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                    <span class="text-blue-400 font-bold text-sm">
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