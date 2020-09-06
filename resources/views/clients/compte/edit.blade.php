@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
	<li><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client</a></li>
	<li><a href="{{route('clients.compte', [$client])}}">Compte</a></li>
	<li class="active">Modification</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Modification compte</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('clients.updatecompte', [$compte]) }}">
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
				<input type="text" class="form-control hidden" name="campagne" id="campagne" value="{{$campagne}}" >
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
						  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $compte->email }}">
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
								<option value="Responsable" {{ ( $compte->statut == 'Responsable') ? 'selected' : '' }}>Responsable</option>
								<option value="Commercial" {{ ( $compte->statut == 'Commercial') ? 'selected' : '' }}>Commercial</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Agenda public : </label>
						<div class="col-sm-10 control-txt">
						  <a href="{{ url('/comresp_public')}}/{{$compte->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$compte->_id}}</a>
						  <!-- / <a href="{{ url('/agendacomresp_public')}}/{{$compte->_id}}">Cliquer ici pour télécharger fichier INC</a> --> 
						  <!-- <a href="{{ url('/agendacomresp_public')}}/{{$compte->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$compte->_id}}</a> -->
						  <!-- <a href="{{ asset('/uploads/agenda') }}/{{ $compte->_id }}.inc" target="_blank" >{{$compte->_id}}.inc</a> -->
						</div>
					</div>
					<div class="form-group">
						<label for="agendapriv" class="col-sm-2 control-label">Ajouter son agenda : </label>
						<div class="col-sm-10">
							<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="{{ $compte->agendapriv }}">
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="note" class="col-sm-2 control-label">Agenda public: </label>
						<div class="col-sm-10 control-txt">
						  <a href="{{ url('/comresp_public')}}/{{$compte->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$compte->_id}}</a>
						</div>
					</div>
					<div class="form-group">
						<label for="agendapriv" class="col-sm-2 control-label">Agenda privé: </label>
						<div class="col-sm-10">
							<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="{{ $compte->agendapriv }}">
						</div>
					</div> -->
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $compte->note }}</textarea>
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

