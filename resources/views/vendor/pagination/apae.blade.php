@if ($paginator->hasPages())
    <nav class="w-full">
        <ul class="pagination flex justify-center gap-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled w-10 rounded-l-md bg-apae-cyan/90 text-apae-white text-center py-1" aria-disabled="true"
                    aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="w-10 rounded-l-md bg-apae-cyan/60 text-apae-white text-center py-1">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled bg-apae-cyan/60 text-apae-white text-center py-1 w-10" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active bg-apae-cyan/90 text-apae-white text-center py-1 w-10" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="bg-apae-cyan/60 text-apae-white text-center py-1 w-10"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="w-10 rounded-l-md rounded-r-md bg-apae-cyan/60 text-apae-white text-center py-1">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled w-10 rounded-r-md bg-apae-cyan/90 text-apae-white text-center py-1" aria-disabled="true"
                    aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
