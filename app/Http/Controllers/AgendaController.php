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
use Microsoft\Graph\Graph;
use Spatie\CalendarLinks\Link;

class AgendaController extends Controller
{


    private $datecalendar = [];
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

    /**
     * displayig agenda privé
     * @param $idClient
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAgendaByClient($idClient){
        $client = User::find($idClient);
        $clientId = $idClient;
        $userConnected = auth()->user();
        $perseAgendaPub = [];
        //parse agenda prive
        $perseAgendaPrive = Service::parseAgendaPrive($client);
        if ($userConnected->statut <> 'Responsable' && $userConnected->statut <> 'Commercial'){
            $perseAgendaPub = Service::parseAgendaAdmin($client);
        }
        $event = Event::where('client_priv','=',$client->prenom.' '.$client->nom)->get();
        $parseEvent = Service::parseEventToArray($event);
        $hoursPlage = $client->plage_horaire;
        $pAgPlg =  Service::parseAgendaPlage($hoursPlage);
        $this->datecalendar = array_merge($pAgPlg,$perseAgendaPrive,$perseAgendaPub);
        //update agenda publique
        $client->agendapub = $this->datecalendar;
        $client->save();
        $this->datecalendar = array_merge($parseEvent,$this->datecalendar);
        $calendarclient = $this->datecalendar;

        $comptesclient = User::where('statut', '=', 'Responsable')
            ->orWhere('statut', '=', 'Commercial')
            ->get();
        if ($userConnected->statut == 'Responsable' || $userConnected->statut == 'Commercial'){
            $comptesclient = User::find($userConnected->_id);
        }
        return view('agendas.index', compact('clientId','calendarclient','comptesclient', 'client'));
    }


    public function index()
    {
        $userConnected= auth()->user();
        if ($userConnected->statut == 'Responsable' || $userConnected->statut == 'Commercial'){
            return redirect()->route("agendas.get_agenda_client",['id'=>$userConnected->_id]);
        }
        $rdvs = Rdv::all();
		$datacalendrier = [];
        $dataevent = Event::all();
        if($rdvs->count()) {
            foreach ($rdvs as $key => $value) {
			$dateagenda = \Carbon\Carbon::parse($value->date_rendezvous->format('yy-m-d').' '.$value->heure_rendezvous);
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
				// $datacalendrier[] = array('title' => $value->societe, 'url' => 'pass here url and any route');
				$datacalendrier[] = array('title' => $value->nom.' '.$value->prenom.' '.$value->societe.' '.$value->nom_personne_rendezvous.'<br/>'.$value->adresse.' '.$value->cp.' '.$value->ville, 'start' => $dateagenda, 'end' => $dateagenda, 'backgroundColor' => $value->couleur_rdv, 'borderColor' => $value->couleur_rdv);
            }
        } ;
		$comptesclient = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
			// ->orWhere('statut', '=', 'Agent')
			// ->orWhere('statut', '=', 'Superviseur')
			// ->orWhere('statut', '=', 'Administrateur')
			// ->orWhere('statut', '=', 'Staff')
            ->get();
		// return view('agendas.index', compact('googlelink','yahoolink','webOutlooklink','icslink','rdvs','dataevent','dateko','calendar','datacalendrier','comptesclient'));
		return view('agendas.index', compact('dataevent','datacalendrier','comptesclient'));
    }


    public function comresp_public($id)
    {
        $client = User::find($id);
        $clientId = $id;
        $userConnected = auth()->user();
        $perseAgendaPub = [];
        //parse agenda prive
        $perseAgendaPrive = Service::parseAgendaPrive($client);
        $perseAgendaPub = Service::parseAgendaAdmin($client);

        $event = Event::where('client_priv','=',$client->prenom.' '.$client->nom)->get();
        $parseEvent = Service::parseEventToArray($event);
        $hoursPlage = $client->plage_horaire;
        $pAgPlg =  Service::parseAgendaPlage($hoursPlage);
        $this->datecalendar = array_merge($pAgPlg,$perseAgendaPrive,$perseAgendaPub,$parseEvent);
        $staffs = User::findOrFail($id);
		/************** AJOUT EVENNEMENT CALENDRIER ****************************/
		$dataeventclient = $this->datecalendar;
		$agendaPub = true;
		return view('agendas.comresp_public', compact('dataeventclient','agendaPub', 'staffs'));
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
