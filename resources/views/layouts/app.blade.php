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

  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
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

  <!--====== Scripts -->
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/material/material.min.js') }}"></script>
  <script src="{{ asset('js/ripples/ripples.min.js') }}"></script>

  <script src="{{ asset('js/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>
  <script src="{{ asset('js/jquery/jquery.plugins.min.js') }}"></script>
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/moment/moment.min.js') }}"></script>
  <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('js/chart/chart.js') }}"></script>
  <script src="{{ asset('js/intro/intro.min.js') }}"></script>

  <script src="{{ asset('js/app/main.js') }}"></script>
  <script src="{{ asset('js/pruebas.js') }}"></script>
  <script src="{{ asset('js/evaluacion_pruebas.js') }}"></script>
  <script src="{{ asset('js/app/validaciones.js') }}"></script>
  <script src="{{ asset('js/app/direccion.js') }}"></script>
  <script>
    window.mostrarAyuda = @json(session('mostrar_ayuda', false));
  </script>
  <script src="{{ asset('js/intro-tour.js') }}"></script>

  {{-- Notificaciones --}}
  <script src="{{ asset('js/app/notificaciones.js') }}"></script>
  {{-- Reloj --}}
  <script src="{{ asset('js/app/reloj.js') }}"></script>
  {{-- Nav Dropdown --}}
  <script src="{{ asset('js/app/dropdown.js') }}"></script>

  <script src="{{ asset('js/fullcalendar/es.js') }}"></script>

  <script>
    $.material.init();
  </script>
  @yield('js')
</body>

</html>
