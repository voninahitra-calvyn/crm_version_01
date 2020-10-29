<?php

namespace App\Http\Controllers;
use App\Day;
use App\Event;
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

class ClientController extends Controller
{
    private $datecalendar = [];

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
           'note' => $request->get('note'),
           'etat' => $request->get('etat')?$request->get('etat'):'Actif',
       ]);
	   
       $client->save();
        $clientEdit = Client::findOrFail($client->id);
        $datenow=\Carbon\Carbon::now()->format('Y-m-d_H-i-s');
        if($request->hasfile('logoClient')) {

            $path = "uploads/logo/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $logo = $request->file('logoClient');
            $nomLogo = $client->id . $datenow . '.' . $logo->getClientOriginalExtension();
            $logo->move($path, $path . $nomLogo);
            $clientEdit->logo = $nomLogo;
            $clientEdit->save();
        }
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

        $centre = Client::findOrFail($idencode);

        //Nom ancien audio
        $nom_logo = $request->hidden_logo;
        $nom_logo1 = $request->hidden_logo1;
        $datelogo=\Carbon\Carbon::now()->format('Y-m-d_H-i-s');
        // $dateaudio=date('Y-m-d_H-i-s');

        if($request->hasfile('logoInputfileclient')){
            $logo = $request->file('logoInputfileclient');
            $centre->note = $request->get('note');
            $centre->noteconfidentielle = $request->get('noteconfidentielle');
            $nom_logo = $idencode .$datelogo. '.' . $logo->getClientOriginalExtension();

            if (file_exists('uploads/logo/' . $nom_logo1)){
                if($nom_logo1<>'') unlink('uploads/logo/' . $nom_logo1);
            }
            $logo->move('uploads/logo/', '/uploads/logo/' . $nom_logo);
            $centre->logo = $nom_logo;
            $centre->save();
            return redirect('/clients/'.$idencode.'/edit')->with('successAutreInfo', 'Logo modifiée avec succès.');
        }

        $statut_user = auth()->user()->statut;
        if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
            $user = User::where('centreappel_id',$idencode)->update(['etat'=>$request->get('etat')]);
        }
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
        if ($statut_user == 'Administrateur' || $statut_user == 'Staff') {
            $client->etat = $request->get('etat');
        }
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
           'note' => $request->get('note'),
           'etat' => $request->get('etat')?$request->get('etat'):'Actif'
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
		$client = $compte->client_id;
        $cli = Client::findOrFail($client);
		$campagne = $cli->societe2;
		$index = 1;
        $logo = Client::find($client);
        return view('clients.compte.edit', compact('client','compte','campagne','index','logo'));
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
    
    
    public function plageHoraire($request){
        $plageHoraire = [
            "lundi"=>[],
            "mardi"=>[],
            "mercredi"=>[],
            "jeudi"=>[],
            "vendredi"=>[],
            "samedi"=>[],
            "dimanche"=>[],
        ];
        $start = $request->get('start');
        $end = $request->get('end');
        if(isset($start['lundi'])){
            $combine = array_combine($start['lundi'], $end['lundi']);

            foreach($combine as $key=>$val){
                $plageHoraire['lundi'][] = [$key,$val]; 
            } 
        }

        if(isset($start['mardi'])){
            $combine = array_combine($start['mardi'], $end['mardi']);
            foreach($combine as $key=>$val){
                $plageHoraire['mardi'][] = [$key,$val]; 
            } 
        }

        if(isset($start['mercredi'])){
            $combine = array_combine($start['mercredi'], $end['mercredi']);
            foreach($combine as $key=>$val){
                $plageHoraire['mercredi'][] = [$key,$val]; 
            } 
        }
        if(isset($start['jeudi'])){
            $combine = array_combine($start['jeudi'], $end['jeudi']);
            foreach($combine as $key=>$val){
                $plageHoraire['jeudi'][] = [$key,$val]; 
            } 
        }
        if(isset($start['vendredi'])){
            $combine = array_combine($start['vendredi'], $end['vendredi']);
            foreach($combine as $key=>$val){
                $plageHoraire['vendredi'][] = [$key,$val]; 
            } 
        }
        if(isset($start['samedi'])){
            $combine = array_combine($start['samedi'], $end['samedi']);
            foreach($combine as $key=>$val){
                $plageHoraire['samedi'][] = [$key,$val]; 
            } 
        }
        if(isset($start['dimanche'])){
            $combine = array_combine($start['dimanche'], $end['dimanche']);
            foreach($combine as $key=>$val){
                $plageHoraire['dimanche'][] = [$key,$val]; 
            } 
        }

        return $plageHoraire;
    }

    public function parseDayToDate(){
        $list=array();
        $month = 12;
        $year = 2020;
        for ($i=1; $i<=$month; $i++){

            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $i, $d, $year);
                if (date('m', $time)==$i)
                    $list[]=date('Y-m-d-D', $time);
            }
            echo "<pre>";
            print_r($list);
            echo "</pre>";
        }

        //$dayLabel = substr("2020-01-19-Sun",11);
    }

    public function updatecompte(Request $request, $idencode)
    {
		
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $id = $hashidsUser->decode($idencode)[0];
		
        // $user = User::find($idencode);
		// $hashidsClient = new Hashids('LSPlusaltClient', 7);
		// $idEncodeClient = $hashidsClient->encode($user->client_id);
	// 	dd($request->all());
        $compte = User::find($idencode);
        $compte->societe2 = $request->get('campagne');
        $compte->nom = $request->get('nom');
        $compte->prenom = $request->get('prenom');
        $compte->telephone = $request->get('telephone');
        $compte->email = $request->get('email');
        $compte->agendapriv = $request->get('agendapriv');
        $compte->agendaoutlook = $request->get('agendaoutlook');
        
		if (($request->get('password')<>'') OR ($request->get('password')<>null) ) {
			$compte->password = bcrypt($request->get('password'));
		}	
        $compte->statut = $request->get('statut');
        $compte->note = $request->get('note');
        if ($request->get('etat')) {
            $compte->etat = $request->get('etat');
        }

        $plageHoraire = $this->plageHoraire($request);
        $compte->plage_horaire = $plageHoraire;

        //parse agenda prive
        $perseAgendaPrive = Service::parseAgendaPrive($compte);
        $perseAgendaAdmin = [];

        $statut_user = auth()->user()->statut;
        if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
            $compte->agendaprivadmin = $request->get('agendaprivadmin');
            $perseAgendaAdmin = Service::parseAgendaAdmin($compte);
        }
        $hoursPlage = $compte->plage_horaire;
        $pAgPlg =  Service::parseAgendaPlage($hoursPlage);

        $this->datecalendar = array_merge($pAgPlg,$perseAgendaPrive,$perseAgendaAdmin);
        $compte->agendapub = $this->datecalendar;
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
