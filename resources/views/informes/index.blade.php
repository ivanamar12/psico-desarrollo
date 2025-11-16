@extends('layouts.root')

@section('title', 'Informes Psicológicos')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Informes Psicológicos" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <article class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('generar informes'))
              <li><a href="#new-informe" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>

          <section id="myTabContent" class="tab-content">
            <!-- Pestaña Lista -->
            <section class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-informes">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Paciente</th>
                      <th style="text-align: center">Fecha</th>
                      <th style="text-align: center">Especialista</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </section>

            <!-- Pestaña Nuevo -->
            <section class="tab-pane fade" id="new-informe">
              <article class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-informes">
                      @csrf
                      <section id="paso1">
                        <h3>I. Datos de identificación</h3>
                        <div class="fila-formulario row">

                          <!-- Paciente -->
                          <div class="form-group col-md-6">
                            <label>Paciente <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="paciente_id" name="paciente_id">
                              <option selected disabled>Buscar paciente - Nombre + Código de historia</option>
                            </select>
                            <small class="form-text text-muted">
                              Este listado incluye únicamente pacientes que han completado mínimo 3 pruebas aplicadas y
                              registro de historia clínica.
                            </small>
                          </div>

                          <!-- Especialista -->
                          <div class="form-group col-md-6">
                            <label>Especialista Responsable <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly
                              value="{{ $especialista_actual ? $especialista_actual->nombre . ' ' . $especialista_actual->apellido . ' - FVP: ' . $especialista_actual->fvp : 'No asignado' }}">

                            <input type="hidden" name="especialista_id"
                              value="{{ $especialista_actual ? $especialista_actual->id : '' }}">
                            <small class="form-text text-muted">
                              Este especialista ha sido asignado automáticamente por el sistema.
                            </small>
                          </div>
                        </div>

                        <p class="text-center mt-3">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>

                      <section id="paso2">
                        <h3>II. Motivo de Consulta</h3>

                        <div class="form-group col-md-12">
                          <p class="text-muted mb-4" id="motivo_completo_texto">
                            Seleccione un paciente para ver la información...
                          </p>
                          <label>Motivo <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="motivo" name="motivo" rows="3" required minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Redacte para el informe el motivo de la evaluacion.
                          </small>
                        </div>

                        <!-- Botones centrados -->
                        <div class="text-center mt-4">
                          <button type="button" id="regresar1" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente2" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </div>
                      </section>

                      <section id="paso3">
                        <h3>III. Instrumentos y Recursos</h3>

                        <div class="form-group col-md-12">
                          <h4>Instrumentos</h4>
                          <p class="text-muted mb-4" id="instrumentos_texto">
                            Seleccione un paciente para ver la información...
                          </p>
                          <label>Instrumentos <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="instrumentos" name="instrumentos" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Redacte para el informe el como se aplicaron los instrumentos.
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <h4>Recursos</h4>
                          <p class="text-muted mb-4" id="recursos_texto">
                            Seleccione un paciente para ver la información...
                          </p>
                          <label>Recursos <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="recursos" name="recursos" rows="3" required minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Redacte para el informe como se aplicaron los recursos.
                          </small>
                        </div>

                        <!-- Botones centrados -->
                        <div class="text-center mt-4">
                          <button type="button" id="regresar2" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente3" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </div>
                      </section>

                      <section id="paso4">
                        <div class="form-group col-md-12">
                          <h3>IV. Consideraciones Generales</h3>
                        </div>

                        <div class="form-group col-md-12 text-right mb-4">
                          <button type="button" id="btnModalHistoria" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-file-text"></i> Ver Historia Clínica
                          </button>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Consideraciones Generales <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="condiciones_generales" name="condiciones_generales" rows="3" required
                            minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Redacte para el informe las consideraciones generales del paciente en la evaluación.
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <h3>V. Resultados por Área</h3>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Física y Salud <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="fisica_salud" name="fisica_salud" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa cómo está la salud física del paciente (ejemplo: talla, peso, enfermedades, etc.)
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Perceptivo Motriz <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="perceptivo_motriz" name="perceptivo_motriz" rows="3" required
                            minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa cómo el paciente ve, escucha y se mueve (ejemplo: coordinación, uso de las manos,
                            etc.)
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Coeficiente Intelectual <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="coeficiente_intelectual" name="coeficiente_intelectual" rows="3" required
                            minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa cómo piensa y aprende el paciente (ejemplo: cómo resuelve problemas, memoria, etc.)
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Afectiva Social <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="afectiva_social" name="afectiva_social" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa cómo el paciente se relaciona con otros (ejemplo: si es tímido, cómo controla sus
                            emociones, etc.)
                          </small>
                        </div>

                        <!-- Botones centrados -->
                        <div class="text-center mt-4">
                          <button type="button" id="regresar3" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente4" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </div>
                      </section>

                      <section id="paso5">
                        <h3>VI. Conclusiones</h3>

                        <div class="form-group col-md-12">
                          <label>Conclusiones <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="conclusion" name="conclusion" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">Redacte las conclusiones generales del informe basadas en
                            los hallazgos.</small>
                        </div>

                        <div class="text-center mt-4">
                          <button type="button" id="regresar4" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="button" id="siguiente5" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </div>
                      </section>

                      <section id="paso6">
                        <h3>VII. Recomendaciones</h3>

                        <div class="form-group col-md-12">
                          <label>Recomendaciones <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="recomendaciones" name="recomendaciones" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">Redacte las recomendaciones específicas para el paciente
                            basadas en los hallazgos.</small>
                        </div>

                        <div class="text-center mt-4">
                          <button type="button" id="regresar5" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" class="btn btn-regresar" style="color: white;">
                            Finalizar y Guardar Informe
                          </button>
                        </div>
                      </section>
                    </form>
                  </div>
                </div>
              </article>
            </section>
          </section>
        </div>
      </div>
    </article>
  </section>

  <!-- Modal Historia Clínica -->
  <section class="modal fade" id="modalHistoriaClinica" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 90%;">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Historia Clínica</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe id="pdf-viewer" class="embed-responsive-item" src="" style="border: none;"></iframe>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal confirmación eliminación -->
  <section class="modal fade" id="modalEliminarInforme" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Eliminar Informe</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: center">¿Estás seguro que deseas eliminar este informe?</p>
          <form id="formEliminarInforme">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="informe_id">
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>

  <script>
    $(function() {
      const pacientes = @json($pacientes);
      const aplicaciones = @json($aplicaciones);

      $('#paciente_id').select2({
        placeholder: 'Escriba para buscar paciente...',
        allowClear: true,
        data: pacientes.map(p => {
          const historia = p.historia_clinicas?.[0] || null;
          const pruebasCount = aplicaciones[p.id] ? aplicaciones[p.id].length : 0;

          return {
            id: p.id,
            text: `${p.nombre} ${p.apellido} | Código: ${historia ? historia.codigo : 'N/A'} | Pruebas: ${pruebasCount}`,
          };
        })
      });

      $('#paciente_id').on('select2:select', function(e) {
        const pacienteId = e.params.data.id;
        const historia = e.params.data.historia;
        const paciente = pacientes.find(p => p.id === pacienteId);

        // Motivo de consulta
        const motivo = historia?.motivo || 'sin motivo';
        const referencia = historia?.referencia || 'sin referencia';
        const especialista = historia?.especialista_refirio || 'no especificado';
        $('#motivo_completo_texto').text(
          `Motivo: ${motivo}. Referido por: ${especialista}. Referencia: ${referencia}.`);

        // Instrumentos y Recursos
        const pruebasPaciente = aplicaciones[pacienteId] || [];
        let estructuradas = 0;
        let noEstructuradas = 0;
        let recursosTexto = '';

        pruebasPaciente.forEach(ap => {
          const prueba = ap.prueba;
          if (!prueba) return;
          if (prueba.tipo === 'Estandarizada') estructuradas++;
          else if (prueba.tipo === 'NO-Estandarizada') noEstructuradas++;
          recursosTexto += `• ${prueba.nombre} (${prueba.tipo})\n`;
        });

        $('#instrumentos_texto').text(
          `Se aplicaron ${estructuradas} pruebas Estandarizadas y ${noEstructuradas} NO-Estandarizadas.`);
        $('#recursos_texto').text(recursosTexto.trim());
      });

      $('#paciente_id').on('select2:clear', function() {
        $('#motivo_completo_texto').text('Seleccione un paciente para ver la información...');
        $('#instrumentos_texto').text('Seleccione un paciente para ver la información...');
        $('#recursos_texto').text('Seleccione un paciente para ver la información...');
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      var tablaInformes = $('#tab-informes').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('informes.index') }}",
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'paciente.nombre',
            name: 'paciente.nombre',
            render: function(data, type, row) {
              return row.paciente.nombre + ' ' + row.paciente.apellido;
            }
          },
          {
            data: 'created_at',
            name: 'created_at'
          },
          {
            data: 'especialista.nombre',
            name: 'especialista.nombre',
            render: function(data, type, row) {
              return row.especialista.nombre + ' ' + row.especialista.apellido;
            }
          },
          {
            data: 'action',
            orderable: false,
            searchable: false,
          }
        ],
      });

      $('#registro-informes').submit(function(e) {
        e.preventDefault();

        // Validar todos los pasos antes de enviar
        let allValid = true;
        for (let i = 1; i <= 7; i++) {
          if (!validarPaso("#paso" + i)) {
            allValid = false;
            // Mostrar el paso con errores
            $("#paso1, #paso2, #paso3, #paso4, #paso5, #paso6, #paso7").hide();
            $("#paso" + i).show();
            toastr.error("Por favor complete correctamente el paso " + i);
            break;
          }
        }

        if (!allValid) return;

        const submitButton = $(this).find('button[type="submit"]');
        const originalText = submitButton.html();
        submitButton.prop('disabled', true).html('<i class="zmdi zmdi-spinner zmdi-hc-spin"></i> Guardando...');

        $.ajax({
          url: "{{ route('informes.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#registro-informes')[0].reset();

              $('#paciente_id').val(null).trigger('change');

              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });

              tablaInformes.ajax.reload();

              $('.nav-tabs a[href="#list"]').tab('show');

              $("#paso1").show();
              $("#paso2, #paso3, #paso4, #paso5, #paso6, #paso7").hide();
            }
          },
          error: function(xhr) {
            if (xhr.status === 422) {
              const errors = xhr.responseJSON.errors;
              for (const field in errors) {
                errors[field].forEach(error => {
                  toastr.error(error, 'Error', {
                    timeOut: 5000
                  });
                });
              }
            } else {
              toastr.error('Ocurrió un error al guardar el informe', 'Error');
            }
          },
          complete: function() {
            submitButton.prop('disabled', false).html(originalText);
          }
        });
      });

      $(document).on('click', '.btn-eliminar-informe', function() {
        const id = $(this).data('id');
        $('#informe_id').val(id);
        $('#modalEliminarInforme').modal('show');
      });

      // Eliminar informe
      $('#formEliminarInforme').submit(function(e) {
        e.preventDefault();
        var id = $('#informe_id').val();

        $.ajax({
          url: '/informes/' + id,
          type: 'POST',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'DELETE'
          },
          success: function(response) {
            if (response.success) {
              $('#modalEliminarInforme').modal('hide');
              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaInformes.ajax.reload();
            } else {
              toastr.error(response.message, 'Error', {
                timeOut: 5000
              });
            }
          },
          error: function(xhr) {
            let errorMsg = 'Error al procesar la solicitud';
            if (xhr.responseJSON && xhr.responseJSON.message) {
              errorMsg = xhr.responseJSON.message;
            }
            toastr.error(errorMsg, 'Error', {
              timeOut: 5000
            });
          }
        });
      });

      $("#paso1").show();
      $("#paso2, #paso3, #paso4, #paso5, #paso6").hide();

      function setupRealTimeValidation(pasoId) {
        $(`${pasoId} :input[type="text"], ${pasoId} :input[type="textarea"]`).on('input', function() {
          const maxLength = 50;
          const currentValue = $(this).val();
          if (currentValue.length > maxLength) {
            $(this).val(currentValue.substring(0, maxLength));
            toastr.error(
              `El campo ${$(this).attr("name")} no debe superar los ${maxLength} caracteres.`);
          }
        });
      }

      setupRealTimeValidation("#paso1");
      setupRealTimeValidation("#paso2");
      setupRealTimeValidation("#paso3");
      setupRealTimeValidation("#paso4");
      setupRealTimeValidation("#paso5");
      setupRealTimeValidation("#paso6");

      function validarPaso(pasoId) {
        let valid = true;
        $(`${pasoId} :input[required]`).each(function() {
          const value = $(this).val();
          const fieldName = $(this).attr('name');

          // Validar si está vacío
          if (value === '' || value === null) {
            $(this).addClass("is-invalid");
            toastr.warning(`El campo ${fieldName} es requerido.`);
            valid = false;
            return;
          }

          // Validar textarea (mínimo y máximo)
          if ($(this).is('textarea')) {
            const minLength = 30;
            const maxLength = 1000;

            if (value.length < minLength) {
              $(this).addClass("is-invalid");
              toastr.warning(`El campo ${fieldName} debe tener al menos ${minLength} caracteres.`);
              valid = false;
            } else if (value.length > maxLength) {
              $(this).addClass("is-invalid");
              toastr.warning(`El campo ${fieldName} no debe superar los ${maxLength} caracteres.`);
              valid = false;
            } else {
              $(this).removeClass("is-invalid");
            }
          } else {
            $(this).removeClass("is-invalid");
          }
        });

        return valid;
      }

      $("#siguiente1").click(function() {
        if (validarPaso("#paso1")) {
          $("#paso1").hide();
          $("#paso2").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 1.");
        }
      });

      $("#siguiente2").click(function() {
        if (validarPaso("#paso2")) {
          $("#paso2").hide();
          $("#paso3").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 2.");
        }
      });

      $("#siguiente3").click(function() {
        if (validarPaso("#paso3")) {
          $("#paso3").hide();
          $("#paso4").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 3.");
        }
      });

      $("#siguiente4").click(function() {
        if (validarPaso("#paso4")) {
          $("#paso4").hide();
          $("#paso5").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 4.");
        }
      });

      $("#siguiente5").click(function() {
        if (validarPaso("#paso5")) {
          $("#paso5").hide();
          $("#paso6").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 5.");
        }
      });

      // Botones de regresar
      $("#regresar1").click(function() {
        $("#paso2").hide();
        $("#paso1").show();
      });

      $("#regresar2").click(function() {
        $("#paso3").hide();
        $("#paso2").show();
      });

      $("#regresar3").click(function() {
        $("#paso4").hide();
        $("#paso3").show();
      });

      $("#regresar4").click(function() {
        $("#paso5").hide();
        $("#paso4").show();
      });

      $("#regresar5").click(function() {
        $("#paso6").hide();
        $("#paso5").show();
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#btnModalHistoria').click(function() {
        const pacienteId = $('#paciente_id').val();

        if (pacienteId) {
          const pdfUrl = "{{ route('informes.pdf-historia', ['pacienteId' => 'PLACEHOLDER']) }}".replace(
            'PLACEHOLDER', pacienteId);

          $('#pdf-viewer').attr('src', pdfUrl);

          $('#modalHistoriaClinica').modal('show');
        } else {
          toastr.error('Debe seleccionar un paciente primero');
        }
      });

      $('#modalHistoriaClinica').on('hidden.bs.modal', function() {
        $('#pdf-viewer').attr('src', '');
      });

      // Contador de caracteres para todos los textarea
      $('textarea').on('input', function() {
        const currentLength = $(this).val().length;
        const maxLength = $(this).attr('maxlength');
        const counterId = `${$(this).attr('id')}-counter`;

        $(`#${counterId}`).text(`${currentLength}/${maxLength}`);

        if (currentLength > maxLength) {
          $(`#${counterId}`).addClass('text-danger');
        } else {
          $(`#${counterId}`).removeClass('text-danger');
        }
      });

      // Inicializar contadores
      $('textarea').each(function() {
        const maxLength = $(this).attr('maxlength');
        $(this).after(
          `<div class="text-right text-muted"><span id="${$(this).attr('id')}-counter">0</span> caracteres</div>`
        );
      });
    });
  </script>

@endsection
