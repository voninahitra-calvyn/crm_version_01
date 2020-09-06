<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheader_title', 'Ajout rendez-vous '); ?>

<?php $__env->startSection('contentheader_levelactive'); ?>
	<li><a href="<?php echo e(route('rdvs.defiscalisation')); ?>"><i class="fa fa-dashboard"></i>Rendez-vous </a></li>
	<li class="active">Ajout</li>
<?php $__env->stopSection(true); ?>


<?php $__env->startSection('main-content'); ?>
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <form class="form-horizontal" method="GET" action="<?php echo e(route('rdvs.storerdv')); ?>">
			
			
                 
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
					<input type="text" class="form-control hidden" value="<?php echo e($compte->nom); ?>" name="client_nompriv" id="client_nompriv">
					<input type="text" class="form-control hidden" value="<?php echo e($compte->prenom); ?>" name="client_prenompriv" id="client_prenompriv">
					<!-- <input type="text" class="form-control hidden" value="<?php echo e($nomsocieteCentreappels); ?>" name="centreappel_societe" id="centreappel_societe"> -->
					<input type="text" class="form-control hidden" value="<?php echo e($client->societe); ?>" name="client_societe" id="client_societe">
					<input type="text" class="form-control hidden" value="<?php echo e($client->_id); ?>" name="client_id" id="client_id">
					<input type="text" class="form-control hidden" value="<?php echo e($compte->_id); ?>" name="compte_id" id="compte_id">
					<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->statut); ?>" name="user_statut" id="user_statut">
					<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->nom); ?>" name="user_nom" id="user_nom">
					<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->prenom); ?>" name="user_prenom" id="user_prenom">
					<input type="text" class="form-control hidden" value="<?php echo e(Auth::user()->_id); ?>" name="user_id" id="user_id">
					<div class="form-group">
						<label for="cli" class="col-sm-2 control-label">Client : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="cli" id="cli" style="width: 100%;">
								<option selected="selected"><?php echo e($compte->nom); ?> (<?php echo e($client->societe2); ?>)</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="typerdv" class="col-sm-2 control-label">Service : </label>
						<div class="col-sm-10">
                        <!-- <select class="form-control select2" multiple="multiple" name="typerdv[]" id="typerdv" style="width: 100%;" > -->
                        <select class="form-control select2" name="typerdv" id="typerdv" style="width: 100%;" required>
							<option> </option>
							<?php $__currentLoopData = $client->service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<!-- <option selected="selected"> -->
								<option>
								<?php echo e($service); ?>

								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
						</div>
					</div>
					
					<div class="form-group" id="groupcentreappel">
						<label for="nomsocieteCentreappels" class="col-sm-2 control-label">Centre d’appels : </label>
						<div class="col-sm-10">
							<!-- <input type="text" class="form-control" value="<?php echo e($client->societe); ?>" name="client_societe" id="client_societe"> -->
							<input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($nomsocieteCentreappels); ?>" disabled>
							<input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e($nomsocieteCentreappels); ?>" name="centreappel_societe" id="centreappel_societe">
						</div>
					</div>
					
					<div class="form-group" id="groupresponsableagent">
						<label for="responsableagent" class="col-sm-2 control-label">Responsable/agent : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>" disabled>
							<input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" value="<?php echo e(Auth::user()->prenom); ?> <?php echo e(Auth::user()->nom); ?>" name="responsableagent" id="responsableagent">
						</div>
					</div>

						<div id="groupnomprenom">
							<div class="form-group">
								<label for="nom" class="col-sm-2 control-label">Nom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" >
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" >
								</div>
							</div>
						</div>

						<div class="form-group" id="groupsociete">
							<label for="societe" class="col-sm-2 control-label">Société : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="societe" id="societe" placeholder="Société" >
							</div>
						</div>

                <div id="groupautre1">
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" >
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Code postal : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="cp" id="cp" placeholder="Code postal" >
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" >
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" >
						</div>
					</div>
					<div class="form-group">
						<label for="mobile" class="col-sm-2 control-label">Mobile : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
							<!-- <input type="email" class="form-control" name="email" id="email" placeholder="Email" required> -->
							<input type="text" class="form-control" value="NC" name="email" id="email" placeholder="Email">
						</div>
					</div>
                </div>

					<div class="form-group" id="groupactivitesociete">
						<label for="activitesociete" class="col-sm-2 control-label">Activité société : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="activitesociete" id="activitesociete" placeholder="Activité société" >
						</div>
					</div>

					<div id="groupquestion">
						<div class="form-group">
							<label for="question_1" class="col-sm-2 control-label">Question 1 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_1" id="question_1" placeholder="Question 1" >
							</div>
						</div>
						<div class="form-group">
							<label for="question_2" class="col-sm-2 control-label">Question 2 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_2" id="question_2" placeholder="Question 2" >
							</div>
						</div>
						<div class="form-group">
							<label for="question_3" class="col-sm-2 control-label">Question 3 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_3" id="question_1" placeholder="Question 3" >
							</div>
						</div>
						<div class="form-group">
							<label for="question_4" class="col-sm-2 control-label">Question 4 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_4" id="question_4" placeholder="Question 4" >
							</div>
						</div>
						<div class="form-group">
							<label for="question_5" class="col-sm-2 control-label">Question 5 : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="question_5" id="question_5" placeholder="Question 5" >
							</div>
						</div>
					</div>

					<div id="groupnetoyagepro">
						<div class="form-group">
							<label for="surface_total_societe" class="col-sm-2 control-label">Surface total société : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="surface_total_societe" id="surface_total_societe" placeholder="Surface total société" >
							</div>
						</div>
						<div class="form-group">
							<label for="surface_bureau" class="col-sm-2 control-label">Surface de bureau : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="surface_bureau" id="surface_bureau" placeholder="Surface de bureau" >
							</div>
						</div>
						<div class="form-group">
							<label for="sous_contrat" class="col-sm-2 control-label">Sous contrat : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="sous_contrat" id="sous_contrat" style="width: 100%;">
									<option selected="selected">Oui</option>
									<option selected="selected">Non</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="date_anniversaire_contrat" class="col-sm-2 control-label">Date anniversaire du contrat: </label>
							<div class="col-sm-10">
								<div class="input-group">
									<input type="text" class="form-control" name="date_anniversaire_contrat" id="date_anniversaire_contrat" placeholder="dd/mm/yyyy" >
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
							<input type="text" class="form-control" name="protectionsociale" id="protectionsociale" placeholder="Protection sociale" >
						</div>
					</div>

					<div class="form-group" id="groupmutuellesante">
						<label for="mutuellesante" class="col-sm-2 control-label">Mutuelle santé : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mutuellesante" id="mutuellesante" placeholder="Mutuelle santé" >
						</div>
					</div>

					<div id="groupmutuel">
						<div class="form-group">
							<label for="mutuelle_entreprise" class="col-sm-2 control-label">Mutuelle entreprise : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="mutuelle_entreprise" id="mutuelle_entreprise" style="width: 100%;">
									<option selected="selected">Oui</option>
									<option selected="selected">Non</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nom_mutuelle" class="col-sm-2 control-label">Nom de sa mutuelle : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nom_mutuelle" id="nom_mutuelle" placeholder="Nom de sa mutuelle" >
							</div>
						</div>
						<div class="form-group">
							<label for="montant_mutuelle_actuelle" class="col-sm-2 control-label">Montant de la mutuelle actuelle : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="montant_mutuelle_actuelle" id="montant_mutuelle_actuelle" placeholder="Montant de la mutuelle actuelle" >
							</div>
						</div>
						<div class="form-group">
							<label for="seul_sur_contrat" class="col-sm-2 control-label">Seul sur le contrat : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="seul_sur_contrat" id="seul_sur_contrat" style="width: 100%;">
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
								<input type="text" class="form-control" name="montant_impots_annuel" id="montant_impots_annuel" placeholder="Montant impot annuel" >
							</div>
						</div>
						<div class="form-group">
							<label for="taux_endettement" class="col-sm-2 control-label">Taux endettement : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="taux_endettement" id="taux_endettement" placeholder="Taux endettement" >
							</div>
						</div>
					</div>

					<div class="form-group" id="groupage">
						<label for="age" class="col-sm-2 control-label">Age : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="age" id="age" placeholder="Age" >
						</div>
					</div>

					<div class="form-group" id="groupprofession">
						<label for="profession" class="col-sm-2 control-label">Profession : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="profession" id="profession" placeholder="Profession" >
						</div>
					</div>

					<div class="form-group" id="groupproprietaireoulocataire">
						<label for="proprietaireoulocataire" class="col-sm-2 control-label">Propriétaire ou Locataire : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="proprietaireoulocataire" id="proprietaireoulocataire" placeholder="Propriétaire ou Locataire" >
						</div>
					</div>
					
				<div id="groupstatutfoyer">
					<div class="form-group">
						<label for="statut_matrimonial" class="col-sm-2 control-label">Statut matrimonial : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut_matrimonial" id="statut_matrimonial" style="width: 100%;">
								<option value="Celibataire" >Celibataire</option>
								<option value="Marié" >Marié</option>
								<option value="Veuf" >Veuf</option>
							</select>
						</div>
					</div>
				</div>
				<div id="groupcompositionfoyer">
					<div class="form-group">
						<label for="composition_foyer" class="col-sm-2 control-label">Composition foyer : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="composition_foyer" id="composition_foyer" placeholder="Composition foyer" >
						</div>
					</div>
				</div>
                <div id="groupautre2">
					<div class="form-group">
						<label id="groupdate1" for="date_rendezvous" class="col-sm-2 control-label">Date rendez-vous : </label>
						<label id="groupdate2" for="date_rendezvous" class="col-sm-2 control-label">Date du jour : </label>
						<div class="col-sm-10">
							
							<div class="input-group">
								<input type="text" class="form-control" name="date_rendezvous" id="date_rendezvous" placeholder="dd-mm-yyyy" >
								<!-- <input type="text" class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" disabled> -->
								<!-- <input type="text" class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" name="date_rendezvous" id="date_rendezvous" placeholder="dd-mm-yyyy" > -->
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label id="groupheure1" for="heure_rendezvous" class="col-sm-2 control-label">Heure rendez-vous : </label>
						<label id="groupheure2" for="heure_rendezvous" class="col-sm-2 control-label">Heure du jour : </label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" name="heure_rendezvous" id="heure_rendezvous" placeholder="Heure rendez-vous" >
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
							<input type="text" class="form-control" name="nom_personne_rendezvous" id="nom_personne_rendezvous" placeholder="Nom de la personne qui sera la pendent le rendez-vous" >
						</div>
					</div>
					
                <div class="form-group" id="groupautre3">
                    <label for="note" class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"> </textarea>
                    </div>
                </div>
					
                <div class="form-group" id="groupautre3">
                    <label for="notestaff" class="col-sm-2 control-label">Note du Staff: </label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?php if(Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent'): ?> hidden <?php endif; ?>" rows="3" placeholder="Note du Staff" disabled> </textarea>
                        <textarea class="form-control <?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?> hidden <?php endif; ?>" rows="3" name="notestaff" id="notestaff" placeholder="Note du Staff"> </textarea>
                    </div>
                </div>
					
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-info pull-right">Valider</button>
						</div>
					</div>
					
				</div>
			</form>
	
		</div>      
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/rdvs/create.blade.php ENDPATH**/ ?>