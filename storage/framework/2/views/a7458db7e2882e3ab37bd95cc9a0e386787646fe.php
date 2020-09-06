<?php $__env->startSection('htmlheader_title'); ?>
    Log in
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!--<body class="hold-transition login-page" style="background-image: url(https://www.littlebigconnection.com/images/global/bg-home.jpg);">-->
	<!-- <body class="hold-transition login-page" style="background-image: url(<?php echo e(asset('/img/bg-home.jpg')); ?>);"> -->
	<body class="hold-transition login-page">
		<div id="app" v-cloak>
			<div class="login-box">
				<div class="login-logo">
					<a href="<?php echo e(url('/home')); ?>"><b>Connexion</b></a>
				</div><!-- /.login-logo -->

			<?php if(count($errors) > 0): ?>
				<div class="alert alert-danger">
					<strong>Whoops!</strong> <?php echo e(trans('adminlte_lang::message.someproblems')); ?><br><br>
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			<?php endif; ?>

			<div class="login-box-body">
				<form action="<?php echo e(url('/login')); ?>" method="post">
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
					<div class="form-group has-feedback">
						<!-- <input type="email" class="form-control" placeholder="<?php echo e(trans('adminlte_lang::message.email')); ?>" name="email"/> -->
						<input class="form-control" placeholder="Adresse email" name="email"/>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="<?php echo e(trans('adminlte_lang::message.password')); ?>" name="password"/>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row login">
						<div class="col-xs-6">
							<div class="checkbox icheck">
								<label>
									<input style="" type="checkbox" name="remember"> <?php echo e(trans('adminlte_lang::message.remember')); ?>

								</label>
							</div>
						</div><!-- /.col -->
						<div class="col-xs-6">
							<button type="submit" class="btn btn-danger btn-block btn-flat"><?php echo e(trans('adminlte_lang::message.buttonsign')); ?></button>
						</div><!-- /.col -->
					</div>
				</form>
				
				
				<!-- <a href="<?php echo e(url('/password/reset')); ?>"><?php echo e(trans('adminlte_lang::message.forgotpassword')); ?></a><br> -->
				<!-- <a href="<?php echo e(url('/register')); ?>" class="text-center"><?php echo e(trans('adminlte_lang::message.registermember')); ?></a> -->
			</div>

		</div>
		</div>
		<?php echo $__env->make('layouts.partials.scripts_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
    </body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/auth/connexion.blade.php ENDPATH**/ ?>