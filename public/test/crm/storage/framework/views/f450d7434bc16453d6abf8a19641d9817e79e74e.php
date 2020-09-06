<?php $__env->startSection('main-content'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-danger">
				<div class="box-body no-padding">
					<div id="calendar3"></div>
				</div>
			</div>
			<button onclick="authenticate()" id="connect-button" class="btn btn-info"><i class="fa fa-calendar-check-o"></i> Se connecter</button>
			<!-- <button onclick="authenticate().then(loadClient)">Se connecter</button> -->
			&nbsp;&nbsp;<button onclick="loadClient().then(execute)" id="ajout-button" class="btn btn-success" style="display: none;"><i class="fa fa-calendar-plus-o"></i> Ajouter ces rendez-vous à votre agenda</button>
			<!-- <button onclick="authenticate().then(execute)">Exécuter3</button> -->
			<!-- <button onclick="execute()">Exécuter4</button> -->
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.cal2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/agendas/index3.blade.php ENDPATH**/ ?>