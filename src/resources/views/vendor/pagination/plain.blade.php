@if ($paginator->hasPages())
    <nav class="pagination" aria-label="Pagination">
        @if ($paginator->onFirstPage())
            <span class="disabled">前へ</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a>
        @endif

        @foreach ($elements as $elements)
            @if (is_string($element))
                <span class="separator">{{ $element }}</span>
            @endif

            @if (is_array($elements))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageurl() }}" rel="next">次へ</a>
        @else
            <span class="disabled">次へ</span>
        @endif
    </nav>
@endif
