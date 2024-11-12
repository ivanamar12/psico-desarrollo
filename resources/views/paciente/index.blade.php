@extends('layouts.app')

@section('title', 'Pacientes')

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
			  <h1 class="text-titles"><i class="zmdi zmdi-face zmdi-hc-fw"></i>Pacientes</h1>
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
							<table class="table table-hover text-center" id="tab-paciente">
								<thead>
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
                    <div class="tab-pane fade in" id="new">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-md-10 col-md-offset-1">
                                    <form id="registro-paciente">@csrf
                                        <div id="paso1">
                                            <h3>Datos Personales</h3>
                                            <div class="fila-formulario">
                                                <div class="form-group label-floating col-md-6">
                                                    <select class="form-control form-control-solid select2" required style="width: 100%;" id="representante_id" name="representante_id">
                                                        <option selected disabled>Seleccione el representante</option>
                                                    </select>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Nombre</label>
                                                    <input class="form-control" id="nombre" name="nombre" type="text">
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Apellido</label>
                                                    <input class="form-control" id="apellido" name="apellido" type="text" required>
                                                </div>
                                                <div class="form-group  col-md-6">
                                                    <input class="form-control" type="date" name="fecha_nac" id="fecha_nac" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control select2" required style="width: 100%;" id="genero_id" name="genero_id">
                                                        <option selected disabled>Seleccione su género</option>
                                                            @foreach ($generos as $genero)
                                                        <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="siguiente1" class="btn btn-primary">Siguiente</button>
                                            </p>
                                        </div>
                                        <div id="paso2">
                                            <h3>Datos Familiares</h3>
                                            <div id="miembrosContainer">
                                                <div class="fila-formulario" id="formulario-familiar-0">
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Nombre</label>
                                                        <input class="form-control" name="familiares[0][nombre]" type="text" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Apellido</label>
                                                        <input class="form-control" name="familiares[0][apellido]" type="text" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input class="form-control" type="date" name="familiares[0][fecha_nac]" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Parentesco</label>
                                                        <input class="form-control" name="familiares[0][parentesco]" type="text" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Género</label>
                                                        <select class="form-control select2" required style="width: 100%;" name="familiares[0][genero_id]">
                                                            <option selected disabled>Seleccione su género</option>
                                                            @foreach ($generos as $genero)
                                                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <h5>¿Tiene alguna discapacidad?</h5>
                                                        <div>
                                                            <label><input type="radio" name="familiares[0][discapacidad]" value="si" required onclick="toggleTipoDiscapacidad(0)"> Sí</label>
                                                            <label><input type="radio" name="familiares[0][discapacidad]" value="no" onclick="toggleTipoDiscapacidad(0)"> No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <input class="form-control" id="tipo-discapacidad-0" name="familiares[0][tipo_discapacidad]" type="text" style="display: none;" placeholder="Describa el tipo de discapacidad">
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <h5>¿Tiene alguna enfermedad crónica?</h5>
                                                        <div>
                                                            <label><input type="radio" name="familiares[0][enfermedad_cronica]" value="si" required onclick="toggleTipoEnfermedad(0)"> Sí</label>
                                                            <label><input type="radio" name="familiares[0][enfermedad_cronica]" value="no" onclick="toggleTipoEnfermedad(0)"> No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <input class="form-control" id="tipo-enfermedad-0" name="familiares[0][tipo_enfermedad]" type="text" style="display: none;" placeholder="Describa el tipo de Enfermedad">
                                                    </div>
                                                    <button type="button" class="eliminar btn btn-danger" onclick="eliminarMiembro(this)">Eliminar</button>
                                                </div>
                                            </div>
                                            <p class="centro-texto">
                                                <button type="button" id="agregarFamiliar" class="btn btn-primary">Agregar Familiar</button>
                                                <button type="button" id="siguiente2" class="btn btn-primary">Siguiente</button>
                                            </p>
                                        </div>
                                        <div id= "paso3">
                                            <h3>Datos Socioeconómicos</h3>
                                            <div class="fila-formulario">
                                                <div class="form-group label-floating col-md-6">
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
                                                <div class="form-group label-floating col-md-6">
                                                    <h5>¿Servicio de Agua Potable?</h5>
                                                    <div>
                                                        <label><input type="radio" name="servecio_agua_potable" value="si" required> Sí</label>
                                                        <label><input type="radio" name="servecio_agua_potable" value="no"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h5>¿Servicio de Gas?</h5>
                                                    <div>
                                                        <label><input type="radio" name="servecio_gas" value="si" required> Sí</label>
                                                        <label><input type="radio" name="servecio_gas" value="no"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h5>¿Servicio de Electricidad?</h5>
                                                    <div>
                                                        <label><input type="radio" name="servecio_electricidad" value="si" required> Sí</label>
                                                        <label><input type="radio" name="servecio_electricidad" value="no"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <h5>¿Servicio de Drenaje?</h5>
                                                    <div>
                                                        <label><input type="radio" name="servecio_drenaje" value="si" required> Sí</label>
                                                        <label><input type="radio" name="servecio_drenaje" value="no"> No</label>
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
                                                        <label><input type="radio" name="disponibilidad_internet" value="si" required onclick="toggleInterInput()"> Sí</label>
                                                        <label><input type="radio" name="disponibilidad_internet" value="no" onclick="toggleInterInput()"> No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <input class="form-control" id="tipo_conexion_internet" name="tipo_conexion_internet"  type="text" placeholder="Especificar el tipo de conexion de internet">
                                                </div>
                                                <div class="form-group label-floating col-md-6">
                                                    <label class="control-label">Fuente de Ingreso Familiar</label>
                                                    <input class="form-control" id="fuente_ingreso_familiar" name="fuente_ingreso_familiar" type="text" required>
                                                </div>
                                            </div>
                                            <p class="centro-texto">
												<button type="button" id="regresar" class="btn btn-secondary"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
												<button type="submit" name="registrar" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i>Registrar</button>
											</p>
                                        </div>
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
<div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el registro seleccionado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('js')
<script>
$(document).ready(function() {
    const representantes = @json($representantes); 
    console.log(representantes); 
    $('#representante_id').select2({
        placeholder: "Seleccione el representante",
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
            transport: function(params, success, failure) {
                const searchTerm = params.data.term.toLowerCase().trim();
                const filteredRepresentantes = representantes.filter(representante =>
                    representante.ci.toLowerCase().includes(searchTerm)
                );

                console.log(filteredRepresentantes); 

                const results = filteredRepresentantes.map(representante => ({
                    id: representante.id,
                    text: `${representante.nombre} ${representante.apellido} (CI: ${representante.ci})`
                }));

                success({ results: results });
            }
        }
    });
});
</script>
<script>
$(document).ready(function() {
    let contador = 1;
    $("#paso1").show();
    $("#paso2").hide();
    $("#paso3").hide();

    function establecerFechaMaximaFamiliares() {
        const fechaNacFamiliarInputs = document.querySelectorAll('input[name="fecha_nac_familiar[]"]');
        const fechaActual = new Date();
        const anio = fechaActual.getFullYear();
        const mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
        const dia = String(fechaActual.getDate()).padStart(2, '0');
        fechaNacFamiliarInputs.forEach(input => {
            input.max = `${anio}-${mes}-${dia}`;
        });
    }

    $("#siguiente1").click(function() {
        if ($("#representante_id").val() && $("#apellido").val()) {
            $("#paso1").hide();
            $("#paso2").show();
        } else {
            toastr.error("Por favor, complete todos los campos requeridos en este paso.");
        }
    });

    $("#agregarFamiliar").click(function() {
        const nuevoFormulario = `<div class="fila-formulario" id="formulario-familiar-${contador}">
            <div class="form-group label-floating col-md-6">
                <label class="control-label">Nombre</label>
                <input class="form-control" name="familiares[${contador}][nombre]" type="text" required>
            </div>
            <div class="form-group label-floating col-md-6">
                <label class="control-label">Apellido</label>
                <input class="form-control" name="familiares[${contador}][apellido]" type="text" required>
            </div>
            <div class="form-group col-md-6">
                <input class="form-control" type="date" name="familiares[${contador}][fecha_nac]" required>
            </div>
            <div class="form-group label-floating col-md-6">
                <label class="control-label">Parentesco</label>
                <input class="form-control" name="familiares[${contador}][parentesco]" type="text" required>
            </div>
            <div class="form-group label-floating col-md-6">
                <label class="control-label">Género</label>
                <select class="form-control select2" required style="width: 100%;" name="familiares[${contador}][genero_id]">
                    <option selected disabled>Seleccione su género</option>
                    @foreach ($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group label-floating col-md-6">
                <h5>¿Tiene alguna discapacidad?</h5>
                <div>
                    <label><input type="radio" name="familiares[${contador}][discapacidad]" value="si" required onclick="toggleTipoDiscapacidad(${contador})"> Sí</label>
                    <label><input type="radio" name="familiares[${contador}][discapacidad]" value="no" onclick="toggleTipoDiscapacidad(${contador})"> No</label>
                </div>
            </div>
            <div class="form-group label-floating col-md-6">
                <input class="form-control" id="tipo-discapacidad-${contador}" name="familiares[${contador}][tipo_discapacidad]" type="text" style="display: none;" placeholder="Describa el tipo de discapacidad">
            </div>
            <div class="form-group label-floating col-md-6">
                <h5>¿Tiene alguna enfermedad crónica?</h5>
                <div>
                    <label><input type="radio" name="familiares[${contador}][enfermedad_cronica]" value="si" required onclick="toggleTipoEnfermedad(${contador})"> Sí</label>
                    <label><input type="radio" name="familiares[${contador}][enfermedad_cronica]" value="no" onclick="toggleTipoEnfermedad(${contador})"> No</label>
                </div>
            </div>
            <div class="form-group label-floating col-md-6">
                <input class="form-control" id="tipo-enfermedad-${contador}" name="familiares[${contador}][tipo_enfermedad]" type="text" style="display: none;" placeholder="Describa el tipo de Enfermedad">
            </div>
            <button type="button" class="eliminar btn btn-danger" onclick="eliminarMiembro(this)">Eliminar</button>
        </div>`;
        $("#miembrosContainer").append(nuevoFormulario);
        contador++;
    });

    $("#siguiente2").click(function() {
        $("#paso2").hide();
        $("#paso3").show();
    });

    $("#regresar").click(function() {
        $("#paso3").hide();
        $("#paso2").show();
    });

    $("#registro-paciente").on("submit", function(event) {
        event.preventDefault(); 
        const formData = $(this).serialize(); 
        console.log(formData); 
        $.ajax({
            url: "{{ route('paciente.store') }}", 
            type: 'POST', 
            data: formData, 
            success: function(response) {
                console.log(response); 
                toastr.success("Paciente registrado exitosamente."); 
                $("#registro-paciente")[0].reset(); 
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                toastr.error("Error al registrar el paciente: " + xhr.responseText); 
            }
        });
    });


    $(document).on('click', 'input[name^="enfermedad_cronica_"]', function() {
        const index = $(this).attr('name').split('_')[2]; 
        toggleTipoEnfermedad(index);
    });

    establecerFechaMaximaFamiliares();
});

function eliminarMiembro(button) {
    $(button).closest('.fila-formulario').remove();
}

function toggleTipoDiscapacidad(index) {
    const disponibilidadDiscapacidadYes = document.querySelector(`input[name="discapacidad_${index}"][value="si"]`);
    const tipoDiscapacidadInput = document.getElementById(`tipo-discapacidad-${index}`);
    if (disponibilidadDiscapacidadYes.checked) {
        tipoDiscapacidadInput.style.display = 'block';  
    } else {
        tipoDiscapacidadInput.style.display = 'none';  
        tipoDiscapacidadInput.value = 'no aplica'; 
    }
}

function toggleTipoEnfermedad(index) {
    const disponibilidadEnfermedadYes = document.querySelector(`input[name="enfermedad_cronica_${index}"][value="si"]`);
    const tipoEnfermedadInput = document.getElementById(`tipo-enfermedad-${index}`);
    if (disponibilidadEnfermedadYes.checked) {
        tipoEnfermedadInput.style.display = 'block'; 
    } else {
        tipoEnfermedadInput.style.display = 'none'; 
        tipoEnfermedadInput.value = 'no aplica';  
    }
}

function toggleInterInput() {
    const disponibilidad_internetYes = document.querySelector(`input[name="disponibilidad_internet"][value="si"]`);
    const tipo_conexionInput = document.getElementById('tipo_conexion_internet'); 
    if (disponibilidad_internetYes.checked) {
        tipo_conexionInput.style.display = 'block'; 
    } else {
        tipo_conexionInput.style.display = 'none'; 
        tipo_conexionInput.value = 'no';  
    }
}
</script>
<script>
    function establecerFechaMaxima() {
        const fechaNacInput = document.getElementById('fecha_nac');
        const fechaActual = new Date();
        const fechaLimite = new Date(fechaActual);
        
        fechaLimite.setMonth(fechaActual.getMonth() - 3);
        
        const anio = fechaLimite.getFullYear();
        const mes = String(fechaLimite.getMonth() + 1).padStart(2, '0'); 
        const dia = String(fechaLimite.getDate()).padStart(2, '0');
        
        fechaNacInput.max = `${anio}-${mes}-${dia}`;
    }

    document.addEventListener('DOMContentLoaded', establecerFechaMaxima);
</script>
<script>
$(document).ready(function(){
    var tablaPaciente = $('#tab-paciente').DataTable({
        
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('paciente.index') }}",
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'apellido' },
            { data: 'action', orderable: false }
        ]
    });
});
</script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var id;
$(document).on('click', '.delete', function(){
    id = $(this).attr('id');
    $('#confirModal').modal('show');
});

$('#btnEliminar').click(function(){
    $.ajax({
        url: "/paciente/" + id, 
        type: 'DELETE',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-paciente').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});
</script>
@endsection