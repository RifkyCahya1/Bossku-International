@extends('main')

@section('content')

<div class="relative w-full">
    <img src="img/ExploreIndonesia.jpg" alt="Gambar Hotel" class="w-full h-96 object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-white/30 via-black/40 to-black"></div>
    <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-22 py-10">
        <h1
            class="text-white mx-auto text-lg md:text-3xl text-pretty font-bold drop-shadow-md mb-2 tracking-wider text-center">
            Discover the Timeless Wonders of Indonesia
        </h1>
    </div>
</div>

<!-- Things To Do in Indonesia -->
<section class="relative py-20">
    <div class="text-left mb-10 px-6 md:px-16">
        <h2 class="text-xl md:text-2xl font-bold tracking-wide text-[#071F35]">
            Indonesia's must-visit cities
        </h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base max-w-2xl leading-relaxed">
            From vibrant urban hubs to serene cultural gems, explore the top cities that define Indonesia's rich heritage
            and dynamic lifestyle.
        </p>
    </div>

    <!-- Swiper -->
    <div class="swiper thingsSwiper w-full select-none px-4 md:px-16">
        <div class="swiper-wrapper">
            @foreach ([
            ['Jakarta', 'https://images.unsplash.com/photo-1555899434-94d1368aa7af?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070','city', 'Pusat Modernitas', 'Ibukota yang dinamis: kuliner jalanan, pusat perbelanjaan, dan kehidupan malam yang semarak.'],
            ['Yogyakarta', 'https://images.unsplash.com/photo-1578469550956-0e16b69c6a3d?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2006','temple', 'Jantung Budaya', 'Kota bersejarah dengan keraton, seni tradisional, dan akses mudah ke candi-candi ikonik.'],
            ['Bandung', 'https://images.unsplash.com/photo-1611638281871-1063d3e76e1f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2033','cafe', 'Kota Kembang & Kreatif', 'Dikenal dengan suasana sejuk, factory outlet, kafe kreatif, dan panorama pegunungan.'],
            ['Surabaya', 'https://images.unsplash.com/photo-1688525141547-2e4c04a218d7?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070','harbor', 'Sejarah & Industri', 'Gerbang ke Jawa Timur dengan warisan sejarah, kuliner khas, dan pesona pelabuhan.'],
            ['Bali', 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170','beach', 'Pulau Dewata', 'Surga tropis dengan pantai eksotis dan budaya yang memikat.'],
            ['Medan', 'https://images.unsplash.com/photo-1638022351671-119a75b2f6f3?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1935','heritage', 'Kota Kuliner', 'Surga kuliner dengan ragam cita rasa dan budaya yang kuat.'],
            ['Makassar', 'https://images.unsplash.com/photo-1715601492348-9668e6d9ca31?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1974','sea', 'Gerbang Timur', 'Kota pesisir dengan sejarah maritim dan panorama laut yang menawan.'],
            ['Semarang', 'https://images.unsplash.com/photo-1652100591395-6d512bfaf5bb?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1974','landmark', 'Kota Atlas', 'Perpaduan budaya Jawa, Tionghoa, dan Eropa dengan landmark ikonik.'],
            ['Palembang', 'https://images.unsplash.com/photo-1598675551183-1b091d43f99f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2192','river', 'Kota Sungai Musi', 'Kota yang terkenal dengan Jembatan Ampera dan kuliner pempek.'],
            ['Banjarmasin', 'https://i.pinimg.com/1200x/df/6e/8e/df6e8e03f7080747f6b35b56ad4cede0.jpg','river', 'Kota Seribu Sungai', 'Dikenal dengan pasar terapung dan budaya sungai yang kaya.'],
            ] as $city)
            <div class="swiper-slide !w-[260px] md:!w-[320px]">
                <div class="relative group overflow-hidden rounded-2xl shadow-xl bg-black/10 backdrop-blur-sm transition-all duration-500 hover:shadow-2xl">
                    <img src="{{ $city[1] }}"
                        alt="{{ $city[0] }}" loading="lazy"
                        class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-5">
                        <h3 class="text-lg font-semibold text-white mb-1">{{ $city[0] }} — {{ $city[2] }}</h3>
                        <p class="text-gray-200 text-xs leading-snug mb-3">{{ $city[3] }}</p>
                        <button class="border border-white text-white text-xs px-3 py-1 rounded-full hover:bg-white hover:text-black transition-all">
                            Learn more →
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation -->
        <div class="flex justify-center items-center">
            <div class="absolute inset-y-0 left-6 md:left-10">
                <div class="swiper-button-prev !text-[#bfa46f] bg-[#071F35] p-2 rounded-full"></div>
            </div>
            <div class="absolute inset-y-0 right-6 md:right-10">
                <div class="swiper-button-next !text-[#bfa46f] bg-[#071F35] p-2 rounded-full"></div>
            </div>
        </div>
    </div>
    </div>
</section>

<script src="JS/SwiperMustVisit.js"></script>

@endsection