<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Support client'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Support client</a></li>
	<li class="active">Mon ticket</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<!-- Supports: <?php echo $supports; ?><br/> 
		**************<br/>
		supportsdistinct: <?php echo $supportsdistinct; ?><br/>  -->
		<!-- **************<br/>
		User: <?php echo $user; ?><br/>  -->
		
        <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
                <tbody>
					<?php $__empty_1 = true; $__currentLoopData = $supportsdistinct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<tr class="<?php if($sup->statut <> 'Administrateur' && $sup->statut <> 'Staff'): ?> bold <?php endif; ?>" >
							<td class="mailbox-name">
								<a href="<?php echo e(route('supports.repondreticket',$sup->user_id)); ?>">
									<?php echo e($sup->prenom); ?> <?php echo e($sup->nom); ?>

								</a>
							</td>
							<td class="mailbox-name">
								<a href="<?php echo e(route('supports.repondreticket',$sup->user_id)); ?>">
									<?php echo e($sup->statut); ?>

								</a>
							</td>
							<td class="mailbox-subject overflow">
								<a href="<?php echo e(route('supports.repondreticket',$sup->user_id)); ?>">
									<?php echo e($sup->message); ?>

								</a>
							</td>
							<td class="mailbox-date">
								<a href="<?php echo e(route('supports.repondreticket',$sup->user_id)); ?>">
									<?php echo e(date('d-m-Y H:i', strtotime($sup->created_at." +1 hours"))); ?>

								</a>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						<tr>
							<td class="mailbox-name"><a><b>Pas de ticket pour l'instant</b></a></td>
						</tr>
					<?php endif; ?>
                </tbody>
            </table>
        </div>

	</section>
		
  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/supports/index.blade.php ENDPATH**/ ?>