<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Desbloqueo de Usuario - PsicoDesarrollo</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

  <x-auth-messages />

  <!-- Header -->
  <header>
    <nav class="navbar">
      <div class="logo">PsicoDesarrollo</div>
      <ul class="nav-links">
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#areas">Áreas</a></li>
        <li><a href="#servicios">Servicios</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>

      <div class="auth-buttons">
        <a href="{{ route('index') }}" class="btn">Volver</a>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main style="min-height: 91vh;">
    <section style="height: 85vh; display: flex; justify-content: center; align-items: center">
      <div class="modal-content">
        <h2>Desbloqueo de Usuario</h2>
        <p>
          Para desbloquear tu usuario, ingresa el correo electrónico asociado a
          tu cuenta a continuación:
        </p>

        <form method="POST" action="{{ route('user-unlock.email') }}">
          @csrf

          <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required
              value="{{ old('email') }}">
          </div>

          <div style="margin-bottom: 15px; margin-right: 8px; display: flex; justify-content: end">
            <a href="{{ route('login') }}">Otro método</a>
          </div>

          <div style="margin: 12px 0px">
            Te enviaremos un enlace para que puedas restablecer tu cuenta y
            acceder nuevamente a ella.
          </div>

          <button type="submit" class="btn btn-block">
            Enviar enlace
          </button>
        </form>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p>© {{ now()->format('Y') }} PsicoDesarrollo. Todos los derechos reservados.</p>
  </footer>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.close-btn').click(function() {
        $('.notification').fadeOut(300);
      });

      setTimeout(function() {
        $('.notification').fadeOut(300);
      }, 5000);
    });
  </script>
</body>

</html>
