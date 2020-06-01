@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Admin - Items')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/adminItems.css">
@endsection

@section('content')
  <div class="page-container">
    <h1>Items</h1>
    <table class="pure-table pure-table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Base Price</th>
          <th>Public?</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $item)
          <tr>
            <td>
              <a href="/admin/item/{{ $item->id }}">{{ $item->title }}</a>
            </td>
            <td>
              {{ $item->price }}
            </td>
            <td>
              {{ $item->public ? 'Yes' : 'No' }}
            </td>
            <td>
              <a href="/admin/item/{{ $item->id }}/delete">Delete</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
