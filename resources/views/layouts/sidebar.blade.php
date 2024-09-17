<section class="full-box cover dashboard-sideBar">
		<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
		<div class="full-box dashboard-sideBar-ct">
			<!--SideBar Title -->
			<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
				PsicoDesarrollo <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
			</div>
			<!-- SideBar User info -->
			<div class="full-box dashboard-sideBar-UserInfo">
				<figure class="full-box">
					<img src="./assets/img/avatar.png" alt="UserIcon">
					<figcaption class="text-center text-titles">{{ Auth::user()->name }}</figcaption>
				</figure>
				<ul class="full-box list-unstyled text-center">
					<li>
						<a href="#!">
							<i class="zmdi zmdi-settings"></i>
						</a>
					</li>
					<li>
						<form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="zmdi zmdi-power">
                            </x-dropdown-link>
                        </form>
					</li>
				</ul>
			</div>
			<!-- SideBar Menu -->
			<ul class="list-unstyled full-box dashboard-sideBar-Menu">
				<li>
					<a href="{{ route('dashboard') }}">
						<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> INICIO
					</a>
				</li>
				<li>
					<a href="{{ route('especialista.index') }}" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Especialistas <i class="zmdi zmdi-caret-"></i>
					</a>
				</li>
				<li>
					<a href="{{ route('secretaria.index') }}" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Secretarias <i class="zmdi zmdi-caret-"></i>
					</a>
				</li>
				<li>
					<a href="{{ route('representante.index') }}" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-male-female zmdi-hc-fw"></i> Representantes <i class="zmdi zmdi-caret-"></i>
					</a>
				</li>
				<li>
					<a href="{{ route('paciente.index') }}" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-face zmdi-hc-fw"></i> Pacientes <i class="zmdi zmdi-caret-"></i>
					</a>
				</li>
				<li>
					<a href="{{ route('citas.index') }}" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-calendar zmdi-hc-fw"></i> Citas <i class="zmdi zmdi-caret-"></i>
					</a>
				</li>
				<li>
					<a href="{{ route('paciente.index') }}" class="btn-sideBar-SubMenu">
						<i class="zmdi zmdi-file zmdi-hc-fw"></i> Historias Clinicas <i class="zmdi zmdi-caret-"></i>
					</a>
				</li>
			</ul>
		</div>
	</section>