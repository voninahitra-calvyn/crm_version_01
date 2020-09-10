@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
	<li><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client</a></li>
	<li class="active">Ajout</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Ajout client</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('clients.store') }}">
                 
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
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#condidentielles" data-toggle="tab">Informations condidentielles</a></li>
							<li><a href="#publiques" data-toggle="tab">informations publiques</a></li>
						</ul>
						<div class="tab-content">
							<div class="active tab-pane" id="condidentielles">
								<div class="form-group">
									<label for="societe" class="col-sm-2 control-label">Société : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société">
									</div>
								</div>
								<div class="form-group">
									<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
									</div>
								</div>
								<div class="form-group">
									<label for="cp" class="col-sm-2 control-label">Cp : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="cp" id="cp" placeholder="Cp">
									</div>
								</div>
								<div class="form-group">
									<label for="ville" class="col-sm-2 control-label">Ville : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
									</div>
								</div>
								<div class="form-group">
									<label for="pays" class="col-sm-2 control-label">Pays : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays">
									</div>
								</div>
								<div class="form-group">
									<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-2 control-label">Email : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="email" id="email"  placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<label for="service" class="col-sm-2 control-label "  >Service : </label>
									<div class="col-sm-10">
										<select class="form-control select2" name="service[]" multiple="multiple" id="service" style="width: 100%;" required>
											<option >Nettoyage pro</option>
											<option >Assurance pro</option>
											<option >Mutuelle santé sénior</option>
											<option >Défiscalisation</option>
											<option >Autres</option>
											<option >Réception d'appels</option>
											<option >Demande de devis</option>
										</select>
									</div>
								</div>
							</div>
							<div class="active tab-pane" id="publiques">
								<div class="form-group">
									<label for="societe2" class="col-sm-2 control-label">Société : </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" name="societe2" id="societe2" placeholder="Société">
									</div>
								</div>
								<div class="form-group">
									<label for="note" class="col-sm-2 control-label">Note : </label>
									<div class="col-sm-10">
									  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"></textarea>
									</div>
								</div>

								@if (Auth::user()->statut == 'Administrateur')
									<div class="form-group">
										<label for="etat" class="col-sm-2 control-label">Etat : </label>
										<div class="col-sm-10">
											<!-- <select class="form-control select2" multiple="multiple" name="typerdv[]" id="typerdv" style="width: 100%;" > -->
											<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
												<option value="Actif">Activé</option>
												<option value="Inactif">Désactivé</option>
											</select>
										</div>
									</div>
								@endif
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

