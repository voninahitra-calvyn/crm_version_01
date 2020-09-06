<?php $__env->startSection('style'); ?>
<!-- 
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('htmlheader_title'); ?>
<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Agenda'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
<li class="active"><a href="<?php echo e(route('agendas.index')); ?>"><i class="fa fa-dashboard"></i> Agenda</a></li>
<li class="active">Rendez-vous</li>
<?php $__env->stopSection(true); ?>

<?php $__env->startSection('main-content'); ?>
				<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->statut); ?>" name="user_statut" id="user_statut">
<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border rouge">
                <h4 class="box-title">Type rendez-vous</h4>
            </div>
            <div class="box-body">
                <!-- the events -->
                <div id="external-events">
                    <!-- <div class="external-event bg-aqua">Rendez-vous brut</div> -->
                    <div class="external-event bg-light-gray">Rendez-vous envoyé</div>
                    <!-- <div class="external-event bg-yellow">Rendez-vous refusé</div> -->
                    <div class="external-event bg-green">Rendez-vous confirmé</div>
                    <div class="external-event bg-red">Rendez-vous annulé</div>
                    <div class="external-event bg-light-blue">Rendez-vous en attente</div>
                    <div class="external-event bg-green-active">Rendez-vous validé</div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
</div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-danger">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
			
			<script>

			</script>
			
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

	<button type="button" class="btn modal btn-success hidden" data-toggle="modal" data-target="#ajoutagendaModal">
		Ajout 
	</button>
	<div class="modal fade ajoutagendaModal" id="ajoutagendaModal"  name="ajoutagendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="<?php echo e(route('agendas.store')); ?>">
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

					<div class="modal-header">
						<button type="button" class="close modal1 hidden" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Saisi plage d'horaire indisponible </h4>
					</div>
					<div class="modal-body">
						<b>Date début:</b>
						<br />
						<input type="text" class="form-control" name="date_debutdh" id="date_debutdh">

						<br />
						<b>Date fin:</b>
						<br />
						<input type="text" class="form-control" name="date_findh" id="date_findh">

						<br />
						<b>Titre:</b>
						<br />
						<input type="text" class="form-control" name="titredh" id="titredh">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn annuler_dh btn-default" id="annuler_dh" data-dismiss="modal">Annuler</button>
						<input type="submit" class="btn valider_dh btn-primary" id="valider_dh" value="Valider">
					</div>
				</form>
			</div>
		</div>
	</div>

        <div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Success Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/agendas/index.blade.php ENDPATH**/ ?>