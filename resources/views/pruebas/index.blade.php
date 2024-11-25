@extends('layouts.app')

@section('title', 'Pruebas')

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
				<a href="#!" class="btn-search">
					<i class="zmdi zmdi-search"></i>
				</a>
			</li>
			<li>
				<a href="#!" class="btn-modal-help">
					<i class="zmdi zmdi-help-outline"></i>
				</a>
			</li>
		</ul>
	</nav>
	<div class="container-fluid">
		<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i>Pruebas</h1>
		</div>
		<p class="lead">
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					<li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
					<li><a href="#new" data-toggle="tab">Nuevo</a></li>
				</ul>
				<div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="list">
						<div class="table-responsive">
							<table class="table table-hover text-center" id="tab-historias">
								<thead>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" id="btnAreaDesarrollo">
                                            Área de Desarrollo
                                        </button>
                                        <button type="button" class="btn btn-primary" id="btnTipoPrueba">
                                            Tipos de Pruebas
                                        </button>
                                        <button type="button" class="btn btn-primary" id="btnRangoEdad">
                                            Rangos de Edades
                                        </button>
                                    </div>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Apellido</th>
										<th class="text-center">Acciones</th>
									</tr>
								</thead>
							</table>	
						</div>
					</div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal Área de Desarrollo -->
<div class="modal fade" id="modalAreaDesarrollo" tabindex="-1" role="dialog" aria-labelledby="modalAreaDesarrolloLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAreaDesarrolloLabel">Áreas de Desarrollo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="areaDesarrolloForm">
                    <div class="form-group label-floating ">
                        <label for="areaDesarrollo" class="control-label">Área de Desarrollo</label>
                        <input type="text" class="form-control" id="area_desarrollo" name="area_desarrollo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tipos de Pruebas -->
<div class="modal fade" id="modalTipoPrueba" tabindex="-1" role="dialog" aria-labelledby="modalTipoPruebaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTipoPruebaLabel">Tipos de Pruebas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tipoPruebaForm">
                    <div class="form-group label-floating ">
                        <label for="tipoPrueba" class="control-label">Tipo de Prueba</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rangos de Edades -->
<div class="modal fade" id="modalRangoEdad" tabindex="-1" role="dialog" aria-labelledby="modalRangoEdadLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRangoEdadLabel">Rangos de Edades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rangoEdadForm">
                    <div class="form-group label-floating ">
                        <label for="rangoEdad" class="control-label">Rango de Edad</label>
                        <input type="text" class="form-control" id="rango_edad" name="rango_edad" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('#btnAreaDesarrollo').click(function() {
        $('#modalAreaDesarrollo').modal('show');
    });

    $('#areaDesarrolloForm').on('submit', function(e) {
        e.preventDefault(); 

        $.ajax({
            type: 'POST',
            url: '{{ route('especialidad.store') }}', 
            data: $(this).serialize(), 
            success: function(response) {
                toastr.success(response.message, 'Éxito', { timeOut: 5000 }); // Usar toastr para mostrar el mensaje
                $('#especialidadModal').modal('hide');
                location.reload(); // Recargar la página
            },
            error: function(xhr) {
                toastr.error('Error al registrar la especialidad: ' + xhr.responseText, 'Error', { timeOut: 5000 });
            }
        });
    });

    $('#btnTipoPrueba').click(function() {
        $('#modalTipoPrueba').modal('show');
    });

    $('#btnRangoEdad').click(function() {
        $('#modalRangoEdad').modal('show');
    });
});
</script>
@endsection