<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nueva Contraseña - PsicoDesarrollo</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

  <x-auth-messages />

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

  <main style="min-height: 91vh;">
    <section style="height: 91vh; display: flex; justify-content: center; align-items: center">
      <div class="modal-content">
        <h2>Establecer Nueva Contraseña</h2>
        <p>Crea una nueva contraseña segura para tu cuenta:</p>

        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="email" value="{{ $user->email }}">
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-group">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
          </div>

          <div style="margin: 12px 0px">
            La contraseña debe tener al menos 8 caracteres.
          </div>

          <button type="submit" class="btn btn-block">
            Actualizar Contraseña
          </button>
        </form>
      </div>
    </section>
  </main>

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
