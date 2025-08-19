@extends('layouts.app')

@section('title', 'Referencias')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Referencias" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <article class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('crear referencia'))
              <li><a href="#new-referencia" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>

          <section id="myTabContent" class="tab-content">
            <!-- Pestaña Lista -->
            <section class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-referencias">
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
            <section class="tab-pane fade" id="new-referencia">
              <article class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-referencias">
                      @csrf
                      <section id="paso1">
                        <h3>I. Datos de identificación</h3>
                        <div class="form-row">

                          <!-- Paciente -->
                          <div class="form-group col-md-6">
                            <label>Paciente <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="paciente_id" name="paciente_id">
                              <option selected disabled>Seleccione el paciente</option>
                            </select>
                            <small class="form-text text-muted">Seleccione al paciente
                              registrado previamente en el sistema.</small>
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

                          <p class="text-center mt-3">
                            <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                              Siguiente
                            </button>
                          </p>
                      </section>

                      <section id="paso2">
                        <h3>II. Motivo de Consulta</h3>

                        <div class="form-group col-md-12">
                          <label>Título <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="titulo" name="titulo" rows="1" required minlength="15" maxlength="255"
                            placeholder="Ej: Referencia a Neurología"></textarea>
                          <small class="form-text text-muted">
                            Redacte el título de la referencia.
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Motivo <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="motivo" name="motivo" rows="3" required minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Redacte el motivo de la referencia.
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
                        <div class="form-group col-md-12">
                          <h3>III. Presentación del caso, Antecedentes e Indicadores psicológicos</h3>
                        </div>

                        <div class="form-group col-md-12 text-right mb-4">
                          <button type="button" id="btnModalHistoria" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-file-text"></i> Ver Historia Clínica
                          </button>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Presentación del caso <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="presentacion_caso" name="presentacion_caso" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa la presentación del caso clínico.
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Antecedentes <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="antecedentes" name="antecedentes" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa los antecedentes relevantes del paciente.
                          </small>
                        </div>

                        <div class="form-group col-md-12">
                          <label>Indicadores psicológicos <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="indicadores_psicologicos" name="indicadores_psicologicos" rows="3" required
                            minlength="30" maxlength="1000"></textarea>
                          <small class="form-text text-muted">
                            Describa los indicadores psicológicos relevantes.
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
                        <h3>IV. Sugerencias</h3>

                        <div class="form-group col-md-12">
                          <label>Sugerencias <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="sugerencias" name="sugerencias" rows="3" required minlength="30"
                            maxlength="1000"></textarea>
                          <small class="form-text text-muted">Redacte las sugerencias específicas para el
                            paciente.</small>
                        </div>

                        <div class="text-center mt-4">
                          <button type="button" id="regresar3" class="btn btn-regresar mr-3" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" class="btn btn-regresar" style="color: white;">
                            Finalizar y Guardar Referencia
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
  <section class="modal fade" id="modalEliminarReferencia" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Eliminar Referencia</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: center">¿Estás seguro que deseas eliminar esta referencia?</p>
          <form id="formEliminarReferencia">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="referencia_id">
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
  <script>
    $(function() {
      const pacientes = @json($pacientes);

      $('#paciente_id').select2({
        placeholder: 'Seleccione paciente',
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
          transport: function(params, success) {
            console.log(params)
            const term = (params.data.term || '').toLowerCase().trim();

            const results = pacientes.map(p => {
              const historia = p.historia_clinicas?.[0] || null;
              return {
                id: p.id,
                text: `${p.nombre} ${p.apellido} - Código: ${historia ? historia.codigo : 'Sin historia'}`,
                historia: historia
              };
            });

            success({
              results
            });
          }
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      var tablaReferencias = $('#tab-referencias').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('referencias.index') }}",
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

      $('#registro-referencias').submit(function(e) {
        e.preventDefault();

        // Validar todos los pasos antes de enviar
        let allValid = true;
        for (let i = 1; i <= 4; i++) {
          if (!validarPaso("#paso" + i)) {
            allValid = false;
            // Mostrar el paso con errores
            $("#paso1, #paso2, #paso3, #paso4").hide();
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
          url: "{{ route('referencias.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#registro-referencias')[0].reset();

              $('#paciente_id').val(null).trigger('change');

              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });

              tablaReferencias.ajax.reload();

              $('.nav-tabs a[href="#list"]').tab('show');

              $("#paso1").show();
              $("#paso2, #paso3, #paso4").hide();
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
              toastr.error('Ocurrió un error al guardar la referencia', 'Error');
            }
          },
          complete: function() {
            submitButton.prop('disabled', false).html(originalText);
          }
        });
      });

      $(document).on('click', '.btn-eliminar-referencia', function() {
        const id = $(this).data('id');
        $('#referencia_id').val(id);
        $('#modalEliminarReferencia').modal('show');
      });

      // Eliminar Referencia
      $('#formEliminarReferencia').submit(function(e) {
        e.preventDefault();
        var id = $('#referencia_id').val();

        $.ajax({
          url: '/referencias/' + id,
          type: 'POST',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'DELETE'
          },
          success: function(response) {
            if (response.success) {
              $('#modalEliminarReferencia').modal('hide');
              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaReferencias.ajax.reload();
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
      $("#paso2, #paso3, #paso4").hide();

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

      function validarPaso(pasoId) {
        let valid = true;
        $(`${pasoId} :input[required]`).each(function() {
          const value = $(this).val();
          const fieldId = $(this).attr('id');
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
            let minLength, maxLength;

            if (fieldId === 'titulo') {
              minLength = 15;
              maxLength = 255;
            } else {
              minLength = 30;
              maxLength = 1000;
            }

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
