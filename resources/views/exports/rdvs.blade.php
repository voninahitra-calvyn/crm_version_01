<table>
    <thead>
		@if (Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent')
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
		@elseif (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
		<tr style="font-weight:bold;">
			<th class="hidden"><b>Référence</b></th>
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
							
		@elseif (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial')
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
		@endif	
    </thead>
    <tbody>
    @foreach($rdvs as $rdv)
		@if (Auth::user()->statut == 'Superviseur')
			@if ($rdv->id_groupe == Auth::user()->centreappel_id)
				<tr class="">
					<td class="">{{ substr($rdv->_id,3,-16) }}</td>
					<td class="">{{$rdv->cli}}</td>
					<td class="">{{$rdv->societe}}</td>
					<td class="">{{$rdv->ville}}</td>
					<td class="">{{$rdv->telephone}}</td>
					<td class="">{{$rdv->nom_personne_rendezvous}}</td>
					<td class="">{{$rdv->statut}}</td>
					<td class="">{{$rdv->date_rendezvous}}</td>
					<td class="">{{$rdv->heure_rendezvous}}</td>
				</tr>
			@endif
		@elseif (Auth::user()->statut == 'Agent')
			@if ($rdv->user_id == Auth::user()->_id)
				<tr>
					<td class="">{{ substr($rdv->_id,3,-16) }}</td>
					<td class="">{{$rdv->cli}}</td>
					<td class="">jjj{{$rdv->societe}}</td>
					<td class="">{{$rdv->ville}}</td>
					<td class="">{{$rdv->telephone}}</td>
					<td class="">{{$rdv->nom_personne_rendezvous}}</td>
					<td class="">{{$rdv->statut}}</td>
					<td class="">{{$rdv->date_rendezvous}}</td>
					<td class="">{{$rdv->heure_rendezvous}}</td>
				</tr>
			@endif
		@elseif (Auth::user()->statut == 'Responsable')
			@if (($rdv->client_id == Auth::user()->client_id) && ($rdv->statut <> 'Rendez-vous brut' && $rdv->statut <> 'Rendez-vous refusé'))
				<tr>
					<td class="">{{ substr($rdv->_id,3,-16) }}</td>
					<td class="">{{$rdv->typerdv}}</td>
					<td class="">{{$rdv->societe}}</td>
					<td class="">{{$rdv->ville}}</td>
					<td class="">{{$rdv->telephone}}</td>
					<td class="">{{$rdv->nom_personne_rendezvous}}</td>
					<td class="">{{$rdv->statut}}</td>
					<td class="">{{$rdv->date_rendezvous}}</td>
					<td class="">{{$rdv->heure_rendezvous}}</td>
					<td class="">{{$rdv->client_prenompriv}} {{$rdv->client_nompriv}}</td>
				</tr>
			@endif
		@elseif (Auth::user()->statut == 'Commercial')
			@if (($rdv->compte_id == Auth::user()->_id) && ($rdv->statut <> 'Rendez-vous brut' && $rdv->statut <> 'Rendez-vous refusé'))
				<tr>
					<td class="">{{ substr($rdv->_id,3,-16) }}</td>
					<td class="">{{$rdv->typerdv}}</td>
					<td class="">{{$rdv->societe}}</td>
					<td class="">{{$rdv->ville}}</td>
					<td class="">{{$rdv->telephone}}</td>
					<td class="">{{$rdv->nom_personne_rendezvous}}</td>
					<td class="">{{$rdv->statut}}</td>
					<td class="">{{$rdv->date_rendezvous}}</td>
					<td class="">{{$rdv->heure_rendezvous}}</td>
					<td class="">{{$rdv->client_prenompriv}} {{$rdv->client_nompriv}}</td>
				</tr>
			@endif
		@elseif (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
        <tr>
			<td class="hidden">{{ substr($rdv->_id,3,-16) }}</td>
			<td class="">{{$rdv->centreappel_societe}}</td>
			<td class="">{{$rdv->user_prenom}} {{$rdv->user_nom}}</td>
			<td class="">{{$rdv->cli}}</td>
			<td class="">{{$rdv->nom}}</td>
			<td class="">{{$rdv->prenom}}</td>
			<td class="">{{$rdv->societe}}</td>
			<td class="">{{$rdv->adresse}}</td>
			<td class="">{{$rdv->cp}}</td>
			<td class="">{{$rdv->ville}}</td>
			<td class="">{{$rdv->telephone}}</td>
			<td class="">{{$rdv->mobile}}</td>
			<td class="">{{$rdv->email}}</td>
			<td class="">{{$rdv->activitesociete}}</td>
			<td class="" >{{$rdv->question_1}}</td>
			<td class="" >{{$rdv->question_2}}</td>
			<td class="">{{$rdv->question_3}}</td>
			<td class="">{{$rdv->question_4}}</td>
			<td class="">{{$rdv->question_5}}</td>
			<td class="">{{$rdv->surface_total_societe}}</td>
			<td class="">{{$rdv->surface_bureau}}</td>
			<td class="">{{$rdv->sous_contrat}}</td>
			<td class="">{{$rdv->date_anniversaire_contrat}}</td>
			<td class="">{{$rdv->protectionsociale}}</td>
			<td class="">{{$rdv->mutuellesante}}</td>
			<td class="">{{$rdv->mutuelle_entreprise}}</td>
			<td class="">{{$rdv->nom_mutuelle}}</td>
			<td class="">{{$rdv->montant_mutuelle_actuelle}}</td>
			<td class="">{{$rdv->seul_sur_contrat}}</td>
			<td class="">{{$rdv->montant_impots_annuel}}</td>
			<td class="">{{$rdv->taux_endettement}}</td>
			<td class="">{{$rdv->age}}</td>
			<td class="">{{$rdv->profession}}</td>
			<td class="">{{$rdv->proprietaireoulocataire}}</td>
			<td class="">{{$rdv->statut_matrimonial}}</td>
			<td class="">{{$rdv->composition_foyer}}</td>
			<td class="">{{$rdv->nomprenomcontact}}</td>
			<td class="">{{$rdv->nom_personne_rendezvous}}</td>
			<td class="">{{$rdv->statut}}</td>
			<td class="">{{$rdv->date_rendezvous}}</td>
			<td class="">{{$rdv->heure_rendezvous}}</td>
			<td class="">{{$rdv->client_prenompriv}} {{$rdv->client_nompriv}}</td>
			<td class="">{{$rdv->note}}</td>
			<td class="">{{$rdv->notestaff}}</td>
        </tr>
		@endif
    @endforeach
    </tbody>
</table>
