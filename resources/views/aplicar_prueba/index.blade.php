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
	<!-- Content page -->
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
										<th class="text-center">Especialista</th>
                                        <th class="text-center">Informe</th>
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
                    <!-- Aquí se mostrarán las preguntas dinámicamente -->
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
@endsection
@section('js')
<script>
$(document).ready(function () {
    let subescalas = [];
    let currentStep = 0;

    // Iniciar la prueba
    $("#btnIniciarPrueba").click(function () {
        let pruebaId = $("#prueba_id").val();
        let pacienteId = $("#paciente_id").val();

        if (!pacienteId || !pruebaId) {
            alert("Seleccione un paciente y una prueba.");
            return;
        }

        $.ajax({
            url: "/aplicar-prueba/" + pruebaId,
            method: "GET",
            success: function (data) {
                subescalas = data.subescalas;

                if (subescalas.length > 0) {
                    mostrarSubescala(currentStep, data.nombre); // Pasar el nombre de la prueba
                    $("#modalPrueba").modal("show");
                } else {
                    alert("Esta prueba no tiene ítems registrados.");
                }
            },
        });
    });

    // Mostrar subescala actual
    function mostrarSubescala(step, pruebaNombre) {
        if (step < 0 || step >= subescalas.length) return;

        let subescala = subescalas[step];
        let contenido = `<h4>${subescala.sub_escala}</h4><p>${subescala.descripcion}</p><ul>`;

        subescala.items.forEach((item) => {
            contenido += `<li>${item.item}`;

            // Si la prueba es "CUMANIN", agregar campos específicos
            if (pruebaNombre === "CUMANIN") {
                if (subescala.sub_escala === "Psicomotricidad" || 
                    subescala.sub_escala === "Escritura" || 
                    subescala.sub_escala === "Estructuración espacial" || 
                    subescala.sub_escala === "Ritmo") {
                    contenido += `
                        <label>¿Con qué mano realizó la actividad?</label>
                        <input type="checkbox" name="lateralidad_${item.id}" value="derecha"> Derecha
                        <input type="checkbox" name="lateralidad_${item.id}" value="izquierda"> Izquierda
                    `;
                } else if (subescala.sub_escala === "Atención") {
                    contenido += `
                        <label>Total de cuadros marcados:</label>
                        <input type="number" name="cuadros_marcados_${item.id}">
                        <label>Total de otras figuras marcadas:</label>
                        <input type="number" name="otras_figuras_marcadas_${item.id}">
                    `;
                }
            }

            // Opciones estándar para todas las pruebas
            contenido += `
                <input type="radio" name="respuesta_${item.id}" value="si"> Sí 
                <input type="radio" name="respuesta_${item.id}" value="no"> No
            </li>`;
        });

        contenido += `</ul>`;
        $("#contenidoPrueba").html(contenido);

        // Mostrar/ocultar botones de navegación
        $("#btnAnterior").toggle(step > 0);
        $("#btnSiguiente").toggle(step < subescalas.length - 1);
        $("#btnFinalizar").toggle(step === subescalas.length - 1);
    }

    // Navegar entre subescalas
    $("#btnSiguiente").click(function () {
        currentStep++;
        mostrarSubescala(currentStep, $("#prueba_id option:selected").text());
    });

    $("#btnAnterior").click(function () {
        currentStep--;
        mostrarSubescala(currentStep, $("#prueba_id option:selected").text());
    });

    // Finalizar la prueba y enviar datos
    $("#btnFinalizar").click(function () {
        let respuestas = {};
        let lateralidad = {};

        // Recopilar respuestas estándar
        $("input[type=radio]:checked").each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        // Recopilar lateralidad si existe
        $("input[name^='lateralidad_']").each(function () {
            let itemId = $(this).attr("name").split("_")[1];
            if (!lateralidad[itemId]) {
                lateralidad[itemId] = [];
            }
            if ($(this).is(":checked")) {
                lateralidad[itemId].push($(this).val());
            }
        });

        // Recopilar cuadros marcados/otras figuras marcadas
        $("input[type=number]").each(function () {
            let name = $(this).attr("name");
            respuestas[name] = $(this).val();
        });

        // Agregar lateralidad al JSON
        respuestas["lateralidad"] = lateralidad;

        // Enviar datos al servidor
        $.ajax({
            url: "/aplicar-prueba/guardar",
            method: "POST",
            data: {
                paciente_id: $("#paciente_id").val(),
                prueba_id: $("#prueba_id").val(),
                respuestas: respuestas,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                alert("Prueba guardada correctamente.");
                $("#modalPrueba").modal("hide");
            }
        });
    });
});

</script>
@endsection