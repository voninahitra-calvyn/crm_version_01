<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte client'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('clients.index')); ?>"><i class="fa fa-dashboard"></i> Client </a></li>
	<li class="active">Comptes</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
					<!-- <div class="info-box-header">
						<div class="lsp-widget_head">
							<div class="lsp-subheader_main">
								<form action="#" method="get" class="">
									<div class="input-group">
										<input type="text" name="q" class="form-control" placeholder="Recherche...">
										<span class="input-group-btn">
											<button type="submit" name="search" id="search-btn" class="btn btn-danger"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</form>  
							</div>		
						</div>
					</div> -->
    <!-- Main content -->
		<div class="box-body no-padding">
			<!-- <div class="box-body table-responsive no-padding"> -->
			<div  class="table-responsive box-body no-padding">
				<table id="tableajoutrdv" class="table table-hover table-striped">
					<thead class="theadexcel">
						<tr class="header">
					<th>Choix</th>
					<th>Référence client</th>
					<th>Campagne</th>
					<th>Nom du commercial</th>
					<!-- <th>Prénom(s)</th> -->
					<!-- <th>Téléphone</th> -->
					<!-- <th>Email</th> -->
					<th>Statut</th>
					<!-- <th>Note</th> -->
				</tr>
					</thead>
				<tbody>
				<?php $__currentLoopData = $comptes->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cmpt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<tr>
					<td>
						<form action = "<?php echo e(route('clients.rendezvous', [$cmpt])); ?>" method="post" class="">
							<?php echo csrf_field(); ?>
							<?php echo method_field('GET'); ?>
							<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-user"></i> Choisir responsable</button>
						</form>
					</td>
					<td><?php echo e(substr($cmpt->_id,3,-16)); ?></td>
					<td><?php echo e($cmpt->societe2); ?></td>
					<td><?php echo e($cmpt->nom); ?></td>
					<!-- <td></td> -->
					<!-- <td><?php echo e($cmpt->telephone); ?></td> -->
					<!-- <td><?php echo e($cmpt->email); ?></td> -->
					<td><?php echo e($cmpt->statut); ?></td>
					<!-- <td><?php echo e($cmpt->note); ?></td> -->
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

				</tbody>

			</table>
		</div>

	</div>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projet freelance\crm1\resources\views/rdvs/ajoutrdv.blade.php ENDPATH**/ ?>