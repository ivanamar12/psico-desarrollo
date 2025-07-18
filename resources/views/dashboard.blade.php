@extends('layouts.root')

@section('title', 'Inicio')

@section('css')
  <link href="./css/tabs/tabs.css" rel="stylesheet">
@endsection

@section('content')

  <main class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Inicio" icon="zmdi zmdi-assignment zmdi-hc-fw" />

    <!-- Sistema de pestañas -->
    <section class="tabs-container">
      <ul class="tabs-list">
        <li>
          <button class="tab-trigger" data-tab="resumen" data-state="active">Resumen</button>
        </li>
        <li>
          <button class="tab-trigger" data-tab="graficos-distribucion-demografica">Distribución Demográfica</button>
        </li>
        <li>
          <button class="tab-trigger" data-tab="graficos-escalas-riesgos">Evaluación de Riesgos</button>
        </li>
        <li>
          <button class="tab-trigger" data-tab="escolarizacion-modalidades">Escolarización y Modalidades</button>
        </li>
        <!-- Agregar más pestañas según necesites -->
        <li>
          <button class="tab-trigger" data-tab="otra">Otra Pestaña</button>
        </li>
      </ul>

      <section class="tabs-content">
        <!-- Pestaña Resumen -->
        <section class="tab-pane" data-tab="resumen" data-state="active">
          <section style="padding: 0px 12px">
            <h2>Totales Registrados</h2>
          </section>

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

          <section>
            <p>
              Cifras actualizadas de especialistas, personal administrativo y pacientes en el sistema.
            </p>
          </section>
        </section>

        <!-- Pestaña Gráficos -->
        <section class="tab-pane" data-tab="graficos-distribucion-demografica">
          <!-- Sección de gráficos -->
          <section class="container-fluid">
            <section style="padding: 12px">
              <h2>Distribución Demográfica de Pacientes</h2>
            </section>

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

            <section>
              <p>
                Visualización de la composición de la población de pacientes, segmentada por género y grupos de
                edad en meses.
              </p>
            </section>
          </section>
        </section>

        <section class="tab-pane" data-tab="graficos-escalas-riesgos">
          <!-- Sección de gráficos -->
          <section class="container-fluid">
            <section style="padding: 12px">
              <h2>Evaluación Integral de Riesgos en Pacientes</h2>
            </section>

            <section class="row">
              <!-- Gráfico de Riesgo Social -->
              <article class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading text-titles text-center">
                    <i class="zmdi zmdi-alert-triangle"></i> &nbsp; RIESGO SOCIAL
                  </div>
                  <div class="panel-body">
                    <div class="chart-container" style="position: relative; height:300px; width:100%">
                      <canvas id="graficaRiesgoSocial"></canvas>
                    </div>
                  </div>
                </div>
              </article>

              <!-- Gráfico de Riesgo Biológico -->
              <article class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading text-titles text-center">
                    <i class="zmdi zmdi-alert-triangle"></i> &nbsp; RIESGO BIOLÓGICO
                  </div>
                  <div class="panel-body">
                    <div class="chart-container" style="position: relative; height:300px; width:100%">
                      <canvas id="graficaRiesgoBiologico"></canvas>
                    </div>
                  </div>
                </div>
              </article>

              <!-- Gráfico de Riesgo Global -->
              <article class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading text-titles text-center">
                    <i class="zmdi zmdi-alert-triangle"></i> &nbsp; RIESGO GLOBAL
                  </div>
                  <div class="panel-body">
                    <div class="chart-container" style="position: relative; height:300px; width:100%">
                      <canvas id="graficaRiesgoGlobal"></canvas>
                    </div>
                  </div>
                </div>
              </article>
            </section>

            <section>
              <p>
                Análisis de los niveles de riesgo (social, biológico y global) identificados en la población atendida.
              </p>
            </section>
          </section>
        </section>

        <section class="tab-pane" data-tab="escolarizacion-modalidades">
            <section class="container-fluid">
                <section style="padding: 12px">
                    <h2>Escolarización y Modalidades de Educación</h2>
                </section>

                <section class="row">
                    <!-- Gráfico de Escolarización -->
                    <article class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading text-titles text-center">
                                <i class="zmdi zmdi-school"></i> &nbsp; EScolarización
                            </div>
                            <div class="panel-body">
                                <div class="chart-container" style="position: relative; height:300px; width:100%">
                                    <canvas id="graficaEscolarizacion"></canvas>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Gráfico de Modalidades de Educación -->
                    <article class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading text-titles text-center">
                                <i class="zmdi zmdi-library"></i> &nbsp; Modalidades de Educación
                            </div>
                            <div class="panel-body">
                                <div class="chart-container" style="position: relative; height:300px; width:100%">
                                    <canvas id="graficaModalidades"></canvas>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </section>
        </section>

        <!-- Otra pestaña -->
        <section class="tab-pane" data-tab="otra">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <h4>Contenido de otra pestaña</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
    </section>

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

          // Gráfico de Riesgo Social
          new Chart(document.getElementById("graficaRiesgoSocial"), {
            type: "bar",
            data: {
              labels: ["Bajo", "Medio", "Alto"],
              datasets: [{
                label: "Nivel de Riesgo Social",
                data: [
                  data.riesgoSocial.bajo,
                  data.riesgoSocial.medio,
                  data.riesgoSocial.alto
                ],
                backgroundColor: ["#4CAF50", "#FFCE56", "#FF6384"],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    stepSize: 1
                  }
                }
              }
            }
          });

          // Gráfico de Riesgo Biológico
          new Chart(document.getElementById("graficaRiesgoBiologico"), {
            type: "bar",
            data: {
              labels: ["Bajo", "Medio", "Alto"],
              datasets: [{
                label: "Nivel de Riesgo Biológico",
                data: [
                  data.riesgoBiologico.bajo,
                  data.riesgoBiologico.medio,
                  data.riesgoBiologico.alto
                ],
                backgroundColor: ["#4CAF50", "#FFCE56", "#FF6384"],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    stepSize: 1
                  }
                }
              }
            }
          });

          // Gráfico de Riesgo Global (Dona)
          new Chart(document.getElementById("graficaRiesgoGlobal"), {
            type: "doughnut",
            data: {
              labels: ["Bajo", "Medio", "Alto"],
              datasets: [{
                data: [
                  data.riesgoGlobal.bajo,
                  data.riesgoGlobal.medio,
                  data.riesgoGlobal.alto
                ],
                backgroundColor: ["#4CAF50", "#FFCE56", "#FF6384"],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: "bottom"
                }
              }
            }
          });
        })
        .catch((error) => {
          console.error("Error al cargar datos:", error);
          // Mostrar mensaje de error al usuario si lo deseas
        });
    });
fetch("{{ route('estadisticas.escolarizacion') }}")
    .then((response) => {
        if (!response.ok) throw new Error("Error en la respuesta del servidor");
        return response.json();
    })
    .then((data) => {
        const fontFamily = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
        const colorTexto = "#333";

        // Gráfica de Dona (Escolarización)
        new Chart(document.getElementById("graficaEscolarizacion"), {
            type: "doughnut", 
            data: {
                labels: Object.keys(data.escolarizados),
                datasets: [{
                    label: "Cantidad de Pacientes",
                    data: Object.values(data.escolarizados),
                    backgroundColor: ["#4CAF50", "#FF6384"],
                    borderWidth: 1,
                }],
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

        // Gráfica de Dona (Modalidades de Educación)
        new Chart(document.getElementById("graficaModalidades"), {
            type: "bar", 
            data: {
                labels: Object.keys(data.modalidades),
                datasets: [{
                    label: "Cantidad de Pacientes",
                    data: Object.values(data.modalidades),
                    backgroundColor: ["#4CAF50", "#FF6384", "#FFCE56"],
                    borderWidth: 1,
                }],
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
    })
    .catch((error) => {
        console.error("Error al cargar datos:", error);
        // Mostrar mensaje de error al usuario si lo deseas
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
