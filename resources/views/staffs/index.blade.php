@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Staff')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Staff</a></li>
	<li class="active">Comptes</li>
@overwrite

@section('main-content')
	@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')	
		<div class="col-md-2">
			<div class="box box-solid">
				<div class="box-header with-border rouge">
					<h3 class="box-title">Type compte</h3>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">
					<li class="active">
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
					<h3 class="box-title">Compte staff</h3>
					<!-- <div class="box-tools pull-right recherche">
						<div class="has-feedback">
							<input type="text" class="form-control input-sm" placeholder="Recherche">
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>
					</div> -->
					<div class="box-tools pull-right">
						<form action = "{{route('staffs.create')}}" method="post" class="">
							@csrf
							@method('GET')
							<button class="btn btn-success btn-sm" type="submit">Ajouter staffs</button>
						</form> 
					</div>
				</div>
				<div class="box-body no-padding">
					<!-- <div class="box-body table-responsive no-padding"> -->
					<div  class="table-responsive box-body no-padding">
						<table id="tablestaff" class="table table-hover table-striped">
							<thead class="theadexcel">
								<tr class="header">
									<th style="width: 50px;"></th>
									<th style="width: 50px;"></th>
									@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
										<th>ID</th>
									@endif
									<th>Nom</th>
									<th>Prénom(s)</th>
									<th>Téléphone</th>
									<th>Email</th>
									<th>Statut</th>
									<th>Note</th>
								</tr>
								</thead>
							<tbody>
							@foreach($staffs->sortByDesc('id') as $staff)
								<tr>
									<td>
										<form action = "{{route('staffs.edit', [$staff])}}" method="post" class="">
											@csrf
											@method('GET')
											<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
										</form>
									</td>
									<td>
										<form  action = "{{route('staffs.destroy', [$staff])}}" method="post" class="">
											@csrf
											@method('DELETE')
											<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
										</form> 
									</td>
									@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
									<td><a href="#">{{ substr($staff->_id,3,-16) }}</a></td>
									@endif
									<td><a href="#">{{$staff->nom}}</a></td>
									<td>{{$staff->prenom}}</td>
									<td>{{$staff->telephone}}</td>
									<td>{{$staff->email}}</td>
									<td>{{$staff->statut}}</td>
									<td>{{$staff->note}}</td>
								</tr>
								@endforeach 

							</tbody>
							</table>
					</div>

				</div>
			</div>
		</div>
		
		<div class="col-sm-12">

		  @if(session()->get('success'))
			<div class="alert alert-success">
			  {{ session()->get('success') }}
			</div>
		  @endif
		</div>


	@else
		<div class="error-page droit">
			<h2 class="headline text-yellow">Erreur  </h2>

			<div class="error-content">
				<h3><i class="fa fa-warning text-yellow"></i> Vous n'avez pas le droit d'accéder à cette page.</h3>
			</div>
		</div>
	@endif
@endsection