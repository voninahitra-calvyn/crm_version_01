<!-- resources\views\auth\passwords\email.blade.php -->

@extends('layouts.auth')

@section('htmlheader_title')
    Password recovery
@endsection

@section('content')

<!-- <body class="login-page" style="background-image: url({{ asset('/img/bg-home.jpg') }});"> -->
<body class="login-page">
    <div id="app">

        <div class="login-box">
				<div class="login-logo">
					<a href="#"><b>Réinitialiser mot de passe</b></a>
				</div><!-- /.login-logo -->

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

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

            <div class="login-box-body">
			
                <form action="{{ url('/password/email') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="row">
                        <div class="col-xs-2">
                        </div><!-- /.col -->
                        <div class="col-xs-8">
                            <button type="submit" class="btn btn-danger btn-block btn-flat">Envoyer le lien de réinitialisation</button>
                        </div><!-- /.col -->
                        <div class="col-xs-2">
                        </div><!-- /.col -->
                    </div>
                </form>

                <a href="{{ url('/login') }}">Connexion</a><br>
                <!-- <a href="{{ url('/register') }}" class="text-center">{{ trans('message.registermember') }}</a> -->

            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
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