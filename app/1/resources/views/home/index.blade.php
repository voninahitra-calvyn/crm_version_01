@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Tableau de bord principal')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('home.index')}}"><i class="fa fa-dashboard"></i> Tableau de bord principal</a></li>
@overwrite

@section('main-content')

    <div class="accueil-page">
        <h3 class="headline text-red">Bonjour {{ Auth::user()->prenom }} {{ Auth::user()->nom }}!</h3>
    </div>
	<form class="form-horizontal @if ($_id <> null) hidden @endif" method="POST" action="{{ route('home.store') }}">
	
	
		 
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
			<div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
				<!-- <label for="note1editor" class="col-sm-12 control-label">Note pour superviseur ou agent : </label> -->
				<div class="col-sm-10">
				  <textarea class="form-control" rows="5" name="note1editor" id="note1editor" placeholder="Note pour superviseur ou agent"></textarea>
				</div>
			</div>
			<div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
				<!-- <label for="note2editor" class="col-sm-12 control-label">Note pour responsable ou commercial : </label> -->
				<div class="col-sm-10">
				  <textarea class="form-control" rows="5" name="note2editor" id="note2editor" placeholder="Note pour responsable ou commercial"></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
					<button type="submit" class="btn btn-success pull-right">Valider</button>
				</div>
			</div>
			
		</div>
	</form>
	
		<div class="box box-danger @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif">
			<div class="box-header with-border @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
				<h3 class="box-title form rouge">Note pour superviseur ou agent :</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
					<!-- <label for="note1" class="col-sm-12 control-label @if (Auth::user()->statut <> 'Administrateur') hidden @endif">Note pour superviseur ou agent : </label> -->
					<div class="col-sm-12">{!! $note1 !!}</div>
				</div>
			</div>
		</div>
		
		<div class="box box-danger  @if (Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent') hidden @endif">
			<div class="box-header with-border @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
				<h3 class="box-title form rouge">Note pour responsable ou commercial :</h3>
			</div>	
			<div class="box-body">	
				<div class="form-group">
					<!-- <label for="note2" class="col-sm-12 control-label @if (Auth::user()->statut <> 'Administrateur') hidden @endif">Note pour responsable ou commercial : </label> -->
					<div class="col-sm-12">{!! $note2 !!}</div>
				</div>
			</div>
		</div>
			
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-10">
				<button type="submit" class="btn btn-info pull-left hidden">Modifier1</button>
			</div>
		</div>
		
		<form action = "{{route('home.edit', [$_id])}}" method="post" class="@if (Auth::user()->statut <> 'Administrateur') hidden @endif">
			@csrf
			@method('GET')
			<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-edit"></i> Modifier</button>
		</form>

@endsection
