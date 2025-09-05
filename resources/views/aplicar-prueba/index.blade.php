@extends('layouts.root')

@section('title', 'Pruebas')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Pruebas" icon="zmdi zmdi-assignment zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            <li><a href="#new-aplicar" data-toggle="tab">Nuevo</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-prueba">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Paciente</th>
                      <th style="text-align: center">Prueba</th>
                      <th style="text-align: center">Fecha</th>
                      <th style="text-align: center">resultados</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="new-aplicar">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="formAplicarPrueba">
                      <!-- Especialista -->
                      <div class="form-group">
                        <label for="especialista">Especialista</label>
                        <input type="text" id="especialista" class="form-control" value="{{ auth()->user()->name }}"
                          disabled>
                        <small class="form-text text-muted">
                          Nombre del profesional que aplica la prueba (se autocompleta).
                        </small>
                      </div>

                      <div class="form-group">
                        <label for="paciente_id">Paciente <span class="text-danger">*</span></label>
                        <select id="paciente_id" name="paciente_id" class="form-control select2" required
                          style="width: 100%;">
                          <option selected disabled>Seleccione un paciente</option>
                          @foreach ($pacientes as $paciente)
                            @php
                              $codigo = optional($paciente->historiaclinicas->first())->codigo ?? 'Sin código';
                            @endphp
                            <option value="{{ $paciente->id }}" data-fecha-nac="{{ $paciente->fecha_nac }}">
                              {{ $paciente->nombre }} {{ $paciente->apellido }} - Código: {{ $codigo }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <!-- Selector de pruebas -->
                      <div class="form-group" id="prueba-container" style="display: none;">
                        <label for="prueba_id">Prueba <span class="text-danger">*</span></label>
                        <select id="prueba_id" name="prueba_id" class="form-control select2" required
                          style="width: 100%;">
                          <option value="">Cargando pruebas disponibles...</option>
                        </select>
                        <small class="form-text text-muted">
                          Pruebas disponibles para el rango de edad del paciente.
                        </small>
                      </div>

                      <button type="button" id="btnIniciarPrueba" class="btn btn-custom" style="color: white;">
                        Aplicar Prueba
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <section id="modalPrueba" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Aplicación de la prueba</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- Barra de progreso -->
          <div class="progress" style="height: 20px;">
            <div id="barraProgreso" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div id="progresoTexto" style="text-align: center"></div>

          <div id="contenidoPrueba">
          </div>
        </div>
        <div class="modal-footer">
          <button id="btnAnterior" class="btn btn-regresar" style="display: none; color: white;">Anterior</button>
          <button id="btnSiguiente" class="btn btn-regresar" style="color: white;">Siguiente</button>
          <button id="btnFinalizar" class="btn btn-custom" style="display: none; color: white;">Finalizar</button>
        </div>
      </div>
    </div>
  </section>

  <section id="modalPruebaVer" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Resultados de la prueba</h3>
        </div>
        <div class="modal-body">
          <div id="contenidoPruebaVer">
            <p>Cargando resultados...</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>
  <script src="{{ asset('js/moment/moment.min.js') }}"></script>
  {{-- Especifico para aplicación de pruebas --}}
  <script src="{{ asset('js/app/pruebas.js') }}"></script>
  <script src="{{ asset('js/app/evaluacion-pruebas.js') }}"></script>

  {{-- Script para los selects --}}
  <script>
    $(document).ready(function() {
      const pacientes = @json($pacientes);
      const pruebas = @json($pruebas);

      const rangosEdad = {
        '0-3 meses': {
          min: 0,
          max: 3
        },
        '4-6 meses': {
          min: 4,
          max: 6
        },
        '7-12 meses': {
          min: 7,
          max: 12
        },
        '13-24 meses': {
          min: 13,
          max: 24
        },
        '25-36 meses': {
          min: 25,
          max: 36
        },
        '37-48 meses': {
          min: 37,
          max: 48
        },
        '49-72 meses': {
          min: 49,
          max: 72
        },
        '36-78 meses': {
          min: 36,
          max: 78
        },
        '60-78 meses': {
          min: 60,
          max: 78
        }
      };

      // Inicializar Select2 para el select de pacientes
      $('#paciente_id').select2({
        placeholder: 'Seleccione un paciente con historia clínica',
        allowClear: true,
        data: pacientes.map(paciente => {
          const codigo = paciente.historiaclinicas && paciente.historiaclinicas.length > 0 ?
            paciente.historiaclinicas[0].codigo :
            'Sin código';

          return {
            id: paciente.id,
            text: `${paciente.nombre} ${paciente.apellido} - Código: ${codigo}`,
            fecha_nac: paciente.fecha_nac
          };
        }),
        language: {
          noResults: function() {
            return "Paciente no encontrado";
          }
        }
      });

      // Inicializar Select2 para el select de pruebas
      const pruebaSelect = $('#prueba_id').select2({
        placeholder: 'Seleccione una prueba',
        allowClear: true,
        language: {
          noResults: function() {
            return "Prueba no encontrada";
          }
        }
      });

      // Ocultar selector de pruebas inicialmente
      $('#prueba-container').hide();
      $('#prueba_id').prop('disabled', true);

      $('#paciente_id').on('change', function() {
        const pacienteId = $(this).val();

        if (!pacienteId) {
          $('#prueba-container').hide();
          $('#prueba_id').prop('disabled', true).val(null).trigger('change');
          return;
        }

        // Buscar el paciente seleccionado en la lista de pacientes
        const pacienteSeleccionado = pacientes.find(p => p.id == pacienteId);

        if (!pacienteSeleccionado || !pacienteSeleccionado.fecha_nac) {
          toastr.error('No se pudo obtener la fecha de nacimiento del paciente');
          return;
        }

        const edadEnMeses = calcularEdadEnMeses(pacienteSeleccionado.fecha_nac);
        filtrarPruebasDisponibles(edadEnMeses);
        $('#prueba-container').show();
      });

      function calcularEdadEnMeses(fechaNacimiento) {
        if (!moment(fechaNacimiento).isValid()) {
          console.error("Fecha inválida:", fechaNacimiento);
          return 0;
        }
        return moment().diff(moment(fechaNacimiento), 'months');
      }

      function filtrarPruebasDisponibles(edadEnMeses) {
        // Filtrar pruebas disponibles según la edad del paciente
        const pruebasDisponibles = pruebas.filter(prueba => {
          const rango = rangosEdad[prueba.rango_edad];
          if (!rango) return false;

          return edadEnMeses >= rango.min && edadEnMeses <= rango.max;
        });

        // Actualizar el select de pruebas
        $('#prueba_id').empty();

        if (pruebasDisponibles.length > 0) {
          $.each(pruebasDisponibles, function(index, prueba) {
            $('#prueba_id').append(
              $('<option></option>').val(prueba.id).text(prueba.nombre)
            );
          });
          $('#prueba_id').prop('disabled', false).trigger('change');
        } else {
          $('#prueba_id').append(
            $('<option></option>').val('').text('No hay pruebas disponibles para este rango de edad')
            .prop('disabled', true)
          );
        }
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      let subescalas = [];
      let currentStep = 0;

      $("#btnIniciarPrueba").click(function() {
        let pruebaId = $("#prueba_id").val();
        let pacienteId = $("#paciente_id").val();
        let tipoPrueba = $("#prueba_id option:selected").data("tipo");
        let pruebaNombre = $("#prueba_id option:selected").text();

        if (!pacienteId) {
          toastr.warning('Seleccione un paciente.', {
            timeOut: 5000
          });
          return;
        }

        if (!pruebaId) {
          toastr.warning('Seleccione una prueba.', {
            timeOut: 5000
          });
          return;
        }

        $.ajax({
          url: "/aplicar-prueba/" + pruebaId,
          method: "GET",
          success: function(data) {
            console.log(data);
            subescalas = data.subescalas;
            if (subescalas.length > 0) {
              $("#modalPrueba").modal("show");
              $("#elementoDelModal").text(subescalas.join(", "));

              iniciarPruebaCumanin(subescalas);
            } else {
              alert("Esta prueba no tiene ítems registrados.");
            }
          },
          error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tab-prueba').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: '{{ route('aplicar_prueba.index') }}',
          type: 'GET'
        },
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'paciente.nombre',
            name: 'paciente.nombre'
          },
          {
            data: 'prueba.nombre',
            name: 'prueba.nombre'
          },
          {
            data: 'fecha',
            name: 'fecha'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ]
      });

      $(document).on('click', '.ver-resultados', function() {
        let aplicacionId = $(this).data('id');

        $.ajax({
          url: '/aplicar-prueba/ver-respuestas/' + aplicacionId,
          method: 'GET',
          success: function(data) {
            $("#contenidoPrueba").html(`
                    <h5>Paciente: ${data.paciente.nombre}</h5>
                    <h5>Prueba: ${data.prueba.id}</h5>
                    <h5>Resultados: ${JSON.stringify(data.prueba.resultados)}</h5>
                    <h5>Fecha: ${data.prueba.created_at}</h5>
                `);
            $("#modalPrueba").modal("show");
          },
          error: function(xhr, status, error) {
            console.error("Error al obtener los resultados:", status, error);
          }
        });
      });
    });
  </script>

  <script>
    $(document).on('click', '.ver-resultados', function() {
      let aplicacionId = $(this).data('id');

      $.ajax({
        url: `/aplicar-prueba/ver-respuestas/${aplicacionId}`,
        method: 'GET',
        success: function(data) {
          console.log("Datos recibidos:", data);
          let resultados = data.prueba.resultados;
          let contenidoHTML = `
                <h5><strong>Paciente:</strong> ${data.paciente.nombre}</h5>
                <h5><strong>Prueba:</strong> ${data.prueba.nombre}</h5>
                <h5><strong>Fecha:</strong> ${data.prueba.fecha || 'No disponible'}</h5>
                <hr>`;

          // 📌 Verificar si la prueba es Koppitz
          if (data.prueba.nombre === "Koppitz") {
            contenidoHTML += `
                    <h5><strong>Puntaje Total:</strong> ${resultados.resultados.puntajeTotal}</h5>
                    <h5><strong>Categoría:</strong> ${resultados.resultados.categoria}</h5>
                    <h5><strong>Ítems Excepcionales:</strong> ${resultados.resultados.itemsExcepcionales}</h5>
                `;
          }
          // 📌 Verificar si la prueba es CUMANIN
          else if (data.prueba.nombre === "CUMANIN") {
            contenidoHTML += `
                    <h5><strong>Resultados:</strong></h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Subescala</th>
                                <th>Puntaje</th>
                                <th>Percentil</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>`;

            if (resultados && resultados.resultados) {
              for (let clave in resultados.resultados) {
                let resultado = resultados.resultados[clave];
                let puntaje = resultado.puntaje ?? 'N/A';
                let percentil = resultado.percentil ?? 'No disponible';
                let observaciones = resultado.observaciones ?? 'Sin observaciones';

                contenidoHTML += `
                            <tr>
                                <td><strong>${clave}</strong></td>
                                <td>${puntaje}</td>
                                <td>${percentil}</td>
                                <td>${observaciones}</td>
                            </tr>`;
              }
            } else {
              contenidoHTML +=
                `<tr><td colspan="4" style="text-align: center">No hay resultados disponibles</td></tr>`;
            }

            contenidoHTML += `
                        </tbody>
                    </table>`;
          }
          // 📌 Para otras pruebas (NO estandarizadas)
          else {
            contenidoHTML += `
                    <h5><strong>Resultados:</strong></h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ítem</th>
                                <th>Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>`;

            if (resultados && resultados.resultados) {
              for (let subescala in resultados.resultados) {
                let respuestas = resultados.resultados[subescala].respuestas;
                let observaciones = resultados.resultados[subescala].observaciones ?? 'Sin observaciones';

                if (respuestas) {
                  for (let item in respuestas) {
                    let respuesta = respuestas[item];
                    contenidoHTML += `
                                    <tr>
                                        <td><strong>${item}</strong></td>
                                        <td>${respuesta}</td>
                                    </tr>`;
                  }
                }

                // Agregar observaciones de la subescala
                contenidoHTML += `
                            <tr>
                                <td colspan="2"><strong>Observaciones ${subescala}:</strong> ${observaciones}</td>
                            </tr>`;
              }
            } else {
              contenidoHTML +=
                `<tr><td colspan="2" style="text-align: center">No hay respuestas disponibles</td></tr>`;
            }

            contenidoHTML += `
                        </tbody>
                    </table>`;
          }

          if (resultados.lateralidad) {
            contenidoHTML += `<h5><strong>Lateralidad:</strong> ${resultados.lateralidad}</h5>`;
          }

          // Cerrar el modal de prueba antes de abrir el de ver resultados
          $("#modalPrueba").modal("hide");

          // Inyectar el contenido en el modal
          $("#contenidoPruebaVer").html(contenidoHTML);
          $("#modalPruebaVer").modal("show");
        },
        error: function(xhr, status, error) {
          console.error("❌ Error al obtener los resultados:", status, error);
          alert("No se encontraron resultados para esta prueba.");
        }
      });
    });
  </script>
@endsection
