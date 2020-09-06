<?php

namespace App\Http\Controllers;
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

use ICal\ICal;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexhh()
    {
        // $staffs = User::all();
		/* $staffs = User::where('statut', '=', 'Administrateur')
				->orWhere('statut', '=', 'Staff')
				->get(); 
        $centreappels = Centreappel::all();
        $clients = Client::all();
        return view('staffs.index', compact('staffs','centreappels','clients')); */
		$rdvs = Rdv::all();
		// $rdvs = Rdv::where('_idRdv', '=', '5ebfed3c49710000c5002d34')->get();

		
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
			
		return view('agendas.index', compact('rdvs','dataevent','dateko','calendar','datacalendrier','comptesclient'));
    }

    public function index()
    {
		$comptesclient = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
			->where('agendapriv', '<>', null)
				->get();
		
		foreach ($comptesclient as $cli){
			// echo $cli->prenom.' '.$cli->nom.' / '.$cli->agendapriv.'<br/>'; 
			/************** AJOUT EVENNEMENT CALENDRIER ****************************/
			$adresse = $cli->agendapriv;
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
							// $evenement->start = $dtstart->add(120, 'minute')->format('Y-m-d H:i:s');
							// $evenement->end = $dtend->add(120, 'minute')->format('Y-m-d H:i:s');
							$evenement->start = $dtstart->format('Y-m-d H:i:s');
							$evenement->end = $dtend->format('Y-m-d H:i:s');
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
								// 'start' => $dtstart->add(120, 'minute')->format('Y-m-d H:i:s'),  
								// 'end' => $dtend->add(120, 'minute')->format('Y-m-d H:i:s'), 
								'start' => $dtstart->format('Y-m-d H:i:s'),  
								'end' => $dtend->format('Y-m-d H:i:s'),
								'backgroundColor' => '#f39c12',  
								'borderColor' => '#f39c12'		
						   ]);
							$agenda->save();
						}
					
					}
					
					  $cmp = array_diff($calcrmetier, $calgoogle);
					  
					  foreach($cmp as $c){
						  $evenementsup = Event::where('googleuid', '=', $c);
						  $evenementsup->delete();
						  // echo $c.'<br/>';
					  }
					
				} catch (\Exception $e) {
					die($e);
				}
			} 
		}
		
		$rdvs = Rdv::all();
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
						// $evenement->start = $dtstart->add(120, 'minute')->format('Y-m-d H:i:s');
						// $evenement->end = $dtend->add(120, 'minute')->format('Y-m-d H:i:s');
						$evenement->start = $dtstart->format('Y-m-d H:i:s');
						$evenement->end = $dtend->format('Y-m-d H:i:s');
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
							// 'start' => $dtstart->add(120, 'minute')->format('Y-m-d H:i:s'),  
							// 'end' => $dtend->add(120, 'minute')->format('Y-m-d H:i:s'),
							'start' => $dtstart->format('Y-m-d H:i:s'),  
							'end' => $dtend->format('Y-m-d H:i:s'),
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
		/***/
		
        $dataevent = Event::where('client_priv', '=', $staffs->prenom.' '.$staffs->nom)
					// ->where('qualification', '<>', 'Rendez-vous annulé')
					->get(); 
		
		return view('agendas.comresp_public', compact('dataevent'));
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
