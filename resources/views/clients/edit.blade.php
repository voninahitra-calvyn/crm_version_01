@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
	<li><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client</a></li>
	<li class="active">Modification</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification centre d'appel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('clients.update', [$client]) }}"  enctype="multipart/form-data">
				@csrf
				@method('PUT')
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
				
				{{ csrf_field() }}
                <!--
				@if ($errors->any())
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
                @endif
				-->
				<div class="box-body">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#condidentielles" data-toggle="tab">Informations condidentielles</a></li>
							<li><a href="#publiques" data-toggle="tab">informations publiques</a></li>
						</ul>
						<div class="tab-content">
							<div class="active tab-pane" id="condidentielles">
								<div class="form-group">
									<label for="nom" class="col-sm-2 control-label">ID : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="{{ substr($client->_id,3,-16) }}" disabled>
									</div>
								</div>
								<div class="form-group " id="">
									<label for="logo" class="col-sm-2 control-label">logo : </label>
									<div class="col-sm-10">

										<div class="col-sm-2">
											<img id="ok_imagecli" class="img-responsive img-circle image_form" src="{{ asset('/uploads/logo')}}/{{ $client->logo }}" controls></img>
										</div>

										<div class="btn btn-primary btn-file  logo">
											<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
											<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
											<input type="file" id="logoInputfileclient" name="logoInputfileclient"   accept="image/*"/>
										</div>

										<input type="hidden" id="is_logos" name="is_logos" value="Non" />
										<input type="hidden" id="hidden_logoclit" name="hidden_logocli" value="{{$client->logo}}" />
										<input type="hidden" id="hidden_logosclit1" name="hidden_logoscli1" value="{{$client->logo}}" />
										<button class="btn btn-primary btn-xs hidden" id="btnmodiflogocli" name="btnmodiflogocli" type="submit"><i class="fa fa-edit"></i> Modifier logo</button>
										<button type="submit" id="btnmodifautreinfo" class="btn btn-success logo hidden"><i class="fa fa-check"></i> Valider</button>
										<button id="btnsupprimer" type="submit" class="btn btn-danger logo"><i class="fa fa-trash"></i> Supprimer</button>
									</div>
								</div>
								<div class="form-group">
									<label for="societe" class="col-sm-2 control-label">Société : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="{{ $client->societe }}">
									</div>
								</div>
								<div class="form-group">
									<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="{{ $client->adresse }}">
									</div>
								</div>
								<div class="form-group">
									<label for="cp" class="col-sm-2 control-label">Cp : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="cp" id="cp" placeholder="Cp" value="{{ $client->cp }}">
									</div>
								</div>
								<div class="form-group">
									<label for="ville" class="col-sm-2 control-label">Ville : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="{{ $client->ville }}">
									</div>
								</div>
								<div class="form-group">
									<label for="pays" class="col-sm-2 control-label">Pays : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays" value="{{ $client->pays }}">
									</div>
								</div>
								<div class="form-group">
									<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="{{ $client->telephone }}">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control text-lowercase" name="email" id="email" placeholder="Email" value="{{ $client->email }}">
									</div>
								</div>
								<div class="form-group">
									<label for="service" class="col-sm-2 control-label">Service : </label>
									<div class="col-sm-10">
										<select class="form-control select2" multiple="multiple" name="service[]" id="service" style="width: 100%;" required>
											<option value="Nettoyage pro" @foreach($client->service as $service) {{ ( $service == 'Nettoyage pro') ? 'selected' : '' }} @endforeach>Nettoyage pro</option>
											<option value="Assurance pro" @foreach($client->service as $service) {{ ( $service == 'Assurance pro') ? 'selected' : '' }} @endforeach>Assurance pro</option>
											<option value="Mutuelle santé sénior" @foreach($client->service as $service) {{ ( $service == 'Mutuelle santé sénior') ? 'selected' : '' }}@endforeach >Mutuelle santé sénior</option>
											<option value="Défiscalisation" @foreach($client->service as $service) {{ ( $service == 'Défiscalisation') ? 'selected' : '' }} @endforeach>Défiscalisation</option>
											<option value="Autres" @foreach($client->service as $service) {{ ( $service == 'Autres') ? 'selected' : '' }} @endforeach>Autres</option>
											<option value="Réception d'appels" @foreach($client->service as $service) {{ ( $service == 'Réception d\'appels') ? 'selected' : '' }} @endforeach>Réception d'appels</option>
											<option value="Demande de devis" @foreach($client->service as $service) {{ ( $service == 'Demande de devis') ? 'selected' : '' }} @endforeach>Demande de devis</option>
										</select>
										<!-- <select class="form-control select2" multiple="multiple" name="service[]" id="service" style="width: 100%;">
											<option value="Nettoyage pro" {{ ( $client->service == 'Nettoyage pro') ? 'selected' : '' }}>Nettoyage pro</option>
											<option value="Assurance pro" {{ ( $client->service == 'Assurance pro') ? 'selected' : '' }} >Assurance pro</option>
											<option value="Mutuelle santé sénior" {{ ( $client->service == 'Mutuelle santé sénior') ? 'selected' : '' }} >Mutuelle santé sénior</option>
											<option value="Défiscalisation"  {{ ( $client->service == 'Défiscalisation') ? 'selected' : '' }} >Défiscalisation</option>
											<option value="Autres" {{ ( $client->service == 'Autres') ? 'selected' : '' }} >Autres</option>
										</select> -->
									</div>
								</div>
					
							</div>
							<div class="active tab-pane" id="publiques">
								<div class="form-group">
									<label for="societe2" class="col-sm-2 control-label">Société : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="societe2" id="societe2" placeholder="Société" value="{{ $client->societe2 }}">
									</div>
								</div>
								<div class="form-group">
									<label for="note" class="col-sm-2 control-label">Note : </label>
									<div class="col-sm-10">
									  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $client->note }}</textarea>
									</div>
								</div>
								@if (Auth::user()->statut == 'Administrateur')
									<div class="form-group">
										<label for="etat" class="col-sm-2 control-label">Etat : {{--$rdv->typerdv--}}</label>
										<div class="col-sm-10">
											<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
												@if($client->etat == "Actif" or $client->etat == '')
													<option value="Actif">Activé</option>
													<option value="Inactif">Désactivé</option>
												@else
													<option value="Inactif">Désactivé</option>
													<option value="Actif">Activé</option>
												@endif
											</select>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
					


					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-primary pull-right">Valider</button>
						</div>
					</div>
					
				</div>
			</form>
	
		</div>      
    </section>
@endsection

