<!-- resources\views\staffs\moncompte.blade.php -->



<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte staff'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Staff</a></li>
	<li class="active">Mon compte</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-4">

			<!-- Profile Image -->
			<div class="box box-danger">
				<div class="box-body box-profile">
					<?php if($staff->img==''): ?>
						<img class="profile-user-img img-responsive img-circle" src="<?php echo e(asset('/img/avatar.png')); ?>" alt="Image profil" />
					<?php else: ?>
						<img class="profile-user-img img-responsive img-circle" src="<?php echo e(URL::to('/')); ?>/img/utilisateurs/<?php echo e($profil->img); ?>" alt="Image profil" />
					<?php endif; ?>

					<h3 class="profile-username text-center  rouge"><?php echo e($staff->nom); ?> <?php echo e($staff->prenom); ?></h3>

					<p class="text-muted text-center rouge"><?php echo e($staff->statut); ?></p>
					

					<ul class="list-group list-group-unbordered ">
						<li class="list-group-item titre rouge">
							<b><i class="fa fa-phone-square margin-r-5"></i> T&eacute;l&eacute;phone :</b>
						</li>
						<li class="list-group-item contenu">
							<p>
							<?php echo e($staff->telephone); ?>

							</p>
						</li>
						<li class="list-group-item titre rouge">
							<b><i class="fa fa-envelope margin-r-5"></i> E-mail :</b>
						</li>
						<li class="list-group-item contenu">
							<?php echo e($staff->email); ?>

						</li>
					</ul>
					

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
			</div>
			<div class="col-md-8">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title form rouge">Modifier mot de passe</h3>
					</div>
					<?php if($errors->any()): ?>
						<div class="alert alert-danger" role="alert">
							Veuillez s'il vous plait corriger les erreurs suivantes :
						</div>
						<div class="alert-danger-liste">
							<ul>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <li><?php echo e($error); ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div><br />
					<?php endif; ?>
					
					<?php if(session()->get('success')): ?>
						<div class="alert alert-success">
						  <?php echo e(session()->get('success')); ?>

						</div>
					<?php endif; ?>
						
					<form class="form-horizontal" method="post" action="<?php echo e(route('staffs.modifmotdepasse', $staff->_id)); ?>">
						<?php echo csrf_field(); ?>
						<?php echo method_field('GET'); ?>
						
						<!--
						<?php if($errors->any()): ?>
							<div class="alert alert-danger" role="alert">
								Veuillez s'il vous plait corriger les erreurs suivantes
							</div>
						<?php endif; ?>
						-->
						<div class="box-body">
							<div class="form-group">
								<label for="nom" class="col-sm-12 control-label">Ancien mot de passe : </label>
								<div class="col-sm-12">
								  <input type="password" class="hidden form-control" name="motdepasse" id="motdepasse" value=<?php echo e($staff->password); ?>>
								  <input type="password" class=" form-control" name="ancienmotdepasse" id="ancienmotdepasse" placeholder="mot de passe">
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-12 control-label">Nouveau mot de passe : </label>
								<div class="col-sm-12">
								  <input type="password" class="form-control" name="nouveaumotdepasse" id="nouveaumotdepasse" placeholder="mot de passe">
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="note" class="col-sm-12 control-label">Note : </label>
								<div class="col-sm-12">
								  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($staff->note); ?></textarea>
								</div>
							</div> -->
							<div class="form-group">
								<div class="col-sm-offset-1 col-sm-10">
									<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
									<button type="submit" class="btn btn-primary pull-right">Modifier</button>
								</div>
							</div>
							
						</div>
					</form>
			
				</div>      
				
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title form rouge">Autre Infos</h3>
					</div>
					<?php if($errors->any()): ?>
						<div class="alert alert-danger" role="alert">
							Veuillez s'il vous plait corriger les erreurs suivantes :
						</div>
						<div class="alert-danger-liste">
							<ul>
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <li><?php echo e($error); ?></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div><br />
					<?php endif; ?>
					
					<?php if(session()->get('successAutreInfo')): ?>
						<div class="alert alert-success">
						  <?php echo e(session()->get('successAutreInfo')); ?>

						</div>
					<?php endif; ?>
						
					<form class="form-horizontal" method="post" action="<?php echo e(route('staffs.modifinfo', $staff->_id)); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						<?php echo method_field('GET'); ?>
						
						<div class="box-body">
							<?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> 
							<div class="form-group" id="">
								<label for="audio" class="col-sm-2 control-label">Audio : </label>
								<div class="col-sm-10">
									<audio src="<?php echo e(asset('/uploads/audio')); ?>/<?php echo e($staff->audio); ?>" controls>Veuillez mettre à jour votre navigateur !</audio>
									<div class="btn btn-primary btn-file  audio">
										<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
										<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
										<input type="file" id="audioInputfile" name="audioInputfile" />
									</div>
									<input type="hidden" id="is_audio" name="is_audio" value="Non" />
									<input type="hidden" id="hidden_audio" name="hidden_audio" value="<?php echo e($staff->audio); ?>" />
									<input type="hidden" id="hidden_audio1" name="hidden_audio1" value="<?php echo e($compte->audio); ?>" />
									<button class="btn btn-primary btn-xs hidden" id="btnmodifaudio" name="btnmodifaudio" type="submit"><i class="fa fa-edit"></i> Modifier audio</button>
									<button type="submit" id="btnmodifautreinfo" class="btn btn-success audio hidden"><i class="fa fa-check"></i> Valider</button>
									<button id="btnsupprimer" type="submit" class="btn btn-danger audio"><i class="fa fa-trash"></i> Supprimer</button>
								</div>
							</div>      
							<?php endif; ?>
							<?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
							<div class="form-group">
								<label for="note" class="col-sm-2 control-label">Agenda public: </label>
								<div class="col-sm-10 control-txt">
									<a href="<?php echo e(url('/comresp_public')); ?>/<?php echo e($staff->_id); ?>" target="_blank" ><?php echo e(url('/comresp_public')); ?>/<?php echo e($staff->_id); ?></a>
								</div>
							</div>
							<div class="form-group">
								<label for="agendapriv" class="col-sm-2 control-label">Agenda privé: </label>
								<div class="col-sm-10">
									<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="<?php echo e($staff->agendapriv); ?>">
								</div>
							</div>
							<?php endif; ?>
							<div class="form-group">
								<label for="note" class="col-sm-2 control-label">Note : </label>
								<div class="col-sm-10">
								  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($staff->note); ?></textarea>
								</div>
							</div>
							<?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> 
							<div class="form-group" id="">
								<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle"><?php echo e($staff->noteconfidentielle); ?></textarea>
								</div>
							</div>      
							<?php endif; ?>
							<div class="form-group">
								<div class="col-sm-offset-1 col-sm-10">
									<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
									<button type="submit" class="btn btn-success pull-right">Modifier</button>
								</div>
							</div>
							
						</div>
					</form>
			
				</div>
			</div>


		</div>
		
      

	</section>
		
  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/staffs/moncompte.blade.php ENDPATH**/ ?>