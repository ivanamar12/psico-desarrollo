<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Desbloquear Cuenta - PsicoDesarrollo</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Estilos específicos para esta página */
    body {
      font-family: 'Quicksand', sans-serif;
      margin: 0;
      background: #f5f7fa;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .unlock-container {
      max-width: 500px;
      margin: 100px auto;
      padding: 40px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .unlock-title {
      color: #2c3e50;
      margin-bottom: 30px;
      font-size: 1.8em;
    }

    .unlock-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .unlock-input {
      padding: 12px 20px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 1em;
      transition: border-color 0.3s ease;
    }

    .unlock-input:focus {
      border-color: #3498db;
      outline: none;
    }

    .unlock-btn {
      background: #3498db;
      color: white;
      padding: 15px 30px;
      border: none;
      border-radius: 8px;
      font-size: 1.1em;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .unlock-btn:hover {
      background: #2980b9;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      color: #3498db;
      text-decoration: none;
      font-weight: 600;
    }
  </style>
</head>

<body>
  <!-- Notification -->
  @if ($errors->any())
    <div class="notification">
      <span class="icon">⚠️</span>
      <div class="notification-content">
        @foreach ($errors->all() as $error)
          <span>{{ $error }}</span>
        @endforeach
      </div>
      <button class="close-btn">&times;</button>
    </div>
  @endif

  <!-- Header mínimo -->
  <header style="background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <nav class="navbar" style="justify-content: center;">
      <div class="logo">PsicoDesarrollo</div>
    </nav>
  </header>

  <!-- Contenido principal -->
  <main>
    <div class="unlock-container">
      <h1 class="unlock-title">Desbloquear Cuenta</h1>
      <form method="POST" action="{{ route('user-unlock.request') }}" class="unlock-form">
        @csrf
        <input type="email" name="email" class="unlock-input" placeholder="Ingresa tu correo electrónico" required>
        <button type="submit" class="unlock-btn">
          Enviar enlace de desbloqueo
        </button>
      </form>
      <a href="{{ route('login') }}" class="back-link">← Volver al login</a>
    </div>
  </main>

  <!-- Footer mínimo -->
  <footer style="margin-top: auto; padding: 20px; text-align: center; color: #666;">
    <p>© {{ now()->year }} PsicoDesarrollo. Todos los derechos reservados.</p>
  </footer>

  <!-- Script para notificaciones -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.close-btn').click(function() {
        $('.notification').fadeOut(300);
      });
    });
  </script>
</body>

</html>
