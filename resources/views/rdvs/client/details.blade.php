@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Détails rendez-vous ')

@section('contentheader_levelactive')
<li><a href=""><i class="fa fa-dashboard"></i>Rendez-vous </a></li>
<li class="active">Détails</li>
@overwrite


@section('main-content')
<!-- Main content -->
<section class="content">
    <div class="box box-danger">
        <form class="form-horizontal" method="post" action="{{ route('rdvs.update', $rdv->id) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">



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
                <!-- <input type="text" class="form-control hidden" value="{{--$client->_id--}}" name="client_id" id="client_id"> -->
                <!-- <div class="form-group">
                    <label for="cli" class="col-sm-2 control-label">Nom du client : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $rdv->client_nompriv }} {{ $rdv->client_prenompriv }}" name="nomcli" id="nomcli" disabled>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="cli" class="col-sm-2 control-label">Client : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $rdv->client_societe }}" name="cli" id="cli" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="typerdv" class="col-sm-2 control-label">Service : {{--$rdv->typerdv--}}</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control"  name="typerdv" id="typerdv" value="" > -->
                        <!-- <textarea class="form-control" rows="1" name="typerdv" id="typerdv" >{{--$client->service--}}</textarea> -->
                        <!-- <select class="form-control select2" multiple="multiple" name="typerdv[]" id="typerdv" style="width: 100%;" disabled> -->
                        <select class="form-control select2" name="typerdv" id="typerdv" style="width: 100%;" disabled>
							@foreach($client->service as $service)
                            <option value="{{$service}}" {{ ( $rdv->typerdv == $service) ? 'selected' : '' }}>{{$service}}</option>
							@endforeach
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
                        <select class="form-control selecttype" name="statut" id="statut" style="width: 100%;" @if (Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff') disabled @endif>
                            <option value="Rendez-vous brut" {{ ( $rdv->statut == "Rendez-vous brut") ? 'selected' : '' }}>Rendez-vous brut</option>
                            <option value="Rendez-vous refusé" {{ ( $rdv->statut == "Rendez-vous refusé") ? 'selected' : '' }}>Rendez-vous refusé</option>
                            <option value="Rendez-vous envoyé" {{ ( $rdv->statut == "Rendez-vous envoyé") ? 'selected' : '' }}>Rendez-vous envoyé</option>
                            <option value="Rendez-vous confirmé" {{ ( $rdv->statut == "Rendez-vous confirmé") ? 'selected' : '' }}>Rendez-vous confirmé</option>
                            <option value="Rendez-vous annulé" {{ ( $rdv->statut == "Rendez-vous annulé") ? 'selected' : '' }}>Rendez-vous annulé</option>
                            <option value="Rendez-vous en attente" {{ ( $rdv->statut == "Rendez-vous en attente") ? 'selected' : '' }}>Rendez-vous en attente</option>
                            <option value="Rendez-vous validé" {{ ( $rdv->statut == "Rendez-vous validé") ? 'selected' : '' }}>Rendez-vous validé</option>
                        </select>
                    </div>
                </div>
						<div id="groupnomprenom">
							<div class="form-group">
								<label for="nom" class="col-sm-2 control-label">Nom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="{{ $rdv->nom }}" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{ $rdv->prenom }}" disabled>
								</div>
							</div>
						</div>
						<div class="form-group" id="groupsociete">
							<label for="societe" class="col-sm-2 control-label">Société : </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="{{ $rdv->societe }}"  disabled>
							</div>
						</div>
                <div id="groupautre1">
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="{{ $rdv->adresse }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Code postal : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="cp" id="cp" placeholder="Code postal" value="{{ $rdv->cp }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="{{ $rdv->ville }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="{{ $rdv->telephone }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="mobile" class="col-sm-2 control-label">Mobile : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile" value="{{ $rdv->mobile }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $rdv->email }}"  disabled>
						</div>
					</div>
				</div>

					<div id="groupquestion">
					<div class="form-group">
						<label for="question_1" class="col-sm-2 control-label">Question 1 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_1" id="question_1" placeholder="Question 1" value="{{ $rdv->question_1 }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_2" class="col-sm-2 control-label">Question 2 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_2" id="question_2" placeholder="Question 2" value="{{ $rdv->question_2 }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_3" class="col-sm-2 control-label">Question 3 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_3" id="question_1" placeholder="Question 3" value="{{ $rdv->question_3 }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_4" class="col-sm-2 control-label">Question 4 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_4" id="question_4" placeholder="Question 4" value="{{ $rdv->question_4 }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="question_5" class="col-sm-2 control-label">Question 5 : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="question_5" id="question_5" placeholder="Question 5" value="{{ $rdv->question_5 }}" disabled>
						</div>
					</div>
					</div>

					<div id="groupnetoyagepro">
					<div class="form-group">
						<label for="surface_total_societe" class="col-sm-2 control-label">Surface total société : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="surface_total_societe" id="surface_total_societe" placeholder="Surface total société" value="{{ $rdv->surface_total_societe }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="surface_bureau" class="col-sm-2 control-label">Surface de bureau : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="surface_bureau" id="surface_bureau" placeholder="Surface de bureau" value="{{ $rdv->surface_bureau }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="sous_contrat" class="col-sm-2 control-label">Sous contrat : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="sous_contrat" id="sous_contrat" value="{{ $rdv->sous_contrat }}" style="width: 100%;" disabled>
								<option selected="selected">Oui</option>
								<option selected="selected">Non</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="date_anniversaire_contrat" class="col-sm-2 control-label">Date anniversaire du contrat: </label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="text" class="form-control" name="date_anniversaire_contrat" id="date_anniversaire_contrat" placeholder="dd/mm/yyyy" value="{{ $rdv->date_anniversaire_contrat }}" disabled>
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
							<input type="text" class="form-control" name="age" id="age" placeholder="Age"  disabled value="{{ $rdv->age }}">
						</div>
					</div>

					<div id="groupmutuel">
					<div class="form-group">
						<label for="mutuelle_entreprise" class="col-sm-2 control-label">Mutuelle entreprise : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="mutuelle_entreprise" id="mutuelle_entreprise" style="width: 100%;" disabled value="{{ $rdv->mutuelle_entreprise }}">
								<option selected="selected">Oui</option>
								<option selected="selected">Non</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="nom_mutuelle" class="col-sm-2 control-label">Nom de sa mutuelle : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="nom_mutuelle" id="nom_mutuelle" placeholder="Nom de sa mutuelle" disabled value="{{ $rdv->nom_mutuelle }}">
						</div>
					</div>
					<div class="form-group">
						<label for="montant_mutuelle_actuelle" class="col-sm-2 control-label">Montant de la mutuelle actuelle : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="montant_mutuelle_actuelle" id="montant_mutuelle_actuelle" placeholder="Montant de la mutuelle actuelle" disabled value="{{ $rdv->montant_mutuelle_actuelle }}">
						</div>
					</div>
					<div class="form-group">
						<label for="seul_sur_contrat" class="col-sm-2 control-label">Seul sur le contrat : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="seul_sur_contrat" id="seul_sur_contrat" style="width: 100%;" disabled value="{{ $rdv->seul_sur_contrat }}">
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
							<input type="text" class="form-control" name="montant_impots_annuel" id="montant_impots_annuel" placeholder="Montant impot annuel" disabled value="{{ $rdv->montant_impots_annuel }}">
						</div>
					</div>
					<div class="form-group">
						<label for="taux_endettement" class="col-sm-2 control-label">Taux endettement : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="taux_endettement" id="taux_endettement" placeholder="Taux endettement" disabled value="{{ $rdv->taux_endettement }}">
						</div>
					</div>
					</div>
				<div id="groupstatutfoyer">
					<div class="form-group">
						<label for="statut_matrimonial" class="col-sm-2 control-label">Statut matrimonial : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut_matrimonial" id="statut_matrimonial" style="width: 100%;" disabled value="{{ $rdv->statut_matrimonial }}">
								<option value="Celibataire" {{ ( $rdv->statut_matrimonial == "Celibataire") ? 'selected' : '' }}>Celibataire</option>
								<option value="Marié" {{ ( $rdv->statut_matrimonial == "Marié") ? 'selected' : '' }}>Marié</option>
								<option value="Veuf" {{ ( $rdv->statut_matrimonial == "Veuf") ? 'selected' : '' }}>Veuf</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="composition_foyer" class="col-sm-2 control-label">Composition foyer : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="composition_foyer" id="composition_foyer" placeholder="Composition foyer" disabled value="{{ $rdv->composition_foyer }}">
						</div>
					</div>
				</div>
                <div id="groupautre2">
                <div class="form-group">
                    <label for="date_rendezvous" class="col-sm-2 control-label">Date rendez-vous : </label>
                    <div class="col-sm-10">
						
                        <div class="input-group">
                            <!-- <input type="text" class="form-control" name="date_rendezvous" data-date-format="mm-dd-yyyy" id="date_rendezvous" placeholder="dd-mm-yyyy" value={{ $rdv->date_rendezvous }}> -->
                            <input type="text" class="form-control" name="date_rendezvous" id="date_rendezvous" placeholder="dd-mm-yyyy" disabled value="{{ $rdv->date_rendezvous }}">
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
                            <input type="text" class="form-control" name="heure_rendezvous" id="heure_rendezvous" placeholder="Heure rendez-vous" disabled value="{{ $rdv->heure_rendezvous }}">
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
							<input type="text" class="form-control" name="nom_personne_rendezvous" id="nom_personne_rendezvous" placeholder="Nom de la personne qui sera la pendent le rendez-vous" disabled value="{{ $rdv->nom_personne_rendezvous }}">
						</div>
					</div>
				
					<div class="form-group" id="grouppersrdv">
						<label for="rendezvous_pour" class="col-sm-2 control-label">Rendez-vous pour : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="rendezvous_pour" id="rendezvous_pour" disabled value="{{$rdv->client_prenompriv}} {{$rdv->client_nompriv}}">
						</div>
					</div>
					
                <div class="form-group" id="groupautre3">
                    <label for="note" class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note" disabled>{{ $rdv->note }}</textarea>
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
@endsection
</script>