@extends('layouts.root')

@section('title', 'Pruebas')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Catálogo de Pruebas" icon="zmdi zmdi-assignment zmdi-hc-fw" />

    <section class="container-fluid">
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
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Descripción</th>
                      <th style="text-align: center">Rango de Edad</th>
                      <th style="text-align: center">Area de Desarrollo</th>
                      <th style="text-align: center">Tipo</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade in" id="new-prueba">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-prueba">
                      @csrf

                      <section id="paso1">
                        <h3>Datos de la Prueba</h3>
                        <div class="fila-formulario">
                          <!-- Campo Nombre -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Nombre<span class="text-danger">*</span></label>
                            <input class="form-control" id="nombre" name="nombre" type="text" maxlength="60"
                              required pattern="[A-Za-zÁÉÍÓÚÜÑáéíóúüñ0-9 ]+">
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
                              <option value="" selected disabled>Seleccione el rango de edad</option>
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
                              <option value="" selected disabled>Seleccione el área de Desarrollo</option>
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
                      </section>

                      <!-- Paso 2 -->
                      <section id="paso2" style="display: none;">
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
                          <button type="button" id="addItem" class="btn btn-regresar" style="color: white;">
                            Agregar Item
                          </button>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <!-- Modal de ver prueba -->
  <section class="modal fade" id="modalPrueba" tabindex="-1" role="dialog" aria-labelledby="modalTitulo"
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
  </section>

  <!-- modal eliminar-->
  <section class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      var tablaPrueba = $('#tab-prueba').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pruebas.index') }}",
          error: function(xhr, error, thrown) {
            toastr.error('Error al cargar los datos de pruebas', 'Error');
          }
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

      let contadorItems = 1;

      $("#addItem").click(function() {
        const nuevoItemFormulario = `
          <div class="fila-formulario" id="formulario-item-${contadorItems}">
            <div class="form-group">
              <label class="control-label">Item<span class="text-danger">*</span></label>
              <input class="form-control" name="items[${contadorItems}][nombre]" type="text" required>
            </div>
            <button type="button" class="eliminar btn btn-eliminar" style="color: white;" onclick="eliminarItem(this)">Eliminar</button>
          </div>`;
        $("#itemsContainer").append(nuevoItemFormulario);
        contadorItems++;
      });

      // Envío del formulario
      $('#registro-prueba').submit(function(e) {
        e.preventDefault();

        // Validar que haya al menos un item
        if ($('#itemsContainer .fila-formulario').length === 0) {
          toastr.error("Debe agregar al menos un item a la prueba.");
          return false;
        }

        const submitButton = $(this).find('button[type="submit"]');
        const originalText = submitButton.html();
        submitButton.prop('disabled', true).html('<i class="zmdi zmdi-spinner zmdi-hc-spin"></i> Guardando...');

        $.ajax({
          url: "{{ route('pruebas.store') }}",
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#registro-prueba')[0].reset();
              $("#itemsContainer").empty().append(`
                <div class="fila-formulario" id="formulario-item-0">
                  <div class="form-group">
                    <label class="control-label">Item<span class="text-danger">*</span></label>
                    <input class="form-control" name="items[0][nombre]" type="text" required>
                  </div>
                  <button type="button" class="eliminar btn btn-eliminar" style="color: white;" onclick="eliminarItem(this)">Eliminar</button>
                </div>
              `);
              contadorItems = 1;

              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });

              tablaPrueba.ajax.reload(null, false);

              $('.nav-tabs a[href="#list"]').tab('show');

              $("#paso1").show();
              $("#paso2").hide();
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
              toastr.error('Ocurrió un error al guardar la prueba', 'Error');
            }
          },
          complete: function() {
            submitButton.prop('disabled', false).html(originalText);
          }
        });
      });
    });

    // Función para eliminar items
    function eliminarItem(button) {
      if ($('#itemsContainer .fila-formulario').length > 1) {
        $(button).closest('.fila-formulario').remove();
      } else {
        toastr.warning("Debe haber al menos un item en la prueba.");
      }
    }

    // Ver detalles de prueba
    $(document).on('click', '.ver-prueba', function() {
      var pruebaId = $(this).data('id');

      $.ajax({
        url: '/pruebas/' + pruebaId,
        method: 'GET',
        success: function(data) {
          if (data && data.length > 0) {
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
          } else {
            toastr.error('No se encontraron datos para esta prueba');
          }
        },
        error: function(xhr) {
          toastr.error('Error al cargar los datos de la prueba');
        }
      });
    });

    // Configuración CSRF para AJAX
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Eliminar prueba
    let idEliminar = null;

    $(document).on('click', '.delete', function() {
      idEliminar = $(this).attr('id');
      $('#confirModal').modal('show');
    });

    $('#btnEliminar').click(function() {
      if (!idEliminar) return;

      $.ajax({
        url: "/pruebas/" + idEliminar,
        type: 'DELETE',
        beforeSend: function() {
          $('#btnEliminar').prop('disabled', true).text('Eliminando...');
        },
        success: function(data) {
          $('#confirModal').modal('hide');
          toastr.success('La prueba se eliminó correctamente', 'Eliminar Prueba', {
            timeOut: 5000
          });
          $('#tab-prueba').DataTable().ajax.reload(null, false);
        },
        error: function(xhr, status, error) {
          toastr.error('No se pudo eliminar la prueba', 'Error', {
            timeOut: 5000
          });
        },
        complete: function() {
          $('#btnEliminar').prop('disabled', false).text('Eliminar');
          idEliminar = null;
        }
      });
    });
  </script>
@endsection
