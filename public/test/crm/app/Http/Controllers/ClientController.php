<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
// use App\Hashids\Hashids;
use Hashids\Hashids;

use App\Http\Controllers\Input;
use Intervention\Image\Facades\Image;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Centreappel;
use App\Client;
use App\User;

use ICal\ICal;
use App\Event;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $staffs = User::all();
		$staffs = User::where('statut', '=', 'Administrateur')
				->orWhere('statut', '=', 'Staff')
				->get(); 
        $centreappels = Centreappel::all();
        $clients = Client::all();
        return view('clients.index', compact('staffs','centreappels','clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
          'societe'=>'required'
		]);

       $client = new Client([
           'societe' => $request->get('societe'),        
           'societe2' => $request->get('societe2'),        
           'adresse' => $request->get('adresse'),        
           'cp' => $request->get('cp'),
           'ville' => $request->get('ville'),        
           'pays' => $request->get('pays'),      
           'telephone' => $request->get('telephone'),        
           'email' => $request->get('email'),      
           'service' => $request->get('service'),      
           'note' => $request->get('note')      
       ]);
	   
       $client->save();
       return redirect('/clients')->with('success', 'Client enregistrée!');
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
		// $hashids = new Hashids('LSPlusaltClient', 7);
		// $id = $hashids->decode($idencode)[0];
        $client = Client::findOrFail($idencode);
       return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idencode)
    {
		// $hashids = new Hashids('LSPlusaltClient', 7);
		// $id = $hashids->decode($idencode)[0];

        $request->validate([
          'societe'=>'required'
        ]);
		
        $client = Client::find($idencode);;
        $client->societe2 = $request->get('societe2');
        $client->societe = $request->get('societe');
        $client->adresse = $request->get('adresse');
        $client->cp = $request->get('cp');
        $client->ville = $request->get('ville');
        $client->pays = $request->get('pays');
        $client->telephone = $request->get('telephone');
        $client->email = $request->get('email');
        $client->service = $request->get('service');
        $client->note = $request->get('note');
        $client->save();

        return redirect('/clients')->with('success', 'Client modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Supprimer client
        $client = Client::find($id);
		$client->delete();//client_id
		//Supprimer les comptes du client
        $compte = User::where('client_id','=',$id);
		$compte->delete();
		
       return redirect('/clients')->with('success', 'Client supprimée!');
    }

    public function compte(Request $request, $idencode)
    {
		// $hashids = new Hashids('LSPlusaltClient', 7);
		// $id = $hashids->decode($idencode)[0];
        $client = Client::findOrFail($idencode);
        // $comptes = User::all();
		
		$comptes = User::join('clients', 'clients.id', '=', 'users.client_id')
			// ->select('users.*', 'clients.societe')
			->where('client_id', '=', $idencode)
            ->get();
		return view('clients.compte.index', compact('client', 'comptes'));
    }
	
    public function createcompte(Request $request, $idclient)
    {
        $client = Client::findOrFail($idclient);
		$campagne = $client->societe2;
		
		$client = Client::where('_id', '=', $idclient)
            ->get();
			// $campagne = $client->societe2;
		return view('clients.compte.create', compact('idclient','client','campagne'));
    }
	
    public function storecompte(Request $request, $idEncodeClient)
    {
		// $hashidsClient = new Hashids('LSPlusaltClient', 7);
		// $idClient = $hashidsClient->decode($idEncodeClient)[0];
		
		
        $request->validate([
          'nom'=>'required'
		]);
		
       $compte = new User([
           'client_id' => $idEncodeClient,         
           'societe2' =>$request->get('campagne'),        
           // 'societe2' => $request->get('compte_id'),        
           'nom' => $request->get('nom'),        
           'prenom' => $request->get('prenom'),        
           'telephone' => $request->get('telephone'),
           'email' => $request->get('email'),      
			'password' => bcrypt($request->get('password')),   
           'statut' => $request->get('statut'),      
           'note' => $request->get('note')      
       ]);
	   
       $compte->save();
	   return redirect('/clients/'.$idEncodeClient.'/compte')->with('success', 'Compte enregistré!');
    }

    public function modifcompte($idencode)
    {
        // $cli = Client::findOrFail($idencode);
		// $campagne = $cli->societe2;
		// $campagne = 'jjjj';
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $hashidsClient = new Hashids('LSPlusaltClient', 7);
		// $id = $hashidsUser->decode($idencode)[0];
        $compte = User::findOrFail($idencode);
		// $client = $compte->client_id;
		$client = $compte->client_id;
        $cli = Client::findOrFail($client);
		$campagne = $cli->societe2;
		return view('clients.compte.edit', compact('client','compte','campagne'));
    }

    public function rendezvous($idencode)
    {
        // $centreappels = Centreappel::all();
        // $compte = $idencode;
        // $compte = Client::all();
        $compte = User::findOrFail($idencode);
		// $compte = User::leftjoin('clients', 'clients._id', '=', 'users.client_id')
			// ->select('users.*', 'clients.societe')
			// ->where('_id', '=', $idencode)
            // ->get();
			
		$client_id = $compte->client_id;
		$statut_user = auth()->user()->statut;
		if ($statut_user=='Superviseur' || $statut_user=='Agent'){
			$centreappels = Centreappel::findOrFail(auth()->user()->centreappel_id);
			$nomsocieteCentreappels = $centreappels->societe;
		}else{
			$nomsocieteCentreappels = 'Groupe Administration';
		}
		// $client = Client::all();	
		$client = Client::findOrFail($compte->client_id);
			// ->select('clients.*')
			// ->where('_id', '=', $compte->client_id)
            // ->get();
		$service = $client->service;
		// $client = $compte->client_id;
		// $typerdv = $compte->client_id;
		// return view('clients.compte.edit', compact('client','compte'));
		return view('rdvs.create', compact('client','compte','nomsocieteCentreappels'));
		// return view('rdvs.defiscalisation.create', compact('compte'));
    }
	
    public function updatecompte(Request $request, $idencode)
    {
		
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $id = $hashidsUser->decode($idencode)[0];
		
        // $user = User::find($idencode);
		// $hashidsClient = new Hashids('LSPlusaltClient', 7);
		// $idEncodeClient = $hashidsClient->encode($user->client_id);
		
        $compte = User::find($idencode);
        $compte->societe2 = $request->get('campagne');
        $compte->nom = $request->get('nom');
        $compte->prenom = $request->get('prenom');
        $compte->telephone = $request->get('telephone');
        $compte->email = $request->get('email');
        $compte->agendapriv = $request->get('agendapriv');
		if (($request->get('password')<>'') OR ($request->get('password')<>null) ) {
			$compte->password = bcrypt($request->get('password'));
		}	
        $compte->statut = $request->get('statut');
        $compte->note = $request->get('note');
        $compte->save();
 
		
		/************** AJOUT EVENNEMENT CALENDRIER ****************************/
/* 		
		try {
			// $adresse = $request->get('agendapriv');
			$adresse = $staffs->agendapriv;
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
					// $evenement->title = 'indisponible';
					$evenement->title = $event->summary;
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
						// 'title' => 'indisponible',  
						'title' => $event->summary,  
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
 */
        
		return redirect('/clients/'.$compte->client_id.'/compte')->with('success', 'Compte modifié!');
    }
	
	
    public function updatecompteL(Request $request, $idencode)
    {
		
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $id = $hashidsUser->decode($idencode)[0];
		
        // $user = User::find($idencode);
		// $hashidsClient = new Hashids('LSPlusaltClient', 7);
		// $idEncodeClient = $hashidsClient->encode($user->client_id);
		
        $compte = User::find($idencode);;
        $compte->societe2 = $request->get('campagne');
        $compte->nom = $request->get('nom');
        $compte->prenom = $request->get('prenom');
        $compte->telephone = $request->get('telephone');
        $compte->email = $request->get('email');
		if (($request->get('password')<>'') OR ($request->get('password')<>null) ) {
			$compte->password = bcrypt($request->get('password'));
		}	
        $compte->statut = $request->get('statut');
        $compte->note = $request->get('note');
        $compte->save();

        return redirect('/clients/'.$compte->client_id.'/compte')->with('success', 'Compte modifié!');
    }
	
    public function suppcompte($idUserEncode)
    {
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $id = $hashidsUser->decode($idUserEncode)[0];
        $compte = User::findOrFail($idUserEncode);
		$compte->delete();

		// $hashidsClient = new Hashids('LSPlusaltClient', 7);
		// $client = $hashidsClient->encode($compte->client_id);
		$client = $compte->client_id;
		return redirect('/clients/'.$client.'/compte')->with('success', 'Compte supprimé!');
    }


}
