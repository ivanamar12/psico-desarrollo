<!DOCTYPE html>
<html lang="es">

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="./css/main.css" rel="stylesheet">
  <link href="./css/select2.min.css" rel="stylesheet" />
  <link href="./css/datatables/datatables.min.css" rel="stylesheet">
  <link href="./css/toastr/toastr.min.css" rel="stylesheet" />
  <link href='./css/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
  <link href="./css/introjs.min.css" rel="stylesheet">
  <link href="./css/intro-custom.css" rel="stylesheet">
  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
</head>

<body>
  <!-- SideBar -->

  <!-- SideBar Menu -->
  @include('layouts.sidebar')

  <!-- Content page-->
  @yield('content')

  <!-- Notifications area -->
  @include('layouts.notificaciones')

  {{-- Nav Dropdown --}}
  <x-nav-dropdown />

  <!-- Dialog help -->
  <div class="modal fade" tabindex="-1" role="dialog" id="Dialog-Help">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Help</h4>
        </div>
        <div class="modal-body">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt incidunt aut
            voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione veritatis a unde autem!
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i
              class="zmdi zmdi-thumb-up"></i> Ok</button>
        </div>
      </div>
    </div>
  </div>
  <!--====== Scripts -->
  <script src="./js/sweetalert2.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/material.min.js"></script>
  <script src="./js/ripples.min.js"></script>
  <script src="./js/select2.min.js"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>
  <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="./js/main.js"></script>
  <script src="./js/pruebas.js"></script>
  <script src="./js/evaluacion_pruebas.js"></script>
  <script src="./js/toastr/toastr.min.js"></script>
  <script src="./js/datatables/datatables.min.js"></script>
  <script src='./js/moment/moment.min.js'></script>
  <script src='./js/fullcalendar/fullcalendar.min.js'></script>
  <script src="./js/chart/chart.js"></script>
  <script src="{{ asset('js/intro.min.js') }}"></script>
  <script src="{{ asset('js/validaciones.js') }}"></script>
  <script src="{{ asset('js/direccion.js') }}"></script>
  <script>
    window.mostrarAyuda = @json(session('mostrar_ayuda', false));
  </script>
  <script src="{{ asset('js/intro-tour.js') }}"></script>
  {{-- Reloj --}}
  <script src="{{ asset('js/app/reloj.js') }}"></script>
  {{-- Nav Dropdown --}}
  <script src="{{ asset('js/app/dropdown.js') }}"></script>

  <script src='/js/es.js'></script>

  <script>
    $.material.init();
  </script>
  @yield('js')
</body>

</html>
