<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte centre d\'appels'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('centreappels.index')); ?>"><i class="fa fa-dashboard"></i> Centre d'appels <?php echo e($centreappel->societe); ?></a></li>
	<li class="active">Comptes</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
					<div class="info-box-header">
						<div class="lsp-widget_head">
							<div class="lsp-subheader_main">
								<!-- <form action="#" method="get" class="">
									<div class="input-group">
										<input type="text" name="q" class="form-control" placeholder="Recherche...">
										<span class="input-group-btn">
											<button type="submit" name="search" id="search-btn" class="btn btn-danger"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</form>  --> 
							</div>		
						   
							<div class="lsp-headerwidget_action">     
								<form action = "<?php echo e(route('centreappels.createcompte', [$centreappel])); ?>" method="post" class="">
									<?php echo csrf_field(); ?>
									<?php echo method_field('GET'); ?>
									<button class="btn btn-success btn-sm" type="submit">Ajouter comptes</button>
								</form>								
							</div>        
						</div>
					</div>
    <!-- Main content -->
    <section class="content">
		<div class="box-body no-padding">
			<div class="box-body table-responsive no-padding">
				<table id="tablecentreappelcompte" class="table table-hover table-striped">
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
					</tr>
					</thead>
					<tbody>
					<?php $__currentLoopData = $comptes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $compte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
							<form action = "<?php echo e(route('centreappels.modifcompte', [$compte])); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('GET'); ?>
								<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
							</form>
						</td>
						<td>
							<form  action = "<?php echo e(route('centreappels.suppcompte', [$compte])); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('GET'); ?>
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
							</form> 
						</td>
						<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
						<td><a href="#"><?php echo e(substr($compte->_id,3,-16)); ?></a></td>
						<?php endif; ?>
						<td><a href="#"><?php echo e($compte->nom); ?></a></td>
						<td><?php echo e($compte->prenom); ?></td>
						<td><?php echo e($compte->telephone); ?></td>
						<td><?php echo e($compte->email); ?></td>
						<td><?php echo e($compte->statut); ?></td>
						<td><?php echo e($compte->note); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
					</tbody>
				</table>
			</div>
		</div>
	
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/centreappels/compte/index.blade.php ENDPATH**/ ?>