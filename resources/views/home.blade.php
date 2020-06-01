@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Welcome')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/home.css">
@endsection

@section('content')
  <div class="parallax parallax-primary">
    <div>
      <h1>
        D&D Designs
      </h1>
    </div>
    <h2>Catchy Tagline</h2>
    <a href="/products" class="button outlined" style="margin-top: 32px;">
      SHOP NOW
    </a>
  </div>
  <div class="banner">
    <h2>Here's our latest updates, or maybe just a paragraph of what D&D is</h2>
  </div>
  <div class="parallax parallax-secondary">
    <div class="quote-container">
      <div class="quote">
        "Here's a nice quote from a review about your product. Excellent 10 out of 10. Would buy again. Would recommend."
      </div>
      - Joe from Montana
    </div>
  </div>
@endsection
