<aside class="w-64 backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-6 h-fit sticky top-28">
    <h2 class="text-gray-300 text-sm uppercase tracking-widest mb-4">Navigation</h2>

    <nav class="space-y-2">
        <a href="/admin"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        <a href="/admin/tours"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/tours*') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-book"></i> Tours
        </a>

        <a href="/admin/users"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/users') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-users"></i> Account Info
        </a>
        
        <a href="#"
            class="flex items-center gap-3 rounded-xl px-4 py-3 transition
            {{ request()->is('admin/settings') ? 'text-white bg-white/20' : 'text-gray-300 hover:text-white hover:bg-white/10' }}">
            <i class="fa-solid fa-gear"></i> Settings
        </a>
    </nav>
</aside>