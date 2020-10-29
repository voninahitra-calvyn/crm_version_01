<!-- resources\views\rdvs\liste.blade.php -->

@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Production')

@section('contentheader_levelactive')
<li class="active"><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Production</a></li>
<li class="active">Liste</li>
@overwrite

@section('main-content')
    @php
    $blink = \App\BlinkStatut::all();
    $rdvBrut=$rdvRfRl=$rdvRfNl=$rdvEnv=$rdvConf=$rdvAnnul=$rdvAtt=$rdvValid=null;
    foreach ($blink as $item){
        if ($item->typerdv=='Rendez-vous brut'){$rdvBrut=$item->isunread;}
        if ($item->typerdv=='Rendez-vous relancer'){$rdvRfRl=$item->isunread;}
        if ($item->typerdv=='Rendez-vous refusé'){$rdvRfNl=$item->isunread;}
        if ($item->typerdv=='Rendez-vous envoyé'){$rdvEnv=$item->isunread;}
        if ($item->typerdv=='Rendez-vous confirmé'){$rdvConf=$item->isunread;}
        if ($item->typerdv=='Rendez-vous annulé'){$rdvAnnul=$item->isunread;}
        if ($item->typerdv=='Rendez-vous en attente'){$rdvAtt=$item->isunread;}
        if ($item->typerdv=='Rendez-vous validé'){$rdvValid=$item->isunread;}
    }
    @endphp
<div class="row">
    <div class="col-md-3">
        <!-- TYPE RENDEZ-VOUS -->
        <div class="box box-solid @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Type de production</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="{{ $typerdv=='tout' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tout">
                        <a href="tout">
                            <i class="fa fa-cubes"></i> Tout
                            <span class="label label-danger pull-right">{{count($rendezvoustout)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Défiscalisation' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Défiscalisation">
                        <a nohref href="#" {{--href="defiscalisation"--}}>
                            <i class="fa fa-money"></i> Défiscalisation
                            <span class="label label-danger pull-right">{{count($rdvsdefiscalisation)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Nettoyage pro' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Nettoyage pro">
                        <a nohref href="#"{{--href="nettoyagepro"--}}>
                            <i class="fa fa-eraser"></i> Nettoyage pro
                            <span class="label label-danger pull-right">{{count($rdvsnettoyagepro)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Assurance pro' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Assurance pro">
                        <a nohref href="#"{{--href="assurancepro"--}}>
                            <i class="fa fa-ticket"></i> Assurance pro
                            <span class="label label-danger pull-right">{{count($rdvsassurancepro)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Mutuelle santé sénior' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Mutuelle santé sénior" >
                        <a nohref href="#"{{--href="mutuellesantesenior"--}}>
                            <i class="fa fa-universal-access"></i> Mutuelle santé sénior
                            <span class="label label-danger pull-right">{{count($rdvsmutuellesantesenior)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Autres' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Autres">
                        <a nohref href="#" {{--href="autre"--}}>
                            <i class="fa fa-adjust"></i> Autres
                            <span class="label label-danger pull-right">{{count($rdvsautre)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Réception d\’appels' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Réception d\’appels">
                        <a nohref href="#" {{--href="appels"--}}>
                            <i class="fa fa-phone"></i> Réception d’appels
                            <span class="label label-danger pull-right">{{count($appels)}}</span>
                        </a>
                    </li>
                    <li class="{{ $typerdv=='Demande de devis' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tp,Demande de devis">
                        <a {{--href="devis"--}}>
                            <i class="fa fa-list"></i> Demande de devis
                            <span class="label label-danger pull-right">{{count($devis)}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- STATUT RENDEZ-VOUS -->
        <div class="box box-solid">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Statut de production</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="{{ $typerdv=='tout' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="tout">
                        <a href="tout">
                            <i class="fa fa-cubes"></i> Tout
                            <span class="label label-danger pull-right">
                            {{count($rendezvoustout)}}{{--$rendezvoustout->countBy('user_statut')->count()--}}
                            <!-- @if (Auth::user()->statut == 'Superviseur')
                                xx {{ $rendezvoustout->countBy('user_statut')->count() }} yy
                            @endif -->
                            </span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous brut' ? 'active' : '' }} {{$rdvBrut=="oui"?"blink":''}}  @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif statutrdvclick" data-statutrdvclick="Rendez-vous brut">
                        <a nohref {{-- href="brut"--}}  href="#">
                            <i class="fa fa-cube"></i> Rendez-vous brut
                            <span class="label label-danger pull-right">
                            {{count($rdvsbrut)}}
                            <!-- @if (Auth::user()->statut == 'Superviseur')
                                xx {{ $rdvsbrut->countBy('user_statut')->count() }} yy
                            @endif -->
                            </span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous relancer' ? 'active' : '' }} {{$rdvRfRl=="oui"?"blink":''}}  @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial')
                            hidden @endif statutrdvclick" data-statutrdvclick="Rendez-vous relancer">
                        <a  nohref {{--href="relance"--}} href="#">
                            <i class="fa fa-thumbs-o-up"></i> Rendez-vous refusé / relancer
                            <span class="label label-danger pull-right">{{count($rdvsrelancer)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous refusé' ? 'active' : '' }}  {{$rdvRfNl=="oui"?"blink":''}} 
                    @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif statutrdvclick"
                        data-statutrdvclick="Rendez-vous refusé">
                        <a  nohref {{--href="refuse"--}}  href="#">
                            <i class="fa fa-thumbs-o-down"></i> Rendez-vous refusé  / ne pas relancer
                            <span class="label label-danger pull-right">{{count($rdvsrefuse)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous envoyé' ? 'active' : '' }}  {{$rdvEnv=="oui"?"blink":''}} statutrdvclick" data-statutrdvclick="Rendez-vous envoyé">
                        <a nohref  {{--href="envoye"--}}  href="#">
                            <i class="fa fa-send"></i> Rendez-vous envoyé
                            <span class="label label-danger pull-right">{{count($rdvsenvoye)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous confirmé' ? 'active' : '' }} {{$rdvConf=="oui"?"blink":''}} statutrdvclick" data-statutrdvclick="Rendez-vous confirmé">
                        <a nohref  {{--href="confirme"--}} href="#">
                            <i class="fa fa-check-square-o"></i> Rendez-vous confirmé
                            <span class="label label-danger pull-right">{{count($rdvsconfirme)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous annulé' ? 'active' : '' }}  {{$rdvAnnul=="oui"?"blink":''}} statutrdvclick" data-statutrdvclick="Rendez-vous annulé">
                        <a  nohref{{-- href="annule"--}}  href="#">
                            <i class="fa fa-arrow-left"></i> Rendez-vous annulé
                            <span class="label label-danger pull-right">{{count($rdvsannule)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous en attente' ? 'active' : '' }}  {{$rdvAtt=="oui"?"blink":''}} statutrdvclick" data-statutrdvclick="Rendez-vous en attente">
                        <a nohref {{-- href="enattente"--}}  href="#">
                            <i class="fa  fa-spinner"></i> Rendez-vous en attente
                            <span class="label label-danger pull-right">{{count($rdvsenattente)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous validé' ? 'active' : '' }}  {{$rdvValid=="oui"?"blink":''}} statutrdvclick" data-statutrdvclick="Rendez-vous validé">
                        <a nohref {{-- href="valide"--}}  href="#">
                            <i class="fa fa-thumbs-up"></i> Rendez-vous validé
                            <span class="label label-danger pull-right">{{count($rdvsvalide)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous validé' ? 'active' : '' }}
                    @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif statutrdvclick" data-statutrdvclick="Réception d’appels brut">
                        <a  nohref {{--href="appelsbrut"--}}  href="#">
                            <i class="fa fa-phone-square"></i> Réception d’appels brut
                            <span class="label label-danger pull-right">{{count($appelsbrut)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous validé' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="Réception d’appels envoyé">
                        <a nohref {{--href="appelsenvoye"--}}  href="#">
                            <i class="fa fa-phone"></i> Réception d’appels envoyé
                            <span class="label label-danger pull-right">{{count($appelsenvoye)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous validé' ? 'active' : '' }}
                    @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif statutrdvclick" data-statutrdvclick="Demande de devis brut">
                        <a nohref{{-- href="devisbrut"--}}  href="#">
                            <i class="fa fa-list-alt"></i> Demande de devis brut
                            <span class="label label-danger pull-right">{{count($devisbrut)}}</span>
                        </a>
                    </li>
                    <li class="{{ $statutrdv=='Rendez-vous validé' ? 'active' : '' }} statutrdvclick" data-statutrdvclick="Demande de devis envoyé">
                        <a nohref {{--href="devisenvoye"--}}  href="#">
                            <i class="fa  fa-list"></i> Demande de devis envoyé
                            <span class="label label-danger pull-right">{{count($devisenvoye)}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-md-9">
        <div class="box box-white">
            <div class="box-header with-border rouge">
                <h3 class="box-title">Production </h3>

                <!-- <div class="box-tools  @if (Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial') pull-right rechercherdv @endif ">
                    <div class="has-feedback">
                        <input type="text" class="form-control input-sm" placeholder="Recherche">
                        <span class="glyphicon glyphicon-search form-control-feedback rouge"></span>
                    </div>
                </div> -->
                <div class="box-tools pull-right ajoutrdv @if (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial') hidden @endif">
                    <form action="{{route('rdvs.choisirclient')}}" method="post" class="">
                        @csrf
                        @method('GET')
                        <button class="btn btn-primary btn-sm" type="submit">Ajouter rendez-vous</button>
                    </form>
                </div>
                    <button id="btnrdvexcel1" name="btnrdvexcel1" type="submit" class="pull-right box-tools exportexcelrdv btn btn-success btn-sm exportToExcel exportExcel">Export excel</button>
                    <button id="btnrdvexcel0" name="btnrdvexcel0" type="submit" class="pull-right box-tools  btn btn-success btn-sm exportToExcel exportExcel">Export total</button>

                <div class="box-tools pull-right">
                    <form id="exporttoexcel" action="{{route('rdvs.exportexcel')}}" class="">
                        @csrf
                        
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-download"></i> Export total</button>
                    </form>
                </div> 
            </div>
            <div class="box-body no-padding">
                <!-- <div  class="table-responsive mailbox-messages"> -->
                <div  class="table-responsive box-body no-padding">
                    <br />
                    <div class="row">
                        <div class="input-daterange">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="start_date" id="start_date" placeholder="Date debut" class="form-control" autocomplete="off" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Date fin" autocomplete="off"/>
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="button" name="search" id="searchdate" value="Filtrer" class="btn btn-info" />
                           <button class="btn btn-danger" id="refresh-tb"> <i class="fa fa-refresh" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <br />
                    <table id="empTables" class="table table-hover table-striped table2excel">
                        <thead class="theadexcel">
                            @if (Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent')
                            <tr class="header">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search "></th>
                                <th class="filter"><b>Référence</b></th>
                                <th class="filter"><b>Campagne en cours</b></th>
                                <th class="filter"><b>Société</b></th>
                                <th class="filter"><b>Ville</b></th>
                                <th class="filter"><b>Téléphone</b></th>
                                <th class="filter"><b>Nom de la personne au rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
                                <th class="filter date"><b>Date rendez-vous</b></th>
                                <th class="filter"><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Date de création</b></th>
                                <th class="filter"><b>Dernière modification  </b></th>
                            </tr>
                            @elseif (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
                            <tr class="">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search @if (Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent') hidden @endif"></th>
                                <th class="filter"><b>Référence</b></th>
                                <th class="filter"><b>Centre d’appels</b></th>
                                <th class="filter"><b>Responsable/agent</b></th>
                                <th class="filter"><b>Campagne en cours</b></th>
                                <th class="filter exprtout hidden"><b>Nom</b></th>
                                <th class="filter exprtout hidden"><b>Prénom</b></th>
                                <th class="filter"><b>Société</b></th>
                                <th class="filter exprtout hidden"><b>Adresse</b></th>
                                <th class="filter exprtout hidden"><b>Code postal</b></th>
                                <th class="filter"><b>Ville</b></th>
                                <th class="filter"><b>Téléphone</b></th>
                                <th class="filter exprtout hidden"><b>Mobile</b></th>
                                <th class="filter exprtout hidden"><b>Email</b></th>
                                <th class="filter exprtout hidden"><b>Activité société</b></th>
                                <th class="filter exprtout hidden"><b>Question 1</b></th>
                                <th class="filter exprtout hidden"><b>Question 2</b></th>
                                <th class="filter exprtout hidden"><b>Question 3</b></th>
                                <th class="filter exprtout hidden"><b>Question 4</b></th>
                                <th class="filter exprtout hidden"><b>Question 5</b></th>
                                <th class="filter exprtout hidden"><b>Surface total société</b></th>
                                <th class="filter exprtout hidden"><b>Surface de bureau</b></th>
                                <th class="filter exprtout hidden"><b>Sous contrat</b></th>
                                <th class="filter exprtout hidden"><b>Date anniversaire du contrat</b></th>
                                <th class="filter exprtout hidden"><b>Protection sociale</b></th>
                                <th class="filter exprtout hidden"><b>Mutuelle santé</b></th>
                                <th class="filter exprtout hidden"><b>Mutuelle entreprise</b></th>
                                <th class="filter exprtout hidden"><b>Nom de sa mutuelle</b></th>
                                <th class="filter exprtout hidden"><b>Montant de la mutuelle actuelle</b></th>
                                <th class="filter exprtout hidden"><b>Seul sur le contrat</b></th>
                                <th class="filter exprtout hidden"><b>Montant impot annuel</b></th>
                                <th class="filter exprtout hidden"><b>Taux endettement</b></th>
                                <th class="filter exprtout hidden"><b>Age</b></th>
                                <th class="filter exprtout hidden"><b>Profession</b></th>
                                <th class="filter exprtout hidden"><b>Propriétaire ou Locataire</b></th>
                                <th class="filter exprtout hidden"><b>Statut matrimonial</b></th>
                                <th class="filter exprtout hidden"><b>Composition foyer</b></th>
{{--
                                <th class="filter exprtout hidden"><b>Nom et prénom du contact</b></th>
--}}
                                <th class="filter"><b>Nom de la personne au rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
                                <th class="filter date"><b>Date rendez-vous</b></th>
                                <!-- <th class="filter">kDate rendez-vous</th> -->
                                <th class="filter"><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Rendez-vous pour</b></th>
                                <th class="filter exprtout hidden"><b>Note</b></th>
                                <th class="filter exprtout hidden"><b>Note du Staff</b></th>
                                <th class="filter"><b>Date de création</b></th>
                                <th class="filter"><b>Dernière modification </b></th>
                            </tr>
                            
                            @elseif (Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial')
                            <tr class="header">
                                <th style="width: 50px;" class="noExl no-filter no-sort no-search ">Bouton détail</th>
                                <th class="filter"><b>Référence</b></th>
                                <th class=""><b>Type</b></th>
                                <th class=""><b>Société</b></th>
                                <th class=""><b>Ville</b></th>
                                <th class=""><b>Téléphone</b></th>
                                <th class=""><b>Nom de la personne rendez-vous</b></th>
                                <th class="filter"><b>Qualification</b></th>
                                <th class="filter date"><b>Date rendez-vous</b></th>
                                <th class=""><b>Heure rendez-vous</b></th>
                                <th class="filter"><b>Rendez-vous pour</b></th>
                            </tr>
                            @endif
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th style="width: 50px;" class="noExl no-filter no-sort no-search @if (Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff' && Auth::user()->statut <> 'Superviseur' && Auth::user()->statut <> 'Agent') hidden @endif"></th>
                            <th class="filter"><b>Référence</b></th>
                            <th class="filter"><b>Centre d’appels</b></th>
                            <th class="filter"><b>Responsable/agent</b></th>
                            <th class="filter"><b>Campagne en cours</b></th>
                            <th class="filter exprtout hidden"><b>Nom</b></th>
                            <th class="filter exprtout hidden"><b>Prénom</b></th>
                            <th class="filter"><b>Société</b></th>
                            <th class="filter exprtout hidden"><b>Adresse</b></th>
                            <th class="filter exprtout hidden"><b>Code postal</b></th>
                            <th class="filter"><b>Ville</b></th>
                            <th class="filter"><b>Téléphone</b></th>
                            <th class="filter exprtout hidden"><b>Mobile</b></th>
                            <th class="filter exprtout hidden"><b>Email</b></th>
                            <th class="filter exprtout hidden"><b>Activité société</b></th>
                            <th class="filter exprtout hidden"><b>Question 1</b></th>
                            <th class="filter exprtout hidden"><b>Question 2</b></th>
                            <th class="filter exprtout hidden"><b>Question 3</b></th>
                            <th class="filter exprtout hidden"><b>Question 4</b></th>
                            <th class="filter exprtout hidden"><b>Question 5</b></th>
                            <th class="filter exprtout hidden"><b>Surface total société</b></th>
                            <th class="filter exprtout hidden"><b>Surface de bureau</b></th>
                            <th class="filter exprtout hidden"><b>Sous contrat</b></th>
                            <th class="filter exprtout hidden"><b>Date anniversaire du contrat</b></th>
                            <th class="filter exprtout hidden"><b>Protection sociale</b></th>
                            <th class="filter exprtout hidden"><b>Mutuelle santé</b></th>
                            <th class="filter exprtout hidden"><b>Mutuelle entreprise</b></th>
                            <th class="filter exprtout hidden"><b>Nom de sa mutuelle</b></th>
                            <th class="filter exprtout hidden"><b>Montant de la mutuelle actuelle</b></th>
                            <th class="filter exprtout hidden"><b>Seul sur le contrat</b></th>
                            <th class="filter exprtout hidden"><b>Montant impot annuel</b></th>
                            <th class="filter exprtout hidden"><b>Taux endettement</b></th>
                            <th class="filter exprtout hidden"><b>Age</b></th>
                            <th class="filter exprtout hidden"><b>Profession</b></th>
                            <th class="filter exprtout hidden"><b>Propriétaire ou Locataire</b></th>
                            <th class="filter exprtout hidden"><b>Statut matrimonial</b></th>
                            <th class="filter exprtout hidden"><b>Composition foyer</b></th>
                            {{--
                                                            <th class="filter exprtout hidden"><b>Nom et prénom du contact</b></th>
                            --}}
                            <th class="filter"><b>Nom de la personne au rendez-vous</b></th>
                            <th class="filter"><b>Qualification</b></th>
                            <th class="filter date"><b>Date rendez-vous</b></th>
                            <!-- <th class="filter">kDate rendez-vous</th> -->
                            <th class="filter"><b>Heure rendez-vous</b></th>
                            <th class="filter"><b>Rendez-vous pour</b></th>
                            <th class="filter exprtout hidden"><b>Note</b></th>
                            <th class="filter exprtout hidden"><b>Note du Staff</b></th>
                            <th class="filter"><b>Date de création</b></th>
                            <th class="filter"><b>Dernière modification </b></th>
                        </tr>
                        </tfoot>

                    </table>
                    <button id="btnrdvexcel" class="btn btn-success btn-sm exportToExcel hidden ">Export excel</button>
                </div>
            </div>
        
        </div>
    </div>
</div>

@endsection