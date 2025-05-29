@extends('layouts.app')

@section('title', 'Pacientes')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Pacientes" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar paciente'))
              <li><a href="#new-paciente" data-toggle="tab"> Nuevo</a></li>
            @endif
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
            <div class="tab-pane fade in" id="new-paciente">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-paciente">@csrf
                      <!-- paso 1 -->
                      <div id="paso1">
                        <h3>Datos Personales</h3>
                        <div class="fila-formulario">

                          <!-- Representante -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Representante <span style="color: red;">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="representante_id" name="representante_id">
                              <option selected disabled>Seleccione el representante</option>
                            </select>
                            <small class="form-text text-muted">Busque al representante por su cedula.</small>
                          </div>

                          <!-- Nombre -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Nombre <span style="color: red;">*</span></label>
                            <input class="form-control" id="nombre" name="nombre" type="text" required
                              oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ingrese el nombre Ej: Carlos.</small>
                          </div>

                          <!-- Apellido -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Apellido <span style="color: red;">*</span></label>
                            <input class="form-control" id="apellido" name="apellido" type="text" required
                              oninput="validarTexto(this)">
                            <small class="form-text text-muted">Ingrese el apellido Ej: Garcia.</small>
                          </div>

                          <!-- Fecha de nacimiento -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Fecha de Nacimiento <span style="color: red;">*</span></label>
                            <input class="form-control" type="date" name="fecha_nac" id="fecha_nac" required>
                            <small class="form-text text-muted">Ingrese la fecha de nacimiento, máximo 6 años y medio,
                              mínimo 3 meses.</small>
                          </div>

                          <!-- Género -->
                          <div class="form-group col-md-6">
                            <label class="control-label">Género <span style="color: red;">*</span></label>
                            <select class="form-control select2" required style="width: 100%;" id="genero_id"
                              name="genero_id">
                              <option selected disabled>Seleccione su género</option>
                              @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                              @endforeach
                            </select>
                            <small class="form-text text-muted">Seleccione su genero.</small>
                          </div>

                        </div>

                        <p class="centro-texto">
                          <button type="button" id="siguiente1" class="btn btn-regresar"
                            style="color: white;">Siguiente</button>
                        </p>
                      </div>
                      <!-- paso 2 -->
                      <div id="paso2">
                        <h3>Datos Familiares</h3>
                        <div id="miembrosContainer">
                          <div class="fila-formulario" id="formulario-familiar-0">

                            <div class="form-group label-floating col-md-6">
                              <label class="control-label">Nombre <span style="color: red;">*</span></label>
                              <input class="form-control" name="familiares[0][nombre]" type="text" required
                                maxlength="50" oninput="validarTexto(this)">
                              <small class="form-text text-muted">Ingrese el nombre del familiar.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <label class="control-label">Apellido <span style="color: red;">*</span></label>
                              <input class="form-control" name="familiares[0][apellido]" type="text" required
                                maxlength="50" oninput="validarTexto(this)">
                              <small class="form-text text-muted">Ingrese el apellido del familiar.</small>
                            </div>

                            <div class="form-group col-md-6">
                              <label class="control-label">Fecha de Nacimiento <span
                                  style="color: red;">*</span></label>
                              <input class="form-control" type="date" name="familiares[0][fecha_nac]" required>
                              <small class="form-text text-muted">Ingrese la fecha de nacimiento.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <label class="control-label">Parentesco <span style="color: red;">*</span></label>
                              <input class="form-control" name="familiares[0][parentesco]" type="text" required
                                maxlength="50" oninput="validarTexto(this)">
                              <small class="form-text text-muted">Ejemplo: madre, padre, hermano(a), etc.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <label class="control-label">Género <span style="color: red;">*</span></label>
                              <select class="form-control select2" required style="width: 100%;"
                                name="familiares[0][genero_id]">
                                <option selected disabled>Seleccione su género</option>
                                @foreach ($generos as $genero)
                                  <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                                @endforeach
                              </select>
                              <small class="form-text text-muted">Seleccione el género del familiar.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <h5>¿Tiene alguna discapacidad? <span style="color: red;">*</span></h5>
                              <div>
                                <label><input type="radio" name="familiares[0][discapacidad]" value="si" required
                                    onclick="toggleTipoDiscapacidad(0)"> Sí</label>
                                <label><input type="radio" name="familiares[0][discapacidad]" value="no"
                                    onclick="toggleTipoDiscapacidad(0)"> No</label>
                              </div>
                              <small class="form-text text-muted">Indique si tiene alguna discapacidad.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <input class="form-control" id="tipo-discapacidad-0"
                                name="familiares[0][tipo_discapacidad]" type="text" style="display: none;"
                                placeholder="Describa el tipo de discapacidad">
                              <small class="form-text text-muted" style="display: none;"
                                id="ayuda-discapacidad-0">Describa la discapacidad si aplica.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <h5>¿Tiene alguna enfermedad crónica? <span style="color: red;">*</span></h5>
                              <div>
                                <label><input type="radio" name="familiares[0][enfermedad_cronica]" value="si"
                                    required onclick="toggleTipoEnfermedad(0)"> Sí</label>
                                <label><input type="radio" name="familiares[0][enfermedad_cronica]" value="no"
                                    onclick="toggleTipoEnfermedad(0)"> No</label>
                              </div>
                              <small class="form-text text-muted">Indique si tiene alguna enfermedad crónica.</small>
                            </div>

                            <div class="form-group label-floating col-md-6">
                              <input class="form-control" id="tipo-enfermedad-0" name="familiares[0][tipo_enfermedad]"
                                type="text" style="display: none;" placeholder="Describa el tipo de Enfermedad">
                              <small class="form-text text-muted" style="display: none;"
                                id="ayuda-enfermedad-0">Describa la enfermedad si aplica.</small>
                            </div>

                            <button type="button" class="eliminar btn btn-danger"
                              onclick="eliminarMiembro(this)">Eliminar</button>

                          </div>
                        </div>

                        <p class="centro-texto">
                          <button type="button" id="agregarFamiliar" class="btn btn-custom"
                            style="color: white;">Agregar Familiar</button>
                          <button type="button" id="siguiente2" class="btn btn-regresar"
                            style="color: white;">Siguiente</button>
                        </p>
                      </div>
                      <!-- paso 3 -->
                      <div id="paso3">
                        <h3>Datos Socioeconómicos</h3>
                        <div class="fila-formulario">

                          <!-- Tipo de Vivienda -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Tipo de Vivienda <span style="color:red">*</span></label>
                            <select name="tipo_vivienda" class="form-control" required>
                              <option value="" disabled selected>Seleccione un tipo</option>
                              <option value="casa_unifamiliar">Casa Unifamiliar</option>
                              <option value="apartamento">Apartamento</option>
                              <option value="vivienda_social">Vivienda Social</option>
                              <option value="vivienda_precaria">Vivienda Precaria</option>
                            </select>
                            <small class="form-text text-muted">Seleccione el tipo de vivienda que habita la
                              familia.</small>
                          </div>

                          <!-- Cantidad de Habitaciones -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Cantidad de Habitaciones <span
                                style="color:red">*</span></label>
                            <input class="form-control" type="number" id="cantidad_habitaciones"
                              name="cantidad_habitaciones" required min="0"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            <small class="form-text text-muted">Ingrese solo números. Número total de habitaciones en la
                              vivienda.</small>
                          </div>

                          <!-- Cantidad de Personas -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Cantidad de Personas en la Vivienda <span
                                style="color:red">*</span></label>
                            <input class="form-control" type="number" id="cantidad_personas" name="cantidad_personas"
                              required min="0"
                              oninput="this.value = this.value.replace(/[^0-9]/g, ''); actualizarMiembros();">
                            <small class="form-text text-muted">Ingrese solo números. Total de personas que viven en la
                              vivienda.</small>
                          </div>

                          <!-- Servicios -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">¿Servicio de Agua Potable? <span
                                style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_agua_potable" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="servecio_agua_potable" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Indique si la vivienda cuenta con acceso a agua
                              potable.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">¿Servicio de Gas? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_gas" value="si" required> Sí</label>
                              <label><input type="radio" name="servecio_gas" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si dispone de servicio de gas en la
                              vivienda.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">¿Servicio de Electricidad? <span
                                style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_electricidad" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="servecio_electricidad" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si cuenta con servicio eléctrico.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">¿Servicio de Drenaje? <span style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_drenaje" value="si" required> Sí</label>
                              <label><input type="radio" name="servecio_drenaje" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si tiene sistema de drenaje sanitario.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">¿Acceso a Servicios Públicos? <span
                                style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="acceso_servcios_publicos" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="acceso_servcios_publicos" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Indique si la vivienda está conectada a servicios
                              básicos.</small>
                          </div>

                          <!-- Internet -->
                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">¿Tiene servicio de Internet en casa? <span
                                style="color:red">*</span></label>
                            <div>
                              <label><input type="radio" name="disponibilidad_internet" value="si" required
                                  onclick="toggleInterInput()"> Sí</label>
                              <label><input type="radio" name="disponibilidad_internet" value="no"
                                  onclick="toggleInterInput()"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si tiene acceso a Internet en el
                              hogar.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Tipo de conexión de Internet</label>
                            <input class="form-control" id="tipo_conexion_internet" name="tipo_conexion_internet"
                              type="text" placeholder="Especifique si aplica" style="display: none;">
                            <small class="form-text text-muted">Ejemplo: Fibra óptica, datos móviles, ADSL, etc.</small>
                          </div>

                          <div class="form-group label-floating col-md-6">
                            <label class="control-label">Fuente de Ingreso Familiar <span
                                style="color:red">*</span></label>
                            <input class="form-control" id="fuente_ingreso_familiar" name="fuente_ingreso_familiar"
                              type="text" required>
                            <small class="form-text text-muted">Indique la principal fuente de ingreso económico del
                              hogar.</small>
                          </div>

                        </div>

                        <p class="centro-texto">
                          <button type="button" id="regresar" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy" style="color: white;"></i> Registrar
                          </button>
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
          <h3 class="modal-title w-100 text-center" style="color: white;">Confirmación</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Desea eliminar el registro seleccionado?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cancelar</button>
          <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-eliminar"
            style="color: white;">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal mostrar paciente -->
  <div id="pacienteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title w-100 text-center" style="color: white;">Paciente</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><strong>Nombre y Apellido:</strong> <span id="nombre"></span></p>
          <p><strong>Fecha de Nacimiento:</strong> <span id="fecha_nac"></span></p>
          <p><strong>Genero:</strong> <span id="genero"></span></p>
          <p><strong>Representante:</strong> <span id="representante_nombre"></span></p>
          <p><strong>Cedula de Identidad:</strong> <span id="representante_ci"></span></p>
          <p><strong>Telefono:</strong> <span id="representante_telefono"></span></p>
          <p><strong>Correo Electronico:</strong> <span id="representante_email"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-custom" data-dismiss="modal" style="color: white;">Cerrar</button>
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

            success({
              results: results
            });
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
        const fechaNacFamiliarInputs = document.querySelectorAll('input[type="date"][name*="[fecha_nac]"]');
        const fechaActual = new Date();
        fechaActual.setDate(fechaActual.getDate() - 1);
        const anio = fechaActual.getFullYear();
        const mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
        const dia = String(fechaActual.getDate()).padStart(2, '0');
        const maxFecha = `${anio}-${mes}-${dia}`;

        fechaNacFamiliarInputs.forEach(input => {
          input.max = maxFecha;
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
          <label class="control-label">Nombre <span class="text-danger">*</span></label>
          <input class="form-control" name="familiares[${contador}][nombre]" type="text" required maxlength="50" oninput="validarTexto(this)">
          <small class="text-danger">Campo obligatorio</small>
        </div>
        <div class="form-group label-floating col-md-6">
          <label class="control-label">Apellido <span class="text-danger">*</span></label>
          <input class="form-control" name="familiares[${contador}][apellido]" type="text" required maxlength="50" oninput="validarTexto(this)">
          <small class="text-danger">Campo obligatorio</small>
        </div>
        <div class="form-group col-md-6">
          <label class="control-label">Fecha de nacimiento <span class="text-danger">*</span></label>
          <input class="form-control" type="date" name="familiares[${contador}][fecha_nac]" required>
          <small class="text-danger">Campo obligatorio</small>
        </div>
        <div class="form-group label-floating col-md-6">
          <label class="control-label">Parentesco <span class="text-danger">*</span></label>
          <input class="form-control" name="familiares[${contador}][parentesco]" type="text" required maxlength="50" oninput="validarTexto(this)">
          <small class="text-danger">Campo obligatorio</small>
        </div>
        <div class="form-group label-floating col-md-6">
          <label class="control-label">Género <span class="text-danger">*</span></label>
          <select class="form-control select2" required style="width: 100%;" name="familiares[${contador}][genero_id]">
            <option selected disabled>Seleccione su género</option>
            @foreach ($generos as $genero)
              <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
            @endforeach
          </select>
          <small class="text-danger">Campo obligatorio</small>
        </div>
        <div class="form-group label-floating col-md-6">
          <h5>¿Tiene alguna discapacidad? <span class="text-danger">*</span></h5>
          <div>
            <label><input type="radio" name="familiares[${contador}][discapacidad]" value="si" required onclick="toggleTipoDiscapacidad(${contador})"> Sí</label>
            <label><input type="radio" name="familiares[${contador}][discapacidad]" value="no" onclick="toggleTipoDiscapacidad(${contador})"> No</label>
          </div>
          <small class="text-danger">Campo obligatorio</small>
        </div>
        <div class="form-group label-floating col-md-6">
          <input class="form-control" id="tipo-discapacidad-${contador}" name="familiares[${contador}][tipo_discapacidad]" type="text" style="display: none;" placeholder="Describa el tipo de discapacidad">
        </div>
        <div class="form-group label-floating col-md-6">
          <h5>¿Tiene alguna enfermedad crónica? <span class="text-danger">*</span></h5>
          <div>
            <label><input type="radio" name="familiares[${contador}][enfermedad_cronica]" value="si" required onclick="toggleTipoEnfermedad(${contador})"> Sí</label>
            <label><input type="radio" name="familiares[${contador}][enfermedad_cronica]" value="no" onclick="toggleTipoEnfermedad(${contador})"> No</label>
          </div>
          <small class="text-danger">Campo obligatorio</small>
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
    function establecerRangoFechas() {
      const fechaNacInputs = document.querySelectorAll('input[name="fecha_nac"]');
      const fechaActual = new Date();

      const fechaMinima = new Date(fechaActual);
      fechaMinima.setMonth(fechaMinima.getMonth() - 78);

      const fechaMaxima = new Date(fechaActual);
      fechaMaxima.setMonth(fechaMaxima.getMonth() - 3);

      const formatoFecha = (fecha) => {
        const anio = fecha.getFullYear();
        const mes = String(fecha.getMonth() + 1).padStart(2, '0');
        const dia = String(fecha.getDate()).padStart(2, '0');
        return `${anio}-${mes}-${dia}`;
      };

      fechaNacInputs.forEach(input => {
        input.min = formatoFecha(fechaMinima);
        input.max = formatoFecha(fechaMaxima);
      });
    }

    document.addEventListener('DOMContentLoaded', establecerRangoFechas);
  </script>
  <script>
    $(document).ready(function() {
      var tablaPaciente = $('#tab-paciente').DataTable({
        language: {
          url: './js/datatables/es-ES.json',
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('paciente.index') }}",
        },
        columns: [{
            data: 'id'
          },
          {
            data: 'nombre'
          },
          {
            data: 'apellido'
          },
          {
            data: 'action',
            orderable: false
          }
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
    $(document).on('click', '.delete', function() {
      id = $(this).attr('id');
      $('#confirModal').modal('show');
    });

    $('#btnEliminar').click(function() {
      $.ajax({
        url: "/paciente/" + id,
        type: 'DELETE',
        beforeSend: function() {
          $('#btnEliminar').text('Eliminando...');
        },
        success: function(data) {
          $('#confirModal').modal('hide');
          toastr.warning('El registro se eliminó correctamente', 'Eliminar Registro', {
            timeOut: 5000
          });
          $('#tab-paciente').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
          console.error('Error al eliminar el registro:', error);
          toastr.error('No se pudo eliminar el registro', 'Error', {
            timeOut: 5000
          });
        }
      });
    });
  </script>
  <script>
    $(document).on('click', '.ver-paciente', function() {
      let pacienteId = $(this).data('id');

      $.ajax({
        url: '/paciente/' + pacienteId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          console.log("Datos del paciente:", data);

          let nombreApellido = data.nombre + " " + data.apellido;
          let fechaNacimiento = data.fecha_nac;
          let genero = data.genero ? data.genero.genero : "No disponible";

          let representanteNombre = data.representante ? data.representante.nombre + " " + data.representante
            .apellido : "No disponible";
          let representanteCedula = data.representante ? data.representante.ci : "No disponible";
          let representanteTelefono = data.representante ? data.representante.telefono : "No disponible";
          let representanteEmail = data.representante ? data.representante.email : "No disponible";

          $('#pacienteModal #nombre').text(nombreApellido);
          $('#pacienteModal #fecha_nac').text(fechaNacimiento);
          $('#pacienteModal #genero').text(genero);
          $('#pacienteModal #representante_nombre').text(representanteNombre);
          $('#pacienteModal #representante_ci').text(representanteCedula);
          $('#pacienteModal #representante_telefono').text(representanteTelefono);
          $('#pacienteModal #representante_email').text(representanteEmail);

          $('#pacienteModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error("Error al obtener los datos:", error);
          alert("Hubo un problema al obtener la información del paciente.");
        }
      });
    });
  </script>
  <script>
    document.getElementById('cantidad_habitaciones').addEventListener('keypress', function(e) {
      if (e.key < '0' || e.key > '9') e.preventDefault();
    });
    document.getElementById('cantidad_personas').addEventListener('keypress', function(e) {
      if (e.key < '0' || e.key > '9') e.preventDefault();
    });
  </script>
@endsection
