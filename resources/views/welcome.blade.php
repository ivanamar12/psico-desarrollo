<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PsicoDesarrollo</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
  <!-- Header -->
  <header>
    <nav class="navbar">
      <div class="logo">PsicoDesarrollo</div>
      <ul class="nav-links">
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#areas">Áreas de Desarrollo</a></li>
        <li><a href="#servicios">Servicios</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>

      <!-- Botones para los modales -->
      @guest
      <div class="auth-buttons">
        <a href="#" class="btn" id="open-login-modal">Iniciar Sesión</a>
        <a href="#" class="btn" id="open-register-modal">Regístrate</a>
      </div>
      @else
      <a href="{{ route('logout') }}" class="btn"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar Sesión
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      @endguest
    </nav>
  </header>

  <!-- Hero Section -->
  <section id="inicio" class="hero">
    <div class="hero-content">
      <h1>¡Descubre el mundo de los pequeños!</h1>
      <p>PsicoDesarrollo acompaña a los niños de 0 a 6 años en su camino hacia un desarrollo integral.</p>
      <a href="#areas" class="btn-secondary">Explora más</a>
    </div>
  </section>

  <!-- Áreas de Desarrollo -->
  <section id="areas" class="development-areas">
    <h2>Áreas de Desarrollo Infantil</h2>
    <div class="grid">
      <div class="area">
        <img src="{{ asset('assets/img/image.jpg') }}" alt="Desarrollo Cognitivo">
        <h3>Desarrollo Cognitivo</h3>
        <p>Potenciamos el aprendizaje y la creatividad.</p>
      </div>
      <div class="area">
        <img src="{{ asset('assets/img/image8.jpg') }}" alt="Desarrollo Motor">
        <h3>Desarrollo Motor</h3>
        <p>Estimulación física para fortalecer habilidades motoras.</p>
      </div>
      <div class="area">
        <img src="{{ asset('assets/img/image4.png') }}" alt="Desarrollo del Lenguaje">
        <h3>Desarrollo del Lenguaje</h3>
        <p>Fomentamos habilidades de comunicación y expresión.</p>
      </div>
      <div class="area">
        <img src="{{ asset('assets/img/image6.jpeg') }}" alt="Desarrollo Social">
        <h3>Desarrollo Social</h3>
        <p>Impulsamos la empatía y las relaciones sociales.</p>
      </div>
      <div class="area">
        <img src="{{ asset('assets/img/image2.jpg') }}" alt="Desarrollo Sensorial">
        <h3>Desarrollo Sensorial</h3>
        <p>Exploración y aprendizaje a través de los sentidos.</p>
      </div>
    </div>
  </section>

  <!-- Servicios -->
  <section id="servicios" class="services">
    <h2>Nuestros Servicios</h2>
    <p>Descubre todo lo que ofrecemos:</p>
    <div class="services-list">
      <div class="service-card">
        <img src="{{ asset('assets/img/image10.jpg') }}" alt="Gestión de Historias">
        <h4>Gestión de Historias</h4>
        <p>Registra y organiza la información de cada niño.</p>
      </div>
      <div class="service-card">
        <img src="{{ asset('assets/img/image11.jpg') }}" alt="Evaluaciones Psicológicas">
        <h4>Evaluaciones Psicológicas</h4>
        <p>Pruebas personalizadas para cada etapa de desarrollo.</p>
      </div>
      <div class="service-card">
        <img src="{{ asset('assets/img/image12.jpeg') }}" alt="Informes Detallados">
        <h4>Informes Detallados</h4>
        <p>Obtén diagnósticos claros y orientados a resultados.</p>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="contact">
    <h2>¿Listo para comenzar?</h2>
    <p>Contáctanos y acompáñanos en el desarrollo integral de los niños.</p>
    <a href="#" class="btn">Contáctanos</a>
  </section>

  <!-- Modal de Iniciar Sesión -->
  <div id="login-modal" class="modal">
    <div class="modal-content">
      <span class="close-btn" id="close-login-modal">&times;</span>
      <h2>Iniciar Sesión</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email-login">Correo Electrónico:</label>
        <input type="email" id="email-login" name="email" placeholder="Ingrese su correo" required>
        <label for="password-login">Contraseña:</label>
        <input type="password" id="password-login" name="password" placeholder="Ingrese su contraseña" required>
        <button type="submit" class="btn">Entrar</button>
        @if ($errors->any())
        <div class="error-messages">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </form>
    </div>
  </div>

  <!-- Modal de Registro -->
  <div id="register-modal" class="modal">
    <div class="modal-content">
      <span class="close-btn" id="close-register-modal">&times;</span>
      <h2>Registro</h2>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name-register">Nombre Completo:</label>
        <input type="text" id="name-register" name="name" placeholder="Ingrese su nombre" required>
        <label for="email-register">Correo Electrónico:</label>
        <input type="email" id="email-register" name="email" placeholder="Ingrese su correo" required>
        <label for="password-register">Contraseña:</label>
        <input type="password" id="password-register" name="password" placeholder="Cree una contraseña" required>
        <label for="password-confirm">Confirmar Contraseña:</label>
        <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirme su contraseña" required>
        <button type="submit" class="btn">Registrarse</button>
        @if ($errors->any())
        <div class="error-messages">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>© 2024 PsicoDesarrollo. Todos los derechos reservados.</p>
  </footer>

  <script>
    const loginModal = document.getElementById('login-modal');
    const registerModal = document.getElementById('register-modal');
    const openLoginBtn = document.getElementById('open-login-modal');
    const openRegisterBtn = document.getElementById('open-register-modal');
    const closeLoginBtn = document.getElementById('close-login-modal');
    const closeRegisterBtn = document.getElementById('close-register-modal');

    openLoginBtn.addEventListener('click', (e) => {
      e.preventDefault();
      loginModal.style.display = 'flex';
    });

    openRegisterBtn.addEventListener('click', (e) => {
      e.preventDefault();
      registerModal.style.display = 'flex';
    });

    closeLoginBtn.addEventListener('click', () => {
      loginModal.style.display = 'none';
    });

    closeRegisterBtn.addEventListener('click', () => {
      registerModal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
      if (e.target === loginModal) loginModal.style.display = 'none';
      if (e.target === registerModal) registerModal.style.display = 'none';
    });
  </script>
</body>

</html>