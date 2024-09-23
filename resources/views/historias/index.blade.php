@extends('layouts.app')
@section('title', 'Historias')
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
            <h1 class="text-titles"><i class="zmdi zmdi-file zmdi-hc-fw"></i>Historias</h1>
        </div>
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
									<table class="table table-hover text-center" id="tab-repre">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Paciente</th>
												<th class="text-center">Código</th>
												<th class="text-center">Acciones</th>
											</tr>
										</thead>
									
									</table>
									
								</div>
					  	</div>
							<div class="tab-pane fade in" id="new">
								<div class="container-fluid">
									<div class="row">
										<div class="col-xs-12 col-md-10 col-md-offset-1">
										<form id="registro-representante" method="POST" action="/ruta-de-registro">@csrf
											<h4>Información del Paciente</h4>
											<div class="form-row">
												<div class="form-group">
													<label class="control-label">Paciente</label>
													<select class="form-control form-control-solid select2" required style="width: 100%;" id="paciente_id" name="paciente_id">
														<option selected>Seleccione un paciente</option>
														@foreach ($pacientes as $paciente)
															<option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group label-floating col-md-6">
														<label class="control-label">Código</label>
														<input type="text" class="form-control" readonly="readonly" id="codigo" name="codigo" title="Código de la historia" placeholder="codigo" required value="{{ 'HIS' . substr(str_shuffle('0123456789'), 0, 5) }}">
													</div>
												<div class="form-group label-floating col-md-6">
													<label class="control -label">Referencia</label>
													<input class="form-control" id="referencia" name="referencia" type="text" required>
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Especialista que Refirió</label>
													<input class="form-control" id="especialista_refirio" name="especialista_refirio" type="text" required>
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Motivo</label>
													<input class="form-control" id="motivo" name="motivo" type="text" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Tipo de vivienda</label>
													<select name="tipo_vivienda" class="form-control">
														<option value="" disabled selected>Tipo de Vivienda</option>
														<option value="casa_unifamiliar" title="Vivienda independiente para una sola familia.">Casa Unifamiliar</option>
														<option value="apartamento" title="Unidad de vivienda en un edificio, puede variar en tamaño.">Apartamento</option>
														<option value="vivienda_social" title="Proyectos habitacionales para familias de bajos recursos.">Vivienda Social</option>
														<option value="vivienda_precaria" title="Construcciones informales, a menudo sin servicios básicos.">Vivienda Precaria</option>
													</select>
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Cantidad de Habitaciones</label>
													<input class="form-control" type="number" id="cantidad_habitaciones" name="cantidad_habitaciones" required min="0" oninput="validarNumero(this)">
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Cantidad de Personas</label>
													<input class="form-control" type="number" id="cantidad_personas" name="cantidad_personas" required min="0" oninput="actualizarMiembros()">
												</div>
												
												<div id="miembros-container" class="col-md-6">
													<h5>Personas que viven en la vivienda</h5>
												</div>
												<button type="button" class="btn btn-primary" id="agregar-miembro" onclick="agregarMiembro()">Agregar Miembro</button>
												<!-- Nuevas secciones para servicios -->
												<div class="form-group label-floating col-md-6">
													<h5>¿Servicio de Agua Potable?</h5>
													<div>
														<label><input type="radio" name="servicio_agua_potable" value="si" required> Sí</label>
														<label><input type="radio" name="servicio_agua_potable" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Gas?</h5>
													<div>
														<label><input type="radio" name="servicio_gas" value="si" required> Sí</label>
														<label><input type="radio" name="servicio_gas" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Electricidad?</h5>
													<div>
														<label><input type="radio" name="servicio_electricidad" value="si" required> Sí</label>
														<label><input type="radio" name="servicio_electricidad" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Drenaje?</h5>
													<div>
														<label><input type="radio" name="servicio_drenaje" value="si" required> Sí</label>
														<label><input type="radio" name="servicio_drenaje" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Acceso a Servicios Públicos?</h5>
													<div>
														<label><input type="radio" name="acceso_servcios_publicos" value="si" required> Sí</label>
														<label><input type="radio" name="acceso_servcios_publicos" value="no"> No</label>
													</div>
												</div>
												<div class="form-group col-md-6">
													<h5>¿Servicio de Internet?</h5>
													<div>
														<label><input type="radio" name="disponibilidad_internet" value="si" required onclick="toggleInput()"> Sí</label>
														<label><input type="radio" name="disponibilidad_internet" value="no" onclick="toggleInput()"> No</label>
													</div>
												</div>
												<div class="form-group label-floating col-md-6">
													<input class="form-control" id="tipo_conexion_internet" name="tipo_conexion_internet" type="text" placeholder="Tipo de conexión">
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Fuente de Ingreso Familiar</label>
													<input class="form-control" id="fuente_ingreso_familiar" name="fuente_ingreso_familiar" type="text" required>
												</div>
											</div>
											<h5>Antecedentes Médicos</h5>
											<div class="form-row">
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño ha sufrido de alguna enfermedad infecciosa?</h5>
													<div>
														<label>
															<input type="radio" name="enfermedad_infecciosa" value="si" required onclick="toggleInput('tipo_enfermedadinfecciosa')"> Sí
														</label>
														<label>
															<input type="radio" name="enfermedad_infecciosa" value="no" onclick="toggleInput('tipo_enfermedadinfecciosa')"> No
														</label>
													</div>
												</div>
												<div id="tipo_enfermedadinfecciosa" class="tipo-input" style="display: none;">
													<input class="form-control" type="text" placeholder="Especificar enfermedad infecciosa">
												</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño ha sufrido de alguna enfermedad no infecciosa?</h5>
													<div>
														<label><input type="radio" name="enfermedad_no_infecciosa" value="si" required onclick="toggleInput('tipo_enfermedad_no_infecciosa')"> Sí</label>
														<label><input type="radio" name="enfermedad_no_infecciosa" value="no" onclick="toggleInput('tipo_enfermedad_no_infecciosa')"> No</label>
													</div>
												</div>
												<div id="tipo_enfermedad_noinfecciosa" class="tipo-input" style="display: none;">
														<input class="form-control" id="tipo_enfermedad_no_infecciosa" type="text" placeholder="Especificar enfermedad no infecciosa">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño padece de alguna enfermedad crónica?</h5>
													<div>
														<label><input type="radio" name="enfermedad_cronica" value="si" required onclick="toggleInput('tipo_enfermedad_cronica')"> Sí</label>
														<label><input type="radio" name="enfermedad_cronica" value="no" onclick="toggleInput('tipo_enfermedad_cronica')"> No</label>
													</div>
												</div>
												<div id="tipo_enfermedadcronica" class="tipo-input" style="display: none;">
														<input class="form-control" id="tipo_enfermedad_cronica" type="text" placeholder="Especificar enfermedad crónica">
													</div>
												<div class="form-group label-floating col-md-6">
													<h5>¿El niño padece de alguna discapacidad?</h5>
													<div>
														<label><input type="radio" name="discapacidad" value="si" required onclick="toggleInput('tipo_discapacidad')"> Sí</label>
														<label><input type="radio" name="discapacidad" value="no" onclick="toggleInput('tipo_discapacidad')"> No</label>
													</div>
												</div>
												<div id="tipodiscapacidad" class="tipo-input" style="display: none;">
													<input class="form-control" id="tipo_discapacidad" type="text" placeholder="Especificar discapacidad">
												</div>
												<div class="form-group label-floating col-md-6">
													<label class="control-label">Otras</label>
													<input class="form-control" id="otros" name="otros" type="text" required>
												</div>
											</div>

											<h5>Historia Escolar</h5>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="control-label">¿Está Escolarizado?</label>
													<select class="form-control" name="escolarizado" required>
														<option value="si">Sí</option>
														<option value="no">No</option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label class="control-label">Dificultades en Lectura</label>
													<input class="form-control" type="text" name="dificultad_lectura">
												</div>
												<!-- Agrega más campos según sea necesario -->
											</div>

											<h5>Historia de Desarrollo</h5>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label class="control-label">Medicamento Durante el Embarazo</label>
													<input class="form-control" type="text" name="medicamento_embarazo">
												</div>
												<div class="form-group col-md-6">
													<label class="control-label">Complicaciones al Nacer</label>
													<input class="form-control" type="text" name="complicaciones_nacer">
												</div>
												<!-- Agrega más campos según sea necesario -->
											</div>

											<p class="text-center">
												<button type="submit" name="registrar" class="btn btn-primary">
													<i class="zmdi zmdi-floppy"></i> Registrar
												</button>
											</p>
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

@endsection
@section('js')
<script>
function validarNumero(input) {
    // Reemplaza cualquier carácter que no sea un número o que sea negativo
    input.value = input.value.replace(/[^0-9]/g, '');
}
</script>
<script>
function cambiarColor(radio) {
    // Obtener el label padre del radio button
    const label = radio.closest('div').previousElementSibling;
    // Agregar o quitar la clase highlight
    if (radio.checked) {
        label.classList.add('highlight');
    } else {
        label.classList.remove('highlight');
    }
}
</script>
<script>
function toggleInput() {
    const internetYes = document.querySelector('input[name="disponibilidad_internet"][value="si"]');
    const tipoConexionInput = document.getElementById('tipo_conexion_internet');

    // Mostrar u ocultar el input basado en la selección del radio button
    if (internetYes.checked) {
        tipoConexionInput.style.display = 'block'; // Mostrar el input
    } else {
        tipoConexionInput.style.display = 'none'; // Ocultar el input
        tipoConexionInput.value = ''; // Limpiar el valor del input al ocultarlo
    }
}
</script>
<script>
function actualizarMiembros() {
    const cantidadPersonas = document.getElementById('cantidad_personas').value;
    const miembrosContainer = document.getElementById('miembros-container');

    // Limpiar el contenedor de miembros
    miembrosContainer.innerHTML = '<h5>Personas que viven en la vivienda</h5>';

    // Agregar los campos de entrada según la cantidad de personas
    for (let i = 0; i < cantidadPersonas; i++) {
        const miembroDiv = document.createElement('div');
        miembroDiv.className = 'miembro';

        miembroDiv.innerHTML = `
            <input class="form-control" type="text" name="nombre[]" placeholder="Nombre" required>
            <input class="form-control" type="text" name="apellido[]" placeholder="Apellido" required>
            <input class="form-control" type="date" name="fecha_nac[]" required id="fecha_nac_${i}">
            <input class="form-control" type="text" name="parentesco[]" placeholder="Parentesco" required>
            
            <h5>¿Tiene alguna discapacidad?</h5>
            <div>
                <label><input type="radio" name="discapacidad_${i}" value="si" onclick="toggleTipoDiscapacidad(${i})"> Sí</label>
                <label><input type="radio" name="discapacidad_${i}" value="no" onclick="toggleTipoDiscapacidad(${i})"> No</label>
            </div>
            <div id="tipo-discapacidad-${i}" class="tipo-input" style="display: none;">
                <input class="form-control" type="text" name="tipo_discapacidad[]" placeholder="Tipo de discapacidad" required>
            </div>

            <h5>¿Tiene alguna enfermedad crónica?</h5>
            <div>
                <label><input type="radio" name="enfermedad_cronica_${i}" value="si" onclick="toggleTipoEnfermedad(${i})"> Sí</label>
                <label><input type="radio" name="enfermedad_cronica_${i}" value="no" onclick="toggleTipoEnfermedad(${i})"> No</label>
            </div>
            <div id="tipo-enfermedad-${i}" class="tipo-input" style="display: none;">
                <input class="form-control" type="text" name="tipo_enfermedad[]" placeholder="Tipo de enfermedad crónica" required>
            </div>

            <button type="button" class="eliminar btn btn-primary" onclick="eliminarMiembro(this)">Eliminar</button>
        `;

        miembrosContainer.appendChild(miembroDiv);
        
        // Establecer la fecha máxima para el campo de fecha de nacimiento
        const today = new Date().toISOString().split('T')[0];
        document.getElementById(`fecha_nac_${i}`).setAttribute('max', today);
    }
}

function toggleTipoDiscapacidad(index) {
    const tipoDiscapacidadInput = document.getElementById(`tipo-discapacidad-${index}`);
    const radios = document.getElementsByName(`discapacidad_${index}`);
    tipoDiscapacidadInput.style.display = radios[0].checked ? 'block' : 'none';
}

function toggleTipoEnfermedad(index) {
    const tipoEnfermedadInput = document.getElementById(`tipo-enfermedad-${index}`);
    const radios = document.getElementsByName(`enfermedad_cronica_${index}`);
    tipoEnfermedadInput.style.display = radios[0].checked ? 'block' : 'none';
}

function agregarMiembro() {
    const miembrosContainer = document.getElementById('miembros-container');
    const miembroDiv = document.createElement('div');
    miembroDiv.className = 'miembro';

    const index = miembrosContainer.children.length; // Obtener el índice basado en el número de hijos actuales

    miembroDiv.innerHTML = `
        <input class="form-control" type="text" name="nombre[]" placeholder="Nombre" required>
        <input class="form-control" type="text" name="apellido[]" placeholder="Apellido" required>
        <input class="form-control" type="date" name="fecha_nac[]" required id="fecha_nac_${index}">
        <input class="form-control" type="text" name="parentesco[]" placeholder="Parentesco" required>
        
        <h5>¿Tiene alguna discapacidad?</h5>
        <div>
            <label><input type="radio" name="discapacidad_${index}" value="si" onclick="toggleTipoDiscapacidad(${index})"> Sí</label>
            <label><input type="radio" name="discapacidad_${index}" value="no" onclick="toggleTipoDiscapacidad(${index})"> No</label>
        </div>
        <div id="tipo-discapacidad-${index}" class="tipo-input" style="display: none;">
            <input class="form-control" type="text" name="tipo_discapacidad[]" placeholder="Tipo de discapacidad" required>
        </div>

        <h5>¿Tiene alguna enfermedad crónica?</h5>
        <div>
            <label><input type="radio" name="enfermedad_cronica_${index}" value="si" onclick="toggleTipoEnfermedad(${index})"> Sí</label>
            <label><input type="radio" name="enfermedad_cronica_${index}" value="no" onclick="toggleTipoEnfermedad(${index})"> No</label>
        </div>
        <div id="tipo-enfermedad-${index}" class="tipo-input" style="display: none;">
            <input class="form-control" type="text" name="tipo_enfermedad[]" placeholder="Tipo de enfermedad crónica" required>
        </div>

        <button type="button" class="eliminar btn btn-primary" onclick="eliminarMiembro(this)">Eliminar</button>
    `;

    miembrosContainer.appendChild(miembroDiv);
    
    // Establecer la fecha máxima para el campo de fecha de nacimiento
    const today = new Date().toISOString().split('T')[0];
    document.getElementById(`fecha_nac_${index}`).setAttribute('max', today);
}

function eliminarMiembro(button) {
    const miembroDiv = button.parentElement;
    miembroDiv.remove();
}
</script>
<script>
function toggleInput(radioName) {
    const radioYes = document.querySelector(`input[name="${radioName}"][value="si"]`);
    const inputDiv = document.getElementById('tipo_enfermedadinfecciosa'); // Usar la ID correcta

    // Mostrar u ocultar el input basado en la selección del radio button
    if (radioYes.checked) {
        inputDiv.style.display = 'block'; // Mostrar el input
    } else {
        inputDiv.style.display = 'none'; // Ocultar el input
        // Limpiar el valor del input al ocultarlo (opcional)
        const inputField = inputDiv.querySelector('input');
        if (inputField) {
            inputField.value = ''; // Limpiar el valor del input
        }
    }
}
@endsection