@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Add an Item')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/addItem.css">
  <link rel="stylesheet" type="text/css" href="/css/dropzone.min.css">
  <script src="/js/product.js"></script>
  <script src="/js/dropzone.min.js"></script>
  <script>
  </script>
@endsection

@section('content')
  <div class="page-container">
    <h1>Create an Item</h1>
    <p class="sub-label">
      Note: This item will not be public until you publicize it from the main item page. You will be able to add images,
      customization options, and additional information after pressing CONTINUE.
    </p>

    <form
      action="/admin/submitItem"
      class="pure-form pure-form-stacked"
      enctype="multipart/form-data"
      method="POST"
    >
      @csrf
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
            <option value="{{ $itemType->id }}">{{ $itemType->title }}</option>
          @endforeach
        </select>

        <label class="label" for="title">Title</label>
        <input type="text" id="title" name="title" class="item-input" required />

        <label class="label" for="short-description">Short Description</label>
        <label class="sub-label" for="short-description">
          This description will appear to users while browsing through products and on social media pages when an item is shared.
        </label>
        <textarea
          type="text"
          id="short-description"
          name="shortDescription"
          class="item-input"
          required
        ></textarea>

        <label class="label" for="long-description">Long Description</label>
        <label class="sub-label" for="long-description">
          This is the full description that appeard on the product page.
        </label>
        <textarea
          type="text"
          id="long-description"
          name="longDescription"
          class="item-input"
          required
        ></textarea>

        <label class="label" for="price">Price</label>
        <label class="sub-label" for="price">
          This is the base price of the item - any options will add on to this price.
        </label>
        <input type="number" step=".01" id="price" name="price" required />

        <label class="label" for="url">Item URL</label>
        <label class="sub-label" for="url">
          This is a unique string at the end of the URL that
          directs users to the product page of this site
          (i.e. https://dddesigns.com/products/this-item-url).
          Typically, this is just the item's title with '-' replacing any spaces.
        </label>
        <input type="text" id="url" name="url" class="item-input" required />

        {{-- <label for="public" class="pure-checkbox">
          <input type="checkbox" name="public" id="public" checked /> Make this item public
        </label> --}}
      </fieldset>
      <input
        type="submit"
        class="button button-dark outlined"
        value="CONTINUE"
      >
    </form>
  </div>
@endsection
