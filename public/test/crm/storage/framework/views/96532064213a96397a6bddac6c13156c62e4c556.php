<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte centre d\'appels'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('centreappels.index')); ?>"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li class="active">Consulter tous les centres d'appels</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
	<div class="col-md-2">
	  <div class="box box-solid">
		<div class="box-header with-border rouge">
		  <h3 class="box-title">Type compte</h3>
		</div>
		<div class="box-body no-padding">
		  <ul class="nav nav-pills nav-stacked">
			<li>
				<a href="staffs">
					<i class="fa fa-users"></i> Staff
					<span class="label label-danger pull-right"><?php echo e(count($staffs)); ?></span>
				</a>
			</li>
			<li class="active">
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
				<h3 class="box-title">Compte centre d'appels</h3>
				<!-- <div class="box-tools pull-right recherchecentreappel">
					<div class="has-feedback">
						<input type="text" class="form-control input-sm" placeholder="Recherche">
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</div> -->
				<div class="box-tools pull-right">
					<form action = "<?php echo e(route('centreappels.create')); ?>" method="post" class="">
						<?php echo csrf_field(); ?>
						<?php echo method_field('GET'); ?>
						<button class="btn btn-success btn-sm" type="submit">Ajouter centre d'appels</button>
					</form>
				</div>
		</div>
		
		<div class="box-body no-padding">
			<div class="box-body table-responsive no-padding">
				<table id="tablecentreappel" class="table table-hover table-striped">
					<thead class="theadexcel">
					<tr class="header">
						<th style="width: 50px;"></th>
						<th style="width: 50px;"></th>
						<th style="width: 50px;"></th>
						<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
						<th>ID</th>
						<?php endif; ?>
						<th>Societe</th>
						<th>Adresse</th>
						<th>Cp</th>
						<th>Ville</th>
						<th>Pays</th>
						<th>Téléphone</th>
						<th>Email</th>
						<!-- <th>Note</th> -->
					</tr>
								</thead>
							<tbody>
					<?php $__currentLoopData = $centreappels->sortByDesc('centreappel'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centreappel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
							<form action = "<?php echo e(route('centreappels.edit', [$centreappel])); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('GET'); ?>
								<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
							</form>
						</td>
						<td>
							<form  action = "<?php echo e(route('centreappels.destroy', $centreappel->id)); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('DELETE'); ?>
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
							</form> 
						</td>
						<td>
							<form action = "<?php echo e(route('centreappels.compte', [$centreappel])); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('GET'); ?>
								<button class="btn btn-success btn-xs" type="submit"><i class="fa fa-user"></i> Compte</button>
							</form>
						</td>
						<!-- <td><a href="#"><?php echo e($centreappel->societe); ?></a></td> -->
						<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
						<td><a href="#"><?php echo e(substr($centreappel->_id,3,-16)); ?></a></td>
						<?php endif; ?>
						<td><?php echo e($centreappel->societe); ?></td>
						<td><?php echo e($centreappel->adresse); ?></td>
						<td><?php echo e($centreappel->cp); ?></td>
						<td><?php echo e($centreappel->ville); ?></td>
						<td><?php echo e($centreappel->pays); ?></td>
						<td><?php echo e($centreappel->telephone); ?></td>
						<td><?php echo e($centreappel->email); ?></td>
						<!-- <td><?php echo e($centreappel->note); ?></td> -->
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					</tbody>
				</table>
			</div>

		</div>

	  </div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/centreappels/index.blade.php ENDPATH**/ ?>