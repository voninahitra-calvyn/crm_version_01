@extends('layouts.app')

@section('style')
    <!--
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 -->
@endsection

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Agenda')
@section('contentheader_levelactive')
    <li class="active"><a href="{{ route('agendas.index')}}"><i class="fa fa-dashboard"></i> Agenda</a></li>
    <li class="active">Rendez-vous</li>
@overwrite

@section('main-content')
    <input type="text" class="form-control hidden" value="{{Auth::user()->statut}}" name="user_statut" id="user_statut">
    <div class="row">
        <div class="col-md-3">

        <!--
			<div class="box box-solid">
				<div class="box-header with-border rouge">
					<h4 class="box-title">Type rendez-vous</h4>
				</div>
				<div class="box-body ">
					@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent')
            <div id="filters">
              <form class="filtreagendaform">
                <div class="form-group hidden">
                    <label for="searchTerm" class="col-sm-12 control-label">Recherche : </label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control searchTerm" name="searchTerm" id="searchTerm" placeholder="Recherche..." >
                    </div>
                </div>
                <div class="form-group client">
                    <label for="searchTerm" class="col-sm-12 control-label rouge">Client : </label>
                    <div class="col-sm-12">
                    <select class="form-control select2 filteragenda" name="clientrdv" id="clientrdv" style="width: 100%;" >
                        <option value="all">Tous</option>
@foreach($comptesclient as $cli)
                <option value="{{$cli->prenom}} {{$cli->nom}}">{{$cli->prenom}} {{$cli->nom}}</option>
								@endforeach
                    </select>
                    </div>
                </div>
              </form>
            </div>
@else
            <input type="text" class="form-control hidden" name="searchTerm" id="searchTerm">
            <input type="text" value="{{Auth::user()->prenom}} {{Auth::user()->nom}}" class="form-control hidden" name="clientrdv" id="clientrdv">
					@endif
                <div id="external-events">
                    <div class="external-event bg-light-gray">Rendez-vous envoyé</div>
                    <div class="external-event bg-green">Rendez-vous confirmé</div>
                    <div class="external-event bg-red">Rendez-vous annulé</div>
                    <div class="external-event bg-light-blue">Rendez-vous en attente</div>
                    <div class="external-event bg-green-active">Rendez-vous validé</div>
                </div>
            </div>
        </div>
-->

            {{-- agenda breakpoint--}}
            <div class="box box-solid">
                {{--@if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff' || Auth::user()->statut == 'Superviseur' || Auth::user()->statut == 'Agent')--}}
                    <div class="box-header with-border rouge">
                        <h4 class="box-title">Filtre</h4>
                    </div>
                    <div class="box-body filtre2">
                        <div id="filters">
                            <form class="">
                                <div class="form-group hidden">
                                    <label for="searchTerm" class="col-sm-12 control-label">Recherche : </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control searchTerm" name="searchTerm"
                                               id="searchTerm" placeholder="Recherche...">
                                    </div>
                                </div>

                                <div class="form-group client">
                                    <label for="filteragenda" class="col-sm-12 control-label">Client : </label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2 filteragenda" name="clientrdv"
                                                id="clientrdv" style="width: 100%;">
                                            <option value="all">Tous</option>
                                          @if((Auth::user()->statut == 'Responsable' || Auth::user()->statut == 'Commercial'))
                                                <option value="{{$comptesclient->prenom}} {{$comptesclient->nom}}"
                                                        data-idclient="{{$comptesclient->_id}}" @if(isset($client)) selected @endif>{{$comptesclient->prenom}} {{$comptesclient->nom}} </option>
                                            @else

                                              @if(isset($client))
                                                <option value="{{$client->prenom}} {{$client->nom}}"
                                                        data-idclient="{{$client->_id}}"
                                                        selected>{{$client->prenom}} {{$client->nom}}</option>
                                                @else
                                                @foreach($comptesclient as $cli)

                                                        <option value="{{$cli->prenom}} {{$cli->nom}}"
                                                                data-idclient="{{$cli->_id}}">{{$cli->prenom}} {{$cli->nom}} </option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group client hidden">
                                    <label for="filterdisponibiliteagenda" class="col-sm-12 control-label">Disponibilité
                                        : </label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2 filterdisponibiliteagenda"
                                                name="disponibiliterdv" id="disponibiliterdv" style="width: 100%;">
                                            <option class="filterdisponibilite" value="disponible">Tous</option>
                                            <option class="filterdisponibilite" value="#f39c12">Indisponible</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div><!--- filters --->

                    </div>
                {{--@else--}}
                    <input type="text" class="form-control hidden" name="searchTerm" id="searchTerm">
                    <input type="text" value="{{Auth::user()->prenom}} {{Auth::user()->nom}}"
                           class="form-control hidden" name="clientrdv" id="clientrdv">
            {{--@endif--}}
            <!-- /.box-body -->
            </div>

            {{--end agenda breakpoint--}}
            <div class="box box-solid">
                <div class="box-header with-border rouge">
                    <h4 class="box-title">Type rendez-vous</h4>
                </div>
                <div class="box-body">
                    <!-- the events -->
                    <div id="external-events">
                        <!-- <div class="external-event bg-aqua">Rendez-vous brut</div> -->
                        <div class="external-event bg-light-gray">Rendez-vous envoyé</div>
                        <!-- <div class="external-event bg-yellow">Rendez-vous refusé</div> -->
                        <div class="external-event bg-green">Rendez-vous confirmé</div>
                        <div class="external-event bg-red">Rendez-vous annulé</div>
                        <div class="external-event bg-light-blue">Rendez-vous en attente</div>
                        <div class="external-event bg-green-active">Rendez-vous validé</div>
                        <div class="external-event bg-yellow">Indisponible</div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-danger">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.box-body -->

                <script>

                </script>

            </div>
            @if (Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial')
             @if(isset($client))
               <div class="form-group">
                        <div class="col-sm-12 control-txt">
                        <label for="note" >Agenda public : </label>
                            <a href="{{ url('/comresp_public')}}/{{$client->_id}}"
                               target="_blank">{{ url('/comresp_public')}}/{{$client->_id}}</a>
                         </div>
                    </div>
               @endif
            @endif
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <button type="button" class="btn modal btn-success ajoutagendaModal hidden" data-toggle="modal"
            data-target="#ajoutagendaModal">
        Ajout
    </button>

    <button type="button" class="btn modal btn-primary modifagendaModal hidden" data-toggle="modal"
            data-target="#modifagendaModal">
        Modif
    </button>

    <button type="button" class="btn modal btn-primary detailagendaModal hidden" data-toggle="modal"
            data-target="#detailagendaModal">
        Détails
    </button>
    <div class="modal fade ajoutagendaModal" id="ajoutagendaModal" name="ajoutagendaModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="{{ route('agendas.store') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Veuillez s'il vous plait corriger les erreurs suivantes
                        </div>
                        <div class="alert-danger-liste">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                    @endif
                    {!! csrf_field() !!}
                    <div class="modal-header box-header with-border rouge">
                        <button type="button" class="close modal1 hidden" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Saisie plage d'horaire indisponible </h4>
                    </div>
                    <div class="modal-body">
                        @if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
                            <b>Client:</b>
                            <br/>
                            <select class="form-control select2 filteragenda" name="client_priv" id="client_priv"
                                    style="width: 100%;">
                                @foreach($comptesclient as $cli)
                                    <option value="{{$cli->prenom}} {{$cli->nom}}">{{$cli->prenom}} {{$cli->nom}}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control hidden" name="searchTerm" id="searchTerm">
                            <input type="text" value="{{Auth::user()->prenom}} {{Auth::user()->nom}}"
                                   class="form-control hidden" name="client_priv" id="client_priv">
                        @endif

                        <br/>
                        <br/>
                        <b>Date début:</b>
                        <br/>
                        <input type="text" class="form-control" name="date_debutdh" id="date_debutdh">

                        <br/>
                        <b>Date fin:</b>
                        <br/>
                        <input type="text" class="form-control " name="date_findh" id="date_findh">

                        <br/>
                        <b>Titre:</b>
                        <br/>
                        <input type="text" class="form-control" name="titredh" id="titredh">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn annuler_dh btn-default" id="annuler_dh" data-dismiss="modal">
                            Annuler
                        </button>
                        <input type="submit" class="btn valider_dh btn-primary" id="valider_dh" value="Valider">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modifagendaModal" id="modifagendaModal" name="modifagendaModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="{{ route('agendas.store') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Veuillez s'il vous plait corriger les erreurs suivantes
                        </div>
                        <div class="alert-danger-liste">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br/>
                    @endif
                    {!! csrf_field() !!}
                    <div class="modal-header box-header with-border rouge">
                        <button type="button" class="close modal1 hidden" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modification plage d'horaire indisponible </h4>
                    </div>
                    <div class="modal-body">
                        <b>Date début:</b>
                        <br/>
                        <input type="text" class="form-control" name="date_debutdhM" id="date_debutdhM">

                        <br/>
                        <b>Date fin:</b>
                        <br/>
                        <input type="text" class="form-control" name="date_findhM" id="date_findhM">

                        <br/>
                        <b>Titre:</b>
                        <br/>
                        <input type="text" class="form-control" name="titredhM" id="titredhM">
                        <input type="text" class="form-control hidden" name="iddhM" id="iddhM">
                        <!-- <textarea class="form-control" rows="3" name="titredhM" id="titredhM"></textarea> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn annuler_dh btn-default" id="annuler_dh" data-dismiss="modal">
                            Annuler
                        </button>
                        <input type="submit" class="btn valider_dh btn-primary" id="valider_dh" value="Modifier">
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade detailagendaModal" id="detailagendaModal" name="detailagendaModal" tabindex="-1"
         role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
                    <div class="alert-danger-liste">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                {!! csrf_field() !!}
                <div class="modal-header box-header with-border rouge">
                    <button type="button" class="close modal1 blanc" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Détails agenda </h4>
                </div>
                <div class="modal-body">
                    <b>Titre:</b>
                    <div name="titre_details" id="titre_details"></div>
                    <b>Date:</b>
                    <div name="date_details" id="date_details"></div>
                    <b>Heure:</b>
                    <div name="heure_details" id="heure_details"></div>
                    <b class="detailsrdv">Adresse:</b>
                    <div class="detailsrdv" name="adresse_details" id="adresse_details"></div>
                    <b class="detailsrdv">Note:</b>
                    <div class="detailsrdv" name="note_details" id="note_details"></div>

                    <!-- <br /> -->
                    <!-- <b>Titre:</b> -->
                    <!-- <br /> -->
                    <!-- <input type="text" class="form-control" name="titredhD" id="titredhD"> -->
                    <!-- <textarea class="form-control" rows="3" name="titredhD" id="titredhD"></textarea> -->
                    <!-- <div name="titredhD" id="titredhD"></div> -->
                </div>
                <form action="{{route('agendas.suppEvent', ['fakeid'])}}" method="post" class="">
                    @csrf
                    @method('GET')
                    <div class="modal-footer">
                        <button type="button" class="btn annuler_dh btn-default" id="annuler_dh" data-dismiss="modal">
                            Fermer
                        </button>
                        <input type="text" class="form-control hidden" name="id_details" id="id_details">
                        <button type="submit" class="btn supprimer_details btn-danger" id="supprimer_details">
                            Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal modal-success fade" id="modal-success">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Success Modal</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@section('script')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
@endsection
