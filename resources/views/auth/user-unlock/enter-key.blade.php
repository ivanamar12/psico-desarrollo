<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificación de Clave - PsicoDesarrollo</title>
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
        <h2>Verificación de Clave</h2>
        <p class="text-lg">
          Para desbloquear tu usuario, ingresa la clave que te hemos enviado:
        </p>

        <form method="POST" action="{{ route('unlock-user.update') }}" id="unlockForm">
          @csrf
          <input type="hidden" name="email" value="{{ request()->query('email') }}">

          <div class="form-group">
            <label for="key">Clave Dinámica:</label>
            <input type="text" id="key" name="key" required minlength="6" maxlength="6" pattern="[0-9]+"
              title="La clave debe contener exactamente 6 dígitos numéricos"
              placeholder="Ingresa la clave de 6 dígitos">
          </div>

          <button type="submit" class="btn btn-block">
            Desbloquear Usuario
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
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
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
  <script>
    $(document).ready(function() {
      $('#unlockForm').on('submit', function(e) {
        e.preventDefault();

        const keyInput = $('#key');
        const keyValue = keyInput.val();

        if (!/^\d{6}$/.test(keyValue)) {
          Swal.fire({
            icon: 'error',
            title: 'Error de validación',
            text: 'La clave debe contener exactamente 6 dígitos numéricos',
            confirmButtonColor: '#3085d6',
          });
          return;
        }

        this.submit();
      });
    });
  </script>
</body>

</html>
