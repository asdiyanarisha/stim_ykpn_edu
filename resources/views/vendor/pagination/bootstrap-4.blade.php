@if ($paginator->hasPages())
<nav class="stim-pagination-nav" aria-label="Navigasi Halaman">
    <ul class="stim-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="stim-page-item disabled">
                <span class="stim-page-link stim-page-arrow" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </span>
            </li>
        @else
            <li class="stim-page-item">
                <a class="stim-page-link stim-page-arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="stim-page-item disabled stim-page-dots">
                    <span class="stim-page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="stim-page-item active" aria-current="page">
                            <span class="stim-page-link stim-page-number">{{ $page }}</span>
                        </li>
                    @else
                        <li class="stim-page-item">
                            <a class="stim-page-link stim-page-number" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="stim-page-item">
                <a class="stim-page-link stim-page-arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Selanjutnya">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </li>
        @else
            <li class="stim-page-item disabled">
                <span class="stim-page-link stim-page-arrow" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </li>
        @endif
    </ul>

    {{-- Page info --}}
    <p class="stim-pagination-info">
        Menampilkan <strong>{{ $paginator->firstItem() }}</strong>–<strong>{{ $paginator->lastItem() }}</strong>
        dari <strong>{{ $paginator->total() }}</strong> dosen
    </p>
</nav>
@endif
