<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\Crypt;
// use App\Hashids\Hashids;
use Hashids\Hashids;

use App\Http\Controllers\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Client;
use App\Centreappel;
use App\User;
use App\Rdv;
use Calendar;
use App\Event;
use Spatie\CalendarLinks\Link;
use DateTime;

use Jsvrcek\ICS\Model\Calendar as Calendar2;
use Jsvrcek\ICS\Model\CalendarEvent;
use Jsvrcek\ICS\Model\Relationship\Attendee;
use Jsvrcek\ICS\Model\Relationship\Organizer;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;

use ICal\ICal;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
    public function indexHH()
    {
		try {
			// $ical = new ICal('ICal.ics', array(
			$ical = new ICal('https://calendar.google.com/calendar/ical/f26nr9uphsj19d8hg2v0f215fs%40group.calendar.google.com/private-d1d5c48d0d7033ab02afeba4f19991cb/basic.ics', array(
			// $ical = new ICal('https://calendar.google.com/calendar/ical/contact%40confirmationrdv.com/public/basic.ics', array(
				'defaultSpan'                 => 2,     // Default value
				'defaultTimeZone'             => 'UTC',
				'defaultWeekStart'            => 'MO',  // Default value
				'disableCharacterReplacement' => false, // Default value
				'filterDaysAfter'             => null,  // Default value
				'filterDaysBefore'            => null,  // Default value
				'skipRecurrence'              => false, // Default value
			));
			// $ical = $ical->initUrl('https://calendar.google.com/calendar/ical/f26nr9uphsj19d8hg2v0f215fs%40group.calendar.google.com/private-d1d5c48d0d7033ab02afeba4f19991cb/basic.ics', $username = null, $password = null, $userAgent = null);
		
			// Dump the whole calendar
			// var_dump($ical->cal);
			// Dump every event
			// var_dump($ical->events());
			// Dump a parsed event's start date
			// var_dump($event->dtstart_array);
			//Events in the next 7 days
			// $events = $ical->eventsFromInterval('1 week');
			$events = $ical->events();
			// var_dump($events);
			foreach ($events as $event){
				// echo 'coco';
				$dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
				$dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
                echo 'Summary: '.$event->summary . '</br>';
                echo 'Dtstart: '.$dtstart->format('d-m-Y H:i') . '</br>';
                echo 'Dtend: '.$dtend->format('d-m-Y H:i') . '</br>';
                echo 'Description: '.$event->description . '</br>';
                echo 'Location: '.$event->location . '</br>';
                echo 'Status: '.$event->status . '</br></br>';
                // echo $event->summary . ' (' . $dtstart->format('d-m-Y H:i') . ')</br>';
				
				/* $agenda = new Event([
					'client_priv' => $request->get('client_priv'),
					'title' => $request->get('titredh'),  
					'start' => $request->get('date_debutdh'),  
					'end' => $request->get('date_findh'),
					'backgroundColor' => '#f39c12',  
					'borderColor' => '#f39c12'		
			   ]);
				$agenda->save(); */
				
			}
			// var_dump($events);
			
			// echo $ical->eventCount;
			
		} catch (\Exception $e) {
			die($e);
		}
	}
	
	
    public function index()
    {
		/* //vider calendrier
		$evenement = Event::all();
		foreach ($evenement as $evnmt){
			$evnmt->delete();
		} */	 
		

		$comptesclient = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
			->where('agendapriv', '<>', null)
				->get();
		
		foreach ($comptesclient as $cli){
			// echo $cli->prenom.' '.$cli->nom.' / '.$cli->agendapriv.'<br/>'; 
			/************** AJOUT EVENNEMENT CALENDRIER ****************************/
			
			try {
				// $adresse = $request->get('agendapriv');
				$adresse = $cli->agendapriv;
				// $ical = new ICal('https://calendar.google.com/calendar/ical/f26nr9uphsj19d8hg2v0f215fs%40group.calendar.google.com/private-d1d5c48d0d7033ab02afeba4f19991cb/basic.ics', array(
				// $ical = new ICal('https://calendar.google.com/calendar/ical/contact%40confirmationrdv.com/public/basic.ics', array(
				$ical = new ICal($adresse, array(
				// $ical = new ICal('basicraoult.ics', array(
				// $ical = new ICal('basictest.ics', array(
					'defaultSpan'                 => 2,     // Default value
					// 'defaultTimeZone'             => 'UTC',
					'defaultTimeZone'             => 'UTC',
					'defaultWeekStart'            => 'MO',  // Default value
					'disableCharacterReplacement' => false, // Default value
					'filterDaysAfter'             => null,  // Default value
					'filterDaysBefore'            => null,  // Default value
					'skipRecurrence'              => false, // Default value
				));
				$events = $ical->events();
				  // Comparer les valeurs
				  // $cmp = array_diff($tab1, $tab2);
				  // print_r($cmp);
				$calcrmetier[] = null;
				$calgoogle[] = null;
				$evenement3 = Event::all();
				foreach ($evenement3 as $evnmt){
					$calcrmetier[] = $evnmt->googleuid; 
				}
				foreach ($events as $event){
					$calgoogle[] = $event->dtstart_array[3].'_'.$event->uid.'_'.$cli->prenom.$cli->nom;
					$evenement = Event::where('googleuid', '=', $event->dtstart_array[3].'_'.$event->uid.'_'.$cli->prenom.$cli->nom)->first();
					// var_dump($evenement);
					if(isset($evenement)){
						$dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
						$dtstart = \Carbon\Carbon::parse($dtstart);
						$dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
						$dtend = \Carbon\Carbon::parse($dtend);
						$evenement->client_priv = $cli->prenom.' '.$cli->nom;
						$evenement->title = 'indisponible';
						// $evenement->title = $event->summary;
						// $evenement->title = 'updt_'.$event->dtstart_array[3].'_'.$event->uid;
						$evenement->start = $dtstart->add(120, 'minute')->format('Y-m-d H:i:s');
						$evenement->end = $dtend->add(120, 'minute')->format('Y-m-d H:i:s');
						$evenement->save();
					}else{
						
						$dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
						$dtstart = \Carbon\Carbon::parse($dtstart);
						$dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
						$dtend = \Carbon\Carbon::parse($dtend);
						$agenda = new Event([
							// 'googleuid' => $event->uid,
							'googleuid' => $event->dtstart_array[3].'_'.$event->uid.'_'.$cli->prenom.$cli->nom,
							'client_priv' => $cli->prenom.' '.$cli->nom,
							'title' => 'indisponible',  
							// 'title' => $event->summary,  
							// 'title' => 'add_'.$event->dtstart_array[3].'_'.$event->uid,  
							'start' => $dtstart->add(120, 'minute')->format('Y-m-d H:i:s'),  
							'end' => $dtend->add(120, 'minute')->format('Y-m-d H:i:s'),
							'backgroundColor' => '#f39c12',  
							'borderColor' => '#f39c12'		
					   ]);
						$agenda->save();
					}
				
				}
				
				// print_r($calgoogle);
				// print_r($calcrmetier);
				  // Comparer les valeurs
				  // $cmp = array_diff($calgoogle, $calcrmetier);
				  $cmp = array_diff($calcrmetier, $calgoogle);
				  // $cmp = array_diff_assoc($calgoogle, $calcrmetier);
				  // $cmp = array_diff_assoc($calcrmetier, $calgoogle);
				  foreach($cmp as $c){
					  $evenementsup = Event::where('googleuid', '=', $c);
					  $evenementsup->delete();
					  // echo $c.'<br/>';
				  }
				  // print_r($cmp);
				
			} catch (\Exception $e) {
				die($e);
			}
        
		}

        // $staffs = User::all();
		/* $staffs = User::where('statut', '=', 'Administrateur')
				->orWhere('statut', '=', 'Staff')
				->get(); 
        $centreappels = Centreappel::all();
        $clients = Client::all();
        return view('staffs.index', compact('staffs','centreappels','clients')); */
		$rdvs = Rdv::all();
		// $rdvs2 = Rdv::where('_idRdv', '=', '5ebfed3c49710000c5002d34')->get();

		
		// $evenement = Event::where('backgroundColor', '<>', '#f39c12');
		// $evenement->delete();
		
		$calendar= 'hhhhhhh';
		// $test= 'hhhhhhh';
		$dateko= 'lll';
		$datacalendrier = [];
        $dataevent = Event::all();
        if($rdvs->count()) {
            foreach ($rdvs as $key => $value) {
		
			$dateagenda = \Carbon\Carbon::parse($value->date_rendezvous.' '.$value->heure_rendezvous);
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			
				// $datacalendrier[] = array('title' => $value->societe, 'url' => 'pass here url and any route');
				$datacalendrier[] = array('title' => $value->nom.' '.$value->prenom.' '.$value->societe.' '.$value->nom_personne_rendezvous.'<br/>'.$value->adresse.' '.$value->cp.' '.$value->ville, 'start' => $dateagenda, 'end' => $dateagenda, 'backgroundColor' => $value->couleur_rdv, 'borderColor' => $value->couleur_rdv);
            }
        } ;
		// $comptesclient = User::all();
		// $comptesclient = User::where('statut', '<>', '')
			// ->orWhere('statut', '<>', ' ')
			// ->orWhere('statut', '<>', null)
            // ->get();
		$comptesclient = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
			// ->orWhere('statut', '=', 'Agent')
			// ->orWhere('statut', '=', 'Superviseur')
			// ->orWhere('statut', '=', 'Administrateur')
			// ->orWhere('statut', '=', 'Staff')
            ->get();
			
/* 			
		$from = DateTime::createFromFormat('Y-m-d H:i', '2018-02-01 09:00');
		$from2 = DateTime::createFromFormat('Y-m-d H:i', '2018-02-01 09:00');
		// $from = \Carbon\Carbon::parse('2018-02-01 09:00')->format('Y-m-d H:i');
		$to = DateTime::createFromFormat('Y-m-d H:i', '2018-02-01 18:00');
		$to2 = DateTime::createFromFormat('Y-m-d H:i', '2018-02-01 18:00');
		// $to = \Carbon\Carbon::parse('2018-02-01 18:00')->format('Y-m-d H:i');

		$link = Link::create('Test titre', $from, $to)
			->description('Test description')
			->address('Test adresse');

		// $link .= Link::create('Test titre2', $from2, $to2)
			// ->description('Test description2')
			// ->address('Test adresse2');
			
		// Générer un lien pour créer un événement sur l'agenda Google
		$googlelink = $link->google();

		// Générer un lien pour créer un événement sur le calendrier Yahoo
		$yahoolink = $link->yahoo();

		// Générer un lien pour créer un événement sur le calendrier Outlook.com
		$webOutlooklink = $link->webOutlook();

		// Générer un uri de données pour un fichier ics (pour iCal et Outlook)
		$icslink = $link->ics();
 */		
		
/*		
	//setup an event
	$eventOne = new CalendarEvent();
	$eventOne->setStart(new \DateTime())
		->setSummary('Family reunion')
		->setUid('event-uid');
		
	//add an Attendee
	$attendee = new Attendee(new Formatter());
	$attendee->setValue('heryaddams@gmail.com')
		->setName('Moe Smith');
	$eventOne->addAttendee($attendee);

	//set the Organizer
	$organizer = new Organizer(new Formatter());
	$organizer->setValue('heryaddams@gmail.com')
		->setName('Heidi Merkell')
		->setLanguage('de');
	$eventOne->setOrganizer($organizer);

	//new event
	$eventTwo = new CalendarEvent();
	$eventTwo->setStart(new \DateTime())
		->setSummary('Dentist Appointment')
		->setUid('event-uid');

	//setup calendar
	$calendar = new Calendar2();
	$calendar->setProdId('-//My Company//Cool Calendar App//EN')
		->addEvent($eventOne)
		->addEvent($eventTwo);

	//setup exporter
	$calendarExport = new CalendarExport(new CalendarStream, new Formatter());
	$calendarExport->addCalendar($calendar);



	//output .ics formatted text
	// echo $calendarExport->getStream();
	$icslink = $calendarExport->getStream();


       // Set the headers
       header('Content-type: text/calendar; charset=utf-8');
       header('Content-Disposition: attachment; filename="cal.ics"');
      
       $icslink = str_replace(' ', '', $icslink);
*/			
		
		

	   
		// return view('agendas.index', compact('googlelink','yahoolink','webOutlooklink','icslink','rdvs','dataevent','dateko','calendar','datacalendrier','comptesclient'));
		return view('agendas.index', compact('rdvs','dataevent','dateko','calendar','datacalendrier','comptesclient'));
    }

    public function comresp_public($id)
    {
        // $dataevent = Event::all();
		// print_r($dataevent);
		$staffs = User::findOrFail($id);
		/* //vider calendrier
		$evenement = Event::where('client_priv', '=', $staffs->prenom.' '.$staffs->nom);
		$evenement->delete(); 
		*/
		
		/************** AJOUT EVENNEMENT CALENDRIER ****************************/
		$adresse = $staffs->agendapriv;
		$infoLien = pathinfo($adresse);
		$extension = $infoLien['extension'];
		if ($extension=='ics'){
			try {
				// $adresse = $request->get('agendapriv');
				// $ical = new ICal('https://calendar.google.com/calendar/ical/f26nr9uphsj19d8hg2v0f215fs%40group.calendar.google.com/private-d1d5c48d0d7033ab02afeba4f19991cb/basic.ics', array(
				// $ical = new ICal('https://calendar.google.com/calendar/ical/contact%40confirmationrdv.com/public/basic.ics', array(
				
				$ical = new ICal($adresse, array(
				// $ical = new ICal('basicraoult.ics', array(
				// $ical = new ICal('basictest.ics', array(
					'defaultSpan'                 => 2,     // Default value
					// 'defaultTimeZone'             => 'UTC',
					'defaultTimeZone'             => 'UTC',
					'defaultWeekStart'            => 'MO',  // Default value
					'disableCharacterReplacement' => false, // Default value
					'filterDaysAfter'             => null,  // Default value
					'filterDaysBefore'            => null,  // Default value
					'skipRecurrence'              => false, // Default value
				));

				$events = $ical->events();
				  // Comparer les valeurs
				  // $cmp = array_diff($tab1, $tab2);
				  // print_r($cmp);
				  $calcrmetier[] = null;
				  $calgoogle[] = null;
				  
				$evenement3 = Event::all();
				foreach ($evenement3 as $evnmt){
					$calcrmetier[] = $evnmt->googleuid; 
				}
				foreach ($events as $event){
					$calgoogle[] = $event->dtstart_array[3].'_'.$event->uid;
					$evenement = Event::where('googleuid', '=', $event->dtstart_array[3].'_'.$event->uid)->first();
					// var_dump($evenement);
					if(isset($evenement)){
						$dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
						$dtstart = \Carbon\Carbon::parse($dtstart);
						$dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
						$dtend = \Carbon\Carbon::parse($dtend);
						$evenement->client_priv = $staffs->prenom.' '.$staffs->nom;
						$evenement->title = 'indisponible';
						// $evenement->title = $event->summary;
						// $evenement->title = 'updt_'.$event->dtstart_array[3].'_'.$event->uid;
						$evenement->start = $dtstart->add(120, 'minute')->format('Y-m-d H:i:s');
						$evenement->end = $dtend->add(120, 'minute')->format('Y-m-d H:i:s');
						$evenement->save();
					}else{
						
						$dtstart = $ical->iCalDateToDateTime($event->dtstart_array[3]);
						$dtstart = \Carbon\Carbon::parse($dtstart);
						$dtend = $ical->iCalDateToDateTime($event->dtend_array[3]);
						$dtend = \Carbon\Carbon::parse($dtend);
						$agenda = new Event([
							// 'googleuid' => $event->uid,
							'googleuid' => $event->dtstart_array[3].'_'.$event->uid,
							'client_priv' => $staffs->prenom.' '.$staffs->nom,
							'title' => 'indisponible',  
							// 'title' => $event->summary,  
							// 'title' => 'add_'.$event->dtstart_array[3].'_'.$event->uid,  
							'start' => $dtstart->add(120, 'minute')->format('Y-m-d H:i:s'),  
							'end' => $dtend->add(120, 'minute')->format('Y-m-d H:i:s'),
							'backgroundColor' => '#f39c12',  
							'borderColor' => '#f39c12'		
					   ]);
						$agenda->save();
					}
				
				}
				
				// print_r($calgoogle);
				// print_r($calcrmetier);
				  // Comparer les valeurs
				  // $cmp = array_diff($calgoogle, $calcrmetier);
				  $cmp = array_diff($calcrmetier, $calgoogle);
				  // $cmp = array_diff_assoc($calgoogle, $calcrmetier);
				  // $cmp = array_diff_assoc($calcrmetier, $calgoogle);
				  foreach($cmp as $c){
					  $evenementsup = Event::where('googleuid', '=', $c);
					  $evenementsup->delete();
					  // echo $c.'<br/>';
				  }
				  // print_r($cmp);
				
			} catch (\Exception $e) {
				die($e);
			}
		}	
		
        $dataevent = Event::where('client_priv', '=', $staffs->prenom.' '.$staffs->nom)
					// ->where('qualification', '<>', 'Rendez-vous annulé')
					->get(); 
		
		return view('agendas.comresp_public', compact('dataevent'));
    }


    public function agendacomresp_public($id)
    {
		$staffs = User::findOrFail($id);
        $dataevent = Event::where('client_priv', '=', $staffs->prenom.' '.$staffs->nom)
					// ->where('qualification', '<>', 'Rendez-vous annulé')
					->get(); 
					
					// print_r($dataevent);
 	

					
		define('ICAL_FORMAT', 'Ymd\THis\Z');

		$icalObject = "BEGIN:VCALENDAR\nCALSCALE:GREGORIAN\nVERSION:2.0\nMETHOD:PUBLISH\nPRODID:-//Rendez-vous//CRM MÉTIER//EN\n";

		foreach ($dataevent as $event) {
           $icalObject .=
           "BEGIN:VEVENT\nDTSTART:" . date(ICAL_FORMAT, strtotime($event->start)) . "\nDTEND:" . date(ICAL_FORMAT, strtotime($event->end)) . "\nDTSTAMP:" . date(ICAL_FORMAT, strtotime($event->created_at)) . "\nSUMMARY:$event->titre_details\nUID:$event->_id\nSTATUS:" . strtoupper('$event->_id') . "\nLAST-MODIFIED:" . date(ICAL_FORMAT, strtotime($event->updated_at)) . "\nLOCATION:$event->adresse_details\nDESCRIPTION:$event->note_details\nEND:VEVENT\n";
		}

		// close calendar
		$icalObject .= "END:VCALENDAR";

       // Set the headers
       // header('Content-type: text/calendar; charset=utf-8');
       // header('Content-Disposition: attachment; filename="agendatest.ics"');
	   
       // $icalObject = str_replace(' ', '', $icalObject);
  
       // echo $icalObject;
	   
 
/* 	   
		//setup an event
		$eventOne = new CalendarEvent();
		$eventOne->setStart(new \DateTime())
			->setSummary('Family reunion')
			->setUid('event-uid');

		//new event
		$eventTwo = new CalendarEvent();
		$eventTwo->setStart(new \DateTime())
			->setSummary('Dentist Appointment')
			->setUid('event-uid');

		//setup calendar
		$calendar = new Calendar2();
		$calendar->setProdId('-//My Company//Cool Calendar App//EN')
			->addEvent($eventOne);
			// ->addEvent($eventTwo);

		//setup exporter
		$calendarExport = new CalendarExport(new CalendarStream, new Formatter());
		$calendarExport->addCalendar($calendar);

		//output .ics formatted text
		// echo $calendarExport->getStream();
		$icalObject = $calendarExport->getStream();
 */
		// $file = fopen("uploads/agenda/".$id.".ics", "w+");
		// fwrite($file, $icalObject);
		// fclose($file);
		// return $icalObject->download('ficherdv.pdf');	
		// return $file->download($id.".ics");	
		// return view('agendas.comresp_public', compact('dataevent'));
		// return "uploads/agenda/".$id.".ics";
		// header('Content-type: text/calendar; charset=utf-8');
		// header('Content-Disposition: inline; filename=calendar.ics');
		// header('Content-Disposition: inline; filename='.$id'.ics');
		$nomfichier= 'Agenda Rendez-vous CRM MÉTIER '.$staffs->prenom.'.ics';
       // Set the headers
       header('Content-type: text/calendar; charset=utf-8');
       header('Content-Disposition: attachment; filename="'.$nomfichier.'"');
	   
       // $icalObject = str_replace(' ', '', $icalObject);
	   
		echo $icalObject;
    }

    public function agenda2()
    {
        // $dataevent = Event::all();
		$dataevent = Event::where('backgroundColor', '<>', '#999')
				// ->orWhere('backgroundColor', '=', 'dd4b39')
				->get(); 
		return view('agendas.index2', compact('dataevent'));
    }
		
	public function getClient(){
		$client = new Google_Client();
		$client->setApplicationName('Calendar API PHP');
		$client->addScope(Google_Service_Calendar::CALENDAR);
		$client->setAuthConfig('credentials.json');
		$client->setAccessType('offline');
		$client->setPrompt('select_account consent');

		// Load previously authorized token from a file, if it exists.
		// The file token.json stores the user's access and refresh tokens, and is
		// created automatically when the authorization flow completes for the first
		// time.
		$tokenPath = 'token.json';
		if (file_exists($tokenPath)) {
			$accessToken = json_decode(file_get_contents($tokenPath), true);
			$client->setAccessToken($accessToken);
		}

		// If there is no previous token or it's expired.
		if ($client->isAccessTokenExpired()) {
			// Refresh the token if possible, else fetch a new one.
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
			} else {
				// Request authorization from the user.
				$authUrl = $client->createAuthUrl();
				printf("Open the following link in your browser:\n%s\n", $authUrl);
				print 'Enter verification code: ';
				$authCode = trim(fgets(STDIN));

				// Exchange authorization code for an access token.
				$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
				$client->setAccessToken($accessToken);

				// Check to see if there was an error.
				if (array_key_exists('error', $accessToken)) {
					throw new Exception(join(', ', $accessToken));
				}
			}
			// Save the token to a file.
			if (!file_exists(dirname($tokenPath))) {
				mkdir(dirname($tokenPath), 0700, true);
			}
			file_put_contents($tokenPath, json_encode($client->getAccessToken()));
		}
		return $client;
	}


	function createCalendar($service){
		$calendar = new Google_Service_Calendar_Calendar();
		$calendar->setSummary('calendarSummary');
		$calendar->setTimeZone('America/Los_Angeles');
		try {
			$createdCalendar = $service->calendars->insert($calendar);
			echo $createdCalendar->getId();
			return $createdCalendar->getId();
		} catch(Exception $e) {
			printf('An error occured creating the Calendar ' . $e->getMessage());
			return null;
		}    
	}

	function insertMyevents($service, $calendarId){
		$event = new Google_Service_Calendar_Event(array(
			'summary' => 'Google I/O 2019',
			'location' => '800 Howard St., San Francisco, CA 94103',
			'description' => 'A chance to hear more about Google\'s developer products.',
			'start' => array(
			  'dateTime' => '2019-11-13T09:00:00-07:00',
			  'timeZone' => 'America/Los_Angeles',
			),
			'end' => array(
			  'dateTime' => '2019-11-14T17:00:00-07:00',
			  'timeZone' => 'America/Los_Angeles',
			)
		));
		try{
			$event = $service->events->insert($calendarId, $event);
		} catch(Exception $e) {
			printf('An error occured inserting the Events ' . $e->getMessage());
		}   
	}


	
    public function agenda3()
    {
		// $client = new \Google_Client();
				// $client->setApplicationName("GOOGLE CALENDAR");
				// $client->addScope(\Google_Service_Calendar::CALENDAR);
				// $client->setAuthConfig('pr-test-4ad4a00e3031.json');
				// $client->setAccessType("offline");

				// $service =  new \Google_Service_Calendar($client);
				// $calenders =  new \Google_Service_Calendar_Calendar();
				// $calenders->setDescription('ramzi');
				// $calenders->setSummary('test');
				// $service->calendars->insert($calenders);
				// print_r($calenders);
		
		$dataevent3 = Event::where('backgroundColor', '<>', '#999')//Rdv envoyé
				->orWhere('backgroundColor', '<>', 'dd4b39') //Rdv manuel
				->get(); 
		return view('agendas.index3', compact('dataevent3'));
    }
	
    public function agenda4($id)
    {
		$rdvs = Rdv::all();
		$calendar= 'hhhhhhh';
		$dateko= 'lll';
		$datacalendrier = [];
        $dataevent = Event::all();
        if($rdvs->count()) {
            foreach ($rdvs as $key => $value) {
		
			$dateagenda = \Carbon\Carbon::parse($value->date_rendezvous.' '.$value->heure_rendezvous);
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			
				$datacalendrier[] = array('title' => $value->nom.' '.$value->prenom.' '.$value->societe.' '.$value->nom_personne_rendezvous.'<br/>'.$value->adresse.' '.$value->cp.' '.$value->ville, 'start' => $dateagenda, 'end' => $dateagenda, 'backgroundColor' => $value->couleur_rdv, 'borderColor' => $value->couleur_rdv);
            }
        } ;
		$comptesclient = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
            ->get();
			
		// return view('agendas.index2', compact('rdvs','dataevent','dateko','calendar','datacalendrier','comptesclient'));
		return view('index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    // public function create(Request $request)
    {
		// return view('staffs.create');
			$agenda = new Event([
				'title' => 'UIUIUIUI',  
				// 'title' => $request,  
				'start' => '2020-05-05',  
				'end' => '2020-05-05',  
				'backgroundColor' => '#f39c12',  
				'borderColor' => '#f39c12'		
		   ]);
			$agenda->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// $events = Event::truncate();
		$agenda = new Event([
			'client_priv' => $request->get('client_priv'),
			'title' => $request->get('titredh'),  
			'start' => $request->get('date_debutdh'),  
			'end' => $request->get('date_findh'),
			'backgroundColor' => '#f39c12',  
			'borderColor' => '#f39c12'		
	   ]);
		$agenda->save();
       
       return redirect('/agendas')->with('success', 'Plage d\'horaire indisponible enregistrée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idencode)
    {
		$hashids = new Hashids('LSPlusaltUser', 7);
		// $id = $hashids->decode($idencode)[0];
        $staff = User::findOrFail($idencode);
       return view('staffs.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$id = $request->get('id_details');
        $event = Event::find($id);
		$event->delete(); 

		return redirect('/agendas')->with('success', 'evenement supprimé!');
    }
	
    public function suppEvent(Request $request,$id)
    {
		$id = $request->get('id_details');
        $event = Event::find($id);
		$event->delete(); 

		return redirect('/agendas')->with('success', 'evenement supprimé!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    // public function destroy(Request $request)
    {
		/* $id = $request->get('id_details');
        $event = Event::find($id);
		$event->delete();
		return redirect('/agendas')->with('success', 'evenement supprimé!'); */
		
        $event = Event::findOrFail($id);
		$event->delete(); 
		return redirect('/agendas')->with('success', 'evenement supprimé!');
    }


}
