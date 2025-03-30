@extends('layouts.app')

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
                            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
                            <li><a href="#new" data-toggle="tab"> Perfil</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="list">
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
                        <div class="tab-pane fade in" id="new">
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

                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña (Opcional)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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

@endsection
