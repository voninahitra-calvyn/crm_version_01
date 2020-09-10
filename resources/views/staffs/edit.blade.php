@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte staff')

@section('contentheader_levelactive')
	<li><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Staff</a></li>
	<li class="active">Modification</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification staff</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

                 
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
				
            <form class="form-horizontal" method="post" action="{{ route('staffs.update', $staff->_id) }}">
				@csrf
				@method('PUT')
				
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
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="{{ substr($staff->_id,3,-16) }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="{{ $staff->nom }}">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{ $staff->prenom }}">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="{{ $staff->telephone }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $staff->email }}">
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
								<option value="Administrateur" {{ ( $staff->statut == 'Administrateur') ? 'selected' : '' }}>Administrateur</option>
								<option value="Staff" {{ ( $staff->statut == 'Staff') ? 'selected' : '' }}>Staff</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $staff->note }}</textarea>
						</div>
					</div>
					@if (Auth::user()->statut == 'Administrateur')
						<div class="form-group">
							<label for="etat" class="col-sm-2 control-label">Etat : {{--$rdv->typerdv--}}</label>
							<div class="col-sm-10">
								<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
									@if($staff->etat == "Actif" or $staff->etat == '')
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

