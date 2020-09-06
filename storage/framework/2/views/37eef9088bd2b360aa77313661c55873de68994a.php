<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->

	<script src="<?php echo e(url (mix('/js/app.js'))); ?>" type="text/javascript"></script>
	
	<!-- jQuery 3 -->
	<script src="<?php echo e(asset ('/js/jquery/jquery.min.js')); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo e(asset ('/js/bootstrap.min.js')); ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo e(asset ('/js/jquery/jquery-ui.min.js')); ?>"></script>
	<!-- fullCalendar -->
	<script src="<?php echo e(asset ('/js/moment/moment.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/fullcalendar/fullcalendar.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/fullcalendar/fr.js')); ?>"></script>
	
	
	<script src="<?php echo e(asset ('/js/ckeditor/ckeditor.js')); ?>"></script>
	<!-- datepicker -->
	<script src="<?php echo e(asset ('/js/bootstrap-datepicker/bootstrap-datepicker.fr.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/bootstrap-timepicker/bootstrap-timepicker.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/dropzone.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/select2.full.js')); ?>"></script>
	<script src="<?php echo e(asset ('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/jquery/jquery.slimscroll.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/fastclick.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/adminlte.min.js')); ?>"></script>
	<!-- excel-bootstrap-table-filter -->
	<script src="<?php echo e(asset ('/js/excel-bootstrap-table-filter-bundle.js')); ?>"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script>
<!-- <?php if(isset($data)): ?> <?php echo $data; ?><?php endif; ?>	 -->

<script>
	// INITIALISATION CHAMPS
	var service = $( "#typerdv" ).val();
	console.log('SERVICE0: : '+service); 
	$("#groupsociete").hide(); 
	$("#groupnomprenom").hide();
	// $("#groupautre1").hide();
	$("#groupquestion").hide();
	$("#groupnetoyagepro").hide();
	$("#groupage").hide();
	$("#groupmutuel").hide();
	$("#groupdefisc").hide();
	$("#groupstatutfoyer").hide();
	$("#groupcompositionfoyer").hide();
	// $("#groupautre2").hide();
	$("#grouppersrdv").hide();
	// $("#groupautre3").hide();
	$("#groupautre1").show(); 
	$("#groupautre2").show(); 
	$("#groupautre3").show(); 
		
	// MODIF
		console.log('SERVICE: : '+service); 
		if((service == 'Défiscalisation') || (service == 'Mutuelle santé sénior')){
			$("#groupsociete").hide(); 
			$("#groupnomprenom").show(); 
			// $("#societe").attr("disabled", "disabled");
			$("#groupstatutfoyer").show();
			$("#grouppersrdv").show();
		}else{
			$("#groupsociete").show(); 
			$("#groupnomprenom").hide(); 
			$("#groupstatutfoyer").hide();
			$("#grouppersrdv").hide();
		}
		if(service == 'Autres'){
			$("#groupquestion").show(); 
		}else{
			$("#groupquestion").hide(); 
		}
		if(service == 'Nettoyage pro'){
			$("#groupnetoyagepro").show(); 
		}else{
			$("#groupnetoyagepro").hide(); 
		}
		if(service == 'Assurance pro' || (service == 'Mutuelle santé sénior') || (service == 'Autres') || (service == 'Nettoyage pro')){
			$("#grouppersrdv").show(); 
		}else{
			$("#grouppersrdv").hide(); 
		}
		if((service == 'Défiscalisation') || (service == 'Autres') || (service == 'Assurance pro pro') || (service == 'Nettoyage pro')){
			$("#groupage").hide(); 
		}else{
			$("#groupage").show(); 
		}
		if(service == 'Mutuelle santé sénior'){
			$("#groupmutuel").show(); 
		}else{
			$("#groupmutuel").hide(); 
		}
		if(service == 'Défiscalisation'){
			$("#groupdefisc").show(); 
			$("#groupcompositionfoyer").show(); 
		}else{
			$("#groupdefisc").hide(); 
			$("#groupcompositionfoyer").hide(); 
		}
	
	
	// FONCTION
    $( "#typerdv" ).change(function(){
			
		var service = $(this).val();
		console.log('SERVICE: : '+service); 
		if((service == 'Défiscalisation') || (service == 'Mutuelle santé sénior')){
			$("#groupsociete").hide(); 
			$("#groupnomprenom").show(); 
			// $("#societe").attr("disabled", "disabled");
			$("#groupstatutfoyer").show();
			$("#grouppersrdv").show();
		}else{
			$("#groupsociete").show(); 
			$("#groupnomprenom").hide(); 
			$("#groupstatutfoyer").hide();
			$("#grouppersrdv").hide();
		}
		if(service == 'Autres'){
			$("#groupquestion").show(); 
		}else{
			$("#groupquestion").hide(); 
		}
		if(service == 'Nettoyage pro'){
			$("#groupnetoyagepro").show(); 
		}else{
			$("#groupnetoyagepro").hide(); 
		}
		if(service == 'Assurance pro' || (service == 'Mutuelle santé sénior') || (service == 'Autres') || (service == 'Nettoyage pro')){
			$("#grouppersrdv").show(); 
		}else{
			$("#grouppersrdv").hide(); 
		}
		if((service == 'Défiscalisation') || (service == 'Autres') || (service == 'Assurance pro pro') || (service == 'Nettoyage pro')){
			$("#groupage").hide(); 
		}else{
			$("#groupage").show(); 
		}
		if(service == 'Mutuelle santé sénior'){
			$("#groupmutuel").show(); 
		}else{
			$("#groupmutuel").hide(); 
		}
		if(service == 'Défiscalisation'){
			$("#groupdefisc").show(); 
		}else{
			$("#groupdefisc").hide(); 
		}
    });
	
	
    $( "#prenom" ).change(function(){
		console.log('ccccccc: '+$(this).val());
    });

  

		console.log('aaaaaaaaa');
        $("#nom").change(function(){
			console.log('bbbbbbb');
        });
		

		
$("select[id='project_id2']").on('change', function()
{
    var project_id = $(this).val();
	console.log('jjjjjjjjjjjjjj: '+project_id);
    // $("select[name='subproject'] > option[data-project != "+ project_id +"]").hide();
        $("textarea[name='note']").hide(); 
        $("input[name='nom']").hide();
    if(project_id == 1)
    {
        $("textarea[name='note']").hide(); 
        $("input[name='nom']").hide(); 
        // note.show();
        // note.prop("disabled", false); 
    }
})
</script>

<script>
  $(function () {
	  
	$("select[name='typerdv']").on('change', function()
	{
		var typerdv = $(this).value;
		//$("select[name='subproject'] > option[data-project != "+ project_id +"]").hide();

		if(typerdv == 'Mutuelle santé sénior')
		{
			var note = $("textarea[name='note']"); 
			note.hide();
			<!-- nom.prop("disabled", false);  -->
		}
	}) 

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'aujourd\'hui',
        month: 'mois',
        week : 'semaine',
        day  : 'jour'
      },
	  events    : <?php if(isset($data)): ?> <?php echo $data; ?><?php endif; ?>,
      //Random default events
      /*events    : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Long Event',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],*/
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
	
	
	
  })
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	  
    // Use the plugin once the DOM has been loaded.
    $(function () {
      // Apply the plugin 
      $('#tableajoutrdv').excelTableFilter();
      $('#tablerdv').excelTableFilter();
      $('#tablestaff').excelTableFilter();
      $('#tablecentreappel').excelTableFilter();
      $('#tablecentreappelcompte').excelTableFilter();
      $('#tableclient').excelTableFilter();
      $('#tableclientcompte').excelTableFilter();
      // $('#table2').excelTableFilter();
      // $('#table3').excelTableFilter();
    });
	
    //Date picker
    $('#datepicker').datepicker({
		weekStart: 1,
		autoclose: true
    })
	
    //Date picker
    $('#date_rendezvous').datepicker({
/* 		format: {
			toDisplay: function (date, format, language) {
				var d = new Date(date);
				// d.setDate(d.getDate());
				// return d.toISOString(); 
				// return d.toISOString(); 
				// var d = new Date(date); 
				// d.format("yyyy-mm-dd");
				// return d.toISOString(); 
				// return d.format("YYYY-MM-DD");
			},
			toValue: function (date, format, language) {
				var d = new Date(date);
				// d.setDate(d.getDate());
				// return new Date(d);
				// var d = new Date(date); 
				// d.format("dd-mm-yyyy");
				return new Date(d); 
				// return d.format("YYYY-MM-DD");
			}
		  }, */
		format: 'dd-mm-yyyy',
		weekStart: 1,
		// format: 'yyyy-mm-dd',
		todayHighlight: true,
		todayBtn: true,
		// forceParse: false,
		// language: 'fr',
		autoclose: true
    })
	
    //Date picker
    $('#date_anniversaire_contrat').datepicker({
		weekStart: 1,
		autoclose: true
    })
	
    //Timepicker
    $('#heure_rendezvous').timepicker({
		showMeridian: false,
		showInputs: false
    })
	
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })



  })
</script>
<?php /**PATH D:\HeryADDAMS\KANDRA\Ohmycorp\app\Ohmycrm\resources\views/layouts/partials/scripts.blade.php ENDPATH**/ ?>