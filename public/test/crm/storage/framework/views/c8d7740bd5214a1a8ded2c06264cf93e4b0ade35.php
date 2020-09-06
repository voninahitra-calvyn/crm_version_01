<table>
    <thead>
		<?php if(Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent'): ?>
		<tr class="header">
			<th><b>Référence</b></th>
			<th class=""><b>Campagne en cours</b></th>
			<th class=""><b>Société</b></th>
			<th class=""><b>Ville</b></th>
			<th class=""><b>Téléphone</b></th>
			<th style="white-space: nowrap;"><b>Nom de la personne au rendez-vous</b></th>
			<th class=""><b>Qualification</b></th>
			<th class=""><b>Date rendez-vous</b></th>
			<th class=""><b>Heure rendez-vous</b></th>
		</tr>
		<?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
		<tr style="font-weight:bold;">
			<th><b>Référence</b></th>
			<th><b>Centre d’appels</b></th>
			<th><b>Responsable/agent</b></th>
			<th><b>Campagne en cours</b></th>
			<th><b>Nom</b></th>
			<th><b>Prénom</b></th>
			<th><b>Société</b></th>
			<th><b>Adresse</b></th>
			<th><b>Code postal</b></th>
			<th><b>Ville</b></th>
			<th><b>Téléphone</b></th>
			<th><b>Mobile</b></th>
			<th><b>Email</b></th>
			<th><b>Activité société</b></th>
			<th><b>Question 1</b></th>
			<th><b>Question 2</b></th>
			<th><b>Question 3</b></th>
			<th><b>Question 4</b></th>
			<th><b>Question 5</b></th>
			<th><b>Surface total société</b></th>
			<th><b>Surface de bureau</b></th>
			<th><b>Sous contrat</b></th>
			<th><b>Date anniversaire du contrat</b></th>
			<th><b>Protection sociale</b></th>
			<th><b>Mutuelle santé</b></th>
			<th><b>Mutuelle entreprise</b></th>
			<th><b>Nom de sa mutuelle</b></th>
			<th><b>Montant de la mutuelle actuelle</b></th>
			<th><b>Seul sur le contrat</b></th>
			<th><b>Montant impot annuel</b></th>
			<th><b>Taux endettement</b></th>
			<th><b>Age</b></th>
			<th><b>Profession</b></th>
			<th><b>Propriétaire ou Locataire</b></th>
			<th><b>Statut matrimonial</b></th>
			<th><b>Composition foyer</b></th>
			<th><b>Nom et prénom du contact</b></th>
			<th><b>Nom de la personne au rendez-vous</b></th>
			<th><b>Qualification</b></th>
			<th><b>Date rendez-vous</b></th>
			<th><b>Heure rendez-vous</b></th>
			<th><b>Rendez-vous pour</b></th>
			<th><b>Note</b></th>
			<th><b>Note du Staff</b></th>
		</tr>
							
		<?php elseif(Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'): ?>
		<tr class="">
			<th><b>Référence</b></th>
			<th><b>Type</b></th>
			<th><b>Société</b></th>
			<th><b>Ville</b></th>
			<th><b>Téléphone</b></th>
			<th><b>Nom de la personne rendez-vous</b></th>
			<th><b>Qualification</b></th>
			<th><b>Date rendez-vous</b></th>
			<th><b>Heure rendez-vous</b></th>
			<th><b>Rendez-vous pour</b></th>
		</tr>
		<?php endif; ?>	
    </thead>
    <tbody>
    <?php $__currentLoopData = $rdvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(Auth::user()->statut == 'Superviseur'): ?>
			<?php if($rdv->id_groupe == Auth::user()->centreappel_id): ?>
				<tr class="">
					<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
					<td class=""><?php echo e($rdv->cli); ?></td>
					<td class=""><?php echo e($rdv->societe); ?></td>
					<td class=""><?php echo e($rdv->ville); ?></td>
					<td class=""><?php echo e($rdv->telephone); ?></td>
					<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->statut); ?></td>
					<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
				</tr>
			<?php endif; ?>
		<?php elseif(Auth::user()->statut == 'Agent'): ?>
			<?php if($rdv->user_id == Auth::user()->_id): ?>
				<tr>
					<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
					<td class=""><?php echo e($rdv->cli); ?></td>
					<td class="">jjj<?php echo e($rdv->societe); ?></td>
					<td class=""><?php echo e($rdv->ville); ?></td>
					<td class=""><?php echo e($rdv->telephone); ?></td>
					<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->statut); ?></td>
					<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
				</tr>
			<?php endif; ?>
		<?php elseif(Auth::user()->statut == 'Responsable'): ?>
			<?php if(($rdv->client_id == Auth::user()->client_id) && ($rdv->statut <> 'Rendez-vous brut' && $rdv->statut <> 'Rendez-vous refusé')): ?>
				<tr>
					<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
					<td class=""><?php echo e($rdv->typerdv); ?></td>
					<td class=""><?php echo e($rdv->societe); ?></td>
					<td class=""><?php echo e($rdv->ville); ?></td>
					<td class=""><?php echo e($rdv->telephone); ?></td>
					<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->statut); ?></td>
					<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>
				</tr>
			<?php endif; ?>
		<?php elseif(Auth::user()->statut == 'Commercial'): ?>
			<?php if(($rdv->compte_id == Auth::user()->_id) && ($rdv->statut <> 'Rendez-vous brut' && $rdv->statut <> 'Rendez-vous refusé')): ?>
				<tr>
					<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
					<td class=""><?php echo e($rdv->typerdv); ?></td>
					<td class=""><?php echo e($rdv->societe); ?></td>
					<td class=""><?php echo e($rdv->ville); ?></td>
					<td class=""><?php echo e($rdv->telephone); ?></td>
					<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->statut); ?></td>
					<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
					<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>
				</tr>
			<?php endif; ?>
		<?php elseif(Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff'): ?>
        <tr>
			<td class=""><?php echo e(substr($rdv->_id,3,-16)); ?></td>
			<td class=""><?php echo e($rdv->centreappel_societe); ?></td>
			<td class=""><?php echo e($rdv->user_prenom); ?> <?php echo e($rdv->user_nom); ?></td>
			<td class=""><?php echo e($rdv->cli); ?></td>
			<td class=""><?php echo e($rdv->nom); ?></td>
			<td class=""><?php echo e($rdv->prenom); ?></td>
			<td class=""><?php echo e($rdv->societe); ?></td>
			<td class=""><?php echo e($rdv->adresse); ?></td>
			<td class=""><?php echo e($rdv->cp); ?></td>
			<td class=""><?php echo e($rdv->ville); ?></td>
			<td class=""><?php echo e($rdv->telephone); ?></td>
			<td class=""><?php echo e($rdv->mobile); ?></td>
			<td class=""><?php echo e($rdv->email); ?></td>
			<td class=""><?php echo e($rdv->activitesociete); ?></td>
			<td class=""><?php echo e($rdv->question_1); ?></td>
			<td class=""><?php echo e($rdv->question_2); ?></td>
			<td class=""><?php echo e($rdv->question_3); ?></td>
			<td class=""><?php echo e($rdv->question_4); ?></td>
			<td class=""><?php echo e($rdv->question_5); ?></td>
			<td class=""><?php echo e($rdv->surface_total_societe); ?></td>
			<td class=""><?php echo e($rdv->surface_bureau); ?></td>
			<td class=""><?php echo e($rdv->sous_contrat); ?></td>
			<td class=""><?php echo e($rdv->date_anniversaire_contrat); ?></td>
			<td class=""><?php echo e($rdv->protectionsociale); ?></td>
			<td class=""><?php echo e($rdv->mutuellesante); ?></td>
			<td class=""><?php echo e($rdv->mutuelle_entreprise); ?></td>
			<td class=""><?php echo e($rdv->nom_mutuelle); ?></td>
			<td class=""><?php echo e($rdv->montant_mutuelle_actuelle); ?></td>
			<td class=""><?php echo e($rdv->seul_sur_contrat); ?></td>
			<td class=""><?php echo e($rdv->montant_impots_annuel); ?></td>
			<td class=""><?php echo e($rdv->taux_endettement); ?></td>
			<td class=""><?php echo e($rdv->age); ?></td>
			<td class=""><?php echo e($rdv->profession); ?></td>
			<td class=""><?php echo e($rdv->proprietaireoulocataire); ?></td>
			<td class=""><?php echo e($rdv->statut_matrimonial); ?></td>
			<td class=""><?php echo e($rdv->composition_foyer); ?></td>
			<td class=""><?php echo e($rdv->nomprenomcontact); ?></td>
			<td class=""><?php echo e($rdv->nom_personne_rendezvous); ?></td>
			<td class=""><?php echo e($rdv->statut); ?></td>
			<td class=""><?php echo e($rdv->date_rendezvous); ?></td>
			<td class=""><?php echo e($rdv->heure_rendezvous); ?></td>
			<td class=""><?php echo e($rdv->client_prenompriv); ?> <?php echo e($rdv->client_nompriv); ?></td>
			<td class=""><?php echo e($rdv->note); ?></td>
			<td class=""><?php echo e($rdv->notestaff); ?></td>
        </tr>
		<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/public/test/crm/resources/views/exports/rdvs.blade.php ENDPATH**/ ?>