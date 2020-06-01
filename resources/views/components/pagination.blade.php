<div class="pagination-container">
  <a
    href="{{ $baseUrl }}?page={{ $page - 1 }}&pageSize={{ $pageSize }}"
    @if($page <= 1)
      onclick="return false;"
      class="page-icon-button page-icon-button-disabled"
    @else
      class="page-icon-button"
    @endif
  >
    <span class="mdi mdi-chevron-left" style="font-size: 24px;"></span>
    Prev Page
  </a>

  Showing {{ $pageSize*($page - 1) + 1 }} - {{ min($totalCount, $pageSize*($page - 1) + $pageSize) }} of {{ $totalCount }}

  <a
    href="{{ $baseUrl }}?page={{ $page + 1 }}&pageSize={{ $pageSize }}"
    @if(min($totalCount, $pageSize*($page - 1) + $pageSize) == $totalCount)
      onclick="return false;"
      class="page-icon-button page-icon-button-disabled"
    @else
      class="page-icon-button"
    @endif
  >
    Next Page
    <span class="mdi mdi-chevron-right" style="font-size: 24px;"></span>
  </a>
</div>