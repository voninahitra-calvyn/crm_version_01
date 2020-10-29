@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte centre d\'appels')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('centreappels.index')}}"><i class="fa fa-dashboard"></i> Centre d'appels {{$centreappel->societe}}</a></li>
	<li class="active">Comptes</li>
@overwrite
<!-- {!!$comptes!!} -->

@section('main-content')
					<div class="info-box-header">
						<div class="lsp-widget_head">
							<div class="lsp-subheader_main">
								<!-- <form action="#" method="get" class="">
									<div class="input-group">
										<input type="text" name="q" class="form-control" placeholder="Recherche...">
										<span class="input-group-btn">
											<button type="submit" name="search" id="search-btn" class="btn btn-danger"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</form>  --> 
							</div>		
						   
							<div class="lsp-headerwidget_action">     
								<form action = "{{route('centreappels.createcompte', [$centreappel])}}" method="post" class="">
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
				<table id="tablecentreappelcompte" class="table table-hover table-striped">
					<thead class="theadexcel">
					<tr class="header">
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur')
						<th class="noExl no-filter" style="width: 50px;"></th>
						@endif
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<th class="noExl no-filter" style="width: 50px;"></th>
						@endif
						<th>ID</th>
						<th>Nom</th>
						<th>Prénom(s)</th>
						<th>Téléphone</th>
						<th>Email</th>
						<th>Statut</th>
						<th>Note</th>
						<th>Etat</th>
						<td>created at</td>
						<td>updated at</td>

					</tr>
					</thead>
					<tbody>
					@foreach($comptes as $compte)
					<tr>
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur')
						<td class="noExl no-filter" >
							<form action = "{{route('centreappels.modifcompte', [$compte])}}" method="post" class="">
								@csrf
								@method('GET')
								<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button>
							</form>
						</td>
						@endif
						@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
						<td class="noExl no-filter" >
							<form  action = "{{route('centreappels.suppcompte', [$compte])}}" method="post" class=""  onsubmit="return confirmDelete();">
								@csrf
								@method('GET')
								<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button>
							</form> 
						</td>
						@endif
						<td><a href="#">{{ substr($compte->_id,3,-16) }}</a></td>
						<td><a href="#">{{$compte->nom}}</a></td>
						<td>{{$compte->prenom}}</td>
						<td>{{$compte->telephone}}</td>
						<td>{{$compte->email}}</td>
						<td>{{$compte->statut}}</td>
						<td>{{$compte->note}}</td>
						<td>{{$compte->etat ? $compte->etat: 'Actif'}}</td>
							<td>{{$compte->created_at->format("Y-m-d H:i:s")}}</td>
							<td>{{$compte->updated_at->format("Y-m-d H:i:s")}}</td>
					</tr>
					@endforeach 
					</tbody>
				</table>
			</div>
		</div>
	
    </section>

@endsection