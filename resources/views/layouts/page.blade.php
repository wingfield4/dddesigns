<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>D&D Designs - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="/js/app.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/grids-responsive-min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="icon" href="/images/logo.jpg">
    @yield('header')
    <style>
      html, button, input, select, textarea, label,
        .pure-g [class *= "pure-u"] {
          /* Set your content font stack here: */
          font-family: "Montserrat", sans-serif;
        }
    </style>
  </head>
  <body>
    <x-full-header :user="$user ?? null"/>
    <x-small-header :user="$user ?? null"/>
    @yield('content')
    <x-footer/>
    @yield('footer')
  </body>
</html>