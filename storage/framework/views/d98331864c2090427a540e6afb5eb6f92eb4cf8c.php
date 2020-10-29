<!-- resources\views\centreappels\edit.blade.php -->



<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte centre d\'appels'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('centreappels.index')); ?>"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li class="active">Modification</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification centre d'appel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo e(route('centreappels.update', [$centreappel])); ?>">
				<input type="hidden" name="_method" value="PUT">
                 
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
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="<?php echo e(substr($centreappel->_id,3,-16)); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="societe" class="col-sm-2 control-label">Société : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="<?php echo e($centreappel->societe); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?php echo e($centreappel->adresse); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Cp : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="cp" id="cp" placeholder="Cp" value="<?php echo e($centreappel->cp); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo e($centreappel->ville); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="pays" class="col-sm-2 control-label">Pays : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays" value="<?php echo e($centreappel->pays); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($centreappel->telephone); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($centreappel->email); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="effectif" class="col-sm-2 control-label">Effectif centre d’appels : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="effectif" id="effectif"  placeholder="Effectif centre d’appels" value="<?php echo e($centreappel->effectif); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="horaireprod" class="col-sm-2 control-label">Horaire de production : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="horaireprod" id="horaireprod"  placeholder="Horaire de production" value="<?php echo e($centreappel->horaireprod); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="campagnefavorite" class="col-sm-2 control-label">Campagne favorite : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="campagnefavorite" id="campagnefavorite"  placeholder="Campagne favorite" value="<?php echo e($centreappel->campagnefavorite); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($centreappel->note); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle"><?php echo e($centreappel->noteconfidentielle); ?></textarea>
						</div>
					</div>
                    <?php if(Auth::user()->statut == 'Administrateur'): ?>
					<div class="form-group">
						<label for="etat" class="col-sm-2 control-label">Etat : </label>
						<div class="col-sm-10">
							<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
								<?php if($centreappel->etat == "Actif" or $centreappel->etat == ''): ?>
									<option value="Actif">Activé</option>
									<option value="Inactif">Désactivé</option>
								<?php else: ?>
									<option value="Inactif">Désactivé</option>
									<option value="Actif">Activé</option>
								<?php endif; ?>
							</select>
						</div>
					</div>
                    <?php endif; ?>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projet freelance\crm1\resources\views/centreappels/edit.blade.php ENDPATH**/ ?>