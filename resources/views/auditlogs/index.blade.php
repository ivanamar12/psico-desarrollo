@extends('layouts.root')

@section('title', 'Bítacora')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

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
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Rol</th>
                      <th style="text-align: center">Acción</th>
                      <th style="text-align: center">Fecha</th>
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
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

  <script>
    var tablaAuditLogs = $('#tab-auditLogs').DataTable({
      language: {
        url: "{{ asset('js/datatables/es-ES.json') }}",
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
@endsection
