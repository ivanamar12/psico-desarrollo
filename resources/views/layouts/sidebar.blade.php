<section class="full-box cover dashboard-sideBar">
  <div class="full-box dashboard-sideBar-bg"></div>
  <div class="full-box dashboard-sideBar-ct">
    <!--SideBar Title -->
    <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title" style="font-weight: 800">
      PsicoDesarrollo <i class="zmdi zmdi-close visible-xs"></i>
    </div>

    <!-- SideBar User info -->
    <div class="full-box dashboard-sideBar-UserInfo">
      <figure class="full-box" style="display: flex; flex-direction: column; align-items: center; gap: 4px">
        <img alt="logo" src="{{ asset('img/logo.png') }}"
          style="width: 100px; height: 100px; border-radius: 50%; border: 2px solid #fff; margin-bottom: 3px">
        <div style="display: flex; flex-direction: column; align-items: center">
          <p
            style="margin: 0; font-size: 16px; color: #fff; background: #00869b; padding: 2px 8px; border-radius: 4px;">
            {{ current_user()->roles()->first()->name }}
          </p>
          <p style="margin: 0; font-size: 22px">{{ current_user()->name }}</p>
          <p style="margin: 0; font-size: 13px">{{ current_user()->email }}</p>
        </div>
      </figure>
    </div>

    <!-- SideBar Menu -->
    <ul class="list-unstyled full-box dashboard-sideBar-Menu">
      <li>
        <a href="{{ route('dashboard') }}">
          <i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> INICIO
        </a>
      </li>

      <!-- ========== REGISTROS MAESTROS ========== -->
      <li class="m-3">
        <h4 class="text-white fw-semibold">Registros Maestros</h4>
      </li>

      @if (auth()->user()->can('ver especialista') || auth()->user()->can('ver secretaria'))
        <li>
          <a href="#!" class="btn-sideBar-SubMenu"
            style="display: flex; align-items: center; justify-content: space-between">
            <span>
              <i class="zmdi zmdi-accounts zmdi-hc-fw"></i> Personal
            </span>
            <i class="zmdi zmdi-caret-down"></i>
          </a>
          <ul class="list-unstyled full-box">
            @if (auth()->user()->can('ver especialista'))
              <li>
                <a href="{{ route('especialidad.index') }}">
                  <i class="zmdi zmdi-assignment" style="margin: 0px 8px"></i>Especialidades
                </a>
              </li>
              <li>
                <a href="{{ route('especialistas.index') }}">
                  <i class="zmdi zmdi-accounts" style="margin: 0px 8px"></i>Especialistas
                </a>
              </li>
            @endif
            @if (auth()->user()->can('ver secretaria'))
              <li>
                <a href="{{ route('secretarias.index') }}">
                  <i class="zmdi zmdi-accounts-alt" style="margin: 0px 8px"></i>Secretarias
                </a>
              </li>
            @endif
          </ul>
        </li>
      @endif

      <li>
        <a href="{{ route('representantes.index') }}">
          <i class="zmdi zmdi-account-box zmdi-hc-fw"></i> Representantes
        </a>
      </li>

      <li>
        <a href="{{ route('pacientes.index') }}">
          <i class="zmdi zmdi-face zmdi-hc-fw"></i> Pacientes
        </a>
      </li>

      <!-- ========== ATENCIÓN CLÍNICA ========== -->
      <li class="m-3">
        <h4 class="text-white fw-semibold">Atención Clínica</h4>
      </li>

      <li>
        <a href="{{ route('citas.index') }}">
          <i class="zmdi zmdi-calendar zmdi-hc-fw"></i> Citas
        </a>
      </li>

      <li>
        <a href="{{ route('historias.index') }}">
          <i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Historias Clínicas
        </a>
      </li>

      @if (auth()->user()->can('pruebas'))
        <li>
          <a href="#!" class="btn-sideBar-SubMenu"
            style="display: flex; align-items: center; justify-content: space-between">
            <span>
              <i class="zmdi zmdi-assignment-check zmdi-hc-fw"></i> Pruebas Psicológicas
            </span>
            <i class="zmdi zmdi-caret-down"></i>
          </a>
          <ul class="list-unstyled full-box">
            <li>
              <a href="{{ route('pruebas.index') }}">
                <i class="zmdi zmdi-assignment" style="margin: 0px 8px"></i>Catálogo de Pruebas
              </a>
            </li>
            <li>
              <a href="{{ route('aplicar-prueba.index') }}">
                <i class="zmdi zmdi-playlist-plus" style="margin: 0px 8px"></i>Aplicación de Pruebas
              </a>
            </li>
          </ul>
        </li>
      @endif

      <!-- ========== DOCUMENTOS ========== -->
      <li class="m-3">
        <h4 class="text-white fw-semibold">Documentos</h4>
      </li>

      <li>
        <a href="{{ route('informes.index') }}">
          <i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Informes Psicológicos
        </a>
      </li>

      <li>
        <a href="#!" class="btn-sideBar-SubMenu"
          style="display: flex; align-items: center; justify-content: space-between">
          <span>
            <i class="zmdi zmdi-file zmdi-hc-fw"></i> Otros Documentos
          </span>
          <i class="zmdi zmdi-caret-down"></i>
        </a>
        <ul class="list-unstyled full-box">
          <li>
            <a href="{{ route('referencias.index') }}">
              <i class="zmdi zmdi-mail-send" style="margin: 0px 8px"></i>Referencias
            </a>
          </li>
          <li>
            <a href="{{ route('constancias-asistencia.index') }}">
              <i class="zmdi zmdi-assignment-check" style="margin: 0px 8px"></i>Constancias de Asistencia
            </a>
          </li>
        </ul>
      </li>

      <!-- ========== SISTEMA ========== -->
      @if (auth()->user()->hasRole(App\Enums\Role::ADMIN->value))
        <li class="m-3">
          <h4 class="text-white fw-semibold">Sistema</h4>
        </li>

        @if (auth()->user()->can('bitacora'))
          <li>
            <a href="{{ route('bitacora.index') }}">
              <i class="zmdi zmdi-time-restore zmdi-hc-fw"></i> Bitácora del Sistema
            </a>
          </li>
        @endif
      @endif

      {{-- @if (auth()->user()->can('usuarios'))
        <li>
          <a href="{{ route('usuarios.index') }}">
            <i class="zmdi zmdi-accounts-list zmdi-hc-fw"></i> Administración de Usuarios
          </a>
        </li>
      @endif --}}
    </ul>
  </div>
</section>
