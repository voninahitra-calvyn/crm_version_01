<!-- resources\views\centreappels\compte\edit.blade.php -->

@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte centre d\'appels')

@section('contentheader_levelactive')
	<li><a href="{{ route('centreappels.index')}}"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li><a href="{{route('centreappels.compte', [$centreappel])}}">Compte</a></li>
	<li class="active">Modification</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
			<div class="row-fluid"><br>
				<div class="col-sm-12">
					<img id="ok_imageadd" class="img-responsive img-circle image_form" src="{{ asset('/uploads/logo') }}/{{ $logo->logo }}" controls></img>
				</div>
			</div>
            <div class="box-header with-border">
				<h3 class="box-title form">Modification compte</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('centreappels.updatecompte', [$compte]) }}" enctype="multipart/form-data">
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
				
				{{ csrf_field() }}
                <!--
				@if ($errors->any())
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
                @endif
				-->
				<div class="box-body">
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">ID : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="{{ substr($compte->_id,3,-16) }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="{{ $compte->nom }}">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{ $compte->prenom }}">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="{{ $compte->telephone }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control text-lowercase" name="email" id="email" placeholder="Email" value="{{ $compte->email }}">
						</div>
					</div>
					<div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif" >
						<label for="password" class="col-sm-2 control-label">Mot de passe : </label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
						</div>
					</div>
					<div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
						<label for="statut" class="col-sm-2 control-label">Statut : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut" style="width: 100%;">
								<option value="Superviseur" {{ ( $compte->statut == 'Superviseur') ? 'selected' : '' }}>Superviseur</option>
								<option value="Agent" {{ ( $compte->statut == 'Agent') ? 'selected' : '' }}>Agent</option>
							</select>
						</div>
					</div>
					<div class="form-group " id="">
						<label for="audio" class="col-sm-2 control-label">Audio : </label>
						<div class="col-sm-10">
							<audio src="{{ asset('/uploads/audio') }}/{{ $compte->audio }}" controls>Veuillez mettre à jour votre navigateur !</audio>
							<div class="btn btn-primary btn-file  audio">
								<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
								<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
								<input type="file" id="audioInputfile" name="audioInputfile" accept="audio/*"/>
							</div>
							<input type="hidden" id="is_audio" name="is_audio" value="Non" />
							<input type="hidden" id="hidden_audio" name="hidden_audio" value="{{ $compte->audio }}" />
							<input type="hidden" id="hidden_audio1" name="hidden_audio1" value="{{ $compte->audio }}" />
							<button class="btn btn-primary btn-xs hidden" id="btnmodifaudio" name="btnmodifaudio" type="submit"><i class="fa fa-edit"></i> Modifier audio</button>
							<button type="submit" id="btnmodifautreinfo" class="btn btn-success audio hidden"><i class="fa fa-check"></i> Valider</button>
							<button id="btnsupprimer" type="submit" class="btn btn-danger audio"><i class="fa fa-trash"></i> Supprimer</button>
						</div>
					</div>  
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $compte->note }}</textarea>
						</div>
					</div>
					@if (Auth::user()->statut == 'Staff')
					<div class="form-group" id="">
						<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle">{{ $compte->noteconfidentielle }}</textarea>
						</div>
					</div>
					@endif
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

