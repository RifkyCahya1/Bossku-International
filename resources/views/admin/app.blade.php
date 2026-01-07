@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="bg-[#0E0E10] relative overflow-hidden min-h-screen">
   <div class="absolute inset-0 pointer-events-none">
      <div class="absolute w-[300px] h-[300px] sm:w-[400px] sm:h-[400px] lg:w-[600px] lg:h-[600px] bg-purple-600/20 rounded-full blur-[100px] sm:blur-[140px] -top-10 -left-10 sm:-top-20 sm:-left-20"></div>
      <div class="absolute w-[300px] h-[300px] sm:w-[400px] sm:h-[400px] lg:w-[600px] lg:h-[600px] bg-blue-500/20 rounded-full blur-[120px] sm:blur-[160px] -bottom-10 -right-10 sm:bottom-0 sm:right-0"></div>
   </div>

   @include('admin.Layout.topbar')

   <div class="flex flex-col lg:flex-row mx-auto my-4 sm:my-6 lg:my-10 px-3 sm:px-4 lg:px-6 gap-4 lg:gap-8">

      <div class="lg:hidden flex items-center gap-4 mb-4">
         <button id="toggleSidebar"
            class="bg-white/10 backdrop-blur-md border border-white/20 text-white py-3 px-4 rounded-xl hover:bg-white/20 transition-all">
            <i class="fa-solid fa-bars"></i>
         </button>

         <div>
            <h1 class="text-xl font-bold text-white">Dashboard</h1>
            <p class="text-sm text-gray-400">Control Center</p>
         </div>
      </div>

      <!-- Sidebar (kode di atas) -->
      @include('admin.Layout.sidebar')

      <main class="flex-1 w-full overflow-x-hidden">
         <!-- Header Dashboard -->
         <div class="mb-6 lg:mb-8 lg:block hidden">
            <h1 class="text-xl sm:text-2xl font-bold text-white mb-2">Dashboard</h1>
         </div>

         <!-- STATS CARDS -->
         <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 lg:mb-10">
            <!-- Card 1 -->
            <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-6 rounded-2xl border border-white/10 text-white hover:border-blue-500/50 transition-all duration-300">
               <div class="flex justify-between items-start">
                  <div>
                     <p class="text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2">Total Users</p>
                     <h3 class="text-2xl sm:text-3xl font-bold">{{ number_format($totalUsers) }}</h3>
                     <p class="text-xs sm:text-sm text-gray-400 mt-1">Accounts</p>
                  </div>
                  <div class="p-2 sm:p-3 bg-blue-500/20 rounded-xl">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                     </svg>
                  </div>
               </div>
            </div>

            <!-- Card 2 -->
            <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-6 rounded-2xl border border-white/10 text-white hover:border-purple-500/50 transition-all duration-300">
               <div class="flex justify-between items-start">
                  <div>
                     <p class="text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2">Active Tours</p>
                     <h3 class="text-2xl sm:text-3xl font-bold">{{ $activeTours }}</h3>
                     <p class="text-xs sm:text-sm text-gray-400 mt-1">Products</p>
                  </div>
                  <div class="p-2 sm:p-3 bg-purple-500/20 rounded-xl">
                     <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                     </svg>
                  </div>
               </div>
            </div>

            <!-- Card 3 -->
            <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-6 rounded-2xl border border-white/10 text-white hover:border-green-500/50 transition-all duration-300">
               <div class="flex justify-between items-start">
                  <div>
                     <p class="text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2">Pending Orders</p>
                     <h3 class="text-2xl sm:text-3xl font-bold">{{ $pendingOrders ?? 12 }}</h3>
                     <p class="text-xs sm:text-sm text-gray-400 mt-1">Needs Review</p>
                  </div>
                  <div class="p-2 sm:p-3 bg-green-500/20 rounded-xl">
                     <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                     </svg>
                  </div>
               </div>
            </div>

            <!-- Card 4 -->
            <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-6 rounded-2xl border border-white/10 text-white hover:border-yellow-500/50 transition-all duration-300">
               <div class="flex justify-between items-start">
                  <div>
                     <p class="text-xs sm:text-sm text-gray-300 mb-1 sm:mb-2">Admin Status</p>
                     <h3 class="text-xl sm:text-2xl font-bold">{{ auth()->user()->role }}</h3>
                     <p class="text-xs sm:text-sm text-gray-400 mt-1">{{ auth()->user()->name }}</p>
                  </div>
                  <div class="p-2 sm:p-3 bg-yellow-500/20 rounded-xl">
                     <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                     </svg>
                  </div>
               </div>
            </div>
         </div>

         <!-- ALERT SECTION -->
         <div class="mb-8 lg:mb-10">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
               <h2 class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                  <span class="text-red-500">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                     </svg>
                  </span> Masalah yang Perlu Perhatian
               </h2>
               <span class="px-3 py-1 bg-red-500/20 text-red-400 text-sm rounded-full w-fit">3 Issue</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
               <!-- Issue Card 1 -->
               <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-5 rounded-xl border border-red-500/30 text-white hover:border-red-500/50 transition-all duration-300 group cursor-pointer" onclick="window.location.href='/admin/orders?status=pending'">
                  <div class="flex items-start justify-between mb-3">
                     <div class="flex items-center gap-2 sm:gap-3">
                        <div class="p-1.5 sm:p-2 bg-red-500/20 rounded-lg">
                           <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                           </svg>
                        </div>
                        <span class="font-semibold text-sm sm:text-base">Pending Payment</span>
                     </div>
                     <span class="text-xs text-red-400">High</span>
                  </div>
                  <p class="text-xs sm:text-sm text-gray-400 mb-3">5 pesanan menunggu konfirmasi pembayaran lebih dari 24 jam</p>
                  <div class="flex justify-between items-center">
                     <span class="text-xs text-gray-500">Klik untuk review →</span>
                     <div class="p-1 bg-red-500/20 rounded group-hover:bg-red-500/30 transition-colors">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                     </div>
                  </div>
               </div>

               <!-- Issue Card 2 -->
               <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-5 rounded-xl border border-yellow-500/30 text-white hover:border-yellow-500/50 transition-all duration-300 group cursor-pointer" onclick="window.location.href='/admin/tours'">
                  <div class="flex items-start justify-between mb-3">
                     <div class="flex items-center gap-2 sm:gap-3">
                        <div class="p-1.5 sm:p-2 bg-yellow-500/20 rounded-lg">
                           <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.342 16.5c-.77.833.192 2.5 1.732 2.5z" />
                           </svg>
                        </div>
                        <span class="font-semibold text-sm sm:text-base">Low Stock Alert</span>
                     </div>
                     <span class="text-xs text-yellow-400">Medium</span>
                  </div>
                  <p class="text-xs sm:text-sm text-gray-400 mb-3">2 produk tour kuota hampir habis</p>
                  <div class="flex justify-between items-center">
                     <span class="text-xs text-gray-500">Klik untuk kelola →</span>
                     <div class="p-1 bg-yellow-500/20 rounded group-hover:bg-yellow-500/30 transition-colors">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                     </div>
                  </div>
               </div>

               <!-- Issue Card 3 -->
               <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-5 rounded-xl border border-blue-500/30 text-white hover:border-blue-500/50 transition-all duration-300 group cursor-pointer" onclick="window.location.href='/admin/support'">
                  <div class="flex items-start justify-between mb-3">
                     <div class="flex items-center gap-2 sm:gap-3">
                        <div class="p-1.5 sm:p-2 bg-blue-500/20 rounded-lg">
                           <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                           </svg>
                        </div>
                        <span class="font-semibold text-sm sm:text-base">Unread Messages</span>
                     </div>
                     <span class="text-xs text-blue-400">Low</span>
                  </div>
                  <p class="text-xs sm:text-sm text-gray-400 mb-3">8 pesan belum dibalas dari customer</p>
                  <div class="flex justify-between items-center">
                     <span class="text-xs text-gray-500">Klik untuk balas →</span>
                     <div class="p-1 bg-blue-500/20 rounded group-hover:bg-blue-500/30 transition-colors">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
            <!-- Monitoring Progress -->
            <div>
               <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
                  <h2 class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                     <span class="text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                     </span> Monitoring Progres
                  </h2>
                  <span class="text-xs sm:text-sm text-gray-400">Real-time Update</span>
               </div>

               <div class="space-y-3 sm:space-y-4">
                  <!-- Progress Item 1 -->
                  <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-5 rounded-xl border border-white/10">
                     <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-white text-sm sm:text-base">Order Completion Rate</span>
                        <span class="text-xs sm:text-sm font-bold text-green-400">78%</span>
                     </div>
                     <div class="w-full bg-gray-700/50 rounded-full h-1.5 sm:h-2 mb-2 sm:mb-3">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-400 h-1.5 sm:h-2 rounded-full" style="width: 78%"></div>
                     </div>
                     <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm text-gray-400 gap-1">
                        <span>32/41 orders completed</span>
                        <span>Target: 85%</span>
                     </div>
                  </div>

                  <!-- Progress Item 2 -->
                  <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-5 rounded-xl border border-white/10">
                     <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-white text-sm sm:text-base">User Growth (7 days)</span>
                        <span class="text-xs sm:text-sm font-bold text-blue-400">+12.5%</span>
                     </div>
                     <div class="w-full bg-gray-700/50 rounded-full h-1.5 sm:h-2 mb-2 sm:mb-3">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-400 h-1.5 sm:h-2 rounded-full" style="width: 65%"></div>
                     </div>
                     <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm text-gray-400 gap-1">
                        <span>+24 new users</span>
                        <span>Total: {{ number_format($totalUsers) }}</span>
                     </div>
                  </div>

                  <!-- Progress Item 3 -->
                  <div class="backdrop-blur-xl bg-white/5 p-4 sm:p-5 rounded-xl border border-white/10">
                     <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-white text-sm sm:text-base">Tour Booking Rate</span>
                        <span class="text-xs sm:text-sm font-bold text-purple-400">45%</span>
                     </div>
                     <div class="w-full bg-gray-700/50 rounded-full h-1.5 sm:h-2 mb-2 sm:mb-3">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-400 h-1.5 sm:h-2 rounded-full" style="width: 45%"></div>
                     </div>
                     <div class="flex flex-col sm:flex-row sm:justify-between text-xs sm:text-sm text-gray-400 gap-1">
                        <span>18/40 slots filled</span>
                        <span>Popular: Bali Tour</span>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div>
               <h3 class="text-base sm:text-lg font-bold text-white mb-3 sm:mb-4 flex items-center gap-2">
                  <x-carbon-activity class="w-5 h-5 sm:w-6 sm:h-6" />
                  Aktivitas Terbaru
               </h3>

               <div class="space-y-2 sm:space-y-3 max-h-[400px] overflow-y-auto pr-2">
                  
               </div>
            </div>
         </div>

         <!-- QUICK ACTIONS -->
         <div class="mt-6 lg:mt-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
               <h2 class="text-lg sm:text-xl font-bold text-white flex items-center gap-2">
                  <span class="text-yellow-500">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                     </svg>
                  </span> Klik Cepat ke Menu
               </h2>
               <span class="text-xs sm:text-sm text-gray-400">Shortcut Actions</span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
               <!-- Quick Action 1 -->
               <a href="/admin/orders/create" class="backdrop-blur-xl bg-white/5 p-3 sm:p-5 rounded-xl border border-white/10 text-white hover:border-green-500/50 hover:bg-white/10 transition-all duration-300 group">
                  <div class="flex flex-col items-center text-center">
                     <div class="p-2 sm:p-3 bg-green-500/20 rounded-xl mb-2 sm:mb-3 group-hover:bg-green-500/30 transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                     </div>
                     <span class="font-medium text-sm sm:text-base">Tambah Order</span>
                     <span class="text-xs text-gray-400 mt-0.5 sm:mt-1">Manual booking</span>
                  </div>
               </a>

               <!-- Quick Action 2 -->
               <a href="/admin/tours/create" class="backdrop-blur-xl bg-white/5 p-3 sm:p-5 rounded-xl border border-white/10 text-white hover:border-blue-500/50 hover:bg-white/10 transition-all duration-300 group">
                  <div class="flex flex-col items-center text-center">
                     <div class="p-2 sm:p-3 bg-blue-500/20 rounded-xl mb-2 sm:mb-3 group-hover:bg-blue-500/30 transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                     </div>
                     <span class="font-medium text-sm sm:text-base">Buat Tour</span>
                     <span class="text-xs text-gray-400 mt-0.5 sm:mt-1">Produk baru</span>
                  </div>
               </a>

               <!-- Quick Action 3 -->
               <a href="/admin/users" class="backdrop-blur-xl bg-white/5 p-3 sm:p-5 rounded-xl border border-white/10 text-white hover:border-purple-500/50 hover:bg-white/10 transition-all duration-300 group">
                  <div class="flex flex-col items-center text-center">
                     <div class="p-2 sm:p-3 bg-purple-500/20 rounded-xl mb-2 sm:mb-3 group-hover:bg-purple-500/30 transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 3.137a4 4 0 00-5.665-5.665" />
                        </svg>
                     </div>
                     <span class="font-medium text-sm sm:text-base">Kelola User</span>
                     <span class="text-xs text-gray-400 mt-0.5 sm:mt-1">Lihat semua user</span>
                  </div>
               </a>

               <!-- Quick Action 4 -->
               <a href="/admin/reports" class="backdrop-blur-xl bg-white/5 p-3 sm:p-5 rounded-xl border border-white/10 text-white hover:border-yellow-500/50 hover:bg-white/10 transition-all duration-300 group">
                  <div class="flex flex-col items-center text-center">
                     <div class="p-2 sm:p-3 bg-yellow-500/20 rounded-xl mb-2 sm:mb-3 group-hover:bg-yellow-500/30 transition-colors">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                     </div>
                     <span class="font-medium text-sm sm:text-base">Laporan</span>
                     <span class="text-xs text-gray-400 mt-0.5 sm:mt-1">Analytics & reports</span>
                  </div>
               </a>
            </div>
         </div>
      </main>
   </div>
</div>

<!-- JavaScript untuk mobile sidebar toggle -->
<script>
   // Inisialisasi toggle button di file utama
   document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.getElementById('toggleSidebar');

      if (toggleBtn) {
         toggleBtn.addEventListener('click', openSidebar);
      }
   });
</script>

@endsection