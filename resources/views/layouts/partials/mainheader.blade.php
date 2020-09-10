
   <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
		  <img src="{{ asset('/img/mobile-logo.png') }}" class="logo-image" alt="logo Image" />
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse mobile-menu" id="navbar-collapse">

			<ul class="nav navbar-nav">
                 <li @if (\Request::is('home*')) class="active" @endif><a href="{{ url('/home') }}">ACCUEIL</a></li>
			   @if (Auth::guest())
                    <!-- <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li> -->
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
					@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
					<li @if (\Request::is('staff*','centreappel*','client*')) class="active" @endif>
						<a href="{{ url('staffs') }}"><i class='fa fa-address-card'></i> <span>Comptes</span></a>
					</li>
					@endif
					@if (Auth::user()->statut == 'Superviseur')
					<li @if (\Request::is('centreappel*')) class="active" @endif>
						<a href="{{ url('centreappels') }}/{{Auth::user()->centreappel_id}}/compte"><i class='fa fa-address-card'></i> <span>Comptes</span></a>
					</li>
					@endif
					<!-- <li @if (\Request::is('staff*','centreappel*','client*')) class="dropdown active" @endif>
						<a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('centreappels') }}"><i class='fa fa-address-card'></i> <span>Comptes</span> <i class="fa fa-angle-down pull-up"></i></a>
						<ul class="dropdown-menu">
							@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
								<li><a href="{{ url('staffs') }}">Staff</a></li>
								<li class="divider"></li>
							@endif
							<li><a href="{{ url('centreappels') }}">Centre d'appels</a></li>
							<li class="divider"></li>
							<li><a href="{{ url('clients') }}">Client</a></li>
						</ul>
					</li> -->
					<!-- <li @if (\Request::is('centreappel*')) class="active" @endif>
						<a href="{{ url('centreappels') }}"><i class='fa fa-users'></i> <span>Comptes</span></a>
					</li> -->
					@if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial')
					<li @if (\Request::is('rendez-vous*','rdvs*')) class="active" @endif>
						<!-- <a href="{{ url('rendez-vous/'.Auth::user()->_id.'/client') }}"><i class='fa fa-clock-o'></i> <span>Rendez-vous</span></a> -->
						<a href="{{ url('rendez-vous/tout') }}"><i class='fa fa-clock-o'></i> <span>PRODUCTION</span></a>
					</li>
					@endif
					@if (Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial')
					<li @if (\Request::is('rendez-vous*','rdvs*')) class="active" @endif>
						<a href="{{ url('rendez-vous/tout') }}"><i class='fa fa-clock-o'></i> <span>PRODUCTION</span></a>
						<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('rendez-vous/tout') }}"><i class='fa fa-address-card'></i> <span>Rendez-vous</span> <i class="fa fa-angle-down pull-up"></i></a>
						<ul class="dropdown-menu">
							<li><a href="{{ url('rendez-vous/defiscalisation') }}">Défiscalisation</a></li>
							<li class="divider"></li>
							<li><a href="{{ url('rendez-vous/nettoyagepro') }}">Nettoyage pro</a></li>
							<li class="divider"></li>
							<li><a href="{{ url('rendez-vous/assurancepro') }}">Assurance pro</a></li>
							<li class="divider"></li>
							<li><a href="{{ url('rendez-vous/mutuellesantesenior') }}">Mutuelle santé sénior</a></li>
							<li class="divider"></li>
							<li><a href="{{ url('rendez-vous/autre') }}">Autres</a></li>
						</ul> -->
					</li>
					@endif
					<li @if (\Request::is('agenda*')) class="active" @endif>
						<a href="{{ url('agendas') }}"><i class='fa fa-calendar'></i> <span>Agenda</span></a>
					</li>
					@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<li @if (\Request::is('supports*')) class="active" @endif>
							<a href="{{route('supports.index')}}"><i class='fa fa-users'></i> <span>Support client</span></a>
						</li>
					@else
						<li @if (\Request::is('supports*')) class="active" @endif>
							<a href="{{route('supports.show', Auth::user()->_id)}}"><i class='fa fa-users'></i> <span>Support client</span></a>
						</li>					
					@endif
						<li class="dropdown user user-menu" id="user_menu" style="max-width: 130px;white-space: nowrap;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 130px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis">
								<img src="{{ asset('/img/avatar.png') }}" class="user-image" alt="User Image" />
								<!-- <span class="hidden-xs" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span> -->
								<span data-toggle="tooltip" title="{{ Auth::user()->name }}" class="overflow">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="{{ asset('/img/avatar.png') }}" class="img-circle" alt="User Image" />
									<p>
										<span data-toggle="tooltip" class="overflow" title="{{ Auth::user()->name }}">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
									</p>
								</li>
								<li class="user-footer">
									<!-- <div class="pull-left"> -->
									<div class="pull-center" style="margin-bottom: 10px;">
										<!-- <a href="{{--route('rdvs.destroy', $rdv->id)--}}" class="btn btn-default btn-flat" id="logout"> -->
										<a href="{{route('staffs.show', Auth::user()->_id)}}" class="btn btn-default btn-flat" id="logout">
										   Mon compte
										</a>
									</div>
									<div class="pull-center">
										<a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
										   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
											{{ trans('adminlte_lang::message.signout') }}
										</a>

										<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
											<input type="submit" value="logout" style="display: none;">
										</form>

									</div>
								</li>
							</ul>
						</li>
					
				@endif

				
				<!-- <li @if (\Request::is('classes*')) class="active" @endif>
					<a href="{{ url('classes') }}"><i class='fa fa-building'></i> <span>Classes</span></a>
				</li>
				<li @if (\Request::is('notes*')) class="active" @endif>
					<a href="{{ url('notes') }}"><i class='fa fa-exchange'></i> <span>Notes</span></a>
				</li>
				<li class='disabled'><a href="#"><i class='fa fa-briefcase'></i> <span>Parents</span></a></li> -->
			</ul>
        </div>
        <!-- /.navbar-collapse -->

	  </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  