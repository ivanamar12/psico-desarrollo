@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<section class="full-box dashboard-contentPage">
    <nav class="full-box dashboard-Navbar">
        <ul class="full-box list-unstyled text-right">
            <li class="pull-left">
                <a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1 class="text-titles"><i class="zmdi zmdi-account-circle"></i> Perfil de Usuario</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        @if(auth()->user()->can('usuarios'))
                            <li><a href="#list" data-toggle="tab">Lista</a></li>
                        @endif
                            <li><a class="active" href="#new" data-toggle="tab"> Perfil</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in" id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center" id="tab-historias">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Correo</th>
                                            <th class="text-center">ROL</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>	
                            </div>
                        </div>
                        <div class="tab-pane fade active in" id="new">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                                        @if(session('success'))
                                                <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif

                                        <form>
                                            <div class="mb-3">
                                                <label for="name" class="form-label"><strong>Nombre</strong></label>
                                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label"><strong>Correo Electrónico</strong></label>
                                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="rol" class="form-label"><strong>Rol</strong></label>
                                                <input type="text" class="form-control" id="rol" value="{{ Auth::user()->roles->first()->name }}" readonly>
                                            </div>

                                            <button type="button" id="btnEditarPerfil" class="btn btn-custom mt-3" style="color: white;">
                                                <i class="zmdi zmdi-edit "  ></i> Editar Perfil
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       
</section>

<!-- Modal para Editar Usuario -->
<div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center" style="color: white;">Editar Perfil</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarPerfil">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                    </div>

                    <div class="mb-3 password-container">
                        <label for="password" class="form-label">Nueva Contraseña (Opcional)</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="toggle-password" data-target="password">👁️</span>
                    </div>

                    <div class="mb-3 password-container">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <span class="toggle-password" data-target="password_confirmation">👁️</span>
                    </div>

                    <div class="form-group label-floating col-md-6">
                       <select name="pregunta_seguridad" class="form-control">
                            <option value="" disabled selected>Pregunta de seguridad</option>
                            <option value="mi mascota" title="">Mi mascota</option>
                            <option value="deporte favorito" title="">Deporte favorito</option>
                            <option value="pelicula favorital" title="">Pelicula favorita</option>
                            <option value="comida favorita" title="">Comida favorita</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Rspuesta</label>
                        <input type="text" class="form-control" id="respuesta_seguridad" name="respuesta_seguridad" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-regresar" data-dismiss="modal" style="color: white;">Cancelar</button>
                        <button type="submit" class="btn btn-custom" style="color: white;">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="verUsuarioModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center" style="color: white;">Detalles de la Historia</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmarEliminar" tabindex="-1" aria-labelledby="confirmarEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center">Confirmar Eliminación</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminarBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
$(document).ready(function () {
    $('#btnEditarPerfil').on('click', function () {
        $('#confirModal').modal('show');
    });

    $('#formEditarPerfil').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('perfil.update') }}",
            method: "POST",
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert("Perfil actualizado correctamente.");
                    location.reload();
                } else {
                    alert("Hubo un error al actualizar el perfil.");
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = "Error al actualizar el perfil:\n";
                for (let key in errors) {
                    errorMessage += errors[key] + "\n";
                }
                alert(errorMessage);
            }
        });
    });
});
</script>
<script>
$(document).ready(function () {
    $('#tab-historias').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('perfil.list') }}",
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'role', name: 'role' },
        { data: 'estado', name: 'estado', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    error: function(xhr) {
        console.error("Error en DataTables:", xhr.responseText);
    }
});


    // Evento para ver usuario
    $(document).on('click', '.ver-usuario', function () {
    let id = $(this).data('id');
    $.get("{{ url('perfil/show') }}/" + id, function (data) {
        let roles = data.rol.length ? data.rol.join(', ') : 'Sin rol asignado'; // Convierte el array a string
        
        $('#verUsuarioModal .modal-body').html(`
            <p><strong>Nombre:</strong> ${data.nombre}</p>
            <p><strong>Correo:</strong> ${data.email}</p>
            <p><strong>Rol:</strong> ${roles}</p>
        `);
        $('#verUsuarioModal').modal('show');
    });
});


    // Evento para editar usuario
    let usuarioId; // Variable global para almacenar el ID del usuario a eliminar

// Cuando se hace clic en el botón eliminar, se guarda el ID y se muestra el modal
$(document).on('click', '.eliminar-usuario', function () {
    usuarioId = $(this).data('id');
    $('#confirmarEliminar').modal('show');
});

// Cuando el usuario confirma la eliminación
$('#confirmarEliminarBtn').click(function () {
    $.ajax({
        url: "{{ url('perfil/delete') }}/" + usuarioId,
        type: 'DELETE',
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function (response) {
            $('#confirmarEliminar').modal('hide'); // Cierra el modal
            $('#tabla-usuarios').DataTable().ajax.reload(); // Recarga la tabla (opcional si quieres recargar la página)
            
            // Muestra toast de éxito
            toastr.success(response.success, 'Éxito', {
                timeOut: 3000,
                onHidden: function() {
                    window.location.reload(); // Recarga la página después de cerrar el toast
                }
            });
        },
        error: function (xhr) {
            toastr.error(xhr.responseJSON.error, 'Error', {
                timeOut: 3000
            });
        }
    });
});

});

</script>
<script>
$(document).ready(function () {
    function validarPassword(password) {
        var regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return regex.test(password);
    }

    $("#password").on("blur", function () {
        var password = $(this).val();
        if (!validarPassword(password)) {
            $(this).removeClass("is-valid").addClass("is-invalid");
            toastr.error("La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.");
        } else {
            $(this).removeClass("is-invalid").addClass("is-valid");
            toastr.success("Contraseña válida.");
        }
    });

    $("#password_confirmation").on("blur", function () {
        var password = $("#password").val();
        var confirmPassword = $(this).val();

        if (confirmPassword === "") return;

        if (confirmPassword !== password) {
            $(this).removeClass("is-valid").addClass("is-invalid");
            toastr.error("Las contraseñas no coinciden.");
        } else {
            $(this).removeClass("is-invalid").addClass("is-valid");
            toastr.success("Las contraseñas coinciden.");
        }
    });

    // Mostrar / Ocultar contraseña
    $(".toggle-password").on("click", function () {
        var target = $(this).data("target");
        var input = $("#" + target);
        var type = input.attr("type") === "password" ? "text" : "password";
        input.attr("type", type);
    });
});
</script>

@endsection
