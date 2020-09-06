<!DOCTYPE html>
<html lang="fr">
	<?php $__env->startSection('htmlheader'); ?>
		<?php echo $__env->make('layouts.partials.htmlheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->yieldSection(); ?>
	<body class="hold-transition skin-black-light layout-top-nav">
		<div id="app" v-cloak>
			<div class="wrapper">
				<div class="content-wrapper">
					<section class="content">
						<?php echo $__env->yieldContent('main-content'); ?>
					</section>
				</div>
				<?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
		<?php $__env->startSection('scripts'); ?>
			<?php echo $__env->make('layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->yieldSection(); ?>
	</body>
</html>
<?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/layouts/cal2.blade.php ENDPATH**/ ?>