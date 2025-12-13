@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="flex items-center space-x-1">

            {{-- Previous Page --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 rounded-sm bg-white/10 text-gray-500 cursor-not-allowed">&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-2 rounded-sm bg-white/10 text-white hover:bg-white/20">&laquo;</a>
            @endif

            {{-- Pagination Numbers --}}
            @foreach ($elements as $element)
                {{-- Ellipsis --}}
                @if (is_string($element))
                    <span class="px-3 py-2 rounded-sm bg-white/5 text-gray-400">…</span>
                @endif

                {{-- Page Number --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 rounded-sm bg-purple-600 text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-2 rounded-sm bg-white/10 text-white hover:bg-white/20">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-2 rounded-sm bg-white/10 text-white hover:bg-white/20">&raquo;</a>
            @else
                <span class="px-3 py-2 rounded-sm bg-white/10 text-gray-500 cursor-not-allowed">&raquo;</span>
            @endif

        </ul>
    </nav>
@endif
