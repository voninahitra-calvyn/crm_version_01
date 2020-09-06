<!-- resources\views\rdvs\edit.blade.php -->



<?php $__env->startSection('htmlheader_title'); ?>
<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Modification rendez-vous '); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
<li><a href="<?php echo e(route('rdvs.tout')); ?>"><i class="fa fa-dashboard"></i>Rendez-vous </a></li>
<li class="active">Modification</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
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
				<!-- <input type="text" class="form-control " value="" name="centreappel_societe" id="centreappel_societe"> -->
				<input type="text" class="form-control hidden" value="<?php echo e($clientComResp->email); ?>" name="client_emailpriv" id="client_emailpriv">
				<input type="text" class="form-control hidden" value="<?php echo e($clientComResp->nom); ?>" name="client_nompriv" id="client_nompriv">
				<input type="text" class="form-control hidden" value="<?php echo e($clientComResp->prenom); ?>" name="client_prenompriv" id="client_prenompriv">
                <input type="text" class="form-control hidden" value="<?php echo e($client->societe); ?>" name="client_societe" id="client_societe">
				<input type="text" class="form-control hidden" value="<?php echo e($nomsocieteCentreappels); ?>" name="centreappel_societe" id="centreappel_societe">
				<!-- <input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>" name="responsableagent" id="responsableagent"> -->
				<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->nom); ?>" name="user_nom" id="user_nom">
				<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->prenom); ?>" name="user_prenom" id="user_prenom">
				<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->statut); ?>" name="user_statut" id="user_statut">
				<div class="form-group">
					<label for="nom" class="col-sm-2 control-label">ID : </label>
					<div class="col-sm-10">
					  <input type="text" class="form-control" name="idrdv" id="idrdv" placeholder="ID" value="<?php echo e(substr($rdv->id,3,-16)); ?>" disabled>
					</div>
				</div>
				<div class="form-group">
                    <label for="cli" class="col-sm-2 control-label">Client : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo e($rdv->cli); ?>" name="cli" id="cli" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="typerdv" class="col-sm-2 control-label">Service : </label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="typerdv" id="typerdv" style="width: 100%;" disabled>
							<?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($service); ?>" <?php echo e(( $rdv->typerdv == $service) ? 'selected' : ''); ?>><?php echo e($service); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
					
				<div class="form-group" id="groupcentreappel">
					<label for="typerdv" class="col-sm-2 control-label">Centre d’appels : </label>
					<div class="col-sm-10">
						<input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($rdv->centreappel_societe); ?>" disabled>
						<input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($rdv->centreappel_societe); ?>" name="centreappel_societe" id="centreappel_societe">
						<!-- <input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($nomsocieteCentreappels); ?>" name="centreappel_societe" id="centreappel_societe"> -->
					</div>
				</div>
					
				<div class="form-group" id="groupresponsableagent">
					<label for="typerdv" class="col-sm-2 control-label">Responsable/agent : </label>
					<div class="col-sm-10">
						<!-- <input type="text" class="form-control" name="responsableagent" id="responsableagent" placeholder="Responsable/agent" value="<?php echo e($rdv->responsableagent); ?>"> -->
						<input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($rdv->responsableagent); ?>" disabled>
						<input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($rdv->responsableagent); ?>" name="responsableagent" id="responsableagent">
					</div>
				</div>
					
                <div class="form-group">
                    <label for="statut" class="col-sm-2 control-label">Qualification : </label>
                    <div class="col-sm-10">
                        <select class="form-control selecttype" name="statut" id="statut" style="width: 100%;" <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> disabled <?php endif; ?>>
							<option id="rendezvousbrut" value="Rendez-vous brut" <?php echo e(( $rdv->statut == "Rendez-vous brut") ? 'selected' : ''); ?>>Rendez-vous brut</option>
                            <option id="rendezvousrefuse" value="Rendez-vous refusé" <?php echo e(( $rdv->statut == "Rendez-vous refusé") ? 'selected' : ''); ?>>Rendez-vous refusé / ne pas relancer</option>
                            <option id="rendezvousrelance" value="Rendez-vous relancer" <?php echo e(( $rdv->statut == "Rendez-vous relancer") ? 'selected' : ''); ?>>Rendez-vous refusé / relancer</option>
                            <option id="rendezvousenvoye" value="Rendez-vous envoyé" <?php echo e(( $rdv->statut == "Rendez-vous envoyé") ? 'selected' : ''); ?>>Rendez-vous envoyé</option>
                            <option id="rendezvousconfirme" value="Rendez-vous confirmé" <?php echo e(( $rdv->statut == "Rendez-vous confirmé") ? 'selected' : ''); ?>>Rendez-vous confirmé</option>
                            <option id="rendezvousannule" value="Rendez-vous annulé" <?php echo e(( $rdv->statut == "Rendez-vous annulé") ? 'selected' : ''); ?>>Rendez-vous annulé</option>
                            <option id="rendezvousenattente" value="Rendez-vous en attente" <?php echo e(( $rdv->statut == "Rendez-vous en attente") ? 'selected' : ''); ?>>Rendez-vous en attente</option>
                            <option id="rendezvousvalide" value="Rendez-vous validé" <?php echo e(( $rdv->statut == "Rendez-vous validé") ? 'selected' : ''); ?>>Rendez-vous validé</option>
                            <option id="receptionappel" value="Réception d’appels brut" <?php echo e(( $rdv->statut == "Réception d’appels brut") ? 'selected' : ''); ?>>Réception d’appels brut</option>
                            <option id="receptionappelenvoye" value="Réception d’appels envoyé" <?php echo e(( $rdv->statut == "Réception d’appels envoyé") ? 'selected' : ''); ?>>Réception d’appels envoyé</option>
                            <option id="demandedevis" value="Demande de devis brut" <?php echo e(( $rdv->statut == "Demande de devis brut") ? 'selected' : ''); ?>>Demande de devis brut</option>
                            <option id="demandedevisenvoye" value="Demande de devis envoyé" <?php echo e(( $rdv->statut == "Demande de devis envoyé") ? 'selected' : ''); ?>>Demande de devis envoyé</option>
                        </select>
                    </div>
                </div>
						<div id="groupnomprenom">
							<div class="form-group">
								<label for="nom" class="col-sm-2 control-label">Nom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo e($rdv->nom); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo e($rdv->prenom); ?>">
								</div>
							</div>
						</div>
						<div class="form-group" id="groupsociete">
							<label for="societe" class="col-sm-2 control-label">Société : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="<?php echo e($rdv->societe); ?>" >
							</div>
						</div>
                <div id="groupautre1">
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="<?php echo e($rdv->adresse); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Code postal : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="cp" id="cp" placeholder="Code postal" value="<?php echo e($rdv->cp); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo e($rdv->ville); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="<?php echo e($rdv->telephone); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="mobile" class="col-sm-2 control-label">Mobile : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo e($rdv->mobile); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo e($rdv->email); ?>" required>
						</div>
					</div>
				</div>

					<div class="form-group" id="groupactivitesociete">
						<label for="activitesociete" class="col-sm-2 control-label">Activité société : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="activitesociete" id="activitesociete" placeholder="Activité société" value="<?php echo e($rdv->activitesociete); ?>">
						</div>
					</div>

					<div id="groupquestion">
						<div class="form-group">
							<label for="question_1" class="col-sm-2 control-label">Question 1 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_1" id="question_1" placeholder="Question 1" value="<?php echo e($rdv->question_1); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="question_2" class="col-sm-2 control-label">Question 2 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_2" id="question_2" placeholder="Question 2" value="<?php echo e($rdv->question_2); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="question_3" class="col-sm-2 control-label">Question 3 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_3" id="question_1" placeholder="Question 3" value="<?php echo e($rdv->question_3); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="question_4" class="col-sm-2 control-label">Question 4 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_4" id="question_4" placeholder="Question 4" value="<?php echo e($rdv->question_4); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="question_5" class="col-sm-2 control-label">Question 5 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_5" id="question_5" placeholder="Question 5" value="<?php echo e($rdv->question_5); ?>">
							</div>
						</div>
					</div>

					<div id="groupnetoyagepro">
						<div class="form-group">
							<label for="surface_total_societe" class="col-sm-2 control-label">Surface total société : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="surface_total_societe" id="surface_total_societe" placeholder="Surface total société" value="<?php echo e($rdv->surface_total_societe); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="surface_bureau" class="col-sm-2 control-label">Surface de bureau : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="surface_bureau" id="surface_bureau" placeholder="Surface de bureau" value="<?php echo e($rdv->surface_bureau); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="sous_contrat" class="col-sm-2 control-label">Sous contrat : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="sous_contrat" id="sous_contrat" value="<?php echo e($rdv->sous_contrat); ?>" style="width: 100%;">
									<option selected="selected">Oui</option>
									<option selected="selected">Non</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="date_anniversaire_contrat" class="col-sm-2 control-label">Date anniversaire du contrat: </label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" class="form-control" name="date_anniversaire_contrat" id="date_anniversaire_contrat" placeholder="dd/mm/yyyy" value="<?php echo e($rdv->date_anniversaire_contrat); ?>">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group" id="groupprotectionsociale">
						<label for="protectionsociale" class="col-sm-2 control-label">Protection sociale : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="protectionsociale" id="protectionsociale" placeholder="Protection sociale" value="<?php echo e($rdv->protectionsociale); ?>">
						</div>
					</div>

					<div class="form-group" id="groupmutuellesante">
						<label for="mutuellesante" class="col-sm-2 control-label">Mutuelle santé : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mutuellesante" id="mutuellesante" placeholder="Mutuelle santé" value="<?php echo e($rdv->mutuellesante); ?>">
						</div>
					</div>

					<div id="groupmutuel">
						<div class="form-group">
							<label for="mutuelle_entreprise" class="col-sm-2 control-label">Mutuelle entreprise : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="mutuelle_entreprise" id="mutuelle_entreprise" style="width: 100%;" value="<?php echo e($rdv->mutuelle_entreprise); ?>">
									<option selected="selected">Oui</option>
									<option selected="selected">Non</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nom_mutuelle" class="col-sm-2 control-label">Nom de sa mutuelle : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nom_mutuelle" id="nom_mutuelle" placeholder="Nom de sa mutuelle" value="<?php echo e($rdv->nom_mutuelle); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="montant_mutuelle_actuelle" class="col-sm-2 control-label">Montant de la mutuelle actuelle : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="montant_mutuelle_actuelle" id="montant_mutuelle_actuelle" placeholder="Montant de la mutuelle actuelle" value="<?php echo e($rdv->montant_mutuelle_actuelle); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="seul_sur_contrat" class="col-sm-2 control-label">Seul sur le contrat : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="seul_sur_contrat" id="seul_sur_contrat" style="width: 100%;" value="<?php echo e($rdv->seul_sur_contrat); ?>">
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
								<input type="text" class="form-control" name="montant_impots_annuel" id="montant_impots_annuel" placeholder="Montant impot annuel" value="<?php echo e($rdv->montant_impots_annuel); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="taux_endettement" class="col-sm-2 control-label">Taux endettement : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="taux_endettement" id="taux_endettement" placeholder="Taux endettement" value="<?php echo e($rdv->taux_endettement); ?>">
							</div>
						</div>
					</div>

					<div class="form-group" id="groupage">
						<label for="age" class="col-sm-2 control-label">Age : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="age" id="age" placeholder="Age" value="<?php echo e($rdv->age); ?>">
						</div>
					</div>

					<div class="form-group" id="groupprofession">
						<label for="profession" class="col-sm-2 control-label">Profession : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="profession" id="profession" placeholder="Profession" value="<?php echo e($rdv->profession); ?>">
						</div>
					</div>

					<div class="form-group" id="groupproprietaireoulocataire">
						<label for="proprietaireoulocataire" class="col-sm-2 control-label">Propriétaire ou Locataire : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="proprietaireoulocataire" id="proprietaireoulocataire" placeholder="Propriétaire ou Locataire" value="<?php echo e($rdv->proprietaireoulocataire); ?>">
						</div>
					</div>
					
				<div id="groupstatutfoyer">
					<div class="form-group">
						<label for="statut_matrimonial" class="col-sm-2 control-label">Statut matrimonial : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut_matrimonial" id="statut_matrimonial" style="width: 100%;" value="<?php echo e($rdv->statut_matrimonial); ?>">
								<option value="Celibataire" <?php echo e(( $rdv->statut_matrimonial == "Celibataire") ? 'selected' : ''); ?>>Celibataire</option>
								<option value="Marié" <?php echo e(( $rdv->statut_matrimonial == "Marié") ? 'selected' : ''); ?>>Marié</option>
								<option value="Veuf" <?php echo e(( $rdv->statut_matrimonial == "Veuf") ? 'selected' : ''); ?>>Veuf</option>
							</select>
						</div>
					</div>
				</div>
				<div id="groupcompositionfoyer">
					<div class="form-group">
						<label for="composition_foyer" class="col-sm-2 control-label">Composition foyer : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="composition_foyer" id="composition_foyer" placeholder="Composition foyer" value="<?php echo e($rdv->composition_foyer); ?>">
						</div>
					</div>
				</div>
				<div id="groupnomprenomcontact">
					<div class="form-group">
						<label for="nomprenomcontact" class="col-sm-2 control-label">Nom et prénom du contact : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nomprenomcontact" id="nomprenomcontact" placeholder="Nom et prénom du contact" value="<?php echo e($rdv->nomprenomcontact); ?>">
						</div>
					</div>
				</div>
                <div id="groupautre2">
					<div class="form-group">
						<label id="groupdate1" for="date_rendezvousedit" class="col-sm-2 control-label">Date rendez-vous : </label>
						<label id="groupdate2" for="date_rendezvousedit" class="col-sm-2 control-label">Date du jour : </label>
						<div class="col-sm-10">
							
							<div class="input-group">
								<input type="text" class="form-control" name="date_rendezvousedit" id="date_rendezvousedit" placeholder="dd-mm-yyyy" value="<?php echo e($rdv->date_rendezvous); ?>" >
								<!-- <input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($rdv->date_rendezvous); ?>" disabled> -->
								<!-- <input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" name="date_rendezvousedit" id="date_rendezvousedit" placeholder="dd-mm-yyyy" value="<?php echo e($rdv->date_rendezvous); ?>" > -->
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
                <div class="form-group">
                    <label id="groupheure1" for="heure_rendezvousedit" class="col-sm-2 control-label">Heure rendez-vous : </label>
                    <label id="groupheure2" for="heure_rendezvousedit" class="col-sm-2 control-label">Heure du jour : </label>
                    <div class="col-sm-10">
                        <div class="input-group">
							<input type="text" class="form-control" name="heure_rendezvousedit" id="heure_rendezvousedit" placeholder="dd-mm-yyyy" value="<?php echo e($rdv->heure_rendezvous); ?>" >
                            <!-- <input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($rdv->heure_rendezvous); ?>" disabled> -->
							<!-- <input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" name="heure_rendezvousedit" id="heure_rendezvousedit" placeholder="dd-mm-yyyy" value="<?php echo e($rdv->heure_rendezvous); ?>" > -->
							<div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
				
					<div class="form-group" id="groupnompersonnerdv">
						<label for="nom_personne_rendezvous" class="col-sm-2 control-label">Nom de la personne qui sera la pendent le rendez-vous : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom_personne_rendezvous" id="nom_personne_rendezvous" placeholder="Nom de la personne qui sera la pendent le rendez-vous" value="<?php echo e($rdv->nom_personne_rendezvous); ?>">
						</div>
					</div>	
					
				<!-- 
				<div class="form-group" id="groupaudiordv">
					<label for="audio" class="col-sm-2 control-label">Audio : </label>
					<div class="col-sm-10">
						<audio src="<?php echo e(asset('/uploads/audio')); ?>/<?php echo e($rdv->audio); ?>" controls>Veuillez mettre à jour votre navigateur !</audio>
						<div class="btn btn-primary btn-file  audio">
							<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
							<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
							<input type="file" id="audioInputfile" name="audioInputfile" />
						</div>
						<input type="hidden" id="is_audio" name="is_audio" value="Non" />
						<input type="hidden" id="hidden_audio" name="hidden_audio" value="<?php echo e($rdv->audio); ?>" />
						<button class="btn btn-primary btn-xs hidden" id="btnmodifaudio" name="btnmodifaudio" type="submit"><i class="fa fa-edit"></i> Modifier audio</button>
						<button type="submit" class="btn btn-success audio hidden"><i class="fa fa-check"></i> Valider</button>
						<button id="btnsupprimer" type="submit" class="btn btn-danger audio"><i class="fa fa-trash"></i> Supprimer</button>
					</div>
				</div> 
				-->
					
                <div class="form-group" id="groupautre3">
                    <label for="note" class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"><?php echo e($rdv->note); ?></textarea>
                    </div>
                </div>
					
                <!-- <div class="form-group <?php if(Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff'): ?> hidden <?php endif; ?>" id="groupautre3"> -->
                <!-- 
				<div class="form-group" id="groupautre3">
                    <label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle"><?php echo e($rdv->noteconfidentielle); ?></textarea>
                    </div>
                </div>
				 -->	
                <div class="form-group" id="groupautre3">
                    <label for="notestaff" class="col-sm-2 control-label">Note du Staff: </label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" rows="3" placeholder="Note du Staff" disabled><?php echo e($rdv->notestaff); ?></textarea>
                        <textarea class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" rows="3" name="notestaff" id="notestaff" placeholder="Note du Staff"><?php echo e($rdv->notestaff); ?></textarea>
                    </div>
                </div>
				
					
					<div class="form-group">
						<div class="margin">
							<div class="col-sm-2 btn-group">
								<a href="javascript:history.go(-1)" class="btn btn-default pull-right">Annuler</a>
							</div>
							<div class="col-sm-8 btn-group">
								<!-- <button id="telechargerpdfficherdv1" class="btn btn-danger pull-right"><i class="fa fa-file-pdf-o"></i> Télécharger</button> -->
							</div>
							<div class="col-sm-2 btn-group">
								<button type="submit" class="btn btn-info pull-left">Valider</button>
							</div>
						</div>
					</div>

            </div>
        </form> 	
		
        <form class="form-horizontal" method="post" action="<?php echo e(route('rdvs.update', $rdv->id)); ?>" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
		</form>
									
					    <div class="row center ">
							<div class="col-md-4">
							</div>
							<div class="col-md-4 exportpdfrdv">
								<form action="<?php echo e(route('rdvs.exportpdf', $rdv->id)); ?>" method="post" class="">
									<?php echo csrf_field(); ?>
									<?php echo method_field('GET'); ?>
									<button id="telechargerpdfficherdv2" type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Télécharger</button>
								</form>
							</div>
							<div class="col-md-4">
							</div>
						</div>		

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/rdvs/edit.blade.php ENDPATH**/ ?>