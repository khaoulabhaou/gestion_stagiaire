@if ($paginator->hasPages())

<style>
        /* Custom pagination colors */
    .pagination-custom {
    color: #495057; /* Default text color */
    border-color: #dee2e6; /* Border color */
    }
    
    .pagination-custom:hover {
    color: #198754; /* Hover text color */
    background-color: #f8f9fa; /* Hover background */
    border-color: #dee2e6; /* Hover border */
    }
    
    .active-page {
    background-color: #198754 !important; /* Active page background */
    border-color: #198754 !important; /* Active page border */
    color: white !important; /* Active page text */
    }
    
    .page-item.active .page-link {
    background-color: #198754;
    border-color: #198754;
    }
</style>

    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link pagination-custom">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link pagination-custom" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link pagination-custom">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link pagination-custom active-page">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link pagination-custom" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link pagination-custom" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link pagination-custom">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif