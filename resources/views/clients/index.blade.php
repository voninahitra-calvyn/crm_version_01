@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client</a></li>
	<li class="active">Consulter tous les clients</li>
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
			<li>
				<a href="centreappels">
					<i class="fa fa-phone"></i> Centre d'appels 
					<span class="label label-danger pull-right">{{count($centreappels)}}</span>
				</a>
			</li>
			<li class="active">
				<a href="clients">
					<i class="fa fa-user"></i> Client
					<span class="label label-danger pull-right">{{count($clients)}}</span>
				</a>
			</li>
		  </ul>
		</div>
	  </div>

	</div>
	
	<div class="col-md-10">
	  <div class="box box-white">
		<div class="box-header with-border rouge">
		  <h3 class="box-title">Compte client</h3>
			<div class="box-tools pull-right">
				<form action = "{{route('clients.create')}}" method="post" class="">
					@csrf
					@method('GET')
					<button class="btn btn-success btn-sm" type="submit">Ajouter client</button>
				</form>
			</div>
		</div>
	<div class="box-body no-padding">
		<div class="box-body table-responsive no-padding">
			<table id="tableclient" class="table table-hover table-striped">
					<thead class="theadexcel">
				<tr class="header">
					<th style="width: 50px;"></th>
					<th style="width: 50px;"></th>
					<th style="width: 50px;"></th>
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<th>ID</th>
						@endif
					<th>Societe</th>
					<th>Note</th>
					<th>Societe</th>
					<th>Adresse</th>
					<th>Cp</th>
					<th>Ville</th>
					<th>Pays</th>
					<th>Téléphone</th>
					<th>Email</th>
					<th>Service</th>
				</tr>
					</thead>
					<tbody>
				@foreach($clients->sortByDesc('client') as $client)
				<tr>
					<td>
						<form action = "{{route('clients.edit', [$client])}}" method="post" class="">
							@csrf
							@method('GET')
							<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
						</form>
					</td>
					<td>
						<form  action = "{{route('clients.destroy', $client->id)}}" method="post" class="">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
						</form> 
					</td>
					<td>
						<form action = "{{route('clients.compte', [$client])}}" method="post" class="">
							@csrf
							@method('GET')
							<button class="btn btn-success btn-xs" type="submit"><i class="fa fa-user"></i> Compte</button>
						</form>
					</td>
					@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
					<td><a href="#">{{ substr($client->_id,3,-16) }}</a></td>
					@endif
					<td><a href="#">{{$client->societe2}}</a></td>
					<td><a href="#">{{$client->note}}</a></td>
					<td>{{$client->societe}}</td>
					<td>{{$client->adresse}}</td>
					<td>{{$client->cp}}</td>
					<td>{{$client->ville}}</td>
					<td>{{$client->pays}}</td>
					<td>{{$client->telephone}}</td>
					<td>{{$client->email}}</td>
					<td>@foreach($client->service as $service) <small class="label label-danger"><i class="fa fa-exchange"></i> {{$service}}</small>@endforeach</td>
				</tr>
				@endforeach	
					</tbody>
			</table>
		</div>

	</div>

	  </div>
	</div>


@endsection