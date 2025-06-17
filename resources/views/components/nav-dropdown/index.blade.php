<section class="Dropdown-area">
  <section class="Dropdown-bg"></section>
  <section class="Dropdown-body">
    <div class="Dropdown-body-title">
      <i class="zmdi zmdi-close"></i>
      <div style="display: flex; flex-direction: column">
        <p style="margin: 0">{{ current_user()->name }}</p>
        <p style="margin: 0; font-size: 13px">{{ current_user()->email }}</p>
      </div>
    </div>
    <div class="Dropdown-body-content">
      <!-- Contenido del dropdown -->
      <a href="{{ route('perfil.index') }}" class="dropdown-item">
        <i class="zmdi zmdi-account" style="margin-right: 10px;"></i>
        Perfil
      </a>
      <a href="#" class="dropdown-item">
        <i class="zmdi zmdi-settings" style="margin-right: 10px;"></i>
        Configuración
      </a>
      <form method="POST" action="{{ route('logout') }}" class="dropdown-item" id="logout-form"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        @csrf
        <i class="zmdi zmdi-power" style="margin-right: 10px;"></i>
        Cerrar Sesión
      </form>
    </div>
  </section>
</section>
