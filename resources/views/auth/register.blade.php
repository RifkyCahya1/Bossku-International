@extends('main', ['excludeNavbar' => true], ['excludeFooter' => true])

@section('content')
<div class="relative flex flex-col md:flex-row min-h-screen overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('img/ExploreIndonesia.jpg') }}"
            alt="Explore Indonesia"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    <!-- Left Section -->
    <div class="relative z-10 flex flex-col justify-center items-start md:w-2/5
                text-white px-6 md:px-20 py-6 text-center md:text-left">
        <img src="{{ asset('img/Bossku.tours.png') }}"
            alt="Bossku.Tours"
            class="w-64 md:w-80 mb-4 mx-auto md:mx-0 drop-shadow-xl">
        <h1 class="text-2xl md:text-4xl font-semibold mb-3 leading-snug">
            Begin Your Journey <br class="hidden md:block"> with Elegance
        </h1>
        <p class="text-gray-300 text-sm md:text-base leading-relaxed max-w-md mx-auto md:mx-0 text-balance">
            Join <span class="text-[#bfa46f] font-medium">Bossku.Tours</span> and enjoy exclusive access to our premium tour collections, designed for those who appreciate style, comfort, and unforgettable moments.
        </p>
    </div>

    <!-- Right Section -->
    <div class="relative z-10 flex items-center justify-center md:w-3/5 px-4 py-8">
        <div class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-2xl shadow-2xl 
                    p-8 md:p-12 w-full max-w-md text-center text-white transition duration-300 hover:scale-[1.02]">

            <h1 class="text-3xl font-semibold mb-2 tracking-wide">Create Account</h1>
            <p class="text-sm text-gray-300 mb-8">Join our luxury travel family today</p>

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


            <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                @csrf

                <div class="text-left">
                    <label class="text-sm text-gray-300">Full Name</label>
                    <input type="text" name="name" required
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-gray-400/30 
                               text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <div class="text-left">
                    <label class="text-sm text-gray-300">Email Address</label>
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

                <div class="text-left">
                    <label class="text-sm text-gray-300">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full mt-1 px-4 py-3 rounded-xl bg-white/10 border border-gray-400/30 
                               text-white placeholder-gray-300 focus:ring-2 focus:ring-[#bfa46f] outline-none">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-[#bfa46f] to-[#a38c58] 
                           hover:opacity-90 transition font-semibold text-white tracking-wider shadow-lg cursor-pointer">
                    REGISTER
                </button>

                <p class="text-gray-300 text-sm mt-6">
                    Already have an account?
                    <a href="Login" class="text-[#bfa46f] hover:underline">Login here</a>
                </p>
            </form>
        </div>
    </div>

</div>
@endsection