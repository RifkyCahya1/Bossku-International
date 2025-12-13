@extends('main', ['excludeNavbar' => true, 'excludeFooter' => true])

@section('content')

<div class="min-h-screen bg-[#0E0E10] relative overflow-hidden">

   <div class="absolute inset-0 pointer-events-none">
      <div class="absolute w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[140px] -top-20 -left-20"></div>
      <div class="absolute w-[600px] h-[600px] bg-blue-500/20 rounded-full blur-[160px] bottom-0 right-0"></div>
   </div>

   @include('admin.Layout.topbar')

   <div class="flex max-w-7xl mx-auto mt-10 px-6 gap-8">

      @include('admin.Layout.sidebar')

      <main class="flex-1">
         <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="backdrop-blur-xl bg-white/5 p-6 rounded-2xl border border-white/10 text-white">
               <p class="text-sm text-gray-300 mb-2">Total Users</p>
               <h3 class="text-3xl font-bold">{{ number_format($totalUsers) }} Account</h3>
            </div>

            <div class="backdrop-blur-xl bg-white/5 p-6 rounded-2xl border border-white/10 text-white">
               <p class="text-sm text-gray-300 mb-2">Active Tours</p>
               <h3 class="text-3xl font-bold">{{ $activeTours }} Products</h3>
            </div>

            <div class="backdrop-blur-xl bg-white/5 p-6 rounded-2xl border border-white/10 text-white">
               <p class="text-sm text-gray-300 mb-2">Admin Status</p>
               <h3 class="text-3xl font-bold">{{ auth()->user()->role }}</h3>
            </div>
         </div>
      </main>
   </div>
</div>

@endsection