@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Ajout rendez-vous ')

@section('contentheader_levelactive')
	<li><a href="{{ route('rdvs.defiscalisation')}}"><i class="fa fa-dashboard"></i>Rendez-vous </a></li>
	<li class="active">Ajout</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <form class="form-horizontal" method="GET" action="{{ route('rdvs.storerdv') }}">
			
			
                 
				@if ($errors->any())
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
					<div class="alert-danger-liste">
						<ul>
							@foreach ($errors->all() as $error)
							  <li>{{ $error }}</li>
							@endforeach
						</ul>
					</div><br />
                @endif
				
                {!! csrf_field() !!}
				<div class="box-body">
					<input type="text" class="form-control hidden" value="{{$client->_id}}" name="client_id" id="client_id">
					<input type="text" class="form-control hidden" value="{{$compte->_id}}" name="compte_id" id="compte_id">
					<!-- <input type="text" class="form-control hidden" value="Défiscalisation" name="typerdv" id="typerdv" placeholder="Nom"> -->
					<!-- <input type="text" class="form-control " value="{{$client->service}}" name="typerdv" id="typerdv" placeholder="Nom"> -->
					<div class="form-group">
						<label for="cli" class="col-sm-2 control-label">Client : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="cli" id="cli" style="width: 100%;">
								<option selected="selected">{{$compte->nom}} {{$compte->prenom}} ({{$client->societe2}})</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="typerdv" class="col-sm-2 control-label">Service : </label>
						<div class="col-sm-10">
						  <!-- <input type="text" class="form-control"  name="typerdv" id="typerdv" value="" > -->
						  <!-- <textarea class="form-control" rows="1" name="typerdv" id="typerdv" >{{$client->service}}</textarea> -->
							<select class="form-control selecttype" name="typerdv" id="typerdv" style="width: 100%;">
								<option selected="selected">{{$client->service}}</option>
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
					@if ($client->service=='Défiscalisation' OR $client->service=='Mutuelle santé sénior')
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom">
						</div>
					</div>
					@endif
					@if ($client->service!='Défiscalisation' && $client->service!='Mutuelle santé sénior')
					<div class="form-group">
						<label for="societe" class="col-sm-2 control-label">Société : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société">
						</div>
					</div>
					@endif
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
						  <input type="text" class="form-control" name="email" id="email" placeholder="Email" >
						</div>
					</div>
					@if ($client->service=='Autres')
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
					@endif
					@if ($client->service=='Nettoyage pro')
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
					@endif
					@if (($client->service!='Nettoyage pro') && ($client->service!='Autres'))
					<div class="form-group">
						<label for="age" class="col-sm-2 control-label">Age : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="age" id="age" placeholder="Age" >
						</div>
					</div>
					@endif
					@if ($client->service=='Mutuelle santé sénior')
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
					@endif
					@if ($client->service=='Défiscalisation')
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
					@endif
					@if ($client->service=='Défiscalisation' OR $client->service=='Mutuelle santé sénior')
					<div class="form-group">
						<label for="statut_matrimonial" class="col-sm-2 control-label">Statut matrimonial : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut_matrimonial" id="statut_matrimonial" style="width: 100%;">
								<option selected="selected">Celibataire</option>
								<option selected="selected">Marié</option>
								<option selected="selected">Veuf</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="composition_foyer" class="col-sm-2 control-label">Composition foyer : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="composition_foyer" id="composition_foyer" placeholder="Composition foyer" >
						</div>
					</div>
					@endif
					<div class="form-group">
						<label for="date_rendezvous" class="col-sm-2 control-label">Date rendez-vous : </label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" name="date_rendezvous" id="date_rendezvous" placeholder="dd/mm/yyyy" >
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
								<input type="text" class="form-control" name="heure_rendezvous" id="heure_rendezvous" placeholder="Heure rendez-vous" >
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
					@if ($client->service!='Défiscalisation' && $client->service!='Mutuelle santé sénior')
					<div class="form-group">
						<label for="nom_personne_rendezvous" class="col-sm-2 control-label">Nom de la personne qui sera la pendent le rendez-vous : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom_personne_rendezvous" id="nom_personne_rendezvous" placeholder="Nom de la personne qui sera la pendent le rendez-vous" >
						</div>
					</div>
					@endif
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"></textarea>
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
@endsection

<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //Date picker
    $('#date_rendezvous').datepicker({
      autoclose: true
    })

  })
</script>
