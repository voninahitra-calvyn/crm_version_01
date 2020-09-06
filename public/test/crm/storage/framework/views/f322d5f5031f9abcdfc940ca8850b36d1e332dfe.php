<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte centre d\'appels'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('centreappels.index')); ?>"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li class="active">Ajout</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Ajout centre d'appel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo e(route('centreappels.store')); ?>">
                 
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
				
				
				 

                <?php echo csrf_field(); ?>

				<div class="box-body">
					<div class="form-group">
						<label for="societe" class="col-sm-2 control-label">Société : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société">
						</div>
					</div>
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Cp : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="cp" id="cp" placeholder="Cp">
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
						</div>
					</div>
					<div class="form-group">
						<label for="pays" class="col-sm-2 control-label">Pays : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="email" id="email"  placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-info pull-right">Valider</button>
						</div>
					</div>
					
				</div>
			</form>
	
		</div>      
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/centreappels/create.blade.php ENDPATH**/ ?>