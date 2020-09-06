

<?php $__env->startSection('htmlheader_title'); ?>
<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Détails rendez-vous '); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
<li><a href=""><i class="fa fa-dashboard"></i>Rendez-vous </a></li>
<li class="active">Détails</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
<!-- Main content -->
<section class="content">
    <div class="box box-danger">
        <form class="form-horizontal" method="post" action="<?php echo e(route('rdvs.update', $rdv->id)); ?>" enctype="multipart/form-data">
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

            <?php echo csrf_field(); ?>

            <div class="box-body">
                <!-- <input type="text" class="form-control hidden" value="" name="client_id" id="client_id"> -->
                <!-- <div class="form-group">
                    <label for="cli" class="col-sm-2 control-label">Nom du client : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo e($rdv->client_nompriv); ?> <?php echo e($rdv->client_prenompriv); ?>" name="nomcli" id="nomcli" disabled>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="cli" class="col-sm-2 control-label">Client : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo e($rdv->client_societe); ?>" name="cli" id="cli" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="typerdv" class="col-sm-2 control-label">Service : </label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control"  name="typerdv" id="typerdv" value="" > -->
                        <!-- <textarea class="form-control" rows="1" name="typerdv" id="typerdv" ></textarea> -->
                        <!-- <select class="form-control select2" multiple="multiple" name="typerdv[]" id="typerdv" style="width: 100%;" disabled> -->
                        <select class="form-control select2" name="typerdv" id="typerdv" style="width: 100%;" disabled>
							<?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($service); ?>" <?php echo e(( $rdv->typerdv == $service) ? 'selected' : ''); ?>><?php echo e($service); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <!-- <div class="form-group">
						<label for="statut" class="col-sm-2 control-label">Client : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut" style="width: 100%;">
								<option selected="selected">Administrateur</option>
								<option selected="selected">Staff</option>
							</select>
						</div>
					</div> -->
                <div class="form-group">
                    <label for="statut" class="col-sm-2 control-label">Statut : </label>
                    <div class="col-sm-10">
                        <select class="form-control selecttype" name="statut" id="statut" style="width: 100%;" <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> disabled <?php endif; ?>>
                            <option value="Rendez-vous brut" <?php echo e(( $rdv->statut == "Rendez-vous brut") ? 'selected' : ''); ?>>Rendez-vous brut</option>
                            <option value="Rendez-vous refusé" <?php echo e(( $rdv->statut == "Rendez-vous refusé") ? 'selected' : ''); ?>>Rendez-vous refusé</option>
                            <option value="Rendez-vous envoyé" <?php echo e(( $rdv->statut == "Rendez-vous envoyé") ? 'selected' : ''); ?>>Rendez-vous envoyé</option>
                            <option value="Rendez-vous confirmé" <?php echo e(( $rdv->statut == "Rendez-vous confirmé") ? 'selected' : ''); ?>>Rendez-vous confirmé</option>
                            <option value="Rendez-vous annulé" <?php echo e(( $rdv->statut == "Rendez-vous annulé") ? 'selected' : ''); ?>>Rendez-vous annulé</option>
                            <option value="Rendez-vous en attente" <?php echo e(( $rdv->statut == "Rendez-vous en attente") ? 'selected' : ''); ?>>Rendez-vous en attente</option>
                            <option value="Rendez-vous validé" <?php echo e(( $rdv->statut == "Rendez-vous validé") ? 'selected' : ''); ?>>Rendez-vous validé</option>
                        </select>
                    </div>
                </div>
						<div id="groupnomprenom">
							<div class="form-group">
								<label for="nom" class="col-sm-2 control-label">Nom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo e($rdv->nom); ?>" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo e($rdv->prenom); ?>" disabled>
								</div>
							</div>
						</div>
						<div class="form-group" id="groupsociete">
							<label for="societe" class="col-sm-2 control-label">Société : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="<?php echo e($rdv->societe); ?>"  disabled>
							</div>
						</div>
                <div id="groupautre1">
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?php echo e($rdv->adresse); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Code postal : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="cp" id="cp" placeholder="Code postal" value="<?php echo e($rdv->cp); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo e($rdv->ville); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($rdv->telephone); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="mobile" class="col-sm-2 control-label">Mobile : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo e($rdv->mobile); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($rdv->email); ?>"  disabled>
						</div>
					</div>
				</div>

					<div id="groupquestion">
					<div class="form-group">
						<label for="question_1" class="col-sm-2 control-label">Question 1 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_1" id="question_1" placeholder="Question 1" value="<?php echo e($rdv->question_1); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_2" class="col-sm-2 control-label">Question 2 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_2" id="question_2" placeholder="Question 2" value="<?php echo e($rdv->question_2); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_3" class="col-sm-2 control-label">Question 3 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_3" id="question_1" placeholder="Question 3" value="<?php echo e($rdv->question_3); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_4" class="col-sm-2 control-label">Question 4 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_4" id="question_4" placeholder="Question 4" value="<?php echo e($rdv->question_4); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_5" class="col-sm-2 control-label">Question 5 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_5" id="question_5" placeholder="Question 5" value="<?php echo e($rdv->question_5); ?>" disabled>
						</div>
					</div>
					</div>

					<div id="groupnetoyagepro">
					<div class="form-group">
						<label for="surface_total_societe" class="col-sm-2 control-label">Surface total société : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="surface_total_societe" id="surface_total_societe" placeholder="Surface total société" value="<?php echo e($rdv->surface_total_societe); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="surface_bureau" class="col-sm-2 control-label">Surface de bureau : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="surface_bureau" id="surface_bureau" placeholder="Surface de bureau" value="<?php echo e($rdv->surface_bureau); ?>" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="sous_contrat" class="col-sm-2 control-label">Sous contrat : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="sous_contrat" id="sous_contrat" value="<?php echo e($rdv->sous_contrat); ?>" style="width: 100%;" disabled>
								<option selected="selected">Oui</option>
								<option selected="selected">Non</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="date_anniversaire_contrat" class="col-sm-2 control-label">Date anniversaire du contrat: </label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" name="date_anniversaire_contrat" id="date_anniversaire_contrat" placeholder="dd/mm/yyyy" value="<?php echo e($rdv->date_anniversaire_contrat); ?>" disabled>
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
					</div>

					<div class="form-group" id="groupage">
						<label for="age" class="col-sm-2 control-label">Age : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="age" id="age" placeholder="Age"  disabled value="<?php echo e($rdv->age); ?>">
						</div>
					</div>

					<div id="groupmutuel">
					<div class="form-group">
						<label for="mutuelle_entreprise" class="col-sm-2 control-label">Mutuelle entreprise : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="mutuelle_entreprise" id="mutuelle_entreprise" style="width: 100%;" disabled value="<?php echo e($rdv->mutuelle_entreprise); ?>">
								<option selected="selected">Oui</option>
								<option selected="selected">Non</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nom_mutuelle" class="col-sm-2 control-label">Nom de sa mutuelle : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom_mutuelle" id="nom_mutuelle" placeholder="Nom de sa mutuelle" disabled value="<?php echo e($rdv->nom_mutuelle); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="montant_mutuelle_actuelle" class="col-sm-2 control-label">Montant de la mutuelle actuelle : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="montant_mutuelle_actuelle" id="montant_mutuelle_actuelle" placeholder="Montant de la mutuelle actuelle" disabled value="<?php echo e($rdv->montant_mutuelle_actuelle); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="seul_sur_contrat" class="col-sm-2 control-label">Seul sur le contrat : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="seul_sur_contrat" id="seul_sur_contrat" style="width: 100%;" disabled value="<?php echo e($rdv->seul_sur_contrat); ?>">
								<option selected="selected">Oui</option>
								<option selected="selected">Non</option>
							</select>
						</div>
					</div>
					</div>
					<div id="groupdefisc">
					<div class="form-group">
						<label for="montant_impots_annuel" class="col-sm-2 control-label">Montant impot annuel : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="montant_impots_annuel" id="montant_impots_annuel" placeholder="Montant impot annuel" disabled value="<?php echo e($rdv->montant_impots_annuel); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="taux_endettement" class="col-sm-2 control-label">Taux endettement : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="taux_endettement" id="taux_endettement" placeholder="Taux endettement" disabled value="<?php echo e($rdv->taux_endettement); ?>">
						</div>
					</div>
					</div>
				<div id="groupstatutfoyer">
					<div class="form-group">
						<label for="statut_matrimonial" class="col-sm-2 control-label">Statut matrimonial : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut_matrimonial" id="statut_matrimonial" style="width: 100%;" disabled value="<?php echo e($rdv->statut_matrimonial); ?>">
								<option value="Celibataire" <?php echo e(( $rdv->statut_matrimonial == "Celibataire") ? 'selected' : ''); ?>>Celibataire</option>
								<option value="Marié" <?php echo e(( $rdv->statut_matrimonial == "Marié") ? 'selected' : ''); ?>>Marié</option>
								<option value="Veuf" <?php echo e(( $rdv->statut_matrimonial == "Veuf") ? 'selected' : ''); ?>>Veuf</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="composition_foyer" class="col-sm-2 control-label">Composition foyer : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="composition_foyer" id="composition_foyer" placeholder="Composition foyer" disabled value="<?php echo e($rdv->composition_foyer); ?>">
						</div>
					</div>
				</div>
                <div id="groupautre2">
                <div class="form-group">
                    <label for="date_rendezvous" class="col-sm-2 control-label">Date rendez-vous : </label>
                    <div class="col-sm-10">
						
                        <div class="input-group">
                            <!-- <input type="text" class="form-control" name="date_rendezvous" data-date-format="mm-dd-yyyy" id="date_rendezvous" placeholder="dd-mm-yyyy" value=<?php echo e($rdv->date_rendezvous); ?>> -->
                            <input type="text" class="form-control" name="date_rendezvous" id="date_rendezvous" placeholder="dd-mm-yyyy" disabled value="<?php echo e($rdv->date_rendezvous); ?>">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="heure_rendezvous" class="col-sm-2 control-label">Heure rendez-vous : </label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="heure_rendezvous" id="heure_rendezvous" placeholder="Heure rendez-vous" disabled value="<?php echo e($rdv->heure_rendezvous); ?>">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
				
					<div class="form-group" id="grouppersrdv">
						<label for="nom_personne_rendezvous" class="col-sm-2 control-label">Nom de la personne qui sera la pendent le rendez-vous : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom_personne_rendezvous" id="nom_personne_rendezvous" placeholder="Nom de la personne qui sera la pendent le rendez-vous" disabled value="<?php echo e($rdv->nom_personne_rendezvous); ?>">
						</div>
					</div>
				
					<div class="form-group" id="grouppersrdv">
						<label for="rendezvous_pour" class="col-sm-2 control-label">Rendez-vous pour : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="rendezvous_pour" id="rendezvous_pour" disabled value="<?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?>">
						</div>
					</div>
					
                <div class="form-group" id="groupautre3">
                    <label for="note" class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note" disabled><?php echo e($rdv->note); ?></textarea>
                    </div>
                </div>
				
				


                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <a href="javascript:history.go(-1)" class="btn btn-info pull-right">Fermer</a>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
<?php $__env->stopSection(); ?>
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/rdvs/client/details.blade.php ENDPATH**/ ?>