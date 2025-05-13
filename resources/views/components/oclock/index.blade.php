<section>
  <span>
    <p>Bienvenido(a) {{ current_user()->name }}</p>
  </span>
  <span id="fechaReloj">
    <span>
      <span id="diaSemana" class="diaSemana"></span>
      <span id="dia" class="dia"></span>
      <span>de </span>
      <span id="mes" class="mes"></span>
      <span>del </span>
      <span id="year" class="year"></span>
    </span>
    <span>, </span>
    <span class="reloj">
      <span id="horas" class="horas"></span>
      <span>:</span>
      <span id="minutos" class="minutos"></span>
      <span>:</span>
      <span class="caja-segundos flex gap-1">
        <span id="segundos" class="segundos"></span>
        <span id="ampm" class="ampm"></span>
      </span>
    </span>
  </span>
</section>
