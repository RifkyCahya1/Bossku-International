@extends('main', ['excludeNavbar' => true], ['excludeFooter' => true])

@section('content')
<div class="relative flex flex-col md:flex-row min-h-screen overflow-hidden">

    <div class="absolute inset-0">
        <img src="{{ asset('img/ExploreIndonesia.jpg') }}"
            alt="Explore Indonesia"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <div class="relative z-10 flex flex-col justify-center items-start md:w-2/5 text-white px-4 md:px-20 py-4 text-center md:text-left">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-300 text-sm md:text-base leading-relaxed mb-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
            <span>Back</span>
        </a>
        <img src="{{ asset('img/Bossku.tours.png') }}" alt="Bossku.Tours" class="w-64 md:w-5xl mb-2 mx-auto md:mx-0">

        <h1 class="text-xl md:text-4xl font-semibold mb-2 leading-snug">
            Explore Indonesia <br class="hidden md:block"> in Luxury & Comfort
        </h1>
        <p class="text-gray-300 text-sm md:text-base leading-relaxed max-w-md mx-auto md:mx-0 text-balance">
            Enjoy an unforgettable travel experience with
            <span class="text-[#bfa46f] font-medium">Bossku.Tours</span>
            a premium journey designed exclusively for those who seek true comfort, beauty, and luxury.
        </p>
    </div>

    <div class="relative z-10 flex items-center justify-center md:w-3/5 px-4 py-4">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl 
                    p-8 md:p-12 w-full max-w-md text-center text-white">
            <h1 class="text-3xl font-semibold mb-2 tracking-wide">Welcome Back</h1>
            <p class="text-sm text-gray-300 mb-8">Sign in to access your journey</p>

            @if ($errors->any())
            <div class="bg-red-500/20 border border-red-400/40 text-red-200 px-4 py-3 rounded-xl text-sm mb-6 text-left">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('status'))
            <div class="bg-green-500/20 border border-green-400/40 text-green-200 px-4 py-3 rounded-xl text-sm mb-6">
                ✅ {{ session('status') }}
            </div>
            @endif


            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                <div class="text-left">
                    <label class="text-sm text-gray-300">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-gray-400/30 
                               text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <div class="text-left">
                    <label class="text-sm text-gray-300">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-gray-400/30 
                               text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-[#bfa46f] to-[#a38c58] 
                           hover:opacity-90 transition font-semibold text-white tracking-wider cursor-pointer">
                    LOGIN
                </button>

                <p class="text-gray-300 text-sm mt-6">
                    Don’t have an account?
                    <a href="Register" class="text-[#bfa46f] hover:underline">Register here</a>
                </p>
            </form>
        </div>
    </div>

</div>
@endsection