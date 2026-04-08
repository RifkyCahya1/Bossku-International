@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono&display=swap" rel="stylesheet">

<style>
   body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #F2F4F8;
   }
</style>

<div class="flex min-h-screen">

   @include('admin.Layout.sidebar')

   <main class="flex-1 overflow-x-hidden px-5 py-6 sm:px-7 sm:py-7 lg:px-9 lg:py-8">

      {{-- Mobile topbar --}}
      <div class="flex items-center gap-3 mb-6 lg:hidden">
         <button id="toggleSidebar" class="w-10 h-10 rounded-xl bg-white border border-black/[0.07] shadow-sm flex items-center justify-center text-gray-600 hover:bg-gray-50 transition">
            <i class="fa-solid fa-bars text-sm"></i>
         </button>
         <div>
            <h1 class="text-lg font-extrabold text-gray-900 leading-tight">Dashboard</h1>
            <p class="text-xs text-gray-500">Control Center</p>
         </div>
      </div>

      {{-- Desktop header --}}
      <div class="hidden lg:flex items-end justify-between mb-8">
         <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
            <p class="text-sm text-gray-500 mt-0.5">Selamat datang kembali, <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span></p>
         </div>
         <span class="text-xs text-gray-400 bg-white border border-black/[0.07] px-4 py-2 rounded-full font-mono" id="live-date"></span>
      </div>

      @include('admin.Layout.topbar')

      {{-- ── STAT CARDS ── --}}
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-7">

         <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="absolute top-0 inset-x-0 h-[3px] bg-[#0ABFA3] rounded-t-2xl"></div>
            <div class="flex justify-end mb-3">
               <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#D4F5EE] flex items-center justify-center text-[#05796A] group-hover:scale-110 transition-transform">
                  <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0Zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0Z" />
                  </svg>
               </div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Total Users</p>
            <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($totalUsers) }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Accounts terdaftar</p>
            <span class="inline-flex mt-2 text-[10px] font-bold bg-[#D4F5EE] text-[#05796A] px-2.5 py-0.5 rounded-full">↑ +24 minggu ini</span>
         </div>

         <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="absolute top-0 inset-x-0 h-[3px] bg-[#FF6B6B] rounded-t-2xl"></div>
            <div class="flex justify-end mb-3">
               <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#FFE8E8] flex items-center justify-center text-[#CC3B3B] group-hover:scale-110 transition-transform">
                  <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
               </div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Active Tours</p>
            <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $activeTours }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Produk aktif</p>
            <span class="inline-flex mt-2 text-[10px] font-bold bg-[#D4F5EE] text-[#05796A] px-2.5 py-0.5 rounded-full">↑ 3 baru bulan ini</span>
         </div>

         <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="absolute top-0 inset-x-0 h-[3px] bg-[#FFBA08] rounded-t-2xl"></div>
            <div class="flex justify-end mb-3">
               <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#FFF3C4] flex items-center justify-center text-[#A07800] group-hover:scale-110 transition-transform">
                  <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
               </div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Pending Orders</p>
            <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $pendingOrders ?? 12 }}</p>
            <p class="text-xs text-gray-400 mt-0.5">Perlu direview</p>
            <span class="inline-flex mt-2 text-[10px] font-bold bg-[#FFF3C4] text-[#A07800] px-2.5 py-0.5 rounded-full">⚠ Perlu tindakan</span>
         </div>

         <div class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="absolute top-0 inset-x-0 h-[3px] bg-[#5B5BD6] rounded-t-2xl"></div>
            <div class="flex justify-end mb-3">
               <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-[#EDEDFF] flex items-center justify-center text-[#3B3BAA] group-hover:scale-110 transition-transform">
                  <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
               </div>
            </div>
            <p class="text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Admin Status</p>
            <p class="text-lg sm:text-xl font-extrabold text-gray-900 leading-tight truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-400 mt-0.5 truncate">{{ auth()->user()->email }}</p>
            <span class="inline-flex mt-2 text-[10px] font-bold bg-[#EDEDFF] text-[#3B3BAA] px-2.5 py-0.5 rounded-full">{{ auth()->user()->role }}</span>
         </div>

      </div>

      {{-- ── ISSUES ── --}}
      <div class="mb-7">
         <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm sm:text-base font-bold text-gray-800 flex items-center gap-2">
               <span class="w-2 h-2 rounded-full bg-[#FF6B6B] shrink-0"></span>
               Masalah yang Perlu Perhatian
            </h2>
            <span class="text-[10px] font-semibold bg-red-50 text-red-500 border border-red-200 px-2.5 py-1 rounded-full">3 Issues</span>
         </div>

         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">

            <a href="/admin/orders?status=pending" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] border-l-[3px] border-l-[var(--color-red)] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 block group">
               <div class="flex items-center justify-between mb-2.5">
                  <div class="flex items-center gap-2.5">
                     <div class="w-8 h-8 rounded-lg bg-[#FFE8E8] flex items-center justify-center text-[var(--color-red)] shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                     </div>
                     <span class="text-sm font-bold text-gray-800">Pending Payment</span>
                  </div>
                  <span class="text-[10px] font-bold bg-red-50 text-[var(--color-red)] px-2 py-0.5 rounded-full">High</span>
               </div>
               <p class="text-xs text-gray-500 leading-relaxed mb-3">5 pesanan menunggu konfirmasi pembayaran lebih dari 24 jam.</p>
               <div class="flex items-center justify-between">
                  <span class="text-[10px] text-gray-400">Klik untuk review</span>
                  <div class="w-6 h-6 rounded-lg bg-[#FFE8E8] flex items-center justify-center text-[var(--color-red)] group-hover:brightness-90 transition">
                     <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                     </svg>
                  </div>
               </div>
            </a>

            <a href="/admin/tours" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] border-l-[3px] border-l-[#FFBA08] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 block group">
               <div class="flex items-center justify-between mb-2.5">
                  <div class="flex items-center gap-2.5">
                     <div class="w-8 h-8 rounded-lg bg-[#FFF3C4] flex items-center justify-center text-[#A07800] shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.342 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                     </div>
                     <span class="text-sm font-bold text-gray-800">Low Stock Alert</span>
                  </div>
                  <span class="text-[10px] font-bold bg-[#FFF3C4] text-[#A07800] px-2 py-0.5 rounded-full">Medium</span>
               </div>
               <p class="text-xs text-gray-500 leading-relaxed mb-3">2 produk tour kuota hampir habis, segera perbarui stok.</p>
               <div class="flex items-center justify-between">
                  <span class="text-[10px] text-gray-400">Klik untuk kelola</span>
                  <div class="w-6 h-6 rounded-lg bg-[#FFF3C4] flex items-center justify-center text-[#A07800] group-hover:brightness-90 transition">
                     <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                     </svg>
                  </div>
               </div>
            </a>

            <a href="/admin/support" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] border-l-[3px] border-l-[#5B5BD6] shadow-sm hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 block group sm:col-span-2 lg:col-span-1">
               <div class="flex items-center justify-between mb-2.5">
                  <div class="flex items-center gap-2.5">
                     <div class="w-8 h-8 rounded-lg bg-[#EDEDFF] flex items-center justify-center text-[#5B5BD6] shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                     </div>
                     <span class="text-sm font-bold text-gray-800">Unread Messages</span>
                  </div>
                  <span class="text-[10px] font-bold bg-[#EDEDFF] text-[#5B5BD6] px-2 py-0.5 rounded-full">Low</span>
               </div>
               <p class="text-xs text-gray-500 leading-relaxed mb-3">8 pesan belum dibalas dari customer, perlu respons segera.</p>
               <div class="flex items-center justify-between">
                  <span class="text-[10px] text-gray-400">Klik untuk balas</span>
                  <div class="w-6 h-6 rounded-lg bg-[#EDEDFF] flex items-center justify-center text-[#5B5BD6] group-hover:brightness-90 transition">
                     <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                     </svg>
                  </div>
               </div>
            </a>

         </div>
      </div>

      {{-- ── MONITORING + ACTIVITY ── --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-7">

         <div class="bg-white rounded-2xl p-5 sm:p-6 border border-black/[0.07] shadow-sm">
            <div class="flex items-center justify-between mb-5">
               <h2 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                  <span class="w-2 h-2 rounded-full bg-[#0ABFA3] shrink-0"></span>
                  Monitoring Progres
               </h2>
               <span class="text-[10px] font-semibold text-gray-400 bg-gray-100 border border-gray-200 px-2.5 py-1 rounded-full">Real-time</span>
            </div>
            <div class="space-y-5">
               <div>
                  <div class="flex justify-between items-center mb-2">
                     <span class="text-sm font-semibold text-gray-700">Order Completion Rate</span>
                     <span class="text-sm font-extrabold text-[#0ABFA3]">78%</span>
                  </div>
                  <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                     <div class="h-full bg-[#0ABFA3] rounded-full" style="width:78%"></div>
                  </div>
                  <div class="flex justify-between text-[11px] text-gray-400 mt-1.5">
                     <span>32/41 orders selesai</span><span>Target: 85%</span>
                  </div>
               </div>
               <div>
                  <div class="flex justify-between items-center mb-2">
                     <span class="text-sm font-semibold text-gray-700">User Growth (7 hari)</span>
                     <span class="text-sm font-extrabold text-[#5B5BD6]">+12.5%</span>
                  </div>
                  <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                     <div class="h-full bg-[#5B5BD6] rounded-full" style="width:65%"></div>
                  </div>
                  <div class="flex justify-between text-[11px] text-gray-400 mt-1.5">
                     <span>+24 user baru</span><span>Total: {{ number_format($totalUsers) }}</span>
                  </div>
               </div>
               <div>
                  <div class="flex justify-between items-center mb-2">
                     <span class="text-sm font-semibold text-gray-700">Tour Booking Rate</span>
                     <span class="text-sm font-extrabold text-[#FF6B6B]">45%</span>
                  </div>
                  <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                     <div class="h-full bg-[#FF6B6B] rounded-full" style="width:45%"></div>
                  </div>
                  <div class="flex justify-between text-[11px] text-gray-400 mt-1.5">
                     <span>18/40 slot terisi</span><span>Populer: Bali Tour</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="bg-white rounded-2xl p-5 sm:p-6 border border-black/[0.07] shadow-sm">
            <div class="flex items-center justify-between mb-5">
               <h2 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                  <span class="w-2 h-2 rounded-full bg-[#FFBA08] shrink-0"></span>
                  Aktivitas Terbaru
               </h2>
            </div>
            <div class="divide-y divide-gray-100 max-h-72 overflow-y-auto pr-1">
               @forelse($recentActivities ?? [] as $act)
               <div class="flex items-start gap-3 py-3">
                  <div class="w-2 h-2 rounded-full mt-1.5 shrink-0" style="background:{{ $act['hex'] ?? '#0ABFA3' }}"></div>
                  <div>
                     <p class="text-xs text-gray-700 leading-relaxed">{{ $act['text'] }}</p>
                     <p class="text-[11px] text-gray-400 mt-0.5 font-mono">{{ $act['time'] }}</p>
                  </div>
               </div>
               @empty
               @foreach([
               ['dot'=>'bg-[#0ABFA3]','text'=>'Booking baru #BK-2840 dari Andi Susanto', 'time'=>'2 menit lalu'],
               ['dot'=>'bg-[#5B5BD6]','text'=>'Partner "Bali Explore" berhasil mendaftar', 'time'=>'15 menit lalu'],
               ['dot'=>'bg-[#FFBA08]','text'=>'Proposal Raja Ampat dikirim ke klien', 'time'=>'1 jam lalu'],
               ['dot'=>'bg-[#FF6B6B]','text'=>'Booking #BK-2837 dibatalkan oleh user', 'time'=>'2 jam lalu'],
               ['dot'=>'bg-[#0ABFA3]','text'=>'Itinerary Lombok 7D6N berhasil dibuat', 'time'=>'3 jam lalu'],
               ['dot'=>'bg-[#5B5BD6]','text'=>'User baru Siti Rahayu bergabung', 'time'=>'4 jam lalu'],
               ] as $act)
               <div class="flex items-start gap-3 py-3">
                  <div class="w-2 h-2 rounded-full mt-1.5 shrink-0 {{ $act['dot'] }}"></div>
                  <div>
                     <p class="text-xs text-gray-700 leading-relaxed">{{ $act['text'] }}</p>
                     <p class="text-[11px] text-gray-400 mt-0.5 font-mono">{{ $act['time'] }}</p>
                  </div>
               </div>
               @endforeach
               @endforelse
            </div>
         </div>

      </div>

      {{-- ── QUICK ACTIONS ── --}}
      <div>
         <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm sm:text-base font-bold text-gray-800 flex items-center gap-2">
               <span class="w-2 h-2 rounded-full bg-[#FFBA08] shrink-0"></span>
               Klik Cepat ke Menu
            </h2>
            <span class="text-[10px] font-semibold text-gray-400 bg-gray-100 border border-gray-200 px-2.5 py-1 rounded-full">Shortcut</span>
         </div>
         <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">

            <a href="/admin/orders/create" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-1 hover:shadow-md hover:border-[#0ABFA3] transition-all duration-200 text-center group">
               <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#D4F5EE] flex items-center justify-center text-[#05796A] mx-auto mb-3 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                  </svg>
               </div>
               <p class="text-sm font-bold text-gray-800">Tambah Order</p>
               <p class="text-xs text-gray-400 mt-0.5">Manual booking</p>
            </a>

            <a href="/admin/tours/create" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-1 hover:shadow-md hover:border-[#5B5BD6] transition-all duration-200 text-center group">
               <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#EDEDFF] flex items-center justify-center text-[#5B5BD6] mx-auto mb-3 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
               </div>
               <p class="text-sm font-bold text-gray-800">Buat Tour</p>
               <p class="text-xs text-gray-400 mt-0.5">Produk baru</p>
            </a>

            <a href="/admin/users" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-1 hover:shadow-md hover:border-[#7B3FE4] transition-all duration-200 text-center group">
               <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#F0E8FF] flex items-center justify-center text-[#7B3FE4] mx-auto mb-3 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
               </div>
               <p class="text-sm font-bold text-gray-800">Kelola User</p>
               <p class="text-xs text-gray-400 mt-0.5">Lihat semua user</p>
            </a>

            <a href="/admin/reports" class="bg-white rounded-2xl p-4 sm:p-5 border border-black/[0.07] shadow-sm hover:-translate-y-1 hover:shadow-md hover:border-[#FFBA08] transition-all duration-200 text-center group">
               <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-[#FFF3C4] flex items-center justify-center text-[#A07800] mx-auto mb-3 group-hover:scale-110 transition-transform">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                  </svg>
               </div>
               <p class="text-sm font-bold text-gray-800">Laporan</p>
               <p class="text-xs text-gray-400 mt-0.5">Analytics & reports</p>
            </a>

         </div>
      </div>

   </main>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
      const btn = document.getElementById('toggleSidebar');
      if (btn) btn.addEventListener('click', () => {
         if (typeof openSidebar === 'function') openSidebar();
      });

      const el = document.getElementById('live-date');
      if (el) el.textContent = new Date().toLocaleDateString('id-ID', {
         weekday: 'long',
         day: 'numeric',
         month: 'long',
         year: 'numeric'
      });
   });
</script>

@endsection