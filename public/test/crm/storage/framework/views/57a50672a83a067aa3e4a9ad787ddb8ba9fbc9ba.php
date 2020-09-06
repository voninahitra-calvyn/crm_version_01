<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $__env->yieldContent('contentheader_title', 'En-tête de page ici'); ?>
        <small><?php echo $__env->yieldContent('contentheader_description'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <!--<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo e(trans('message.level')); ?></a></li>-->
        <!--<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $__env->yieldContent('contentheader_level'); ?></a></li>-->
        <!--<li><?php echo $__env->yieldContent('contentheader_level2'); ?></li>-->
        <!--<li class="active"><?php echo $__env->yieldContent('contentheader_levelactive'); ?></li>-->
        <?php echo $__env->yieldContent('contentheader_levelactive'); ?>
    </ol>
</section><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\Ohmycrm\resources\views/layouts/partials/contentheader.blade.php ENDPATH**/ ?>