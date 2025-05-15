@extends('layouts.root')

@section('title', 'Inicio')

@section('css')
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <nav class="full-box dashboard-Navbar">
      <ul class="full-box list-unstyled text-right">
        <li class="pull-left">
          <a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
        </li>

        <li>
          <a href="#!" class="btn-Notifications-area">
            <i class="zmdi zmdi-notifications-none"></i>
            <span class="badge">7</span>
          </a>
        </li>

        <li>
          <a href="#!" class="btn-dropdown">
            <i class="zmdi zmdi-account"></i>
          </a>
        </li>

        <li>
          <a href="#!" class="btn-modal-help">
            <i class="zmdi zmdi-help-outline"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- Content page -->
    <section class="container-fluid">
      <div class="page-header">
        <x-oclock />

        <h1 class="text-titles"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i>Inicio</h1>
      </div>
      <p class="lead">
    </section>

    <div class="full-box text-center" style="padding: 30px 10px;">
      <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
          Total Usuarios
        </div>
        <div class="full-box tile-icon text-center">
          <i class="zmdi zmdi-account"></i>
        </div>
        <div class="full-box tile-number text-titles">
          <p class="full-box">{{ $totalUsuarios }}</p>
          <small>Registrados</small>
        </div>
      </article>

      <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
          Especialistas
        </div>
        <div class="full-box tile-icon text-center">
          <i class="zmdi zmdi-male-alt"></i>
        </div>
        <div class="full-box tile-number text-titles">
          <p class="full-box">{{ $totalEspecialistas }}</p>
          <small>Registrados</small>
        </div>
      </article>

      <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
          Secretarias
        </div>
        <div class="full-box tile-icon text-center">
          <i class="zmdi zmdi-male-female"></i>
        </div>
        <div class="full-box tile-number text-titles">
          <p class="full-box">{{ $totalSecretarias }}</p>
          <small>Registrados</small>
        </div>
      </article>

      <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
          Pacientes
        </div>
        <div class="full-box tile-icon text-center">
          <i class="zmdi zmdi-face"></i>
        </div>
        <div class="full-box tile-number text-titles">
          <p class="full-box">{{ $totalPacientes }}</p>
          <small>Registrados</small>
        </div>
      </article>

      <article class="full-box tile">
        <div class="full-box tile-title text-center text-titles text-uppercase">
          Representantes
        </div>
        <div class="full-box tile-icon text-center">
          <i class="zmdi zmdi-male-female"></i>
        </div>
        <div class="full-box tile-number text-titles">
          <p class="full-box">{{ $totalRepresentantes }}</p>
          <small>Registrados</small>
        </div>
      </article>
    </div>

    <!-- Sección de gráficos -->
    <div class="container-fluid">
      <div class="row">
        <!-- Gráfico de géneros -->
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading text-titles text-center">
              <i class="zmdi zmdi-male-female"></i> &nbsp; DISTRIBUCIÓN POR GÉNEROS
            </div>
            <div class="panel-body">
              <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="graficaGenero"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Gráfico de edades -->
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading text-titles text-center">
              <i class="zmdi zmdi-time"></i> &nbsp; DISTRIBUCIÓN POR EDADES
            </div>
            <div class="panel-body">
              <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="graficaEdades"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

@endsection

@section('js')
  <script src="{{ asset('js/chart/chart.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      fetch("{{ route('estadisticas.pacientes') }}")
        .then((response) => {
          if (!response.ok) throw new Error("Error en la respuesta del servidor");
          return response.json();
        })
        .then((data) => {
          // Configuración común para ambos gráficos
          const fontFamily = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
          const colorTexto = "#333";

          // Gráfica de Donut (Género)
          new Chart(document.getElementById("graficaGenero"), {
            type: "doughnut",
            data: {
              labels: Object.keys(data.generos),
              datasets: [{
                data: Object.values(data.generos),
                backgroundColor: ["#36A2EB", "#FF6384", "#FFCE56"],
                borderWidth: 1,
              }, ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: "bottom",
                  labels: {
                    font: {
                      family: fontFamily,
                      size: 12
                    },
                    color: colorTexto,
                  },
                },
                tooltip: {
                  bodyFont: {
                    family: fontFamily
                  }
                },
              },
            },
          });

          // Gráfica de Barras (Edades)
          new Chart(document.getElementById("graficaEdades"), {
            type: "bar",
            data: {
              labels: data.edades.map((item) => item.rango),
              datasets: [{
                label: "Cantidad de Pacientes",
                data: data.edades.map((item) => item.cantidad),
                backgroundColor: "#4CAF50",
                borderColor: "#388E3C",
                borderWidth: 1,
              }, ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    font: {
                      family: fontFamily
                    },
                    color: colorTexto
                  },
                  grid: {
                    color: "rgba(0,0,0,0.05)"
                  },
                },
                x: {
                  ticks: {
                    font: {
                      family: fontFamily
                    },
                    color: colorTexto
                  },
                  grid: {
                    display: false
                  },
                },
              },
              plugins: {
                legend: {
                  labels: {
                    font: {
                      family: fontFamily
                    },
                    color: colorTexto
                  },
                },
              },
            },
          });
        })
        .catch((error) => {
          console.error("Error al cargar datos:", error);
          // Mostrar mensaje de error al usuario si lo deseas
        });
    });
  </script>
@endsection
