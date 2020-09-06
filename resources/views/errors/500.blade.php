@extends('layouts.errors')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.servererror') }}
@endsection

@section('main-content')

    <div class="error-page">
        <h2 class="headline text-red">500</h2>
        <div class="error-content">
            <h3 class="text-red"><i class="fa fa-warning text-red"></i> <b>CRM MÉTIER ERREUR!</b> <br/></h3>
            <h3><i class="text-red"></i> <b>{{ trans('adminlte_lang::message.somethingwrong') }}.</h3>
            <p>
                {{ trans('adminlte_lang::message.wewillwork') }}
                {{ trans('adminlte_lang::message.mainwhile') }} <a href='{{ url('/home') }}'>{{ trans('adminlte_lang::message.returndashboard') }}</a> ou contacter l'administrateur.
            </p>
            <!-- <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="{{ trans('adminlte_lang::message.search') }}"/>
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form> -->
        </div>
    </div><!-- /.error-page -->
@endsection