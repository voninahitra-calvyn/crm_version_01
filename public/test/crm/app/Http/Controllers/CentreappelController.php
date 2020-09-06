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

class CentreappelController extends Controller
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
        return view('centreappels.index', compact('staffs','centreappels','clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('centreappels.create');
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

       $centreappel = new Centreappel([
           'societe' => $request->get('societe'),        
           'adresse' => $request->get('adresse'),        
           'cp' => $request->get('cp'),
           'ville' => $request->get('ville'),        
           'pays' => $request->get('pays'),      
           'telephone' => $request->get('telephone'),        
           'email' => $request->get('email'),    
           'effectif' => $request->get('effectif'),      
           'horaireprod' => $request->get('horaireprod'),      
           'campagnefavorite' => $request->get('campagnefavorite'),      
           'email' => $request->get('email'),      
           'noteconfidentielle' => $request->get('noteconfidentielle')      
       ]);
	   
       $centreappel->save();
       return redirect('/centreappels')->with('success', 'Centreappel enregistrée!');
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
		// $hashids = new Hashids('LSPlusaltCentreappel', 7);
		// $id = $hashids->decode($idencode)[0];
        $centreappel = Centreappel::findOrFail($idencode);
       return view('centreappels.edit', compact('centreappel'));
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
		// $hashids = new Hashids('LSPlusaltCentreappel', 7);
		// $id = $hashids->decode($idencode)[0];

        $request->validate([
          'societe'=>'required'
        ]);
		
        $centreappel = Centreappel::find($idencode);;
        $centreappel->societe = $request->get('societe');
        $centreappel->adresse = $request->get('adresse');
        $centreappel->cp = $request->get('cp');
        $centreappel->ville = $request->get('ville');
        $centreappel->pays = $request->get('pays');
        $centreappel->telephone = $request->get('telephone');
        $centreappel->email = $request->get('email');
        $centreappel->effectif = $request->get('effectif');
        $centreappel->horaireprod = $request->get('horaireprod');
        $centreappel->campagnefavorite = $request->get('campagnefavorite');
        $centreappel->noteconfidentielle = $request->get('noteconfidentielle');
        $centreappel->note = $request->get('note');
        $centreappel->save();

        return redirect('/centreappels')->with('success', 'Centreappel modifiée!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Supprimer centre d'appel
        $centreappel = Centreappel::find($id);
		$centreappel->delete();
		//Supprimer les comptes du centre d'appel
        $compte = User::where('centreappel_id','=',$id);
		$compte->delete();

		return redirect('/centreappels')->with('success', 'Centreappel supprimée!');
    }
	
	
    public function compte(Request $request, $idencode)
    {
        $centreappel = Centreappel::find($idencode);
		 $comptes = User::leftjoin('centreappels', 'users.centreappel_id', '=', 'centreappels._id')
			->where('centreappel_id', '=', $idencode)
            ->get(); 
			
		return view('centreappels.compte.index', compact('centreappel', 'comptes'));
    }
	
    public function createcompte(Request $request, $idcentreappel)
    {
		return view('centreappels.compte.create', compact('idcentreappel'));
    }
	
    public function storecompte(Request $request, $idEncodeCentreappel)
    {
		// $hashidsCentreappel = new Hashids('LSPlusaltCentreappel', 7);
		// $idCentreappel = $hashidsCentreappel->decode($idEncodeCentreappel)[0];
		
		
        $request->validate([
          'nom'=>'required'
		]);

       $compte = new User([
           'centreappel_id' => $idEncodeCentreappel,        
           'nom' => $request->get('nom'),        
           'prenom' => $request->get('prenom'),        
           'telephone' => $request->get('telephone'),
           'email' => $request->get('email'),    
			'password' => bcrypt($request->get('password')), 
           'statut' => $request->get('statut'),      
           'note' => $request->get('note'),      
           'noteconfidentielle' => $request->get('noteconfidentielle')      
       ]);
	   
       $compte->save();
	   
		 
        $compteedit = User::findOrFail($compte->id);
		$dateaudio=\Carbon\Carbon::now()->format('Y-m-d_H-i-s');
		
		if($request->hasfile('audioInputfile')){ 
			$audio = $request->file('audioInputfile');
			$nom_audio = $compte->id .$dateaudio. '.' . $audio->getClientOriginalExtension();
			$audio->move('uploads/audio/', '/uploads/audio/' . $nom_audio);
			$compteedit->audio = $nom_audio; 	
			$compteedit->save();
		} 
		 
	   return redirect('/centreappels/'.$idEncodeCentreappel.'/compte')->with('success', 'Compte enregistré!');
    }

    public function modifcompte($idencode)
    {
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $hashidsCentreappel = new Hashids('LSPlusaltCentreappel', 7);
		// $id = $hashidsUser->decode($idencode)[0];
        $compte = User::findOrFail($idencode);
		// $centreappel = $hashidsCentreappel->encode($compte->centreappel_id);
		$centreappel = $compte->centreappel_id;
		return view('centreappels.compte.edit', compact('centreappel','compte'));
    }
	
    public function updatecompte(Request $request, $idencode)
    {
		$compte = User::findOrFail($idencode);
		
		//Nom ancien audio
		$nom_audio = $request->hidden_audio;
		$nom_audio1 = $request->hidden_audio1;
		$dateaudio=\Carbon\Carbon::now()->format('Y-m-d_H-i-s');
		// $dateaudio=date('Y-m-d_H-i-s');
		//***** UPLOAD AUDIO
		if($request->hasfile('audioInputfile')){ 
			$audio = $request->file('audioInputfile');
			$compte->note = $request->get('note');
			$compte->noteconfidentielle = $request->get('noteconfidentielle');
			$nom_audio = $idencode .$dateaudio. '.' . $audio->getClientOriginalExtension();
			if (file_exists('uploads/audio/' . $nom_audio1)){
				if($nom_audio1<>'') unlink('uploads/audio/' . $nom_audio1);
			}	
			$audio->move('uploads/audio/', '/uploads/audio/' . $nom_audio);
			$compte->audio = $nom_audio; 	
			$compte->save();
			return redirect('/centreappels/'.$idencode.'/modifcompte')->with('successAutreInfo', 'Audio modifiée avec succès.');
		}else{
			if ($nom_audio=='') {
				$compte->audio = ''; 
				$compte->save();
				return redirect('/centreappels/'.$idencode.'/modifcompte')->with('successAutreInfo', 'Audio supprimé avec succès.');
			}else{
				$compte->nom = $request->get('nom');
				$compte->nom = $request->get('nom');
				$compte->prenom = $request->get('prenom');
				$compte->telephone = $request->get('telephone');
				$compte->email = $request->get('email');
				if (($request->get('password')<>'') OR ($request->get('password')<>null) ) {
					$compte->password = bcrypt($request->get('password'));
				}	
				$compte->statut = $request->get('statut');
				$compte->note = $request->get('note');
				$compte->noteconfidentielle = $request->get('noteconfidentielle');
				$compte->save();

				return redirect('/centreappels/'.$compte->centreappel_id.'/compte')->with('success', 'Compte modifié!');
			}	
		}
    }
	
    public function suppcompte($idUserEncode)
    {
		// $hashidsUser = new Hashids('LSPlusaltUser', 7);
		// $id = $hashidsUser->decode($idUserEncode)[0];
        $compte = User::findOrFail($idUserEncode);
		$compte->delete();

		// $hashidsCentreappel = new Hashids('LSPlusaltCentreappel', 7);
		// $centreappel = $hashidsCentreappel->encode($compte->centreappel_id);
		return redirect('/centreappels/'.$compte->centreappel_id.'/compte')->with('success', 'Compte supprimé!');
    }

}
