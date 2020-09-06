<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Support client'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('staffs.index')); ?>"><i class="fa fa-dashboard"></i> Support client</a></li>
	<li class="active">Liste ticket</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
		<div >
		  <?php if(session()->get('error')): ?>
			<div class="message alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> Erreur</h4>
				<?php echo e(session()->get('error')); ?>

			</div>
		  <?php endif; ?>
		</div>
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
						<tr class="<?php if($sup->repondu <> 'Oui'): ?> bold <?php endif; ?>" >
							<td class="mailbox-name col-md-4">
								<a href="<?php echo e(route('supports.repondreticket',$sup->user_id)); ?>">
									<div><?php echo e($sup->prenomE); ?> <?php echo e($sup->nomE); ?></div>
								<span><i><?php echo e($sup->statutE); ?></i></span>
								</a>
							</td>
							<td class="mailbox-subject overflow col-md-6">
								<a href="<?php echo e(route('supports.repondreticket',$sup->user_id)); ?>">
									<?php echo e($sup->message); ?>

								</a>
							</td>
							<td class="mailbox-date col-md-2">
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