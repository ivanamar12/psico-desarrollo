@extends('layouts.root')

@section('title', 'Notificaciones')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Notificaciones" icon="zmdi zmdi-notifications-active zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
          </ul>

          <section id="myTabContent" class="tab-content">
            <!-- Pestaña Lista -->
            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <div class="text-right mb-3">
                  <button id="btn-marcar-todas" class="btn btn-custom" style="color: white;">
                    <i class="zmdi zmdi-check-all"></i> Marcar todas como leídas
                  </button>
                </div>
                <table class="table table-hover text-center" id="tab-notificaciones">
                  <thead>
                    <tr>
                      <th style="text-align: center">Título</th>
                      <th style="text-align: center">Mensaje</th>
                      <th style="text-align: center">Fecha</th>
                      <th style="text-align: center">Estado</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal confirmación eliminación -->
  <section class="modal fade" id="modalEliminarNotificacion" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Eliminar Notificación</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="text-align: center">¿Estás seguro que deseas eliminar esta notificación?</p>
          <form id="formEliminarNotificacion">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="notificacion_id">
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
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      var tablaNotificaciones = $('#tab-notificaciones').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: false,
        ajax: {
          url: "{{ route('notificaciones.get') }}",
          dataSrc: 'notifications'
        },
        columns: [{
            data: 'data.title',
            render: function(data) {
              return data || 'Sin título';
            }
          },
          {
            data: 'data.message',
            render: function(data) {
              return data || 'Sin mensaje';
            }
          },
          {
            data: 'created_at'
          },
          {
            data: 'read_at',
            render: function(data) {
              return data ?
                '<span class="badge badge-success">Leída</span>' :
                '<span class="badge badge-warning">No leída</span>';
            }
          },
          {
            data: 'id',
            orderable: false,
            searchable: false,
            render: function(data) {
              return `
                <button onclick="marcarLeida('${data}')" class="btn btn-success btn-raised btn-xs" title="Marcar como leída">
                  <i class="zmdi zmdi-check"></i>
                </button>
                <button onclick="mostrarModalEliminar('${data}')" class="btn btn-danger btn-raised btn-xs" title="Eliminar">
                  <i class="zmdi zmdi-delete"></i>
                </button>
              `;
            }
          }
        ],
        createdRow: function(row, data) {
          if (!data.read_at) {
            $(row).css('background-color', '#f9f9f9');
            $(row).css('font-weight', '500');
          }
        }
      });

      // Marcar todas como leídas
      $('#btn-marcar-todas').click(function() {
        $.post("{{ route('notificaciones.marcar-todas') }}", {
          _token: "{{ csrf_token() }}"
        }, function(response) {
          if (response.success) {
            toastr.success(response.message, 'Éxito', {
              timeOut: 5000
            });
            tablaNotificaciones.ajax.reload();
            // Esta funcion la obtenemos de el componente de notificaciones
            cargarNotificaciones();
          }
        }).fail(function(xhr) {
          toastr.error(xhr.responseJSON.message, 'Error', {
            timeOut: 5000
          });
        });
      });
    });

    function marcarLeida(id) {
      window.location.href = `/notificaciones/redirigir/${id}`;
    }

    function mostrarModalEliminar(id) {
      $('#notificacion_id').val(id);
      $('#modalEliminarNotificacion').modal('show');
    }

    // Eliminar notificación
    $('#formEliminarNotificacion').submit(function(e) {
      e.preventDefault();
      var id = $('#notificacion_id').val();

      $.ajax({
        url: '/notificaciones/' + id,
        type: 'POST',
        data: $(this).serialize() + '&_method=DELETE',
        success: function(response) {
          if (response.success) {
            $('#modalEliminarNotificacion').modal('hide');
            toastr.success(response.message, 'Éxito', {
              timeOut: 5000
            });
            $('#tab-notificaciones').DataTable().ajax.reload();
            // Esta funcion la obtenemos de el componente de notificaciones
            cargarNotificaciones();
          }
        },
        error: function(xhr) {
          toastr.error(xhr.responseJSON.message, 'Error', {
            timeOut: 5000
          });
        }
      });
    });
  </script>
@endsection
