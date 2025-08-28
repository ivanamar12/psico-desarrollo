<!DOCTYPE html>
<html lang="es">

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS Base -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <link href="{{ asset('css/introjs.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/intro-custom.css') }}" rel="stylesheet">
  <link href="{{ asset('css/toastr/toastr.min.css') }}" rel="stylesheet" />

  <!-- CSS Específico por vista -->
  @yield('css')
</head>

<body>
  <!-- SideBar Menu -->
  @include('layouts.sidebar')

  <!-- Content page-->
  @yield('content')

  <!-- Notifications area -->
  @include('layouts.notificaciones')

  {{-- Nav Dropdown --}}
  <x-nav-dropdown />

  <!-- JS Base -->
  <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/material.min.js') }}"></script>
  <script src="{{ asset('js/ripples.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <script src="{{ asset('js/toastr/toastr.min.js') }}"></script>
  {{-- Funcionalidades principales de la UI --}}
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/intro.min.js') }}"></script>
  <script>
    window.mostrarAyuda = @json(session('mostrar_ayuda', false));
  </script>
  <script src="{{ asset('js/intro-tour.js') }}"></script>
  {{-- Reloj --}}
  <script src="{{ asset('js/app/reloj.js') }}"></script>
  {{-- Nav Dropdown --}}
  <script src="{{ asset('js/app/dropdown.js') }}"></script>

  <!-- JS Específico por vista -->
  @yield('js')
</body>

</html>
