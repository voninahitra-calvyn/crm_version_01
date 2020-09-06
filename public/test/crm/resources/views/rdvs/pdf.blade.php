	
	<div class="form-group" style="margin-bottom:5px">
		<b>ID : </b> {{ substr($rdv->id,3,-16) }}
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Client : </b> {{ $rdv->cli }} 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Service : </b> {{ $rdv->typerdv }} 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Centre d’appels : </b> {{ $rdv->centreappel_societe }} 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Responsable/agent : </b> {{ $rdv->responsableagent }} 
	</div>
	<div class="form-group" style="margin-bottom:5px">
		<b>Qualification : </b> {{ $rdv->statut }} 
	</div>
	
	@if ($rdv->nom != '' && $rdv->nom != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Nom : </b> {{ $rdv->nom }} 
		</div>
	@endif
	
	@if ($rdv->prenom != '' && $rdv->prenom != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Prenom : </b> {{ $rdv->prenom }} 
		</div>
	@endif
	
	@if ($rdv->societe != '' && $rdv->societe != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Société : </b> {{ $rdv->societe }} 
		</div>
	@endif
	
	@if ($rdv->adresse != '' && $rdv->adresse != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Adresse : </b> {{ $rdv->adresse }} 
		</div>
	@endif
	
	@if ($rdv->cp != '' && $rdv->cp != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Code postal : </b> {{ $rdv->cp }} 
		</div>
	@endif
	
	@if ($rdv->ville != '' && $rdv->ville != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Ville : </b> {{ $rdv->ville }} 
		</div>
	@endif
	
	@if ($rdv->telephone != '' && $rdv->telephone != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Téléphone : </b> {{ $rdv->telephone }} 
		</div>
	@endif
	
	@if ($rdv->mobile != '' && $rdv->mobile != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Mobile : </b> {{ $rdv->mobile }} 
		</div>
	@endif
	
	@if ($rdv->email != '' && $rdv->email != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Email : </b> {{ $rdv->email }} 
		</div>
	@endif
	
	@if ($rdv->activitesociete != '' && $rdv->activitesociete != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Activité société : </b> {{ $rdv->activitesociete }} 
		</div>
	@endif
	
	@if ($rdv->question_1 != '' && $rdv->question_1 != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 1 : </b> {{ $rdv->question_1 }} 
		</div>
	@endif
	
	@if ($rdv->question_2 != '' && $rdv->question_2 != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 2 : </b> {{ $rdv->question_2 }} 
		</div>
	@endif
	
	@if ($rdv->question_3 != '' && $rdv->question_3 != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 3 : </b> {{ $rdv->question_3 }} 
		</div>
	@endif
	
	@if ($rdv->question_4 != '' && $rdv->question_4 != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 4 : </b> {{ $rdv->question_4 }} 
		</div>
	@endif
	
	@if ($rdv->question_5 != '' && $rdv->question_5 != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Question 5 : </b> {{ $rdv->question_5 }} 
		</div>
	@endif
	
	@if ($rdv->surface_total_societe != '' && $rdv->surface_total_societe != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Surface total société : </b> {{ $rdv->surface_total_societe }} 
		</div>
	@endif
	
	@if ($rdv->surface_bureau != '' && $rdv->surface_bureau != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Surface de bureau : </b> {{ $rdv->surface_bureau }} 
		</div>
	@endif
	
	@if($rdv->typerdv=="Nettoyage pro")
		@if ($rdv->sous_contrat != '' && $rdv->sous_contrat != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Sous contrat : </b> {{ $rdv->sous_contrat }} 
			</div>
		@endif
	@endif
	
	@if ($rdv->date_anniversaire_contrat != '' && $rdv->date_anniversaire_contrat != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Date anniversaire du contrat : </b> {{ $rdv->date_anniversaire_contrat }} 
		</div>
	@endif
	
	@if($rdv->typerdv=="Assurance pro")
		@if ($rdv->protectionsociale != '' && $rdv->protectionsociale != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Protection sociale : </b> {{ $rdv->protectionsociale }} 
			</div>
		@endif
	@endif
	
	@if($rdv->typerdv=="Assurance pro")
		@if ($rdv->mutuellesante != '' && $rdv->mutuellesante != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Mutuelle santé : </b> {{ $rdv->mutuellesante }} 
			</div>
		@endif
	@endif
	
	@if($rdv->typerdv=="Mutuelle santé sénior")
		@if ($rdv->mutuelle_entreprise != '' && $rdv->mutuelle_entreprise != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Mutuelle entreprise : </b> {{ $rdv->mutuelle_entreprise }} 
			</div>
		@endif
	@endif
	
	@if ($rdv->nom_mutuelle != '' && $rdv->nom_mutuelle != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Nom de sa mutuelle : </b> {{ $rdv->nom_mutuelle }} 
		</div>
	@endif
	
	@if ($rdv->montant_mutuelle_actuelle != '' && $rdv->montant_mutuelle_actuelle != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Montant de la mutuelle actuelle : </b> {{ $rdv->montant_mutuelle_actuelle }} 
		</div>
	@endif
	
	@if($rdv->typerdv=="Mutuelle santé sénior")
		@if ($rdv->seul_sur_contrat != '' && $rdv->seul_sur_contrat != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Seul sur le contrat : </b> {{ $rdv->seul_sur_contrat }} 
			</div>
		@endif
	@endif
	
	@if ($rdv->montant_impots_annuel != '' && $rdv->montant_impots_annuel != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Montant impot annuel : </b> {{ $rdv->montant_impots_annuel }} 
		</div>
	@endif
	
	@if ($rdv->taux_endettement != '' && $rdv->taux_endettement != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Taux endettement : </b> {{ $rdv->taux_endettement }} 
		</div>
	@endif
	
	@if($rdv->typerdv=="Mutuelle santé sénior")
		@if ($rdv->age != '' && $rdv->age != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Age : </b> {{ $rdv->age }} 
			</div>
		@endif
	@endif
	
	@if ($rdv->profession != '' && $rdv->profession != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Profession : </b> {{ $rdv->profession }} 
		</div>
	@endif
	
	@if ($rdv->proprietaireoulocataire != '' && $rdv->proprietaireoulocataire != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Propriétaire ou Locataire : </b> {{ $rdv->proprietaireoulocataire }} 
		</div>
	@endif
	
	@if($rdv->typerdv=="Défiscalisation")
		@if ($rdv->statut_matrimonial != '' && $rdv->statut_matrimonial != null)
			<div class="form-group" style="margin-bottom:5px">
				<b>Statut matrimonial : </b> {{ $rdv->statut_matrimonial }} 
			</div>
		@endif
	@endif
	
	@if ($rdv->composition_foyer != '' && $rdv->composition_foyer != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Composition foyer : </b> {{ $rdv->composition_foyer }} 
		</div>
	@endif
	
	@if ($rdv->date_rendezvous != '' && $rdv->date_rendezvous != null)
		<div class="form-group" style="margin-bottom:5px">
		@if (($rdv->typerdv == 'Réception d\'appels') || ($rdv->typerdv == 'Demande de devis')) 
			<b>Date du jour : </b> {{ $rdv->date_rendezvous }} 
		@else
			<b>Date rendez-vous : </b> {{ $rdv->date_rendezvous }}
		@endif
		</div>
	@endif
	
	@if ($rdv->heure_rendezvous != '' && $rdv->heure_rendezvous != null)
		<div class="form-group" style="margin-bottom:5px">
		@if (($rdv->typerdv == 'Réception d\'appels') || ($rdv->typerdv == 'Demande de devis')) 
			<b>Heure du jour : </b> {{ $rdv->heure_rendezvous }} 
		@else
			<b>Heure rendez-vous : </b> {{ $rdv->heure_rendezvous }}
		@endif
		</div>
	@endif
	
	@if ($rdv->nom_personne_rendezvous != '' && $rdv->nom_personne_rendezvous != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Nom de la personne qui sera la pendent le rendez-vous : </b> {{ $rdv->nom_personne_rendezvous }} 
		</div>
	@endif
	
	@if ($rdv->note != '' && $rdv->note != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Note : </b> {{ $rdv->note }} 
		</div>
	@endif
	
	@if ($rdv->notestaff != '' && $rdv->notestaff != null)
		<div class="form-group" style="margin-bottom:5px">
			<b>Note du Staff : </b> {{ $rdv->notestaff }} 
		</div>
	@endif
