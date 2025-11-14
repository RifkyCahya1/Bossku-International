@extends('main')

@section('content')
<section class="relative">
    <img src="{{ asset($data['image']) }}" loading="lazy"
        alt="{{ $data['name_en'] }}"
        class="w-full h-screen object-cover brightness-75">

    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white">
        <h1 class="text-5xl md:text-6xl font-semibold mb-4 tracking-tight drop-shadow-2xl uppercase">
            {{ $data['name_en'] }}
        </h1>
        <p class="text-lg md:text-xl font-light max-w-2xl leading-relaxed opacity-90">
            {{ $data['name_local'] ?? '' }}
        </p>

        <div class="flex flex-col items-center gap-2 mt-10 animate-bounce">
            <span class="text-sm font-light tracking-widest opacity-80">Scroll Down</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6 animate-pulse">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
</section>

<div class="container mx-auto px-6 md:px-16 mt-16">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 grid-rows-2 gap-3 h-auto md:h-[600px] overflow-hidden">
            @foreach($data['gallery'] ?? [] as $index => $image)
                @if($index == 0)
                <div class="col-span-2 sm:col-span-2 md:col-span-2">
                    <img src="{{ asset($image) }}" class="object-cover w-full h-44 sm:h-56 md:h-full transition-transform duration-500 rounded-xs">
                </div>

                @elseif($index == 1)
                <div class="col-span-2 sm:col-span-1 md:col-span-2">
                    <img src="{{ asset($image) }}" class="object-cover w-full h-44 sm:h-56 md:h-full transition-transform duration-500 rounded-xs">
                </div>

                @elseif($index == 2)
                <div class="col-span-1 sm:col-span-1 md:col-span-1">
                    <img src="{{ asset($image) }}" class="object-cover w-full h-36 sm:h-44 md:h-full transition-transform duration-500 rounded-xs">
                </div>
                
                @elseif($index == 3)
                <div class="col-span-1 sm:col-span-2 md:col-span-3">
                    <img src="{{ asset($image) }}" class="object-cover w-full h-36 sm:h-44 md:h-full transition-transform duration-500 rounded-xs">
                </div>
                @endif
            @endforeach
        </div>

        <div class="order-first md:order-last space-y-5">
            <div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#02335B] tracking-tight leading-tight">
                    {{ $data['name_local'] }}
                </h2>
                <p class="text-gray-700 leading-relaxed text-pretty text-justify text-sm sm:text-base">
                    {{ $data['description_web'] }}
                </p>
            </div>

            @isset($data['best_time_to_visit'])
            <div class="bg-gradient-to-br from-white/90 to-[#f9fafb]/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-[#02335B] rounded-full"></div>
                    <h3 class="text-lg font-semibold text-[#02335B]">Best Time To Visit </h3>
                </div>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                    {{ $data['best_time_to_visit'] }}
                </p>
            </div>
            @endisset

            @isset($data['climate'])
            <div class="bg-gradient-to-br from-white/90 to-[#f9fafb]/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-[#02335B] rounded-full"></div>
                    <h3 class="text-lg font-semibold text-[#02335B]">Climate</h3>
                </div>
                <p class="text-gray-600 text-sm sm:text-base  leading-relaxed">
                    {{ $data['climate'] }}
                </p>
            </div>
            @endisset
        </div>
    </div>
</div>

<div class="container mx-auto px-6 md:px-16 py-16">
    @if(!empty($data['highlights']))
    <div class="mb-12">
        <h3 class="text-2xl font-semibold text-[#02335B] text-center mb-6">Highlights</h3>
        <ul class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($data['highlights'] as $item)
            <li class="bg-gradient-to-br from-[#02335B] to-[#04507E] text-white rounded-2xl p-6 text-center hover:scale-105 transition-transform duration-500 shadow-lg">
                <span class="font-medium">{{ $item }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="container mx-auto px-6 md:px-16">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        @if(!empty($data['Do']))
        <div class="bg-gradient-to-br from-white via-[#fdfdfd] to-[#f9fafb] border border-gray-100 rounded-2xl shadow-sm p-4 md:p-8 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-1.5 h-6 bg-[#02335B] rounded-full"></div>
                <h3 class="text-2xl font-semibold text-[#02335B] tracking-tight">Travel Etiquette in {{ $data['name_en'] }}</h3>
            </div>
            <ul class="space-y-2 text-gray-700 leading-relaxed">
                @foreach($data['Do'] as $Doit)
                <li class="flex items-start gap-3">
                    <span class="text-[#02335B] text-sm sm:text-base leading-relaxed text-pretty">•</span>
                    <span>{{ $Doit }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($data['Dont']))
        <div class="bg-gradient-to-br from-white via-[#fdfdfd] to-[#f9fafb] border border-gray-100 rounded-2xl shadow-sm p-4 md:p-8 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-1.5 h-6 bg-[#c53030] rounded-full"></div>
                <h3 class="text-2xl font-semibold text-[#02335B] tracking-tight">Things to Avoid in {{ $data['name_en'] }}</h3>
            </div>
            <ul class="space-y-2 text-gray-700 leading-relaxed">
                @foreach($data['Dont'] as $Dontit)
                <li class="flex items-start gap-3">
                    <span class="text-[#c53030] text-sm sm:text-base leading-relaxed text-pretty">•</span>
                    <span>{{ $Dontit }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($data['travel_tips']))
        <div class="bg-gradient-to-br from-white via-[#fdfdfd] to-[#f9fafb] border border-gray-100 rounded-2xl shadow-sm p-4 md:p-8 hover:shadow-lg transition-all duration-300">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-1.5 h-6 bg-[#FFCA10] rounded-full"></div>
                <h3 class="text-2xl font-semibold text-[#02335B] tracking-tight">Travel Tips</h3>
            </div>
            <ul class="space-y-2 text-gray-700 leading-relaxed">
                @foreach($data['travel_tips'] as $tip)
                <li class="flex items-start gap-3">
                    <span class="text-[#FFCA10] text-sm sm:text-base leading-relaxed text-pretty">•</span>
                    <span>{{ $tip }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        @if(!empty($data['popular_foods']))
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-4 md:p-8 hover:shadow-md transition-all duration-300">
             <div class="flex items-center gap-3 mb-5">
                <div class="w-1.5 h-6 bg-[#16724F] rounded-full"></div>
                <h3 class="text-2xl font-semibold text-[#02335B] tracking-tight">Popular Foods</h3>
            </div>
            <ul class="space-y-2 text-gray-700">
                @foreach($data['popular_foods'] as $food)
                <li class="flex items-start gap-3">
                    <span class="text-[#16724F] text-sm sm:text-base leading-relaxed text-pretty">•</span>
                    <span>{{ $food }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($data['top_activities']))
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-4 md:p-8 hover:shadow-md transition-all duration-300">
             <div class="flex items-center gap-3 mb-5">
                <div class="w-1.5 h-6 bg-[#A52F76] rounded-full"></div>
                <h3 class="text-2xl font-semibold text-[#02335B] tracking-tight">Top Activities</h3>
            </div>
            <ul class="space-y-2 text-gray-700">
                @foreach($data['top_activities'] as $activity)
                <li class="flex items-start gap-3">
                    <span class="text-[#A52F76] text-sm sm:text-base leading-relaxed text-pretty">•</span>
                    <span>{{ $activity }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>


<div class="px-6 md:px-16 py-16">
    <div class="container mx-auto px-6 md:px-16 text-center">
        <p class="text-[#02335B] font-semibold tracking-widest">EXPLORE INDONESIA</p>
        <h2 class="text-3xl md:text-5xl font-semibold text-gray-900 mb-8 leading-tight">
            Discover the Wonders of Indonesia’s Regions
        </h2>
 
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
            @php
            $islands = [
            ['img' => 'img/Pulau/sumatra.jpg', 'name' => 'Sumatra'],
            ['img' => 'img/Pulau/java.jpg', 'name' => 'Java'],
            ['img' => 'img/Pulau/kalimantan.jpg', 'name' => 'Kalimantan'],
            ['img' => 'img/Pulau/sulawesi.jpg', 'name' => 'Sulawesi'],
            ['img' => 'img/Pulau/papua.jpg', 'name' => 'Maluku & Papua'],
            ['img' => 'img/Pulau/ntt.jpg', 'name' => 'Bali & Nusa Tenggara'],
            ];
            @endphp

            @foreach($islands as $island)
            <div class="relative group rounded-sm overflow-hidden shadow-sm">
                <img src="{{ asset($island['img']) }}" alt="{{ $island['name'] }}" loading="lazy"
                    class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
                <h3 class="absolute bottom-5 left-6 text-white text-2xl font-semibold tracking-wide drop-shadow-md">
                    {{ $island['name'] }}
                </h3>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection