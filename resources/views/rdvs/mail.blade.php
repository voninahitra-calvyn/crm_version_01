	<h1>{{ $rdv->cli }}</h1>
<ul>	
	<li><b>Statut :</b>{{ $rdv->statut }}</li> </br>
@if ($client->service=='Défiscalisation' OR $client->service=='Mutuelle santé sénior')
	<li><b>Nom :</b> {{ $rdv->nom }}</li> </br>
	<li><b>Prenom :</b>{{ $rdv->prenom }}</li> </br>
@endif
@if ($client->service!='Défiscalisation' && $client->service!='Mutuelle santé sénior')
	<li><b>Société :</b>{{ $rdv->societe }}</li> </br>
@endif
	<li><b>Adresse :</b>{{ $rdv->adresse }}</li> </br>
	<li><b>Code postal :</b>{{ $rdv->cp }}</li> </br>
	<li><b>Ville :</b>{{ $rdv->ville }}</li> </br>
	<li><b>Téléphone :</b>{{ $rdv->telephone }}</li> </br>
	<li><b>Mobile :</b>{{ $rdv->mobile }}</li> </br>
	<li><b>Email :</b>{{ $rdv->email }}</li> </br>
@if ($client->service=='Autres')
	<li><b>Question 1 :</b>{{ $rdv->question_1 }}</li> </br>
	<li><b>Question 2 :</b>{{ $rdv->question_2 }}</li> </br>
	<li><b>Question 3 :</b>{{ $rdv->question_3 }}</li> </br>
	<li><b>Question 4 :</b>{{ $rdv->question_4 }}</li> </br>
	<li><b>Question 5 :</b>{{ $rdv->question_5 }}</li> </br>
@endif
@if ($client->service=='Nettoyage pro')
	<li><b>Surface total société :</b>{{ $rdv->surface_total_societe }}</li> </br>
	<li><b>Surface de bureau :</b>{{ $rdv->surface_bureau }}</li> </br>
	<li><b>Sous contrat :</b>{{$rdv->sous_contrat}}
	<li><b>Date anniversaire du contrat: {{ $rdv->date_anniversaire_contrat }}</li> </br>
@endif
@if (($client->service!='Nettoyage pro') && ($client->service!='Autres'))
	<li><b>Age :</b>{{ $rdv->age }}</li> </br>
@endif
@if ($client->service=='Mutuelle santé sénior')
	<li><b>Mutuelle entreprise :</b>{{ $rdv->mutuelle_entreprise }}</li> </br>
	<li><b>Nom de sa mutuelle :</b>{{ $rdv->nom_mutuelle }}</li> </br>
	<li><b>Montant de la mutuelle actuelle :</b>{{ $rdv->montant_mutuelle_actuelle }}</li> </br>
	<li><b>Seul sur le contrat :</b>{{ $rdv->seul_sur_contrat }}</li> </br>
@endif
@if ($client->service=='Défiscalisation')
	<li><b>Montant impot annuel :</b>{{ $rdv->montant_impots_annuel }}</li> </br>
	<li><b>Taux endettement :</b>{{ $rdv->taux_endettement }}</li> </br>
@endif
@if ($client->service=='Défiscalisation' OR $client->service=='Mutuelle santé sénior')
	<li><b>Statut matrimonial :</b>{{ $rdv->statut_matrimonial }}</li> </br>
	<li><b>Composition foyer :</b>{{ $rdv->composition_foyer }}</li> </br>
@endif
	<li><b>Date rendez-vous :</b>{{ $rdv->date_rendezvous }}</li> </br>
	<li><b>Heure rendez-vous :</b>{{ $rdv->heure_rendezvous }}</li></li> </br>
@if ($client->service!='Défiscalisation' && $client->service!='Mutuelle santé sénior')
	<li><b>Nom de la personne qui sera la pendent le rendez-vous :</b>{{ $rdv->nom_personne_rendezvous }}</li> </br>
@endif
	<li><b>Note :</b>{{ $rdv->note }}</li> </br>
</ul>
Vous pouvez voir les détails <a href="http://127.0.0.1:8000/rdvs/5e554ad0001500001b00147d/edit">ici</a>