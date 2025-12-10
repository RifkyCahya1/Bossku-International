<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error 404 - Page Not Found</title>

    {{-- CSS --}}
    @if (env('APP_ENV') === 'production')
    <link rel="stylesheet" href="{{ asset('build/assets/app-Ceak9gP4.css') }}">
    @else
    @vite('resources/css/app.css')
    @endif

    <!-- Lottie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>

    <style>
        .floaty {
            animation: floaty 6s ease-in-out infinite;
        }

        @keyframes floaty {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-18px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .glow-border {
            position: relative;
        }

        .glow-border::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 24px;
            padding: 2px;
            background: linear-gradient(135deg, #E5D3A5, #ffffff20, #E5D3A5);
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#0B0B0D] to-[#1A1A1C] text-white min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- BACKGROUND EFFECT -->
    <div class="absolute w-[500px] h-[500px] bg-pink-500/10 rounded-full blur-3xl top-[-100px] left-[-80px] floaty"></div>
    <div class="absolute w-[600px] h-[600px] bg-indigo-500/10 rounded-full blur-3xl bottom-[-120px] right-[-80px] floaty"></div>

    <!-- CARD -->
    <div class="glow-border backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl shadow-[0_0_80px_rgba(255,255,255,0.06)] p-10 max-w-xl w-full relative z-10 text-center">

        <!-- Lottie anim -->
        <div class="mx-auto w-48 h-48 mb-6" id="lottie-error"></div>

        <!-- Title -->
        <h1 class="text-7xl font-extrabold tracking-tight text-[#E5D3A5] mb-3">
            404
        </h1>

        <p class="text-xl text-gray-200 mb-4">
            Halaman seng koen goleki ra ketemu, rek.
        </p>

        <p class="text-gray-400 text-sm mb-10 leading-relaxed">
            Mungkin URL salah, dipindah, utowo emang di-delete admin e pas laper.
        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <a href="/"
                class="px-6 py-3 rounded-xl bg-[#E5D3A5] text-black font-semibold hover:bg-[#d2bd8d] transition active:scale-95">
                Home
            </a>

            <button onclick="location.reload()"
                class="px-6 py-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition active:scale-95">
                Refresh
            </button>

            <a href="https://wa.me/62XXXXXXX"
                class="px-6 py-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition active:scale-95">
                WA Admin
            </a>
        </div>
    </div>

    <!-- Lottie Loader -->
    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-error'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://lottie.host/f9a30c3f-3edb-4f92-83d8-1f5c41e50e9d/2nSLTtbyoF.json'
        });
    </script>

    {{-- JS --}}
    @if (env('APP_ENV') === 'production')
    <script src="{{ asset('build/assets/app-C4jk1yJQ.js') }}" defer></script>
    @else
    @vite('resources/js/app.js')
    @endif

</body>

</html>