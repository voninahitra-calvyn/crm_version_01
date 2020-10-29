<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Tableau de bord principal'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li class="active"><a href="<?php echo e(route('home.index')); ?>"><i class="fa fa-dashboard"></i> Tableau de bord principal</a></li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>

    <div class="accueil-page">
        <h3 class="headline text-red">Bonjour <?php echo e(Auth::user()->nom); ?> <span style="text-transform: uppercase"><?php echo e(Auth::user()->prenom); ?> </span>,
			il est <span id="time"></span>.</h3>
    </div>
	<form class="form-horizontal <?php if($_id <> null): ?> hidden <?php endif; ?>" method="POST" action="<?php echo e(route('home.store')); ?>">
	
	
		 
		<?php if($errors->any()): ?>
			<div class="alert alert-danger" role="alert">
				Veuillez s'il vous plait corriger les erreurs suivantes
			</div>
			<div class="alert-danger-liste">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  <li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div><br />
		<?php endif; ?>
		
		
		 

		<?php echo csrf_field(); ?>

		<div class="box-body">
			<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
				<!-- <label for="note1editor" class="col-sm-12 control-label">Note pour superviseur ou agent : </label> -->
				<div class="col-sm-10">
				  <textarea class="form-control" rows="5" name="note1editor" id="note1editor" placeholder="Note pour superviseur ou agent"></textarea>
				</div>
			</div>
			<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
				<!-- <label for="note2editor" class="col-sm-12 control-label">Note pour responsable ou commercial : </label> -->
				<div class="col-sm-10">
				  <textarea class="form-control" rows="5" name="note2editor" id="note2editor" placeholder="Note pour responsable ou commercial"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
					<button type="submit" class="btn btn-success pull-right">Valider</button>
				</div>
			</div>
			
		</div>
	</form>
	
		<div class="box box-danger <?php if(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?> hidden <?php endif; ?>">
			<div class="box-header with-border <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
				<h3 class="box-title form rouge">Note pour superviseur ou agent :</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
					<!-- <label for="note1" class="col-sm-12 control-label <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">Note pour superviseur ou agent : </label> -->
					<div class="col-sm-12"><?php echo $note1; ?></div>
				</div>
			</div>
		</div>
		
		<div class="box box-danger  <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>">
			<div class="box-header with-border <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
				<h3 class="box-title form rouge">Note pour responsable ou commercial :</h3>
			</div>	
			<div class="box-body">	
				<div class="form-group">
					<!-- <label for="note2" class="col-sm-12 control-label <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">Note pour responsable ou commercial : </label> -->
					<div class="col-sm-12"><?php echo $note2; ?></div>
				</div>
			</div>
		</div>
			
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-10">
				<button type="submit" class="btn btn-info pull-left hidden">Modifier1</button>
			</div>
		</div>
		
		<form action = "<?php echo e(route('home.edit', [$_id])); ?>" method="post" class="<?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
			<?php echo csrf_field(); ?>
			<?php echo method_field('GET'); ?>
			<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Modifier</button>
		</form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<script>


        document.write()
        function showTime() {
            var date = new Date();
            var date=new Date()
            var h=date.getHours();
            if (h<10) {h = "0" + h}
            var m=date.getMinutes();
            if (m<10) {m = "0" + m}
            var s=date.getSeconds();
            if (s<10) {s = "0" + s}

            document.getElementById('time').innerHTML = h+":"+m;
        }
        setInterval(showTime, 1000);
	</script>

	<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projet freelance\crm1\resources\views/home/index.blade.php ENDPATH**/ ?>