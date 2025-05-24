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
          <div class="table-responsive">
            <table class="table table-hover text-center" id="tab-especialidad">
              <thead>
                <button id="btnNuevaEspecialidad" class="btn btn-custom" style="color: white;">
                  <i class="zmdi zmdi-plus"></i> Nueva Especialidad
                </button>
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal para nueva especialidad -->
  <div class="modal fade" id="modalNuevaEspecialidad" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Nueva Especialidad</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formNuevaEspecialidad">
            @csrf
            <div class="form-group label-floating">
              <label class="control-label">Nombre de la especialidad</label>
              <input class="form-control" type="text" name="especialidad" required maxlength="30">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-custom" style="color: white;">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal editar -->
  <div class="modal fade" id="modalEditarEspecialidad" tabindex="-1" role="dialog">
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
            <div class="form-group label-floating">
              <label class="control-label">Nombre de la especialidad</label>
              <input class="form-control" type="text" name="especialidad" id="especialidad_nombre" required
                maxlength="30">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-custom" style="color: white;">Guardar cambios</button>
            </div>
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

      // Mostrar modal para nueva especialidad
      $('#btnNuevaEspecialidad').click(function() {
        $('#formNuevaEspecialidad')[0].reset();
        $('#modalNuevaEspecialidad').modal('show');
      });

      // Registrar nueva especialidad
      $('#formNuevaEspecialidad').submit(function(e) {
        e.preventDefault();

        $.ajax({
          url: "{{ route('especialidad.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#modalNuevaEspecialidad').modal('hide');
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

      // Función para editar especialidad
      window.editEspecialidad = function(id) {
        $.get('/especialidad/' + id + '/edit', function(data) {
          $('#especialidad_id').val(data.id);
          $('#especialidad_nombre').val(data.especialidad);
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
            toastr.error(xhr.responseJSON.message, 'Error', {
              timeOut: 5000
            });
          }
        });
      });
    });
  </script>
@endsection
