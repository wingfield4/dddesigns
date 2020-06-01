@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Add Item Customization')

@section('header')
  <script src="/js/addCustomization.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/addCustomization.css">
@endsection

@section('content')
  <div class="page-container">
    <h1>Add Customization for {{ $item->title }}</h1>

    <form
      class="pure-form pure-form-stacked"
      enctype="multipart/form-data"
      @if(isset($customization))
        action="/admin/submitEditCustomization"
      @else
        action="/admin/submitCustomization"
      @endif
      method="POST"
    >
      @csrf
      <input type="hidden" name="itemId" value="{{ $item->id }}" />
      @if(isset($customization))
        <input type="hidden" name="customizationId" value="{{ $customization->id }}" />
      @endif

      <label class="label" for="customization-type">Customization Type</label>
      <select
        id="customization-type"
        class="pure-input"
        name="customizationType"
        onchange="window.onChangeCustomizationTypeId(this)"
        required
      >
        <option value="" disabled selected></option>
        @foreach ($customizationTypes as $customizationType)
          <option
            value="{{ $customizationType->id }}"
            @if(isset($customization) && $customization->customization_type_id == $customizationType->id)
              selected
            @endif
          >
            {{ $customizationType->title }}
          </option>
        @endforeach
      </select>

      <label class="label" for="title">Title</label>
      <input
        id="title"
        name="title"
        class="pure-input"
        type="text"
        maxlength="100"
        required
        @if(isset($customization))
          value="{{ $customization->title }}"
        @endif
      />

      <label class="label" for="description">Description</label>
      <input
        id="description"
        name="description"
        class="pure-input"
        type="text"
        maxlength="1000"
        @if(isset($customization))
          value="{{ $customization->description }}"
        @endif
      />

      <label class="label" for="required">
        <input
          id="required"
          name="required"
          class="pure-input"
          type="checkbox"
          @if(isset($customization) && $customization->required)
            checked
          @endif
        />
        Require a Response?
      </label>
      {{-- <label class="sub-label" for="required">
        If yes, a user will be required to fill out this field to submit the order
      </label> --}}

      <div
        name="customization-container"
        id="customization-type-1-container"
        style="display: none;"
      >
        <label class="label" for="min-length">Minimum Characters in Response</label>
        <input
          id="min-length"
          name="minLength"
          class="pure-input"
          type="number"
          @if(isset($customization) && !is_null($customization->free_text_min_length))
            value="{{ $customization->free_text_min_length }}"
          @else
            value="0"
          @endif
        />

        <label class="label" for="max-length">Max Characters in Response</label>
        <input
          id="max-length"
          name="maxLength"
          class="pure-input"
          type="number"
          value="240"
          @if(isset($customization) && !is_null($customization->free_text_max_length))
            value="{{ $customization->free_text_max_length }}"
          @else
            value="240"
          @endif
        />
      </div>

      <div
        name="customization-container"
        id="customization-type-2-container"
        style="display: none;"
      >
        @for ($i = 1; $i < 50; $i++)
          <div
            id="options-container-{{ $i }}"
            class="options-container"
            @if ($i > 1)
              style="display: none;"
            @endif
          >
            <div class="option-container">
              <label class="label" for="options">Option {{ $i }}</label>
              <input
                placeholder="Title"
                id="option-{{ $i }}-title"
                name="option{{ $i }}Title"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="100"
              />
            </div>

            <div class="option-container">
              <input
                placeholder="Description"
                id="option-{{ $i }}-description"
                name="option{{ $i }}Description"
                class="pure-input pure-u-23-24"
                type="text"
                maxlength="1000"
              />
            </div>

            <div class="option-container">
              <input
                placeholder="Price"
                id="option-{{ $i }}-price"
                name="option{{ $i }}Price"
                class="pure-input pure-u-23-24"
                type="number"
                step=".01"
              />
            </div>

            <button
              type="button"
              class="button button-dark icon-button"
              onclick="window.onDeleteOption({{ $i }})"
            >
              <span class="mdi mdi-delete"></span>
            </button>
          </div>
        @endfor

        <br />
        <button
          class="button button-dark outlined"
          onclick="window.onAddOption()"
          type="button"
        >
          <span class="mdi mdi-plus-circle-outline"></span>
          ADD ANOTHER OPTION
        </button>

        <label class="label" for="allow-custom-option">
          <input
            id="allow-custom-option"
            name="allowCustomOption"
            class="pure-input"
            type="checkbox"
            @if(isset($customization) && $customization->allow_custom_option)
              checked
            @endif
          />
          Allow Custom Option?
        </label>

        <label class="label" for="custom-option-description">Custom Options Description</label>
        <label class="sub-label" for="custom-option-description">(If applicable) Give the user a description or example of what to provide as a custom option</label>
        <input
          id="custom-option-description"
          name="customOptionDescription"
          class="pure-input"
          type="text"
          maxlength="1000"
        />
      </div>

      <div
        name="customization-container"
        id="customization-type-3-container"
        style="display: none;"
      >
        <!-- nothing here for now -->
      </div>

      <br />
      <input
        id="submit"
        type="submit"
        class="button button-dark outlined"
        value="SAVE"
      >
    </form>
  </div>
@endsection

@section('footer')
  <script>
    @if(isset($customization))
      window.onInitializeCustomizationType(@json($customization->customization_type_id));
      @foreach($customization->options as $option)
        window.addOption(@json($option));
      @endforeach
    @endif
  </script>
@endsection