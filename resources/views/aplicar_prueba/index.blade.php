@extends('layouts.app')

@section('title', 'Pruebas')

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
			<h1 class="text-titles"><i class="zmdi zmdi-assignment zmdi-hc-fw"></i>Pruebas</h1>
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
							<table class="table table-hover text-center" id="tab-prueba">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Paciente</th>
										<th class="text-center">Prueba</th>
										<th class="text-center">Fecha</th>
                                        <th class="text-center">resultados</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
					<div class="tab-pane fade in" id="new">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-10 col-md-offset-1">
									<form id="formAplicarPrueba">
										<div class="form-group">
											<label for="paciente_id">Paciente</label>
											<select id="paciente_id" class="form-control">
												<option value="">Seleccione un paciente</option>
												@foreach($pacientes as $paciente)
													<option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="especialista">Especialista</label>
											<input type="text" id="especialista" class="form-control" value="{{ auth()->user()->name }}" disabled>
										</div>
										<div class="form-group">
											<label for="prueba_id">Prueba</label>
											<select id="prueba_id" class="form-control">
												<option value="">Seleccione una prueba</option>
												@foreach($pruebas as $prueba)
													<option value="{{ $prueba->id }}">{{ $prueba->nombre }}</option>
												@endforeach
											</select>
										</div>
										<button type="button" id="btnIniciarPrueba" class="btn btn-primary">Aplicar Prueba</button>
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
<div id="modalPrueba" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aplicación de Prueba</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="contenidoPrueba">
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnAnterior" class="btn btn-secondary" style="display: none;">Anterior</button>
                <button id="btnSiguiente" class="btn btn-primary">Siguiente</button>
                <button id="btnFinalizar" class="btn btn-success" style="display: none;">Finalizar</button>
            </div>
        </div>
    </div>
</div>
<div id="modalPruebaVer" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resultados de la Prueba</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="contenidoPruebaVer"> <!-- Cambié el ID aquí -->
                    <p>Cargando resultados...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnCerrar" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
$(document).ready(function () {
    let subescalas = [];
    let currentStep = 0;

    $("#btnIniciarPrueba").click(function () {
        let pruebaId = $("#prueba_id").val();
        let pacienteId = $("#paciente_id").val();
        let tipoPrueba = $("#prueba_id option:selected").data("tipo");
        let pruebaNombre = $("#prueba_id option:selected").text();

        if (!pacienteId || !pruebaId) {
            alert("Seleccione un paciente y una prueba.");
            return;
        }

        $.ajax({
            url: "/aplicar-prueba/" + pruebaId,
            method: "GET",
            success: function (data) {
    console.log(data); 
    subescalas = data.subescalas;
    if (subescalas.length > 0) {
        $("#modalPrueba").modal("show");
        $("#elementoDelModal").text(subescalas.join(", ")); 

        iniciarPruebaCumanin(subescalas);
    } else {
        alert("Esta prueba no tiene ítems registrados.");
    }
},
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error);
            }
        });
    });
});
</script>
<script>
$(document).ready(function () {
    $('#tab-prueba').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("aplicar_prueba.index") }}', 
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' }, 
            { data: 'paciente.nombre', name: 'paciente.nombre' }, 
			{ data: 'prueba.nombre', name: 'prueba.nombre' }, 
			{ data: 'fecha', name: 'fecha' }, 
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $(document).on('click', '.ver-resultados', function () {
        let aplicacionId = $(this).data('id'); 

        $.ajax({
            url: '/aplicar-prueba/ver-respuestas/' + aplicacionId, 
            method: 'GET',
            success: function (data) {
                $("#contenidoPrueba").html(`
                    <h5>Paciente: ${data.paciente.nombre}</h5>
                    <h5>Prueba: ${data.prueba.id}</h5>
                    <h5>Resultados: ${JSON.stringify(data.prueba.resultados)}</h5>
                    <h5>Fecha: ${data.prueba.created_at}</h5>
                `);
                $("#modalPrueba").modal("show");
            },
            error: function (xhr, status, error) {
                console.error("Error al obtener los resultados:", status, error);
            }
        });
    });
});
</script>
<script>
$(document).on('click', '.ver-resultados', function () {
    let aplicacionId = $(this).data('id'); // Obtener el ID de la aplicación de prueba

    $.ajax({
        url: `/aplicar-prueba/ver-respuestas/${aplicacionId}`, 
        method: 'GET',
        success: function (data) {
            let resultados = data.prueba.resultados;
            
            let contenidoHTML = `
                <h5><strong>Paciente:</strong> ${data.paciente.nombre}</h5>
                <h5><strong>Prueba:</strong> ${data.prueba.nombre}</h5>
                <h5><strong>Fecha:</strong> ${data.prueba.fecha || 'No disponible'}</h5>
                <hr>
                <h5><strong>Resultados:</strong></h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subescala</th>
                            <th>Puntaje</th>
                            <th>Percentil</th>
                        </tr>
                    </thead>
                    <tbody>`;

            if (resultados && resultados.resultados) {
                for (let clave in resultados.resultados) {
                    let resultado = resultados.resultados[clave];
                    let puntaje = resultado.puntaje ?? 'N/A';
                    let percentil = resultado.percentil ?? 'No disponible';

                    contenidoHTML += `
                        <tr>
                            <td><strong>${clave}</strong></td>
                            <td>${puntaje}</td>
                            <td>${percentil}</td>
                        </tr>`;
                }
            } else {
                contenidoHTML += `<tr><td colspan="3" class="text-center">No hay resultados disponibles</td></tr>`;
            }

            contenidoHTML += `
                    </tbody>
                </table>`;

            if (resultados.lateralidad) {
                contenidoHTML += `<h5><strong>Lateralidad:</strong> ${resultados.lateralidad}</h5>`;
            }

            if (resultados.observaciones) {
                contenidoHTML += `<h5><strong>Observaciones:</strong> ${resultados.observaciones}</h5>`;
            }

            // Insertar el contenido en el modal correcto
            $("#contenidoPruebaVer").html(contenidoHTML);
            $("#modalPruebaVer").modal("show"); // Asegurar que solo este modal se abre
        },
        error: function (xhr, status, error) {
            console.error("❌ Error al obtener los resultados:", status, error);
            alert("No se encontraron resultados para esta prueba.");
        }
    });
});

</script>
@endsection