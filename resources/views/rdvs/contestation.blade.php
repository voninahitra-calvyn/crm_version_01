@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Ajout rendez-vous ')

@section('contentheader_levelactive')
<li><a href="{{ route('rdvs.defiscalisation')}}"><i class="fa fa-dashboard"></i>Rendez-vous </a></li>
<li class="active">Ajout</li>
@overwrite


@section('main-content')
<!-- Main content -->
<section class="content">
    <div class="box box-danger">
        <form class="form-horizontal" method="post" action="{{ route('rdvs.contestation', $rdv->id) }}" enctype="multipart/form-data">
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

            {!! csrf_field() !!}
            <div class="box-body">
                <!-- <input type="text" class="form-control hidden" value="{{--$client->_id--}}" name="client_id" id="client_id"> -->
                 <input type="text" class="form-control hidden" value="{{ $rdv->compte_id }}" name="compte_id" id="compte_id">
                <div class="form-group">
                    <label for="cli" class="col-sm-2 control-label">Client : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{ $rdv->cli }}" name="cli" id="cli" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="note" class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="6" name="note" id="note" placeholder="Note">{{ $rdv->note }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <a href="javascript:history.go(-1)" class="btn btn-default">Annuler</a>
                        <button type="submit" class="btn btn-info pull-right">Contester</button>
                    </div>
                </div>

            </div>
        </form>

    </div>
</section>
@endsection

<script>
    $(function() {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //Date picker
        $('#date_rendezvous').datepicker({
            autoclose: true
        })

    })
</script>