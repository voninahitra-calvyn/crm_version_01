<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->

	<script src="<?php echo e(url (mix('/js/app.js'))); ?>" type="text/javascript"></script>
	
	<!-- jQuery 3 -->
	<script src="<?php echo e(asset ('/js/jquery/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/jquery.table2excel.js')); ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo e(asset ('/js/bootstrap.min.js')); ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo e(asset ('/js/jquery/jquery-ui.min.js')); ?>"></script>
	<!-- fullCalendar -->
	<script src="<?php echo e(asset ('/js/moment/moment.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/fullcalendar/fullcalendar.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/fullcalendar/fr.js')); ?>"></script>
	<!-- <script src="<?php echo e(asset ('/js/fullcalendar/main.js')); ?>"></script> -->
	
	
	<script src="<?php echo e(asset ('/js/ckeditor/ckeditor.js')); ?>"></script>
    
	<!-- datepicker -->
	<script src="<?php echo e(asset ('/js/bootstrap-datepicker/prettify.js')); ?>"></script>
	
	<!-- <script src="<?php echo e(asset ('/js/bootstrap-datepicker/jquery.js')); ?>"></script> -->
	<script src="<?php echo e(asset ('/js/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/bootstrap-timepicker/bootstrap-timepicker.js')); ?>"></script>
	
	<!-- excel-bootstrap-table-filter -->
	<script src="<?php echo e(asset ('/js/excel-bootstrap-table-filter-bundle.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/dropzone.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/select2.full.js')); ?>"></script>
	<script src="<?php echo e(asset ('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/jquery/jquery.slimscroll.min.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/fastclick.js')); ?>"></script>
	<script src="<?php echo e(asset ('/js/adminlte.min.js')); ?>"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script> -->
 <!-- <?php if(isset($datacalendrier)): ?> <?php echo json_encode($datacalendrier); ?><?php endif; ?>  -->
<!-- <?php if(isset($dataevent)): ?> <?php echo json_encode($dataevent); ?><?php endif; ?>  -->

<script>
	// INITIALISATION CHAMPS
	
	var service = $( "#typerdv" ).val();
	console.log('SERVICE0: : '+service); 
	$("#groupsociete").hide(); 
	$("#groupnomprenom").hide();
	// $("#groupautre1").hide();
	$("#groupquestion").hide();
	$("#groupnetoyagepro").hide();
	$("#groupactivitesociete").hide();
	$("#groupage").hide();
	$("#groupprofession").hide();
	$("#groupproprietaireoulocataire").hide();
	$("#groupprotectionsociale").hide();
	$("#groupmutuellesante").hide();
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
	$("#groupnompersonnerdv").show(); 
	$("#receptionappel").show(); 
	$("#receptionappelenvoye").show(); 
	$("#demandedevis").show(); 
	$("#demandedevisenvoye").show(); 
	$("#rendezvousbrut").show();  
	$("#rendezvousrefuse").show();  
	$("#rendezvousenvoye").show();
	$("#rendezvousconfirme").show();
	$("#rendezvousannule").show();
	$("#rendezvousenattente").show();
	$("#rendezvousvalide").show();
	var user_statut = $("#user_statut").val();

		
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
			$("#groupnompersonnerdv").show(); 
		}else{
			$("#grouppersrdv").hide(); 
		}
		if((service == 'Défiscalisation') || (service == 'Assurance pro') || (service == 'Nettoyage pro')){
			$("#groupactivitesociete").show(); 
		}else{
			$("#groupactivitesociete").hide(); 
		}
		if(service == 'Assurance pro'){
			$("#groupprotectionsociale").show(); 
			$("#groupmutuellesante").show(); 
		}else{
			$("#groupprotectionsociale").hide(); 
			$("#groupmutuellesante").hide(); 
		}
		if((service == 'Autres') || (service == 'Assurance pro') || (service == 'Nettoyage pro')){
			$("#groupage").hide(); 
		}else{
			$("#groupage").show(); 
		}
		if(service == 'Mutuelle santé sénior'){
			$("#groupmutuel").show(); 
			$("#groupstatutfoyer").hide();
		}else{
			$("#groupmutuel").hide(); 
		}
		if(service == 'Défiscalisation'){
			$("#groupdefisc").show(); 
			$("#groupcompositionfoyer").show(); 
			$("#groupprofession").show(); 
			$("#groupproprietaireoulocataire").show(); 
			$("#groupnompersonnerdv").show(); 
		}else{
			$("#groupdefisc").hide(); 
			$("#groupcompositionfoyer").hide();
			$("#groupprofession").hide();
			$("#groupproprietaireoulocataire").hide();
		}
		if((service == 'Réception d\'appels') || (service == 'Demande de devis')){
			// $("#groupcentreappel").hide(); 
			// $("#groupclient_priv").hide(); 
			// $("#groupautre2").hide(); 
			$("#groupage").hide(); 
			$("#groupnompersonnerdv").hide(); 
			$("#groupdate1").hide(); 
			$("#groupheure1").hide();
			$("#groupdate2").show();  
			$("#groupheure2").show(); 
		}else{
			$("#groupdate1").show(); 
			$("#groupheure1").show();
			$("#groupdate2").hide();  
			$("#groupheure2").hide(); 
			
		}
		if((service == 'Réception d\'appels') || (service == 'Réception d\’appels envoyé')){ 
			$("#date_rendezvous").val(moment().format('DD-MM-YYYY'));
			$("#heure_rendezvous").val(moment().format('H:m'));
			// $("#heure_rendezvous").val(moment().subtract(1,'hour').format('H:m'));
			// $("#date_rendezvousedit").val(moment().format('DD-MM-YYYY'));
			// $("#heure_rendezvousedit").val(moment().subtract(1,'hour').format('H:m'));
	
			if((user_statut == 'Superviseur') || (user_statut == 'Agent')){
				$("#date_rendezvousedit").prop("disabled", true );
				$("#heure_rendezvousedit").prop("disabled", true );
			}else{
				$("#date_rendezvousedit").prop("disabled", false );
				$("#heure_rendezvousedit").prop("disabled", false );
			}
		
		
			$("#rendezvousbrut").hide();  
			$("#rendezvousrefuse").hide();  
			$("#rendezvousenvoye").hide();
			$("#rendezvousconfirme").hide();
			$("#rendezvousannule").hide();
			$("#rendezvousenattente").hide();
			$("#rendezvousvalide").hide();
			$("#receptionappel").show(); 
			$("#receptionappelenvoye").show();
			$("#demandedevis").hide(); 
			$("#demandedevisenvoye").hide();  
		}else if((service == 'Demande de devis') || (service == 'Demande de devis envoyé')){  
			$("#date_rendezvous").val(moment().format('DD-MM-YYYY'));
			$("#heure_rendezvous").val(moment().format('H:m'));
			
			
			if((user_statut == 'Superviseur') || (user_statut == 'Agent')){
				$("#date_rendezvousedit").prop("disabled", true );
				$("#heure_rendezvousedit").prop("disabled", true );
			}else{
				$("#date_rendezvousedit").prop("disabled", false );
				$("#heure_rendezvousedit").prop("disabled", false );
			}
		
		
			$("#rendezvousbrut").hide();  
			$("#rendezvousrefuse").hide();  
			$("#rendezvousenvoye").hide();
			$("#rendezvousconfirme").hide();
			$("#rendezvousannule").hide();
			$("#rendezvousenattente").hide();
			$("#rendezvousvalide").hide();
			$("#receptionappel").hide(); 
			$("#receptionappelenvoye").hide();
			$("#demandedevis").show(); 
			$("#demandedevisenvoye").show();  
		}else{  
			$("#rendezvousbrut").show();  
			$("#rendezvousrefuse").show();  
			$("#rendezvousenvoye").show();
			$("#rendezvousconfirme").show();
			$("#rendezvousannule").show();
			$("#rendezvousenattente").show();
			$("#rendezvousvalide").show(); 
			$("#demandedevis").hide(); 
			$("#demandedevisenvoye").hide(); 
			$("#receptionappel").hide(); 
			$("#receptionappelenvoye").hide();
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
		if((service == 'Défiscalisation') || (service == 'Assurance pro') || (service == 'Nettoyage pro')){
			$("#groupactivitesociete").show(); 
		}else{
			$("#groupactivitesociete").hide(); 
		}
		if(service == 'Assurance pro'){
			$("#groupprotectionsociale").show(); 
			$("#groupmutuellesante").show(); 
		}else{
			$("#groupprotectionsociale").hide(); 
			$("#groupmutuellesante").hide(); 
		}
		if((service == 'Autres') || (service == 'Assurance pro') || (service == 'Nettoyage pro')){
			$("#groupage").hide(); 
		}else{
			$("#groupage").show(); 
		}
		if(service == 'Mutuelle santé sénior'){
			$("#groupmutuel").show(); 
			$("#groupstatutfoyer").hide();
		}else{
			$("#groupmutuel").hide(); 
		}
		if(service == 'Défiscalisation'){
			$("#groupdefisc").show(); 
			$("#groupcompositionfoyer").show(); 
			$("#groupprofession").show(); 
			$("#groupproprietaireoulocataire").show(); 
		}else{
			$("#groupdefisc").hide(); 
			$("#groupcompositionfoyer").hide(); 
			$("#groupprofession").hide(); 
			$("#groupproprietaireoulocataire").hide(); 
		}
		if((service == 'Réception d\'appels') || (service == 'Demande de devis')){
			// $("#groupcentreappel").hide(); 
			// $("#groupclient_priv").hide(); 
			// $("#groupautre2").hide(); 
			$("#groupage").hide(); 
			$("#groupnompersonnerdv").hide(); 
			$("#groupdate1").hide(); 
			$("#groupheure1").hide();
			$("#groupdate2").show();  
			$("#groupheure2").show(); 
		}else{
			$("#groupdate1").show(); 
			$("#groupheure1").show();
			$("#groupdate2").hide();  
			$("#groupheure2").hide(); 
			
		}
		if((service == 'Réception d\'appels') || (service == 'Réception d\’appels envoyé')){ 
			$("#date_rendezvous").val(moment().format('DD-MM-YYYY'));
			$("#heure_rendezvous").val(moment().format('H:mm'));
			
			
			if((user_statut == 'Superviseur') || (user_statut == 'Agent')){
				$("#date_rendezvous").prop("disabled", true );
				$("#heure_rendezvous").prop("disabled", true );
			}else{
				$("#date_rendezvous").prop("disabled", false );
				$("#heure_rendezvous").prop("disabled", false );
			}
		
		
			$("#rendezvousbrut").hide();  
			$("#rendezvousrefuse").hide();  
			$("#rendezvousenvoye").hide();
			$("#rendezvousconfirme").hide();
			$("#rendezvousannule").hide();
			$("#rendezvousenattente").hide();
			$("#rendezvousvalide").hide();
			$("#receptionappel").show(); 
			$("#receptionappelenvoye").show();  
		}else if((service == 'Demande de devis') || (service == 'Demande de devis envoyé')){  
			$("#date_rendezvous").val(moment().format('DD-MM-YYYY'));
			$("#heure_rendezvous").val(moment().format('H:mm'));
			
			
			if((user_statut == 'Superviseur') || (user_statut == 'Agent')){
				$("#date_rendezvous").prop("disabled", true );
				$("#heure_rendezvous").prop("disabled", true );
			}else{
				$("#date_rendezvous").prop("disabled", false );
				$("#heure_rendezvous").prop("disabled", false );
			}
		
		
			$("#rendezvousbrut").hide();  
			$("#rendezvousrefuse").hide();  
			$("#rendezvousenvoye").hide();
			$("#rendezvousconfirme").hide();
			$("#rendezvousannule").hide();
			$("#rendezvousenattente").hide();
			$("#rendezvousvalide").hide();
			$("#demandedevis").show(); 
			$("#demandedevisenvoye").show();  
		}else{  
			$("#rendezvousbrut").show();  
			$("#rendezvousrefuse").show();  
			$("#rendezvousenvoye").show();
			$("#rendezvousconfirme").show();
			$("#rendezvousannule").show();
			$("#rendezvousenattente").show();
			$("#rendezvousvalide").show(); 
			$("#demandedevis").hide(); 
			$("#demandedevisenvoye").hide(); 
			$("#receptionappel").hide(); 
			$("#receptionappelenvoye").hide();
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
			right : 'month,agendaWeek,agendaDay,listWeek'
			// right : 'month,agendaDay,listWeek'
		},
		buttonText: {
			today: 'Aujourd\'hui',
			month: 'Mois',
			week : 'Semaine',
			day  : 'Jour',
			list  : 'Liste'
		}, 
		navLinks: true, // can click day/week names to navigate views
		<?php if(isset(auth()->user()->statut)): ?>
			<?php if(isset(auth()->user()->statut)): ?>
				<?php if((auth()->user()->statut == 'Superviseur') || (auth()->user()->statut == 'Agent')): ?>
					selectable: false,
				<?php else: ?> 
					selectable: true,
				<?php endif; ?> 
			<?php endif; ?> 
		<?php endif; ?> 
		defaultView: 'agendaWeek',
		// slotMinutes: '90',
		// slotDuration: '00:30',
		scrollTime : '08:00:00',
		// minTime : '08:00',
		// maxTime : '18:00',
		selectHelper: true,
		/*select: function(start, end) {
			
			// $('#modal-success').modal();
        // var title = prompt('Titre:');
        var title = 'Indisponible';
        var eventData;
        if (title) {
			eventData = {
				// overlap: false,
				// rendering: 'background',
				// color: '#ff9f89',
				title: title,
				backgroundColor: '#ff0000',
				borderColor: '#ff0000',
				start: start,
				end: end
			};
			$.ajax({
				url: SITEURL + "/agendas/create",
				// url: "http://127.0.0.1:8000/agendas/create",
				data: eventData,
				// data: 'title=' + title + '&start=' + start + '&end=' + end,
				// type: "POST" ,
				// success: function (data) {
					// displayMessage("Added Successfully");
				// } ,

			}); 
			$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
        }
        $('#calendar').fullCalendar('unselect');
		},*/
		eventLimit: true, // allow "more" link when too many events    
		defaultTimedEventDuration: '01:30:00',
		forceEventDuration: true,
		<?php if(isset($dataevent)): ?>
			// events: <?php echo $dataevent; ?>,
			events: [
				<?php $__currentLoopData = $dataevent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				{
					id : '<?php echo $event->_id; ?>',  
					client_priv : '<?php echo $event->client_priv; ?>',   
					adresse_details : '<?php echo $event->adresse_details; ?>',  
					note_details : '<?php echo $event->note_details; ?>',  
					<?php if(isset(auth()->user()->statut)): ?>
						<?php if(isset(auth()->user()->statut)): ?>
							<?php if((auth()->user()->statut == 'Superviseur') || (auth()->user()->statut == 'Agent')): ?>
								title : 'Créneau horaire indisponible', 
								titre_details : 'Créneau horaire indisponible', 
							<?php else: ?> 
								title : '<?php echo $event->title; ?>',
								titre_details : '<?php echo $event->titre_details; ?>', 
								<!-- title : '<?php echo $event->client_priv; ?>', -->
							<?php endif; ?> 
						<?php endif; ?> 
					<?php endif; ?> 
					start : '<?php echo $event->start; ?>',
					// end: '<?php echo $event->start; ?>',
					backgroundColor : '<?php echo $event->backgroundColor; ?>',  
					borderColor : '<?php echo $event->borderColor; ?>',
				},
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			], 
		<?php endif; ?>
		select: function(start, end) {
			$('#date_debutdh').val(start.format('YYYY-MM-DD HH:mm:ss'));
			$('#date_findh').val(end.format('YYYY-MM-DD HH:mm:ss'));
			$('#titredh').val('Indisponible');
			<?php if(isset(auth()->user()->statut)): ?>
				<?php if((auth()->user()->statut != 'Superviseur') && (auth()->user()->statut != 'Agent')): ?>
					$('.btn.ajoutagendaModal').click();
				<?php endif; ?> 
			<?php endif; ?> 
			var eventData = null;
			/* $('.btn.valider_dh').click(function(){
				eventData = {
					// overlap: false,
					// rendering: 'background',
					// color: '#ff9f89',
					title: $('#titredh').val(),
					backgroundColor: '#f39c12',
					borderColor: '#f39c12',
					start: start,
					end: end
				};
				//reinitialiser date modal
				start=null;
				end=null;
				$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				$('.close.modal1').click();
			}); */
			$('.btn.annuler_dh').click(function(){
				eventData = {
					title: null,
					start: null,
					end: null
				};
				start=null;
				end=null;
				$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
			});
		},
		eventClick: function(calEvent, jsEvent, view) {
			// $('#date_debutdhD').val(moment(calEvent.start).format('DD-MM-YYYY HH:mm:ss'));
			$('#date_debutdhD').html(moment(calEvent.start).format('DD-MM-YYYY HH:mm'));
			if(calEvent.titre_details==null || calEvent.titre_details==''){
			// if(calEvent.note_details==null || calEvent.note_details==''){
			// if(((calEvent.note_details==null)&&(calEvent.adresse_details==null)) || ((calEvent.note_details=='')&&(calEvent.adresse_details==''))){
				$('#titre_details').html(calEvent.title)
				$('#date_details').html(moment(calEvent.start).format('DD-MM-YYYY'));
				$('#heure_details').html(moment(calEvent.start).format('HH:mm'));
				$('#supprimer_dh').removeClass('hidden');
				$('#supprimer_details').removeClass('hidden');
				$('.detailsrdv').addClass('hidden');
				$('.detailsrdv').addClass('hidden');
			}else{
				$('#titre_details').html(calEvent.titre_details);
				$('#date_details').html(moment(calEvent.start).format('DD-MM-YYYY'));
				$('#heure_details').html(moment(calEvent.start).format('HH:mm'));
				$('#adresse_details').html(calEvent.adresse_details);
				$('#note_details').html(calEvent.note_details);
				$('#date_findhD').val(moment(calEvent.end).format('YYYY-MM-DD HH:mm:ss'));
				/* 
				<?php if(isset(auth()->user()->statut)): ?>
					<?php if(auth()->user()->statut == 'Administrateur'): ?>
						$('#supprimer_dh').removeClass('hidden');
						$('#supprimer_details').removeClass('hidden');
					<?php else: ?>
						$('#supprimer_dh').addClass('hidden');
						$('#supprimer_details').addClass('hidden');
					<?php endif; ?> 
				<?php endif; ?> 
				*/
				$('#supprimer_dh').addClass('hidden');
				$('#supprimer_details').addClass('hidden');
				$('.detailsrdv').removeClass('hidden');
				$('.detailsrdv').removeClass('hidden');
			}	
		// $('#titredhD').val(calEvent.title);
		$('#titredhD').html(calEvent.title);
		// $('#titredhD').html(calEvent.client_priv);
			$('#id_details').val(calEvent.id);
			<?php if(isset(auth()->user()->statut)): ?>
				<?php if((auth()->user()->statut != 'Superviseur') && (auth()->user()->statut != 'Agent')): ?>
					$('.btn.detailagendaModal').click();
					//$('.supprimer_dh').removeClass('hidden');
				<?php else: ?>
					//$('.supprimer_dh').addClass('hidden');
				<?php endif; ?>
			<?php endif; ?>
			// $('.btn.modifagendaModal').click();
			// if (calEvent.title == 'Indisponible') $('.btn.modifagendaModal').click();//cocomodif
			// alert('jjjjjj: '+moment(calEvent.start).format('YYYY-MM-DD HH:mm:ss'));
			// alert('Plage d\'horaire indisponible');
			// 
			// $('.modal2').modal();
			// $('.btn.modifagendaModal').click();
			// $('#editagendaModal').modal('show');
			// $(".editagendaModal").modal('show');
// $(".editagendaModal").modal();
// var instance = M.Modal.getInstance($('.editagendaModal'));
// instance.open();
			
		},
		<!-- events    : <?php if(isset($datacalendrier)): ?> <?php echo json_encode($datacalendrier); ?><?php endif; ?>, -->
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
		eventRender: function(event, element, view) {
			element.find('span.fc-title').addClass('titreClass');     
			element.find('td.fc-list-item-title').addClass('listerdv');
			element.find('span.fc-title').html(element.find('span.fc-title').text());
			element.find('div.fc-content').html(element.find('div.fc-content').text());
			element.find('td.fc-list-item-title').html(element.find('td.fc-list-item-title').text());
			
			//Filtre
			var showTypes, showDispo, showFacilities, showSearchTerms = true;
			var clientrdv = $('#clientrdv').val();
			var disponibiliterdv = $('#disponibiliterdv').val();
			var searchTerms = $('#searchTerm').val();
			/* filters */
			if (searchTerms.length > 0){
				showSearchTerms = event.title.toLowerCase().indexOf(searchTerms) >= 0 || event.desc.toLowerCase().indexOf(searchTerms) >= 0;
			}
			
			if (clientrdv && clientrdv.length > 0) {				
				if (clientrdv.trim().toLowerCase() == "all") {
					showTypes = true;
				}else {
					showTypes = clientrdv.trim().toLowerCase() == event.client_priv.trim().toLowerCase();
					// alert(clientrdv.indexOf(event.client_priv));
				}
			}
			
			if (disponibiliterdv && disponibiliterdv.length > 0) {	
				if (disponibiliterdv.trim().toLowerCase() == "disponible") {
					showDispo = true;
				}else {
					showDispo = disponibiliterdv.trim().toLowerCase() == event.backgroundColor.trim().toLowerCase();
					//showTypes = event.backgroundColor.trim().toLowerCase() == '#f39c12';
				}
			} 
			
			//return showSearchTerms;	
			return showTypes && showDispo;	
			// return showTypes && showSearchTerms;	
		},
		editable  : false,
		droppable : false, // this allows things to be dropped onto the calendar !!!
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
    });//CALENDAR
	
  $('.filterdisponibiliteagenda').on('change',function(){
    $('#calendar').fullCalendar('rerenderEvents');
  });
	
  $('.filteragenda').on('change',function(){
    $('#calendar').fullCalendar('rerenderEvents');
  });
	
  $('#searchTerm').on('input', function(){
    $('#calendar').fullCalendar('rerenderEvents');
  });

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
      $('#filters').css({
        'padding-top'  : '0px',
        'margin-top'  : '-10px',
        'height'  : '70px'
      })
  })
</script>
   
   <script type="text/javascript">

      /* if ($('.datedebpicker').prop('type') != "date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
      } */
    </script>

<script>
  $(function () {
			window.prettyPrint && prettyPrint();
	  
	  
  
			
			$('#dp1').datepicker({
				format: 'mm-dd-yyyy',
                todayBtn: 'linked'
			});  
	  
    //Initialize Select2 Elements
    $('.select2').select2()
	  
    // Use the plugin once the DOM has been loaded.
    $(function () {
      // Apply the plugin 
      $('#table').excelTableFilter();
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
		format: 'dd-mm-yyyy',
		weekStart: 1,
		autoclose: true
    })
/*	
    //Date picker datedebpicker
    $('#datedebpicker').datepicker({
		format: 'dd-mm-yyyy',
		weekStart: 1,
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
    })
	
    //Date picker datedebpicker
    $('#datefinpicker').datepicker({
		format: 'dd-mm-yyyy',
		weekStart: 1,
		todayHighlight: true,
		todayBtn: true,
		autoclose: true
    })
*/
	
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
    $('#date_rendezvousedit').datepicker({
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
		format: 'dd-mm-yyyy',
		weekStart: 1,
		autoclose: true
    })
	
    //Timepicker
    $('#heure_rendezvous').timepicker({
		showMeridian: false,
		showInputs: false
    })
	
    //Timepicker
    $('#heure_rendezvousedit').timepicker({
		showMeridian: false,
		showInputs: false
    })
	
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

// $('#datepicker').datepicker({
    // format: 'mm-dd-yyyy'
// });


  })
</script>

<!-- EXPORT EXCEL -->
<script>
	$(function() {
		$("#btnrdvexcel").click(function(e){
			var table = $(this).prev('.table2excel');
			if(table && table.length){
				var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
				$(table).table2excel({
					exclude: ".noExl",
					//exclude2: ".checkbox-container",
					name: "Excel Document Name",
					filename: "Production" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_divs: false,
					exclude_inputs: true,
					preserveColors: preserveColors
				});
			}
		});
		
	});
</script>

<!-- CKEDITOR -->
<script>
	$(function() {

    // Replace the <textarea id="note1editor"> and <textarea id="note2editor"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('note1editor')  
	$('.textarea').wysihtml5()//bootstrap WYSIHTML5 - text editor
	
    CKEDITOR.replace('note2editor') 
	$('.textarea').wysihtml5()//bootstrap WYSIHTML5 - text editor
		
	});
</script><?php /**PATH /home/clients/452225fdd1f675c63558ad49feb51168/crm/resources/views/layouts/partials/scripts.blade.php ENDPATH**/ ?>