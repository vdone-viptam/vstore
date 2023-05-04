@if ($paginator->hasPages())
    <ul class="pagination pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>«</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>
        @endif
        @if($paginator->currentPage() > 3)
            <li class="hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li style="border: none !important;cursor: default"><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($paginator->lastPage() < 5)
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @else
                @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endif

        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li style="border: none !important;cursor: default"><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a
                    href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif
        @if ($paginator->hasMorePages())
            <li class="disabled"><span>»</span>
            </li>
        @else
            <li class="disabled" @if($paginator->currentPage() == $paginator->lastPage() - 1) style="cursor: default" @endif><span>»</span>
            </li>
        @endif
    </ul>
@endif
