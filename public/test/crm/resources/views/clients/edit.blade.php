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
            <form class="form-horizontal" method="post" action="{{ route('clients.update', [$client]) }}">
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
									  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $client->email }}">
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

