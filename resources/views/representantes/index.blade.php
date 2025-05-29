@extends('layouts.app')

@section('title', 'Representantes')

@section('content')
  <section class="full-box dashboard-contentPage">
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

    <!-- Page title -->
    <x-page-header title="Representantes" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar representante'))
              <li><a href="#new" data-toggle="tab"> Nuevo</a></li>
            @endif
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-representante">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">CI</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Apellido</th>
                      <th class="text-center">Correo</th>
                      <th class="text-center">Teléfono</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="new">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-representante">@csrf
                      <div id="paso1">
                        <h3>Datos Personales</h3>
                        <div class="fila-formulario row">

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Cédula de Identidad (CI) <span
                                class="text-danger">*</span></label>
                            <input class="form-control" id="ci" name="ci" type="text" required
                              oninput="validateInput(this)" maxlength="8">
                            <small class="leyenda-input">Ingrese el número de cédula del representante.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Nombre <span class="text-danger">*</span></label>
                            <input class="form-control" id="nombre" name="nombre" type="text" required
                              maxlength="50" oninput="validarTexto(this)">
                            <small class="leyenda-input">Nombre completo del representante.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Apellido <span class="text-danger">*</span></label>
                            <input class="form-control" id="apellido" name="apellido" type="text" required
                              maxlength="50" oninput="validarTexto(this)">
                            <small class="leyenda-input">Apellido completo del representante.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Teléfono<span class="text-danger">*</span></label>
                            <input class="form-control" type="tel" id="telefono" name="telefono" required>
                            <small class="leyenda-input">Número telefónico de contacto.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Correo electrónico<span class="text-danger">*</span></label>
                            <input class="form-control" type="email" id="email" name="email" required>
                            <small class="leyenda-input">Correo electrónico del representante.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label class="control-label">Género <span class="text-danger">*</span></label>
                            <select class="form-control select2" required style="width: 100%;" id="genero_id"
                              name="genero_id">
                              <option selected disabled>Seleccione su género</option>
                              @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                              @endforeach
                            </select>
                            <small class="leyenda-input">Seleccione el género del representante.</small>
                          </div>

                        </div>
                        <p class="centro-texto">
                          <button type="button" id="siguiente1" class="btn btn-regresar"
                            style="color: white;">Siguiente</button>
                        </p>
                      </div>

                      <div id="paso2" style="display: none;">
                        <h3>Datos de Dirección</h3>
                        <div class="fila-formulario row">

                          <div class="form-group label-floating col-md-6">
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

                          <div class="form-group label-floating col-md-6">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- modal editar-->
  <div class="modal fade" id="editRepresentante" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Actualizar Representante</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
              <form id="editar-representante">@csrf
                <input type="hidden" id="id" name="id">
                <div id="paso1_edit">
                  <h3>Datos Personales</h3>
                  <div class="fila-formulario">
                    <div class="form-group label-floating col-md-6">
                      <label class="control-label">Nombre</label>
                      <input class="form-control" id="nombre2" name="nombre2" type="text">
                    </div>
                    <div class="form-group label-floating col-md-6">
                      <label class="control-label">Apellido</label>
                      <input class="form-control" id="apellido2" name="apellido2" type="text" required>
                    </div>
                    <div class="form-group label-floating col-md-6">
                      <label class="control-label">CI</label>
                      <input class="form-control" id="ci2" name="ci2" type="number" required
                        max="34000000" oninput="validateInput(this)">
                    </div>
                    <div class="form-group label-floating col-md-6">
                      <label class="control-label">Teléfono</label>
                      <input class="form-control" type="tel" id="telefono2" name="telefono2" required>
                    </div>
                    <div class="form-group label-floating col-md-6">
                      <label class="control-label">Correo electrónico</label>
                      <input class="form-control" type="email" id="email2" name="email2" required>
                    </div>
                    <div class="form-group col-md-6">
                      <select class="form-control select2" required style="width: 100%;" id="genero_id2"
                        name="genero_id2">
                        @foreach ($generos as $genero)
                          <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <p class="centro-texto"><button type="button" id="siguiente1_edit" class="btn btn-regresar"
                      style="color: white;">Siguiente</button></p>
                </div>
                <div id="paso2_edit" style="display: none;">
                  <h3>Datos de Dirección</h3>
                  <div class="fila-formulario">
                    <div class="form-group label-floating col-md-6">
                      <label class="control-label">Estado</label>
                      <select class="form-control form-control-solid select2" required style="width: 100%;"
                        id="estado_id2" name="estado_id2">
                        <option></option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <select class="form-control form-control-solid select2" required style="width: 100%;"
                        id="municipio_id2" name="municipio_id2">
                        <option></option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <select class="form-control form-control-solid select2" required style="width: 100%;"
                        id="parroquia_id2" name="parroquia_id2">
                        <option></option>
                      </select>
                    </div>
                    <div class="form-group label-floating col-md-6">
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
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cancelar</button>
          <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-eliminar"
            style="color: white;">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal mostrar representante -->
  <div id="representanteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Representante</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Nombre y Apellido:</strong> <span id="nombre"></span></p>
          <p><strong>Cédula de Identidad:</strong> <span id="ci"></span></p>
          <p><strong>Teléfono:</strong> <span id="telefono"></span></p>
          <p><strong>Email:</strong> <span id="email"></span></p>
          <p><strong>Género:</strong> <span id="genero"></span></p>
          <p><strong>Dirección:</strong> <span id="direccion"></span></p>
        </div>
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
      var tablaRepresentante = $('#tab-representante').DataTable({
        language: {
          url: './js/datatables/es-ES.json',
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('representantes.index') }}",
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
    $(document).ready(function() {
      $("#paso1").show();

      $("#siguiente1").click(function() {
        $("#paso1").hide();
        $("#paso2").show();
      });

      $("#regresar").click(function() {
        $("#paso2").hide();
        $("#paso1").show();
      });

      $("#registro-representante").submit(function(event) {
        event.preventDefault();
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var ci = $('#ci').val();
        var telefono = $('#telefono').val();
        var email = $('#email').val();
        var genero_id = $('#genero_id').val();
        var estado_id = $('#estado_id').val();
        var municipio_id = $('#municipio_id').val();
        var parroquia_id = $('#parroquia_id').val();
        var sector = $('#sector').val();
        var _token = $("input[name=_token]").val();

        $.ajax({
          url: "{{ route('representantes.store') }}",
          type: "POST",
          data: {
            nombre: nombre,
            apellido: apellido,
            ci: ci,
            telefono: telefono,
            email: email,
            genero_id: genero_id,
            estado_id: estado_id,
            municipio_id: municipio_id,
            parroquia_id: parroquia_id,
            sector: sector,
            _token: _token
          },
          success: function(response) {
            if (response.success) {
              $('#registro-representante')[0].reset();
              toastr.success('El registro se ingresó correctamente', 'Nuevo registro', {
                timeOut: 5000
              });
              $('#tab-representante').DataTable().ajax.reload();
              $("#paso1").show();
              $("#paso2").hide();
            }
          },
          error: function(xhr) {
            console.error(xhr.responseText);
            toastr.error('Ocurrió un error al registrar el representante', 'Error', {
              timeOut: 5000
            });
          }
        });
      });
    });
  </script>
  <script>
    const estados = @json($estados);
    const municipios = @json($municipios);
    const parroquias = @json($parroquias);
  </script>
  <script>
    function editRepresentante(id) {
      $.get('/representantes/' + id + '/edit', function(representante) {
        $('#id').val(representante.id);
        $('#nombre2').val(representante.nombre);
        $('#apellido2').val(representante.apellido);
        $('#ci2').val(representante.ci);
        $('#telefono2').val(representante.telefono);
        $('#email2').val(representante.email);

        if (representante.direccion) {
          $('#estado_id2').val(representante.direccion.estado_id).trigger('change');

          filterMunicipios(representante.direccion.estado_id);
          $('#municipio_id2').val(representante.direccion.municipio_id).trigger('change');

          filterParroquias(representante.direccion.municipio_id);
          $('#parroquia_id2').val(representante.direccion.parroquia_id).trigger('change');

          $('#sector2').val(representante.direccion.sector);
        }

        $('#editRepresentante').modal('show');
      });
    }

    $('#editRepresentante').on('shown.bs.modal', function() {
      initSelect2('#estado_id2', "Seleccione su estado", estados, 'estado');
      initSelect2('#municipio_id2', "Seleccione su municipio", municipios, 'municipio');
      initSelect2('#parroquia_id2', "Seleccione su parroquia", parroquias, 'parroquia');

      $('#estado_id2').on('change', function() {
        const estadoId = $(this).val();
        filterMunicipios(estadoId);
        $('#parroquia_id2').empty().append('<option selected disabled>Seleccione su parroquia</option>');
      });

      $('#municipio_id2').on('change', function() {
        const municipioId = $(this).val();
        filterParroquias(municipioId);
      });
    });

    const initSelect2 = (selector, placeholder, data, type) => {
      $(selector).select2({
        placeholder: placeholder,
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
          delay: 250,
          transport: function(params, success) {
            const searchTerm = params.data.term.toLowerCase().trim();
            const filteredResults = data.filter(item =>
              type === 'estado' ? item.estado.toLowerCase().includes(searchTerm) :
              type === 'municipio' ? item.municipio.toLowerCase().includes(searchTerm) :
              item.parroquia.toLowerCase().includes(searchTerm)
            );
            const results = filteredResults.map(item => ({
              id: item.id,
              text: type === 'estado' ? item.estado : type === 'municipio' ? item.municipio : item.parroquia
            }));
            success({
              results: results
            });
          }
        },
        dropdownParent: $('#editRepresentante .modal-body')
      });
    };

    const showMunicipios = (filteredMunicipios) => {
      $('#municipio_id2').empty().append('<option selected disabled>Seleccione su municipio</option>');
      filteredMunicipios.forEach(item => {
        const option = new Option(item.municipio, item.id, false, false);
        $('#municipio_id2').append(option);
      });
      $('#municipio_id2').trigger('change');
    };

    const filterMunicipios = (estadoId) => {
      const filteredMunicipios = municipios.filter(item => item.estado_id == estadoId);
      showMunicipios(filteredMunicipios);
    };

    const showParroquias = (filteredParroquias) => {
      $('#parroquia_id2').empty().append('<option selected disabled>Seleccione su parroquia</option>');
      filteredParroquias.forEach(item => {
        const option = new Option(item.parroquia, item.id, false, false);
        $('#parroquia_id2').append(option);
      });
      $('#parroquia_id2').trigger('change');
    };

    const filterParroquias = (municipioId) => {
      const filteredParroquias = parroquias.filter(item => item.municipio_id == municipioId);
      showParroquias(filteredParroquias);
    };
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

      $("#editar-representante").submit(function(event) {
        event.preventDefault();

        var id = $('#id').val();
        var nombre = $('#nombre2').val();
        var apellido = $('#apellido2').val();
        var ci = $('#ci2').val();
        var telefono = $('#telefono2').val();
        var email = $('#email2').val();
        var genero_id = $('#genero_id2').val();
        var estado_id = $('#estado_id2').val();
        var municipio_id = $('#municipio_id2').val();
        var parroquia_id = $('#parroquia_id2').val();
        var sector = $('#sector2').val();
        var _token = $("input[name=_token]").val();

        $.ajax({
          url: "/representantes/" + id,
          type: "PUT",
          data: {
            id: id,
            nombre: nombre,
            apellido: apellido,
            ci: ci,
            telefono: telefono,
            email: email,
            genero_id: genero_id,
            estado_id: estado_id,
            municipio_id: municipio_id,
            parroquia_id: parroquia_id,
            sector: sector,
            _token: _token
          },
          success: function(response) {
            console.log("Respuesta del servidor:", response);
            if (response.success) {
              console.log("Cerrando el modal...");
              $('#editRepresentante').modal('hide');
              toastr.info('El registro se actualizó correctamente', 'Actualizar registro', {
                timeOut: 5000
              });
              $('#tab-representante').DataTable().ajax.reload();
            } else {
              console.log("No se pudo actualizar el registro.");
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
    $(document).on('click', '.ver-representante', function() {
      let representanteId = $(this).data('id');

      $.ajax({
        url: '/representantes/' + representanteId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          console.log("Datos del representante:", data);

          let nombreApellido = data.nombre + " " + data.apellido;
          let cedula = data.ci;
          let telefono = data.telefono;
          let email = data.email;

          let genero = data.genero ? data.genero.genero : "No disponible";

          let direccion =
            `${data.direccion.sector}, ${data.direccion.parroquia.parroquia}, ${data.direccion.municipio.municipio}, ${data.direccion.estado.estado}`;

          $('#representanteModal #nombre').text(nombreApellido);
          $('#representanteModal #ci').text(cedula);
          $('#representanteModal #telefono').text(telefono);
          $('#representanteModal #email').text(email);
          $('#representanteModal #genero').text(genero);
          $('#representanteModal #direccion').text(direccion);

          $('#representanteModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error("Error al obtener los datos:", error);
          alert("Hubo un problema al obtener la información del especialista.");
        }
      });
    });
  </script>
@endsection
