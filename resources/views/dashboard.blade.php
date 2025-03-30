@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<section class="full-box dashboard-contentPage">
<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="#!" class="btn-Notifications-area">
						<i class="zmdi zmdi-notifications-none"></i>
						<span class="badge">7</span>
					</a>
				</li>
				<li>
					<a href="#!" class="btn-modal-help">
						<i class="zmdi zmdi-help-outline"></i>
					</a>
				</li>
			</ul>
		</nav>
</section>

<section class="full-box dashboard-contentPage">
    <div class="container-fluid">
        <div class="page-header">
        </div>
    </div>
    
    <div class="full-box text-center" style="padding: 30px 10px;">
        <article class="full-box tile">
            <div class="full-box tile-title text-center text-titles text-uppercase">
                Total Usuarios
            </div>
            <div class="full-box tile-icon text-center">
                <i class="zmdi zmdi-account"></i>
            </div>
            <div class="full-box tile-number text-titles">
                <p class="full-box">{{ $totalUsuarios }}</p>
                <small>Registrados</small>
            </div>
        </article>
        
        <article class="full-box tile">
            <div class="full-box tile-title text-center text-titles text-uppercase">
                Especialistas
            </div>
            <div class="full-box tile-icon text-center">
                <i class="zmdi zmdi-male-alt"></i>
            </div>
            <div class="full-box tile-number text-titles">
                <p class="full-box">{{ $totalEspecialistas }}</p>
                <small>Registrados</small>
            </div>
        </article>
        
        <article class="full-box tile">
            <div class="full-box tile-title text-center text-titles text-uppercase">
                Secretarias
            </div>
            <div class="full-box tile-icon text-center">
                <i class="zmdi zmdi-male-female"></i>
            </div>
            <div class="full-box tile-number text-titles">
                <p class="full-box">{{ $totalSecretarias }}</p>
                <small>Registrados</small>
            </div>
        </article>
        
        <article class="full-box tile">
            <div class="full-box tile-title text-center text-titles text-uppercase">
                Pacientes
            </div>
            <div class="full-box tile-icon text-center">
                <i class="zmdi zmdi-face"></i>
            </div>
            <div class="full-box tile-number text-titles">
                <p class="full-box">{{ $totalPacientes }}</p>
                <small>Registrados</small>
            </div>
        </article>
        
        <article class="full-box tile">
            <div class="full-box tile-title text-center text-titles text-uppercase">
                Representantes
            </div>
            <div class="full-box tile-icon text-center">
                <i class="zmdi zmdi-male-female"></i>
            </div>
            <div class="full-box tile-number text-titles">
                <p class="full-box">{{ $totalRepresentantes }}</p>
                <small>Registrados</small>
            </div>
        </article>
    </div>

    <div>
    <h3>Distribución de Género</h3>
    <canvas id="graficaGenero" width="400" height="400"></canvas>
</div>

<div>
    <h3>Distribución de Edades</h3>
    <canvas id="graficaEdades" width="400" height="400"></canvas>
</div>

</section>

@endsection
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function () {
    fetch("{{ route('estadisticas.pacientes') }}")
        .then(response => response.json())
        .then(data => {
            // Gráfica de Donut (Género)
            new Chart(document.getElementById('graficaGenero'), {
                type: 'doughnut',
                data: {
                    labels: ['Masculino', 'Femenino'],
                    datasets: [{
                        data: [data.generos.Masculino, data.generos.Femenino],
                        backgroundColor: ['#36A2EB', '#FF6384']
                    }]
                }
            });

            // Gráfica de Barras (Edades)
            new Chart(document.getElementById('graficaEdades'), {
                type: 'bar',
                data: {
                    labels: data.edades.rangos.map(meses => meses + ' meses'),
                    datasets: [{
                        label: 'Cantidad de Pacientes',
                        data: data.edades.cantidad,
                        backgroundColor: '#4CAF50'
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })
        .catch(error => console.error('Error al cargar datos:', error));
});
</script>
@endsection
