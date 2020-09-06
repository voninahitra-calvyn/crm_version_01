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
				<form class="form-horizontal <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>" method="POST" action="<?php echo e(route('home.update', $home->_id)); ?>">

				<?php echo csrf_field(); ?>
				<?php echo method_field('PUT'); ?>
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title form rouge">Note pour superviseur ou agent :</h3>
						</div>
						<div class="box-body">
							<div class="form-group ">
								<div class="col-sm-12">
									<textarea class="form-control " rows="5" name="note1editor" id="note1editor" placeholder=""><?php echo e($home->note1); ?></textarea>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-info pull-right">Valider</button>
						</div>
					</div>
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title form rouge">Note pour responsable ou commercial :</h3>
						</div>
						<div class="box-body">
							<div class="form-group ">
								<div class="col-sm-12">
									<textarea class="form-control" rows="5" class="textarea" name="note2editor" id="note2editor" placeholder=""><?php echo e($home->note2); ?></textarea>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-primary pull-right">Valider</button>
						</div>
					</div>
				</form>
				
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/home/edit.blade.php ENDPATH**/ ?>