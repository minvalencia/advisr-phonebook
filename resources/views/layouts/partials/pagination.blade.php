@if ($paginator->hasPages())
  <div class="pagination d-block float-right">
    <div class="pages d-flex align-items-center justify-content-end">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <div class="page-item previous">
          <a class="page-link"><i class="mdi mdi-arrow-left"></i></a>
        </div>
      @else
        <div class="page-item previous">
          <a class="page-link" data-page="{{ urldecode($paginator->previousPageUrl()) }}" href="{{ urldecode($paginator->previousPageUrl()) }}">
            <i class="mdi mdi-arrow-left"></i>
          </a>
        </div>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <div class="page-item disabled" aria-disabled="true">
            <a class="page-link">{{ $element }}</a>
          </div>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <div class="page-item active">
                <a class="page-link">{{ $page }}</a>
              </div>
            @else
              <div class="page-item">
                <a class="page-link" href="{{ urldecode($url) }}">{{ $page }}</a>
              </div>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <div class="page-item" class="page-item next">
          <a class="page-link" href="{{ urldecode($paginator->nextPageUrl()) }}" data-page="{{ urldecode($paginator->nextPageUrl()) }}">
            <i class="mdi mdi-arrow-right"></i>
          </a>
        </div>
      @else
        <div class="page-item next">
          <a class="page-link"><i class="mdi mdi-arrow-right"></i></a>
        </div>
      @endif

    </div>
    @php
      $offset = $paginator->perPage() * ($paginator->currentPage() - 1);
      $showFrom = $offset + 1;
      $showTo = $showFrom + $paginator->perPage() - 1 < $paginator->total() ? $showFrom + $paginator->perPage() - 1 : $paginator->total();
    @endphp
    <div class="page-records pt-2 me-3" style="height: 20px;">
      <sub class="text-muted d-block w-100 h-100">
        Page {{ number_format($paginator->currentPage()) }} of {{ number_format($paginator->lastPage()) }}
        <span class="text-dark">|</span>
        Showing {{ number_format($showFrom) }} to {{ number_format($showTo) }} of {{ number_format($paginator->total()) }} records
      </sub>
    </div>
  </div>
  @endif

