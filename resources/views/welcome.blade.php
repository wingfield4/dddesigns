@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Welcome')

@section('header')

@endsection

@section('content')
  <div class="page-container">
    Thanks for creating an account!
  </div>
@endsection
