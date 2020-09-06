<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte client'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('clients.index')); ?>"><i class="fa fa-dashboard"></i> Client</a></li>
	<li class="active">Modification</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification centre d'appel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo e(route('clients.update', [$client])); ?>">
				<input type="hidden" name="_method" value="PUT">
                 
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
				
				<?php echo e(csrf_field()); ?>

                <!--
				<?php if($errors->any()): ?>
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
                <?php endif; ?>
				-->
				<div class="box-body">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#condidentielles" data-toggle="tab">Informations condidentielles</a></li>
							<li><a href="#publiques" data-toggle="tab">informations publiques</a></li>
						</ul>
						<div class="tab-content">
							<div class="active tab-pane" id="condidentielles">
								<div class="form-group">
									<label for="nom" class="col-sm-2 control-label">ID : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="<?php echo e(substr($client->_id,3,-16)); ?>" disabled>
									</div>
								</div>
								<div class="form-group">
									<label for="societe" class="col-sm-2 control-label">Société : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="<?php echo e($client->societe); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?php echo e($client->adresse); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="cp" class="col-sm-2 control-label">Cp : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="cp" id="cp" placeholder="Cp" value="<?php echo e($client->cp); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="ville" class="col-sm-2 control-label">Ville : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo e($client->ville); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="pays" class="col-sm-2 control-label">Pays : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays" value="<?php echo e($client->pays); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($client->telephone); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($client->email); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="service" class="col-sm-2 control-label">Service : </label>
									<div class="col-sm-10">
										<select class="form-control select2" multiple="multiple" name="service[]" id="service" style="width: 100%;" required>
											<option value="Nettoyage pro" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Nettoyage pro') ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>Nettoyage pro</option>
											<option value="Assurance pro" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Assurance pro') ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>Assurance pro</option>
											<option value="Mutuelle santé sénior" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Mutuelle santé sénior') ? 'selected' : ''); ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> >Mutuelle santé sénior</option>
											<option value="Défiscalisation" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Défiscalisation') ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>Défiscalisation</option>
											<option value="Autres" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Autres') ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>Autres</option>
											<option value="Réception d'appels" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Réception d\'appels') ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>Réception d'appels</option>
											<option value="Demande de devis" <?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e(( $service == 'Demande de devis') ? 'selected' : ''); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>>Demande de devis</option>
										</select>
										<!-- <select class="form-control select2" multiple="multiple" name="service[]" id="service" style="width: 100%;">
											<option value="Nettoyage pro" <?php echo e(( $client->service == 'Nettoyage pro') ? 'selected' : ''); ?>>Nettoyage pro</option>
											<option value="Assurance pro" <?php echo e(( $client->service == 'Assurance pro') ? 'selected' : ''); ?> >Assurance pro</option>
											<option value="Mutuelle santé sénior" <?php echo e(( $client->service == 'Mutuelle santé sénior') ? 'selected' : ''); ?> >Mutuelle santé sénior</option>
											<option value="Défiscalisation"  <?php echo e(( $client->service == 'Défiscalisation') ? 'selected' : ''); ?> >Défiscalisation</option>
											<option value="Autres" <?php echo e(( $client->service == 'Autres') ? 'selected' : ''); ?> >Autres</option>
										</select> -->
									</div>
								</div>
					
							</div>
							<div class="active tab-pane" id="publiques">
								<div class="form-group">
									<label for="societe2" class="col-sm-2 control-label">Société : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="societe2" id="societe2" placeholder="Société" value="<?php echo e($client->societe2); ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="note" class="col-sm-2 control-label">Note : </label>
									<div class="col-sm-10">
									  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($client->note); ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					


					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-primary pull-right">Valider</button>
						</div>
					</div>
					
				</div>
			</form>
	
		</div>      
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/clients/edit.blade.php ENDPATH**/ ?>