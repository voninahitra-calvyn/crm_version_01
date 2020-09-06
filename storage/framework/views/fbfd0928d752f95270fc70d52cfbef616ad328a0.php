<?php $__env->startSection('htmlheader_title'); ?>
    Password recovery
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<body class="login-page">
    <div id="app">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>Réinitialiser mot de passe</b></a>
			</div>
			<div class="login-box-body">
				<form action="<?php echo e(url(config('adminlte.password_reset_url', 'password/reset'))); ?>" method="post">
					<?php echo csrf_field(); ?>


					<input type="hidden" name="token" value="<?php echo e($token); ?>">

					<div class="form-group has-feedback <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
						<input type="email" name="email" class="form-control" value="<?php echo e(isset($email) ? $email : old('email')); ?>"
							   placeholder="Email">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						<?php if($errors->has('email')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('email')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
					<div class="form-group has-feedback <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
						<input type="password" name="password" class="form-control"
							   placeholder="Nouveau mot de passe">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						<?php if($errors->has('password')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('password')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
					<div class="form-group has-feedback <?php echo e($errors->has('password_confirmation') ? 'has-error' : ''); ?>">
						<input type="password" name="password_confirmation" class="form-control"
							   placeholder="Confirmation mot de passe">
						<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
						<?php if($errors->has('password_confirmation')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('password_confirmation')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
					<button type="submit"
							class="btn btn-primary btn-block btn-flat"
					>Valider réinitialisation mot de passe</button>
				</form>
			</div>
			<!-- /.login-box-body -->
		</div><!-- /.login-box -->
    </div><!-- /.app -->
</body>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>