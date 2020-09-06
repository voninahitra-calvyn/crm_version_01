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
          <!-- <a href="compose.html" class="rdv btn btn-danger btn-block margin-bottom">Creér un rendez-vous</a> -->

          <div class="box box-solid">
            <div class="box-header with-border rouge">
              <h3 class="box-title">Type rendez-vous</h3>

              <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> -->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active">
					<a href="#">
						<i class="fa fa-money"></i> Défiscalisation
						<span class="label label-danger pull-right">{{count($rdvsdef)}}</span>
					</a>
				</li>
                <li>
					<a href="#">
						<i class="fa fa-eraser"></i> Nettoyage pro 
						<span class="label label-danger pull-right">2</span>
					</a>
				</li>
                <li>
					<a href="#">
						<i class="fa fa-ticket"></i> Assurance pro
						<span class="label label-danger pull-right">4</span>
					</a>
				</li>
                <li>
					<a href="#">
						<i class="fa fa-universal-access"></i> Mutuelle santé sénior 
						<span class="label label-danger pull-right">7</span>
					</a>
                </li>
                <li>
					<a href="#">
						<i class="fa fa-adjust"></i> Autres
						<span class="label label-danger pull-right">{{count($rdvsautre)}}</span>
					</a> 
				</li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        
		<!-- /.col -->
        <div class="col-md-9">
          <div class="box box-white">
            <div class="box-header with-border rouge">
              <h3 class="box-title">Rendez-vous défiscalisation</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Recherche">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
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
                    <!-- <th class="">Montant impot annuel</th> -->
                    <!-- <th class="">Taux endettement</th>
                    <th class="">Statut matrimonial</th>
                    <th class="">Composition foyer</th>
                    <th class="">Date rendez-vous</th>
                    <th class="">Heure rendez-vous</th>
                    <th class="">Note</th> -->
                  </tr>
				  
				@foreach($rdvsdef as $rdv)
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
						<!-- <td class="">{{$rdv->montant_impots_annuel}}</td> -->
						<!-- <td class="">{{$rdv->taux_endettement}}</td>
						<td class="">{{$rdv->statut_matrimoniel}}</td>
						<td class="">{{$rdv->composition_foyer}}</td>
						<td class="">{{$rdv->date_rendezvous}}</td>
						<td class="">{{$rdv->heure_rendezvous}}</td>
						<td class="">{{$rdv->note}}</td> -->
					</tr>
				  @endforeach
                  <!-- <tr>
                    <td class="">1A</td>
                    <td class="">2A</td>
                    <td class="">3A</td>
                    <td class="">4A</td>
                    <td class="">5A</td>
                    <td class="">6A</td>
                    <td class="">7A</td>
                    <td class="">8A</td>
                    <td class="">9A</td>
                    <td class="">10A</td>
                    <td class="">11A</td>
                    <td class="">12A</td>
                    <td class="">13A</td>
                    <td class="">14A</td>
                    <td class="">15A</td>
                    <td class="">16A</td>
                  </tr>
                  <tr>
                    <td class="">1B</td>
                    <td class="">2B</td>
                    <td class="">3B</td>
                    <td class="">4B</td>
                    <td class="">5B</td>
                    <td class="">6B</td>
                    <td class="">7B</td>
                    <td class="">8B</td>
                    <td class="">9B</td>
                    <td class="">10B</td>
                    <td class="">11B</td>
                    <td class="">12B</td>
                    <td class="">13B</td>
                    <td class="">14B</td>
                    <td class="">15B</td>
                    <td class="">16B</td> -->
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection