@extends('layouts.root')

@section('title', 'Secretarias')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Secretarias" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list-secretaria" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar secretaria'))
              <li><a href="#new-secretaria" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>
          <section id="myTabContent" class="tab-content">
            <section class="tab-pane fade active in" id="list-secretaria">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-secretaria">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">CI</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Apellido</th>
                      <th style="text-align: center">Correo</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </section>

            <section class="tab-pane fade in" id="new-secretaria">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-secretaria">
                      @csrf
                      <div id="paso1">
                        <h3>Datos Personales</h3>
                        <div class="row">
                          <!-- Cédula -->
                          <div class="form-group col-md-6">
                            <label for="ci">Cédula de Identidad (CI) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control ci-verificar" id="ci" name="ci"
                              required>
                            <small class="form-text text-muted">Ingrese su número de cédula sin puntos y la letra seguna
                              sea el caso V, P o E.</small>
                          </div>

                          <!-- Nombre -->
                          <div class="form-group col-md-6">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                              maxlength="50" oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ej: María</small>
                          </div>

                          <!-- Apellido -->
                          <div class="form-group col-md-6">
                            <label for="apellido">Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required
                              maxlength="50" oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ej: González</small>
                          </div>

                          <!-- Fecha Nacimiento -->
                          <div class="form-group col-md-6">
                            <label for="fecha_nac">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                            <small class="form-text text-muted">Seleccione su fecha de nacimiento.</small>
                          </div>

                          <!-- Grado -->
                          <div class="form-group col-md-6">
                            <label for="grado">Grado <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="grado" name="grado" required
                              oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ej: TSU, Licenciada, etc.</small>
                          </div>

                          <!-- Teléfono -->
                          <div class="form-group col-md-6">
                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control telefono-verificar" id="telefono" name="telefono"
                              required>
                            <small class="form-text text-muted">Ej: 04141234567</small>
                          </div>

                          <!-- Correo -->
                          <div class="form-group col-md-6">
                            <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control email-verificar" id="email" name="email"
                              required maxlength="255">
                            <small class="form-text text-muted">Ej: ejemplo@correo.com</small>
                          </div>

                          <!-- Género -->
                          <div class="form-group col-md-6">
                            <label for="genero_id">Género <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="genero_id" name="genero_id" required
                              style="width: 100%;">
                              <option disabled selected>Seleccione su género</option>
                              @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                              @endforeach
                            </select>
                            <small class="form-text text-muted">Seleccione una opción de la lista.</small>
                          </div>
                        </div>

                        <p class="centro-texto mt-3">
                          <button type="button" id="siguiente1" class="btn btn-regresar text-white">Siguiente</button>
                        </p>
                      </div>

                      <div id="paso2" style="display: none;">
                        <h3>Datos de Dirección</h3>
                        <div class="fila-formulario row">

                          <div class="form-group col-md-6">
                            <label class="control-label">Estado <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="estado_id" name="estado_id">
                              <option selected disabled>Seleccione su estado</option>
                            </select>
                            <small class="leyenda-input">Seleccione el estado donde reside.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label class="control-label">Municipio <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="municipio_id" name="municipio_id">
                              <option selected disabled>Seleccione su municipio</option>
                            </select>
                            <small class="leyenda-input">Seleccione el municipio correspondiente.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label class="control-label">Parroquia <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="parroquia_id" name="parroquia_id">
                              <option selected disabled>Seleccione su parroquia</option>
                            </select>
                            <small class="leyenda-input">Seleccione la parroquia dentro del municipio.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label class="control-label">Sector <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="sector" name="sector" required
                              minlength="10" maxlength="80">
                            <small class="leyenda-input">Ingrese el nombre del sector donde vive.</small>
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
                      </div>
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
  <section class="modal fade" id="editsecretaria" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Actualizar secretaria</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
              <form id="editar-secretaria">@csrf
                <input type="hidden" id="id" name="id">
                <div id="paso1_edit">
                  <h3>Datos Personales</h3>
                  <div class="row">

                    <div class="form-group col-md-6">
                      <label>CI</label>
                      <input class="form-control" id="ci2" name="ci2" type="text" required
                        max="34000000" oninput="validateInput(this)">
                    </div>

                    <div class="form-group col-md-6">
                      <label>Nombre</label>
                      <input class="form-control" id="nombre2" name="nombre2" type="text" required
                        oninput="validarTexto(this)">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Apellido</label>
                      <input class="form-control" id="apellido2" name="apellido2" type="text" required
                        oninput="validarTexto(this)">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Fecha de Nacimiento</label>
                      <input class="form-control" type="date" name="fecha_nac2" id="fecha_nac2" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="grado2">Grado</label>
                      <input class="form-control" id="grado2" name="grado2" type="text" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Teléfono</label>
                      <input class="form-control" type="tel" id="telefono2" name="telefono2" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Correo electrónico</label>
                      <input class="form-control email-verificar" type="email" id="email2" name="email2"
                        required maxlength="255">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="genero_id2">Género</label>
                      <select class="form-control select2" required style="width: 100%;" id="genero_id2"
                        name="genero_id2">
                        @foreach ($generos as $genero)
                          <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <p class="centro-texto">
                    <button type="button" id="siguiente1_edit" class="btn btn-regresar" style="color: white;">
                      Siguiente
                    </button>
                  </p>
                </div>

                <div id="paso2_edit" style="display: none;">
                  <h3>Datos de Dirección</h3>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="estado_id2">Estado</label>
                      <select class="form-control select2" required style="width: 100%;" id="estado_id2"
                        name="estado_id2">
                        <option></option>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="municipio_id2">Municipio</label>
                      <select class="form-control select2" required style="width: 100%;" id="municipio_id2"
                        name="municipio_id2">
                        <option></option>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="parroquia_id2">Parroquia</label>
                      <select class="form-control select2" required style="width: 100%;" id="parroquia_id2"
                        name="parroquia_id2">
                        <option></option>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="sector2">Sector</label>
                      <input class="form-control" type="text" id="sector2" name="sector2" required>
                    </div>
                  </div>

                  <p class="centro-texto">
                    <button type="button" id="regresar_edit" class="btn btn-regresar" style="color: white;"><i
                        class="zmdi zmdi-arrow-back"></i> Regresar</button>
                    <button type="submit" name="registrar" class="btn btn-custom" style="color: white;"><i
                        class="zmdi zmdi-floppy"></i>Guardar cambios</button>
                  </p>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- modal mostrar secretaria -->
  <section id="secretariaModal" class="modal fade" tabindex="-1" role="dialog">
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
            Información de la Secretaria
          </h3>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Nombre completo:</strong><br><span id="nombre_show"></span></p>
              <p><strong>Cédula de Identidad:</strong><br><span id="ci_show"></span></p>
              <p><strong>Fecha de Nacimiento:</strong><br><span id="fecha_nac_show"></span></p>
              <p><strong>Grado:</strong><br><span id="grado_show"></span></p>
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
      var tablaSecretaria = $('#tab-secretaria').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('secretarias.index') }}",
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'ci'
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
        ]
      });

      $("#registro-secretaria").submit(function(event) {
        event.preventDefault();
        toastr.clear();

        registerSecretaria();
      });

      function registerSecretaria() {
        var formData = {
          nombre: $('#nombre').val(),
          apellido: $('#apellido').val(),
          ci: $('#ci').val(),
          fecha_nac: $('#fecha_nac').val(),
          grado: $('#grado').val(),
          telefono: $('#telefono').val(),
          email: $('#email').val(),
          genero_id: $('#genero_id').val(),
          estado_id: $('#estado_id').val(),
          municipio_id: $('#municipio_id').val(),
          parroquia_id: $('#parroquia_id').val(),
          sector: $('#sector').val(),
          _token: $("input[name=_token]").val()
        };

        $.ajax({
          url: "{{ route('secretarias.store') }}",
          type: "POST",
          data: formData,
          success: function(response) {
            if (response.success) {
              $('#registro-secretaria')[0].reset();

              $('#estado_id').val(null).trigger('change');
              $('#municipio_id').val(null).trigger('change');
              $('#parroquia_id').val(null).trigger('change');

              $(".email-verificar, .telefono-verificar, .ci-verificar").removeClass("is-valid is-invalid");

              toastr.success(response.message, 'Éxito', {
                timeOut: 3000
              });

              tablaSecretaria.ajax.reload();

              $('.nav-tabs a[href="#list-secretaria"]').tab('show');
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
              toastr.error('Ocurrió un error al guardar la secretaria.', 'Error');
            }
          }
        });
      }

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
    });
  </script>

  <script>
    function editsecretaria(id) {
      $.get('/secretarias/' + id + '/edit', function(secretaria) {
        $('#id').val(secretaria.id);
        $('#nombre2').val(secretaria.nombre);
        $('#apellido2').val(secretaria.apellido);
        $('#ci2').val(secretaria.ci);
        $('#fecha_nac2').val(secretaria.fecha_nac);
        $('#grado2').val(secretaria.grado);
        $('#telefono2').val(secretaria.telefono);
        $('#email2').val(secretaria.email);

        if (secretaria.direccion) {
          const estado = estados.find(e => e.id == secretaria.direccion.estado_id);
          const municipio = municipios.find(m => m.id == secretaria.direccion.municipio_id);
          const parroquia = parroquias.find(p => p.id == secretaria.direccion.parroquia_id);

          setSelect2Preselection('#estado_id2', estado.id, estado.estado);
          filterMunicipios(estado.id, municipio.id);
          filterParroquias(municipio.id, parroquia.id);

          $('#sector2').val(secretaria.direccion.sector);
        }

        $('#editsecretaria').modal('show');
      });
    }

    $('#editsecretaria').on('shown.bs.modal', function() {
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

    function initSelect2(selector, placeholder) {
      $(selector).select2({
        placeholder: placeholder,
        width: '100%',
        dropdownParent: $('#editsecretaria')
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
  </script>

  <script>
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

      // Resetear fomulario en caso de volver a la vista
      $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        if (e.target.hash === '#list-secretaria') {
          $('#estado_id').val(null).trigger('change');
          $('#municipio_id').val(null).trigger('change');
          $('#parroquia_id').val(null).trigger('change');

          $('#registro-secretaria')[0].reset();
        }
      });

      $("#editar-secretaria").submit(function(event) {
        event.preventDefault();

        var id = $('#id').val();
        var nombre = $('#nombre2').val();
        var apellido = $('#apellido2').val();
        var ci = $('#ci2').val();
        var fecha_nac = $('#fecha_nac2').val();
        var grado = $('#grado2').val();
        var telefono = $('#telefono2').val();
        var email = $('#email2').val();
        var estado_id = $('#estado_id2').val();
        var municipio_id = $('#municipio_id2').val();
        var parroquia_id = $('#parroquia_id2').val();
        var sector = $('#sector2').val();
        var _token = $("input[name=_token]").val();

        $.ajax({
          url: "/secretarias/" + id,
          type: "PUT",
          data: {
            id: id,
            nombre: nombre,
            apellido: apellido,
            ci: ci,
            fecha_nac: fecha_nac,
            grado: grado,
            telefono: telefono,
            email: email,
            estado_id: estado_id,
            municipio_id: municipio_id,
            parroquia_id: parroquia_id,
            sector: sector,
            _token: _token
          },
          success: function(response) {
            if (response.success) {
              $('#editsecretaria').modal('hide');

              $('#estado_id').val(null).trigger('change');
              $('#municipio_id').val(null).trigger('change');
              $('#parroquia_id').val(null).trigger('change');

              toastr.info('El registro se actualizó correctamente', 'Actualizar registro', {
                timeOut: 5000
              });

              $('#tab-secretaria').DataTable().ajax.reload();
            } else {
              alert('No se pudo actualizar el registro.');
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la actualización:', textStatus, errorThrown);
            alert('Ocurrió un error al actualizar el registro. Intenta nuevamente.');
          }
        });
      });
    });
  </script>

  {{-- Ver secretaria --}}
  <script>
    $(document).on('click', '.ver-secretaria', function() {
      let secretariaId = $(this).data('id');
      let $modal = $('#secretariaModal');

      $.ajax({
        url: '/secretarias/' + secretariaId,
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
          $modal.find('#fecha_nac_show').text(fechaNac);
          $modal.find('#grado_show').text(formatValue(data.grado));
          $modal.find('#telefono_show').text(formatValue(data.telefono));
          $modal.find('#email_show').text(formatValue(data.email));
          $modal.find('#genero_show').text(formatValue(data.genero?.genero));
          $modal.find('#direccion_show').text(direccion);

          $modal.modal('show');
        },
        error: function(xhr, status, error) {
          $modal.find('.modal-body').html(
            '<div class="alert alert-danger text-center">Error al cargar la información de la secretaria.</div>'
          );
          toastr.error('Error al cargar la información de la secretaria.');
        }
      });
    });
  </script>

@endsection
