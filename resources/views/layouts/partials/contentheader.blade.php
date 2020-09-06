<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'En-tête de page ici')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <!--<li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('message.level') }}</a></li>-->
        <!--<li><a href="#"><i class="fa fa-dashboard"></i> @yield('contentheader_level')</a></li>-->
        <!--<li>@yield('contentheader_level2')</li>-->
        <!--<li class="active">@yield('contentheader_levelactive')</li>-->
        @yield('contentheader_levelactive')
    </ol>
</section>