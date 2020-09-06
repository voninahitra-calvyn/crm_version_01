@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
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
<div class="row">
    <div class="col-md-3">
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
				<!-- {!! $calendar->calendar() !!} -->
            </div>
            <!-- /.box-body -->
			
			<script>

			</script>
			
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('script')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> -->
<!-- {!! $calendar->script() !!} -->
@endsection
