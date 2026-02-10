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
          <div style="width: 100%; display: flex; justify-content: end">
            <button type="button" class="no-shadow-on-click" data-dismiss="modal"
              style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
            Aplicación de la prueba
          </h3>
        </div>

        <div class="modal-body">
          <!-- Barra de progreso -->
          <div class="progress" style="height: 20px;">
            <div id="barraProgreso" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
              aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div id="progresoTexto" style="text-align: center"></div>

          <div id="contenidoPrueba"></div>
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
          <div style="width: 100%; display: flex; justify-content: end">
            <button type="button" class="no-shadow-on-click" data-dismiss="modal"
              style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
            Resultados de la prueba
          </h3>
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

  <script>
    const pacientes = @json($pacientes);
    const pruebas = @json($pruebas);
  </script>

  {{-- Script para los selects --}}
  <script>
    $(document).ready(function() {
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

  {{-- Mostrar prueba seleccionada --}}
  <script>
    $(document).ready(function() {
      let subescalas = [];
      let currentStep = 0;

      $("#btnIniciarPrueba").click(function() {
        let pruebaId = $("#prueba_id").val();
        let pacienteId = $("#paciente_id").val();

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

        // Buscar la prueba en los datos que ya estan en la vista
        const pruebaSeleccionada = pruebas.find(p => p.id == pruebaId);

        if (!pruebaSeleccionada) {
          toastr.error('Prueba no encontrada.');
          return;
        }

        // Acceder directamente a las subescalas
        const subescalas = pruebaSeleccionada.subescalas;

        if (subescalas && subescalas.length > 0) {
          $("#modalPrueba").modal("show");
          iniciarPrueba(subescalas);
        } else {
          toastr.warning('Esta prueba no tiene ítems registrados.', {
            timeOut: 5000
          });
        }
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
          url: "{{ route('aplicar-prueba.index') }}",
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
    });
  </script>

  <script>
    $(document).ready(function() {
      let subescalas = [];
      let respuestasTotales = {};
      let currentStep = 0;
      let tipoPrueba = "";
      let nombrePrueba = "";

      function sanitizarNombreSubescala(nombre) {
        return nombre.replace(/[^a-zA-Z0-9]/g, "_").toLowerCase();
      }

      function iniciarPrueba(subescalasData, tipo, nombre) {
        subescalas = subescalasData.filter(
          (subescala) => subescala.items && subescala.items.length > 0
        );
        tipoPrueba = tipo;
        nombrePrueba = nombre;

        if (subescalas.length === 0) {
          toastr.error('No hay subescalas con ítems disponibles.', "Error", {
            timeOut: 5000,
          });
          return;
        }

        currentStep = 0;
        respuestasTotales = {};
        mostrarSubescala(currentStep);
      }

      function mostrarSubescala(step) {
        if (step < 0 || step >= subescalas.length) return;

        let subescala = subescalas[step];
        let idSanitizado = sanitizarNombreSubescala(subescala.sub_escala);

        let contenido = `<h4>${subescala.sub_escala}</h4><p>${subescala.descripcion}</p>`;

        contenido += `<table class="table table-bordered">`;
        contenido += `<thead><tr><th>Ítem</th>`;

        if (
          ["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo", ].includes(subescala.sub_escala)
        ) {
          contenido += `<th>Lateralidad</th>`;
        }

        if (subescala.sub_escala === "Atencion" || subescala.sub_escala === "Fluidez Verbal") {
          contenido += `<th>Valor</th>`;
        }

        contenido += `<th>Respuesta</th></tr></thead><tbody>`;

        subescala.items.forEach((item) => {
          let respuestaGuardada = respuestasTotales[subescala.sub_escala]?.respuestas?.[item.item] || "";
          let lateralidadGuardada = respuestasTotales[subescala.sub_escala]?.lateralidad?.[item.item] || [];

          contenido += `<tr><td>${item.item}</td>`;

          if (
            ["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)
          ) {
            contenido += `<td>
                <label>Derecha <input type="checkbox" name="lateralidad_${item.id}"
                  value="derecha" ${lateralidadGuardada.includes("derecha") ? "checked" : ""} required></label>
                <label>Izquierda <input type="checkbox" name="lateralidad_${item.id}"
                  value="izquierda" ${lateralidadGuardada.includes("izquierda") ? "checked" : ""} required></label>
              </td>`;
          }

          if (subescala.sub_escala === "Atencion" || subescala.sub_escala === "Fluidez Verbal") {
            contenido +=
              `<td><input class="form-control input-numerico" type="number" name="respuesta_${item.id}" min="0" value="${respuestaGuardada}" required></td>`;
          } else {
            contenido += `<td>
                <label>Sí <input type="radio" name="respuesta_${item.id}" value="si" ${respuestaGuardada === "si" ? "checked" : ""} required></label>
                <label>No <input type="radio" name="respuesta_${item.id}" value="no" ${respuestaGuardada === "no" ? "checked" : ""} required></label>
              </td>`;
          }

          contenido += `</tr>`;
        });

        contenido += `</tbody></table>`;

        // Agregar campo de observaciones con ID sanitizado
        let observacionesGuardadas = respuestasTotales[subescala.sub_escala]?.observaciones || "";
        contenido += `<div class="form-group">
            <label for="observaciones_${idSanitizado}">Observaciones: <span class="text-danger">*</span></label>
            <textarea class="form-control observaciones" id="observaciones_${idSanitizado}" name="observaciones_${idSanitizado}" rows="3" required>${observacionesGuardadas}</textarea>
          </div>`;

        $("#contenidoPrueba").html(contenido);
        actualizarBotones(step);
      }

      function actualizarBotones(step) {
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescalas.length - 1);
        $("#btnFinalizar").toggle(step === subescalas.length - 1);

        // Actualizar barra de progreso
        let progreso = ((step + 1) / subescalas.length) * 100;
        $("#barraProgreso")
          .css("width", progreso + "%")
          .attr("aria-valuenow", progreso);
        $("#progresoTexto").text(`Paso ${step + 1} de ${subescalas.length}`);
      }

      function validarTodosLosCampos() {
        let subescala = subescalas[currentStep];
        let todosCompletos = true;
        let mensajesError = [];

        // Validar campo de observaciones
        let idSanitizado = sanitizarNombreSubescala(subescala.sub_escala);
        let campoObservaciones = $(`#observaciones_${idSanitizado}`);

        if (campoObservaciones.length > 0) {
          let observaciones = campoObservaciones.val().trim();
          if (!observaciones) {
            mensajesError.push("Las observaciones son obligatorias");
            todosCompletos = false;
            campoObservaciones.addClass('is-invalid');
          } else {
            campoObservaciones.removeClass('is-invalid');
          }
        }

        // Validar inputs de tipo radio (Sí/No)
        $(`input[type=radio][name^="respuesta_"]`).each(function() {
          let name = $(this).attr('name');
          let checked = $(`input[name="${name}"]:checked`).length > 0;

          if (!checked) {
            let itemId = name.split('_')[1];
            let itemNombre = subescala.items.find((i) => i.id == itemId)?.item;
            mensajesError.push(`El ítem "${itemNombre}" requiere una respuesta (Sí/No)`);
            todosCompletos = false;
            $(`input[name="${name}"]`).closest('td').addClass('bg-danger');
          } else {
            $(`input[name="${name}"]`).closest('td').removeClass('bg-danger');
          }
        });

        // Validar inputs numéricos (Atención, Fluidez Verbal)
        $(`input[type=number].input-numerico`).each(function() {
          let valor = $(this).val().trim();
          if (valor === '' || isNaN(valor)) {
            let name = $(this).attr('name');
            let itemId = name.split('_')[1];
            let itemNombre = subescala.items.find((i) => i.id == itemId)?.item;
            mensajesError.push(`El ítem "${itemNombre}" requiere un valor numérico`);
            todosCompletos = false;
            $(this).addClass('is-invalid');
          } else {
            $(this).removeClass('is-invalid');
          }
        });

        // Validar checkboxes de lateralidad (si aplica)
        if (["Psicomotricidad", "Escritura", "Estructuración espacial", "Ritmo"].includes(subescala.sub_escala)) {
          $(`input[type=checkbox][name^="lateralidad_"]`).each(function() {
            let name = $(this).attr('name');
            let checked = $(`input[name="${name}"]:checked`).length > 0;

            if (!checked) {
              let itemId = name.split('_')[1];
              let itemNombre = subescala.items.find((i) => i.id == itemId)?.item;
              mensajesError.push(`El ítem "${itemNombre}" requiere seleccionar lateralidad (Derecha/Izquierda)`);
              todosCompletos = false;
              $(this).closest('td').addClass('bg-danger');
            } else {
              $(this).closest('td').removeClass('bg-danger');
            }
          });
        }

        // Mostrar errores si los hay
        if (!todosCompletos) {
          let mensajeUnico = mensajesError.length > 0 ? mensajesError[0] : 'Complete todos los campos requeridos';
          toastr.error(mensajeUnico, "Campos incompletos", {
            timeOut: 5000,
          });

          // Si hay múltiples errores, mostrar en consola para debug
          if (mensajesError.length > 1) {
            console.log("Todos los errores:", mensajesError);
          }
        }

        return todosCompletos;
      }

      function guardarRespuestasActuales() {
        let respuestas = {};
        let lateralidad = {};
        let observaciones = "";
        let subescala = subescalas[currentStep];

        let esCumanin = nombrePrueba === "CUMANIN";

        $(`input[type=radio]:checked`).each(function() {
          let name = $(this).attr("name");
          let itemId = name.split("_")[1];
          let itemNombre = subescala.items.find((i) => i.id == itemId)?.item;

          if (!esCumanin && itemNombre) {
            respuestas[itemNombre] = $(this).val();
          } else {
            respuestas[`respuesta_${itemId}`] = $(this).val();
          }
        });

        $(`input[name^='lateralidad_']`).each(function() {
          let itemId = $(this).attr("name").split("_")[1];
          let itemNombre = subescala.items.find((i) => i.id == itemId)?.item;

          if (!lateralidad[itemNombre]) {
            lateralidad[itemNombre] = [];
          }
          if ($(this).is(":checked")) {
            lateralidad[itemNombre].push($(this).val());
          }
        });

        $(`input[type=number]`).each(function() {
          let name = $(this).attr("name");
          let itemId = name.split("_")[1];
          let itemNombre = subescala.items.find((i) => i.id == itemId)?.item;

          if (!esCumanin && itemNombre) {
            respuestas[itemNombre] = $(this).val();
          } else {
            respuestas[`respuesta_${itemId}`] = $(this).val();
          }
        });

        // Guardar observaciones con ID sanitizado
        let idSanitizado = sanitizarNombreSubescala(subescala.sub_escala);
        let campoObservaciones = $(`#observaciones_${idSanitizado}`);
        if (campoObservaciones.length > 0) {
          observaciones = campoObservaciones.val().trim();
        }

        respuestasTotales[subescala.sub_escala] = {
          respuestas: respuestas,
          lateralidad: lateralidad,
          observaciones: observaciones,
        };
      }

      $("#btnSiguiente").click(function() {
        if (validarTodosLosCampos()) {
          guardarRespuestasActuales();
          currentStep++;
          mostrarSubescala(currentStep);
        }
      });

      $("#btnAnterior").click(function() {
        if (validarTodosLosCampos()) {
          guardarRespuestasActuales();
          currentStep--;
          mostrarSubescala(currentStep);
        }
      });

      $("#btnFinalizar")
        .off("click")
        .on("click", function() {
          if (validarTodosLosCampos()) {
            guardarRespuestasActuales();

            $("#btnFinalizar").prop('disabled', true).html(
              '<i class="zmdi zmdi-spinner zmdi-hc-spin"></i> Guardando...');

            $.ajax({
              url: "{{ route('aplicar-prueba.store') }}",
              method: "POST",
              data: {
                paciente_id: $("#paciente_id").val(),
                prueba_id: $("#prueba_id").val(),
                respuestas: respuestasTotales,
                _token: $('meta[name="csrf-token"]').attr("content"),
              },
              success: function(response) {
                $("#modalPrueba").modal("hide");

                if (response.success) {
                  $("#formAplicarPrueba")[0].reset();
                  $("#paciente_id").val(null).trigger("change");
                  $("#prueba_id").val(null).trigger("change");
                  $("#prueba-container").hide();
                  $("#prueba_id").prop('disabled', true);

                  toastr.success(response.message || "Prueba guardada exitosamente", "Éxito", {
                    timeOut: 5000,
                  });

                  $('#tab-prueba').DataTable().ajax.reload();
                  $('.nav-tabs a[href="#list"]').tab("show");
                  $("#btnFinalizar").prop('disabled', false).html('Finalizar');

                  subescalas = [];
                  respuestasTotales = {};
                  currentStep = 0;
                } else {
                  // Manejar caso donde el servidor no devuelve success=true
                  toastr.error(response.message || "Error al guardar la prueba", "Error", {
                    timeOut: 5000,
                  });
                }
              },
              error: function(xhr, status, error) {
                if (xhr.status === 422) {
                  const errors = xhr.responseJSON.errors;
                  for (const field in errors) {
                    errors[field].forEach((errorMsg) => {
                      toastr.error(errorMsg, "Error de validación", {
                        timeOut: 5000,
                      });
                    });
                  }
                } else if (xhr.status === 500) {
                  toastr.error(xhr.responseJSON.error || "Error interno del servidor", "Error", {
                    timeOut: 5000,
                  });
                } else {
                  toastr.error("Ocurrió un error al guardar la prueba: " + error, "Error", {
                    timeOut: 5000,
                  });
                }

                $("#btnFinalizar").prop('disabled', false).html('Finalizar');
                $('#tab-prueba').DataTable().ajax.reload();
              },
            });
          }
        });

      window.iniciarPrueba = iniciarPrueba;
    });
  </script>

  <script>
    $(document).on('click', '.ver-resultados', function() {
      let aplicacionId = $(this).data('id');

      function interpretarPercentil(percentil) {
        if (percentil === 'No disponible') return 'Sin datos';
        const p = parseInt(percentil);
        if (p >= 75) return 'Superior';
        if (p >= 25) return 'Normal';
        return 'Inferior';
      }

      $.ajax({
        url: `/aplicar-prueba/${aplicacionId}`,
        method: 'GET',
        success: function(data) {
          let aplicacion_prueba = data.aplicacion_prueba;
          let paciente = aplicacion_prueba.paciente;
          let prueba = aplicacion_prueba.prueba;
          let resultados_finales = aplicacion_prueba.resultados_finales;

          let contenidoHTML = `
            <h5><strong>Paciente:</strong> ${paciente.nombre} ${paciente.apellido}</h5>
            <h5><strong>Prueba:</strong> ${prueba.nombre}</h5>
            <h5><strong>Fecha:</strong> ${aplicacion_prueba.created_at_formatted || 'No disponible'}</h5>
            <hr>`;

          if (prueba.nombre === "Koppitz") {
            contenidoHTML += `
              <h5><strong>Puntaje Total:</strong> ${resultados_finales.resultados.puntajeTotal}</h5>
              <h5><strong>Items Esperados:</strong> ${resultados_finales.resultados.itemsEsperados}</h5>
              <h5><strong>Items Excepcionales:</strong> ${resultados_finales.resultados.itemsExcepcionales}</h5>
              <h5><strong>Categoría:</strong> ${resultados_finales.resultados.categoria}</h5>
              <hr>
              <h5><strong>Detalles por Ítem:</strong></h5>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Ítem</th>
                    <th>Tipo</th>
                    <th>Respuesta</th>
                    <th>Correcto</th>
                    <th>Rango Edad</th>
                  </tr>
                </thead>
                <tbody>`;

            for (let item in resultados_finales.resultados.detallesPuntaje) {
              let detalle = resultados_finales.resultados.detallesPuntaje[item];
              contenidoHTML += `
                <tr>
                  <td>${item}</td>
                  <td>${detalle.tipo}</td>
                  <td>${detalle.respuesta}</td>
                  <td>${detalle.correcto ? '✅' : '❌'}</td>
                  <td>${detalle.edad_rango}</td>
                </tr>`;
            }

            contenidoHTML += `</tbody></table>`;
          } else if (prueba.nombre === "Bender") {
            contenidoHTML += `
              <h5><strong>Resultados Bender - Edad: ${aplicacion_prueba.resultados_finales.edad_meses} meses</strong></h5>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Indicador</th>
                    <th>Valor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Puntaje de Desarrollo</strong></td>
                    <td>${resultados_finales.resultados.puntaje_desarrollo}</td>
                  </tr>
                  <tr>
                    <td><strong>Indicadores Significativos</strong></td>
                    <td>${resultados_finales.resultados.indicadores_significativos}</td>
                  </tr>
                  <tr>
                    <td><strong>Altamente Significativos</strong></td>
                    <td>${resultados_finales.resultados.altamente_significativos}</td>
                  </tr>
                  <tr>
                    <td><strong>Puntaje de Daño Cerebral</strong></td>
                    <td>${resultados_finales.resultados.puntaje_dano_cerebral}</td>
                  </tr>
                </tbody>
              </table>`;

            if (resultados_finales.resultados.detalles_items && resultados_finales.resultados.detalles_items.length > 0) {
              contenidoHTML += `
                <h5><strong>Detalles por Figura:</strong></h5>`;

              // Agrupar ítems por subescala
              let itemsPorSubescala = {};
              resultados_finales.resultados.detalles_items.forEach(detalle => {
                if (!itemsPorSubescala[detalle.subescala]) {
                  itemsPorSubescala[detalle.subescala] = [];
                }
                itemsPorSubescala[detalle.subescala].push(detalle);
              });

              // Crear tabla para cada subescala
              for (let subescala in itemsPorSubescala) {
                let items = itemsPorSubescala[subescala];
                let observacionSubescala = resultados_finales.resultados.observaciones_por_subescala[subescala] || 'Sin observaciones';

                contenidoHTML += `
                  <h6><strong>${subescala}</strong></h6>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Ítem</th>
                        <th>Respuesta</th>
                        <th>Tipo</th>
                      </tr>
                    </thead>
                    <tbody>`;

                items.forEach(detalle => {
                  let tipo = '';
                  if (detalle.es_altamente_significativo) tipo = 'Altamente Significativo';
                  else if (detalle.es_indicador_significativo) tipo = 'Indicador Significativo';

                  contenidoHTML += `
                    <tr>
                      <td>${detalle.item}</td>
                      <td>${detalle.respuesta}</td>
                      <td>${tipo}</td>
                    </tr>`;
                });

                contenidoHTML += `</tbody></table>`;
                contenidoHTML += `<p><strong>Observaciones:</strong> ${observacionSubescala}</p><hr>`;
              }
            }
          } else if (prueba.nombre === "CUMANIN") {
            contenidoHTML += `
              <h5><strong>Resultados CUMANIN - Edad: ${aplicacion_prueba.resultados_finales.edad_meses} meses</strong></h5>
              <h5><strong>Lateralidad: ${aplicacion_prueba.resultados_finales.lateralidad || 'No definida'}</strong></h5>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Subescala</th>
                    <th>Puntaje Bruto</th>
                    <th>Percentil</th>
                    <th>Interpretación</th>
                    <th>Observaciones</th>
                  </tr>
                </thead>
                <tbody>`;

            if (aplicacion_prueba.resultados_finales.resultados) {
              for (let clave in aplicacion_prueba.resultados_finales.resultados) {
                let resultado = aplicacion_prueba.resultados_finales.resultados[clave];
                let puntaje = resultado.puntaje ?? 'N/A';
                let percentil = resultado.percentil ?? 'No disponible';
                let interpretacion = interpretarPercentil(percentil);
                let observaciones = resultado.observaciones ?? 'Sin observaciones';

                contenidoHTML += `
                  <tr>
                    <td><strong>${clave}</strong></td>
                    <td>${puntaje}</td>
                    <td>${percentil}</td>
                    <td>${interpretacion}</td>
                    <td>${observaciones}</td>
                  </tr>`;
              }
            } else {
              contenidoHTML +=
                `<tr><td colspan="5" style="text-align: center">No hay resultados disponibles</td></tr>`;
            }

            contenidoHTML += `</tbody></table>`;
          } else {
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

            if (aplicacion_prueba.resultados_finales) {
              for (let subescala in aplicacion_prueba.resultados_finales) {
                let respuestas = aplicacion_prueba.resultados_finales[subescala].respuestas;
                let observaciones = aplicacion_prueba.resultados_finales[subescala].observaciones ??
                  'Sin observaciones';

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

          if (aplicacion_prueba.resultados_finales.lateralidad) {
            contenidoHTML +=
              `<h5><strong>Lateralidad:</strong> ${aplicacion_prueba.resultados_finales.lateralidad}</h5>`;
          }

          $("#modalPrueba").modal("hide");

          $("#contenidoPruebaVer").html(contenidoHTML);
          $("#modalPruebaVer").modal("show");
        },
        error: function(xhr, status, error) {
          toastr.error("No se encontraron resultados para esta prueba.", "Error", {
            timeOut: 5000,
          });
        }
      });
    });
  </script>

@endsection
