	
	<div class="form-group" style="margin-bottom:5px">
		<b>ID : </b> <?php echo e(substr($rdv->id,3,-16)); ?>

	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Client : </b> <?php echo e($rdv->cli); ?> 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Service : </b> <?php echo e($rdv->typerdv); ?> 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Centre d’appels : </b> <?php echo e($rdv->centreappel_societe); ?> 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Responsable/agent : </b> <?php echo e($rdv->responsableagent); ?> 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Qualification : </b> <?php echo e($rdv->statut); ?> 
	</div>
	
	<?php if($rdv->nom != '' && $rdv->nom != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Nom : </b> <?php echo e($rdv->nom); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->prenom != '' && $rdv->prenom != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Prenom : </b> <?php echo e($rdv->prenom); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->societe != '' && $rdv->societe != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Société : </b> <?php echo e($rdv->societe); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->adresse != '' && $rdv->adresse != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Adresse : </b> <?php echo e($rdv->adresse); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->cp != '' && $rdv->cp != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Code postal : </b> <?php echo e($rdv->cp); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->ville != '' && $rdv->ville != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Ville : </b> <?php echo e($rdv->ville); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->telephone != '' && $rdv->telephone != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Téléphone : </b> <?php echo e($rdv->telephone); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->mobile != '' && $rdv->mobile != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Mobile : </b> <?php echo e($rdv->mobile); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->email != '' && $rdv->email != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Email : </b> <?php echo e($rdv->email); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->activitesociete != '' && $rdv->activitesociete != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Activité société : </b> <?php echo e($rdv->activitesociete); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->question_1 != '' && $rdv->question_1 != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 1 : </b> <?php echo e($rdv->question_1); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->question_2 != '' && $rdv->question_2 != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 2 : </b> <?php echo e($rdv->question_2); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->question_3 != '' && $rdv->question_3 != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 3 : </b> <?php echo e($rdv->question_3); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->question_4 != '' && $rdv->question_4 != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 4 : </b> <?php echo e($rdv->question_4); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->question_5 != '' && $rdv->question_5 != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 5 : </b> <?php echo e($rdv->question_5); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->surface_total_societe != '' && $rdv->surface_total_societe != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Surface total société : </b> <?php echo e($rdv->surface_total_societe); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->surface_bureau != '' && $rdv->surface_bureau != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Surface de bureau : </b> <?php echo e($rdv->surface_bureau); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Nettoyage pro"): ?>
		<?php if($rdv->sous_contrat != '' && $rdv->sous_contrat != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Sous contrat : </b> <?php echo e($rdv->sous_contrat); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->date_anniversaire_contrat != '' && $rdv->date_anniversaire_contrat != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Date anniversaire du contrat : </b> <?php echo e($rdv->date_anniversaire_contrat); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Assurance pro"): ?>
		<?php if($rdv->protectionsociale != '' && $rdv->protectionsociale != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Protection sociale : </b> <?php echo e($rdv->protectionsociale); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Assurance pro"): ?>
		<?php if($rdv->mutuellesante != '' && $rdv->mutuellesante != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Mutuelle santé : </b> <?php echo e($rdv->mutuellesante); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Mutuelle santé sénior"): ?>
		<?php if($rdv->mutuelle_entreprise != '' && $rdv->mutuelle_entreprise != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Mutuelle entreprise : </b> <?php echo e($rdv->mutuelle_entreprise); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->nom_mutuelle != '' && $rdv->nom_mutuelle != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Nom de sa mutuelle : </b> <?php echo e($rdv->nom_mutuelle); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->montant_mutuelle_actuelle != '' && $rdv->montant_mutuelle_actuelle != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Montant de la mutuelle actuelle : </b> <?php echo e($rdv->montant_mutuelle_actuelle); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Mutuelle santé sénior"): ?>
		<?php if($rdv->seul_sur_contrat != '' && $rdv->seul_sur_contrat != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Seul sur le contrat : </b> <?php echo e($rdv->seul_sur_contrat); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->montant_impots_annuel != '' && $rdv->montant_impots_annuel != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Montant impot annuel : </b> <?php echo e($rdv->montant_impots_annuel); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->taux_endettement != '' && $rdv->taux_endettement != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Taux endettement : </b> <?php echo e($rdv->taux_endettement); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Mutuelle santé sénior"): ?>
		<?php if($rdv->age != '' && $rdv->age != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Age : </b> <?php echo e($rdv->age); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->profession != '' && $rdv->profession != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Profession : </b> <?php echo e($rdv->profession); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->proprietaireoulocataire != '' && $rdv->proprietaireoulocataire != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Propriétaire ou Locataire : </b> <?php echo e($rdv->proprietaireoulocataire); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->typerdv=="Défiscalisation"): ?>
		<?php if($rdv->statut_matrimonial != '' && $rdv->statut_matrimonial != null): ?>
			<div class="form-group" style="margin-bottom:5px">
				<b>Statut matrimonial : </b> <?php echo e($rdv->statut_matrimonial); ?> 
			</div>
		<?php endif; ?>
	<?php endif; ?>
	
	<?php if($rdv->composition_foyer != '' && $rdv->composition_foyer != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Composition foyer : </b> <?php echo e($rdv->composition_foyer); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->date_rendezvous != '' && $rdv->date_rendezvous != null): ?>
		<div class="form-group" style="margin-bottom:5px">
		<?php if(($rdv->typerdv == 'Réception d\'appels') || ($rdv->typerdv == 'Demande de devis')): ?> 
			<b>Date du jour : </b> <?php echo e($rdv->date_rendezvous); ?> 
		<?php else: ?>
			<b>Date rendez-vous : </b> <?php echo e($rdv->date_rendezvous); ?>

		<?php endif; ?>
		</div>
	<?php endif; ?>
	
	<?php if($rdv->heure_rendezvous != '' && $rdv->heure_rendezvous != null): ?>
		<div class="form-group" style="margin-bottom:5px">
		<?php if(($rdv->typerdv == 'Réception d\'appels') || ($rdv->typerdv == 'Demande de devis')): ?> 
			<b>Heure du jour : </b> <?php echo e($rdv->heure_rendezvous); ?> 
		<?php else: ?>
			<b>Heure rendez-vous : </b> <?php echo e($rdv->heure_rendezvous); ?>

		<?php endif; ?>
		</div>
	<?php endif; ?>
	
	<?php if($rdv->nom_personne_rendezvous != '' && $rdv->nom_personne_rendezvous != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Nom de la personne qui sera la pendent le rendez-vous : </b> <?php echo e($rdv->nom_personne_rendezvous); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->note != '' && $rdv->note != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Note : </b> <?php echo e($rdv->note); ?> 
		</div>
	<?php endif; ?>
	
	<?php if($rdv->notestaff != '' && $rdv->notestaff != null): ?>
		<div class="form-group" style="margin-bottom:5px">
			<b>Note du Staff : </b> <?php echo e($rdv->notestaff); ?> 
		</div>
	<?php endif; ?>
<?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/rdvs/pdf.blade.php ENDPATH**/ ?>