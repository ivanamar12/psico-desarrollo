@extends('layouts.root')

@section('title', 'Especialistas')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Especialistas" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list-especialista" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar especialista'))
              <li><a href="#new-especialista" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>
          <section id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="list-especialista">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-especialista">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">CI</th>
                      <th style="text-align: center">FVP</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Apellido</th>
                      <th style="text-align: center">Correo</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <section class="tab-pane fade in" id="new-especialista">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-especialista">
                      @csrf

                      <!-- Paso 1 -->
                      <section id="paso1">
                        <h3>Datos Personales</h3>
                        <div class="row">

                          <!-- CI -->
                          <div class="form-group col-md-6">
                            <label for="ci">Cédula de Identidad (CI) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control ci-verificar" id="ci" name="ci" required
                              maxlength="11">
                            <small class="form-text text-muted">
                              Ingrese la letra según sea el caso V, P o E y luego su número de cédula sin puntos. Máximo
                              11 caracteres.
                            </small>
                          </div>

                          <!-- FVP -->
                          <div class="form-group col-md-6">
                            <label for="fvp">N° F.V.P <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fvp" name="fvp" required
                              oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="120">
                            <small class="form-text text-muted">
                              Número de la federación venezolana de psicólogos. Máximo 120 caracteres.
                            </small>
                          </div>

                          <!-- Nombre -->
                          <div class="form-group col-md-6">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                              oninput="validarTexto(this)" maxlength="120">
                            <small class="form-text text-muted">Solo letras. Máximo 120 caracteres.</small>
                          </div>

                          <!-- Apellido -->
                          <div class="form-group col-md-6">
                            <label for="apellido">Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required
                              oninput="validarTexto(this)" maxlength="120">
                            <small class="form-text text-muted">Solo letras. Máximo 120 caracteres.</small>
                          </div>

                          <!-- Fecha de nacimiento -->
                          <div class="form-group col-md-6">
                            <label for="fecha_nac">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                            <small class="form-text text-muted">Seleccione la fecha en el calendario.</small>
                          </div>

                          <!-- Especialidad -->
                          <div class="form-group col-md-6">
                            <label for="especialidad_id">Especialidad <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="especialidad_id" name="especialidad_id" required>
                              <option selected disabled>Seleccione su especialidad</option>
                              @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->especialidad }}</option>
                              @endforeach
                            </select>
                            <small class="form-text text-muted">Seleccione de la lista desplegable.</small>
                          </div>

                          <!-- Teléfono -->
                          <div class="form-group col-md-6">
                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control telefono-verificar" id="telefono" name="telefono"
                              required maxlength="12">
                            <small class="form-text text-muted">
                              Debe comenzar con 0412, 0424, etc. Máximo 12 caracteres.
                            </small>
                          </div>

                          <!-- Email -->
                          <div class="form-group col-md-6">
                            <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control email-verificar" id="email" name="email"
                              required maxlength="255">
                            <small class="form-text text-muted">Ej: ejemplo@correo.com</small>
                          </div>

                          <!-- Género -->
                          <div class="form-group col-md-6">
                            <label for="genero_id">Género <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="genero_id" name="genero_id" required>
                              <option selected disabled>Seleccione su género</option>
                              @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                              @endforeach
                            </select>
                            <small class="form-text text-muted">Seleccione de la lista desplegable.</small>
                          </div>
                        </div>

                        <!-- Botón -->
                        <p class="text-center mt-3">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>

                      <!-- Paso 2 -->
                      <section id="paso2" style="display: none;">
                        <h3>Datos de Dirección</h3>

                        <div class="fila-formulario row">
                          <!-- Estado -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="estado_id" name="estado_id">
                              <option selected disabled>Seleccione su estado</option>
                            </select>
                            <small class="leyenda-input">Seleccione el estado donde reside.</small>
                          </div>

                          <!-- Municipio -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Municipio <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="municipio_id" name="municipio_id">
                              <option selected disabled>Seleccione su municipio</option>
                            </select>
                            <small class="leyenda-input">Seleccione el municipio correspondiente.</small>
                          </div>

                          <!-- Parroquia -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Parroquia <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="parroquia_id" name="parroquia_id">
                              <option selected disabled>Seleccione su parroquia</option>
                            </select>
                            <small class="leyenda-input">Seleccione la parroquia del municipio.</small>
                          </div>

                          <!-- Sector -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Sector <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="sector" name="sector" required
                              minlength="10" maxlength="150">
                            <small class="leyenda-input">
                              Ingrese el nombre del sector donde vive. Máximo 150 caracteres.
                            </small>
                          </div>
                        </div>

                        <p class="centro-texto">
                          <button type="button" id="regresar" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>

                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy"></i> Registrar
                          </button>
                        </p>
                      </section>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </section>
        </div>
      </div>
    </section>
  </section>

  <!-- Modal editar -->
  <section class="modal fade" id="modalEditarEspecialista" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content rounded shadow-lg">
        <div class="modal-header">
          <div style="width: 100%; display: flex; justify-content: end">
            <button type="button" class="no-shadow-on-click" data-dismiss="modal"
              style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
            Editar Especialista
          </h3>
        </div>

        <div class="modal-body">
          <form id="formEditarEspecialista">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="especialista_id">

            <!-- Paso 1 -->
            <section id="paso1_edit">
              <h4 class="text-center mb-3">Datos Personales</h4>
              <div class="row">

                <!-- CI -->
                <div class="form-group col-md-6">
                  <label for="ci2">Cédula de Identidad (CI) <span class="text-danger">*</span></label>
                  <input class="form-control" id="ci2" name="ci2" required maxlength="11">
                  <small class="form-text text-muted">
                    Ingrese la letra según sea el caso V, P o E y luego su número de cédula sin puntos. Máximo
                    11 caracteres.
                  </small>
                </div>

                <!-- FVP -->
                <div class="form-group col-md-6">
                  <label for="fvp2">N° F.V.P <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="fvp2" name="fvp2" required
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="120">
                  <small class="form-text text-muted">
                    Número de la federación venezolana de psicólogos. Máximo 120 caracteres.
                  </small>
                </div>

                <!-- Nombre -->
                <div class="form-group col-md-6">
                  <label for="nombre2">Nombre <span class="text-danger">*</span></label>
                  <input class="form-control" id="nombre2" name="nombre2" required oninput="validarTexto(this)"
                    maxlength="120">
                  <small class="form-text text-muted">Solo letras. Máximo 120 caracteres.</small>
                </div>

                <!-- Apellido -->
                <div class="form-group col-md-6">
                  <label for="apellido2">Apellido <span class="text-danger">*</span></label>
                  <input class="form-control" id="apellido2" name="apellido2" required oninput="validarTexto(this)"
                    maxlength="120">
                  <small class="form-text text-muted">Solo letras. Máximo 120 caracteres.</small>
                </div>

                <!-- Fecha de nacimiento -->
                <div class="form-group col-md-6">
                  <label for="fecha_nac2">Fecha de Nacimiento <span class="text-danger">*</span></label>
                  <input type="date" class="form-control" id="fecha_nac2" name="fecha_nac2" required>
                  <small class="form-text text-muted">Seleccione la fecha en el calendario.</small>
                </div>

                <!-- Especialidad -->
                <div class="form-group col-md-6">
                  <label for="especialidad_id2">Especialidad <span class="text-danger">*</span></label>
                  <select class="form-control select2" id="especialidad_id2" name="especialidad_id2" required>
                    <option selected disabled>Seleccione su especialidad</option>
                    @foreach ($especialidades as $especialidad)
                      <option value="{{ $especialidad->id }}">{{ $especialidad->especialidad }}</option>
                    @endforeach
                  </select>
                  <small class="form-text text-muted">Seleccione de la lista desplegable.</small>
                </div>

                <!-- Teléfono -->
                <div class="form-group col-md-6">
                  <label for="telefono2">Teléfono <span class="text-danger">*</span></label>
                  <input type="tel" class="form-control" id="telefono2" name="telefono2" required maxlength="12">
                  <small class="form-text text-muted">
                    Debe comenzar con 0412, 0424, etc. Máximo 12 caracteres.
                  </small>
                </div>

                <!-- Email -->
                <div class="form-group col-md-6">
                  <label for="email2">Correo Electrónico <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" id="email2" name="email2" required maxlength="255">
                  <small class="form-text text-muted">Ej: ejemplo@correo.com</small>
                </div>

                <!-- Género -->
                <div class="form-group col-md-6">
                  <label for="genero_id2">Género <span class="text-danger">*</span></label>
                  <select class="form-control select2" id="genero_id2" name="genero_id2" required>
                    <option selected disabled>Seleccione su género</option>
                    @foreach ($generos as $genero)
                      <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                    @endforeach
                  </select>
                  <small class="form-text text-muted">Seleccione de la lista desplegable.</small>
                </div>
              </div>

              <div class="text-center mt-3">
                <button type="button" id="siguiente1_edit" class="btn btn-regresar px-4" style="color: white;">
                  Siguiente
                </button>
              </div>
            </section>

            <!-- Paso 2 -->
            <section id="paso2_edit" style="display: none;">
              <h4 class="text-center mb-3">Datos de Dirección</h4>
              <div class="row">
                <!-- Estado -->
                <div class="form-group col-md-6">
                  <label class="control-label">Estado <span class="text-danger">*</span></label>
                  <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id2"
                    name="estado_id2">
                    <option selected disabled>Seleccione su estado</option>
                  </select>
                  <small class="leyenda-input">Seleccione el estado donde reside.</small>
                </div>

                <!-- Municipio -->
                <div class="form-group col-md-6">
                  <label class="control-label">Municipio <span class="text-danger">*</span></label>
                  <select class="form-control form-control-solid select2" required style="width: 100%;"
                    id="municipio_id2" name="municipio_id2">
                    <option selected disabled>Seleccione su municipio</option>
                  </select>
                  <small class="leyenda-input">Seleccione el municipio correspondiente.</small>
                </div>

                <!-- Parroquia -->
                <div class="form-group col-md-6">
                  <label class="control-label">Parroquia <span class="text-danger">*</span></label>
                  <select class="form-control form-control-solid select2" required style="width: 100%;"
                    id="parroquia_id2" name="parroquia_id2">
                    <option selected disabled>Seleccione su parroquia</option>
                  </select>
                  <small class="leyenda-input">Seleccione la parroquia del municipio.</small>
                </div>

                <!-- Sector -->
                <div class="form-group col-md-6">
                  <label class="control-label">Sector <span class="text-danger">*</span></label>
                  <input class="form-control" type="text" id="sector2" name="sector2" required minlength="10"
                    maxlength="150">
                  <small class="leyenda-input">
                    Ingrese el nombre del sector donde vive. Máximo 150 caracteres.
                  </small>
                </div>
              </div>

              <div class="text-center mt-3">
                <button type="button" id="regresar_edit" class="btn btn-regresar" style="color: white;">
                  <i class="zmdi zmdi-arrow-back"></i> Regresar
                </button>

                <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                  Guardar Cambios
                </button>
              </div>
            </section>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- modal mostrar especialista -->
  <section id="especialistaModal" class="modal fade" tabindex="-1" role="dialog">
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
            Información del Especialista
          </h3>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Nombre completo:</strong><br><span id="nombre_show"></span></p>
              <p><strong>Cédula de Identidad:</strong><br><span id="ci_show"></span></p>
              <p><strong>F.V.P:</strong><br><span id="fvp_show"></span></p>
              <p><strong>Fecha de Nacimiento:</strong><br><span id="fecha_nac_show"></span></p>
              <p><strong>Especialidad:</strong><br><span id="especialidad_show"></span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Teléfono:</strong><br><span id="telefono_show"></span></p>
              <p><strong>Email:</strong><br><span id="email_show"></span></p>
              <p><strong>Género:</strong><br><span id="genero_show"></span></p>
              <p><strong>Dirección:</strong><br><span id="direccion_show" class="small"></span></p>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>
  <script src="{{ asset('js/app/validaciones.js') }}"></script>
  <script src="{{ asset('js/app/direccion.js') }}"></script>

  <script>
    const estados = @json($estados);
    const municipios = @json($municipios);
    const parroquias = @json($parroquias);
  </script>

  <script>
    $(document).ready(function() {
      var tablaEspecialista = $('#tab-especialista').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('especialistas.index') }}",
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'ci'
          },
          {
            data: 'fvp'
          },
          {
            data: 'nombre'
          },
          {
            data: 'apellido'
          },
          {
            data: 'email'
          },
          {
            data: 'action',
            orderable: false
          }
        ],
      });

      $("#paso1").show();
      $("#paso2").hide();

      $("#siguiente1").click(function() {
        let valid = true;

        // Validar campos requeridos dentro de #paso1
        $('#paso1 :input[required]').each(function() {
          if ($(this).val() === '' || $(this).val() === null) {
            $(this).addClass('is-invalid');
            valid = false;
          } else {
            $(this).removeClass('is-invalid');
          }
        });

        const emailInput = document.getElementById('email');
        const emailValid = validarEmail(emailInput);

        // Validación final
        if (valid && emailValid) {
          $("#paso1").hide();
          $("#paso2").show();
        } else {
          if (!emailValid) {
            toastr.error("Por favor ingrese un email válido antes de continuar.");
          } else {
            toastr.error("Debe completar todos los campos requeridos del paso 1.");
          }
        }
      });

      $("#regresar").click(function() {
        $("#paso2").hide();
        $("#paso1").show();
      });

      $("#registro-especialista").submit(function(e) {
        e.preventDefault();
        toastr.clear();

        $.ajax({
          url: "{{ route('especialistas.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#registro-especialista')[0].reset();

              $('#estado_id').val(null).trigger('change');
              $('#municipio_id').val(null).trigger('change');
              $('#parroquia_id').val(null).trigger('change');

              $(".email-verificar, .telefono-verificar, .ci-verificar").removeClass("is-valid is-invalid");

              $("#paso2").hide();
              $("#paso1").show();

              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaEspecialista.ajax.reload();
              $('.nav-tabs a[href="#list-especialista"]').tab('show');
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
              toastr.error('Ocurrió un error al crear el especialista.', 'Error');
            }
          }
        });
      });
    });
  </script>

  {{-- Editar especialista --}}
  <script>
    // Mostrar especialista a actualizar
    window.editEspecialista = function(id) {
      $.get('/especialistas/' + id + '/edit', function(especialista) {
        $('#especialista_id').val(especialista.id);
        $('#ci2').val(especialista.ci);
        $('#fvp2').val(especialista.fvp);
        $('#nombre2').val(especialista.nombre);
        $('#apellido2').val(especialista.apellido);
        $('#fecha_nac2').val(especialista.fecha_nac);
        $('#especialidad_id2').val(especialista.especialidad_id).trigger('change');
        $('#telefono2').val(especialista.telefono);
        $('#email2').val(especialista.email);
        $('#genero_id2').val(especialista.genero_id).trigger('change');

        if (especialista.direccion) {
          const estado = estados.find(e => e.id == especialista.direccion.estado_id);
          const municipio = municipios.find(m => m.id == especialista.direccion.municipio_id);
          const parroquia = parroquias.find(p => p.id == especialista.direccion.parroquia_id);

          setSelect2Preselection('#estado_id2', estado.id, estado.estado);
          filterMunicipios(estado.id, municipio.id);
          filterParroquias(municipio.id, parroquia.id);

          $('#sector2').val(especialista.direccion.sector);
        }

        $('#modalEditarEspecialista').modal('show');
      });
    }

    $('#modalEditarEspecialista').on('shown.bs.modal', function() {
      initSelect2('#estado_id2', 'Seleccione su estado');
      initSelect2('#municipio_id2', 'Seleccione su municipio');
      initSelect2('#parroquia_id2', 'Seleccione su parroquia');

      $('#estado_id2').off('change').on('change', function() {
        const estadoId = $(this).val();
        clearSelect('#municipio_id2', 'Seleccione su municipio');
        clearSelect('#parroquia_id2', 'Seleccione su parroquia');
        filterMunicipios(estadoId);
      });

      $('#municipio_id2').off('change').on('change', function() {
        const municipioId = $(this).val();
        clearSelect('#parroquia_id2', 'Seleccione su parroquia');
        filterParroquias(municipioId);
      });
    });

    // Para inicializar la librería en cada select
    function initSelect2(selector, placeholder) {
      $(selector).select2({
        placeholder: placeholder,
        width: '100%',
        dropdownParent: $('#modalEditarEspecialista')
      });
    }

    function setSelect2Preselection(selector, id, text) {
      if ($(selector).find("option[value='" + id + "']").length === 0) {
        $(selector).append(new Option(text, id, true, true)).trigger('change');
      } else {
        $(selector).val(id).trigger('change');
      }
    }

    function clearSelect(selector, placeholder) {
      $(selector).empty().append(`<option disabled selected>${placeholder}</option>`).val(null).trigger('change');
    }

    function filterMunicipios(estadoId, preselectedId = null) {
      const filtered = municipios.filter(m => m.estado_id == estadoId);
      $('#municipio_id2').empty().append('<option disabled selected>Seleccione su municipio</option>');
      filtered.forEach(m => {
        const option = new Option(m.municipio, m.id, false, m.id == preselectedId);
        $('#municipio_id2').append(option);
      });
      $('#municipio_id2').trigger('change');
    }

    function filterParroquias(municipioId, preselectedId = null) {
      const filtered = parroquias.filter(p => p.municipio_id == municipioId);
      $('#parroquia_id2').empty().append('<option disabled selected>Seleccione su parroquia</option>');
      filtered.forEach(p => {
        const option = new Option(p.parroquia, p.id, false, p.id == preselectedId);
        $('#parroquia_id2').append(option);
      });
      $('#parroquia_id2').trigger('change');
    }

    // Actualizar especialista
    $(document).ready(function() {
      $("#paso1_edit").show();
      $("#paso2_edit").hide();

      $("#siguiente1_edit").click(function() {
        let valid = true;

        $('#paso1_edit :input[required]').each(function() {
          if ($(this).val() === '' || $(this).val() === null) {
            $(this).addClass('is-invalid');
            valid = false;
          } else {
            $(this).removeClass('is-invalid');
          }
        });

        const emailInputEdit = document.getElementById('email2');
        const emailValidEdit = validarEmail(emailInputEdit);

        if (valid && emailValidEdit) {
          $("#paso1_edit").hide();
          $("#paso2_edit").show();
        } else {
          if (!emailValidEdit) {
            toastr.error("Por favor ingrese un email válido antes de continuar.");
          } else {
            toastr.error("Debe completar todos los campos requeridos del paso 1.");
          }
        }
      });

      $("#regresar_edit").click(function() {
        $("#paso2_edit").hide();
        $("#paso1_edit").show();
      });

      $("#formEditarEspecialista").submit(function(e) {
        e.preventDefault();
        var id = $('#especialista_id').val();

        $.ajax({
          url: "/especialistas/" + id,
          type: "PUT",
          data: {
            ci: $('#ci2').val(),
            fvp: $('#fvp2').val(),
            nombre: $('#nombre2').val(),
            apellido: $('#apellido2').val(),
            fecha_nac: $('#fecha_nac2').val(),
            especialidad_id: $('#especialidad_id2').val(),
            telefono: $('#telefono2').val(),
            email: $('#email2').val(),
            genero_id: $('#genero_id2').val(),
            estado_id: $('#estado_id2').val(),
            municipio_id: $('#municipio_id2').val(),
            parroquia_id: $('#parroquia_id2').val(),
            sector: $('#sector2').val(),
            _token: $("input[name=_token]").val(), // Importante
          },
          success: function(response) {
            if (response.success) {
              $('#modalEditarEspecialista').modal('hide');
              toastr.info(response.message, 'Éxito', {
                timeOut: 5000
              });
              $('#tab-especialista').DataTable().ajax.reload();
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
              toastr.error('Ocurrió un error al actualizar el especialista.', 'Error');
            }
          }
        });
      });
    });
  </script>

  {{-- Ver especialista --}}
  <script>
    $(document).on('click', '.ver-especialista', function() {
      let especialistaId = $(this).data('id');
      let $modal = $('#especialistaModal');

      $.ajax({
        url: '/especialistas/' + especialistaId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          const formatValue = (value, defaultValue = 'No disponible') =>
            value && value !== '' ? value : defaultValue;

          const nombreApellido = `${formatValue(data.nombre)} ${formatValue(data.apellido)}`;

          const fechaNac = data.fecha_nac_formatted || formatValue(data.fecha_nac);

          let direccionParts = [];
          if (data.direccion) {
            if (data.direccion.sector) direccionParts.push(data.direccion.sector);
            if (data.direccion.parroquia) direccionParts.push(data.direccion.parroquia.parroquia);
            if (data.direccion.municipio) direccionParts.push(data.direccion.municipio.municipio);
            if (data.direccion.estado) direccionParts.push(data.direccion.estado.estado);
          }
          const direccion = direccionParts.length > 0 ? direccionParts.join(', ') : 'No disponible';

          $modal.find('#nombre_show').text(nombreApellido);
          $modal.find('#ci_show').text(formatValue(data.ci));
          $modal.find('#fvp_show').text(formatValue(data.fvp));
          $modal.find('#fecha_nac_show').text(fechaNac);
          $modal.find('#especialidad_show').text(formatValue(data.especialidad?.especialidad));
          $modal.find('#telefono_show').text(formatValue(data.telefono));
          $modal.find('#email_show').text(formatValue(data.email));
          $modal.find('#genero_show').text(formatValue(data.genero?.genero));
          $modal.find('#direccion_show').text(direccion);

          $modal.modal('show');
        },
        error: function(xhr, status, error) {
          $modal.find('.modal-body').html(
            '<div class="alert alert-danger text-center">Error al cargar la información del especialista.</div>'
          );
          toastr.error('Error al cargar la información del especialista.');
        }
      });
    });
  </script>

@endsection
