@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'FAQs')

@section('header')

@endsection

@section('content')
  <div class="page-container">
    This is the 'Frequently Asked Questions' page
  </div>
@endsection
