@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a></li>
        @endif

        @php
            $start = $paginator->currentPage() - 1;
            $end = $paginator->currentPage() + 1;

            if ($start < 1) {
                $start = 1;
                $end = min(3, $paginator->lastPage());
            } elseif ($end > $paginator->lastPage()) {
                $end = $paginator->lastPage();
                $start = max(1, $end - 2);
            }
        @endphp

        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item{{ $paginator->currentPage() == $i ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a></li>
        @endif
    </ul>
@endif
