@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', $item->title)

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/product.css">
  <link rel="stylesheet" type="text/css" href="/css/reviewGallery.css">
  <script src="/js/product.js"></script>
  <script src="/js/reviewGallery.js"></script>
@endsection

@section('content')
  <div class="page-container">
    <div class="display-container">
      <div class="gallery-container">
        @if(is_object($item->thumbnailImage))
          <img
            id="main-image"
            class="gallery-image"
            src="{{ $baseImagePath . $item->thumbnailImage->full_path }}"
            alt="{{ $item->thumbnailImage->description }}"
            height="400"
            width="100%"
          />
        @else
          <div class="no-thumbnail">
            <span class="mdi mdi-basket"></span>
          </div>
        @endif
        <div onClick="window.openImage()" target="_blank" class="open-icon-container">
          <span class="mdi mdi-open-in-new"></span>
        </div>
        <div class="other-images-container">
          @foreach ($item->images as $image)
            <div
              class="mini-image-container"
              onclick="window.selectImage({{ $image->id }}, '{{ $baseImagePath . $image->full_path }}')"
            >
              <img
                id="mini-image-{{ $image->id }}"
                name="mini-image"
                class="mini-image"
                src="{{ $baseImagePath.$image->full_path }}"
                alt="{{ $image->description }}"
                height="100%"
                width="100%"
              />
            </div>
          @endforeach
        </div>
      </div>
      <div class="info-container">
        <h1 class="title">{{ $item->title }}</h1>
        <div class="divider"></div>
        <div class="caption">
          @if ($item->item_type_id == 1)
            Starting from
          @endif
          ${{ $item->price }}
        </div>
        <h2 class="header">Description</h2>
        <div class="description">
          {{ $item->long_description }}
        </div>
        <div class="build-button-container">
          <a href="/products/{{ $item->item_page_url }}/customize" class="button build-button outlined">
            <span class="mdi mdi-basket"></span>
            @if ($item->item_type_id == 1)
              BUILD AND ORDER
            @elseif ($item->item_type_id == 2)
              ORDER NOW
            @endif
          </a>
        </div>
        <h2 class="header">Share This Page</h2>
        <x-share-icons :path="$item->item_page_url" :title="$item->title"/>
      </div>
    </div>
    {{-- <div class="divider"></div> --}}
    <div class="tab-container">
      <div class="tab-spacer-left"></div>
      <div
        class="tab tab-active"
        name="tab"
        id="tab-1"
        onclick="window.onSelectTab(1)"
      >
        Additional Information
      </div>
      <div
        class="tab tab-right"
        name="tab"
        id="tab-2"
        onclick="window.onSelectTab(2)"
      >
        Reviews
      </div>
      <div class="tab-spacer-right"></div>
    </div>
    <div id="tab-content-1" name="tab-content">
      <h2>Additional Information</h2>
      <table class="pure-table">
        <tbody>
          @foreach ($item->information as $information)
            <tr class="{{ $loop->index%2 == 0 ? 'pure-table-odd' : '' }} ">
              <td>{{ $information->title }}</td>
              <td>{{ $information->description }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="hidden" id="tab-content-2" name="tab-content">
      <h2>Reviews</h2>
      @foreach ($reviews as $review)
        <div class="review-container">
          <h3 class="review-name">
            {{ $review->user->first_name }} {{ strtoupper(substr($review->user->last_name, 0, 1)) }}.
          </h3>
          <div class="stars-container">
            @for ($i = 0; $i < $review->stars; $i++)
              <span class="mdi mdi-star"></span>
            @endfor
            @for ($i = 0; $i < 5 - $review->stars; $i++)
              <span class="mdi mdi-star-outline"></span>
            @endfor
          </div>
          @if(count($review->images) > 0)
            <x-review-gallery :images="$review->images" :baseImagePath="$baseImagePath" :id="rand(0,100000)"/>
          @endif
          {{ $review->review }}
        </div>
      @endforeach
    </div>
  </div>
@endsection
