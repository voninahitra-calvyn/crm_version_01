<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; //MongoDB
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
// use App\Hashids\Hashids;
use Hashids\Hashids;

use App\Http\Controllers\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use Illuminate\Http\Request;
use Calendar;
use App\Event;
use App\Rdv;

class EventController extends Controller
{
    public function index()
    {
			
		$rdvs = Rdv::all();
        $events = [];
        $data = Event::all();
        if($rdvs->count()) {
            // foreach ($data as $key => $value) {
            foreach ($rdvs as $key => $value) {
                $events[] = Calendar::event(
                    $value->create_at,
                    true,
                    new \DateTime($value->create_at),
                    new \DateTime($value->updated_at.' +1 day'),
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
        return view('agendas.fullcalender', compact('calendar','rdvs'));
    }
}