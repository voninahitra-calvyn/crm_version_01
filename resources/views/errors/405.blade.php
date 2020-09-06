@extends('layouts.errors')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.pagenotfound') }}
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 405</h2>
        <div class="error-content">
            <h3 class="text-yellow"><i class="fa fa-warning text-yellow"></i> <b>CRM MÉTIER ERREUR!</b> <br/></h3>
            <h3><i class="text-yellow"></i> <b>{{ trans('adminlte_lang::message.pagenotfound') }}.</h3>
            <p>
                {{ trans('adminlte_lang::message.notfindpage') }}
                {{ trans('adminlte_lang::message.mainwhile') }} <a href='{{ url('/home') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a> 
			</p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection