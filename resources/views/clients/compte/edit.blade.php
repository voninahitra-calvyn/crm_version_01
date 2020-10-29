@extends('layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Compte client')

@section('contentheader_levelactive')
    <li><a href="{{ route('clients.index')}}"><i class="fa fa-dashboard"></i> Client</a></li>
    <li><a href="{{route('clients.compte', [$client])}}">Compte</a></li>
    <li class="active">Modification</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title form">Modification compte</h3>
            </div>
            <div class="row-fluid">
                <div class="col-sm-12">
                    @if($logo->logo)
                    <img id="ok_imageadd" class="img-responsive img-circle image_form" src="{{ asset('/uploads/logo') }}/{{ $logo->logo }}" controls></img>
                    @endif
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="{{ route('clients.updatecompte', [$compte]) }}">
                <input type="hidden" name="_method" value="GET">

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

            {{ csrf_field() }}
            <!--
				@if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Veuillez s'il vous plait corriger les erreurs suivantes
                </div>
@endif
                    -->
                <input type="text" class="form-control hidden" name="campagne" id="campagne" value="{{$campagne}}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="nom" class="col-sm-2 control-label">ID : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID"
                                   value="{{ substr($compte->_id,3,-16) }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nom" class="col-sm-2 control-label">Nom : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom"
                                   value="{{ $compte->nom }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prenom" class="col-sm-2 control-label">Prenom : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom"
                                   value="{{ $compte->prenom }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="telephone" id="telephone"
                                   placeholder="Téléphone" value="{{ $compte->telephone }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-lowercase" name="email" id="email" placeholder="Email"
                                   value="{{ $compte->email }}">
                        </div>
                    </div>
                    <div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
                        <label for="password" class="col-sm-2 control-label">Mot de passe : </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Mot de passe">
                        </div>
                    </div>
                    <div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
                        <label for="statut" class="col-sm-2 control-label">Statut : </label>
                        <div class="col-sm-10">
                            <select class="form-control selecttype" name="statut" style="width: 100%;">
                                <option value="Responsable" {{ ( $compte->statut == 'Responsable') ? 'selected' : '' }}>
                                    Responsable
                                </option>
                                <option value="Commercial" {{ ( $compte->statut == 'Commercial') ? 'selected' : '' }}>
                                    Commercial
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note" class="col-sm-2 control-label">Indispnonibilité horaire : </label>
                        <div class="col-sm-10">
                            <a type="button" data-toggle="modal" data-target="#confirmeModalMod">
                                <input type="button" class="btn btn-default form-control" value="Saisissez ici la plage horaire" style="text-align: left;"/>
                            </a>
                        </div>
                        <div class="modal fade" tabindex="-1" role="dialog" id="confirmeModalMod">
                            <div class="modal-dialog modal-overlay" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color:#bb2839; ">
                                        <h5 class="modal-title" style="color: #fff;">Heure d'indisponibilité</h5>
                                    </div>
                                    <div class="modal-body">

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Lundi
                                                    <button type="button" id="lundi"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['lundi'] ))
                                                    @foreach($compte->plage_horaire['lundi'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="lundi"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input id="lundi" class="form-control heure_plage"
                                                                               name="start[lundi][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[lundi][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Mardi
                                                    <button type="button" id="mardi"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['mardi'] ))
                                                    @foreach($compte->plage_horaire['mardi'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'start' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="start[mardi][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[mardi][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Mercredi
                                                    <button type="button" id="mercredi"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['mercredi'] ))
                                                    @foreach($compte->plage_horaire['mercredi'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'start' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="start[mercredi][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[mercredi][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Jeudi
                                                    <button type="button" id="jeudi"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['jeudi'] ))
                                                    @foreach($compte->plage_horaire['jeudi'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'start' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="start[jeudi][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[jeudi][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Vendredi
                                                    <button type="button" id="vendredi"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['vendredi'] ))
                                                    @foreach($compte->plage_horaire['vendredi'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'start' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="start[vendredi][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[vendredi][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Samedi
                                                    <button type="button" id="samedi"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['samedi'] ))
                                                    @foreach($compte->plage_horaire['samedi'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'start' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="start[samedi][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[samedi][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    Dimanche
                                                    <button type="button" id="dimanche"
                                                            class="btn btn-info btn-xs pull-right add_plage">Ajouter une
                                                        plage horaire
                                                    </button>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                @if(isset($compte->plage_horaire['dimanche'] ))
                                                    @foreach($compte->plage_horaire['dimanche'] as $plg)
                                                        <div class="ligne">
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'start' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de début
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="start[dimanche][]" type="text"
                                                                               value="{{$plg[0]}}">
                                                                        <span class="input-group-addon">
							                        	                    <span class="glyphicon glyphicon-time"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-10">
                                                                    <label for="{{ 'end_' . $index }}"
                                                                           class="col-sm-4 control-label">Heure de fin
                                                                        :</label>
                                                                    <div class="col-sm-8 input-group date">
                                                                        <input class="form-control heure_plage"
                                                                               name="end[dimanche][]"
                                                                               id="{{ 'end_' . $index++ }}"
                                                                               type="text" value="{{$plg[1]}}">
                                                                        <span class="input-group-addon">
							                       		                    <span class="glyphicon glyphicon-time"></span>
							                                        	</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <button type="button" class="btn btn-danger">
                                                                        Supprimer
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group">
                                            <button type="button" style="background-color: #bb2839; color: #fff;"
                                                    id="AnnulerBtnMod" class="btn btn-default" data-dismiss="modal">OK
                                            </button>
                                        </div>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                    </div>
                    <div class="form-group">
                        <label for="agendapriv" class="col-sm-2 control-label">Agenda privé google ou outlook: </label>
                        <div class="col-sm-10">
                            <input type="text" class=" form-control" name="agendapriv" id="agendapriv"
                                   value="{{ $compte->agendapriv }}">
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <label for="agendaoutlook" class="col-sm-2 control-label">Agenda outlook : </label>
                        <div class="col-sm-10">
                            <input type="text" class=" form-control" name="agendaoutlook" id="agendaoutlook"
                                   value="">
                        </div>
                    </div>
                    @if (Auth::user()->statut == 'Administrateur' || Auth::user()->statut == 'Staff')
                    <div class="form-group">
                        <label for="agendaprivadmin" class="col-sm-2 control-label">Agenda privé Administrateur : </label>
                        <div class="col-sm-10">
                            <input type="text" class=" form-control" name="agendaprivadmin" id="agendaprivadmin"
                                   value="{{ $compte->agendaprivadmin }}">
                        </div>
                    </div>
                    @endif
                    @if (Auth::user()->statut <> 'Responsable' && Auth::user()->statut <> 'Commercial')
                    <div class="form-group">
                        <label for="note" class="col-sm-2 control-label">Agenda public : </label>
                        <div class="col-sm-10 control-txt">

                            {{--<input type="text" class=" form-control" name="agendapub" id="agendapub"
                                   value="{{ $compte->agendapub }}">--}}
                            <a href="{{ url('/comresp_public')}}/{{$compte->_id}}"
                               target="_blank">{{ url('/comresp_public')}}/{{$compte->_id}}</a>
                         </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="note" class="col-sm-2 control-label">Note : </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="note" id="note"
                                      placeholder="Note">{{ $compte->note }}</textarea>
                        </div>
                    </div>
                    @if (Auth::user()->statut == 'Administrateur')
                        <div class="form-group">
                            <label for="etat" class="col-sm-2 control-label">Etat : {{--$rdv->typerdv--}}</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="etat" id="etat" style="width: 100%;"
                                        required>
                                    @if(isset($client->etat))
                                        <option value="Actif" {{$client->etat=="Actif"?'selected':''}}>Activé</option>
                                        <option value="Inactif" {{$client->etat=="Inactif"?'selected':''}}>Désactivé
                                        </option>
                                    @else
                                        <option value="Actif">Activé</option>
                                        <option value="Inactif">Désactivé</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                            <a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
                            <button type="submit" class="btn btn-primary pull-right">Valider</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>


    </section>

@endsection



