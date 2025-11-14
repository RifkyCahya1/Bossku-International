@extends('main')

@section('content')

<div class="relative w-full">
    <img src="https://images.unsplash.com/photo-1536168097491-171100319fbf?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1931"
        alt="Gambar Aktivitas Outdoor"
        class="w-full h-96 object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-white/30 via-black/40 to-black"></div>
    <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-22 py-10">
        <h1
            class="text-white mx-auto text-lg md:text-3xl text-pretty font-bold drop-shadow-md mb-2 tracking-wider text-center">
            Explore Thrilling Experiences Across Indonesia
        </h1>
        <p class="text-white/90 text-center text-sm md:text-base max-w-xl mx-auto">
            From surfing Bali’s waves to hiking majestic volcanoes — your next adventure starts here.
        </p>
    </div>
</div>


<section class="relative py-20">
    <div class="text-left mb-10 px-6 md:px-16">
        <h2 class="text-xl md:text-2xl font-bold tracking-wide text-[#071F35]">
            Unforgettable Experiences in Indonesia
        </h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base max-w-2xl leading-relaxed">
            Feel the thrill of Indonesia — from surfing Bali’s waves to hiking volcanoes, diving in coral kingdoms, and more adventures waiting to be lived.
        </p>
    </div>

    <div class="swiper thingsSwiper w-full select-none px-4 md:px-16">
        <div class="swiper-wrapper">
            @foreach ([
            ['Surfing', 'https://images.unsplash.com/photo-1493225255756-d9584f8606e9?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070', 'Ride the Waves', 'Nikmati sensasi ombak kelas dunia di pantai-pantai Bali.'],
            ['Hiking', 'https://images.unsplash.com/photo-1551632811-561732d1e306?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170', 'Sunrise Above the Clouds', 'Rasakan keindahan matahari terbit di atas lautan pasir dan kabut Gunung Bromo.'],
            ['Snorkeling', 'https://plus.unsplash.com/premium_photo-1661265851801-e523847e3932?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1974','Underwater Paradise', 'Jelajahi dunia bawah laut penuh warna di salah satu spot menyelam terbaik dunia.'],
            ['Rafting', 'https://images.unsplash.com/photo-1642933196504-62107dac9258?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1974', 'Adrenaline Rush', 'Hadapi arus deras dan nikmati keindahan lembah sungai tropis yang memukau.'],
            ['Camping', 'https://images.unsplash.com/photo-1510312305653-8ed496efae75?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1974', 'Stars & Serenity', 'Rasakan ketenangan malam di bawah langit bertabur bintang di Ranu Kumbolo.'],
            ['Diving', 'https://images.unsplash.com/photo-1682687982167-d7fb3ed8541d?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2071', 'Swim with Mantas', 'Selam bersama ikan pari manta di perairan biru jernih Taman Nasional Komodo.'],
            ['Paragliding', 'https://images.unsplash.com/photo-1592208128295-5aaa34f1d72b?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170', 'Fly High', 'Terbang bebas di langit Batu sambil menikmati panorama gunung dan kota di bawahmu.'],
            ['Caving', 'https://plus.unsplash.com/premium_photo-1661897264411-9d1915616451?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2070', 'Into the Depths', 'Jelajahi gua-gua tersembunyi dengan stalaktit dan sungai bawah tanah yang menakjubkan.'],
            ] as $activity)
            <div class="swiper-slide !w-[260px] md:!w-[320px]">
                <div class="relative group overflow-hidden rounded-2xl shadow-xl bg-black/10 backdrop-blur-sm transition-all duration-500 hover:shadow-2xl">
                    <img src="{{ $activity[1] }}"
                        alt="{{ $activity[0] }}" loading="lazy"
                        class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-5">
                        <h3 class="text-lg font-semibold text-white mb-1">{{ $activity[0] }}</h3>
                        <p class="text-gray-200 text-xs leading-snug mb-3">{{ $activity[3] }}</p>
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
                <div class="swiper-button-prev !text-[#bfa46f] bg-[#071F35] p-2 rounded-full font-bold"></div>
            </div>
            <div class="absolute inset-y-0 right-6 md:right-10">
                <div class="swiper-button-next !text-[#bfa46f] bg-[#071F35] p-2 rounded-full"></div>
            </div>
        </div>
    </div>
</section>


<script src="JS/SwiperMustVisit.js"></script>

@endsection