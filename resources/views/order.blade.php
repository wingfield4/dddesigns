@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Order')

@section('header')

@endsection

@section('content')
  <div class="page-container">
    This is for order: {{ $order->number }}
  </div>
@endsection
