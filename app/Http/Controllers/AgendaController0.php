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

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $staffs = User::all();
		/* $staffs = User::where('statut', '=', 'Administrateur')
				->orWhere('statut', '=', 'Staff')
				->get(); 
        $centreappels = Centreappel::all();
        $clients = Client::all();
        return view('staffs.index', compact('staffs','centreappels','clients')); */
		$rdvs = Rdv::all();
		$test= 'hhhhhhh';
		$dateko= 'lll';
		$events = [];
        $data = Event::all();
        if($rdvs->count()) {
            foreach ($rdvs as $key => $value) {
                $events[] = Calendar::event(
                    $value->create_at,
                    true,
                    new \DateTime($value->create_at),
                    new \DateTime($value->create_at.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    'url' => 'pass here url and any route',
	                ]
                );
            }
        } 
        $calendar = Calendar::addEvents($events);
        // return view('fullcalender', compact('calendar'));
		return view('agendas.index', compact('rdvs','test','dateko','calendar','data'));
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

       /*$staff = new User([
           'staff_id' => 1,        
           // 'staff_id' => $idStaff,        
           'nom' => $request->get('nom'),        
           'prenom' => $request->get('prenom'),        
           'telephone' => $request->get('telephone'),
           'email' => $request->get('email'),        
           'statut' => $request->get('statut'),      
           'note' => $request->get('note')      
       ]);
	   
	   $staff->save();*/
	   
	   User::create($request->all());
	   
       
       return redirect('/staffs')->with('success', 'Staff enregistrée!');
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
    public function update(Request $request, User $staff)
    {
		// $hashids = new Hashids('LSPlusaltUser', 7);
		// $id = $hashids->decode($idencode)[0];

        // $request->validate([
          // 'societe'=>'required'
        // ]);
		
        /* $staff = User::find($idencode);
        $staff->nom = $request->get('nom');
        $staff->prenom = $request->get('prenom');
        $staff->telephone = $request->get('telephone');
        $staff->email = $request->get('email');
        $staff->statut = $request->get('statut');
        $staff->note = $request->get('note');
        $staff->save(); */
		
		$staff->update($request->all());

        return redirect('/staffs')->with('success', 'Staff modifiée!');
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
