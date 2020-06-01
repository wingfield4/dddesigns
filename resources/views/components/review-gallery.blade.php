<div class="review-gallery-container">
  @foreach($images as $image)
    <div
      class="review-gallery-image-container"
      onclick="window.onOpenGalleryDialog({{ $id }}, '{{ $baseImagePath . $image->full_path }}', '{{ $image->description }}')"
    >
      <img
        id="mini-image-{{ $image->id }}"
        name="mini-image"
        class="review-gallery-image"
        src="{{ $baseImagePath . $image->full_path }}"
        alt="{{ $image->description }}"
        height="100%"
        width="100%"
      />
    </div>
  @endforeach
  <div
    style="display: none;"
    id="review-gallery-dialog-{{ $id }}"
    class="review-gallery-dialog-container"
    onclick="window.onCloseGalleryDialog({{ $id }})"
  >
    <div class="review-gallery-dialog">
      <img
        id="review-gallery-main-image"
        class="review-gallery-dialog-image"
        height="100%"
        width="100%"
      >
      {{-- <div class="review-gallery-dialog-button-left">
        <span class="mdi mdi-chevron-left"></span>
      </div>
      <div class="review-gallery-dialog-button-right">
        <span class="mdi mdi-chevron-right"></span>
      </div> --}}
    </div>
  </div>
</div>