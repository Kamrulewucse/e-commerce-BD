
@if ($paginator->hasPages())
    <ul class="pagination">
    @if ($paginator->onFirstPage())
    <li><a href="#" disabled class="prev page-number"><i class="fa fa-angle-double-left"></i></a>
    @else
      <li><a href="{{ $paginator->previousPageUrl() }}" class="page-number"><i class="fa fa-angle-double-left"></i></a></li>
    @endif

   @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><a class="page-number">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="{{ $url }}" class="current page-number">{{ $page }}</a></li>
                    @else
                        <li><a class="page-number" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

    @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" class="next page-number">
                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>
    @else

    @endif

</ul>
@endif
