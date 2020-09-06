@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Support client')

@section('contentheader_levelactive')
	<li><a href="{{ route('staffs.index')}}"><i class="fa fa-dashboard"></i> Support client</a></li>
	<li class="active">Liste ticket</li>
@overwrite


@section('main-content')
    <!-- Main content -->
		<div >
		  @if(session()->get('error'))
			<div class="message alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> Erreur</h4>
				{{ session()->get('error') }}
			</div>
		  @endif
		</div>
    <section class="content">
		<!-- Supports: {!!$supports!!}<br/> 
		**************<br/>
		supportsdistinct: {!!$supportsdistinct!!}<br/>  -->
		<!-- **************<br/>
		User: {!!$user!!}<br/>  -->
		
        <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
                <tbody>
					@forelse ($supportsdistinct as $sup)
						<tr class="@if ($sup->repondu <> 'Oui') bold @endif" >
							<td class="mailbox-name col-md-4">
								<a href="{{ route('supports.repondreticket',$sup->user_id)}}">
									<div>{{$sup->prenomE}} {{$sup->nomE}}</div>
								<span><i>{{$sup->statutE}}</i></span>
								</a>
							</td>
							<td class="mailbox-subject overflow col-md-6">
								<a href="{{ route('supports.repondreticket',$sup->user_id)}}">
									{{$sup->message}}
								</a>
							</td>
							<td class="mailbox-date col-md-2">
								<a href="{{ route('supports.repondreticket',$sup->user_id)}}">
									{{ date('d-m-Y H:i', strtotime($sup->created_at." +1 hours")) }}
								</a>
							</td>
						</tr>
					@empty
						<tr>
							<td class="mailbox-name"><a><b>Pas de ticket pour l'instant</b></a></td>
						</tr>
					@endforelse
                </tbody>
            </table>
        </div>

	</section>
		
  
@endsection

