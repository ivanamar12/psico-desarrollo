@extends('layouts.root')

@section('title', 'Especialidades')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Especialidades" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            <li><a href="#new" data-toggle="tab">Nuevo</a></li>
          </ul>

          <section id="myTabContent" class="tab-content">
            <!-- Pestaña Lista -->
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-especialidad">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <!-- Pestaña Nuevo -->
            <div class="tab-pane fade" id="new">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-especialidad">
                      @csrf

                      <!-- Paso único -->
                      <div id="paso1">
                        <h3>Información de la Especialidad</h3>
                        <div class="form-group">
                          <label class="control-label">Nombre de la especialidad <span
                              class="text-danger">*</span></label>
                          <input class="form-control" type="text" name="especialidad" id="especialidad_nombre" required
                            maxlength="30">
                          <small class="form-text text-muted">Máximo 30 caracteres</small>
                        </div>

                        <!-- Botón Registrar -->
                        <p class="text-center mt-3">
                          <button type="submit" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy"></i> Registrar
                          </button>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal editar -->
  <section class="modal fade" id="modalEditarEspecialidad" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Editar Especialidad</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formEditarEspecialidad">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="especialidad_id">
            <div class="form-group">
              <label class="control-label">Nombre de la especialidad <span class="text-danger">*</span></label>
              <input class="form-control" type="text" name="especialidad" id="especialidad_nombre_edit" required
                maxlength="30">
              <small class="form-text text-muted">Máximo 30 caracteres</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-custom" style="color: white;">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      var tablaEspecialidad = $('#tab-especialidad').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('especialidad.index') }}",
        columns: [{
            data: 'id'
          },
          {
            data: 'especialidad'
          },
          {
            data: 'action',
            orderable: false,
            searchable: false
          }
        ]
      });

      // Registrar nueva especialidad
      $('#registro-especialidad').submit(function(e) {
        e.preventDefault();

        $.ajax({
          url: "{{ route('especialidad.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#registro-especialidad')[0].reset();

              // Mostrar mensaje
              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });

              // Recargar tabla
              tablaEspecialidad.ajax.reload();

              // Cambiar a la pestaña de lista
              $('.nav-tabs a[href="#list"]').tab('show');
            }
          },
          error: function(xhr) {
            const {
              especialidad
            } = xhr.responseJSON.errors;

            especialidad.forEach(e => {
              toastr.error(e, 'Error', {
                timeOut: 5000
              });
            });
          }
        });
      });

      // Función para editar especialidad
      window.editEspecialidad = function(id) {
        $.get('/especialidad/' + id + '/edit', function(data) {
          $('#especialidad_id').val(data.id);
          $('#especialidad_nombre_edit').val(data.especialidad);
          $('#modalEditarEspecialidad').modal('show');
        });
      }

      // Actualizar especialidad
      $('#formEditarEspecialidad').submit(function(e) {
        e.preventDefault();
        var id = $('#especialidad_id').val();

        $.ajax({
          url: '/especialidad/' + id,
          type: 'POST',
          data: $(this).serialize() + '&_method=PUT',
          success: function(response) {
            if (response.success) {
              $('#modalEditarEspecialidad').modal('hide');
              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaEspecialidad.ajax.reload();
            }
          },
          error: function(xhr) {
            const {
              especialidad
            } = xhr.responseJSON.errors;

            especialidad.forEach(e => {
              toastr.error(e, 'Error', {
                timeOut: 5000
              });
            });
          }
        });
      });
    });
  </script>
@endsection
