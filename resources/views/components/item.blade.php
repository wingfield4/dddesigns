<a href="/products/{{ $item->item_page_url }}" class="item-container">
  <div class="item-thumbnail-container">
    @if(is_object($item->thumbnailImage))
      <img
          src="{{ $baseImagePath . $item->thumbnailImage->full_path }}"
        alt="{{ $item->description }}"
        height="100%"
        width="100%"
        class="item-thumbnail"
      />
    @else
      <div class="no-thumbnail">
        <span class="mdi mdi-basket"></span>
      </div>
    @endif
    <div class="tag-container">
      @if ($item->item_type_id == 1)
        <div class="item-type made-to-order">
          Made to Order!
        </div>
      @elseif ($item->item_type_id == 2)
        <div class="item-type buy-it-now">
          Buy it Now!
        </div>
      @endif
      @if (!is_null($item->price))
        <div class="item-starting-price">
          @if ($item->item_type_id == 1)
            Starting from
          @endif
          ${{ $item->price }}
        </div>
      @endif
    </div>
  </div>
  <div class="item-info-container">
    <h1>{{ $item->title }}</h1>
    <p>{{ $item->short_description }}</p>
    <button class="button outlined" href="products/{{ $item->item_page_url }}/customize">
      @if ($item->item_type_id == 1)
        BUILD AND ORDER
      @elseif ($item->item_type_id == 2)
        ORDER NOW
      @endif
    </button>
  </div>
</a>