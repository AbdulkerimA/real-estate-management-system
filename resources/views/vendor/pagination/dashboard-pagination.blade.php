<div class="content-card rounded-2xl p-6">
    <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
        <div class="flex items-center space-x-4">
            <span class="text-gray-400">
                Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} properties
            </span>
            <div class="filter-dropdown">
                <form method="GET" action="{{ '/'.request()->path() }}">
                    <select name="per_page" onchange="this.form.submit()" class="bg-[#12181f] border border-gray-600 rounded-lg px-3 py-2 text-white text-sm">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 per page</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 per page</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 per page</option>
                    </select>
                </form>
            </div>
        </div>
        
        <div class="flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button class="pagination-btn px-4 py-2 rounded-lg border border-gray-600 text-gray-400 cursor-not-allowed" disabled>
                    Previous
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn px-4 py-2 rounded-lg border border-gray-600 text-gray-400 hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                    Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="pagination-btn active px-4 py-2 rounded-lg">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="pagination-btn px-4 py-2 rounded-lg text-gray-400 hover:bg-[#00ff88] hover:text-[#12181f] transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn px-4 py-2 rounded-lg border border-gray-600 text-gray-400 hover:border-[#00ff88] hover:text-[#00ff88] transition-colors">
                    Next
                </a>
            @else
                <button class="pagination-btn px-4 py-2 rounded-lg border border-gray-600 text-gray-400 cursor-not-allowed" disabled>
                    Next
                </button>
            @endif
        </div>
    </div>
</div>