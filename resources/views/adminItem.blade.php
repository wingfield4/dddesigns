@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - '.$item->title)

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/adminItem.css">
@endsection

@section('content')
  <div class="page-container">
    <h1>{{ $item->title }}</h1>

    @if( $item->public )
      <div>This item is public.</div><br />
      <a
        href="/admin/item/{{ $item->id }}/privatize"
        class="button button-dark outlined"
      >
        MAKE IT PRIVATE
      </a>
    @else
      <div>This item is private.</div><br />
      <a
        href="/admin/item/{{ $item->id }}/publicize"
        class="button button-dark outlined"
      >
        MAKE IT PUBLIC
      </a>
    @endif

    <h2 class="title">
      Information
      <a class="icon-link" href="/admin/item/{{ $item->id }}/edit">
        <span class="mdi mdi-pencil"></span>
      </a>
    </h2>
    <div class="divider"></div>

    <div class="label">Short Description</div>
    <div>{{ $item->short_description }}</div>

    <div class="label">Long Description</div>
    <div>{{ $item->long_description }}</div>

    <div class="label">Price</div>
    <div>{{ $item->price }}</div>

    <div class="label">Type</div>
    <div>{{ $item->itemType->title }}</div>

    <div class="label">URL</div>
    <div>{{ $item->item_page_url }}</div>
    <br />
    <a href="/admin/item/{{ $item->id }}/edit" class="button outlined button-dark">
      EDIT THIS ITEM
    </a>

    <h2 class="title">Additional Information</h2>
    <div class="divider"></div>

    <table class="pure-table pure-table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Information</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($item->information as $information)
          <tr>
            <td>
              {{ $information->title }}
            </td>
            <td>
              {{ $information->description }}
            </td>
            <td>
              <a href="/admin/editInformation/{{ $information->id }}">EDIT</a>
            </td>
            <td>
              <a href="/admin/deleteInformation/{{ $information->id }}">DELETE</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table><br />
    <a href="/admin/item/{{ $item->id }}/addInformation" class="button outlined button-dark">
      ADD INFROMATION
    </a>

    <h2 class="title">Images</h2>
    <div class="divider"></div>

    <div class="images-container">
      @foreach($item->images as $image)
        <div class="image-container">
          <div class="image-thumbnail-container">
            <img
              src="{{ $image->fullPathURL() }}"
              class="image"
              height="100%"
              width="100%"
            />
          </div>
          <a href="/admin/deleteImage/{{ $image->id }}/{{ $item->id }}" class="delete-image-link">
            <span class="mdi mdi-delete"></span>
          </a>
        </div>
      @endforeach
    </div>
    <a href="/admin/item/{{ $item->id }}/addImages" class="button outlined button-dark">
      ADD IMAGES
    </a>

    <h2 class="title">Customization Options</h2>
    <div class="divider"></div>
    <table class="pure-table pure-table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Type</th>
          <th>Required?</th>
          <th>Allow Custom Option?</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($item->customizations as $customization)
          <tr>
            <td>{{ $customization->title }}</td>
            <td>{{ $customization->description }}</td>
            <td>{{ $customization->customizationType->title }}</td>
            <td>{{ $customization->required ? 'Yes' : 'No' }}</td>
            <td>{{ $customization->allow_custom_option ? 'Yes' : ($customization->customization_type_id == 2 ? 'No' : 'N/A') }}</td>
            <td>
              <a href="/admin/editCustomization/{{ $customization->id }}">Edit</a>
            </td>
            <td>
              <a href="/admin/deleteCustomization/{{ $customization->id }}">Delete</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table><br />
    <a href="/admin/item/{{ $item->id }}/addCustomization" class="button outlined button-dark">
      ADD CUSTOMIZATION
    </a>
  </div>
@endsection
