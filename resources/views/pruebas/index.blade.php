@extends('layouts.app')

@section('title', 'Pruebas')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Pruebas" icon="zmdi zmdi-assignment zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            <li><a href="#new-prueba" data-toggle="tab">Nuevo</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-prueba">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Descripción</th>
                      <th class="text-center">Rango de Edad</th>
                      <th class="text-center">Area de Desarrollo</th>
                      <th class="text-center">Tipo</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="new-prueba">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="pruebaForm">@csrf
                      <div id="paso1">
                        <h3>Datos de la Prueba</h3>
                        <div class="fila-formulario">
                          <!-- Campo Nombre -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Nombre<span class="text-danger">*</span></label>
                            <input class="form-control" id="nombre" name="nombre" type="text" maxlength="60"
                              required>
                            <small class="form-text text-muted">Máximo 60 caracteres. Solo letras, números y
                              espacios.</small>
                          </div>

                          <!-- Campo Descripción -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Descripción<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" maxlength="300" rows="3" required></textarea>
                            <small class="form-text text-muted">Máximo 300 caracteres. Describe brevemente la
                              prueba.</small>
                          </div>

                          <!-- Campo Rango de Edad -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Rango de Edad<span class="text-danger">*</span></label>
                            <select class="form-control select2" required id="rango_edad" name="rango_edad">
                              <option selected disabled>Seleccione el rango de edad</option>
                              <option value="0-3 meses">0-3 Meses</option>
                              <option value="4-6 meses">4-6 Meses</option>
                              <option value="7-12 meses">7-12 Meses</option>
                              <option value="13-24 meses">13-24 Meses</option>
                              <option value="25-36 meses">25-36 Meses</option>
                              <option value="37-48 meses">37-48 Meses</option>
                              <option value="49-72 meses">49-72 Meses</option>
                              <option value="36-78 meses">36-78 Meses</option>
                              <option value="60-78 meses">60-78 Meses</option>
                            </select>
                            <small class="form-text text-muted">Seleccione el grupo etario para el que fue diseñada la
                              prueba.</small>
                          </div>

                          <!-- Campo Área de Desarrollo -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Área de Desarrollo<span class="text-danger">*</span></label>
                            <select class="form-control select2" required id="area_desarrollo" name="area_desarrollo">
                              <option selected disabled>Seleccione el área de Desarrollo</option>
                              <option value="Cognitiva">Cognitiva</option>
                              <option value="Motora">Motora</option>
                              <option value="Lenguaje">Lenguaje</option>
                              <option value="Socio-Afectiva">Socio-Afectiva</option>
                              <option value="Sensorial">Sensorial</option>
                            </select>
                            <small class="form-text text-muted">Seleccione el área de desarrollo que evalúa la
                              prueba.</small>
                          </div>
                        </div>
                        <p class="centro-texto">
                          <button type="button" id="siguiente1" class="btn btn-regresar"
                            style="color: white;">Siguiente</button>
                        </p>
                      </div>

                      <!-- Paso 2 -->
                      <div id="paso2" style="display: none;">
                        <h3>Items de la Prueba</h3>
                        <p><strong>Indicación:</strong> Agregue uno o varios ítems que componen la prueba. Cada ítem
                          representa una tarea o pregunta específica para evaluar al niño.</p>

                        <div id="itemsContainer">
                          <div class="fila-formulario" id="formulario-item-0">
                            <div class="form-group">
                              <label class="control-label">Item<span class="text-danger">*</span></label>
                              <input class="form-control" name="items[0][nombre]" type="text" required>
                            </div>
                            <button type="button" class="eliminar btn btn-eliminar" style="color: white;"
                              onclick="eliminarItem(this)">Eliminar</button>
                          </div>
                        </div>

                        <p class="centro-texto">
                          <button type="button" id="addItem" class="btn btn-regresar" style="color: white;">Agregar
                            Item</button>
                          <button type="button" id="regresar" class="btn btn-regresar" style="color: white;"><i
                              class="zmdi zmdi-arrow-back"></i> Regresar</button>
                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;"><i
                              class="zmdi zmdi-floppy"></i>Registrar</button>
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
  <!-- Modal de ver prueba -->
  <div class="modal fade" id="modalPrueba" tabindex="-1" role="dialog" aria-labelledby="modalTitulo"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" id="modalTitulo" style="color: white;">Título de la prueba</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Descripción:</strong> <span id="modalDescripcion"></span></p>
          <p><strong>Área de Desarrollo:</strong> <span id="modalareaDesarrollo"></span></p>
          <p><strong>Rango de Edad:</strong> <span id="modalrangoEdad"></span></p>
          <p><strong>Tipo:</strong> <span id="modalTipo"></span></p>
          <p><strong>Ítems:</strong></p>
          <ul id="modalItems"></ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal eliminar-->
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
@endsection
@section('js')
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
    $("#nombre").on('input', function() {
      const valor = $(this).val();
      const regex = /^[A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9 ]{0,60}$/;

      if (!regex.test(valor)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    });
  </script>
  <script>
    $(document).ready(function() {
      let contadorItems = 1;
      $("#addItem").click(function() {
        const nuevoItemFormulario = `
            <div class="fila-formulario" id="formulario-item-${contadorItems}">
                <div class="form-group">
                    <label class="control-label">Item</label>
                    <input class="form-control" name="items[${contadorItems}][nombre]" type="text" required>
                </div>
                <button type="button" class="eliminar btn btn-danger" onclick="eliminarItem(this)">Eliminar</button>
            </div>`;
        $("#itemsContainer").append(nuevoItemFormulario);
        contadorItems++;
      });
    });

    function eliminarItem(button) {
      $(button).closest('.fila-formulario').remove();
    }
    $(document).ready(function() {
      $('#pruebaForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
          url: '/pruebas/prueba',
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              toastr.success('El registro se ingresó correctamente', 'Nuevo registro', {
                timeOut: 5000
              });
            } else {
              toastr.success(response.message, 'Exito', {
                timeOut: 5000
              });
            }

            setTimeout(function() {
              $('#pruebaForm')[0].reset();
              location.reload();
            }, 2000);
          },
          error: function(xhr) {
            console.error(xhr.responseText);
            toastr.error('Ocurrió un error al registrar el especialista', 'Error', {
              timeOut: 5000
            });

            setTimeout(function() {
              $('#pruebaForm')[0].reset();
              location.reload();
            }, 2000);
          }
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      var tablaPrueba = $('#tab-prueba').DataTable({
        language: {
          url: './js/datatables/es-ES.json',
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pruebas.index') }}",
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'nombre'
          },
          {
            data: 'descripcion'
          },
          {
            data: 'rango_edad'
          },
          {
            data: 'area_desarrollo'
          },
          {
            data: 'tipo'
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
    $(document).on('click', '.ver-prueba', function() {
      var pruebaId = $(this).data('id');

      $.ajax({
        url: '/pruebas/' + pruebaId,
        method: 'GET',
        success: function(data) {
          $('#modalTitulo').text(data[0].prueba_nombre);
          $('#modalDescripcion').text(data[0].prueba_descripcion);
          $('#modalareaDesarrollo').text(data[0].area_desarrollo);
          $('#modalrangoEdad').text(data[0].rango_edad);
          $('#modalTipo').text(data[0].tipo);

          $('#modalItems').empty();

          $.each(data, function(index, item) {
            $('#modalItems').append('<li>' + item.item_nombre + '</li>');
          });

          $('#modalPrueba').modal('show');
        },
        error: function(xhr) {
          console.error(xhr);
          alert('Error al cargar los datos.');
        }
      });
    });
  </script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(document).on('click', '.delete', function() {
      id = $(this).attr('id');
      $('#confirModal').modal('show');
    });

    $('#btnEliminar').click(function() {
      $.ajax({
        url: "/pruebas/" + id,
        type: 'DELETE',
        beforeSend: function() {
          $('#btnEliminar').text('Eliminando...');
        },
        success: function(data) {
          $('#confirModal').modal('hide');
          toastr.warning('La prueba se eliminó correctamente', 'Eliminar Prueba', {
            timeOut: 5000
          });
          $('#tab-prueba').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
          console.error('Error al eliminar la prueba:', error);
          toastr.error('No se pudo eliminar la prueba', 'Error', {
            timeOut: 5000
          });
        }
      });
    });
  </script>
@endsection
