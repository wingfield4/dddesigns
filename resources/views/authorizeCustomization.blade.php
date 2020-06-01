@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'About Us')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/authorizeCustomization.css">
@endsection

@section('content')
  <div class="page-container">
    <div class="inner-page-container">
      <div class="login-card">
        <div class="login-card-header">
          <h2 class="title">Login</h2>
          <p>Don't have an account? Click <a href="/join" class="light">here</a> to create one!</p>
        </div>
        <div class="login-form-container">
          <form class="pure-form pure-form-stacked" action="/products/{{ $itemPageUrl ?? '' }}/authorize" method="post">
            @csrf
            <label for="login-email-input">Email</label>
            <input
              id="login-email-input"
              name="email"
              class="pure-input pure-u-1"
              type="email"
              maxlength="100"
              required
              @isset($email)
                value="{{ $email }}"
              @endisset
            >
            <div style="height: 16px;"></div>
            <label for="login-email-input">Password</label>
            <input
              id="login-password-input"
              name="password"
              class="pure-input pure-u-1"
              type="password"
              maxlength="100"
              required
            >
            @isset($error)
              <div class="error">{{ $error }}</div>
            @endisset
            <div class="login-button-container">
              <input
                type="submit"
                class="button button-dark outlined"
              >
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="inner-page-container">
      OR
    </div>
    <br />
    <div class="inner-page-container">
      <a class="button outlined button-dark" href="/products/{{ $itemPageUrl ?? '' }}/customize?guest=true">
        CHECKOUT AS GUEST
      </a>
    </div>
  </div>
@endsection
