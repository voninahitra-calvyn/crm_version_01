<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte client'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('clients.index')); ?>"><i class="fa fa-dashboard"></i> Client</a></li>
	<li class="active">Consulter tous les clients</li>
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
			<li>
				<a href="centreappels">
					<i class="fa fa-phone"></i> Centre d'appels 
					<span class="label label-danger pull-right"><?php echo e(count($centreappels)); ?></span>
				</a>
			</li>
			<li class="active">
				<a href="clients">
					<i class="fa fa-user"></i> Client
					<span class="label label-danger pull-right"><?php echo e(count($clients)); ?></span>
				</a>
			</li>
		  </ul>
		</div>
	  </div>

	</div>
	
	<div class="col-md-10">
	  <div class="box box-white">
		<div class="box-header with-border rouge">
		  <h3 class="box-title">Compte client</h3>
			<div class="box-tools pull-right">
				<form action = "<?php echo e(route('clients.create')); ?>" method="post" class="">
					<?php echo csrf_field(); ?>
					<?php echo method_field('GET'); ?>
					<button class="btn btn-success btn-sm" type="submit">Ajouter client</button>
				</form>
			</div>
		</div>
	<div class="box-body no-padding">
		<div class="box-body table-responsive no-padding">
			<table id="tableclient" class="table table-hover table-striped">
					<thead class="theadexcel">
				<tr class="header">
					<th style="width: 50px;"></th>
					<th style="width: 50px;"></th>
					<th style="width: 50px;"></th>
						<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
						<th>ID</th>
						<?php endif; ?>
					<th>Societe</th>
					<th>Note</th>
					<th>Societe</th>
					<th>Adresse</th>
					<th>Cp</th>
					<th>Ville</th>
					<th>Pays</th>
					<th>Téléphone</th>
					<th>Email</th>
					<th>Service</th>
				</tr>
					</thead>
					<tbody>
				<?php $__currentLoopData = $clients->sortByDesc('client'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<form action = "<?php echo e(route('clients.edit', [$client])); ?>" method="post" class="">
							<?php echo csrf_field(); ?>
							<?php echo method_field('GET'); ?>
							<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
						</form>
					</td>
					<td>
						<form  action = "<?php echo e(route('clients.destroy', $client->id)); ?>" method="post" class="">
							<?php echo csrf_field(); ?>
							<?php echo method_field('DELETE'); ?>
							<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
						</form> 
					</td>
					<td>
						<form action = "<?php echo e(route('clients.compte', [$client])); ?>" method="post" class="">
							<?php echo csrf_field(); ?>
							<?php echo method_field('GET'); ?>
							<button class="btn btn-success btn-xs" type="submit"><i class="fa fa-user"></i> Compte</button>
						</form>
					</td>
					<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
					<td><a href="#"><?php echo e(substr($client->_id,3,-16)); ?></a></td>
					<?php endif; ?>
					<td><a href="#"><?php echo e($client->societe2); ?></a></td>
					<td><a href="#"><?php echo e($client->note); ?></a></td>
					<td><?php echo e($client->societe); ?></td>
					<td><?php echo e($client->adresse); ?></td>
					<td><?php echo e($client->cp); ?></td>
					<td><?php echo e($client->ville); ?></td>
					<td><?php echo e($client->pays); ?></td>
					<td><?php echo e($client->telephone); ?></td>
					<td><?php echo e($client->email); ?></td>
					<td><?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <small class="label label-danger"><i class="fa fa-exchange"></i> <?php echo e($service); ?></small><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					</tbody>
			</table>
		</div>

	</div>

	  </div>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/clients/index.blade.php ENDPATH**/ ?>