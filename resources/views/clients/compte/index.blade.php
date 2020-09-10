@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client {{$client->societe}}</a></li>
	<li class="active">Comptes</li>
@overwrite

@section('main-content')
					<div class="info-box-header">
						<div class="lsp-widget_head">
							<div class="lsp-subheader_main">
							  <!-- search form -->
								<!-- <form action="#" method="get" class="">
									<div class="input-group">
										<input type="text" name="q" class="form-control" placeholder="Recherche...">
										<span class="input-group-btn">
											<button type="submit" name="search" id="search-btn" class="btn btn-danger"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</form> -->  
							</div>		
						   
							<div class="lsp-headerwidget_action">     
								<form action = "{{route('clients.createcompte', [$client])}}" method="post" class="">
									@csrf
									@method('GET')
									<button class="btn btn-success btn-sm" type="submit">Ajouter comptes</button>
								</form>     
							</div>        
						</div>
					</div>
    <!-- Main content -->
    <section class="content">
	<div class="box-body no-padding">
		<div class="box-body table-responsive no-padding">
			<table id="tableclientcompte" class="table table-hover table-striped">
					<thead class="theadexcel">
				<tr class="header">
					<th style="width: 50px;"></th>
					<th style="width: 50px;"></th>
					<th style="width: 70px;" class="@if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif"></th>
					@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<th>ID</th>
					@endif
					<th>Société publique</th>
					<th>Service</th>
					<th>Nom</th>
					<th>Prénom(s)</th>
					<th>Téléphone</th>
					<th>Email</th>
					<th>Statut</th>
					<th>Note</th>
					<th>Etat</th>
				</tr>
					</thead>
					<tbody>
				@foreach($comptes->sortByDesc('id') as $compte)
				<tr>
					<td>
						<form action = "{{route('clients.modifcompte', [$compte])}}" method="post" class="">
							@csrf
							@method('GET')
							<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
						</form>
					</td>
					<td>
						<form  action = "{{route('clients.suppcompte', [$compte])}}" method="post" class=""  onsubmit="return confirmDelete();">
							@csrf
							@method('GET')
							<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
						</form> 
					</td>
					<td class="@if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif">
						<form action = "{{route('clients.rendezvous', [$compte])}}" method="post" class="">
							@csrf
							@method('GET')
							<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-address-card"></i> Ajout rendez-vous</button>
						</form>
					</td>
					@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
					<td><a href="#">{{ substr($compte->_id,3,-16) }}</a></td>
					@endif
					<td>{{$client->societe2}}</td>
					<!-- <td>{{--$client->service--}}</td>	 -->
					<td>@foreach($client->service as $service) <small class="label label-danger"><i class="fa fa-exchange"></i> {{$service}}</small>@endforeach</td>
					<td>{{$compte->nom}}</td>
					<td>{{$compte->prenom}}</td>
					<td>{{$compte->telephone}}</td>
					<td>{{$compte->email}}</td>
					<td>{{$compte->statut}}</td>
					<td>{{$compte->note}}</td>
					<td>{{$compte->etat ? $compte->etat : 'Actif'}}</td>
				</tr>
				@endforeach 
					</tbody>

			</table>
		</div>

	</div>

	</section>
@endsection