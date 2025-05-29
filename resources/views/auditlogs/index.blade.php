@extends('layouts.app')
@section('title', 'Bítacora')
@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Content page -->

    <!-- Page title -->
    <x-page-header title="Bítacora" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade active in" id="list">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-auditLogs">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Nombre</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Rol</th>
                      <th class="text-center">Acción</th>
                      <th class="text-center">Fecha</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

@endsection
@section('js')
  <script>
    var tablaAuditLogs = $('#tab-auditLogs').DataTable({
      language: {
        url: './js/datatables/es-ES.json',
      },
      processing: true,
      serverSide: true,
      ajax: {
        url: "{{ route('bitacora.index') }}",
      },
      columns: [{
          data: 'id'
        },
        {
          data: 'name'
        },
        {
          data: 'email'
        },
        {
          data: 'role'
        },
        {
          data: 'auditAction'
        },
        {
          data: 'created'
        }
      ]
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
    });
  </script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

@endsection
