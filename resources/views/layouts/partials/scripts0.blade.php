<!-- resources\views\layouts\partials\scripts.blade.php -->

<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->

	<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
	
	<!-- jQuery 3 -->
	<script src="{{ asset ('/js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset ('/js/jquery.table2excel.js') }}"></script>
	<!-- Bootstrap 3.3.7 -->
	<!-- <script src="{{ asset ('/js/bootstrap.min.js') }}"></script> -->
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset ('/js/jquery/jquery-ui.min.js') }}"></script>
	<!-- fullCalendar -->
	<script src="{{ asset ('/js/moment/moment.js') }}"></script>
	<script src="{{ asset ('/js/fullcalendar/fullcalendar.js') }}"></script>
	<script src="{{ asset ('/js/fullcalendar/fr.js') }}"></script>
	<!-- <script src="{{ asset ('/js/fullcalendar/main.js') }}"></script> -->
	
	<!-- Laravel DataTables -->
	<script src="{{ asset ('/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset ('/js/jquery.dataTables.min.js') }}"></script>
	
	<script src="{{ asset ('/js/ckeditor/ckeditor.js') }}"></script>
	<!-- datepicker -->
	<script src="{{ asset ('/js/bootstrap-datepicker/prettify.js') }}"></script>
	
	<!-- <script src="{{ asset ('/js/bootstrap-datepicker/jquery.js') }}"></script> -->
	<script src="{{ asset ('/js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset ('/js/bootstrap-timepicker/bootstrap-timepicker.js') }}"></script>
	
	<!-- excel-bootstrap-table-filter -->
	<script src="{{ asset ('/js/excel-bootstrap-table-filter-bundle.js') }}"></script>
	<script src="{{ asset ('/js/dropzone.js') }}"></script>
	<script src="{{ asset ('/js/select2.full.js') }}"></script>
	<script src="{{ asset ('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<script src="{{ asset ('/js/jquery/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset ('/js/fastclick.js') }}"></script>
	<script src="{{ asset ('/js/adminlte.min.js') }}"></script>
	<script src="https://apis.google.com/js/api.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js"></script> -->
 <!-- @if(isset($datacalendrier)) {!!json_encode($datacalendrier)!!}@endif  -->
<!-- @if(isset($dataevent)) {!!json_encode($dataevent)!!}@endif  -->
<!-- Script -->

<script>

$(document).ready(function(){
    $('.input-daterange').datepicker({
        todayBtn:'linked',
        format: "dd-mm-yyyy",
        autoclose: true
    });

    fetch_data('no');
	var url = '{{route('rdvs.datatable')}}';
      // DataTable
  // val = document.getElementById('mot_rdv').value;

    $('#searchdate').click(function(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if(start_date != '' && end_date !='')
        {
            $('#empTables').DataTable().destroy();
            fetch_data('yes', start_date, end_date);
        }
        else
        {
            alert("Both Date is Required");
        }
    });

   });

function fetch_data(is_date_search, start_date='', end_date='') {
    $('#empTables').DataTable({
        processing: true,
        serverSide: true,
        orders: true,
        lengthMenu: [10, 50, 100, 500],
        pageLength: 50,
        ajax: {
            url: '/rendez-vous/datatable',
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                is_date_search:is_date_search, start_date:start_date, end_date:end_date

            },
        },
        columns: [
            {
                data: '_id', "searchable": false, "orderable": false, "className": 'noExl no-filter',
                name: '_id',
                render: function (data) {
                    var url = '{{route('rdv.edit',':_id')}}';
                    url = url.replace(':_id', data);

                    return ' <td  class="noExl no-filter"> <a href="' + url + '" > <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-edit"></i> Modifier</button> </a> </td>';
                }
            },

            {
                data: '_id', "searchable": false, "orderable": false, "className": 'noExl no-filter',
                name: '_id',
                render: function (data) {
                    var url = '{{route('rdv.destroy',':_id')}}';
                    url = url.replace(':_id', data);

                    return ' <td  class="noExl no-filter"> <a nohref onClick="deleteRdv(\'' + url + '\')" > <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Supprimer</button> </a> </td>';
                }
            },


            {
                data: '_id',
                name: '_id',
                render: function (data, type, row) {
                    var dt = data.substr(3, 5);
                    return "<p>" + dt + "<p>";
                }
            },

            {
                data: 'centreappel_societe',
                name: 'centreappel_societe'
            },

            {
                data: {"nom": 'user_nom', "prenom": 'user_prenom'},
                name: 'user_nom',
                render: function (data, type, full) {
                    return data["user_prenom"] + " " + data["user_nom"];
                }
            },

            {
                data: 'cli',
                name: 'cli',

            },


            {
                data: 'societe',
                name: 'societe'
            },
            {
                data: 'ville',
                name: 'ville'
            },

            {
                data: {"tel": 'telephone', "mob": 'mobile'},
                name: 'telephone',
                render: function (data) {
                    return data['telephone'] ? data['telephone'] : data['mobile'];
                }
            },
            {
                data: 'nom_personne_rendezvous',
                name: 'nom_personne_rendezvous'
            },

            {
                data: 'statut',
                name: 'statut',
                render: function (data) {
                    var statut = data;

                    if (data == "Rendez-vous relancer") {
                        statut = "Rendez-vous refusé / relancer";
                    }
                    if (data == "Rendez-vous refusé") {
                        statut = "Rendez-vous refusé / ne pas relancer";
                    }

                    return statut;

                }


            },

            {
                data: 'date_rendezvous',
                name: 'date_rendezvous',
                render: function (data) {
                    var d = new Date(data),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();
                    heure = d.getHours();
                    min = d.getMinutes();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    if (heure.length < 2) heure = '0' + heure;
                    if (min.length < 2) min = '0' + min;
                    return [day, month, year].join('-');
                }
            },

            {
                data: 'heure_rendezvous',
                name: 'heure_rendezvous'
            },

            {
                data: {"nom": 'client_nompriv', "prenom": 'client_prenompriv'},
                name: 'client_prenompriv',
                render: function (data) {

                    return data["client_prenompriv"] + " " + data["client_nompriv"];
                }

            },

            {
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    var d = new Date(data),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();
                    heure = d.getHours();
                    min = d.getMinutes();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    if (heure.length < 2) heure = '0' + heure;
                    if (min.length < 2) min = '0' + min;
                    return [day, month, year].join('-') + " " + [heure, min].join(':');
                }
            },

            {
                data: 'updated_at',
                name: 'updated_at',
                render: function (data) {
                    var d = new Date(data),
                        month = '' + (d.getMonth() + 1),
                        day = '' + d.getDate(),
                        year = d.getFullYear();
                    heure = d.getHours();
                    min = d.getMinutes();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    if (heure.length < 2) heure = '0' + heure;
                    if (min.length < 2) min = '0' + min;
                    return [day, month, year].join('-') + " " + [heure, min].join(':');
                }

            },
        ]
    });
}

</script>

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
	$("#rendezvousrelance").show();  
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
			$("#groupnomprenomcontact").show(); 
		}else{
			$("#groupdate1").show(); 
			$("#groupheure1").show();
			$("#groupdate2").hide();  
			$("#groupheure2").hide(); 
			$("#groupnomprenomcontact").hide(); 
			
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
			$("#rendezvousrelance").hide();  
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
			$("#rendezvousrelance").hide();   
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
			$("#rendezvousrelance").show();  
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
			$("#groupnomprenomcontact").show(); 
		}else{
			$("#groupdate1").show(); 
			$("#groupheure1").show();
			$("#groupdate2").hide();  
			$("#groupheure2").hide(); 
			$("#groupnomprenomcontact").hide(); 
			
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
			$("#rendezvousrelance").hide();   
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
			$("#rendezvousrelance").hide();   
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
			$("#rendezvousrelance").show();  
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
	    alert("on change type rdv");
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
		@if(isset(auth()->user()->statut))
			@if(isset(auth()->user()->statut))
				@if((auth()->user()->statut == 'Superviseur') || (auth()->user()->statut == 'Agent'))
					selectable: false,
				@else 
					selectable: true,
				@endif 
			@endif 
		@endif 
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
		@if(isset($dataevent))
			// events: {!!$dataevent!!},
			events: [
				@foreach($dataevent as $event)
				{
					id : '{!!$event->_id!!}',  
					client_priv : '{!!$event->client_priv!!}',   
					adresse_details : '{!!$event->adresse_details!!}',  
					note_details : '{!!$event->note_details!!}',  
					@if(isset(auth()->user()->statut))
						@if(isset(auth()->user()->statut))
							@if((auth()->user()->statut == 'Superviseur') || (auth()->user()->statut == 'Agent'))
								title : 'Créneau horaire indisponible', 
								titre_details : 'Créneau horaire indisponible', 
							@else 
								title : '{!!$event->title!!}',
								titre_details : '{!!$event->titre_details!!}', 
								<!-- title : '{!!$event->client_priv!!}', -->
							@endif 
						@endif 
					@endif 
					start : '{!!$event->start!!}',
					// end: '{!!$event->start!!}',
					backgroundColor : '{!!$event->backgroundColor!!}',  
					borderColor : '{!!$event->borderColor!!}',
				},
				@endforeach
			], 
		@endif
		select: function(start, end) {
			$('#date_debutdh').val(start.format('YYYY-MM-DD HH:mm:ss'));
			$('#date_findh').val(end.format('YYYY-MM-DD HH:mm:ss'));
			$('#titredh').val('Indisponible');
			@if(isset(auth()->user()->statut))
				@if((auth()->user()->statut != 'Superviseur') && (auth()->user()->statut != 'Agent'))
					$('.btn.ajoutagendaModal').click();
				@endif 
			@endif 
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
		    alert("event click");
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
				@if(isset(auth()->user()->statut))
					@if(auth()->user()->statut == 'Administrateur')
						$('#supprimer_dh').removeClass('hidden');
						$('#supprimer_details').removeClass('hidden');
					@else
						$('#supprimer_dh').addClass('hidden');
						$('#supprimer_details').addClass('hidden');
					@endif 
				@endif 
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
			@if(isset(auth()->user()->statut))
				@if((auth()->user()->statut != 'Superviseur') && (auth()->user()->statut != 'Agent'))
					$('.btn.detailagendaModal').click();
					//$('.supprimer_dh').removeClass('hidden');
				@else
					//$('.supprimer_dh').addClass('hidden');
				@endif
			@endif
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
		<!-- events    : @if(isset($datacalendrier)) {!!json_encode($datacalendrier)!!}@endif, -->
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

		    console.log("event :" + event);
		    console.log("element :" + element);
		    console.log("view :" + view);
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
			    console.log("client.trimù: " + clientrdv.trim().toLowerCase());
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
		//alert("ato");

   //   let edit_id = $(this).val();
      window.location.href = window.location.origin + '/get_agenda_client';
      //$('#calendar').fullCalendar('rerenderEvents');
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

//blink notify
	getUnreadNotif();

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
      $('#empTables').excelTableFilter();
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
				$('#empTables').excelTableFilter();
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
</script>

<!-- CALENDAR_2 -->
<script>

  $(document).ready(function() {

		$('#calendar2').fullCalendar({
		header: {
			left: 'prev,next today',
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
		// defaultDate: '2020-06-01',
		defaultView: 'agendaWeek',
		selectHelper: true,
		scrollTime : '08:00:00',
		navLinks: true,
		editable: false,
		eventLimit: true, // allow "more" link when too many events    
		defaultTimedEventDuration: '01:30:00',
		forceEventDuration: true,
		events: [
		@if(isset($dataevent))
			@foreach($dataevent as $event)
			{
				title : 'Indisponible', 
				start : '{!!$event->start!!}',
				// end: '{!!$event->start!!}',
				backgroundColor : '#f39c12',  
				// backgroundColor : '{!!$event->borderColor!!}',
				borderColor : '#f39c12',
				//borderColor : '{!!$event->borderColor!!}',
			},
			@endforeach
		@endif
		],
		eventRender: function(event, element, view) {
			
			if (event.backgroundColor=='#dd4b39') {
				// event.title('hhhh')
				// $(this).remove();
				// alert(event.backgroundColor);
				// event.backgroundColor.val('#000');
				// $(this).css({'display'  : 'none'});
			}else{
				
			}
		} 
    });

  });

</script>


<!-- CALENDAR_3 -->
<script>

  $(document).ready(function() {
		$('#calendar3').fullCalendar({
		header: {
			left: 'prev,next today',
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
		// defaultDate: '2020-06-01',
		defaultView: 'agendaWeek',
		selectHelper: true,
		scrollTime : '08:00:00',
		navLinks: true,
		editable: false,
		eventLimit: true, // allow "more" link when too many events    
		defaultTimedEventDuration: '01:30:00',
		forceEventDuration: true,
		// THIS KEY WON'T WORK IN PRODUCTION!!!
		// To make your own Google API key, follow the directions here:
		// http://fullcalendar.io/docs/google_calendar/
		googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
		events: [
		@if(isset($dataevent3))
			@foreach($dataevent3 as $event3)
			{
				title : '{!!$event3->title!!}', 
				start : '{!!$event3->start!!}',
				// end: '{!!$event3->start!!}',
				backgroundColor : '{!!$event3->backgroundColor!!}',
				borderColor : '{!!$event3->borderColor!!}',
			},
			@endforeach
		@endif
		],
		eventClick: function(event) {
        // window.open('https://calendar.google.com/calendar/r/week?sf=true', 'gcalevent', 'width=700,height=600');
        // return false;
			/* var event2 = {
			  'summary': 'Google I/O 2015',
			  'location': '800 Howard St., San Francisco, CA 94103',
			  'description': 'A chance to hear more about Google\'s developer products.',
			  'start': {
				'dateTime': '2015-05-28T09:00:00-07:00',
				'timeZone': 'America/Los_Angeles'
			  },
			  'end': {
				'dateTime': '2015-05-28T17:00:00-07:00',
				'timeZone': 'America/Los_Angeles'
			  },
			  'recurrence': [
				'RRULE:FREQ=DAILY;COUNT=2'
			  ],
			  'attendees': [
				{'email': 'lpage@example.com'},
				{'email': 'sbrin@example.com'}
			  ],
			  'reminders': {
				'useDefault': false,
				'overrides': [
				  {'method': 'email', 'minutes': 24 * 60},
				  {'method': 'popup', 'minutes': 10}
				]
			  }
			};

			var request = gapi.client.calendar.events.insert({
			  'calendarId': 'primary',
			  'resource': event
			});

			request.execute(function(event) {
			  appendPre('Event created: ' + event.htmlLink);
			}); */

		},
		eventRender: function(event, element, view) {
			element.find('span.fc-title').addClass('titreClass');     
			element.find('td.fc-list-item-title').addClass('listerdv');
			element.find('span.fc-title').html(element.find('span.fc-title').text());
			element.find('div.fc-content').html(element.find('div.fc-content').text());
			element.find('td.fc-list-item-title').html(element.find('td.fc-list-item-title').text());
		}
    });

  });

</script>


<script>
	var connectButton = document.getElementById('connect-button');
	var ajoutButton = document.getElementById('ajout-button');
	var eventRdv2 = [
		@if(isset($dataevent3))
			@foreach($dataevent3 as $event3)
			/* {
				"summary" : "{!!$event3->title!!}", 
				"location" : "{!!$event3->adresse_details!!}", 
				"description" : "{!!$event3->note_details!!}", 
				"start": {
					// "dateTime": "{!!$event3->start!!}",
					"dateTime": "2020-06-12T19:00:00",
					"timeZone": "Europe/Paris"
				},
				"end": {
					// "dateTime": "{!!$event3->end!!}",
					"dateTime": "2020-06-12T21:00:00",
					"timeZone": "Europe/Paris"
				}
			}, */
			{
				"summary": "Test copie RDV",
				"location": "Test adressse",
				"description": ["<b>a aa a / aaa a a a</b><b><br/>a a a</b><br/><b>Centre d’appels : </b>Groupe Administration<br/><b>Responsable/agent : </b>Alvarez Raoul<br/><b>Qualification : </b>Rendez-vous validé<br/><b>Téléphone : </b>a<br/><b>Mobile : </b>a<br/><b>Email : </b>a<br/><b>Activité société : </b>a<br/><b>Question 1 :</b>aa<br/><b>Question 2 :</b>a<br/><b>Question 3 :</b>a<br/><b>Question 4 :</b>a<br/><b>Question 5 :</b>a<br/><b>Surface total société :</b>a<br/><b>Surface de bureau :</b>a<br/><b>Sous contrat :</b>Non<br/><b>Protection sociale : </b>a<br/><b>Mutuelle santé : </b>a<br/><b>Mutuelle entreprise : </b>Non<br/><b>Seul sur le contrat : </b>Non<br/><b>Statut matrimonial : </b>Celibataire"],
				"start": {
					"dateTime": "2020-06-12T09:00:00",
					"timeZone": "Europe/Paris"
				},
				"end": {
					"dateTime": "2020-06-12T10:30:00",
					"timeZone": "Europe/Paris"
				}
			},
			@endforeach
		@endif
	];  
	// alert(JSON.stringify(eventRdv2));
	
	function authenticate() {
		return gapi.auth2.getAuthInstance()
			.signIn({scope: "https://www.googleapis.com/auth/calendar"})
			.then(
				function() { 
					console.log("Sign-in successful"); 
					connectButton.style.display = 'none';
					ajoutButton.style.display = 'block';
				},
				function(err) { 
					console.error("Error signing in", err); 
				}
			);
	}
  
	function loadClient() {
		// gapi.client.setApiKey("AIzaSyCSb1-dzinoQT2J2Hihhb-15KqqNOI82PQ");
		return gapi.client.load("https://content.googleapis.com/discovery/v1/apis/calendar/v3/rest")
			.then(function() { console.log("GAPI client loaded for API"); },
				  function(err) { console.error("Error loading GAPI client for API", err); });
	}
	
	function execute(event) {
		var eventRdv = {
			"summary": "Test copie RDV",
			"location": "Test adressse",
			// "description": "Test description",
			"description": ["<b>a aa a / aaa a a a</b><b><br/>a a a</b><br/><b>Centre d’appels : </b>Groupe Administration<br/><b>Responsable/agent : </b>Alvarez Raoul<br/><b>Qualification : </b>Rendez-vous validé<br/><b>Téléphone : </b>a<br/><b>Mobile : </b>a<br/><b>Email : </b>a<br/><b>Activité société : </b>a<br/><b>Question 1 :</b>aa<br/><b>Question 2 :</b>a<br/><b>Question 3 :</b>a<br/><b>Question 4 :</b>a<br/><b>Question 5 :</b>a<br/><b>Surface total société :</b>a<br/><b>Surface de bureau :</b>a<br/><b>Sous contrat :</b>Non<br/><b>Protection sociale : </b>a<br/><b>Mutuelle santé : </b>a<br/><b>Mutuelle entreprise : </b>Non<br/><b>Seul sur le contrat : </b>Non<br/><b>Statut matrimonial : </b>Celibataire"],
			"start": {
				"dateTime": "2020-06-12T09:00:00",
				"timeZone": "Europe/Paris"
			},
			"end": {
				"dateTime": "2020-06-12T10:30:00",
				"timeZone": "Europe/Paris"
			}
		};
		// alert(eventRdv);
		
	// alert(JSON.stringify(eventRdv2));
	
		var request = gapi.client.calendar.events.insert({
			'calendarId': 'primary',
			'sendNotifications': 'true',
			'sendUpdates': 'all',
			'supportsAttachments': 'false',
			'resource': eventRdv
			// 'resource': eventRdv2
			// 'resource': JSON.stringify(eventRdv2)
		})
	
		// gapi.client.setApiKey("AIzaSyCSb1-dzinoQT2J2Hihhb-15KqqNOI82PQ");
		
		request.execute(function(event) {
			// appendPre('Event created: ' + event.htmlLink);
			console.error("Lien calendrier google:", event.htmlLink);
			ajoutButton.style.display = 'none';
			window.open(event.htmlLink,'_blank');
		});
	}
  
	gapi.load("client:auth2", function() {
		gapi.auth2.init({
			apiKey: "AIzaSyCSb1-dzinoQT2J2Hihhb-15KqqNOI82PQ",
			client_id: "738352823188-1o5808mk13am3kmakr1pq7kssqgo9d9u.apps.googleusercontent.com"
			});
	});
</script>


<!-- CALENDAR_4 -->
<script>

  $(document).ready(function() {

		$('#calendar4').fullCalendar({
		header: {
			left: 'prev,next today',
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
		// defaultDate: '2020-06-01',
		defaultView: 'agendaWeek',
		selectHelper: true,
		scrollTime : '08:00:00',
		navLinks: true,
		editable: false,
		eventLimit: true, // allow "more" link when too many events    
		defaultTimedEventDuration: '01:30:00',
		forceEventDuration: true,
		events: [
		@if(isset($dataevent))
			@foreach($dataevent as $event)
			{
				title : 'Indisponible', 
				start : '{!!$event->start!!}',
				// end: '{!!$event->start!!}',
				backgroundColor : '#582900',  
				// backgroundColor : '{!!$event->borderColor!!}',
				borderColor : '#582900',
				//borderColor : '{!!$event->borderColor!!}',
			},
			@endforeach
		@endif
		],
		eventRender: function(event, element, view) {
			
			if (event.backgroundColor=='#dd4b39') {
				// event.title('hhhh')
				// $(this).remove();
				// alert(event.backgroundColor);
				// event.backgroundColor.val('#000');
				// $(this).css({'display'  : 'none'});
			}else{
				
			}
		} 
    });

  });

</script>

<!-- CALENDAR_4 -->
<script>

  $(document).ready(function() {

		$('#agenda_comresp_public').fullCalendar({
		header: {
			left: 'prev,next today',
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
		// defaultDate: '2020-06-01',
		defaultView: 'agendaWeek',
		selectHelper: true,
		scrollTime : '08:00:00',
		navLinks: true,
		editable: false,
		eventLimit: true, // allow "more" link when too many events    
		defaultTimedEventDuration: '01:30:00',
		forceEventDuration: true,
		events: [
		@if(isset($dataevent))
			@foreach($dataevent as $event)
			{
				// title : '{!!$event->title!!}', 
				title : 'Indisponible', 
				start : '{!!$event->start!!}',
				// end: '{!!$event->start!!}',
				backgroundColor : '#f39c12',  //Jaune
				// backgroundColor : '{!!$event->borderColor!!}',
				borderColor : '#f39c12',  //Jaune
				// borderColor : '{!!$event->borderColor!!}', 
			},
			@endforeach
		@endif
		],
		eventRender: function(event, element, view) {
			element.find('span.fc-title').addClass('titreClass');     
			element.find('td.fc-list-item-title').addClass('listerdv');
			element.find('span.fc-title').html(element.find('span.fc-title').text());
			element.find('div.fc-content').html(element.find('div.fc-content').text());
			element.find('td.fc-list-item-title').html(element.find('td.fc-list-item-title').text());
			
			if (event.backgroundColor=='#dd4b39') {
				// event.title('hhhh')
				// $(this).remove();
				// alert(event.backgroundColor);
				// event.backgroundColor.val('#000');
				// $(this).css({'display'  : 'none'});
			}else{
				
			}
		}
    });

  });

</script>

<!-- UPLOAD image-->
	<script src="{{ asset ('/js/upload_image.js') }}"></script>
<!-- UPLOAD AUDIO -->
<script>

  $(document).ready(function() {


		if($('#hidden_audio').val()==''){
			$("#btnajouter").show();
			$("#btnremplacer").hide();
			$("#btnsupprimer").hide();
		}else{
			$("#btnajouter").hide();
			$("#btnremplacer").show();
			$("#btnsupprimer").show();
		}
        $('#audioInputfile').change(function(e){
            var fileName = e.target.files[0].name;
            // alert('The file "' + fileName +  '" has been selected.');
			$('#is_audio').val('Oui');
			$('#hidden_audio').val('');
			$('#hidden_audio').val(fileName);
			$('#btnmodifaudio').click();
        });
		
		$("#btnsupprimer").click(function(){
			$('#hidden_audio').val('');
		});
		
		$("#btnrdvexcel0").click(function(){

			$('.exprtout').removeClass('noExl');
			$('#btnrdvexcel').click();
		});
		
		$("#btnrdvexcel1").click(function(){
			$('.exprtout').addClass('noExl');
			$('#btnrdvexcel').click();
		});
		
        // $('#telechargerpdfficherdv1').change(function(e){
			// $('#telechargerpdfficherdv2').click();
        // });
		// if($('#telechargerpdfficherdv1').click()){
			// $('#telechargerpdfficherdv2').click();
		// }
		
			
  });

  function confirmDelete()
  {
      var x = confirm("êtes vous sûr de vouloir supprimer cet élément ?");
      if (x)
          return true;
      else
          return false;
  }

 function deleteRdv(url){ 
 
  var x = confirm("êtes vous sûr de vouloir supprimer cet élément ?");
      if (x)
          return window.location.href=url;
      else
          return false;

 }
  document.write()
  function showTime() {
      var date = new Date();
      var date=new Date()
      var h=date.getHours();
      if (h<10) {h = "0" + h}
      var m=date.getMinutes();
      if (m<10) {m = "0" + m}
      var s=date.getSeconds();
      if (s<10) {s = "0" + s}

     //document.getElementById('time').innerHTML = h+":"+m;
  }
  setInterval(showTime, 1000);

  // on change resp/agent on select on  call center
  $('#centreappel_societe_ch').change(function (e) {
      var id = $(this).children(":selected").attr("data-centre");
      $('#rdv_id_groupe').val(id);
      console.log("call center id :" +id);
      $.ajax({
		  url: "/get-agent/"+id,
		  method: "get",
		  success: function (data) {
		      var len = data.length;
		    $("#centreappel_societe_agent").empty();
		    for (var i =0; i<len; i++){
		        var name = data[i]['nom'];
		        var prenom = data[i]['prenom'];
				var id_agent = data[i]['_id'];
                $("#centreappel_societe_agent").append("<option value='"+id_agent+','+prenom+' '+name+"'>"+prenom+' '+name+"</option>");
			}
          }
	  })
  });
  // on change campagne en cours
  $('#campagne-client').change(function (e) {
      var prenomCli = $(this).children(":selected").attr("data-campagne-client-prenom");
      var nomCli = $(this).children(":selected").attr("data-campagne-client-nom");
      var emailCli = $(this).children(":selected").attr("data-campagne-client-email");
      var idCli = $(this).children(":selected").attr("data-campagne-client-id");
      console.log('client id :' + idCli);
      $('#client_id_camp').val(idCli);
	  $('#client_prenompriv_camp').val(prenomCli);
	  $('#client_nompriv_camp').val(nomCli);
	  $('#client_emailpriv_camp').val(emailCli);
  });

  function getUnreadNotif(){
	$.ajax({
		  url: "/get-unread",
		  method: "get",
		  success: function (data) {
		      if(data){
				$('#blink-sup1').removeClass("blink");  
				$('#blink-sup2').removeClass("blink"); 

				$('#blink-sup1').addClass("blink");  
				$('#blink-sup2').addClass("blink");  
			  console.log("add blink");
			  }else{
				$('#blink-sup1').removeClass("blink");  
				$('#blink-sup2').removeClass("blink");  
				console.log("non");
			}
          }
	  })
  }
  setInterval(getUnreadNotif, 20000);


</script>

<script>
	$('#modaly').click(function(){
    $('#onLoadModal').modal('show');
	});
        $(function () {


            // Initialisation des DateTimePicker
            //Timepicker
          /*  $('.heure_plage').timepicker({
                showMeridian: false,
                showInputs: false
            }) */

            // Initialisation index pour étiquettes
            var index = 0;

            // Suppression d'une ligne de réponse (utilisation de "on" pour gérer les boutons créés dynamiquement)
            $(document).on('click', '.btn-danger', function(){
                $(this).parents('.ligne').remove();
            });

            // Ajout d'une ligne de plage horaire
            $('.add_plage').on('click',function() {
				var day = $(this).attr('id');
                var html = '<div class="ligne">\n'
                    + '<div class="row form-group">\n'
                    + '<div class="col-sm-10">\n'
                    + '<label for="start' + index++ + '" class="col-sm-4 control-label">Heure de début :</label>\n'                    + '<div class="col-sm-8 input-group date">\n'
                    + '<input class="form-control" name="start[' + day + '][]" id ="' + index++ + '" type="text">\n'
                    + '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>\n'
                    + '</div></div></div>\n'
                    + '<div class="row form-group">\n'
                    + '<div class="col-sm-10">\n'
                    + '<label for="end' + index++ + '" class="col-sm-4 control-label">Heure de fin :</label>\n'
                    + '<div class="col-sm-8 input-group date">\n'
                    + '<input class="form-control" name="end[' + $(this).attr("id") + '][]" id ="' + index++ + '" type="text">\n'
                    + '<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>\n'
                    + '</div></div>\n'
                    + '<div class="col-sm-2"><button type="button" class="btn btn-danger" style="float:right">Supprimer</button></div></div>\n'
                    + '</div>\n';
                $(this).parents('.panel').find('.panel-body').append(html);
                $('.date').datetimepicker({ locale: 'fr', format: 'LT' });
            });
        });
	</script>




	