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
		<!-- Support: <?php echo $support; ?><br/> -->

		<?php $__currentLoopData = $support; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($sup->support_id==null): ?>
				<div class="direct-chat-msg">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-left"><?php echo e($sup->prenom); ?> <?php echo e($sup->nom); ?></span>
						<span class="direct-chat-timestamp pull-right"><?php echo e(date('d M Y H:i', strtotime($sup->created_at." +1 hours"))); ?> </span>

					</div>
					<?php if($user->img==''): ?>
						<img class="direct-chat-img" src="<?php echo e(asset('/img/avatar.png')); ?>" alt="User Image"/>
					<?php else: ?>
						<img class="direct-chat-img" src="<?php echo e(URL::to('/')); ?>/img/utilisateurs/<?php echo e($profil->img); ?>" alt="User Image"/>
					<?php endif; ?>
					<div class="direct-chat-text">
						<?php echo e($sup->message); ?>

						<span class="username  pull-right">
						  <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
							<form action="<?php echo e(route('supports.destroy', $sup->id)); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('DELETE'); ?>
								<button class="pull-right btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
							</form>
						  
						</span>
					</div>
				</div>
			<?php else: ?>
				<div class="direct-chat-msg right">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right"><?php echo e($sup->prenom); ?> <?php echo e($sup->nom); ?></span>
						<span class="direct-chat-timestamp pull-left"><?php echo e(date('d M Y H:i', strtotime($sup->created_at." +1 hours"))); ?></span>
					</div>
					<?php if($user->img==''): ?>
						<img class="direct-chat-img" src="<?php echo e(asset('/img/avatar2.png')); ?>" alt="User Image"/>
					<?php else: ?>
						<img class="direct-chat-img" src="<?php echo e(URL::to('/')); ?>/img/utilisateurs/<?php echo e($profil->img); ?>" alt="User Image"/>
					<?php endif; ?>
					<div class="direct-chat-text">
						<?php echo e($sup->message); ?>

						<span class="username  pull-right">
						  <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
							<form action="<?php echo e(route('supports.destroy', $sup->id)); ?>" method="post" class="">
								<?php echo csrf_field(); ?>
								<?php echo method_field('DELETE'); ?>
								<button class="pull-right admin btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
							</form>
						  
						</span>
					</div>
				</div>
			<?php endif; ?>	
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<form class="form-horizontal" method="POST" action="<?php echo e(route('supports.store')); ?>" <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?>hidden <?php endif; ?>>
			<?php echo csrf_field(); ?>

				<div class="input-group">
					<input type="text" name="nom" id="nom" value="<?php echo e(Auth::user()->nom); ?>" hidden>
					<input type="text" name="prenom" id="prenom" value="<?php echo e(Auth::user()->prenom); ?>" hidden>
					<input type="text" name="user_id" id="user_id" value="<?php echo e($sup->user_id); ?>" hidden>
					<input type="text" name="support_id" id="support_id" value="<?php echo e($sup->_id); ?>" hidden>
					<input type="text" name="statut" id="statut" value="<?php echo e(Auth::user()->statut); ?>" hidden>
					<input type="text" name="message" id="message" placeholder="Tapez le message ..." class="form-control">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-danger btn-flat">Répondre</button>
					</span>
				</div>
			</form>
	</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\Ohmycrm\resources\views/supports/repondreticket.blade.php ENDPATH**/ ?>