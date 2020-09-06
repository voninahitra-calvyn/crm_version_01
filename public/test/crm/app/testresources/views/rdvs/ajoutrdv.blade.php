@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client {{--$comptes--}}</a></li>
	<li class="active">Comptes</li>
@overwrite

@section('main-content')
					<!-- <div class="info-box-header">
						<div class="lsp-widget_head">
							<div class="lsp-subheader_main">
								<form action="#" method="get" class="">
									<div class="input-group">
										<input type="text" name="q" class="form-control" placeholder="Recherche...">
										<span class="input-group-btn">
											<button type="submit" name="search" id="search-btn" class="btn btn-danger"><i class="fa fa-search"></i>
											</button>
										</span>
									</div>
								</form>  
							</div>		
						</div>
					</div> -->
    <!-- Main content -->
		<div class="box-body no-padding">
			<!-- <div class="box-body table-responsive no-padding"> -->
			<div  class="table-responsive box-body no-padding">
				<table id="tableajoutrdv" class="table table-hover table-striped">
					<thead class="theadexcel">
						<tr class="header">
					<th>Choix</th>
					<th>Référence client</th>
					<th>Campagne</th>
					<th>Nom du commercial</th>
					<!-- <th>Prénom(s)</th> -->
					<!-- <th>Téléphone</th> -->
					<!-- <th>Email</th> -->
					<th>Statut</th>
					<!-- <th>Note</th> -->
				</tr>
					</thead>
				<tbody>
				@foreach($comptes->sortByDesc('id') as $cmpt)
				
				<tr>
					<td>
						<form action = "{{route('clients.rendezvous', [$cmpt])}}" method="post" class="">
							@csrf
							@method('GET')
							<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-user"></i> Choisir responsable</button>
						</form>
					</td>
					<td>{{ substr($cmpt->_id,3,-16) }}</td>
					<td>{{--!!$cmpt->clients!!--}}{{$cmpt->societe2}}</td>
					<td>{{$cmpt->nom}}</td>
					<!-- <td></td> -->
					<!-- <td>{{$cmpt->telephone}}</td> -->
					<!-- <td>{{$cmpt->email}}</td> -->
					<td>{{$cmpt->statut}}</td>
					<!-- <td>{{$cmpt->note}}</td> -->
				</tr>
				@endforeach 

				</tbody>

			</table>
		</div>

	</div>

	
@endsection