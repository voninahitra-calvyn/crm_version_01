<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Compte client'); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('clients.index')); ?>"><i class="fa fa-dashboard"></i> Client</a></li>
	<li><a href="<?php echo e(route('clients.compte', [$client])); ?>">Compte</a></li>
	<li class="active">Modification</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification compte</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?php echo e(route('clients.updatecompte', [$compte])); ?>">
				<input type="hidden" name="_method" value="GET">
                 
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
				<input type="text" class="form-control hidden" name="campagne" id="campagne" value="<?php echo e($campagne); ?>" >
				<div class="box-body">
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">ID : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="<?php echo e(substr($compte->_id,3,-16)); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo e($compte->nom); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo e($compte->prenom); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($compte->telephone); ?>" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($compte->email); ?>">
						</div>
					</div>
					<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>" >
						<label for="password" class="col-sm-2 control-label">Mot de passe : </label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
						</div>
					</div>
					<div class="form-group <?php if(Auth::user()->statut <> 'Administrateur'): ?> hidden <?php endif; ?>">
						<label for="statut" class="col-sm-2 control-label">Statut : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut" style="width: 100%;">
								<option value="Responsable" <?php echo e(( $compte->statut == 'Responsable') ? 'selected' : ''); ?>>Responsable</option>
								<option value="Commercial" <?php echo e(( $compte->statut == 'Commercial') ? 'selected' : ''); ?>>Commercial</option>
							</select>
						</div>
					</div>

					<?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">
									<?php echo e($day->name); ?>

									<button type="button" id="" class="btn btn-info btn-xs pull-right add_plage">Ajouter une plage horaire</button>
								</h3>
							</div>
							<div class="panel-body">
								
									<div class="ligne">
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="" class="col-sm-4 control-label">Heure de début :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="}" id ="" type="text" value="">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="" class="col-sm-4 control-label">Heure de fin :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="" id ="" type="text" value="">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-danger">Supprimer</button>
											</div>
										</div>
									</div>
								<div class="ligne">
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="" class="col-sm-4 control-label">Heure de début :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="}" id ="" type="text" value="">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="" class="col-sm-4 control-label">Heure de fin :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="" id ="" type="text" value="">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-danger">Supprimer</button>
											</div>
										</div>
									</div>
								
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Agenda public : </label>
						<div class="col-sm-10 control-txt">
						  <a href="<?php echo e(url('/comresp_public')); ?>/<?php echo e($compte->_id); ?>" target="_blank" ><?php echo e(url('/comresp_public')); ?>/<?php echo e($compte->_id); ?></a>
						  <!-- / <a href="<?php echo e(url('/agendacomresp_public')); ?>/<?php echo e($compte->_id); ?>">Cliquer ici pour télécharger fichier INC</a> --> 
						  <!-- <a href="<?php echo e(url('/agendacomresp_public')); ?>/<?php echo e($compte->_id); ?>" target="_blank" ><?php echo e(url('/comresp_public')); ?>/<?php echo e($compte->_id); ?></a> -->
						  <!-- <a href="<?php echo e(asset('/uploads/agenda')); ?>/<?php echo e($compte->_id); ?>.inc" target="_blank" ><?php echo e($compte->_id); ?>.inc</a> -->
						</div>
					</div>
					<div class="form-group">
						<label for="agendapriv" class="col-sm-2 control-label">Ajouter son agenda : </label>
						<div class="col-sm-10">
							<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="<?php echo e($compte->agendapriv); ?>">
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="note" class="col-sm-2 control-label">Agenda public: </label>
						<div class="col-sm-10 control-txt">
						  <a href="<?php echo e(url('/comresp_public')); ?>/<?php echo e($compte->_id); ?>" target="_blank" ><?php echo e(url('/comresp_public')); ?>/<?php echo e($compte->_id); ?></a>
						</div>
					</div>
					<div class="form-group">
						<label for="agendapriv" class="col-sm-2 control-label">Agenda privé: </label>
						<div class="col-sm-10">
							<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="<?php echo e($compte->agendapriv); ?>">
						</div>
					</div> -->
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($compte->note); ?></textarea>
						</div>
					</div>
					<?php if(Auth::user()->statut == 'Administrateur'): ?>
						<div class="form-group">
							<label for="etat" class="col-sm-2 control-label">Etat : </label>
							<div class="col-sm-10">
								<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
									<?php if(isset($client->etat)): ?>
										<option value="Actif" <?php echo e($client->etat=="Actif"?'selected':''); ?>>Activé</option>
										<option value="Inactif" <?php echo e($client->etat=="Inactif"?'selected':''); ?>>Désactivé</option>
									<?php else: ?>
										<option value="Actif">Activé</option>
										<option value="Inactif">Désactivé</option>
									<?php endif; ?>
								</select>
							</div>
						</div>
					<?php endif; ?>

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

<?php $__env->startSection('scripts'); ?>
	<script src="<?php echo e(asset ('/js/jquery/jquery.min.js')); ?>"></script>
	<script>

        $(function () {
            // Initialisation des DateTimePicker
            //Timepicker
            $('.heure_plage').timepicker({
                showMeridian: false,
                showInputs: false
            })

            // Initialisation index pour étiquettes
            var index = <?php echo e($index); ?>;

            // Suppression d'une ligne de réponse (utilisation de "on" pour gérer les boutons créés dynamiquement)
            $(document).on('click', '.btn-danger', function(){
                $(this).parents('.ligne').remove();
            });

            // Ajout d'une ligne de plage horaire
            $('.add_plage').click(function() {
                var html = '<div class="ligne">\n'
                    + '<div class="row form-group">\n'
                    + '<div class="col-sm-10">\n'
                    + '<label for="start' + index++ + '" class="col-sm-4 control-label">Heure de début :</label>\n'
                    + '<div class="col-sm-8 input-group date">\n'
                    + '<input class="form-control" name="start[' + $(this).attr("id") + '][]" id ="' + index++ + '" type="text">\n'
                    + '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>\n'
                    + '</div></div></div>\n'
                    + '<div class="row form-group">\n'
                    + '<div class="col-sm-10">\n'
                    + '<label for="end' + index++ + '" class="col-sm-4 control-label">Heure de fin :</label>\n'
                    + '<div class="col-sm-8 input-group date">\n'
                    + '<input class="form-control" name="end[' + $(this).attr("id") + '][]" id ="' + index++ + '" type="text">\n'
                    + '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>\n'
                    + '</div></div>\n'
                    + '<div class="col-sm-2"><button type="button" class="btn btn-danger">Supprimer</button></div></div>\n'
                    + '</div>\n';
                $(this).parents('.panel').find('.panel-body').append(html);
                $('.date').datetimepicker({ locale: 'fr', format: 'LT' });
            });

            // Soumission
            $(document).on('submit', 'form', function(e) {
                e.preventDefault();
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json"
                })
                    .done(function(data) {
                        window.location.href = '<?php echo url('restaurant'); ?>';
                    })
                    .fail(function(data) {
                        var obj = data.responseJSON;
                        // Nettoyage préliminaire
                        $('.help-block').text('');
                        $('.form-group').removeClass('has-error');
                        $('.alert').addClass('hidden');
                        // Balayage de l'objet
                        $.each(data.responseJSON, function (key, value) {
                            // Traitement du nom
                            if(key == 'name') {
                                $('.help-block').eq(0).text(value);
                                $('.form-group').eq(0).addClass('has-error');
                            }
                            // Traitement des erreurs des plages horaires
                            else {
                                $('.alert').removeClass('hidden');
                            }
                        });
                    });
            });
        });
	</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\crm1\resources\views/clients/compte/edit.blade.php ENDPATH**/ ?>