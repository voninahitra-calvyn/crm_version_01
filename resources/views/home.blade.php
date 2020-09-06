@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title', 'Tableau de bord principal')

@section('contentheader_levelactive')
	<li class="active"><a href="{{ route('home.index')}}"><i class="fa fa-dashboard"></i> Tableau de bord principal</a></li>
@overwrite

@section('main-content')

    <div class="accueil-page">
        <h3 class="headline text-red">Bonjour {{ Auth::user()->prenom }} {{ Auth::user()->nom }}!</h3>
    </div><!-- /.error-page -->
@endsection
