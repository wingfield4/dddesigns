@extends('layouts.page', [
  'error' => $error ?? null,
  'user' => $user ?? null,
  'warning' => $warning ?? null
])
@section('title', 'Create an Account')

@section('header')
  <link rel="stylesheet" type="text/css" href="/css/join.css">
@endsection

@section('content')
  <div class="page-container">
    @isset($error)
      <x-error-banner :error="$error"/>
    @endisset
    @isset($warning)
      <x-warning-banner :warning="$warning"/>
    @endisset
    <div class="inner-page-container">
      <div class="join-card">
        <div class="join-card-header">
          <h2 class="title">Create an Account</h2>
          <p>Creating an account will let you save your shipping information and more easily track your order status!</p>
        </div>
        <div class="join-form-container">
          <form class="pure-form pure-form-stacked" action="/join" method="post">
            <fieldset>
              @csrf
              <div class="pure-g">
                <div class="pure-u-1 pure-u-sm-1-2">
                  <label for="join-first-name-input">First Name</label>
                  <input
                    id="join-first-name-input"
                    name="firstName"
                    class="pure-input pure-u-23-24"
                    type="text"
                    maxlength="100"
                    required
                    @isset($user)
                      value="{{ $user->first_name }}"
                    @endisset
                  >
                </div>
                <div class="pure-u-1 pure-u-sm-1-2">
                  <label for="join-last-name-input">Last Name</label>
                  <input
                    id="join-last-name-input"
                    name="lastName"
                    class="pure-input pure-u-23-24"
                    type="text"
                    maxlength="100"
                    required
                    @isset($user)
                      value="{{ $user->last_name }}"
                    @endisset
                  >
                </div>
                <div class="pure-u-1">
                  <label for="join-email-input">Email</label>
                  <input
                    id="join-email-input"
                    name="email"
                    class="pure-input pure-u-1"
                    type="email"
                    maxlength="100"
                    required
                    @isset($user)
                      value="{{ $user->email }}"
                    @endisset
                  >
                </div>
                <div class="pure-u-1">
                  <label for="join-confirm-email-input">Confirm Email</label>
                  <input
                    id="join-confirm-email-input"
                    name="confirmEmail"
                    class="pure-input pure-u-1"
                    type="email"
                    maxlength="100"
                    required
                  >
                </div>
                <div class="pure-u-1">
                  <label for="join-password-input">Password</label>
                  <input
                    id="join-password-input"
                    name="password"
                    class="pure-input pure-u-1"
                    type="password"
                    maxlength="100"
                    required
                  >
                </div>
                <div class="pure-u-1">
                  <label for="join-confirm-password-input">Confirm Password</label>
                  <input
                    id="join-confirm-password-input"
                    name="confirmPassword"
                    class="pure-input pure-u-1"
                    type="password"
                    maxlength="100"
                    required
                  >
                </div>
                <div class="pure-u-1">
                  <div class="join-button-container">
                    <input
                      type="submit"
                      class="button button-dark outlined"
                    >
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
