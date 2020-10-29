<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRM MÉTIER</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/bootstrap3-wysihtml5.all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/bootstrap-timepicker.css') }}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('/css/dropzone.min.css') }}" rel="stylesheet" type="text/css" /> -->

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.dataTables.min.css') }}">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fullcalendar.print.min.css') }}" media="print">


     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--excel-bootstrap-table-filter -->
    <link rel="stylesheet" href="{{ asset('/css/excel-bootstrap-table-filter-style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery-fc.css') }}">
    <style>
    /* Blink for Webkit and others
(Chrome, Safari, Firefox, IE, ...)
*/

@-webkit-keyframes blinker {
  from {opacity: 1.0;}
  to {opacity: 0.0;}
}
.blink{
	text-decoration: blink;
	-webkit-animation-name: blinker;
	-webkit-animation-duration: 0.6s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-timing-function:ease-in-out;
	-webkit-animation-direction: alternate;
}

.ligne .btn-danger{
    float: right;
}
.image_form{
    z-index: 5;
    height: 90px;
    width: 90px;
    border: 3px solid;
    border-color: transparent;
}
         {{--   @if(isset($calendarclient))
td.fc-widget-content{
    background-color: #f39c12!important;
}
        @endif--}}
    </style>

    <script>

	
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
        // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
        $lang_files = File::files(resource_path().
            '/lang/'.App::getLocale());
        $trans = [];
        foreach($lang_files as $f) {
            $filename = pathinfo($f)['filename'];
            $trans[$filename] = trans($filename);
        }
        $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
        echo json_encode($trans);
        @endphp
		
		

    </script>

</head>