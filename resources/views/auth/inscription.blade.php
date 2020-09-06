@extends('layouts.auth')


@section('content')


	<body class="hold-transition register-page" style="background-image: url({{ asset('/img/bg-home.png') }});">
	
    <div id="app" v-cloak>
		<!--
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home') }}"><b>Inscription</b></a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="register-box-body">
                <register-form></register-form>

                <a href="{{ url('/login') }}" class="text-center">{{ trans('message.membership') }}</a>
            </div>
        </div>
		-->
		
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home') }}"><b>Inscription</b></a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="register-box-body">
                <form action="{{ url('/register') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
						<select class="form-control selecttype" name="statut" style="width: 100%;">
							<option selected="selected">Administrateur</option>
							<!-- <option>Gestionnaire</option>
							<option>Professeur</option>
							<option>Etudiant</option> -->
						</select>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" value="{{ old('nom') }}" autofocus/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom" autofocus/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="{{ trans('message.email') }}" name="email" value="{{ old('email') }}"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="{{ trans('message.password') }}" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="{{ trans('message.retypepassword') }}" name="password_confirmation"/>
                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    </div>
					<div class="row register">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label>
									<input type="checkbox" name="terms"> Accepter les <a href="#"  data-toggle="modal" data-target="#termsModal">conditions d'utilisation</a>
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('message.register') }}</button>
						</div>
						<!-- /.col -->
					</div>
                </form>

                <a href="{{ url('/login') }}" class="text-center">{{ trans('message.membership') }}</a>
                    </div>
            </div>
	</div>

    @include('layouts.partials.scripts_auth')

    @include('auth.terms')
</body>

@endsection
