@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Add Item Images')

@section('header')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="/css/dropzone.min.css">
  <script src="/js/product.js"></script>
  <script src="/js/dropzone.min.js"></script>
  <script>
    Dropzone.options.myAwesomeDropzone = {
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    };
  </script>
@endsection

@section('content')
  <div class="page-container">
    <h1>Add Images for {{ $item->title }}</h1>

    <form
      action="/admin/submitItemImage"
      enctype="multipart/form-data"
      method="POST"
      class="dropzone"
      id="my-awesome-dropzone"
    >
      @csrf
      <input type="hidden" name="itemId" value="{{ $item->id }}" />
    </form>

    <br /><br />
    <a
      href="/admin/item/{{ $item->id }}"
      class="button button-dark outlined"
    >
      Done
    </a>
  </div>
@endsection
