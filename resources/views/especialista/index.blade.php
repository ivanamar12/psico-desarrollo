@extends('layouts.app')
@section('title', 'Especialistas')
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
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
                <x-oclock />
			    <h1 class="text-titles"><i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Especialistas</h1>
			</div>
			<p class="lead">
			</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					  	<li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
                        @if(auth()->user()->can('registrar especialista'))
                            <li><a href="#new" data-toggle="tab">Nuevo</a></li>
                        @endif
					</ul>
					<div id="myTabContent" class="tab-content">
						
					  	<div class="tab-pane fade active in" id="list">
								<div class="table-responsive">
									<table class="table table-hover text-center" id="tab-especialista">
										<thead>
                                            <button id="openModal" class="btn btn-custom" style="color: white;">Especialidades</button>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Nombre</th>
												<th class="text-center">Apellido</th>
												<th class="text-center">CI</th>
												<th class="text-center">Correo</th>
												<th class="text-center">Telefono</th>
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
                                    <form id="registro-especialista">@csrf
                                            <div id="paso1">
                                                <h3>Datos Personales</h3>
                                                <div class="fila-formulario">
                                                <div class="form-group label-floating col-md-6">
														<label class="control-label">Nombre</label>
														<input class="form-control" id="nombre" name="nombre" type="text">
													</div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Apellido</label>
                                                        <input class="form-control" id="apellido" name="apellido" type="text" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">CI</label>
                                                        <input class="form-control" id="ci" name="ci" type="number" required max="34000000" oninput="validateInput(this)">
                                                    </div>
                                                    <div class="form-group  col-md-6">
                                                        <input class="form-control" type="date" name="fecha_nac" id="fecha_nac" required>
                                                    </div>
                                                    <div class="form-grup col-md-6">
                                                        <select class="form-control select2" required style="width: 100%;" id="especialidad_id" name="especialidad_id">
                                                            <option selected disabled>Seleccione su especialidad</option>
                                                            @foreach ($especialidades as $especialidad)
                                                            <option value="{{ $especialidad->id }}">{{ $especialidad->especialidad }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Teléfono</label>
                                                        <input class="form-control" type="tel" id="telefono" name="telefono" required>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Correo electrónico</label>
                                                        <input class="form-control" type="email" id="email" name="email" required>
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
                                                    <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">Siguiente</button>
                                                </p>
                                            </div>
                                            <div id="paso2" style="display: none;">
                                                <h3>Datos de Dirección</h3>
                                                <div class="fila-formulario">
                                                    <div class="form-group label-floating col-md-6">
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id" name="estado_id">
                                                            <option selected disabled>Seleccione su estado</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id" name="municipio_id">
                                                            <option selected disabled>Seleccione su municipio</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_id" name="parroquia_id">
                                                            <option selected disabled>Seleccione su parroquia</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating col-md-6">
                                                        <label class="control-label">Sector</label>
                                                        <input class="form-control" type="text" id="sector" name="sector" required>
                                                    </div>
                                                </div>
                                                <p class="centro-texto">
                                                    <button type="button" id="regresar" class="btn btn-regresar" style="color: white;"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                                    <button type="submit" name="registrar" class="btn btn-custom"  style="color: white;"><i class="zmdi zmdi-floppy"></i>Registrar</button>
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
		
</section>
<!-- modal eliminar -->
    <div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title w-100 text-center" style="color: white;">Confirmar </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el registro seleccionado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cancelar</button>
                    <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-eliminar" style="color: white;">Eliminar</button>
                </div>
            </div>
        </div>
    </div> 
<!-- Modal editar -->
<div class="modal fade" id="editespecialista" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-header">
            <h3 class="modal-title w-100 text-center" style="color: white;">Editar Especialista</h3>
            </div>
            <div class="modal-body">
                <div class="row">
					<div class="col-xs-12 col-md-10 col-md-offset-1">
                        <form id="editar-especialista">@csrf
                        <input type="hidden" id="id" name="id">
                            <div id="paso1_edit">
                                <h3>Datos Personales</h3>
                                <div class="fila-formulario">
                                    <div class="form-group label-floating col-md-6">
										<label class="control-label">Nombre</label>
										<input class="form-control" id="nombre2" name="nombre2" type="text">
									</div>
                                    <div class="form-group label-floating col-md-6">
                                        <label class="control-label">Apellido</label>
                                        <input class="form-control" id="apellido2" name="apellido2" type="text" required>
                                    </div>
                                    <div class="form-group label-floating col-md-6">
                                        <label class="control-label">CI</label>
                                        <input class="form-control" id="ci2" name="ci2" type="number" required max="34000000" oninput="validateInput(this)">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label class="control-label">Fecha de Nacimiento</label>
                                        <input class="form-control" type="date" name="fecha_nac2" id="fecha_nac2" required>
                                    </div>
                                    <div class="form-grup col-md-6">
                                        <label class="control-label">Especialidad</label>
                                        <select class="form-control select2" required style="width: 100%;" id="especialidad_id2" name="especialidad_id2">
                                            <option selected disabled>Seleccione su especialidad</option>
                                            @foreach ($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id }}">{{ $especialidad->especialidad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group label-floating col-md-6">
                                        <label class="control-label">Teléfono</label>
                                        <input class="form-control" type="tel" id="telefono2" name="telefono2" required>
                                    </div>
                                    <div class="form-group label-floating col-md-6">
                                        <label class="control-label">Correo electrónico</label>
                                        <input class="form-control" type="email" id="email2" name="email2" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Género</label>
                                        <select class="form-control select2" required style="width: 100%;" id="genero_id2" name="genero_id2">
                                            <option selected disabled>Seleccione su género</option>
                                            @foreach ($generos as $genero)
                                            <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p class="centro-texto"><button type="button" id="siguiente1_edit" class="btn btn-regresar" style="color: white;">Siguiente</button></p>
                            </div>
                            <div id="paso2_edit" style="display: none;">
                            <h3>Datos de Dirección</h3>
                                <div class="fila-formulario">
                                    <div class="form-group label-floating col-md-6">
                                        <label class="control-label">Estado</label>
                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="estado_id2" name="estado_id2">
                                            <option ></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Municipio</label>
                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="municipio_id2" name="municipio_id2">
                                            <option ></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Parroquia</label>
                                        <select class="form-control form-control-solid select2" required style="width: 100%;" id="parroquia_id2" name="parroquia_id2">
                                            <option ></option>
                                        </select>
                                    </div>
                                    <div class="form-group label-floating col-md-6">
                                        <label class="control-label">Sector</label>
                                        <input class="form-control" type="text" id="sector2" name="sector2" required>
                                    </div>
                                </div>
                                <p class="centro-texto">
                                    <button type="button" id="regresar_edit" class="btn btn-regresar" style="color: white;"><i class="zmdi zmdi-arrow-back"></i> Regresar</button>
                                    <button type="submit" name="registrar" class="btn btn-custom" style="color: white;"><i class=""></i>Guardar cambios</button>
                                </p>
                            </div>
                        </form>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<!-- modal mostrar especialista -->
<div id="especialistaModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title w-100 text-center" style="color: white;">Especialista</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <p><strong>Nombre y Apellido:</strong> <span id="nombre"></span></p>
                <p><strong>Cédula de Identidad:</strong> <span id="ci"></span></p>
                <p><strong>Fecha de Nacimiento:</strong> <span id="fecha_nac"></span></p>
                <p><strong>Especialidad:</strong> <span id="especialidad"></span></p>
                <p><strong>Teléfono:</strong> <span id="telefono"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
                <p><strong>Género:</strong> <span id="genero"></span></p>
                <p><strong>Dirección:</strong> <span id="direccion"></span></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="especialidadModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title w-100 text-center" style="color: white;">Especialista</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="especialidadForm">
                    <div class="form-group">
                        <label for="especialidad">Especialidad</label>
                        <input type="text" class="form-control" id="especialidad" name="especialidad" required>
                    </div>
                    <button type="submit" class="btn btn-custom" style="color: white;">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
const estados = @json($estados);
    const municipios = @json($municipios);
    const parroquias = @json($parroquias);
</script>
<script>
$(document).ready(function(){
    var tablaEspecialista = $('#tab-especialista').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: "{{ route('especialista.index')}}",
        },
        columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'apellido'},
            {data: 'ci'},
			{data: 'email'},
            {data: 'telefono'},
            {data: 'action', orderable: false}
        ]
    });
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

        $("#registro-especialista").submit(function(event) {
            event.preventDefault(); 
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var ci = $('#ci').val();
            var fecha_nac = $('#fecha_nac').val();
            var especialidad_id = $('#especialidad_id').val(); 
            var telefono = $('#telefono').val();
            var email = $('#email').val();
            var genero_id = $('#genero_id').val();
            var estado_id = $('#estado_id').val();
            var municipio_id = $('#municipio_id').val();
            var parroquia_id = $('#parroquia_id').val();
            var sector = $('#sector').val();
            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('especialista.store') }}", 
                type: "POST",
                data: {
                    nombre: nombre,
                    apellido: apellido,
                    ci: ci,
                    fecha_nac: fecha_nac,
                    especialidad_id: especialidad_id,
                    telefono: telefono,
                    email: email,
                    genero_id: genero_id,
                    estado_id: estado_id,
                    municipio_id: municipio_id,
                    parroquia_id: parroquia_id,
                    sector: sector,
                    _token: _token
                },
                success: function(response) {
                    if (response.success) {
                        $('#registro-especialista')[0].reset(); 
                        toastr.success('El registro se ingresó correctamente', 'Nuevo registro', { timeOut: 5000 });
                        $('#tab-especialista').DataTable().ajax.reload(); 
                        $("#paso1").show(); 
                        $("#paso2").hide();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Ocurrió un error al registrar el especialista', 'Error', { timeOut: 5000 });
                }
            });
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
        url: "/especialista/" + id, 
        type: 'DELETE',
        beforeSend: function(){
            $('#btnEliminar').text('Eliminando...');
        },
        success: function(data){
            $('#confirModal').modal('hide');
            toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', { timeOut: 5000 });
            $('#tab-especialista').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error al eliminar el registro:', error);
            toastr.error('No se pudo eliminar el registro', 'Error', { timeOut: 5000 });
        }
    });
});
</script>
<script>
document.getElementById('telefono').addEventListener('input', function() {
    const telefonoInput = this.value;
    const validPrefixes = ['0412', '0424', '0414', '0416', '0426'];

    if (telefonoInput.length > 11) {
        this.value = telefonoInput.slice(0, 11); 
    }

    const isValidPrefix = validPrefixes.some(prefix => telefonoInput.startsWith(prefix));

    if (telefonoInput.length === 11 && !isValidPrefix) {
        toastr.warning('El número debe comenzar con 0412, 0424, 0414, 0416 o 0426.', 'Advertencia', { timeOut: 5000 });
        this.value = ''; 
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaNacInput = document.getElementById('fecha_nac');
    
    const today = new Date();
    
    const yearEighteen = today.getFullYear() - 18;

    const minDate = `${yearEighteen}-01-01`;
    fechaNacInput.setAttribute('min', '1900-01-01'); 
    fechaNacInput.setAttribute('max', `${yearEighteen}-12-31`); 
});
</script>
<script>
function validateInput(input) {
    const value = input.value.toString();
    
    if (parseInt(value) > 34000000 || value.length > 8) {
        toastr.warning('El número de cédula es incorrecto. Debe ser un número de hasta 8 dígitos y no mayor a 34,000,000.', 'Advertencia', { timeOut: 5000 });
        input.value = '';
    }
}
</script>
<script>
$(document).ready(function() {
    $('#estado_id').select2({
        placeholder: "Seleccione su estado",
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
            transport: function(params, success, failure) {
                const searchTerm = params.data.term.toLowerCase().trim();
                const filteredEstados = estados.filter(estado =>
                    estado.estado.toLowerCase().includes(searchTerm));
                const results = filteredEstados.map(estado => ({
                    id: estado.id, text: estado.estado
                }));
                success({ results: results });
            }
        }
    });

    $('#municipio_id').select2({
        placeholder: "Seleccione su municipio",
        allowClear: true
    });

    $('#parroquia_id').select2({
        placeholder: "Seleccione su parroquia",
        allowClear: true
    });

    const showMunicipios = (filteredMunicipios) => {
        $('#municipio_id').empty().append('<option selected disabled>Seleccione su municipio</option>');
        filteredMunicipios.forEach(item => {
            const option = new Option(item.municipio, item.id, false, false);
            $('#municipio_id').append(option);
        });
        $('#municipio_id').trigger('change');
    };

    const filterMunicipios = (id) => {
        const filteredMunicipios = municipios.filter(item => item.estado_id == id);
        showMunicipios(filteredMunicipios);
    };

    const showParroquias = (filteredParroquias) => {
        $('#parroquia_id').empty().append('<option selected disabled>Seleccione su parroquia</option>');
        filteredParroquias.forEach(item => {
            const option = new Option(item.parroquia, item.id, false, false);
            $('#parroquia_id').append(option);
        });
        $('#parroquia_id').trigger('change');
    };

    const filterParroquias = (id) => {
        const filteredParroquias = parroquias.filter(item => item.municipio_id == id);
        showParroquias(filteredParroquias);
    };

    $('#estado_id').on('change', function(e) {
        const estadoId = $(this).val();
        filterMunicipios(estadoId);
        $('#parroquia_id').empty().append('<option selected disabled>Seleccione su parroquia</option>');
    });

    $('#municipio_id').on('change', function(e) {
        const municipioId = $(this).val();
        filterParroquias(municipioId);
    });
});
</script>
<script>
function editespecialista(id) {
    $.get('/especialista/' + id + '/edit', function(especialista) {
        $('#id').val(especialista.id);
        $('#nombre2').val(especialista.nombre);
        $('#apellido2').val(especialista.apellido);
        $('#ci2').val(especialista.ci);
        $('#fecha_nac2').val(especialista.fecha_nac);
        $('#especialidad_id2').val(especialista.especialidad_id).trigger('change');
        $('#telefono2').val(especialista.telefono);
        $('#email2').val(especialista.email);

        if (especialista.direccion) {
            $('#estado_id2').val(especialista.direccion.estado_id).trigger('change');

            filterMunicipios(especialista.direccion.estado_id);
            $('#municipio_id2').val(especialista.direccion.municipio_id).trigger('change');

            filterParroquias(especialista.direccion.municipio_id);
            $('#parroquia_id2').val(especialista.direccion.parroquia_id).trigger('change');

            $('#sector2').val(especialista.direccion.sector);
        }
        
        $('#editespecialista').modal('show');
    });
}

$('#editespecialista').on('shown.bs.modal', function () {
    initSelect2('#estado_id2', "Seleccione su estado", estados, 'estado');
    initSelect2('#municipio_id2', "Seleccione su municipio", municipios, 'municipio');
    initSelect2('#parroquia_id2', "Seleccione su parroquia", parroquias, 'parroquia');

    $('#estado_id2').on('change', function() {
        const estadoId = $(this).val();
        filterMunicipios(estadoId);
        $('#parroquia_id2').empty().append('<option selected disabled>Seleccione su parroquia</option>');
    });

    $('#municipio_id2').on('change', function() {
        const municipioId = $(this).val();
        filterParroquias(municipioId);
    });
});

const initSelect2 = (selector, placeholder, data, type) => {
    $(selector).select2({
        placeholder: placeholder,
        allowClear: true,
        minimumInputLength: 1,
        ajax: {
            delay: 250,
            transport: function(params, success) {
                const searchTerm = params.data.term.toLowerCase().trim();
                const filteredResults = data.filter(item => 
                    type === 'estado' ? item.estado.toLowerCase().includes(searchTerm) :
                    type === 'municipio' ? item.municipio.toLowerCase().includes(searchTerm) :
                    item.parroquia.toLowerCase().includes(searchTerm)
                );
                const results = filteredResults.map(item => ({
                    id: item.id,
                    text: type === 'estado' ? item.estado : type === 'municipio' ? item.municipio : item.parroquia
                }));
                success({ results: results });
            }
        },
        dropdownParent: $('#editespecialista .modal-body')
    });
};

const showMunicipios = (filteredMunicipios) => {
    $('#municipio_id2').empty().append('<option selected disabled>Seleccione su municipio</option>');
    filteredMunicipios.forEach(item => {
        const option = new Option(item.municipio, item.id, false, false);
        $('#municipio_id2').append(option);
    });
    $('#municipio_id2').trigger('change');
};

const filterMunicipios = (estadoId) => {
    const filteredMunicipios = municipios.filter(item => item.estado_id == estadoId);
    showMunicipios(filteredMunicipios);
};

const showParroquias = (filteredParroquias) => {
    $('#parroquia_id2').empty().append('<option selected disabled>Seleccione su parroquia</option>');
    filteredParroquias.forEach(item => {
        const option = new Option(item.parroquia, item.id, false, false);
        $('#parroquia_id2').append(option);
    });
    $('#parroquia_id2').trigger('change');
};

const filterParroquias = (municipioId) => {
    const filteredParroquias = parroquias.filter(item => item.municipio_id == municipioId);
    showParroquias(filteredParroquias);
};
</script>
<script>
$(document).ready(function() {
    $("#paso1_edit").show();
    $("#paso2_edit").hide(); 

    $("#siguiente1_edit").click(function() {
        $("#paso1_edit").hide(); 
        $("#paso2_edit").show();
    });

    $("#regresar_edit").click(function() {
        $("#paso2_edit").hide(); 
        $("#paso1_edit").show();
    });

    $("#editar-especialista").submit(function(event) {
        event.preventDefault(); 

        var id = $('#id').val(); 
        var nombre = $('#nombre2').val();
        var apellido = $('#apellido2').val();
        var ci = $('#ci2').val();
        var fecha_nac = $('#fecha_nac2').val();
        var especialidad_id = $('#especialidad_id2').val(); 
        var telefono = $('#telefono2').val();
        var email = $('#email2').val();
        var genero_id = $('#genero_id2').val();
        var estado_id = $('#estado_id2').val();
        var municipio_id = $('#municipio_id2').val();
        var parroquia_id = $('#parroquia_id2').val();
        var sector = $('#sector2').val();
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "/especialista/" + id,
            type: "PUT",
            data: {
                id: id,
                nombre: nombre,
                apellido: apellido,
                ci: ci,
                fecha_nac: fecha_nac,
                especialidad_id: especialidad_id,
                telefono: telefono,
                email: email,
                genero_id: genero_id,
                estado_id: estado_id,
                municipio_id: municipio_id,
                parroquia_id: parroquia_id,
                sector: sector,
                _token: _token
            },
            success: function(response) {
                console.log("Respuesta del servidor:", response); 
                if (response.success) {
                    console.log("Cerrando el modal..."); 
                    $('#editespecialista').modal('hide'); 
                    toastr.info('El registro se actualizó correctamente', 'Actualizar registro', { timeOut: 5000 });
                    $('#tab-especialista').DataTable().ajax.reload(); 
                } else {
                    console.log("No se pudo actualizar el registro."); 
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la actualización:', textStatus, errorThrown);
                alert('Ocurrió un error al actualizar el registro. Intenta nuevamente.');
            }
        });
    });
});
</script>
<script>
$(document).on('click', '.ver-especialista', function() {
    let especialistaId = $(this).data('id');

    $.ajax({
        url: '/especialistas/' + especialistaId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log("Datos del especialista:", data);

            let nombreApellido = data.nombre + " " + data.apellido;
            let cedula = data.ci;
            let fechaNacimiento = data.fecha_nac;
            let telefono = data.telefono;
            let email = data.email;

            let especialidad = data.especialidad ? data.especialidad.especialidad : "No disponible";
            let genero = data.genero ? data.genero.genero : "No disponible";

            let direccion = `${data.direccion.sector}, ${data.direccion.parroquia.parroquia}, ${data.direccion.municipio.municipio}, ${data.direccion.estado.estado}`;

            $('#especialistaModal #nombre').text(nombreApellido);
            $('#especialistaModal #ci').text(cedula);
            $('#especialistaModal #fecha_nac').text(fechaNacimiento);
            $('#especialistaModal #especialidad').text(especialidad);
            $('#especialistaModal #telefono').text(telefono);
            $('#especialistaModal #email').text(email);
            $('#especialistaModal #genero').text(genero);
            $('#especialistaModal #direccion').text(direccion);

            $('#especialistaModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.error("Error al obtener los datos:", error);
            alert("Hubo un problema al obtener la información del especialista.");
        }
    });
});

</script>
<script>
$(document).ready(function() {
    $('#openModal').on('click', function() {
        $('#especialidadModal').modal('show');
    });

    $('#especialidadForm').on('submit', function(e) {
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
});
</script>

@endsection
