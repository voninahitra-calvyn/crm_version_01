<!-- resources\views\centreappels\create.blade.php -->

@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte centre d\'appels')

@section('contentheader_levelactive')
	<li><a href="{{ route('centreappels.index')}}"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li class="active">Ajout</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="box box-danger">
            <div class="box-header with-border">
				<h3 class="box-title form">Ajout centre d'appel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('centreappels.store') }}" enctype="multipart/form-data">
                 
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
					<div class="form-group " id="">
						<label for="logo-centre" class="col-sm-2 control-label">Logo : </label>
						<div class="col-sm-8">
							<div class="col-sm-3">
								<img id="ok_imageadd" class="img-responsive img-circle image_form" src="" controls></img>
							</div>
							<div class="btn btn-danger btn-file  logo">
								<input type="file" id="logo-centre" class="logoCallCenter" name="logoCallCenter" accept="image/*"/>Parcourir...
							</div>
						</div>
						<div class="col-sm-2">
							<input type="hidden"  id="is_logoadd" name="is_logoadd" value="Non" />
							<input type="hidden"  id="hidden_logoadd" name="hidden_logoadd"  />

						</div>
					</div>
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
						  <input type="text" class="form-control text-lowercase" name="email" id="email"  placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="effectif" class="col-sm-2 control-label">Effectif centre d’appels : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="effectif" id="effectif"  placeholder="Effectif centre d’appels">
						</div>
					</div>
					<div class="form-group">
						<label for="horaireprod" class="col-sm-2 control-label">Horaire de production : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="horaireprod" id="horaireprod"  placeholder="Horaire de production">
						</div>
					</div>
					<div class="form-group">
						<label for="campagnefavorite" class="col-sm-2 control-label">Campagne favorite : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="campagnefavorite" id="campagnefavorite"  placeholder="Campagne favorite">
						</div>
					</div>
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note"></textarea>
						</div>
					</div>
					@if (Auth::user()->statut == 'Staff')
					<div class="form-group">
						<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle"></textarea>
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
							<button type="submit" class="btn btn-info pull-right">Valider</button>
						</div>
					</div>
					
				</div>
			</form>
	
		</div>      
    </section>
@endsection

