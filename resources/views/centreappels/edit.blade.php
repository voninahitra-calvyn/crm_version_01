<!-- resources\views\centreappels\edit.blade.php -->

@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte centre d\'appels')

@section('contentheader_levelactive')
	<li><a href="{{ route('centreappels.index')}}"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
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
            <form class="form-horizontal" method="post" action="{{ route('centreappels.update', [$centreappel]) }}"
				  enctype="multipart/form-data">
						<input type="hidden" name="_method" value="GET">
						@csrf
						@method('PUT')
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
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="{{ substr($centreappel->_id,3,-16) }}" disabled>
						</div>
					</div>

					<div class="form-group " id="">
						<label for="logo" class="col-sm-2 control-label">logo : </label>
						<div class="col-sm-10">

							<div class="col-sm-2">
									<img id="ok_image" class="img-responsive img-circle image_form" src="{{ asset('/uploads/logo') }}/{{ $centreappel->logo }}" controls></img>
							</div>

							<div class="btn btn-primary btn-file  logo">
								<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
								<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
								<input type="file" id="logoInputfile" name="logoInputfile"   accept="image/*"/>
							</div>

							<input type="hidden" id="is_logo" name="is_logo" value="Non" />
							<input type="hidden" id="hidden_logo" name="hidden_logo" value="{{ $centreappel->logo }}" />
							<input type="hidden" id="hidden_logo1" name="hidden_logo1" value="{{ $centreappel->logo }}" />
							<button class="btn btn-primary btn-xs hidden" id="btnmodiflogo" name="btnmodiflogo" type="submit"><i class="fa fa-edit"></i> Modifier logo</button>
							<button type="submit" id="btnmodifautreinfo" class="btn btn-success logo hidden"><i class="fa fa-check"></i> Valider</button>
							<button id="btnsupprimer" type="submit" class="btn btn-danger logo"><i class="fa fa-trash"></i> Supprimer</button>
						</div>
					</div>

					<div class="form-group">
						<label for="societe" class="col-sm-2 control-label">Société : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="societe" id="societe" placeholder="Société" value="{{ $centreappel->societe }}">
						</div>
					</div>
					<div class="form-group">
						<label for="adresse" class="col-sm-2 control-label">Adresse : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse" value="{{ $centreappel->adresse }}">
						</div>
					</div>
					<div class="form-group">
						<label for="cp" class="col-sm-2 control-label">Cp : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="cp" id="cp" placeholder="Cp" value="{{ $centreappel->cp }}">
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label">Ville : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="{{ $centreappel->ville }}">
						</div>
					</div>
					<div class="form-group">
						<label for="pays" class="col-sm-2 control-label">Pays : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="pays" id="pays" placeholder="Pays" value="{{ $centreappel->pays }}">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="{{ $centreappel->telephone }}">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control text-lowercase" name="email" id="email" placeholder="Email" value="{{ $centreappel->email }}">
						</div>
					</div>
					<div class="form-group">
						<label for="effectif" class="col-sm-2 control-label">Effectif centre d’appels : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="effectif" id="effectif"  placeholder="Effectif centre d’appels" value="{{ $centreappel->effectif }}">
						</div>
					</div>
					<div class="form-group">
						<label for="horaireprod" class="col-sm-2 control-label">Horaire de production : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="horaireprod" id="horaireprod"  placeholder="Horaire de production" value="{{ $centreappel->horaireprod }}">
						</div>
					</div>
					<div class="form-group">
						<label for="campagnefavorite" class="col-sm-2 control-label">Campagne favorite : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="campagnefavorite" id="campagnefavorite"  placeholder="Campagne favorite" value="{{ $centreappel->campagnefavorite }}">
						</div>
					</div>
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $centreappel->note }}</textarea>
						</div>
					</div>
					@if (Auth::user()->statut == 'Staff')
					<div class="form-group">
						<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle">{{ $centreappel->noteconfidentielle }}</textarea>
						</div>
					</div>
					@endif
                    @if (Auth::user()->statut == 'Administrateur')
					<div class="form-group">
						<label for="etat" class="col-sm-2 control-label">Etat : {{--$rdv->typerdv--}}</label>
						<div class="col-sm-10">
							<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
								@if($centreappel->etat == "Actif" or $centreappel->etat == '')
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

