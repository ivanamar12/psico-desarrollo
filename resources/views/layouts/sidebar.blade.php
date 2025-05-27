<section class="full-box cover dashboard-sideBar">
  <div class="full-box dashboard-sideBar-bg "></div>
  <div class="full-box dashboard-sideBar-ct">
    <!--SideBar Title -->
    <div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title" style="font-weight: 800">
      PsicoDesarrollo <i class="zmdi zmdi-close  visible-xs"></i>
    </div>
    <!-- SideBar User info -->
    <div class="full-box dashboard-sideBar-UserInfo">
      <figure class="full-box" style="display: flex; flex-direction: column; align-items: center; gap: 4px">
        <img src="./assets/img/avatar.png" alt="UserIcon">
        <div style="display: flex; flex-direction: column; align-items: center">
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
      @if (auth()->user()->can('ver especialista'))
        <li>
          <a href="#!" class="btn-sideBar-SubMenu"
            style="display: flex; align-items: center; justify-content: space-between"
            data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="2">
            <span>
              <i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Especialistas
            </span>
            <i class="zmdi zmdi-caret-down"></i>
          </a>
          <ul class="list-unstyled full-box">
            <li>
              <a href="{{ route('especialidad.index') }}"
                data-intro="En esta sección puedes gestionar las especialidades del sistema.">
                <i class="zmdi zmdi-assignment" style="margin: 0px 8px"></i>Registrar Especialidades
              </a>
            </li>
            <li>
              <a href="{{ route('especialista.index') }}"
                data-intro="En esta sección puedes gestionar los especialistas del sistema.">
                <i class="zmdi zmdi-accounts" style="margin: 0px 8px"></i>Registrar Especialistas
              </a>
            </li>
          </ul>
        </li>
      @endif
      @if (auth()->user()->can('ver secretaria'))
        <li>
          <a href="{{ route('secretaria.index') }}" class="btn-sideBar-SubMenu"
            data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="3">
            <i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Secretarias<i class="zmdi zmdi-caret-"></i>
          </a>
        </li>
      @endif
      <li>
        <a href="{{ route('representantes.index') }}" class="btn-sideBar-SubMenu"
          data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="4">
          <i class="zmdi zmdi-male-female zmdi-hc-fw"></i>Representantes<i class="zmdi zmdi-caret-"></i>
        </a>
      </li>
      <li>
        <a href="{{ route('paciente.index') }}" class="btn-sideBar-SubMenu"
          data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="5">
          <i class="zmdi zmdi-face zmdi-hc-fw"></i>Pacientes<i class="zmdi zmdi-caret-"></i>
        </a>
      </li>
      <li>
        <a href="{{ route('citas.index') }}" class="btn-sideBar-SubMenu"
          data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="6">
          <i class="zmdi zmdi-calendar zmdi-hc-fw"></i>Citas<i class="zmdi zmdi-caret-"></i>
        </a>
      </li>
      <li>
        <a href="{{ route('historias.index') }}" class="btn-sideBar-SubMenu"
          data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="7">
          <i class="zmdi zmdi-file zmdi-hc-fw"></i>Historias Clinicas<i class="zmdi zmdi-caret-"></i>
        </a>
      </li>
      @if (auth()->user()->can('pruebas'))
        <li>
          <a href="#!" class="btn-sideBar-SubMenu"
            style="display: flex; align-items: center; justify-content: space-between"
            data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="8">
            <span>
              <i class="zmdi zmdi-book zmdi-hc-fw"></i>Pruebas
            </span>
            <i class="zmdi zmdi-caret-down"></i>
          </a>
          <ul class="list-unstyled full-box">
            <li>
              <a href="{{ route('pruebas.index') }}"
                data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="9">
                <i class="zmdi zmdi-assignment" style="margin: 0px 8px"></i>Registrar Pruebas
              </a>
            </li>
            <li>
              <a href="{{ route('aplicar_prueba.index') }}"
                data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="10"><i
                  class="zmdi zmdi-assignment" style="margin: 0px 8px"></i>Aplicar Pruebas</a>
            </li>
          </ul>
        </li>
      @endif
      @if (auth()->user()->can('bitacora'))
        <li>
          <a href="{{ route('bitacora.index') }}" class="btn-sideBar-SubMenu"
            data-intro="En esta sección puedes gestionar los especialistas del sistema." data-step="11">
            <i class="zmdi zmdi-file zmdi-hc-fw"></i> Bítacora <i class="zmdi zmdi-caret-"></i>
          </a>
        </li>
      @endif
    </ul>
  </div>
</section>
