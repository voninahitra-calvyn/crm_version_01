<!-- resources\views\centreappels\compte\edit.blade.php -->



<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte centre d\'appels'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('centreappels.index')); ?>"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li><a href="<?php echo e(route('centreappels.compte', [$centreappel])); ?>">Compte</a></li>
	<li class="active">Modification</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification compte</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo e(route('centreappels.updatecompte', [$compte])); ?>" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="GET">
                 
				<?php if($errors->any()): ?>
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
					<div class="alert-danger-liste">
						<ul>
							<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <li><?php echo e($error); ?></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div><br />
                <?php endif; ?>
				
				<?php echo e(csrf_field()); ?>

                <!--
				<?php if($errors->any()): ?>
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
                <?php endif; ?>
				-->
				<div class="box-body">
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">ID : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="<?php echo e(substr($compte->_id,3,-16)); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo e($compte->nom); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo e($compte->prenom); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($compte->telephone); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($compte->email); ?>">
						</div>
					</div>
					<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>" >
						<label for="password" class="col-sm-2 control-label">Mot de passe : </label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
						</div>
					</div>
					<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
						<label for="statut" class="col-sm-2 control-label">Statut : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut" style="width: 100%;">
								<option value="Superviseur" <?php echo e(( $compte->statut == 'Superviseur') ? 'selected' : ''); ?>>Superviseur</option>
								<option value="Agent" <?php echo e(( $compte->statut == 'Agent') ? 'selected' : ''); ?>>Agent</option>
							</select>
						</div>
					</div>
					<div class="form-group " id="">
						<label for="audio" class="col-sm-2 control-label">Audio : </label>
						<div class="col-sm-10">
							<audio src="<?php echo e(asset('/uploads/audio')); ?>/<?php echo e($compte->audio); ?>" controls>Veuillez mettre à jour votre navigateur !</audio>
							<div class="btn btn-primary btn-file  audio">
								<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
								<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
								<input type="file" id="audioInputfile" name="audioInputfile"   accept="audio/*"/>
							</div>
							<input type="hidden" id="is_audio" name="is_audio" value="Non" />
							<input type="hidden" id="hidden_audio" name="hidden_audio" value="<?php echo e($compte->audio); ?>" />
							<input type="hidden" id="hidden_audio1" name="hidden_audio1" value="<?php echo e($compte->audio); ?>" />
							<button class="btn btn-primary btn-xs hidden" id="btnmodifaudio" name="btnmodifaudio" type="submit"><i class="fa fa-edit"></i> Modifier audio</button>
							<button type="submit" id="btnmodifautreinfo" class="btn btn-success audio hidden"><i class="fa fa-check"></i> Valider</button>
							<button id="btnsupprimer" type="submit" class="btn btn-danger audio"><i class="fa fa-trash"></i> Supprimer</button>
						</div>
					</div>  
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($compte->note); ?></textarea>
						</div>
					</div>
					<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>" id="">
						<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle"><?php echo e($compte->noteconfidentielle); ?></textarea>
						</div>
					</div>  
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-primary pull-right">Valider</button>
						</div>
					</div>
					
				</div>
			</form>
	
		</div>      
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/centreappels/compte/edit.blade.php ENDPATH**/ ?>