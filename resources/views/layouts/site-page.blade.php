<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'DreamStill Technologies' }}</title>
    <script defer data-domain="dreamstill.ca" src="https://plausible.io/js/script.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  </head>
  <body>
    @yield('content')
  </body>
</html>
