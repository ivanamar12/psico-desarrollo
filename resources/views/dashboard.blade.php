@extends('layouts.root')

@section('title', 'Inicio')

@section('css')
  <link href="./css/tabs/tabs.css" rel="stylesheet">
@endsection

@section('content')

  <main class="full-box dashboard-contentPage">
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
          <a href="#!" class="btn-ayuda-interactiva" onclick="iniciarAyuda()">
            <i class="zmdi zmdi-help-outline"></i>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Content page -->

    <!-- Page title -->
    <x-page-header title="Inicio" icon="zmdi zmdi-assignment zmdi-hc-fw" />

    <!-- Sistema de pestañas -->
    <div class="tabs-container">
      <ul class="tabs-list">
        <li>
          <button class="tab-trigger" data-tab="resumen" data-state="active">Resumen</button>
        </li>
        <li>
          <button class="tab-trigger" data-tab="graficos">Gráficos</button>
        </li>
        <!-- Agregar más pestañas según necesites -->
        <li>
          <button class="tab-trigger" data-tab="otra">Otra Pestaña</button>
        </li>
      </ul>

      <div class="tabs-content">
        <!-- Pestaña Resumen -->
        <div class="tab-pane" data-tab="resumen" data-state="active">

          <section class="full-box text-center" style="padding: 30px 10px;">
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
          </section>
        </div>

        <!-- Pestaña Gráficos -->
        <div class="tab-pane" data-tab="graficos">
          <!-- Sección de gráficos -->
          <section class="container-fluid">
            <section class="row">
              <!-- Gráfico de géneros -->
              <article class="col-md-6">
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
              </article>

              <!-- Gráfico de edades -->
              <article class="col-md-6">
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
              </article>
            </section>
          </section>
        </div>

        <!-- Otra pestaña -->
        <div class="tab-pane" data-tab="otra">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4>Contenido de otra pestaña</h4>
                    <p>Aquí puedes agregar más contenido según sea necesario.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

@endsection

@section('js')
  <script src="{{ asset('js/chart/chart.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Sistema de pestañas
      const tabTriggers = document.querySelectorAll('.tab-trigger');
      const tabPanes = document.querySelectorAll('.tab-pane');

      tabTriggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
          const tabId = trigger.getAttribute('data-tab');

          // Actualizar estado de los triggers
          tabTriggers.forEach(t => t.setAttribute('data-state', 'inactive'));
          trigger.setAttribute('data-state', 'active');

          // Actualizar estado de los paneles
          tabPanes.forEach(pane => {
            pane.setAttribute('data-state', 'inactive');
            if (pane.getAttribute('data-tab') === tabId) {
              pane.setAttribute('data-state', 'active');
            }
          });
        });
      });

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
  <script>
    function iniciarAyuda() {
      introJs().setOptions({
        nextLabel: 'Siguiente',
        prevLabel: 'Anterior',
        skipLabel: 'Saltar',
        doneLabel: 'Finalizar',
      }).start();
    }
  </script>
@endsection
