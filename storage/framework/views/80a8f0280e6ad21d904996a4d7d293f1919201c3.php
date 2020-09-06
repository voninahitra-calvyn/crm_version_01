<?php $__env->startSection('htmlheader_title'); ?>
    <?php echo e(trans('adminlte_lang::message.pagenotfound')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

    <div class="error-page">
        <h2 class="headline text-yellow"> 405</h2>
        <div class="error-content">
            <h3 class="text-yellow"><i class="fa fa-warning text-yellow"></i> <b>CRM MÉTIER ERREUR!</b> <br/></h3>
            <h3><i class="text-yellow"></i> <b><?php echo e(trans('adminlte_lang::message.pagenotfound')); ?>.</h3>
            <p>
                <?php echo e(trans('adminlte_lang::message.notfindpage')); ?>

                <?php echo e(trans('adminlte_lang::message.mainwhile')); ?> <a href='<?php echo e(url('/home')); ?>'><?php echo e(trans('adminlte_lang::message.returndashboard')); ?></a> 
			</p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/errors/405.blade.php ENDPATH**/ ?>