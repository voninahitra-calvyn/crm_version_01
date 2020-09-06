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
		
		<!--     
			<div class="box box-solid">
				<div class="box-header with-border rouge">
					<h4 class="box-title">Type rendez-vous</h4>
				</div>
				<div class="box-body ">
					<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
					<div id="filters">
					  <form class="filtreagendaform">
						<div class="form-group hidden">
							<label for="searchTerm" class="col-sm-12 control-label">Recherche : </label>
							<div class="col-sm-12">
							  <input type="text" class="form-control searchTerm" name="searchTerm" id="searchTerm" placeholder="Recherche..." >
							</div>
						</div>
						<div class="form-group client">
							<label for="searchTerm" class="col-sm-12 control-label rouge">Client : </label>
							<div class="col-sm-12">
							<select class="form-control select2 filteragenda" name="clientrdv" id="clientrdv" style="width: 100%;" >
								<option value="all">Tous</option>
								<?php $__currentLoopData = $comptesclient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?>"><?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							</div>
						</div>
					  </form>
					</div>
					<?php else: ?>
					  <input type="text" class="form-control hidden" name="searchTerm" id="searchTerm">
					  <input type="text" value="<?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>" class="form-control hidden" name="clientrdv" id="clientrdv">
					<?php endif; ?>
					<div id="external-events">
						<div class="external-event bg-light-gray">Rendez-vous envoyé</div>
						<div class="external-event bg-green">Rendez-vous confirmé</div>
						<div class="external-event bg-red">Rendez-vous annulé</div>
						<div class="external-event bg-light-blue">Rendez-vous en attente</div>
						<div class="external-event bg-green-active">Rendez-vous validé</div>
					</div>
				</div>
			</div>
		-->
			
			<div class="box box-solid">
				<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
					<div class="box-header with-border rouge">
						<h4 class="box-title">Filtre</h4>
					</div>
					<div class="box-body filtre2">
					<div id="filters">
					  <form class="">
						<div class="form-group hidden">
							<label for="searchTerm" class="col-sm-12 control-label">Recherche : </label>
							<div class="col-sm-12">
							  <input type="text" class="form-control searchTerm" name="searchTerm" id="searchTerm" placeholder="Recherche..." >
							</div>
						</div>
						<div class="form-group client">
							<label for="filteragenda" class="col-sm-12 control-label">Client : </label>
							<div class="col-sm-12">
							<select class="form-control select2 filteragenda" name="clientrdv" id="clientrdv" style="width: 100%;" >
								<option value="all">Tous</option>
								<?php $__currentLoopData = $comptesclient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
										<option value="<?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?>"><?php echo e($cli->nom); ?></option>
									<?php else: ?>
										<option value="<?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?>"><?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?></option>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							</div>
						</div> 
						<div class="form-group client hidden">
							<label for="filterdisponibiliteagenda" class="col-sm-12 control-label">Disponibilité : </label>
							<div class="col-sm-12">
							<select class="form-control select2 filterdisponibiliteagenda" name="disponibiliterdv" id="disponibiliterdv" style="width: 100%;" >
								<option class="filterdisponibilite" value="disponible">Tous</option>
								<option  class="filterdisponibilite" value="#f39c12">Indisponible</option>
							</select>
							</div>
						</div>
					  </form>
					</div><!--- filters --->

				</div>
					<?php else: ?>
					  <input type="text" class="form-control hidden" name="searchTerm" id="searchTerm">
					  <input type="text" value="<?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>" class="form-control hidden" name="clientrdv" id="clientrdv">
					<?php endif; ?>
				<!-- /.box-body -->
			</div>

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
						<div class="external-event bg-yellow">Indisponible</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>

		</div>
		<!-- /.col -->
    <div class="col-md-9">
        <div class="box box-danger">
            <div class="box-body no-padding">
                <div id="calendar"></div>
            </div>
            <div class="box-footer no-padding">
				<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
					<!-- <b>Lien partageable public :</b> <a href="<?php echo e(route('agendas.agenda2', Auth::user()->_id)); ?>" target="_blank" ><?php echo e(url('/admnstaff')); ?>/<?php echo e(Auth::user()->_id); ?></a> -->
				<?php elseif(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
					<!-- <b>Lien pour ajouter ces rendez-vous à votre agenda :</b> <a href="<?php echo e(route('agendas.agenda3', Auth::user()->_id)); ?>" target="_blank" ><?php echo e(url('/comresp')); ?>/<?php echo e(Auth::user()->_id); ?></a> -->
					<!-- <b>Lien partageable public :</b> <a href="<?php echo e(route('agendas.comresp_public', Auth::user()->_id)); ?>" target="_blank" ><?php echo e(url('/comresp_public')); ?>/<?php echo e(Auth::user()->_id); ?></a> -->
				<?php endif; ?>
			</div>
			
			<script>

			</script>
			
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

	<button type="button" class="btn modal btn-success ajoutagendaModal hidden" data-toggle="modal" data-target="#ajoutagendaModal">
		Ajout 
	</button>

	<button type="button" class="btn modal btn-primary modifagendaModal hidden" data-toggle="modal" data-target="#modifagendaModal">
		Modif 
	</button>

	<button type="button" class="btn modal btn-primary detailagendaModal hidden" data-toggle="modal" data-target="#detailagendaModal">
		Détails 
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

					<div class="modal-header box-header with-border rouge">
						<button type="button" class="close modal1 hidden" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Saisie plage d'horaire indisponible </h4>
					</div>
					<div class="modal-body">
						<?php if(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
						<b>Client:</b>
						<br />
						<select class="form-control select2 filteragenda" name="client_priv" id="client_priv" style="width: 100%;" >
							<?php $__currentLoopData = $comptesclient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?>"><?php echo e($cli->prenom); ?> <?php echo e($cli->nom); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<?php else: ?>
						  <input type="text" class="form-control hidden" name="searchTerm" id="searchTerm">
						  <input type="text" value="<?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>" class="form-control hidden" name="client_priv" id="client_priv">
						<?php endif; ?>

						<br />
						<br />
						<b>Date début:</b>
						<br />
						<input type="text" class="form-control" name="date_debutdh" id="date_debutdh">

						<br />
						<b>Date fin:</b>
						<br />
						<input type="text" class="form-control " name="date_findh" id="date_findh">

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

	<div class="modal fade modifagendaModal" id="modifagendaModal"  name="modifagendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

					<div class="modal-header box-header with-border rouge">
						<button type="button" class="close modal1 hidden" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Modification plage d'horaire indisponible </h4>
					</div>
					<div class="modal-body">
						<b>Date début:</b>
						<br />
						<input type="text" class="form-control" name="date_debutdhM" id="date_debutdhM">

						<br />
						<b>Date fin:</b>
						<br />
						<input type="text" class="form-control" name="date_findhM" id="date_findhM">

						<br />
						<b>Titre:</b>
						<br />
						<input type="text" class="form-control" name="titredhM" id="titredhM">
						<input type="text" class="form-control hidden" name="iddhM" id="iddhM">
						<!-- <textarea class="form-control" rows="3" name="titredhM" id="titredhM"></textarea> -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn annuler_dh btn-default" id="annuler_dh" data-dismiss="modal">Annuler</button>
						<input type="submit" class="btn valider_dh btn-primary" id="valider_dh" value="Modifier">
					</div>
				</form>							

			</div>
		</div>
	</div>


	<div class="modal fade detailagendaModal" id="detailagendaModal"  name="detailagendaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
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

				<div class="modal-header box-header with-border rouge">
					<button type="button" class="close modal1 blanc" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Détails agenda </h4>
				</div>
				<div class="modal-body">
					<b>Titre:</b>
					<div name="titre_details" id="titre_details"></div>
					<b>Date:</b>
					<div name="date_details" id="date_details"></div>
					<b>Heure:</b>
					<div name="heure_details" id="heure_details"></div>
					<b class="detailsrdv">Adresse:</b>
					<div class="detailsrdv" name="adresse_details" id="adresse_details"></div>
					<b class="detailsrdv">Note:</b>
					<div class="detailsrdv" name="note_details" id="note_details"></div>

					<!-- <br /> -->
					<!-- <b>Titre:</b> -->
					<!-- <br /> -->
					<!-- <input type="text" class="form-control" name="titredhD" id="titredhD"> -->
					<!-- <textarea class="form-control" rows="3" name="titredhD" id="titredhD"></textarea> -->
					<!-- <div name="titredhD" id="titredhD"></div> -->
				</div>
				<form action = "<?php echo e(route('agendas.suppEvent', ['fakeid'])); ?>" method="post" class="">
					<?php echo csrf_field(); ?>
					<?php echo method_field('GET'); ?>
					<div class="modal-footer">
						<button type="button" class="btn annuler_dh btn-default" id="annuler_dh" data-dismiss="modal">Fermer</button>
						<input type="text" class="form-control hidden" name="id_details" id="id_details">
						<button type="submit" class="btn supprimer_details btn-danger" id="supprimer_details">Supprimer</button>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/agendas/index.blade.php ENDPATH**/ ?>