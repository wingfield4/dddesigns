@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Products')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/products.css">
@endsection

@section('content')
  <div class="page-container">
    <div class="items-container">
      @foreach ($items as $item)
        <x-item :item="$item" :baseImagePath="$baseImagePath" />
      @endforeach
    </div>
  </div>
@endsection
