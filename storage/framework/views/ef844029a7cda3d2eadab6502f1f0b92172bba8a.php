<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte staff'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Staff</a></li>
	<li class="active">Modification</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification staff</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

                 
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
				
            <form class="form-horizontal" method="post" action="<?php echo e(route('staffs.update', $staff->_id)); ?>">
				<?php echo csrf_field(); ?>
				<?php echo method_field('PUT'); ?>
				
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
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="<?php echo e(substr($staff->_id,3,-16)); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo e($staff->nom); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo e($staff->prenom); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($staff->telephone); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($staff->email); ?>">
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
								<option value="Administrateur" <?php echo e(( $staff->statut == 'Administrateur') ? 'selected' : ''); ?>>Administrateur</option>
								<option value="Staff" <?php echo e(( $staff->statut == 'Staff') ? 'selected' : ''); ?>>Staff</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($staff->note); ?></textarea>
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/staffs/edit.blade.php ENDPATH**/ ?>