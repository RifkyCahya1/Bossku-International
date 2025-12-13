@if ($paginator->hasPages())
<nav role="navigation">
    <ul class="flex items-center space-x-2 select-none">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
        <span class="p-2 rounded-xs bg-gray-200 text-gray-400 cursor-not-allowed">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
            </svg>
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="p-2 rounded-xs bg-[#071F35] text-gold hover:bg-black transition shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
            </svg>
        </a>
        @endif

        {{-- MOBILE VIEW: only current page --}}
        <span class="md:hidden p-2 rounded-xs bg-[#071F35] text-gold font-semibold shadow">
            {{ $paginator->currentPage() }}
        </span>

        {{-- DESKTOP VIEW --}}
        <div class="hidden md:flex items-center space-x-2">

            {{-- First page --}}
            @if ($paginator->currentPage() > 3)
            <a href="{{ $paginator->url(1) }}"
                class="px-3 py-1 rounded-xs bg-white border text-gray-700 hover:bg-gray-100">1</a>
            @endif

            {{-- Ellipsis before --}}
            @if ($paginator->currentPage() > 4)
            <span class="px-3 py-1 text-gray-500">…</span>
            @endif

            {{-- Page range around current --}}
            @foreach (range(max(1, $paginator->currentPage() - 2), min($paginator->currentPage() + 2, $paginator->lastPage())) as $page)
            @if ($page == $paginator->currentPage())
            <span class="px-3 py-1 rounded-xs bg-[#071F35] text-gold font-semibold shadow">{{ $page }}</span>
            @else
            <a href="{{ $paginator->url($page) }}"
                class="px-3 py-1 rounded-xs bg-white border border-gray-300 text-gray-700 hover:bg-gray-100">
                {{ $page }}
            </a>
            @endif
            @endforeach

            {{-- Ellipsis after --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <span class="px-3 py-1 text-gray-500">…</span>
                @endif

                {{-- Last page --}}
                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                        class="px-3 py-1 rounded-xs bg-white border text-gray-700 hover:bg-gray-100">
                        {{ $paginator->lastPage() }}
                    </a>
                    @endif

        </div>

        {{-- Next --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="p-2 rounded-xs bg-[#071F35] text-gold hover:bg-black transition shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
        @else
        <span class="p-2 rounded-xs bg-gray-200 text-gray-400 cursor-not-allowed">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
            </svg>
        </span>
        @endif

    </ul>
</nav>
@endif