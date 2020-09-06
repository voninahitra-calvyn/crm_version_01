<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
// use App\Hashids\Hashids;
use Hashids\Hashids;

use App\Http\Controllers\Input;
use Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Client;
use App\Centreappel;
use App\User;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class StaffController extends Controller
{
	
	protected $process;

	
    public function modifinfo3(Request $request, $idencode)
    {
		$today = today()->format('Y-m-d');
		if(!is_dir(storage_path('backup'))) mkdir(storage_path('backup'));
		$this->process = Spatie\DbDumper\Databases\MongoDb::create()
			->setDbName('bd_ohmycrm')
			->setUserName('')
			->setPassword('')
			->dumpToFile('dump.gz');
		$this->process->mustRun();
	}
			
    public function modifinfo2(Request $request, $idencode)
    {
		$today = today()->format('Y-m-d');
		if(!is_dir(storage_path('backup'))) mkdir(storage_path('backup'));
		$this->process = new Process(sprintf(
			/*
			'mongodump -h 127.0.0.1 --port 27017 -d -u%s -p%s %s >%s',
			// 'mysqldump --compact --skip-comments -u%s -p%s %s >%s',
			// 'mongodump -h 127.0.0.1 --port 27017 -d bd_ohmycrm',
			// 'mongodump -h 127.0.0.1 --port 3001 -d dump/meteor'
			// config('database.connections.mongo.username'),
			// config('database.connections.mongo.password'),
			// config('database.connections.mongo.database'),
			config(''),
			config(''),
			config('bd_ohmycrm'),
			storage_path("backup/{$today}.gz")
			*/
			'mongodump --db bd_ohmycrm'
		));
		$this->process->mustRun();
        // try{
			// $this->process->mustRun();
			// Log::info('Daily DB Backup - Success');	
		// } catch(ProcessFailedException $exception){
			// Log::error('Daily DB Backup - Failed', $exception);	
		// }
			return redirect('/staffs/'.$idencode)->with('successBackup', 'Backup effectué avec succès.');
	}
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
        return view('staffs.index', compact('staffs','centreappels','clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'nom'=>'required'
		]);

		$staff = new User([
			// 'staff_id' => 1,        
			// 'staff_id' => $idStaff,        
			'nom' => $request->get('nom'),        
			'prenom' => $request->get('prenom'),        
			'telephone' => $request->get('telephone'),
			'email' => $request->get('email'),        
			'password' => bcrypt($request->get('password')),        
			'statut' => $request->get('statut'),      
			'note' => $request->get('note')      
		]);
	   
	   $staff->save();
	   
	   // User::create($request->all());
	   
       
       return redirect('/staffs')->with('success', 'Staff enregistrée!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idencode)
    {
        $staff = User::findOrFail($idencode);
       return view('staffs.moncompte', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idencode)
    {
		// $hashids = new Hashids('LSPlusaltUser', 7);
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
    // public function update(Request $request, User $staff)
    public function update(Request $request, $idencode)
    {
		// $hashids = new Hashids('LSPlusaltUser', 7);
		// $id = $hashids->decode($idencode)[0];

        // $request->validate([
          // 'societe'=>'required'
        // ]);
		
        
		$staff = User::find($idencode);
        $staff->nom = $request->get('nom');
        $staff->prenom = $request->get('prenom');
        $staff->telephone = $request->get('telephone');
		if (($request->get('password')<>'') OR ($request->get('password')<>null) ) {
			$staff->password = bcrypt($request->get('password'));
		}	
		$staff->email = $request->get('email');
        $staff->statut = $request->get('statut');
        $staff->note = $request->get('note');
        $staff->save(); 
		
		
		// $staff->update($request->all());

        return redirect('/staffs')->with('success', 'Staff modifiée!');
    }
	
    public function modifmotdepasse(Request $request, $idencode)
    {
		// $idencode = $request->get('idcompte');
		$motdepasse = $request->get('motdepasse');
		$ancienmotdepasseinput = $request->get('ancienmotdepasse');
		$nouveau = $request->get('nouveaumotdepasse');
		$nouveaucrypt = bcrypt($request->get('nouveaumotdepasse'));
		
		// return redirect('/staffs/'.$idencode)->withErrors(['motdepasse: '.Encrypt($motdepasse).'motdepassecrypt: '.$motdepasse.' $ancien: '.$ancien.' $anciencrypt: '.$anciencrypt.' $nouveau: '.$nouveau.' $nouveaucrypt: '.$nouveaucrypt]);
		
		if (($ancienmotdepasseinput <> '') OR ($ancienmotdepasseinput<> null)){
			if (Hash::check($ancienmotdepasseinput, $motdepasse)){ 
				if (($nouveau<> '') OR ($nouveau<> null)){
					$staff = User::find($idencode);
					$staff->password = $nouveaucrypt;
					$staff->note = $request->get('note');
					$staff->save(); 
					return redirect('/staffs/'.$idencode)->with('success', 'Mot de passe modifié avec succès.');		
				}else{
					return redirect('/staffs/'.$idencode)->withErrors(['Veuillez renseigner le nouveau mot de passe SVP.']);
				}
			}else{
				return redirect('/staffs/'.$idencode)->withErrors(['Ancien mot de passe incorrecte.']);
			}
		}else{
			return redirect('/staffs/'.$idencode)->withErrors(['Veuillez renseigner l\'ancien mot de passe SVP.']);
		}
	}
	
    public function modifinfo(Request $request, $idencode)
    {
		$staff = User::findOrFail($idencode);
		
		//Nom ancien audio
		$nom_audio = $request->hidden_audio;
		$nom_audio1 = $request->hidden_audio1;
		$dateaudio=\Carbon\Carbon::now()->format('Y-m-d_H-i-s');
		//***** UPLOAD AUDIO
		if($request->hasfile('audioInputfile')){ 
			$audio = $request->file('audioInputfile');
			$staff->note = $request->get('note');
			$staff->noteconfidentielle = $request->get('noteconfidentielle');
			$nom_audio = $idencode .$dateaudio. '.' . $audio->getClientOriginalExtension();
			if (file_exists('uploads/audio/' . $nom_audio1)){
				if($nom_audio1<>'') unlink('uploads/audio/' . $nom_audio1);
			}	
			$audio->move('uploads/audio/', '/uploads/audio/' . $nom_audio);
			$staff->audio = $nom_audio; 	
			$staff->save();
			return redirect('/staffs/'.$idencode)->with('successAutreInfo', 'Audio modifiée avec succès.');
		}else{
			$staff->agendapriv = $request->get('agendapriv');
			$staff->note = $request->get('note');
			$staff->noteconfidentielle = $request->get('noteconfidentielle');
			if ($nom_audio=='') $staff->audio = ''; 
			$staff->save(); 
			return redirect('/staffs/'.$idencode)->with('successAutreInfo', 'Autre Infos modifiée avec succès.');
		}
	/* 	
		if($request->hasfile('audiosupagentInputfile')){
			// $staff->note = $request->get('note');
			// $staff->noteconfidentielle = $request->get('noteconfidentielle');
			$staff->note = 'ooo';
			$staff->noteconfidentielle = $nom_audio;
			$audio = $request->file('audiosupagentInputfile');
			$nom_audio = $idencode . '.' . $audio->getClientOriginalExtension();
			$audio->move('uploads/audio/', '/uploads/audio/' . $nom_audio);
			// Storage::make($audio)->save( public_path('/uploads/audio/' . $nom_audio) );
			$staff->audio = $nom_audio; 	
			$staff->save();
			return redirect('/staffs/'.$idencode)->with('successAutreInfo', 'Autre Infos et audio modifiée avec succès.');
		}else{
			// $staff->note = $request->get('note');
			$staff->note = $request->file('audiosupagentInputfile');
			$staff->noteconfidentielle = $request->get('noteconfidentielle');
			// $staff->audio = ''; 
			$staff->save(); 
			return redirect('/staffs/'.$idencode)->with('successAutreInfo', 'Autre Infos modifiée avec succès.');	
		}
	 */
}
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $staff)
    {
		$staff->delete();
		
        /* $staff = User::find($id);
		$staff->delete(); */

		return redirect('/staffs')->with('success', 'Staff supprimée!');
    }


}
