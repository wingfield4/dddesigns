@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Edit '.$item->title)

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/editItem.css">
@endsection

@section('content')
  <div class="page-container">
    <h1>Edit {{ $item->title }}</h1>

    <form
      action="/admin/submitEditItem"
      class="pure-form pure-form-stacked"
      enctype="multipart/form-data"
      method="POST"
    >
      @csrf
      <input
        type="hidden"
        name="itemId"
        value="{{ $item->id }}"
      />
      <fieldset>
        <legend>Item Information</legend>

        <label class="label" for="title">Item Type</label>
        <select
          id="item-type"
          name="itemTypeId"
          class="item-input"
          required
        >
          @foreach($itemTypes as $itemType)
            <option
              value="{{ $itemType->id }}"
              @if ($item->item_type_id == $itemType->id)
                selected
              @endif
            >
              {{ $itemType->title }}
            </option>
          @endforeach
        </select>

        <label class="label" for="title">Title</label>
        <input
          type="text"
          id="title"
          name="title"
          class="item-input"
          required
          value="{{ $item->title }}"
        />

        <label class="label" for="short-description">Short Description</label>
        <label class="sub-label" for="short-description">
          This description will appear to users while browsing through products and on social media pages when an item is shared.
        </label>
        <textarea
          type="text"
          id="short-description"
          name="shortDescription"
          class="item-input text-area"
          required
        >{{ $item->short_description }}</textarea>

        <label class="label" for="long-description">Long Description</label>
        <label class="sub-label" for="long-description">
          This is the full description that appeard on the product page.
        </label>
        <textarea
          type="text"
          id="long-description"
          name="longDescription"
          class="item-input text-area"
          required
        >{{ $item->long_description }}</textarea>

        <label class="label" for="price">Price</label>
        <label class="sub-label" for="price">
          This is the base price of the item - any options will add on to this price.
        </label>
        <input
          type="number"
          step=".01"
          id="price"
          name="price"
          required
          value="{{ $item->price }}"
        />

        {{-- <label class="label" for="url">Item URL</label>
        <label class="sub-label" for="url">
          This is a unique string at the end of the URL that
          directs users to the product page of this site
          (i.e. https://dddesigns.com/products/this-item-url).
          Typically, this is just the item's title with '-' replacing any spaces.
        </label>
        <input
          type="text"
          id="url"
          name="url"
          class="item-input"
          required
          value="{{ $item->item_page_url }}"
        /> --}}
      </fieldset>
      <input
        type="submit"
        class="button button-dark outlined"
        value="SAVE"
      >
    </form>
  </div>
@endsection
