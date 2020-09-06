<?php $__env->startSection('content'); ?>


	<body class="hold-transition register-page" style="background-image: url(<?php echo e(asset('/img/bg-home.png')); ?>);">
	
    <div id="app" v-cloak>
		<!--
        <div class="register-box">
            <div class="register-logo">
                <a href="<?php echo e(url('/home')); ?>"><b>Inscription</b></a>
            </div>

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> <?php echo e(trans('message.someproblems')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="register-box-body">
                <register-form></register-form>

                <a href="<?php echo e(url('/login')); ?>" class="text-center"><?php echo e(trans('message.membership')); ?></a>
            </div>
        </div>
		-->
		
        <div class="register-box">
            <div class="register-logo">
                <a href="<?php echo e(url('/home')); ?>"><b>Inscription</b></a>
            </div>

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> <?php echo e(trans('message.someproblems')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="register-box-body">
                <form action="<?php echo e(url('/register')); ?>" method="post">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="form-group has-feedback">
						<select class="form-control selecttype" name="statut" style="width: 100%;">
							<option selected="selected">Administrateur</option>
							<!-- <option>Gestionnaire</option>
							<option>Professeur</option>
							<option>Etudiant</option> -->
						</select>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" value="<?php echo e(old('nom')); ?>" autofocus/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" autofocus/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="<?php echo e(trans('message.email')); ?>" name="email" value="<?php echo e(old('email')); ?>"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo e(trans('message.password')); ?>" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="<?php echo e(trans('message.retypepassword')); ?>" name="password_confirmation"/>
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
					<div class="row register">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
									<input type="checkbox" name="terms"> Accepter les <a href="#"  data-toggle="modal" data-target="#termsModal">conditions d'utilisation</a>
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo e(trans('message.register')); ?></button>
						</div>
						<!-- /.col -->
					</div>
                </form>

                <a href="<?php echo e(url('/login')); ?>" class="text-center"><?php echo e(trans('message.membership')); ?></a>
                    </div>
            </div>
	</div>

    <?php echo $__env->make('layouts.partials.scripts_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('auth.terms', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/auth/inscription.blade.php ENDPATH**/ ?>