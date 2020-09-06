<?php $__env->startSection('htmlheader_title'); ?>
    <?php echo e(trans('adminlte_lang::message.servererror')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

    <div class="error-page">
        <h2 class="headline text-red">500</h2>
        <div class="error-content">
            <h3 class="text-red"><i class="fa fa-warning text-red"></i> <b>CRM MÉTIER ERREUR!</b> <br/></h3>
            <h3><i class="text-red"></i> <b><?php echo e(trans('adminlte_lang::message.somethingwrong')); ?>.</h3>
            <p>
                <?php echo e(trans('adminlte_lang::message.wewillwork')); ?>

                <?php echo e(trans('adminlte_lang::message.mainwhile')); ?> <a href='<?php echo e(url('/home')); ?>'><?php echo e(trans('adminlte_lang::message.returndashboard')); ?></a> ou contacter l'administrateur.
            </p>
            <!-- <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="<?php echo e(trans('adminlte_lang::message.search')); ?>"/>
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form> -->
        </div>
    </div><!-- /.error-page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/errors/500.blade.php ENDPATH**/ ?>