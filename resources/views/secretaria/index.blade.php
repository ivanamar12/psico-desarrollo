@extends('layouts.app')

@section('title', 'Secretarias')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Secretarias" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar secretaria'))
              <li><a href="#new-secretaria" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>
          <section id="myTabContent" class="tab-content">
            <section class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-secretaria">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">CI</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Apellido</th>
                      <th style="text-align: center">Correo</th>
                      <th style="text-align: center">Telefono</th>
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
                              required>
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
                            <input class="form-control" type="text" id="sector" name="sector" required>
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
    </div>

  </section>
  <!-- Modal editar -->
  <div class="modal fade" id="editsecretaria" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
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
                        required>
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
  </div>
  <!-- modal eliminar -->
  <div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Confirmación</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea eliminar el registro seleccionado?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-eliminar"
            style="color: white;">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- modal mostrar secretaria -->
  <div id="secretariaModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Secretaria</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Nombre y Apellido:</strong> <span id="nombre"></span></p>
          <p><strong>Cédula de Identidad:</strong> <span id="ci"></span></p>
          <p><strong>Fecha de Nacimiento:</strong> <span id="fecha_nac"></span></p>
          <p><strong>Grado:</strong> <span id="grado"></span></p>
          <p><strong>Teléfono:</strong> <span id="telefono"></span></p>
          <p><strong>Email:</strong> <span id="email"></span></p>
          <p><strong>Género:</strong> <span id="genero"></span></p>
          <p><strong>Estado:</strong> <span id="direccion"></span></p>
          <div class="modal-footer">
            <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  @endsection
  @section('js')
    <script>
      const estados = @json($estados);
      const municipios = @json($municipios);
      const parroquias = @json($parroquias);
    </script>
    <script>
      $(document).ready(function() {
        var tablaSecretaria = $('#tab-secretaria').DataTable({
          language: {
            url: './js/datatables/es-ES.json',
          },
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('secretaria.index') }}",
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
              data: 'telefono'
            },
            {
              data: 'action',
              orderable: false
            }
          ]
        });
      });
    </script>
    <script>
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

        // Validación final
        if (valid) {
          $("#paso1").hide();
          $("#paso2").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 1.");
        }
      });

      $("#regresar").click(function() {
        $("#paso2").hide();
        $("#paso1").show();
      });
    </script>
    <script>
      $(document).ready(function() {
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
            url: "{{ route('secretaria.store') }}",
            type: "POST",
            data: formData,
            success: function(response) {
              if (response.success) {
                $('#registro-secretaria')[0].reset();
                $(".email-verificar, .telefono-verificar, .ci-verificar").removeClass("is-valid is-invalid");

                $("#paso1").show();
                $("#paso2").hide();

                toastr.success('¡Registro exitoso!', 'Éxito', {
                  timeOut: 3000
                });
                $('#tab-secretaria').DataTable().ajax.reload(null, false);
              }
            },
            error: function(xhr) {
              console.error(xhr.responseText);
              toastr.error('Error al registrar.', 'Error', {
                timeOut: 5000
              });
            }
          });
        }
      });
    </script>
    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var id;
      $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        $('#confirModal').modal('show');
      });

      $('#btnEliminar').click(function() {
        $.ajax({
          url: "/secretaria/" + id,
          type: 'DELETE',
          beforeSend: function() {
            $('#btnEliminar').text('Eliminando...');
          },
          success: function(data) {
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', {
              timeOut: 5000
            });
            $('#tab-secretaria').DataTable().ajax.reload();
          },
          error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', {
              timeOut: 5000
            });
          }
        });
      });
    </script>
    <script>
      function editsecretaria(id) {
        $.get('/secretaria/' + id + '/edit', function(secretaria) {
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
          $("#paso1_edit").hide();
          $("#paso2_edit").show();
        });

        $("#regresar_edit").click(function() {
          $("#paso2_edit").hide();
          $("#paso1_edit").show();
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
            url: "/secretaria/" + id,
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

    <script>
      $(document).on('click', '.ver-secretaria', function() {
        let secretariaId = $(this).data('id');

        $.ajax({
          url: '/secretarias/' + secretariaId,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            console.log("Datos del secretarias:", data);

            let nombreApellido = data.nombre + " " + data.apellido;
            let cedula = data.ci;
            let fechaNacimiento = data.fecha_nac;
            let grado = data.grado;
            let telefono = data.telefono;
            let email = data.email;

            let genero = data.genero ? data.genero.genero : "No disponible";

            let direccion =
              `${data.direccion.sector}, ${data.direccion.parroquia.parroquia}, ${data.direccion.municipio.municipio}, ${data.direccion.estado.estado}`;

            $('#secretariaModal #nombre').text(nombreApellido);
            $('#secretariaModal #ci').text(cedula);
            $('#secretariaModal #fecha_nac').text(fechaNacimiento);
            $('#secretariaModal #grado').text(grado);
            $('#secretariaModal #telefono').text(telefono);
            $('#secretariaModal #email').text(email);
            $('#secretariaModal #genero').text(genero);
            $('#secretariaModal #direccion').text(direccion);

            $('#secretariaModal').modal('show');
          },
          error: function(xhr, status, error) {
            console.error("Error al obtener los datos:", error);
            alert("Hubo un problema al obtener la información del especialista.");
          }
        });
      });
    </script>
  @endsection
