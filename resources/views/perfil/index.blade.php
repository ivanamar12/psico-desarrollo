@extends('layouts.root')

@section('title', 'Perfil')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <style>
    .password-container {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 70%;
      transform: translateY(-50%);
      cursor: pointer;
      z-index: 10;
      background: none;
      border: none;
      font-size: 16px;
    }

    .password-container input {
      padding-right: 40px;
    }
  </style>
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Perfil de Usuario" icon="zmdi zmdi-account-circle zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            @if (auth()->user()->can('usuarios'))
              <li><a href="#list-usuarios" data-toggle="tab">Lista</a></li>
            @endif
            <li><a class="active" href="#new-perfil" data-toggle="tab"> Perfil</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in" id="list-usuarios">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-historias">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Correo</th>
                      <th style="text-align: center">ROL</th>
                      <th style="text-align: center">Estado</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="tab-pane fade active in" id="new-perfil">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    @if (session('success'))
                      <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form>
                      <div class="mb-3">
                        <label for="name" class="form-label"><strong>Nombre</strong></label>
                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}"
                          readonly>
                      </div>

                      <div class="mb-3">
                        <label for="email" class="form-label"><strong>Correo Electrónico</strong></label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                          readonly>
                      </div>

                      <div class="mb-3">
                        <label for="rol" class="form-label"><strong>Rol</strong></label>
                        <input type="text" class="form-control" id="rol"
                          value="{{ Auth::user()->roles->first()->name }}" readonly>
                      </div>

                      <button type="button" id="btnEditarPerfil" class="btn editar-perfil btn-custom mt-3"
                        style="color: white;">
                        <i class="zmdi zmdi-edit "></i> Editar Perfil
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <!-- Modal para Editar Usuario -->
  <section class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div style="width: 100%; display: flex; justify-content: end">
            <button type="button" class="no-shadow-on-click" data-dismiss="modal"
              style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
            Editar perfil
          </h3>
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

            <div class="form-group">
              <label for="security_question_id">Pregunta de seguridad</label>
              <select name="security_question_id" id="security_question_id" class="form-control">
                <option value="" disabled selected>Seleccione una pregunta</option>
                @foreach ($preguntas as $pregunta)
                  <option value="{{ $pregunta->id }}"
                    {{ Auth::user()->security_question_id == $pregunta->id ? 'selected' : '' }}>
                    {{ $pregunta->question }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="security_answer" class="form-label">Respuesta</label>
              <input type="text" class="form-control" id="security_answer" name="security_answer">
              <small class="text-muted">Ingrese una nueva respuesta si desea cambiarla</small>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-regresar" data-dismiss="modal"
                style="color: white;">Cancelar</button>
              <button type="submit" class="btn btn-custom" style="color: white;">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="modal fade" id="verUsuarioModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div style="width: 100%; display: flex; justify-content: end">
            <button type="button" class="no-shadow-on-click" data-dismiss="modal"
              style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
            Información del Usuario
          </h3>
        </div>

        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#btnEditarPerfil').on('click', function() {
        $('#confirModal').modal('show');
      });

      $('#formEditarPerfil').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
          url: "{{ route('perfil.update') }}",
          method: "POST",
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              toastr.success("Perfil actualizado correctamente.");
              setTimeout(function() {
                location.reload();
              }, 1500);
            } else {
              toastr.error("Hubo un error al actualizar el perfil.");
            }
          },
          error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            for (let key in errors) {
              toastr.error(errors[key][0]);
            }
          }
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tab-historias').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: "{{ route('perfil.list') }}",
        columns: [{
            data: 'id',
            name: 'id'
          },
          {
            data: 'name',
            name: 'name'
          },
          {
            data: 'email',
            name: 'email'
          },
          {
            data: 'role',
            name: 'role'
          },
          {
            data: 'estado',
            name: 'estado',
            orderable: false,
            searchable: false
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ],
        error: function(xhr) {
          console.error("Error en DataTables:", xhr.responseText);
        }
      });

      // Evento para ver usuario
      $(document).on('click', '.ver-usuario', function() {
        let id = $(this).data('id');
        $.get("{{ url('perfil/show') }}/" + id, function(data) {
          let roles = data.rol.length ? data.rol.join(', ') :
            'Sin rol asignado'; // Convierte el array a string

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
    });
  </script>

  <script>
    $(document).ready(function() {
      function validarPassword(password) {
        var regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return regex.test(password);
      }

      $("#password").on("blur", function() {
        var password = $(this).val();
        if (password && !validarPassword(password)) {
          $(this).removeClass("is-valid").addClass("is-invalid");
          toastr.error(
            "La contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial."
          );
        } else if (password) {
          $(this).removeClass("is-invalid").addClass("is-valid");
        }
      });

      $("#password_confirmation").on("blur", function() {
        var password = $("#password").val();
        var confirmPassword = $(this).val();

        if (confirmPassword === "") return;

        if (confirmPassword !== password) {
          $(this).removeClass("is-valid").addClass("is-invalid");
          toastr.error("Las contraseñas no coinciden.");
        } else {
          $(this).removeClass("is-invalid").addClass("is-valid");
        }
      });

      // Mostrar / Ocultar contraseña
      $(".toggle-password").on("click", function() {
        var target = $(this).data("target");
        var input = $("#" + target);
        var type = input.attr("type") === "password" ? "text" : "password";
        input.attr("type", type);
      });
    });
  </script>

@endsection
