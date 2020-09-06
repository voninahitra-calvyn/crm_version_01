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
    <div class="col-md-12">
        <div class="box box-white">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Rendez-vous assurance pro</h3>

				<div class="box-tools">
					<div class="has-feedback">
					  <input type="text" class="form-control input-sm" placeholder="Recherche">
					  <span class="glyphicon glyphicon-search form-control-feedback"></span>
					</div>
				</div>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                            <tr class="header">
                                <th style="width: 50px;"></th>
                                <th style="width: 50px;"></th>
                                <th class="">Type</th>
                                <th class="">Société</th>
                                <th class="">Adresse</th>
                                <th class="">CP</th>
                                <th class="">Ville</th>
                                <th class="">Téléphone</th>
                                <th class="">Mobile</th>
                                <th class="">Email</th>
                                <th class="">age</th>
                                <th class="">Date rendez-vous</th>
                                <th class="">Heure rendez-vous</th>
                                <th class="">Nom de la personne rendez-vous</th>
                                <th class="">Note</th>
                            </tr>

                            @foreach($rendezvous as $rdv)
                            <tr>
                                <td class="">
                                    <form action="{{route('rdvs.contester', [$rdv])}}" method="post" >
                                        @csrf
                                        @method('GET')
                                        <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Contester</button>
                                    </form>
                                </td>
								<td class="">
									<form action="{{route('rdvs.details', [$rdv])}}" method="post" >
										@csrf
										@method('GET')
										<button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Détails</button>
									</form>
								</td>
                                <td class="">{{$rdv->typerdv}}</td>
                                <td class="">{{$rdv->societe}}</td>
                                <!-- <td class="">{{$rdv->client_id}}</td> -->
                                <td class="">{{$rdv->adresse}}</td>
                                <td class="">{{$rdv->cp}}</td>
                                <td class="">{{$rdv->ville}}</td>
                                <td class="">{{$rdv->telephone}}</td>
                                <td class="">{{$rdv->mobile}}</td>
                                <td class="">{{$rdv->email}}</td>
                                <td class="">{{$rdv->age}}</td>
                                <td class="">{{$rdv->date_rendezvous}}</td>
                                <td class="">{{$rdv->heure_rendezvous}}</td>
                                <td class="">{{$rdv->nom_personne_rendezvous}}</td>
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