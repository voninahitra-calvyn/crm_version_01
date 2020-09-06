
   <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
		  <img src="<?php echo e(asset('/img/mobile-logo.png')); ?>" class="logo-image" alt="logo Image" />
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse mobile-menu" id="navbar-collapse">

			<ul class="nav navbar-nav">
                 <li <?php if(\Request::is('home*')): ?> class="active" <?php endif; ?>><a href="<?php echo e(url('/home')); ?>">Index</a></li>
			   <?php if(Auth::guest()): ?>
                    <!-- <li><a href="<?php echo e(url('/register')); ?>"><?php echo e(trans('adminlte_lang::message.register')); ?></a></li> -->
                    <li><a href="<?php echo e(url('/login')); ?>"><?php echo e(trans('adminlte_lang::message.login')); ?></a></li>
                <?php else: ?>
					<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
					<li <?php if(\Request::is('staff*','centreappel*','client*')): ?> class="active" <?php endif; ?>>
						<a href="<?php echo e(url('staffs')); ?>"><i class='fa fa-address-card'></i> <span>Comptes</span></a>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->statut == 'Superviseur'): ?>
					<li <?php if(\Request::is('centreappel*')): ?> class="active" <?php endif; ?>>
						<a href="<?php echo e(url('centreappels')); ?>/<?php echo e(Auth::user()->centreappel_id); ?>/compte"><i class='fa fa-address-card'></i> <span>Comptes</span></a>
					</li>
					<?php endif; ?>
					<!-- <li <?php if(\Request::is('staff*','centreappel*','client*')): ?> class="dropdown active" <?php endif; ?>>
						<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo e(url('centreappels')); ?>"><i class='fa fa-address-card'></i> <span>Comptes</span> <i class="fa fa-angle-down pull-up"></i></a>
						<ul class="dropdown-menu">
							<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
								<li><a href="<?php echo e(url('staffs')); ?>">Staff</a></li>
								<li class="divider"></li>
							<?php endif; ?>
							<li><a href="<?php echo e(url('centreappels')); ?>">Centre d'appels</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo e(url('clients')); ?>">Client</a></li>
						</ul>
					</li> -->
					<!-- <li <?php if(\Request::is('centreappel*')): ?> class="active" <?php endif; ?>>
						<a href="<?php echo e(url('centreappels')); ?>"><i class='fa fa-users'></i> <span>Comptes</span></a>
					</li> -->
					<?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
					<li <?php if(\Request::is('rendez-vous*','rdvs*')): ?> class="active" <?php endif; ?>>
						<!-- <a href="<?php echo e(url('rendez-vous/'.Auth::user()->_id.'/client')); ?>"><i class='fa fa-clock-o'></i> <span>Rendez-vous</span></a> -->
						<a href="<?php echo e(url('rendez-vous/tout')); ?>"><i class='fa fa-clock-o'></i> <span>PRODUCTION</span></a>
					</li>
					<?php endif; ?>
					<?php if(Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial'): ?>
					<li <?php if(\Request::is('rendez-vous*','rdvs*')): ?> class="active" <?php endif; ?>>
						<a href="<?php echo e(url('rendez-vous/tout')); ?>"><i class='fa fa-clock-o'></i> <span>PRODUCTION</span></a>
						<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo e(url('rendez-vous/tout')); ?>"><i class='fa fa-address-card'></i> <span>Rendez-vous</span> <i class="fa fa-angle-down pull-up"></i></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo e(url('rendez-vous/defiscalisation')); ?>">Défiscalisation</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo e(url('rendez-vous/nettoyagepro')); ?>">Nettoyage pro</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo e(url('rendez-vous/assurancepro')); ?>">Assurance pro</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo e(url('rendez-vous/mutuellesantesenior')); ?>">Mutuelle santé sénior</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo e(url('rendez-vous/autre')); ?>">Autres</a></li>
						</ul> -->
					</li>
					<?php endif; ?>
					<li <?php if(\Request::is('agenda*')): ?> class="active" <?php endif; ?>>
						<a href="<?php echo e(url('agendas')); ?>"><i class='fa fa-calendar'></i> <span>Agenda</span></a>
					</li>
					<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
						<li <?php if(\Request::is('supports*')): ?> class="active" <?php endif; ?>>
							<a href="<?php echo e(route('supports.index')); ?>"><i class='fa fa-users'></i> <span>Support client</span></a>
						</li>
					<?php else: ?>
						<li <?php if(\Request::is('supports*')): ?> class="active" <?php endif; ?>>
							<a href="<?php echo e(route('supports.show', Auth::user()->_id)); ?>"><i class='fa fa-users'></i> <span>Support client</span></a>
						</li>					
					<?php endif; ?>
						<li class="dropdown user user-menu" id="user_menu" style="max-width: 130px;white-space: nowrap;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="max-width: 130px;white-space: nowrap;overflow: hidden;overflow-text: ellipsis">
								<img src="<?php echo e(asset('/img/avatar.png')); ?>" class="user-image" alt="User Image" />
								<!-- <span class="hidden-xs" data-toggle="tooltip" title="<?php echo e(Auth::user()->name); ?>"><?php echo e(Auth::user()->name); ?></span> -->
								<span data-toggle="tooltip" title="<?php echo e(Auth::user()->name); ?>" class="overflow"><?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?php echo e(asset('/img/avatar.png')); ?>" class="img-circle" alt="User Image" />
									<p>
										<span data-toggle="tooltip" class="overflow" title="<?php echo e(Auth::user()->name); ?>"><?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?></span>
									</p>
								</li>
								<li class="user-footer">
									<!-- <div class="pull-left"> -->
									<div class="pull-center" style="margin-bottom: 10px;">
										<!-- <a href="" class="btn btn-default btn-flat" id="logout"> -->
										<a href="<?php echo e(route('staffs.show', Auth::user()->_id)); ?>" class="btn btn-default btn-flat" id="logout">
										   Mon compte
										</a>
									</div>
									<div class="pull-center">
										<a href="<?php echo e(url('/logout')); ?>" class="btn btn-default btn-flat" id="logout"
										   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
											<?php echo e(trans('adminlte_lang::message.signout')); ?>

										</a>

										<form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
											<?php echo e(csrf_field()); ?>

											<input type="submit" value="logout" style="display: none;">
										</form>

									</div>
								</li>
							</ul>
						</li>
					
				<?php endif; ?>

				
				<!-- <li <?php if(\Request::is('classes*')): ?> class="active" <?php endif; ?>>
					<a href="<?php echo e(url('classes')); ?>"><i class='fa fa-building'></i> <span>Classes</span></a>
				</li>
				<li <?php if(\Request::is('notes*')): ?> class="active" <?php endif; ?>>
					<a href="<?php echo e(url('notes')); ?>"><i class='fa fa-exchange'></i> <span>Notes</span></a>
				</li>
				<li class='disabled'><a href="#"><i class='fa fa-briefcase'></i> <span>Parents</span></a></li> -->
			</ul>
        </div>
        <!-- /.navbar-collapse -->

	  </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/layouts/partials/mainheader.blade.php ENDPATH**/ ?>