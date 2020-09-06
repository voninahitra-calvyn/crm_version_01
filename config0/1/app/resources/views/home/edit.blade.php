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
    </div><!-- /.error-page -->
				<form class="form-horizontal @if (Auth::user()->statut <> 'Administrateur') hidden @endif" method="POST" action="{{ route('home.update', $home->_id) }}">

				@csrf
				@method('PUT')
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title form rouge">Note pour superviseur ou agent :</h3>
						</div>
						<div class="box-body">
							<div class="form-group ">
								<div class="col-sm-12">
									<textarea class="form-control " rows="5" name="note1editor" id="note1editor" placeholder="">{{ $home->note1 }}</textarea>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-info pull-right">Valider</button>
						</div>
					</div>
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title form rouge">Note pour responsable ou commercial :</h3>
						</div>
						<div class="box-body">
							<div class="form-group ">
								<div class="col-sm-12">
									<textarea class="form-control" rows="5" class="textarea" name="note2editor" id="note2editor" placeholder="">{{ $home->note2 }}</textarea>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
							<button type="submit" class="btn btn-primary pull-right">Valider</button>
						</div>
					</div>
				</form>
				
	
@endsection
