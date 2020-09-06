@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
	<!--<body class="hold-transition login-page" style="background-image: url(https://www.littlebigconnection.com/images/global/bg-home.jpg);">-->
	<!-- <body class="hold-transition login-page" style="background-image: url({{ asset('/img/bg-home.jpg') }});"> -->
	<body class="hold-transition login-page">
		<div id="app" v-cloak>
			<div class="login-box">
				<div class="login-logo">
					<a href="{{ url('/home') }}"><b>Connexion</b></a>
				</div><!-- /.login-logo -->

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<div class="login-box-body">
				<form action="{{ url('/login') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group has-feedback">
						<!-- <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/> -->
						<input class="form-control" placeholder="Adresse email" name="email"/>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row login">
						<div class="col-xs-6">
							<div class="checkbox icheck">
								<label class="hidden">
									<input style="" type="checkbox" name="remember"> {{ trans('adminlte_lang::message.remember') }}
								</label>
								<a href="{{ url('/password/reset') }}">Mot de passe oublié ?</a><br>
							</div>
						</div><!-- /.col -->
						<div class="col-xs-6">
							<button type="submit" class="btn btn-danger btn-block btn-flat">{{ trans('adminlte_lang::message.buttonsign') }}</button>
						</div><!-- /.col -->
					</div>
				</form>
				
				
				
				<!-- <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a> -->
			</div>

		</div>
		</div>
		@include('layouts.partials.scripts_auth')

		<script>
		  $(function () {
			$('input').iCheck({
			  checkboxClass: 'icheckbox_square-blue',
			  radioClass: 'iradio_square-blue',
			  increaseArea: '20%' // optional
			});
		  });
		</script>
    </body>

@endsection
