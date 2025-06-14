<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificación de Seguridad - PsicoDesarrollo</title>
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
    <section style="height: 85vh; display: flex; justify-content: center; align-items: center">
      <div class="modal-content">
        <h2>Verificación de Seguridad</h2>
        <p>Por favor responde a tu pregunta de seguridad:</p>

        <form method="POST" action="{{ route('security-question.verify') }}">
          @csrf
          <input type="hidden" name="email" value="{{ $user->email }}">
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-group">
            <label for="security_answer">Tu respuesta:</label>
            <input type="text" id="security_answer" name="security_answer" required>
          </div>

          <button type="submit" class="btn btn-block">
            Verificar Respuesta
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
