@extends('layouts.auth')

@section('htmlheader_title')
    Password recovery
@endsection

@section('content')
<body class="login-page">
    <div id="app">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>Réinitialiser mot de passe</b></a>
			</div>
			<div class="login-box-body">
				<form action="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" method="post">
					{!! csrf_field() !!}

					<input type="hidden" name="token" value="{{ $token }}">

					<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
						<input type="email" name="email" class="form-control text-lowercase" value="{{ isset($email) ? $email : old('email') }}"
							   placeholder="Email">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
						<input type="password" name="password" class="form-control"
							   placeholder="Nouveau mot de passe">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
						<input type="password" name="password_confirmation" class="form-control"
							   placeholder="Confirmation mot de passe">
						<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
						@if ($errors->has('password_confirmation'))
							<span class="help-block">
								<strong>{{ $errors->first('password_confirmation') }}</strong>
							</span>
						@endif
					</div>
					<button type="submit"
							class="btn btn-primary btn-block btn-flat"
					>Valider réinitialisation mot de passe</button>
				</form>
			</div>
			<!-- /.login-box-body -->
		</div><!-- /.login-box -->
    </div><!-- /.app -->
</body>	
@endsection