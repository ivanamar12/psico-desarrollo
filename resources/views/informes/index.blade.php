@extends('layouts.app')

@section('title', 'Informes')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Informes" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('generar informes'))
              <li><a href="#new-informe" data-toggle="tab"> Nuevo</a></li>
            @endif
          </ul>

          <section id="myTabContent" class="tab-content">
            <!-- Pestaña Lista -->
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

            <!-- Pestaña Nuevo -->
            <div class="tab-pane fade" id="new">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    
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
  
@endsection

@section('js')
@endsection
