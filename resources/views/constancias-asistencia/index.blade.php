@extends('layouts.app')

@section('title', 'Constancias de Asistencia')

@section('content')
  <section class="full-box dashboard-contentPage">
    <!-- NavBar -->
    <x-navbar />

    <!-- Page title -->
    <x-page-header title="Constancias de Asistencia" icon="zmdi zmdi-assignment-o zmdi-hc-fw" />

    <article class="container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="active"><a href="#list" data-toggle="tab">Nueva</a></li>
          </ul>

          <section id="myTabContent" class="tab-content">
            <section class="tab-pane fade active in" id="new-constancia">
              <article class="container-fluid">
                <form action="{{ route('constancias-asistencia.store') }}" method="POST"
                  id="generar-constancia-asistencia-form">
                  @csrf
                  <section class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                      <section id="paso1">
                        <h3>I. Datos de identificación</h3>
                        <div class="form-row">

                          <!-- Paciente -->
                          <div class="form-group col-md-6">
                            <label>Paciente <span class="text-danger">*</span></label>
                            <select class="form-control form-control-solid select2" required style="width: 100%;"
                              id="paciente_id" name="paciente_id">
                              <option selected disabled>Seleccione el paciente</option>
                            </select>
                            <small class="form-text text-muted">
                              Aquí puede encontrar los pacientes que han asistido a, por lo menos una cita.
                            </small>
                          </div>

                          {{-- Especialista --}}
                          <div class="form-group col-md-6">
                            <label>Especialista Responsable <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" readonly
                              value="{{ $especialista ? $especialista->nombre . ' ' . $especialista->apellido . ' - FVP: ' . $especialista->fvp : 'No asignado' }}">

                            <input type="hidden" name="especialista_id"
                              value="{{ $especialista ? $especialista->id : '' }}">
                            <small class="form-text text-muted">
                              Este especialista ha sido asignado automáticamente por el sistema.
                            </small>
                          </div>
                      </section>
                    </div>
                  </section>

                  <section class="row">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                      <h3>II. Citas</h3>
                      <article style="margin: 17px; display: flex; gap: 20px" id="lista-citas"></article>
                    </div>
                  </section>

                  <section id="container-hidden-input"></section>

                  <section class="row" style="margin: 34px 0px">
                    @if (auth()->user()->can('generar constancia-asistencia'))
                      <div class="text-center">
                        <button type="button" class="btn btn-regresar" style="color: white;"
                          id="generar-constancia-asistencia">
                          Generar Constancia
                        </button>
                      </div>
                    @else
                      <div class="col-xs-12 col-md-10 col-md-offset-1 text-center">
                        <i class="zmdi zmdi-info" style="color: rgba(248, 21, 21, 0.863)"></i>
                        <span style="margin-left: 8px">Lo sentimos, no tienes permisos para generar constancias.</span>
                      </div>
                    @endif
                  </section>
                </form>
              </article>
            </section>
          </section>
        </div>
      </div>
    </article>
  </section>

@endsection

@section('js')
  <script>
    const errors = @json($errors->all())

    const pacientes = @json($pacientes);
    const pacientesFiltrados = pacientes.filter(paciente => paciente.citas.length);
  </script>

  <script>
    $(function() {
      let citasSelected = [];

      function convertHour(hour24) {
        if (!/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/.test(hour24)) {
          console.error("Formato de hora inválido. Usa HH:mm.");
          return null;
        }

        const [hours, minutes] = hour24.split(':');
        let hours12 = parseInt(hours, 10);
        const ampm = hours12 >= 12 ? 'pm' : 'am';

        hours12 = hours12 % 12;
        hours12 = hours12 || 12;

        return `${hours12}:${minutes} ${ampm}`;
      }

      function convertDate(date) {
        const [y, m, d] = date.split('-');
        return `${d}-${m}-${y}`;
      }

      function renderCitas(citas) {
        const $listaCitas = $('#lista-citas');
        let html = '';

        citas.forEach(cita => {
          const panelClass = cita.isSelected ? 'panel-success' : 'panel-info';
          const itemClass = cita.isSelected ? 'cita-item-selected' : 'cita-item';
          html += `
            <div data-id="${cita.id}" class="${itemClass} panel ${panelClass}" 
              style="width: 170px; cursor: pointer">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <i class="zmdi zmdi-calendar"></i> Cita #${cita.id}
                </h4>
              </div>
              <div class="panel-body text-center">
                <h5 class="text-primary">${convertDate(cita.fecha_consulta)}</h5>
                <small class="text-muted">${convertHour(cita.hora)}</small>
              </div>
            </div>
          `;
        });
        $listaCitas.html(html);
      }

      $('#lista-citas').on('click', '.cita-item, .cita-item-selected', function() {
        const citaId = parseInt($(this).data('id'));

        citasSelected = citasSelected.map(cita => {
          if (cita.id === citaId) {
            return {
              ...cita,
              isSelected: !cita.isSelected
            };
          }
          return cita;
        });

        renderCitas(citasSelected);
        renderHiddenInputs();
      });

      $('#paciente_id').on('change', function() {
        const selectedOption = $(this).select2('data')[0];
        if (selectedOption && selectedOption.id) {
          citasSelected = structuredClone(selectedOption.citas);
          renderCitas(citasSelected);
          renderHiddenInputs();
        } else {
          citasSelected = [];
          renderCitas(citasSelected);
          renderHiddenInputs();
        }
      });

      $('#paciente_id').select2({
        placeholder: 'Seleccione paciente',
        allowClear: true,
        minimumInputLength: 1,
        data: pacientesFiltrados.map(paciente => {
          const historia = paciente.historia_clinicas?.[0] || null;
          return {
            id: paciente.id,
            text: `${paciente.nombre} ${paciente.apellido} - Código: ${historia ? historia.codigo : 'Sin historia'}`,
            historia: historia,
            citas: paciente.citas,
            isSelected: false
          };
        })
      });

      function renderHiddenInputs() {
        const $container = $('#container-hidden-input');
        $container.empty();

        const citasIds = citasSelected.filter(cita => cita.isSelected).map(cita => cita.id);

        if (citasIds.length > 0) {
          const inputHtml = `<input type="hidden" name="citas_seleccionadas" value='${JSON.stringify(citasIds)}'>`;
          $container.append(inputHtml);
        }
      }

      $('#generar-constancia-asistencia').click(function(e) {
        e.preventDefault();

        if (!citasSelected.some(cita => cita.isSelected)) {
          toastr.error('Debes seleccionar al menos una cita.', 'Error');
          return
        }

        $('#generar-constancia-asistencia-form').submit();
      });
    });
  </script>

  <script>
    $(function() {
      if (errors) {
        errors.forEach(error => {
          toastr.error(error, 'Error');
        })
      }
    });
  </script>

@endsection
