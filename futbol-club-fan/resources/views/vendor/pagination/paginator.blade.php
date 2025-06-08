@if ($paginator->hasPages())

    <section class="section-pagination">
        <div class="pagination-container">

            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <button class="pagination-button" disabled>
                    <svg fill="none" width="24" height="24" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 4L6 8L10 12" stroke="currentColor" stroke-width="2" />
                    </svg>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">
                    <button class="pagination-button">
                        <svg fill="none" width="24" height="24" viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 4L6 8L10 12" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </button>
                </a>
            @endif

            {{-- Elementos de página --}}
            @foreach ($elements as $element)
                {{-- Three Dots Separator --}}
                @if (is_string($element))
                    <button class="pagination-button " disabled>...</button>
                @endif

                {{-- Links de páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button id="{{ $page }}" class="pagination-button current-page" disabled>
                                {{ $page }}
                            </button>
                        @else
                            <a href="{{ $url }}">
                                <button id="{{ $page }}" class="pagination-button">
                                    {{ $page }}
                                </button>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">
                    <button class="pagination-button">
                        <svg fill="none" width="24" height="24" viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 4L10 8L6 12" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </button>
                </a>
            @else
                <button class="pagination-button" disabled>
                    <svg fill="none" width="24" height="24" viewBox="0 0 16 16"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="currentColor" stroke-width="2" />
                    </svg>
                </button>
            @endif

        </div>
    </section>

@endif
