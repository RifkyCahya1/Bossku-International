<section x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 5200)"
    x-show="show"
    x-transition.opacity.scale.duration.1200ms
    class="fixed inset-0 flex flex-col items-center justify-center bg-gradient-to-b from-[#081B2B] to-[#0B1C29] text-[#D6C7A1] z-[9999] overflow-hidden">

    <!-- Title -->
    <div class="text-center relative">
        <h1 class="text-4xl md:text-5xl font-semibold tracking-widest mb-3 animate-fadeUp">
            Explore Indonesia
        </h1>
        <p class="text-[#89A1B2] text-sm md:text-base tracking-[0.25em] animate-fadeIn delay-[1.4s]">
            Cultural journeys, crafted with elegance
        </p>
    </div>

    <!-- Load Font Awesome (move this <link> to your layout <head> for production) -->

    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <i class="absolute fa-solid fa-plane text-[2.5rem] text-[#D6C7A1]/90 animate-bird1" aria-hidden="true"></i>
        <i class="absolute fa-solid fa-plane text-[1.5rem] text-[#D6C7A1]/90 animate-bird2" aria-hidden="true"></i>
        <i class="absolute fa-solid fa-plane text-[0.75rem] text-[#D6C7A1]/90 animate-bird3" aria-hidden="true"></i>
    </div>

    <div class="absolute bottom-[40%] w-64 h-[1px] bg-gradient-to-r from-transparent via-[#D6C7A1]/60 to-transparent opacity-0 animate-fadeLine delay-[2.5s]"></div>

    <style>
        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeLine {
            0% {
                opacity: 0;
                transform: scaleX(0);
            }

            100% {
                opacity: 1;
                transform: scaleX(1);
            }
        }

        @keyframes fly {
            0% {
                transform: translateX(-10%) translateY(0) scale(0.8) rotate(2deg);
                opacity: 0;
            }

            15% {
                opacity: 1;
            }

            50% {
                transform: translateX(50vw) translateY(-10vh) scale(1) rotate(0deg);
                opacity: 0.9;
            }

            100% {
                transform: translateX(110vw) translateY(-20vh) scale(1.1) rotate(-2deg);
                opacity: 0;
            }
        }

        .animate-fadeUp {
            animation: fadeUp 1.4s ease forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 2.2s ease forwards;
        }

        .animate-fadeLine {
            animation: fadeLine 1.6s ease forwards;
        }

        .animate-bird1 {
            animation: fly 7s cubic-bezier(0.55, 0.25, 0.35, 1) infinite;
            top: 55%;
            left: -15%;
        }

        .animate-bird2 {
            animation: fly 8s cubic-bezier(0.55, 0.25, 0.35, 1) infinite;
            top: 45%;
            left: -25%;
            animation-delay: 1.3s;
        }

        .animate-bird3 {
            animation: fly 9s cubic-bezier(0.55, 0.25, 0.35, 1) infinite;
            top: 60%;
            left: -20%;
            animation-delay: 2.1s;
        }
    </style>
</section>