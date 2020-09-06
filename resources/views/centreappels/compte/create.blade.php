@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte centre d\'appels')

@section('contentheader_levelactive')
	<li><a href="{{ route('centreappels.index')}}"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li><a href="{{route('centreappels.compte', [$idcentreappel])}}">Compte</a></li>
	<li class="active">Ajout</li>
@overwrite


@section('main-content')
	@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur')
		<!-- Main content -->
		<section class="content">
			<div class="box box-danger">
				<div class="box-header with-border">
					<h3 class="box-title form">Ajout compte</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form class="form-horizontal" method="POST" action="{{ route('centreappels.storecompte', [$idcentreappel]) }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="GET">
					 
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
						<div class="form-group">
							<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" >
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email : </label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="email" id="email" placeholder="Email" >
							</div>
						</div>
						<div class="form-group @if (Auth::user()->statut <> 'Administrateur'  && Auth::user()->statut <> 'Superviseur') hidden @endif">
							<label for="password" class="col-sm-2 control-label">Mot de passe : </label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" >
							</div>
						</div>
						<div class="form-group @if (Auth::user()->statut <> 'Administrateur'  && Auth::user()->statut <> 'Superviseur') hidden @endif">
							<label for="statut" class="col-sm-2 control-label">Statut : </label>
							<div class="col-sm-10">
								<select class="form-control selecttype" name="statut" style="width: 100%;">
									<option selected="selected" class="@if (Auth::user()->statut <> 'Administrateur') hidden @endif">Superviseur</option>
									<option selected="selected">Agent</option>
								</select>
							</div>
						</div>
						<div class="form-group " id="">
							<label for="audio" class="col-sm-2 control-label">Audio : </label>
							<div class="col-sm-8">
								<input class="form-control col-sm-10" id="hidden_audio" name="hidden_audio" value="Aucun fichier sélectionné." disabled />
							</div>
							<div class="col-sm-2">
								<div class="btn btn-danger btn-file  audio">
									<input type="file" id="audioInputfile" name="audioInputfile" accept="audio/*"/>Parcourir...
								</div>
							</div>
						</div>  
						<div class="form-group">
								<label for="note" class="col-sm-2 control-label">Note : </label>
								<div class="col-sm-10">
								  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"></textarea>
								</div>
						</div>
						<div class="form-group @if (Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff') hidden @endif" id="">
							<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
							<div class="col-sm-10">
							  <textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle"></textarea>
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
	@else
		<div class="error-page droit">
			<h2 class="headline text-yellow">Erreur  </h2>

			<div class="error-content">
				<h3><i class="fa fa-warning text-yellow"></i> Vous n'avez pas le droit d'accéder à cette page.</h3>
			</div>
		</div>
	@endif
@endsection

