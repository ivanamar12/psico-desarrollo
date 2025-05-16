<!-- Notification for Status -->
@if (session('status'))
  <div class="notification">
    <span class="icon">✅</span> <!-- Cambié el icono a un check -->
    <div class="notification-content">
      <span>{{ session('status') }}</span>
    </div>
    <button class="close-btn">&times;</button>
  </div>
@endif

<!-- Notification for Errors (existente) -->
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
