<!DOCTYPE html>
<html lang="pt-BR">
  <head>
      <meta charset="UTF-8">
      <title>@yield('title', 'Sistema')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body class="bg-light">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <div class="d-flex">
      @unless(request()->is('login*'))
        <div>
          @include('layouts.menuLateral')
        </div>
      @endunless

      <div class="flex-grow-1 p-4">
        @yield('content')
      </div>
    </div>

  </body>
</html>