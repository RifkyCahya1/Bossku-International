@extends('main')
@section('content')

<div class="relative w-full">
    <img src="img/ExploreIndonesia.jpg" alt="Gambar Hotel" class="w-full h-screen object-cover">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-22 py-10">
        <h1 class="text-white mx-auto text-3xl md:text-8xl text-pretty font-bold drop-shadow-md mb-2 tracking-wider text-center uppercase">
            EXPLORE INDONESIA
        </h1>
    </div>
</div>

<div class="container relative z-10 px-6 md:px-16 mx-auto mt-12">
    <section class="text-center">
        <p class="text-[#8A8A8A] text-xs md:text-base font-medium tracking-[0.25em] uppercase">
            Interactive Map
        </p>

        <h2 class="text-[#0B0B0B] text-3xl md:text-5xl font-semibold leading-snug tracking-tight mb-2">
            Explore Indonesia’s Beauty
        </h2>

        <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto font-normal leading-relaxed">
            Discover the timeless charm of Indonesia through our interactive map
            from tropical beaches to misty highlands, each island awaits your exploration.
        </p>
    </section>

    <div id="map" style="height: 600px; width: 100%;"></div>

    <div id="modalOverlay"
        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm justify-center items-center z-[9999] transition-opacity duration-300 opacity-0">

        <div id="modalContent"
            class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 p-6 relative transform scale-95 transition-all duration-300 ease-out">

            <button onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-2xl font-bold transition-transform hover:scale-110">
                &times;
            </button>

            <img id="modalImage" src="" alt="Province Image" class="w-full h-64 object-cover rounded-xl mb-4">

            <h2 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-2"></h2>
            <p id="modalDescription" class="text-gray-600 leading-relaxed"></p>
        </div>
    </div>
</div>

<div x-data="islandSection()" class="container mx-auto px-6 md:px-16 py-16">
    <div class="text-center mb-12">
        <h2 class="text-[#0B0B0B] text-3xl md:text-5xl font-semibold leading-snug tracking-tight mb-2">
            Explore Indonesia’s Beauty
        </h2>
        <p class="text-gray-500 text-sm md:text-base font-medium  max-w-2xl mx-auto">
            Explore our other enchanting islands and unveil the timeless beauty of Indonesia.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        <template x-for="card in cards" :key="card.name">
            <div class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-all duration-500">
                <img :src="card.image" :alt="card.name"
                    loading="lazy"
                    class="w-full h-64 md:h-72 object-cover transform group-hover:scale-105 transition duration-500 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-5 left-5 text-white">
                    <h3 class="text-xl md:text-2xl font-semibold" x-text="card.name"></h3>
                    <p class="text-xs md:text-sm text-gray-200" x-text="card.desc"></p>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('islandSection', () => ({
            cards: [{
                    name: 'Bali',
                    desc: 'Island of the Gods',
                    image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80'
                },
                {
                    name: 'Lombok',
                    desc: 'Tranquil tropical escape',
                    image: 'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=800&q=80'
                },
                {
                    name: 'Java',
                    desc: 'Cultural heart of Indonesia',
                    image: 'https://images.unsplash.com/photo-1588335076481-8f3de2408a26?w=800&q=80'
                },
                {
                    name: 'Sumatra',
                    desc: 'Untamed wilderness & beauty',
                    image: 'https://images.unsplash.com/photo-1581167761644-7e97c0e8e0f0?w=800&q=80'
                },
                {
                    name: 'Sulawesi',
                    desc: 'Diving paradise & unique culture',
                    image: 'https://images.unsplash.com/photo-1605518865563-0f8d8d58b1f1?w=800&q=80'
                },
                {
                    name: 'Papua',
                    desc: 'Frontier of natural wonders',
                    image: 'https://images.unsplash.com/photo-1605792657660-596af9009e82?w=800&q=80'
                },
            ]
        }))
    })
</script>


<script src="JS/map.js"></script>
@endsection