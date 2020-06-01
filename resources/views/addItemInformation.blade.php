@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Add Information')

@section('header')

@endsection

@section('content')
  <div class="page-container">
    <form
      class="pure-form pure-form-stacked"
      enctype="multipart/form-data"
      @if(isset($information))
        action="/admin/submitEditInformation"
      @else
        action="/admin/submitInformation"
      @endif
      method="POST"
    >
      @csrf
      <input type="hidden" name="itemId" value="{{ $item->id }}" />
      @if(isset($information))
        <input type="hidden" name="informationId" value="{{ $information->id }}" />
      @endif

      <label class="label" for="title">Title</label>
      <input
        id="title"
        name="title"
        class="pure-input"
        type="text"
        maxlength="100"
        required
        @if(isset($information))
          value="{{ $information->title }}"
        @endif
      />

      <label class="label" for="description">Description</label>
      <input
        id="description"
        name="description"
        class="pure-input"
        type="text"
        maxlength="100"
        required
        @if(isset($information))
          value="{{ $information->description }}"
        @endif
      />

      <input
        id="submit"
        type="submit"
        class="button button-dark outlined"
        value="SAVE"
      >
    </form>
  </div>
@endsection
