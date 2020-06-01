@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'About Us')

@section('header')

@endsection

@section('content')
  <div class="page-container">
    This is the 'About Us' page
  </div>
@endsection
