<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Tableau de bord principal'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('home.index')); ?>"><i class="fa fa-dashboard"></i> Tableau de bord principal</a></li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>

    <div class="accueil-page">
        <h3 class="headline text-red">Bonjour <?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>!</h3>
    </div><!-- /.error-page -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/home/index.blade.php ENDPATH**/ ?>