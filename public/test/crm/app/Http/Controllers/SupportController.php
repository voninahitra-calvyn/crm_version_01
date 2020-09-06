<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
// use App\Hashids\Hashids;
use Hashids\Hashids;

use App\Http\Controllers\Input;
// use App\Http\Controllers\Carbon\Carbon;
use Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

// use App\Mail\Contact;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\User;
use App\Support;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	//lien supportsadmin/requete
    public function requete()
    {
		
		$idencode ="5ed113a4d44c1404265c9132";
		$supports = Support::find($idencode);
			$supports->nomE = "Zeyen";	//Nom personne qui envoie le ticket
			$supports->prenomE = "Stéphane";	//Prénom personne qui envoie le ticket"repondu":"Oui","vu":"Oui",
			$supports->vu = "Oui";	//Vu par le staff
			$supports->repondu = "Oui";	//Repondu par le staff
			$supports->save(); 
			print_r("succès requête"); 
			
			/* 
			$supportsall = Support::all();
			print_r($supportsall); 
			*/
				
	}
	
    public function index()
    {
        $supportsall = Support::all();
        $supportsdistinct = Support:: orderBy('created_at', 'desc')->distinct('user_id')->select('repondu', 'vu', 'nomE', 'prenomE', 'statutE',  'nom', 'prenom', 'statut', 'message', 'created_at')
		->groupBy('user_id')->get();
        $supportscreatedistinct = Support:: orderBy('created_at', 'asc')->distinct('user_id')->select('nom', 'prenom', 'statut', 'message', 'created_at')
		->groupBy('user_id')->get();
        // $supportsdistinct = Support::distinct('user_id')
							// ->select('nom')->get();
        // $supportsdistinct = Support::orderBy('user_id', 'desc')
							// ->where('DISTINCT(user_id)')->get();
        // $supportsdistinct = Support::distinct('user_id')->select('nom', 'prenom')
									// ->get();
        $supports = Support::orderBy('user_id', 'desc')
					->get();
        // $supports = Support::where('support_id','=', null)
					// ->get();
       return view('supports.index', compact('supportsall','supports','supportsdistinct','supportscreatedistinct'));
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
		$statut_user = auth()->user()->statut;
		$id_staff = auth()->user()->_id;
		$nom_staff = auth()->user()->nom;
		$prenom_staff = auth()->user()->prenom;
		
        $request->validate([
          'message'=>'required'
		]);
		$id_client = $request->get('user_id');
		$support_id = $request->get('support_id');
		$staff = User::findOrFail($id_staff);
		$client = User::findOrFail($id_client);
		if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$support = new Support([
				// 'staff_id' => 1,        
				// 'staff_id' => $idStaff,        
				'user_id' => $request->get('user_id'),        
				'support_id' => $request->get('support_id'),        
				'nom' => $request->get('nom'),        
				'prenom' => $request->get('prenom'),    
				'statut' => $request->get('statut'),      
				'nomE' => $client->nom,       
				'prenomE' => $client->prenom,           
				'statutE' => $client->statut,        
				'message' => $request->get('message'),
				'repondu' => 'Oui',
				'vu' => 'Oui',
				// 'date_message' => $request->get('date_message') 
				'date_message' => \Carbon\Carbon::now()
			]);
		}else{
			$support = new Support([
				// 'staff_id' => 1,        
				// 'staff_id' => $idStaff,        
				'user_id' => $request->get('user_id'),        
				'support_id' => $request->get('support_id'),        
				'nom' => $request->get('nom'),        
				'prenom' => $request->get('prenom'),      
				'nomE' => $request->get('nom'),        
				'prenomE' => $request->get('prenom'),        
				'statut' => $request->get('statut'),        
				'statutE' => $request->get('statut'),        
				'message' => $request->get('message'),
				'repondu' => 'Non',
				'vu' => 'Non',
				// 'date_message' => $request->get('date_message') 
				'date_message' => \Carbon\Carbon::now()
			]);
		}
	   
		$support->save();
		
		// $email = 'heryaddams@yahoo.fr';
		// $email = 'contact@fidelbox.com';
		// $bccemail = 'heryaddams@gmail.com';
		$bccemail = 'contact@crmmetier.com';
		// $emailuser = $request->get('email');
		$email = $client->email;
		// $email = $client->nom;
		$contenu = $request->get('message');
		$staff2 = $request->get('nom').' '.$request->get('prenom');
		$client2 = $client->nom.' '.$client->prenom;
		$id_user = $client->_id;
		$statut_client = $client->statut;
	  
		if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
	  
			if ($statut_client == 'Responsable' || $statut_client == 'Commercial'){
				try{
					// Mail::queue('supports.mail_ResponsableCommercial', compact('staff','client','support_id'), function($message)use($email, $bccemail, $client2) {
					Mail::send('supports.mail_ResponsableCommercial', compact('staff','client','support_id'), function($message)use($email, $bccemail, $client2) {
						try { 
							$message->setTo($email); 
						} catch (\Swift_RfcComplianceException $e) { 
							return redirect('/supports')->with('error', 'impossible d\'envoyer l\'email, veuillez vérifier l\'email du destinataire ou contacter l\'administrateur.');
						}
						$message
							// ->from('contact@lacentraledurdv.com','La centrale du rendez-vous')
							->from('contact@crmmetier.com')
							// ->replyTo('contact@lacentraledurdv.com','La centrale du rendez-vous')
							// ->replyTo('contact@lacentraledurdv.com')
							// ->sender('contact@lacentraledurdv.com')
							->to($email, $client2)
							->bcc($bccemail)
							->subject('Une réponse à votre ticket vous attend');
					}); 
				}
				catch (Swift_TransportException $STe) {
					$string = date("Y-m-d H:i:s")  . ' - ' . $STe->getMessage() . PHP_EOL;
					$errorMsg = "the mail service has encountered a problem. Please retry later or contact the site admin.";
					 print_r($errorMsg);
				}
				catch(Exception $e){
					return redirect('/supports')->with('success', 'ticket enregistrée!');
				}
				catch(ErrorException $ee){
					return redirect('/supports')->with('success', 'ticket enregistrée!');
				}
			}elseif ($statut_client == 'Superviseur' || $statut_client == 'Agent'){
				try{
					Mail::send('supports.mail_SuperviseurAgent', compact('staff','client','support_id'), function($message)use($email, $bccemail, $client2) {
						$message
							->from('contact@crmmetier.com')
							// ->from('contact@crmmetier.com','CRM métier')
							// ->replyTo('contact@crmmetier.com','CRM métier')
							->to($email, $client2)
							->bcc($bccemail)
							->subject('Une réponse à votre ticket vous attend');
					});
				}
				catch (Swift_TransportException $STe) {
					$string = date("Y-m-d H:i:s")  . ' - ' . $STe->getMessage() . PHP_EOL;
					$errorMsg = "the mail service has encountered a problem. Please retry later or contact the site admin.";
					 print_r($errorMsg);
				}
				catch(Exception $e){
				}
			}			
		}
		
    	/*if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			try{
				Mail::send('supports.mail', compact('staff','client','support_id'), function($message)use($email, $client2, $contenu) {
					$message->to($email, $client2)->subject('Une réponse à votre ticket vous attend'.$contenu);
					$message->from('contact@lacentraledurdv.com','La centrale du rendez-vous');
				});  
			}
			catch (Swift_TransportException $STe) {
				$string = date("Y-m-d H:i:s")  . ' - ' . $STe->getMessage() . PHP_EOL;
				$errorMsg = "the mail service has encountered a problem. Please retry later or contact the site admin.";
				 print_r($errorMsg);
			}
			catch(Exception $e){
			}
		}*/
	   
		if ($request->get('support_id')==null){
			return redirect('/supports/'.$id_user)->with('success', 'ticket enregistrée!');
		}else{
			return redirect('/supports')->with('success', 'ticket enregistrée!');
		}
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idencode)
    {
        $user = User::findOrFail($idencode);
        $support = Support::where('user_id', '=', $idencode)
				// ->orWhere('statut', '=', 'Staff')
				->get();
       return view('supports.monticket', compact('support', 'user'));
    }
	
    public function repondreticket($user_id)
    {
        $suprt = Support::where('user_id', '=', $user_id)->get()->first();
        $supportupdt = Support::find($suprt->_id);
        $supportupdt->repondu = 'Oui';
        $supportupdt->vu = 'Oui';
        $supportupdt->save();
		
		$user = User::findOrFail($user_id);
        $support = Support::where('user_id', '=', $user_id)
				->get();
       return view('supports.repondreticket', compact('support', 'user')); 
    }
	
    public function edit($idencode)
    {
        $staff = User::findOrFail($idencode);
       return view('staffs.edit', compact('staff'));
    }
	
    public function update(Request $request, $idencode)
    {
    }
	
    public function destroy(Support $support)
    {
		$support->delete();
		return redirect('/supports')->with('success', 'Support supprimé!');
    }


}
