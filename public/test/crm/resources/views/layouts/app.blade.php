<!DOCTYPE html>

<html lang="fr">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show
<!-- <body class="skin-green sidebar-mini"> -->
<!-- <body class="hold-transition skin-red fixed sidebar-mini"> -->
<body class="hold-transition skin-black-light layout-top-nav">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('layouts.partials.mainheader')

    {{-- @include('layouts.partials.sidebar') --}}

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


    @include('layouts.partials.footer')

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('layouts.partials.scripts')
@show
</body>
</html>
