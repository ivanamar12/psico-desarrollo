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
</section>

@endsection