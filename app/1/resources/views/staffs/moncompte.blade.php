<!-- resources\views\staffs\moncompte.blade.php -->

@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte staff')

@section('contentheader_levelactive')
	<li><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Staff</a></li>
	<li class="active">Mon compte</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-4">

			<!-- Profile Image -->
			<div class="box box-danger">
				<div class="box-body box-profile">
					@if ($staff->img=='')
						<img class="profile-user-img img-responsive img-circle" src="{{ asset('/img/avatar.png') }}" alt="Image profil" />
					@else
						<img class="profile-user-img img-responsive img-circle" src="{{ URL::to('/') }}/img/utilisateurs/{{ $profil->img }}" alt="Image profil" />
					@endif

					<h3 class="profile-username text-center  rouge">{{ $staff->nom }} {{ $staff->prenom }}</h3>

					<p class="text-muted text-center rouge">{{$staff->statut}}</p>
					

					<ul class="list-group list-group-unbordered ">
						<li class="list-group-item titre rouge">
							<b><i class="fa fa-phone-square margin-r-5"></i> T&eacute;l&eacute;phone :</b>
						</li>
						<li class="list-group-item contenu">
							<p>
							{{ $staff->telephone }}
							</p>
						</li>
						<li class="list-group-item titre rouge">
							<b><i class="fa fa-envelope margin-r-5"></i> E-mail :</b>
						</li>
						<li class="list-group-item contenu">
							{{$staff->email}}
						</li>
					</ul>
					

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
			</div>
			<div class="col-md-8">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title form rouge">Modifier mot de passe</h3>
					</div>
					@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							Veuillez s'il vous plait corriger les erreurs suivantes :
						</div>
						<div class="alert-danger-liste">
							<ul>
								@foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
								@endforeach
							</ul>
						</div><br />
					@endif
					
					@if(session()->get('success'))
						<div class="alert alert-success">
						  {{ session()->get('success') }}
						</div>
					@endif
						
					<form class="form-horizontal" method="post" action="{{ route('staffs.modifmotdepasse', $staff->_id) }}">
						@csrf
						@method('GET')
						
						<!--
						@if ($errors->any())
							<div class="alert alert-danger" role="alert">
								Veuillez s'il vous plait corriger les erreurs suivantes
							</div>
						@endif
						-->
						<div class="box-body">
							<div class="form-group">
								<label for="nom" class="col-sm-12 control-label">Ancien mot de passe : </label>
								<div class="col-sm-12">
								  <input type="password" class="hidden form-control" name="motdepasse" id="motdepasse" value={{ $staff->password }}>
								  <input type="password" class=" form-control" name="ancienmotdepasse" id="ancienmotdepasse" placeholder="mot de passe">
								</div>
							</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-12 control-label">Nouveau mot de passe : </label>
								<div class="col-sm-12">
								  <input type="password" class="form-control" name="nouveaumotdepasse" id="nouveaumotdepasse" placeholder="mot de passe">
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="note" class="col-sm-12 control-label">Note : </label>
								<div class="col-sm-12">
								  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $staff->note }}</textarea>
								</div>
							</div> -->
							<div class="form-group">
								<div class="col-sm-offset-1 col-sm-10">
									<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
									<button type="submit" class="btn btn-primary pull-right">Modifier</button>
								</div>
							</div>
							
						</div>
					</form>
			
				</div>      
				
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title form rouge">Autre Infos</h3>
					</div>
					@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							Veuillez s'il vous plait corriger les erreurs suivantes :
						</div>
						<div class="alert-danger-liste">
							<ul>
								@foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
								@endforeach
							</ul>
						</div><br />
					@endif
					
					@if(session()->get('successAutreInfo'))
						<div class="alert alert-success">
						  {{ session()->get('successAutreInfo') }}
						</div>
					@endif
						
					<form class="form-horizontal" method="post" action="{{ route('staffs.modifinfo', $staff->_id) }}" enctype="multipart/form-data">
						@csrf
						@method('GET')
						
						<div class="box-body">
							@if (Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent') 
							<div class="form-group" id="">
								<label for="audio" class="col-sm-2 control-label">Audio : </label>
								<div class="col-sm-10">
									<audio src="{{ asset('/uploads/audio') }}/{{ $staff->audio }}" controls>Veuillez mettre à jour votre navigateur !</audio>
									<div class="btn btn-primary btn-file  audio">
										<div id ="btnajouter"><i class="fa fa-cloud-upload"></i> Ajouter </div>
										<div id ="btnremplacer"><i class="fa fa-cloud-upload"></i> Remplacer </div>
										<input type="file" id="audioInputfile" name="audioInputfile" />
									</div>
									<input type="hidden" id="is_audio" name="is_audio" value="Non" />
									<input type="hidden" id="hidden_audio" name="hidden_audio" value="{{ $staff->audio }}" />
									<input type="hidden" id="hidden_audio1" name="hidden_audio1" value="{{ $compte->audio }}" />
									<button class="btn btn-primary btn-xs hidden" id="btnmodifaudio" name="btnmodifaudio" type="submit"><i class="fa fa-edit"></i> Modifier audio</button>
									<button type="submit" id="btnmodifautreinfo" class="btn btn-success audio hidden"><i class="fa fa-check"></i> Valider</button>
									<button id="btnsupprimer" type="submit" class="btn btn-danger audio"><i class="fa fa-trash"></i> Supprimer</button>
								</div>
							</div>      
							@endif
							@if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial')
							<div class="form-group">
								<label for="note" class="col-sm-2 control-label">Agenda public: </label>
								<div class="col-sm-10 control-txt">
									<a href="{{ url('/comresp_public')}}/{{$staff->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$staff->_id}}</a>
								</div>
							</div>
							<div class="form-group">
								<label for="agendapriv" class="col-sm-2 control-label">Agenda privé: </label>
								<div class="col-sm-10">
									<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="{{ $staff->agendapriv }}">
								</div>
							</div>
							@endif
							<div class="form-group">
								<label for="note" class="col-sm-2 control-label">Note : </label>
								<div class="col-sm-10">
								  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $staff->note }}</textarea>
								</div>
							</div>
							@if (Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent') 
							<div class="form-group" id="">
								<label for="noteconfidentielle" class="col-sm-2 control-label">Note confidentielle : </label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="3" name="noteconfidentielle" id="noteconfidentielle" placeholder="Note confidentielle">{{ $staff->noteconfidentielle }}</textarea>
								</div>
							</div>      
							@endif
							<div class="form-group">
								<div class="col-sm-offset-1 col-sm-10">
									<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
									<button type="submit" class="btn btn-success pull-right">Modifier</button>
								</div>
							</div>
							
						</div>
					</form>
			
				</div>    
				
				<div class="box box-danger hidden">
					<div class="box-header with-border">
						<h3 class="box-title form rouge">Sauvegarde</h3>
					</div>
					@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							Veuillez s'il vous plait corriger les erreurs suivantes :
						</div>
						<div class="alert-danger-liste">
							<ul>
								@foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
								@endforeach
							</ul>
						</div><br />
					@endif
					
					@if(session()->get('successBackup'))
						<div class="alert alert-success">
						  {{ session()->get('successBackup') }}
						</div>
					@endif
						
					<form class="form-horizontal" method="post" action="{{ route('staffs.modifinfo', $staff->_id) }}" enctype="multipart/form-data">
						@csrf
						@method('GET')
						
						<div class="box-body">
							<div class="form-group">
								<label for="basededonnees" class="col-sm-12 control-label">Base de données : </label>
								<div class="col-sm-12">
								  <!-- <input type="password" class="form-control" name="basededonnees" id="basededonnees" placeholder="Base de données"> -->
								  <input type="text" class="form-control" name="basededonnees" id="basededonnees" placeholder="Base de données">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-1 col-sm-10">
									<a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
									<button type="submit" class="btn btn-success pull-right">Sauvegarder</button>
								</div>
							</div>
							
						</div>
					</form>
			
				</div>
			</div>


		</div>
		
      

	</section>
		
  
@endsection

