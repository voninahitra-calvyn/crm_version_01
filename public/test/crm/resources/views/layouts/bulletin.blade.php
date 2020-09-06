<!DOCTYPE html>

<html lang="fr">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<!-- <body class="skin-blue sidebar-mini"> -->
<body class="hold-transition skin-green fixed sidebar-mini">
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
</body>
</html>
