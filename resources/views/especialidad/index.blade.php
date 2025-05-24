@extends('layouts.app')
@section('title', 'Especialidades')
@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
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
    <!-- Content page -->

    <!-- Page title -->
    <x-page-header title="Especialidades" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar especialidad'))
              <li><a href="#new" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>

          <section id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-especialidad">
                  <thead>
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

            <div class="tab-pane fade" id="new">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-especialidad">
                      @csrf
                      <div class="form-group label-floating">
                        <label class="control-label">Nombre de la especialidad</label>
                        <input class="form-control" type="text" id="especialidad" name="especialidad" required
                          maxlength="30">
                      </div>
                      <p class="text-center">
                        <button type="submit" class="btn btn-custom" style="color: white;">
                          <i class="zmdi zmdi-floppy"></i> Guardar
                        </button>
                      </p>
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
  <div class="modal fade" id="editEspecialidadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Editar Especialidad</h3>
        </div>
        <div class="modal-body">
          <form id="editar-especialidad">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_id" name="id">
            <div class="form-group label-floating">
              <label class="control-label">Nombre de la especialidad</label>
              <input class="form-control" type="text" id="edit_especialidad" name="especialidad" required
                maxlength="30">
            </div>
            <p class="text-center">
              <button type="submit" class="btn btn-custom" style="color: white;">
                <i class="zmdi zmdi-floppy"></i> Guardar cambios
              </button>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script>
    $(document).ready(function() {
      var tablaEspecialidad = $('#tab-especialidad').DataTable({
        language: {
          url: './js/datatables/es-ES.json',
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
              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaEspecialidad.ajax.reload();
              $('.nav-tabs a[href="#list"]').tab('show');
            }
          },
          error: function(xhr) {
            toastr.error(xhr.responseJSON.message, 'Error', {
              timeOut: 5000
            });
          }
        });
      });

      // Función para editar especialidad
      window.editEspecialidad = function(id) {
        $.get('/especialidad/' + id + '/edit', function(data) {
          $('#edit_id').val(data.id);
          $('#edit_especialidad').val(data.especialidad);
          $('#editEspecialidadModal').modal('show');
        });
      }

      // Actualizar especialidad
      $('#editar-especialidad').submit(function(e) {
        e.preventDefault();
        var id = $('#edit_id').val();

        $.ajax({
          url: '/especialidad/' + id,
          type: 'POST',
          data: $(this).serialize() + '&_method=PUT',
          success: function(response) {
            if (response.success) {
              $('#editEspecialidadModal').modal('hide');
              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaEspecialidad.ajax.reload();
            }
          },
          error: function(xhr) {
            toastr.error(xhr.responseJSON.message, 'Error', {
              timeOut: 5000
            });
          }
        });
      });
    });
  </script>
@endsection
