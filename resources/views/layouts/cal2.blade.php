<!DOCTYPE html>
<html lang="fr">
	@section('htmlheader')
		@include('layouts.partials.htmlheader')
	@show
	<body class="hold-transition skin-black-light layout-top-nav">
		<div id="app" v-cloak>
			<div class="wrapper">
				<div class="content-wrapper">
					<section class="content-header">
						<h1>Responsable : {{$staffs->nom}}</h1>
					</section>
					<section class="content">
						@yield('main-content')
					</section>
				</div>
				@include('layouts.partials.footer')
			</div>
		</div>
		@section('scripts')
			@include('layouts.partials.scripts')
		@show
	</body>
</html>
