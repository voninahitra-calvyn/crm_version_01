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
			<th><b>Société</b></th>
			<th><b>Ville</b></th>
			<th><b>Téléphone</b></th>
			<th><b>Nom de la personne au rendez-vous</b></th>
			<th><b>Qualification</b></th>
			<th><b>Date rendez-vous</b></th>
			<th><b>Heure rendez-vous</b></th>
			<th><b>Rendez-vous pour</b></th>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\crm\resources\views/exports/rdvs.blade.php ENDPATH**/ ?>