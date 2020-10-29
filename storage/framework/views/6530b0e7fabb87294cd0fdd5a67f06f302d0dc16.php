<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Staff'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Staff</a></li>
	<li class="active">Comptes</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
	<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>	
		<div class="col-md-2">
			<div class="box box-solid">
				<div class="box-header with-border rouge">
					<h3 class="box-title">Type compte</h3>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">
					<li class="active">
						<a href="staffs">
							<i class="fa fa-users"></i> Staff
							<span class="label label-danger pull-right"><?php echo e(count($staffs)); ?></span>
						</a>
					</li>
					<li>
						<a href="centreappels">
							<i class="fa fa-phone"></i> Centre d'appels 
							<span class="label label-danger pull-right"><?php echo e(count($centreappels)); ?></span>
						</a>
					</li>
					<li>
						<a href="clients">
							<i class="fa fa-user"></i> Client
							<span class="label label-danger pull-right"><?php echo e(count($clients)); ?></span>
						</a>
					</li>
				  </ul>
				</div>
				<!-- /.box-body -->
			</div>

		</div>
		
		<div class="col-md-10">
			<div class="box box-white">
				<div class="box-header with-border rouge">
					<h3 class="box-title">Compte staff</h3>
					<!-- <div class="box-tools pull-right recherche">
						<div class="has-feedback">
							<input type="text" class="form-control input-sm" placeholder="Recherche">
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>
					</div> -->
					<div class="box-tools pull-right">
						<form action = "<?php echo e(route('staffs.create')); ?>" method="post" class="">
							<?php echo csrf_field(); ?>
							<?php echo method_field('GET'); ?>
							<button class="btn btn-success btn-sm" type="submit">Ajouter staffs</button>
						</form> 
					</div>
				</div>
				<div class="box-body no-padding">
					<!-- <div class="box-body table-responsive no-padding"> -->
					<div  class="table-responsive box-body no-padding">
						<table id="tablestaff" class="table table-hover table-striped">
							<thead class="theadexcel">
								<tr class="header">
									<th style="width: 50px;"></th>
									<th style="width: 50px;"></th>
									<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
										<th>ID</th>
									<?php endif; ?>
									<th>Nom</th>
									<th>Prénom(s)</th>
									<th>Téléphone</th>
									<th>Email</th>
									<th>Statut</th>
									<th>Note</th>
									<th>Etat</th>
								</tr>
								</thead>
							<tbody>
							<?php $__currentLoopData = $staffs->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										<form action = "<?php echo e(route('staffs.edit', [$staff])); ?>" method="post" class="">
											<?php echo csrf_field(); ?>
											<?php echo method_field('GET'); ?>
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td>
										<form  action = "<?php echo e(route('staffs.destroy', [$staff])); ?>" method="post" class="" onsubmit="return confirmDelete();">
											<?php echo csrf_field(); ?>
											<?php echo method_field('DELETE'); ?>
											<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
										</form> 
									</td>
									<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
									<td><a href="#"><?php echo e(substr($staff->_id,3,-16)); ?></a></td>
									<?php endif; ?>
									<td><a href="#"><?php echo e($staff->nom); ?></a></td>
									<td><?php echo e($staff->prenom); ?></td>
									<td><?php echo e($staff->telephone); ?></td>
									<td><?php echo e($staff->email); ?></td>
									<td><?php echo e($staff->statut); ?></td>
									<td><?php echo e($staff->note); ?></td>
									<td><?php echo e($staff->etat ? $staff->etat : 'Actif'); ?></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

							</tbody>
							</table>
					</div>

				</div>
			</div>
		</div>
		
		<div class="col-sm-12">

		  <?php if(session()->get('success')): ?>
			<div class="alert alert-success">
			  <?php echo e(session()->get('success')); ?>

			</div>
		  <?php endif; ?>
		</div>


	<?php else: ?>
		<div class="error-page droit">
			<h2 class="headline text-yellow">Erreur  </h2>

			<div class="error-content">
				<h3><i class="fa fa-warning text-yellow"></i> Vous n'avez pas le droit d'accéder à cette page.</h3>
			</div>
		</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projet freelance\crm1\resources\views/staffs/index.blade.php ENDPATH**/ ?>