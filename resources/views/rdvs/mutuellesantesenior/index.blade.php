@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Rendez-vous')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Rendez-vous</a></li>
	<li class="active">Liste</li>
@overwrite

@section('main-content')
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border rouge">
              <h3 class="box-title">Type rendez-vous</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li>
					<a href="defiscalisation">
						<i class="fa fa-money"></i> Défiscalisation
						<span class="label label-danger pull-right">{{count($rdvsdefiscalisation)}}</span>
					</a>
				</li>
                <li>
					<a href="nettoyagepro">
						<i class="fa fa-eraser"></i> Nettoyage pro 
						<span class="label label-danger pull-right">{{count($rdvsnettoyagepro)}}</span>
					</a>
				</li>
                <li>
					<a href="assurancepro">
						<i class="fa fa-ticket"></i> Assurance pro
						<span class="label label-danger pull-right">{{count($rdvsassurancepro)}}</span>
					</a>
				</li>
                <li class="active">
					<a href="mutuellesantesenior">
						<i class="fa fa-universal-access"></i> Mutuelle santé sénior 
						<span class="label label-danger pull-right">{{count($rdvsmutuellesantesenior)}}</span>
					</a>
                </li>
                <li>
					<a href="autre">
						<i class="fa fa-adjust"></i> Autres
						<span class="label label-danger pull-right">{{count($rdvsautre)}}</span>
					</a> 
				</li>
              </ul>
            </div>
          </div>

        </div>
		
        <div class="col-md-9">
          <div class="box box-white">
            <div class="box-header with-border rouge">
              <h3 class="box-title">Rendez-vous mutuelle santé sénior</h3>

				<div class="box-tools pull-right rechercherdv">
					<div class="has-feedback">
					  <input type="text" class="form-control input-sm" placeholder="Recherche">
					  <span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</div>
				<div class="box-tools pull-right">
					<form action = "{{route('rdvs.choisirclient')}}" method="post" class="">
						@csrf
						@method('GET')
						<button class="btn btn-success btn-sm" type="submit">Ajouter rendez-vous</button>
					</form>
				</div>
            </div>
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tr class="header">
                    <th class="">Type</th>
                    <th class="">Nom</th>
                    <th class="">Prénom</th>
                    <th class="">Adresse</th>
                    <th class="">CP</th>
                    <th class="">Ville</th>
                    <th class="">Téléphone</th>
                    <th class="">Mobile</th>
                    <th class="">Email</th>
                    <th class="">Age</th>
                    <th class="">Mutuelle entreprise</th>
                    <th class="">Nom de sa mutuelle</th>
                    <th class="">Montant mutuelle actuelle</th>
                    <th class="">Seul sur le contrat</th>
                    <th class="">Statut matrimonial</th>
                    <th class="">Composition foyer</th>
                    <th class="">Date rendez-vous</th>
                    <th class="">Heure rendez-vous</th>
                    <th class="">Note</th>
                  </tr>
				  
				@foreach($rdvsmutuellesantesenior as $rdv)
					<tr>
						<td class="">{{$rdv->typerdv}}</td>
						<td class="">{{$rdv->nom}}</td>
						<td class="">{{$rdv->prenom}}</td>
						<td class="">{{$rdv->adresse}}</td>
						<td class="">{{$rdv->cp}}</td>
						<td class="">{{$rdv->ville}}</td>
						<td class="">{{$rdv->telephone}}</td>
						<td class="">{{$rdv->mobile}}</td>
						<td class="">{{$rdv->email}}</td>
						<td class="">{{$rdv->age}}</td>
						<td class="">{{$rdv->mutuelle_entreprise}}</td>
						<td class="">{{$rdv->nom_mutuelle}}</td>
						<td class="">{{$rdv->montant_mutuelle_actuelle}}</td>
						<td class="">{{$rdv->seul_sur_contrat}}</td>
						<td class="">{{$rdv->statut_matrimonial}}</td>
						<td class="">{{$rdv->composition_foyer}}</td>
						<td class="">{{$rdv->date_rendezvous}}</td>
						<td class="">{{$rdv->heure_rendezvous}}</td>
						<td class="">{{$rdv->note}}</td>
					</tr>
				  @endforeach
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection