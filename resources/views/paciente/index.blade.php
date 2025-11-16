@extends('layouts.root')

@section('title', 'Pacientes')

@section('css')
  <link href="{{ asset('css/datatables/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Pacientes" icon="zmdi zmdi-male-female zmdi-hc-fw" />

    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list-paciente" data-toggle="tab">Lista</a></li>
            @if (auth()->user()->can('registrar paciente'))
              <li><a href="#new-paciente" data-toggle="tab">Nuevo</a></li>
            @endif
          </ul>
          <section id="myTabContent" class="tab-content">
            <section class="tab-pane fade active in" id="list-paciente">
              <div class="table-responsive">
                <table class="table table-hover text-center" id="tab-paciente">
                  <thead>
                    <tr>
                      <th style="text-align: center">#</th>
                      <th style="text-align: center">Nombre</th>
                      <th style="text-align: center">Apellido</th>
                      <th style="text-align: center">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </section>

            <section class="tab-pane fade in" id="new-paciente">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <form id="registro-paciente">
                      @csrf

                      <!-- Paso 1 -->
                      <section id="paso1">
                        <h3>Datos Personales</h3>
                        <div class="fila-formulario row">

                          <!-- Representante -->
                          <div class="form-group col-md-6">
                            <label>Representante <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="representante_id" name="representante_id">
                              <option selected disabled>Seleccione el representante</option>
                            </select>
                            <small class="form-text text-muted">
                              Escriba el número de cédula, nombre o apellido del representante.
                            </small>
                          </div>

                          <!-- Nombre -->
                          <div class="form-group col-md-6">
                            <label>Nombre <span class="text-danger">*</span></label>
                            <input class="form-control" id="nombre" name="nombre" type="text" required
                              oninput="validarTexto(this)" maxlength="120">
                            <small class="form-text text-muted">
                              Ingrese el nombre. Solo letras. Máximo 120 caracteres.
                            </small>
                          </div>

                          <!-- Apellido -->
                          <div class="form-group col-md-6">
                            <label>Apellido <span class="text-danger">*</span></label>
                            <input class="form-control" id="apellido" name="apellido" type="text" required
                              oninput="validarTexto(this)" maxlength="120">
                            <small class="form-text text-muted">
                              Ingrese el apellido. Solo letras. Máximo 120 caracteres.
                            </small>
                          </div>

                          <!-- Fecha de Nacimiento -->
                          <div class="form-group col-md-6">
                            <label>Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="fecha_nac" id="fecha_nac" required>
                            <small class="form-text text-muted">Ingrese la fecha de nacimiento, máximo 6 años y medio,
                              mínimo 3 meses.</small>
                          </div>

                          <!-- Género -->
                          <div class="form-group col-md-6">
                            <label>Género <span class="text-danger">*</span></label>
                            <select class="form-control select2" required style="width: 100%;" id="genero_id"
                              name="genero_id">
                              <option selected disabled>Seleccione su género</option>
                              @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                              @endforeach
                            </select>
                            <small class="form-text text-muted">Seleccione el género del paciente.</small>
                          </div>
                        </div>

                        <p class="text-center mt-3">
                          <button type="button" id="siguiente1" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>

                      <!-- Paso 2 -->
                      <section id="paso2" style="display: none;">
                        <h3>Datos Familiares</h3>
                        <h4>Familiares que vivan en el hogar</h4>
                        <div id="miembrosContainer"></div>

                        <p class="text-center mt-3">
                          <button type="button" id="agregarFamiliar" class="btn btn-custom" style="color: white;">
                            Agregar Familiar
                          </button>
                          <button type="button" id="siguiente2" class="btn btn-regresar" style="color: white;">
                            Siguiente
                          </button>
                        </p>
                      </section>

                      <!-- Paso 3 -->
                      <section id="paso3" style="display: none;">
                        <h3>Datos Socioeconómicos</h3>
                        <div class="fila-formulario row">

                          <!-- Tipo de Vivienda -->
                          <div class="form-group col-md-6">
                            <label>Tipo de Vivienda <span class="text-danger">*</span></label>
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
                          <div class="form-group col-md-6">
                            <label>Cantidad de Habitaciones <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="cantidad_habitaciones"
                              name="cantidad_habitaciones" required min="1" max="20"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            <small class="form-text text-muted">Ingrese solo números. Número total de habitaciones en la
                              vivienda.</small>
                          </div>

                          <!-- Cantidad de Personas -->
                          <div class="form-group col-md-6">
                            <label>Cantidad de Personas en la Vivienda <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" id="cantidad_personas" name="cantidad_personas"
                              required min="1" max="50"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <small class="form-text text-muted">Ingrese solo números. Total de personas que viven en la
                              vivienda.</small>
                          </div>

                          <!-- Servicios Básicos -->
                          <div class="form-group col-md-6">
                            <label>¿Servicio de Agua Potable? <span class="text-danger">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_agua_potable" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="servecio_agua_potable" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Indique si la vivienda cuenta con acceso a agua
                              potable.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Servicio de Gas? <span class="text-danger">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_gas" value="si" required> Sí</label>
                              <label><input type="radio" name="servecio_gas" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si dispone de servicio de gas en la
                              vivienda.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Servicio de Electricidad? <span class="text-danger">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_electricidad" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="servecio_electricidad" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si cuenta con servicio eléctrico.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Servicio de Drenaje? <span class="text-danger">*</span></label>
                            <div>
                              <label><input type="radio" name="servecio_drenaje" value="si" required> Sí</label>
                              <label><input type="radio" name="servecio_drenaje" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si tiene sistema de drenaje sanitario.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>¿Acceso a Servicios Públicos? <span class="text-danger">*</span></label>
                            <div>
                              <label><input type="radio" name="acceso_servcios_publicos" value="si" required>
                                Sí</label>
                              <label><input type="radio" name="acceso_servcios_publicos" value="no"> No</label>
                            </div>
                            <small class="form-text text-muted">Indique si la vivienda está conectada a servicios
                              básicos.</small>
                          </div>

                          <!-- Internet -->
                          <div class="form-group col-md-6">
                            <label>¿Tiene servicio de Internet en casa? <span class="text-danger">*</span></label>
                            <div>
                              <label><input type="radio" name="disponibilidad_internet" value="si" required
                                  onclick="toggleInterInput()"> Sí</label>
                              <label><input type="radio" name="disponibilidad_internet" value="no"
                                  onclick="toggleInterInput()"> No</label>
                            </div>
                            <small class="form-text text-muted">Seleccione si tiene acceso a Internet en el
                              hogar.</small>
                          </div>

                          <div class="form-group col-md-6" id="tipo_conexion_internet" style="display: none;">
                            <label>Tipo de conexión de Internet</label>
                            <input class="form-control" name="tipo_conexion_internet" type="text"
                              placeholder="Especifique si aplica" maxlength="100">
                            <small class="form-text text-muted">Ejemplo: Fibra óptica, datos móviles, ADSL, etc.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Fuente de Ingreso Familiar <span class="text-danger">*</span></label>
                            <input class="form-control" id="fuente_ingreso_familiar" name="fuente_ingreso_familiar"
                              type="text" required maxlength="255">
                            <small class="form-text text-muted">Indique la principal fuente de ingreso económico del
                              hogar.</small>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Observaciones (Opcional)</label>
                            <textarea class="form-control" name="observacion" rows="3" maxlength="500"></textarea>
                            <small class="form-text text-muted">
                              Ingrese cualquier observación adicional sobre el paciente.
                            </small>
                          </div>
                        </div>

                        <p class="text-center mt-3">
                          <button type="button" id="regresar2" class="btn btn-regresar" style="color: white;">
                            <i class="zmdi zmdi-arrow-back"></i> Regresar
                          </button>
                          <button type="submit" name="registrar" class="btn btn-custom" style="color: white;">
                            <i class="zmdi zmdi-floppy"></i> Registrar
                          </button>
                        </p>
                      </section>
                    </form>
                  </div>
                </div>
              </div>
            </section>
          </section>
        </div>
      </div>
    </section>
  </section>

  <!-- Modal mostrar paciente -->
  <section id="pacienteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div style="width: 100%; display: flex; justify-content: end">
            <button type="button" class="no-shadow-on-click" data-dismiss="modal"
              style="color: black; background: #aeadad; border: none; border-radius: 20%; width: 22px; height: 22px; padding: 0;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <h3 class="modal-title w-100 text-center" style="color: white; margin-bottom: 12px;">
            Información del Paciente
          </h3>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <p><strong>Nombre completo:</strong><br><span id="nombre_show"></span></p>
              <p><strong>Fecha de Nacimiento:</strong><br><span id="fecha_nac_show"></span></p>
              <p><strong>Género:</strong><br><span id="genero_show"></span></p>
            </div>
            <div class="col-md-6">
              <p><strong>Representante:</strong><br><span id="representante_nombre_show"></span></p>
              <p><strong>Cédula de Identidad:</strong><br><span id="representante_ci_show"></span></p>
              <p><strong>Teléfono:</strong><br><span id="representante_telefono_show"></span></p>
              <p><strong>Correo Electrónico:</strong><br><span id="representante_email_show"></span></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script src="{{ asset('js/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/select2/select2.min.js') }}"></script>
  <script src="{{ asset('js/select2/es.js') }}"></script>
  <script src="{{ asset('js/app/validaciones.js') }}"></script>

  <script>
    $(document).ready(function() {
      const representantes = @json($representantes);

      const representantesData = representantes.map(representante => ({
        id: representante.id,
        text: `${representante.nombre} ${representante.apellido} (CI: ${representante.ci})`
      }));

      $('#representante_id').select2({
        placeholder: "Seleccione el representante",
        allowClear: true,
        data: representantesData,
      });

      var tablaPaciente = $('#tab-paciente').DataTable({
        language: {
          url: "{{ asset('js/datatables/es-ES.json') }}",
        },
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pacientes.index') }}",
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

      // Control de pasos
      $("#paso1").show();
      $("#paso2").hide();
      $("#paso3").hide();

      $("#siguiente1").click(function() {
        let valid = true;

        // Validar campos requeridos del paso 1
        $('#paso1 :input[required]').each(function() {
          if ($(this).val() === '' || $(this).val() === null) {
            $(this).addClass('is-invalid');
            valid = false;
          } else {
            $(this).removeClass('is-invalid');
          }
        });

        // Validar fecha de nacimiento
        const fechaNac = new Date($('#fecha_nac').val());
        const fechaActual = new Date();
        const edadMinima = new Date(fechaActual);
        edadMinima.setMonth(edadMinima.getMonth() - 78); // 6.5 años
        const edadMaxima = new Date(fechaActual);
        edadMaxima.setMonth(edadMaxima.getMonth() - 3); // 3 meses

        if (fechaNac < edadMinima || fechaNac > edadMaxima) {
          $('#fecha_nac').addClass('is-invalid');
          toastr.error("La fecha de nacimiento debe estar entre 3 meses y 6 años y medio.");
          valid = false;
        } else {
          $('#fecha_nac').removeClass('is-invalid');
        }

        if (valid) {
          $("#paso1").hide();
          $("#paso2").show();
        } else {
          toastr.error("Debe completar todos los campos requeridos del paso 1.");
        }
      });

      $("#siguiente2").click(function() {
        // Validar que al menos haya un familiar si es necesario
        if ($('#miembrosContainer').children().length === 0) {
          toastr.warning("Se recomienda agregar al menos un familiar que viva en el hogar.");
        }

        $("#paso2").hide();
        $("#paso3").show();
      });

      $("#regresar2").click(function() {
        $("#paso3").hide();
        $("#paso2").show();
      });

      // Agregar familiar
      let contadorFamiliares = 0;

      $("#agregarFamiliar").click(function() {
        const nuevoFormulario = `
          <div class="fila-formulario row mb-3 p-3 border rounded" id="formulario-familiar-${contadorFamiliares}">
            <div class="form-group col-md-6">
              <label>Nombre <span class="text-danger">*</span></label>
              <input class="form-control" name="familiares[${contadorFamiliares}][nombre]" type="text" required maxlength="120" oninput="validarTexto(this)">
              <small class="form-text text-muted">Ingrese el nombre del familiar.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Apellido <span class="text-danger">*</span></label>
              <input class="form-control" name="familiares[${contadorFamiliares}][apellido]" type="text" required maxlength="120" oninput="validarTexto(this)">
              <small class="form-text text-muted">Ingrese el apellido del familiar.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Fecha de Nacimiento <span class="text-danger">*</span></label>
              <input class="form-control" type="date" name="familiares[${contadorFamiliares}][fecha_nac]" required>
              <small class="form-text text-muted">Ingrese la fecha de nacimiento.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Parentesco <span class="text-danger">*</span></label>
              <input class="form-control" name="familiares[${contadorFamiliares}][parentesco]" type="text" required maxlength="120" oninput="validarTexto(this)">
              <small class="form-text text-muted">Ejemplo: madre, padre, hermano(a), etc.</small>
            </div>

            <div class="form-group col-md-6">
              <label>Género <span class="text-danger">*</span></label>
              <select class="form-control select2" required style="width: 100%;" name="familiares[${contadorFamiliares}][genero_id]">
                <option selected disabled>Seleccione su género</option>
                @foreach ($generos as $genero)
                  <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                @endforeach
              </select>
              <small class="form-text text-muted">Seleccione el género del familiar.</small>
            </div>

            <div class="form-group col-md-6">
              <label>¿Tiene alguna discapacidad? <span class="text-danger">*</span></label>
              <div>
                <label><input type="radio" name="familiares[${contadorFamiliares}][discapacidad]" value="si" required onclick="toggleTipoDiscapacidad(${contadorFamiliares})"> Sí</label>
                <label><input type="radio" name="familiares[${contadorFamiliares}][discapacidad]" value="no" onclick="toggleTipoDiscapacidad(${contadorFamiliares})"> No</label>
              </div>
              <small class="form-text text-muted">Indique si tiene alguna discapacidad.</small>
            </div>

            <div class="form-group col-md-6" id="tipo-discapacidad-container-${contadorFamiliares}" style="display: none;">
              <label>Tipo de discapacidad</label>
              <input class="form-control" id="tipo-discapacidad-${contadorFamiliares}" name="familiares[${contadorFamiliares}][tipo_discapacidad]" type="text" placeholder="Describa el tipo de discapacidad" maxlength="255">
              <small class="form-text text-muted">Describa la discapacidad si aplica.</small>
            </div>

            <div class="form-group col-md-6">
              <label>¿Tiene alguna enfermedad crónica? <span class="text-danger">*</span></label>
              <div>
                <label><input type="radio" name="familiares[${contadorFamiliares}][enfermedad_cronica]" value="si" required onclick="toggleTipoEnfermedad(${contadorFamiliares})"> Sí</label>
                <label><input type="radio" name="familiares[${contadorFamiliares}][enfermedad_cronica]" value="no" onclick="toggleTipoEnfermedad(${contadorFamiliares})"> No</label>
              </div>
              <small class="form-text text-muted">Indique si tiene alguna enfermedad crónica.</small>
            </div>

            <div class="form-group col-md-6" id="tipo-enfermedad-container-${contadorFamiliares}" style="display: none;">
              <label>Tipo de enfermedad</label>
              <input class="form-control" id="tipo-enfermedad-${contadorFamiliares}" name="familiares[${contadorFamiliares}][tipo_enfermedad]" type="text" placeholder="Describa el tipo de Enfermedad" maxlength="255">
              <small class="form-text text-muted">Describa la enfermedad si aplica.</small>
            </div>

            <div class="col-md-12 text-right">
              <button type="button" class="btn btn-danger btn-sm" onclick="eliminarMiembro(${contadorFamiliares})">
                <i class="zmdi zmdi-delete"></i> Eliminar
              </button>
            </div>
          </div>
        `;

        $("#miembrosContainer").append(nuevoFormulario);

        // Inicializar Select2 para el nuevo select
        $(`select[name="familiares[${contadorFamiliares}][genero_id]"]`).select2();

        // Establecer el rango de fechas para el nuevo campo
        establecerFechaMaximaFamiliares();

        contadorFamiliares++;
      });

      // Función para eliminar un familiar
      window.eliminarMiembro = function(id) {
        $(`#formulario-familiar-${id}`).remove();
      };

      // Submit del formulario
      $("#registro-paciente").submit(function(e) {
        e.preventDefault();
        toastr.clear();

        $.ajax({
          url: "{{ route('pacientes.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              $('#registro-paciente')[0].reset();
              $('#representante_id').val(null).trigger('change');
              $('#genero_id').val(null).trigger('change');

              // Limpiar contenedor de familiares
              $('#miembrosContainer').empty();
              contadorFamiliares = 0;

              // Regresar al paso 1
              $("#paso3").hide();
              $("#paso1").show();

              toastr.success(response.message, 'Éxito', {
                timeOut: 5000
              });
              tablaPaciente.ajax.reload();
              $('.nav-tabs a[href="#list-paciente"]').tab('show');
            }
          },
          error: function(xhr) {
            if (xhr.status === 422) {
              const errors = xhr.responseJSON.errors;
              for (const field in errors) {
                errors[field].forEach(error => {
                  toastr.error(error, 'Error', {
                    timeOut: 5000
                  });
                });
              }
            } else {
              toastr.error('Ocurrió un error al crear el paciente.', 'Error');
            }
          }
        });
      });

      // Establecer rango de fechas al cargar la página
      establecerRangoFechas();
    });

    // Funciones para mostrar/ocultar campos condicionales
    window.toggleTipoDiscapacidad = function(index) {
      const discapacidadSi = $(`input[name="familiares[${index}][discapacidad]"][value="si"]`).is(':checked');
      if (discapacidadSi) {
        $(`#tipo-discapacidad-container-${index}`).show();
        $(`#tipo-discapacidad-${index}`).prop('required', true);
      } else {
        $(`#tipo-discapacidad-container-${index}`).hide();
        $(`#tipo-discapacidad-${index}`).prop('required', false);
        $(`#tipo-discapacidad-${index}`).val('');
      }
    };

    window.toggleTipoEnfermedad = function(index) {
      const enfermedadSi = $(`input[name="familiares[${index}][enfermedad_cronica]"][value="si"]`).is(':checked');
      if (enfermedadSi) {
        $(`#tipo-enfermedad-container-${index}`).show();
        $(`#tipo-enfermedad-${index}`).prop('required', true);
      } else {
        $(`#tipo-enfermedad-container-${index}`).hide();
        $(`#tipo-enfermedad-${index}`).prop('required', false);
        $(`#tipo-enfermedad-${index}`).val('');
      }
    };

    function toggleInterInput() {
      const disponibilidadInternetSi = document.querySelector('input[name="disponibilidad_internet"][value="si"]');
      const tipoConexionContainer = document.getElementById('tipo_conexion_internet');
      const tipoConexionInput = document.querySelector('#tipo_conexion_internet input');

      if (disponibilidadInternetSi.checked) {
        tipoConexionContainer.style.display = 'block';
        tipoConexionInput.value = '';
      } else {
        tipoConexionContainer.style.display = 'none';
        tipoConexionInput.value = 'no';
      }
    }

    function establecerRangoFechas() {
      const fechaNacInput = document.getElementById('fecha_nac');
      const fechaActual = new Date();

      const fechaMinima = new Date(fechaActual);
      fechaMinima.setMonth(fechaMinima.getMonth() - 78); // 6.5 años

      const fechaMaxima = new Date(fechaActual);
      fechaMaxima.setMonth(fechaMaxima.getMonth() - 3); // 3 meses

      const formatoFecha = (fecha) => {
        const anio = fecha.getFullYear();
        const mes = String(fecha.getMonth() + 1).padStart(2, '0');
        const dia = String(fecha.getDate()).padStart(2, '0');
        return `${anio}-${mes}-${dia}`;
      };

      fechaNacInput.min = formatoFecha(fechaMinima);
      fechaNacInput.max = formatoFecha(fechaMaxima);
    }

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
  </script>

  {{-- Ver paciente --}}
  <script>
    $(document).on('click', '.ver-paciente', function() {
      let pacienteId = $(this).data('id');
      let $modal = $('#pacienteModal');

      $.ajax({
        url: '/pacientes/' + pacienteId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          const formatValue = (value, defaultValue = 'No disponible') =>
            value && value !== '' ? value : defaultValue;

          const nombreApellido = `${formatValue(data.nombre)} ${formatValue(data.apellido)}`;
          const fechaNac = data.fecha_nac_formatted || formatValue(data.fecha_nac);

          $modal.find('#nombre_show').text(nombreApellido);
          $modal.find('#fecha_nac_show').text(fechaNac);
          $modal.find('#genero_show').text(formatValue(data.genero?.genero));
          $modal.find('#representante_nombre_show').text(
            data.representante ?
            `${formatValue(data.representante.nombre)} ${formatValue(data.representante.apellido)}` :
            'No disponible'
          );
          $modal.find('#representante_ci_show').text(formatValue(data.representante?.ci));
          $modal.find('#representante_telefono_show').text(formatValue(data.representante?.telefono));
          $modal.find('#representante_email_show').text(formatValue(data.representante?.email));

          $modal.modal('show');
        },
        error: function(xhr, status, error) {
          $modal.find('.modal-body').html(
            '<div class="alert alert-danger text-center">Error al cargar la información del paciente.</div>'
          );
          toastr.error('Error al cargar la información del paciente.');
        }
      });
    });
  </script>

@endsection
