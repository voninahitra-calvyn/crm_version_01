@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte centre d\'appels')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('centreappels.index')}}"><i class="fa fa-dashboard"></i> Centre d'appels</a></li>
	<li class="active">Consulter tous les centres d'appels</li>
@overwrite

@section('main-content')
	<div class="col-md-2">
	  <div class="box box-solid">
		<div class="box-header with-border rouge">
		  <h3 class="box-title">Type compte</h3>
		</div>
		<div class="box-body no-padding">
		  <ul class="nav nav-pills nav-stacked">
			<li>
				<a href="staffs">
					<i class="fa fa-users"></i> Staff
					<span class="label label-danger pull-right">{{count($staffs)}}</span>
				</a>
			</li>
			<li class="active">
				<a href="centreappels">
					<i class="fa fa-phone"></i> Centre d'appels 
					<span class="label label-danger pull-right">{{count($centreappels)}}</span>
				</a>
			</li>
			<li>
				<a href="clients">
					<i class="fa fa-user"></i> Client
					<span class="label label-danger pull-right">{{count($clients)}}</span>
				</a>
			</li>
		  </ul>
		</div>
		<!-- /.box-body -->
	  </div>

	</div>
	
	<div class="col-md-10">
	  <div class="box box-white">
		<div class="box-header with-border rouge">
				<h3 class="box-title">Compte centre d'appels</h3>
				<!-- <div class="box-tools pull-right recherchecentreappel">
					<div class="has-feedback">
						<input type="text" class="form-control input-sm" placeholder="Recherche">
						<span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</div> -->
				<div class="box-tools pull-right">
					<form action = "{{route('centreappels.create')}}" method="post" class="">
						@csrf
						@method('GET')
						<button class="btn btn-success btn-sm" type="submit">Ajouter centre d'appels</button>
					</form>
				</div>
		</div>
		
		<div class="box-body no-padding">
			<div class="box-body table-responsive no-padding">
				<table id="tablecentreappel" class="table table-hover table-striped">
					<thead class="theadexcel">
					<tr class="header">
						<th style="width: 50px;"></th>
						<th style="width: 50px;"></th>
						<th style="width: 50px;"></th>
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<th>ID</th>
						@endif
						<th>Societe</th>
						<th>Adresse</th>
						<th>Cp</th>
						<th>Ville</th>
						<th>Pays</th>
						<th>Téléphone</th>
						<th>Email</th>
						<!-- <th>Note</th> -->
					</tr>
								</thead>
							<tbody>
					@foreach($centreappels->sortByDesc('centreappel') as $centreappel)
					<tr>
						<td>
							<form action = "{{route('centreappels.edit', [$centreappel])}}" method="post" class="">
								@csrf
								@method('GET')
								<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
							</form>
						</td>
						<td>
							<form  action = "{{route('centreappels.destroy', $centreappel->id)}}" method="post" class="">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
							</form> 
						</td>
						<td>
							<form action = "{{route('centreappels.compte', [$centreappel])}}" method="post" class="">
								@csrf
								@method('GET')
								<button class="btn btn-success btn-xs" type="submit"><i class="fa fa-user"></i> Compte</button>
							</form>
						</td>
						<!-- <td><a href="#">{{$centreappel->societe}}</a></td> -->
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<td><a href="#">{{ substr($centreappel->_id,3,-16) }}</a></td>
						@endif
						<td>{{$centreappel->societe}}</td>
						<td>{{$centreappel->adresse}}</td>
						<td>{{$centreappel->cp}}</td>
						<td>{{$centreappel->ville}}</td>
						<td>{{$centreappel->pays}}</td>
						<td>{{$centreappel->telephone}}</td>
						<td>{{$centreappel->email}}</td>
						<!-- <td>{{$centreappel->note}}</td> -->
					</tr>
					@endforeach	
					</tbody>
				</table>
			</div>

		</div>

	  </div>
	</div>

@endsection