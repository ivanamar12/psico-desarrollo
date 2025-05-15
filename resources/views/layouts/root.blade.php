<!DOCTYPE html>
<html lang="es">

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- CSS Base -->
  <link href="./css/main.css" rel="stylesheet">

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
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae esse velit ipsa sunt
            incidunt aut voluptas, nihil reiciendis maiores eaque hic vitae saepe voluptatibus. Ratione
            veritatis a unde autem!
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-raised" data-dismiss="modal"><i
              class="zmdi zmdi-thumb-up"></i> Ok</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Base -->
  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/material.min.js') }}"></script>
  <script src="{{ asset('js/ripples.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    /** this is the function for o'clock */
    if (document.getElementById("fechaReloj")) {
      let actualizarHora = function() {
        let fecha = new Date(),
          horas = fecha.getHours(),
          ampm,
          minutos = fecha.getMinutes(),
          segundos = fecha.getSeconds(),
          diaSemana = fecha.getDay(),
          dia = fecha.getDate(),
          mes = fecha.getMonth(),
          year = fecha.getFullYear();

        let pHoras = document.getElementById("horas"),
          pAMPM = document.getElementById("ampm"),
          pMinutos = document.getElementById("minutos"),
          pSegundos = document.getElementById("segundos"),
          pDiaSemana = document.getElementById("diaSemana"),
          pDia = document.getElementById("dia"),
          pMes = document.getElementById("mes"),
          pYear = document.getElementById("year");

        let semana = [
          "Domingo",
          "Lunes",
          "Martes",
          "Miercoles",
          "Jueves",
          "Viernes",
          "Sabado",
        ];
        pDiaSemana.textContent = semana[diaSemana];
        pDia.textContent = dia;

        let meses = [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre",
        ];
        pMes.textContent = meses[mes];
        pYear.textContent = year;

        if (horas >= 12) {
          horas = horas - 12;
          ampm = "PM";
        } else {
          ampm = "AM";
        }

        if (horas == 0) {
          horas = 12;
        }
        pHoras.textContent = horas;

        if (minutos < 10) {
          minutos = "0" + minutos;
        }
        pMinutos.textContent = minutos;

        if (segundos < 10) {
          segundos = "0" + segundos;
        }
        pSegundos.textContent = segundos;
        pAMPM.textContent = ampm;
      };
      actualizarHora();

      setInterval(actualizarHora, 1000);
    }
  </script>
  {{-- Nav Dropdown --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const dropdownBtn = document.querySelector('.btn-dropdown');
      const dropdownArea = document.querySelector('.Dropdown-area');
      const dropdownClose = document.querySelector('.Dropdown-body-title .zmdi-close');

      // Abrir dropdown
      dropdownBtn.addEventListener('click', function(e) {
        e.preventDefault();
        dropdownArea.classList.add('show-Dropdown-area');
      });

      // Cerrar dropdown
      dropdownClose.addEventListener('click', function() {
        dropdownArea.classList.remove('show-Dropdown-area');
      });

      // Cerrar al hacer click fuera
      document.addEventListener('click', function(e) {
        if (!dropdownArea.contains(e.target) && !dropdownBtn.contains(e.target)) {
          dropdownArea.classList.remove('show-Dropdown-area');
        }
      });
    });
  </script>

  <!-- JS Específico por vista -->
  @yield('js')
</body>

</html>
