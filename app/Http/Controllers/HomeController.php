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

use App\Home;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$home = Home::all();
        if($home->count()) {
			// $note1=1;
			// $note2=2;
			foreach ($home as $key => $value) {
				$_id=$value->_id;
				$note1=$value->note1;
				$note2=$value->note2;
			}
        }else{
			$_id=null;
			$note1=null;
			$note2=null;
		}	
		return view('home.index', compact('home','_id','note1','note2'));		
		/*
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
		*/
		// return view('home.index');
		// return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// return view('staffs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
          // 'nom'=>'required'
		// ]);

	   Home::create($request->all());
	   
       
       return redirect('/home')->with('success', 'Note enregistrée!');
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
        $home = Home::findOrFail($idencode);
       return view('home.edit', compact('home'));
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
        $note = Home::findOrFail($idencode);
        $note->note1 = $request->get('note1editor');
        $note->note2 = $request->get('note2editor');
        $note->save();
        return redirect('/home')->with('success', 'Home modifiée!');
    }
	
    public function modifhome(Request $request, $idencode)
    {
        $home = Home::findOrFail($idencode);
		return view('home.edit', compact('home'));
    }
	
    public function validermodifhome(Request $request, Home $home)
    {
        /*
		$note = Home::findOrFail($idencode);
		$note->update($request->all());
		
		$home = Home::all();
        if($home->count()) {
			// $note1=1;
			// $note2=2;
			foreach ($home as $key => $value) {
				$_id=$value->_id;
				$note1=$value->note1;
				$note2=$value->note2;
			}
        }else{
			$note1=null;
			$note2=null;
		}	
		return view('home.index', compact('home','_id','note1','note2'));	

        // return redirect('/home')->with('success', 'Home modifiée!');
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
		return redirect('/staffs')->with('success', 'Staff supprimée!');
    }


}
