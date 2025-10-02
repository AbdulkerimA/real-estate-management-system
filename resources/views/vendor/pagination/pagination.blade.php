@if ($paginator->hasPages())
    <div class="flex justify-center items-center space-x-2 mt-8">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="px-4 py-2 bg-[#1c252e] rounded-lg opacity-50 cursor-not-allowed">
                Previous
            </button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-4 py-2 bg-[#1c252e] rounded-lg hover:bg-gray-600 transition-colors">
                Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="px-4 py-2 bg-[#00ff88] text-[#12181f] rounded-lg font-semibold">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}" 
                   class="px-4 py-2 bg-[#1c252e] rounded-lg hover:bg-gray-600 transition-colors">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-4 py-2 bg-[#1c252e] rounded-lg hover:bg-gray-600 transition-colors">
                Next
            </a>
        @else
            <button class="px-4 py-2 bg-[#1c252e] rounded-lg opacity-50 cursor-not-allowed">
                Next
            </button>
        @endif
    </div>
@endif
