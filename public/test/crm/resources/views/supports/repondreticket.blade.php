@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Support client')

@section('contentheader_levelactive')
	<li><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Support client</a></li>
	<li class="active">Repondre ticket</li>
@overwrite


@section('main-content')
    <!-- Main content -->
    <section class="content">
		<!-- Support: {!!$support!!}<br/> -->

		@foreach ($support as $sup)
			@if ($sup->support_id==null)
				<div class="direct-chat-msg">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-left">{{$sup->prenom}} {{$sup->nom}}</span>
						<span class="direct-chat-timestamp pull-right">{{ date('d M Y H:i', strtotime($sup->created_at." +1 hours")) }} </span>

					</div>
					@if ($user->img=='')
						<img class="direct-chat-img" src="{{ asset('/img/avatar.png') }}" alt="User Image"/>
					@else
						<img class="direct-chat-img" src="{{ URL::to('/') }}/img/utilisateurs/{{ $profil->img }}" alt="User Image"/>
					@endif
					<div class="direct-chat-text">
						{{$sup->message}}
						<span class="username  pull-right">
						  <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
							<form action="{{route('supports.destroy', $sup->id)}}" method="post" class="">
								@csrf
								@method('DELETE')
								<button class="pull-right btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
							</form>
						  
						</span>
					</div>
				</div>
			@else
				<div class="direct-chat-msg right">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">{{$sup->prenom}} {{$sup->nom}}</span>
						<span class="direct-chat-timestamp pull-left">{{ date('d M Y H:i', strtotime($sup->created_at." +1 hours")) }}</span>
					</div>
					@if ($user->img=='')
						<img class="direct-chat-img" src="{{ asset('/img/avatar2.png') }}" alt="User Image"/>
					@else
						<img class="direct-chat-img" src="{{ URL::to('/') }}/img/utilisateurs/{{ $profil->img }}" alt="User Image"/>
					@endif
					<div class="direct-chat-text">
						{{$sup->message}}
						<span class="username  pull-right">
						  <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
							<form action="{{route('supports.destroy', $sup->id)}}" method="post" class="">
								@csrf
								@method('DELETE')
								<button class="pull-right admin btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>
							</form>
						  
						</span>
					</div>
				</div>
			@endif	
		@endforeach

			<form class="form-horizontal" method="POST" action="{{ route('supports.store') }}" @if (Auth::user()->statut <> 'Administrateur' && Auth::user()->statut <> 'Staff')hidden @endif>
			{!! csrf_field() !!}
				<div class="input-group">
					<input type="text" name="nom" id="nom" value="{{Auth::user()->nom}}" hidden>
					<input type="text" name="prenom" id="prenom" value="{{Auth::user()->prenom}}" hidden>
					<input type="text" name="email" id="email" value="{{Auth::user()->email}}" hidden>
					<input type="text" name="user_id" id="user_id" value="{{$sup->user_id}}" hidden>
					<input type="text" name="support_id" id="support_id" value="{{$sup->_id}}" hidden>
					<input type="text" name="statut" id="statut" value="{{Auth::user()->statut}}" hidden>
					<input type="text" name="message" id="message" placeholder="Tapez le message ..." class="form-control">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-danger btn-flat">Répondre</button>
					</span>
				</div>
			</form>
			<div class="form-group">
				<div class="col-sm-12">
					<br/><a href="{{ url('/supports')}}" class="btn btn-default" target="_blank" >Retour</a>
				</div>
			</div>
	</section>
@endsection

