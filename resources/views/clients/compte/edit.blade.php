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
					</div><br />
                @endif
				
				{{ csrf_field() }}
                <!--
				@if ($errors->any())
                    <div class="alert alert-danger" role="alert">
						Veuillez s'il vous plait corriger les erreurs suivantes
                    </div>
                @endif
				-->
				<input type="text" class="form-control hidden" name="campagne" id="campagne" value="{{$campagne}}" >
				<div class="box-body">
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">ID : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="idcompte" id="idcompte" placeholder="ID" value="{{ substr($compte->_id,3,-16) }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label">Nom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="{{ $compte->nom }}">
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label">Prenom : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="{{ $compte->prenom }}">
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-2 control-label">Téléphone : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Téléphone" value="{{ $compte->telephone }}" >
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email : </label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ $compte->email }}">
						</div>
					</div>
					<div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif" >
						<label for="password" class="col-sm-2 control-label">Mot de passe : </label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
						</div>
					</div>
					<div class="form-group @if (Auth::user()->statut <> 'Administrateur') hidden @endif">
						<label for="statut" class="col-sm-2 control-label">Statut : </label>
						<div class="col-sm-10">
							<select class="form-control selecttype" name="statut" style="width: 100%;">
								<option value="Responsable" {{ ( $compte->statut == 'Responsable') ? 'selected' : '' }}>Responsable</option>
								<option value="Commercial" {{ ( $compte->statut == 'Commercial') ? 'selected' : '' }}>Commercial</option>
							</select>
						</div>
					</div>

					@foreach($days as $day)
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">
									{{ $day->name }}
									<button type="button" id="{{--{{ $day->id }}--}}" class="btn btn-info btn-xs pull-right add_plage">Ajouter une plage horaire</button>
								</h3>
							</div>
							<div class="panel-body">
								{{--@foreach($day->restaurants as $restaurant)--}}
									<div class="ligne">
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="{{--{{ 'start' . $index }}--}}" class="col-sm-4 control-label">Heure de début :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="{{--{{ 'start[' . $day->id . '][]' }--}}}" id ="{{--{{ 'start_' . $index++ }}--}}" type="text" value="{{--{{ $restaurant->pivot->start_time }}--}}">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="{{--{{ 'end_' . $index }}--}}" class="col-sm-4 control-label">Heure de fin :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="{{--{{ 'end[' . $day->id . '][]' }}--}}" id ="{{--{{ 'end_' . $index++ }}--}}" type="text" value="{{--{{ $restaurant->pivot->end_time }}--}}">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-danger">Supprimer</button>
											</div>
										</div>
									</div>
								<div class="ligne">
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="{{--{{ 'start' . $index }}--}}" class="col-sm-4 control-label">Heure de début :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="{{--{{ 'start[' . $day->id . '][]' }--}}}" id ="{{--{{ 'start_' . $index++ }}--}}" type="text" value="{{--{{ $restaurant->pivot->start_time }}--}}">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-sm-10">
												<label for="{{--{{ 'end_' . $index }}--}}" class="col-sm-4 control-label">Heure de fin :</label>
												<div class="col-sm-8 input-group date">
													<input class="form-control heure_plage" name="{{--{{ 'end[' . $day->id . '][]' }}--}}" id ="{{--{{ 'end_' . $index++ }}--}}" type="text" value="{{--{{ $restaurant->pivot->end_time }}--}}">
													<span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
												</div>
											</div>
											<div class="col-sm-2">
												<button type="button" class="btn btn-danger">Supprimer</button>
											</div>
										</div>
									</div>
								{{--@endforeach--}}
							</div>
						</div>
					@endforeach
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Agenda public : </label>
						<div class="col-sm-10 control-txt">
						  <a href="{{ url('/comresp_public')}}/{{$compte->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$compte->_id}}</a>
						  <!-- / <a href="{{ url('/agendacomresp_public')}}/{{$compte->_id}}">Cliquer ici pour télécharger fichier INC</a> --> 
						  <!-- <a href="{{ url('/agendacomresp_public')}}/{{$compte->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$compte->_id}}</a> -->
						  <!-- <a href="{{ asset('/uploads/agenda') }}/{{ $compte->_id }}.inc" target="_blank" >{{$compte->_id}}.inc</a> -->
						</div>
					</div>
					<div class="form-group">
						<label for="agendapriv" class="col-sm-2 control-label">Ajouter son agenda : </label>
						<div class="col-sm-10">
							<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="{{ $compte->agendapriv }}">
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="note" class="col-sm-2 control-label">Agenda public: </label>
						<div class="col-sm-10 control-txt">
						  <a href="{{ url('/comresp_public')}}/{{$compte->_id}}" target="_blank" >{{ url('/comresp_public')}}/{{$compte->_id}}</a>
						</div>
					</div>
					<div class="form-group">
						<label for="agendapriv" class="col-sm-2 control-label">Agenda privé: </label>
						<div class="col-sm-10">
							<input type="text" class=" form-control" name="agendapriv" id="agendapriv" value="{{ $compte->agendapriv }}">
						</div>
					</div> -->
					<div class="form-group">
						<label for="note" class="col-sm-2 control-label">Note : </label>
						<div class="col-sm-10">
						  <textarea class="form-control" rows="3" name="note" id="note" placeholder="Note">{{ $compte->note }}</textarea>
						</div>
					</div>
					@if (Auth::user()->statut == 'Administrateur')
						<div class="form-group">
							<label for="etat" class="col-sm-2 control-label">Etat : {{--$rdv->typerdv--}}</label>
							<div class="col-sm-10">
								<select class="form-control select2" name="etat" id="etat" style="width: 100%;" required>
									@if(isset($client->etat))
										<option value="Actif" {{$client->etat=="Actif"?'selected':''}}>Activé</option>
										<option value="Inactif" {{$client->etat=="Inactif"?'selected':''}}>Désactivé</option>
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

@section('scripts')
	<script src="{{ asset ('/js/jquery/jquery.min.js') }}"></script>
	<script>

        $(function () {
            // Initialisation des DateTimePicker
            //Timepicker
            $('.heure_plage').timepicker({
                showMeridian: false,
                showInputs: false
            })

            // Initialisation index pour étiquettes
            var index = {{ $index }};

            // Suppression d'une ligne de réponse (utilisation de "on" pour gérer les boutons créés dynamiquement)
            $(document).on('click', '.btn-danger', function(){
                $(this).parents('.ligne').remove();
            });

            // Ajout d'une ligne de plage horaire
            $('.add_plage').click(function() {
                var html = '<div class="ligne">\n'
                    + '<div class="row form-group">\n'
                    + '<div class="col-sm-10">\n'
                    + '<label for="start' + index++ + '" class="col-sm-4 control-label">Heure de début :</label>\n'
                    + '<div class="col-sm-8 input-group date">\n'
                    + '<input class="form-control" name="start[' + $(this).attr("id") + '][]" id ="' + index++ + '" type="text">\n'
                    + '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>\n'
                    + '</div></div></div>\n'
                    + '<div class="row form-group">\n'
                    + '<div class="col-sm-10">\n'
                    + '<label for="end' + index++ + '" class="col-sm-4 control-label">Heure de fin :</label>\n'
                    + '<div class="col-sm-8 input-group date">\n'
                    + '<input class="form-control" name="end[' + $(this).attr("id") + '][]" id ="' + index++ + '" type="text">\n'
                    + '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>\n'
                    + '</div></div>\n'
                    + '<div class="col-sm-2"><button type="button" class="btn btn-danger">Supprimer</button></div></div>\n'
                    + '</div>\n';
                $(this).parents('.panel').find('.panel-body').append(html);
                $('.date').datetimepicker({ locale: 'fr', format: 'LT' });
            });

            // Soumission
            $(document).on('submit', 'form', function(e) {
                e.preventDefault();
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json"
                })
                    .done(function(data) {
                        window.location.href = '{!! url('restaurant') !!}';
                    })
                    .fail(function(data) {
                        var obj = data.responseJSON;
                        // Nettoyage préliminaire
                        $('.help-block').text('');
                        $('.form-group').removeClass('has-error');
                        $('.alert').addClass('hidden');
                        // Balayage de l'objet
                        $.each(data.responseJSON, function (key, value) {
                            // Traitement du nom
                            if(key == 'name') {
                                $('.help-block').eq(0).text(value);
                                $('.form-group').eq(0).addClass('has-error');
                            }
                            // Traitement des erreurs des plages horaires
                            else {
                                $('.alert').removeClass('hidden');
                            }
                        });
                    });
            });
        });
	</script>

@endsection

