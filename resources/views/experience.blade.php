@extends('main')

@section('content')

<div class="relative w-full">
    <img src="https://images.unsplash.com/photo-1502786129293-79981df4e689?q=80&w=1931&auto=format&fit=crop"
        class="w-full h-96 object-cover" alt="Indonesia Experience">
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

    <div class="absolute inset-0 flex flex-col justify-center items-center px-6">
        <h1 class="text-white text-3xl md:text-5xl font-bold drop-shadow-lg tracking-wide text-center">
            Discover Premium Experiences in Indonesia
        </h1>
        <p class="text-white/80 text-center mt-3 max-w-2xl">
            Find the finest attractions — from breathtaking nature, exclusive activities, to unforgettable cultural experiences.
        </p>
    </div>
</div>


<section class="py-16 md:py-20">
    <div class="px-6 md:px-16 mb-10">
        <h2 class="text-2xl md:text-3xl font-bold text-[#071F35] tracking-wide">
            Featured Experiences
        </h2>
        <p class="text-gray-600 max-w-xl mt-2 leading-relaxed">
            Choose your dream destination and enjoy world-class experiences across Indonesia.
        </p>
    </div>

    <div class="swiper thingsSwiper px-6 md:px-16 select-none">
        <div class="swiper-wrapper">

            @foreach ($experiences as $item)
            @php
            $img = $item->summer_img ?? $item->autumn_img ?? $item->winter_img;
            @endphp

            <div class="swiper-slide !w-[280px] md:!w-[340px]">
                <div class="relative rounded-2xl overflow-hidden group shadow-xl bg-white/10 backdrop-blur-md border border-white/20 transition-all duration-500 hover:shadow-2xl">

                    <img src="{{ $img }}" class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $item->name }}">

                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 w-full p-5">

                        <h3 class="text-white text-lg font-semibold">
                            {{ trim(str_replace('WNA', '', $item->name)) }}
                        </h3>

                        <p class="text-gray-300 text-xs mt-1">
                            {{ $item->location }}
                        </p>

                        <div class="flex items-center justify-between mt-3">
                            <div class="text-white font-semibold text-sm">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>

                            <a href="/attraction/{{ $item->id }}" class="text-xs px-3 py-1.5 rounded-full border border-white text-white hover:bg-white hover:text-black transition-all duration-300">
                                View Details →
                            </a>
                        </div>

                    </div>

                </div>
            </div>

            @endforeach

        </div>

        <div class="absolute inset-y-0 left-2 md:left-10 flex items-center z-10">
            <div class="swiper-button-prev bg-[#071F35] !text-[#d6c08a] p-3 rounded-full shadow-lg"></div>
        </div>

        <div class="absolute inset-y-0 right-2 md:right-10 flex items-center z-10">
            <div class="swiper-button-next bg-[#071F35] !text-[#d6c08a] p-3 rounded-full shadow-lg"></div>
        </div>
    </div>

</section>

<section class="py-16 md:py-20 bg-gray-50 border-t">
    <div class="px-6 md:px-16 mb-10">
        <h2 class="text-2xl md:text-3xl font-bold text-[#071F35] tracking-wide">
            All Tickets & Attractions
        </h2>
        <p class="text-gray-600 max-w-xl mt-2">
            Search your favorite attractions, filter by category, or sort by price.
        </p>
    </div>

    <div class="px-6 md:px-16 mb-10">
        <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search name / location..."
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400">

            <select name="city" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400">
                <option value="">All Cities</option>

                @foreach ($cities as $city)
                <option value="{{ $city }}"
                    {{ request('city') == $city ? 'selected' : '' }}>
                    {{ $city }}
                </option>
                @endforeach
            </select>

            <select name="sort" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-400">
                <option value="">No Sort</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Lowest Price</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>Highest Price</option>
            </select>

            <button class="bg-[#071F35] text-[#d6c08a] font-semibold py-3 rounded-xl hover:bg-black transition">
                Apply Filter
            </button>

        </form>
    </div>

    <div class="px-6 md:px-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse ($allProducts as $p)
        @php
        $img = $p->summer_img ?? $p->autumn_img ?? $p->winter_img;
        @endphp

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden group">
            <img src="{{ $img }}" class="w-full h-56 object-cover group-hover:scale-110 transition" alt="">

            <div class="p-5">
                <h3 class="text-lg font-bold text-[#071F35]">
                    {{ trim(str_replace('WNA', '', $p->name)) }}
                </h3>

                <p class="text-gray-600 text-sm mt-1">
                    {{ $p->location }}
                </p>

                <div class="flex justify-between items-center mt-4">
                    <div class="font-semibold text-[#071F35]">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </div>

                    <a href="/attraction/{{ $p->id }}"
                        class="px-3 py-1.5 text-xs border border-[#071F35] text-[#071F35] rounded-full hover:bg-[#071F35] hover:text-white transition">
                        Details →
                    </a>
                </div>
            </div>
        </div>

        @empty
        <p class="col-span-4 text-center text-gray-500 py-10">
            No matching attractions found 😭
        </p>
        @endforelse

    </div>
    <div class="px-6 md:px-16 mt-10">
        {{ $allProducts->links('pagination.custom') }}
    </div>

</section>

<script src="JS/SwiperMustVisit.js"></script>

@endsection