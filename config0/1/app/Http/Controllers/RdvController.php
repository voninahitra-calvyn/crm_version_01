<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use PDF;
// use App\Hashids\Hashids;
// use Hashids\Hashids;

use App\Http\Controllers\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; //MongoDB
use Illuminate\Support\Facades\Mail;

use App\Mail\Contact;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Centreappel;
use App\Client;
use App\Rdv;
use App\Event;
use App\User;
use App\Exports\RdvsExport;

// use App\Imports\RdvsImport;

use Maatwebsite\Excel\Facades\Excel;

class RdvController extends Controller
{
	//lien rendez-vous/requete
    public function requete()
    {
		/* $idencode ="5ea45762413b000079006e8b";
		$rdv = Rdv::find($idencode);
			$rdv->user_id = "5ea4571b413b000079006e8a";	//id Responsable/agent
			$rdv->responsableagent = "MOMOjj Cocokk";	//nom et penom Responsable/agent
			$rdv->user_nom = "nom99";	//nom Responsable/agent
			$rdv->user_prenom = "prenom99";	//penom Responsable/agent
			// $rdv->compte_id = "5ea4571b413b000079006e8a";	
			// $rdv->client_nompriv = "RESPONSABLE5444444";	
			// $rdv->client_prenompriv = "Résponsable44444";	
			// $rdv->cli = "RESPONSABLE44444 (Soci\u00e9t\u00e9 publiques Cli4444)";	
			$rdv->save(); 
			print_r("succès requête");
				
		// return view('rdvs.ajoutrdv', compact('comptes')); */
		/* ATRIBUER RDV
		$idencode ="5ea47ed6413b000079006e8c"; //id rdv
		$rdv = Rdv::find($idencode);
			$rdv->compte_id = "5ea4571b413b000079006e8a"; //id compte client	
			$rdv->client_nompriv = "COMMECIALE";  //nom compte client
			$rdv->client_prenompriv = "Commerciale"; //prenom compte client	
			$rdv->cli = "COMMECIALE (Société publiques Cli)";//nom compte client(Société publique client)
			$rdv->save(); 
			print_r("succès requête");
		*/	
    }
	
    public function index()
    {
		$comptes = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
            ->get();
				
		return view('rdvs.ajoutrdv', compact('comptes'));
    }
	
    public function choisirclient()
    {

		$comptes = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
            ->get();
			
		$client = Client::where('_id', '=', '5e510cc49b35a7c1eb875ed6')
            ->get();
			
		return view('rdvs.ajoutrdv', compact('client','comptes'));
    }
	
    public function client($idencode)
    {
		$statutrdv = 'Rendez-vous brut';
        return view('rdvs.client.index', compact('rendezvous'));  
    }
	
    public function tout()
    {
		$typerdv="tout";
		$statutrdv = '';	
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
				->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
				// ->where('statut', '<>', 'Rendez-vous brut')
				// ->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
				// ->where('statut', '<>', 'Rendez-vous brut')
				// ->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::all();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
		
	
    public function brut() 
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous brut';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->where('typerdv', '=', 'Autres')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->where('typerdv', '=', 'Autres')
				->get();
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
		
    public function relance()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous relancer';	
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
		
		
    public function refuse()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous refusé';	
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
			
    public function envoye()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous envoyé';	
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
			
    public function confirme()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous confirmé';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
				
    public function annule()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous annulé';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
						
    public function enattente()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous en attente';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
							
    public function valide()
    {
		$typerdv="";
		$statutrdv = 'Rendez-vous validé';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
							
    public function appelsbrut()
    {
		$typerdv="";
		$statutrdv = 'Réception d’appels brut';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
				
    public function appelsenvoye()
    {
		$typerdv="";
		$statutrdv = 'Réception d’appels envoyé';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
				
    public function devisbrut()
    {
		$typerdv="";
		$statutrdv = 'Demande de devis brut';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
				
    public function devisenvoye()
    {
		$typerdv="";
		$statutrdv = 'Demande de devis envoyé';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', $statutrdv)
				->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('statut', '=', $statutrdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('statut', '=', $statutrdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}

    public function createrdvdefiscalisation()
    {
		return view('rdvs.defiscalisation.create');
	}
						
    public function defiscalisation()
    {
		$statutrdv = '';
		$typerdv = 'Défiscalisation';	
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
						
    public function nettoyagepro()
    {
		$statutrdv = '';
		$typerdv = 'Nettoyage pro';		
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
						
    public function assurancepro()
    {
		$statutrdv = '';
		$typerdv = 'Assurance pro';	
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
						
    public function mutuellesantesenior()
    {
		$statutrdv = '';
		$typerdv = 'Mutuelle santé sénior';	
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
						
    public function autre()
    {
		$statutrdv = '';
		$typerdv = 'Autres';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}

						
    public function appels()
    {
		$statutrdv = '';
		$typerdv = 'Réception d\'appels';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}
						
    public function devis()
    {
		$statutrdv = '';
		$typerdv = 'Demande de devis';
		// $rendezvous = Rdv::all();
		// $test = Auth::user('statut');
		// $test = Auth::id();
		$statut_user = auth()->user()->statut;
		$id_user = auth()->user()->_id;
		$id_centreappel = auth()->user()->centreappel_id;
		$id_client = auth()->user()->client_id;
		if ($statut_user == 'Superviseur'){
			$rendezvous = Rdv::where('id_groupe', '=', $id_centreappel)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('id_groupe', '=', $id_centreappel)
				->get();
			$rdvsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('id_groupe', '=', $id_centreappel)
				->where('typerdv', '=', 'Demande de devis')
				->get(); 
		}else if ($statut_user == 'Agent'){
			$rendezvous = Rdv::where('user_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::where('user_id', '=', $id_user)
				->get();
			$rdvsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('user_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->get();
				
			 $appels = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('user_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->get();
		}else if ($statut_user == 'Responsable'){
			$rendezvous = Rdv::where('client_id', '=', $id_client)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('client_id', '=', $id_client)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('client_id', '=', $id_client)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
		}else if ($statut_user == 'Commercial'){
			$rendezvous = Rdv::where('compte_id', '=', $id_user)
					->where('typerdv', '=', $typerdv)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
					->get();
			$rendezvoustout = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->orWhere('statut', '<>', 'Rendez-vous relancer')
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels brut')
				->get();
			$appelsenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Réception d\’appels envoyé')
				->get();
			$devisbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Défiscalisation')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Nettoyage pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsassurancepro = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Assurance pro')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Mutuelle santé sénior')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $rdvsautre = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Autres')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get();
				
			 $appels = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Réception d\'appels')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
				
			 $devis = Rdv::where('compte_id', '=', $id_user)
				->where('typerdv', '=', 'Demande de devis')
				->where('statut', '<>', 'Rendez-vous brut')
				->orWhere('statut', '<>', 'Rendez-vous refusé')
				->get(); 
		}else if ($statut_user == 'Administrateur' || $statut_user == 'Staff'){
			$rendezvous = Rdv::where('typerdv', '=', $typerdv)
					->get();
			$rendezvoustout = Rdv::all();
			$rdvsbrut = Rdv::where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('statut', '=', 'Rendez-vous refusé')
				->get();
			$rdvsrelancer = Rdv::where('statut', '=', 'Rendez-vous relancer')
				->get();
			$rdvsenvoye = Rdv::where('statut', '=', 'Rendez-vous envoyé')
				->get();
			$rdvsconfirme = Rdv::where('statut', '=', 'Rendez-vous confirmé')
				->get();
			$rdvsannule = Rdv::where('statut', '=', 'Rendez-vous annulé')
				->get();
			$rdvsenattente = Rdv::where('statut', '=', 'Rendez-vous en attente')
				->get();
			$rdvsvalide = Rdv::where('statut', '=', 'Rendez-vous validé')
				->get();
			$appelsbrut = Rdv::where('statut', '=', 'Réception d’appels brut')
				->get();
			$appelsenvoye = Rdv::where('statut', '=', 'Réception d’appels envoyé')
				->get();
			$devisbrut = Rdv::where('statut', '=', 'Demande de devis brut')
				->get();
			$devisenvoye = Rdv::where('statut', '=', 'Demande de devis envoyé')
				->get();
			$rdvsdefiscalisation = Rdv::where('typerdv', '=', 'Défiscalisation')
				->get();
				
			 $rdvsnettoyagepro = Rdv::where('typerdv', '=', 'Nettoyage pro')
				->get();
				
			 $rdvsassurancepro = Rdv::where('typerdv', '=', 'Assurance pro')
				->get();
				
			 $rdvsmutuellesantesenior = Rdv::where('typerdv', '=', 'Mutuelle santé sénior')
				->get();
				
			 $rdvsautre = Rdv::where('typerdv', '=', 'Autres')
				->get(); 
				
			 $appels = Rdv::where('typerdv', '=', 'Réception d\'appels')
				->get(); 
				
			 $devis = Rdv::where('typerdv', '=', 'Demande de devis')
				->get(); 
		}
		// Auth::user()->statut == 'Superviseur'
		
        // return view('rdvs.defiscalisation.index', compact('rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre'));  
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsrelancer','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
	}

    public function mail()
    {
		return view('rdvs.mail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $centreappels = Centreappel::all();
		// return view('rdvs.create', compact('centreappels'));
		return view('rdvs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storerdv(Request $request)
    {
        $request->validate([
          // 'nom'=>'required'
		]);
		
		$statut_user = auth()->user()->statut;
		if ($statut_user<>'Superviseur' && $statut_user<>'Agent'){
			if ($statut_user<>'Responsable' && $statut_user<>'Commercial'){
				$id_groupe = null;
			}else{
				$id_groupe = auth()->user()->client_id;
			}
		}else{
			$id_groupe = auth()->user()->centreappel_id;
		}
		$typerdv = $request->get('typerdv');
		if ($typerdv=="Réception d'appels"){
			$statut="Réception d’appels brut";
		}elseif ($typerdv=='Demande de devis'){
			$statut='Demande de devis brut';
		}else{
			$statut='Rendez-vous brut';
		}


	   // Rdv::create($request->all());
       $rdv = new Rdv([
			'statut' => $statut,  
			'id_groupe' => $id_groupe,  
			'client_nompriv' => $request->get('client_nompriv'),  
			'client_prenompriv' => $request->get('client_prenompriv'),  
			'cli' => $request->get('cli'),  
			'client_id' => $request->get('client_id'),  
			'centreappel_societe' => $request->get('centreappel_societe'),  
			'responsableagent' => $request->get('responsableagent'),  
			'client_societe' => $request->get('client_societe'),  
			'compte_id' => $request->get('compte_id'),  
			'user_statut' => $request->get('user_statut'),  
			'user_id' => $request->get('user_id'),  
			'user_nom' => $request->get('user_nom'),  
			'user_prenom' => $request->get('user_prenom'),  
			'typerdv' => $typerdv,  
			'nom' => $request->get('nom'),  
			'prenom' => $request->get('prenom'),  
			'adresse' => $request->get('adresse'),  
			'cp' => $request->get('cp'),  
			'ville' => $request->get('ville'),  
			'telephone' => $request->get('telephone'),  
			'mobile' => $request->get('mobile'),  
			'email' => $request->get('email'),  
			'activitesociete' => $request->get('activitesociete'),  
			'age' => $request->get('age'),  
			'profession' => $request->get('profession'),  
			'proprietaireoulocataire' => $request->get('proprietaireoulocataire'),  
			'protectionsociale' => $request->get('protectionsociale'),  
			'mutuellesante' => $request->get('mutuellesante'),  
			'montant_impots_annuel' => $request->get('montant_impots_annuel'),  
			'taux_endettement' => $request->get('taux_endettement'),  
			'statut_matrimonial' => $request->get('statut_matrimonial'),  
			'composition_foyer' => $request->get('composition_foyer'), 
			'nomprenomcontact' => $request->get('nomprenomcontact'),  
			'date_rendezvous' => $request->get('date_rendezvous'),  
			'heure_rendezvous' => $request->get('heure_rendezvous'),  
			'note' => $request->get('note'), 
			'notestaff' => $request->get('notestaff'), 
			'societe' => $request->get('societe'),  
			'surface_total_societe' => $request->get('surface_total_societe'),  
			'surface_bureau' => $request->get('surface_bureau'),  
			'sous_contrat' => $request->get('sous_contrat'),  
			'date_anniversaire_contrat' => $request->get('date_anniversaire_contrat'), 
			'nom_personne_rendezvous' => $request->get('nom_personne_rendezvous'),  
			'mutuelle_entreprise' => $request->get('mutuelle_entreprise'),  
			'nom_mutuelle' => $request->get('nom_mutuelle'),  
			'montant_mutuelle_actuelle' => $request->get('montant_mutuelle_actuelle'),  
			'seul_sur_contrat' => $request->get('seul_sur_contrat'), 
			'question_1' => $request->get('question_1'),  
			'question_2' => $request->get('question_2'),  
			'question_3' => $request->get('question_3'),  
			'question_4' => $request->get('question_4'),  
			'question_5' => $request->get('question_5')			
       ]);
	   
       $rdv->save();
	   
       
       return redirect('/rendez-vous/tout')->with('success', 'Rdv enregistrée!');
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


    public function contester($idencode)
    {
		// $hashids = new Hashids('LSPlusaltUser', 7);
		// $id = $hashids->decode($idencode)[0];
        $rdv = Rdv::findOrFail($idencode);
        $client = Client::findOrFail($rdv->client_id);
		// $compte = $rdv->client_id; //5e510d119b35a7c1eb875ed8
		// $compte = $client->_id; //5e510d119b35a7c1eb875ed8
		$compte = User::where('client_id', '=', $client->_id)
            ->get();
		// $client = $compte->client_id;
       return view('rdvs.contestation', compact('rdv','client','compte'));
    }
	
    public function contestation(Request $request, $idencode)
    {
        $rdv = Rdv::find($idencode);
		$rdv->statut = 'Rendez-vous en attente';  
		$rdv->note = $request->get('note');
        $rdv->save(); 
		
		/*
		Mail::send('rdvs.mail', compact('rdv','client'), function($message) {
			$message->to('heryaddams@yahoo.fr', 'RAZAFIMAHEFA Heriniaina')->subject('Rendez-vous '.$request->get('cli').' contesté');
			$message->from('ohmycrmadmn@gmail.com','La centrale du rendez-vous');
		}); */
			
        return redirect('/rendez-vous/'.$request->get('compte_id').'/client')->with('success', 'Rdv contesté!');
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
        $rdv = Rdv::findOrFail($idencode);
        $client = Client::findOrFail($rdv->client_id);
        $clientComResp = User::findOrFail($rdv->compte_id);
		// $compte = $rdv->client_id; //5e510d119b35a7c1eb875ed8
		// $compte = $client->_id; //5e510d119b35a7c1eb875ed8
		$compte = User::where('client_id', '=', $client->_id)
            ->get();
		// $client = $compte->client_id;
		$statut_user = auth()->user()->statut;
		if ($statut_user=='Superviseur' || $statut_user=='Agent'){
			$centreappels = Centreappel::findOrFail(auth()->user()->centreappel_id);
			$nomsocieteCentreappels = $centreappels->societe;
		}else{
			$nomsocieteCentreappels = 'Groupe Administration';
		}
       return view('rdvs.edit', compact('rdv','client','clientComResp','compte','nomsocieteCentreappels'));
    }
	
    public function details($idencode)
    {
		// $hashids = new Hashids('LSPlusaltUser', 7);
		// $id = $hashids->decode($idencode)[0];
        $rdv = Rdv::findOrFail($idencode);
        $client = Client::findOrFail($rdv->client_id);
		// $compte = $rdv->client_id; //5e510d119b35a7c1eb875ed8
		// $compte = $client->_id; //5e510d119b35a7c1eb875ed8
		$compte = User::where('client_id', '=', $client->_id)
            ->get();
		// $client = $compte->client_id;
       return view('rdvs.client.details', compact('rdv','client','compte'));
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
		$isAudio=$request->get('is_audio');
		// $Audio=$request->get('hidden_audio');
		if($isAudio=='Oui'){
			$rdv = Rdv::findOrFail($idencode);
			
			//Nom ancien audio
			$nom_audio = $request->hidden_audio;
			//***** UPLOAD AUDIO
    		if($request->hasfile('audioInputfile')){
    			$audio = $request->file('audioInputfile');
    			$nom_audio = $idencode . '.' . $audio->getClientOriginalExtension();
				$audio->move('uploads/audio/', '/uploads/audio/' . $nom_audio);
				// Storage::make($audio)->save( public_path('/uploads/audio/' . $nom_audio) );
				$rdv->audio = $nom_audio; 	
				$rdv->save();
			}else{
				$rdv->audio = ''; 	
				$rdv->save();
				// Storage::delete(public_path('/uploads/audio/' . $nom_audio));
			}
			return redirect('/rendez-vous/tout')->with('success', 'Rdv modifiée!');
		}
		else{
			// $hashids = new Hashids('LSPlusaltUser', 7);
			// $id = $hashids->decode($idencode)[0];

			// $request->validate([
			  // 'societe'=>'required'
			// ]);
			
	/* 		$statut_user = auth()->user()->statut;
			if ($statut_user<>'Superviseur' && $statut_user<>'Agent'){
				if ($statut_user<>'Responsable' && $statut_user<>'Commercial'){
					$id_groupe = null;
				}else{
					$id_groupe = auth()->user()->client_id;
				}
			}else{
				$id_groupe = auth()->user()->centreappel_id;
			}  */
			
			$statut_user = auth()->user()->statut;
			$rdv = Rdv::find($idencode);
			$client = Client::findOrFail($rdv->client_id);
			// $compte = User::findOrFail($rdv->compte_id);
			//*********** A COMMENTER APRES MODIF***************
			$rdv->client_nompriv = $request->get('client_nompriv');
			$rdv->client_prenompriv = $request->get('client_prenompriv');
			// $rdv->user_nom = $request->get('user_nom');  //cocomodif
			// $rdv->user_prenom = $request->get('user_prenom');  //cocomodif
			// $rdv->statut = 'Rendez-vous brut';  
			// $rdv->id_groupe = $id_groupe; 
			// $rdv->id_groupe = $id_centreappel; 
			$rdv->client_societe = $request->get('client_societe'); 
			// $rdv->centreappel_societe = $request->get('centreappel_societe');  //cocomodif
			$rdv->responsableagent = $request->get('responsableagent'); 
			// $rdv->client_id = $request->get('client_id'); 
			// $rdv->typerdv = $request->get('typerdv');
			if ($statut_user<>'Superviseur' && $statut_user<>'Agent'){
				$rdv->statut = $request->get('statut'); 
			}  
			
			$couleur_rdv = '#fff'; 
			if ($request->get('statut')=='Rendez-vous envoyé'){
				$couleur_rdv = '#999'; 
			}elseif ($request->get('statut')=='Rendez-vous confirmé'){
				$couleur_rdv = '#00a65a'; 
			}elseif ($request->get('statut')=='Rendez-vous annulé'){
				$couleur_rdv = '#dd4b39';	
			}elseif ($request->get('statut')=='Rendez-vous en attente'){
				$couleur_rdv = '#3c8dbc';	
			}elseif ($request->get('statut')=='Rendez-vous validé'){
				$couleur_rdv = '#063';	
			}

			
			
			$rdv->nom = $request->get('nom'); 
			$rdv->prenom = $request->get('prenom'); 
			$rdv->adresse = $request->get('adresse'); 
			$rdv->cp = $request->get('cp'); 
			$rdv->ville = $request->get('ville'); 
			$rdv->telephone = $request->get('telephone'); 
			$rdv->mobile = $request->get('mobile'); 
			$rdv->email = $request->get('email'); 
			$rdv->activitesociete = $request->get('activitesociete'); 
			$rdv->age = $request->get('age'); 
			$rdv->profession = $request->get('profession'); 
			$rdv->proprietaireoulocataire = $request->get('proprietaireoulocataire'); 
			$rdv->protectionsociale = $request->get('protectionsociale'); 
			$rdv->mutuellesante = $request->get('mutuellesante'); 
			$rdv->montant_impots_annuel = $request->get('montant_impots_annuel'); 
			$rdv->taux_endettement = $request->get('taux_endettement'); 
			$rdv->statut_matrimonial = $request->get('statut_matrimonial'); 
			$rdv->composition_foyer = $request->get('composition_foyer');
			$rdv->nomprenomcontact = $request->get('nomprenomcontact');
			$rdv->date_rendezvous = $request->get('date_rendezvousedit'); 
			$rdv->heure_rendezvous = $request->get('heure_rendezvousedit'); 
			$rdv->note = $request->get('note');
			$rdv->noteconfidentielle = $request->get('noteconfidentielle');
			$rdv->notestaff = $request->get('notestaff');
			$rdv->societe = $request->get('societe'); 
			$rdv->surface_total_societe = $request->get('surface_total_societe'); 
			$rdv->surface_bureau = $request->get('surface_bureau'); 
			$rdv->sous_contrat = $request->get('sous_contrat'); 
			$rdv->date_anniversaire_contrat = $request->get('date_anniversaire_contrat');
			$rdv->nom_personne_rendezvous = $request->get('nom_personne_rendezvous'); 
			$rdv->mutuelle_entreprise = $request->get('mutuelle_entreprise'); 
			$rdv->nom_mutuelle = $request->get('nom_mutuelle'); 
			$rdv->montant_mutuelle_actuelle = $request->get('montant_mutuelle_actuelle'); 
			$rdv->seul_sur_contrat = $request->get('seul_sur_contrat');
			$rdv->question_1 = $request->get('question_1'); 
			$rdv->question_2 = $request->get('question_2'); 
			$rdv->question_3 = $request->get('question_3'); 
			$rdv->question_4 = $request->get('question_4'); 
			$rdv->question_5 = $request->get('question_5');	
			$rdv->couleur_rdv = $couleur_rdv;	
			$rdv->save(); 
			
			// $rdv->update($request->all());
			
			//**** ENVOIE MAIL **************************
			/* 
			Mail::to('heryaddams@yahoo.fr')
				->send(new Contact($request->except('_token')));
			*/

		  // $data = array('societe'=>"Virat Gandhi");
		  // $data = array('societe'=>$request->get('societe'),'client'=>$request->get('prenom')+" "+$request->get('nom'));
		  // $email = 'heryaddams@yahoo.fr';
		  $email = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('email'))));
		  $client2 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'))));
		  $client_priv = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('client_prenompriv').' '.$request->get('client_nompriv'))));
		  $adresse2 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('adresse').' '.$request->get('cp').' '.$request->get('ville'))));
		  $typerdvA = $request->get('typerdv');
		  $centreappel_societeA = $request->get('centreappel_societe');
		  $responsableagentA = $request->get('responsableagent');
		  $statutA = $request->get('statut');
		  $nomA = $request->get('nom');
		  $prenomA = $request->get('prenom');
		  $societeA = $request->get('societe');
		  $clientA = $request->get('cli');
		  $telephoneA = $request->get('telephone');
		  $mobileA = $request->get('mobile');
		  $emailA = $request->get('email');
		  $activitesocieteA = $request->get('activitesociete');
		  $question_1A = $request->get('question_1');
		  $question_2A = $request->get('question_2');
		  $question_3A = $request->get('question_3');
		  $question_4A = $request->get('question_4');
		  $question_5A = $request->get('question_5');
		  $surface_total_societeA = $request->get('surface_total_societe');
		  $surface_bureauA = $request->get('surface_bureau');
		  $sous_contratA = $request->get('sous_contrat');
		  $date_anniversaire_contratA = $request->get('date_anniversaire_contrat');
		  $protectionsocialeA = $request->get('protectionsociale');
		  $mutuellesanteA = $request->get('mutuellesante');
		  $mutuelle_entrepriseA = $request->get('mutuelle_entreprise');
		  $nom_mutuelleA = $request->get('nom_mutuelle');
		  $montant_mutuelle_actuelleA = $request->get('montant_mutuelle_actuelle');
		  $seul_sur_contratA = $request->get('seul_sur_contrat');
		  $montant_impots_annuelA = $request->get('montant_impots_annuel');
		  $taux_endettementA = $request->get('taux_endettement');
		  $ageA = $request->get('age');
		  $professionA = $request->get('profession');
		  $proprietaireoulocataireA = $request->get('proprietaireoulocataire');
		  $statut_matrimonialA = $request->get('statut_matrimonial');
		  $composition_foyerA = $request->get('composition_foyer');
		  $noteA = $request->get('note');
		  $centreappel_societe = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('centreappel_societe'))));
		  $responsableagent = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('responsableagent'))));
		  $statut = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('statut'))));
		  $nom = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('nom'))));
		  $prenom = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('prenom'))));
		  $societe = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('societe'))));
		  $nompers = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('nom_personne_rendezvous'))));
		  $client = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('cli'))));
		  $telephone = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('telephone'))));
		  $mobile = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('mobile'))));
		  $email = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('email'))));
		  $activitesociete = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('activitesociete'))));
		  $question_1 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('question_1'))));
		  $question_2 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('question_2'))));
		  $question_3 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('question_3'))));
		  $question_4 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('question_4'))));
		  $question_5 = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('question_5'))));
		  $surface_total_societe = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('surface_total_societe'))));
		  $surface_bureau = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('surface_bureau'))));
		  $sous_contrat = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('sous_contrat'))));
		  $date_anniversaire_contrat = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('date_anniversaire_contrat'))));
		  $protectionsociale = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('protectionsociale'))));
		  $mutuellesante = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('mutuellesante'))));
		  $mutuelle_entreprise = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('mutuelle_entreprise'))));
		  $nom_mutuelle = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('nom_mutuelle'))));
		  $montant_mutuelle_actuelle = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('montant_mutuelle_actuelle'))));
		  $seul_sur_contrat = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('seul_sur_contrat'))));
		  $montant_impots_annuel = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('montant_impots_annuel'))));
		  $taux_endettement = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('taux_endettement'))));
		  $age = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('age'))));
		  $profession = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('profession'))));
		  $proprietaireoulocataire = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('proprietaireoulocataire'))));
		  $statut_matrimonial = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('statut_matrimonial'))));
		  $composition_foyer = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('composition_foyer'))));
		  $note = addslashes(trim(preg_replace('/\s\s+/', '', $request->get('note'))));
		  
		  $data = array('societe'=>$societe);
			// Mail::send('rdvs.mail', $data, function($message) {
		//******** CALENDRIER *********************************
			$dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			$dateagenda2 = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$dateagenda2 = $dateagenda2->add(90, 'minute')->format('yy-m-d H:i:s');
			$titre_details = $client2.' / '.$nompers;
			$note_details  = "";
			// $note_details  = isset($centreappel_societeA)?'Centre d’appels : '.$centreappel_societe : '';
			// $note_details .= isset($responsableagentA)?'Responsable/agent : '.$responsableagent.'<br/>' : '';
			$note_details .= isset($statutA)?'Qualification : '.$statut.'<br/>' : '';
			$note_details .= isset($telephoneA)?'Téléphone : '.$telephone.'<br/>' : '';
			$note_details .= isset($mobileA)?'Mobile : '.$mobile.'<br/>' : '';
			$note_details .= isset($emailA)?'Email : '.$email.'<br/>' : '';
			$note_details .= isset($activitesocieteA)?'Activité société : '.$activitesociete.'<br/>' : '';
			$note_details .= isset($question_1A)?'Question 1 :'.$question_1.'<br/>' : '';
			$note_details .= isset($question_2A)?'Question 2 :'.$question_2.'<br/>' : '';
			$note_details .= isset($question_3A)?'Question 3 :'.$question_3.'<br/>' : '';
			$note_details .= isset($question_4A)?'Question 4 :'.$question_4.'<br/>' : '';
			$note_details .= isset($question_5A)?'Question 5 :'.$question_5.'<br/>' : '';
			$note_details .= isset($surface_total_societeA)?'Surface total société :'.$surface_total_societe.'<br/>' : '';
			$note_details .= isset($surface_bureauA)?'Surface de bureau :'.$surface_bureau.'<br/>' : '';
			if($typerdvA=="Nettoyage pro") $note_details .= isset($sous_contratA)?'Sous contrat :'.$sous_contrat.'<br/>' : '';
			$note_details .= isset($date_anniversaire_contratA)?'Date anniversaire du contrat : '.$date_anniversaire_contrat.'<br/>' : '';
			if($typerdvA=="Assurance pro") $note_details .= isset($protectionsocialeA)?'Protection sociale : '.$protectionsociale.'<br/>' : '';
			if($typerdvA=="Assurance pro") $note_details .= isset($mutuellesanteA)?'Mutuelle santé : '.$mutuellesante.'<br/>' : '';
			if($typerdvA=="Mutuelle santé sénior") $note_details .= isset($mutuelle_entrepriseA)?'Mutuelle entreprise : '.$mutuelle_entreprise.'<br/>' : '';
			$note_details .= isset($nom_mutuelleA)?'Nom de sa mutuelle : '.$nom_mutuelle.'<br/>' : '';
			$note_details .= isset($montant_mutuelle_actuelleA)?'Montant de la mutuelle actuelle : '.$montant_mutuelle_actuelle.'<br/>' : '';
			if($typerdvA=="Mutuelle santé sénior") $note_details .= isset($seul_sur_contratA)?'Seul sur le contrat : '.$seul_sur_contrat.'<br/>' : '';
			$note_details .= isset($montant_impots_annuelA)?'Montant impot annuel : '.$montant_impots_annuel.'<br/>' : '';
			$note_details .= isset($taux_endettementA)?'Taux endettement : '.$taux_endettement.'<br/>' : '';
			if(($typerdvA=="Mutuelle santé sénior") || ($typerdvA=="Défiscalisation")) $note_details .= isset($ageA)?'Age : '.$age.'<br/>' : '';
			$note_details .= isset($professionA)?'Profession : '.$profession.'<br/>' : '';
			$note_details .= isset($proprietaireoulocataireA)?'Propriétaire ou Locataire : '.$proprietaireoulocataire.'<br/>' : '';
			if($typerdvA=="Défiscalisation") $note_details .= isset($statut_matrimonialA)?'Statut matrimonial : '.$statut_matrimonial.'<br/>' : '';
			$note_details .= isset($composition_foyerA)?'Composition foyer : '.$composition_foyer.'<br/>' : '';
			$note_details .= isset($noteA)?'Note : '.$note.'<br/>' : '';
			$titre = "";
			$titre = '<b>'.$client2.' / '.$nompers.'</b>';
			$titre .= '<b><br/>'.$adresse2.'</b>';
			$titre .= isset($centreappel_societeA)?'<br/><b>Centre d’appels : </b>'.$centreappel_societe : '';
			$titre .= isset($responsableagentA)?'<br/><b>Responsable/agent : </b>'.$responsableagent : '';
			$titre .= isset($statutA)?'<br/><b>Qualification : </b>'.$statut : '';
			$titre .= isset($telephoneA)?'<br/><b>Téléphone : </b>'.$telephone : '';
			$titre .= isset($mobileA)?'<br/><b>Mobile : </b>'.$mobile : '';
			$titre .= isset($emailA)?'<br/><b>Email : </b>'.$email : '';
			$titre .= isset($activitesocieteA)?'<br/><b>Activité société : </b>'.$activitesociete : '';
			$titre .= isset($question_1A)?'<br/><b>Question 1 :</b>'.$question_1 : '';
			$titre .= isset($question_2A)?'<br/><b>Question 2 :</b>'.$question_2 : '';
			$titre .= isset($question_3A)?'<br/><b>Question 3 :</b>'.$question_3 : '';
			$titre .= isset($question_4A)?'<br/><b>Question 4 :</b>'.$question_4 : '';
			$titre .= isset($question_5A)?'<br/><b>Question 5 :</b>'.$question_5 : '';
			$titre .= isset($surface_total_societeA)?'<br/><b>Surface total société :</b>'.$surface_total_societe : '';
			$titre .= isset($surface_bureauA)?'<br/><b>Surface de bureau :</b>'.$surface_bureau : '';
			if($typerdvA=="Nettoyage pro") $titre .= isset($sous_contratA)?'<br/><b>Sous contrat :</b>'.$sous_contrat : '';
			$titre .= isset($date_anniversaire_contratA)?'<br/><b>Date anniversaire du contrat : </b>'.$date_anniversaire_contrat : '';
			if($typerdvA=="Assurance pro") $titre .= isset($protectionsocialeA)?'<br/><b>Protection sociale : </b>'.$protectionsociale : '';
			if($typerdvA=="Assurance pro") $titre .= isset($mutuellesanteA)?'<br/><b>Mutuelle santé : </b>'.$mutuellesante : '';
			if($typerdvA=="Mutuelle santé sénior") $titre .= isset($mutuelle_entrepriseA)?'<br/><b>Mutuelle entreprise : </b>'.$mutuelle_entreprise : '';
			$titre .= isset($nom_mutuelleA)?'<br/><b>Nom de sa mutuelle : </b>'.$nom_mutuelle : '';
			$titre .= isset($montant_mutuelle_actuelleA)?'<br/><b>Montant de la mutuelle actuelle : </b>'.$montant_mutuelle_actuelle : '';
			if($typerdvA=="Mutuelle santé sénior") $titre .= isset($seul_sur_contratA)?'<br/><b>Seul sur le contrat : </b>'.$seul_sur_contrat : '';
			$titre .= isset($montant_impots_annuelA)?'<br/><b>Montant impot annuel : </b>'.$montant_impots_annuel : '';
			if(($typerdvA=="Mutuelle santé sénior") || ($typerdvA=="Défiscalisation")) $titre .= isset($ageA)?'<br/><b>Age : </b>'.$age : '';
			$titre .= isset($taux_endettementA)?'<br/><b>Taux endettement : </b>'.$taux_endettement : '';
			$titre .= isset($professionA)?'<br/><b>Profession : </b>'.$profession : '';
			$titre .= isset($proprietaireoulocataireA)?'<br/><b>Propriétaire ou Locataire : </b>'.$proprietaireoulocataire : '';
			if($typerdvA=="Défiscalisation") $titre .= isset($statut_matrimonialA)?'<br/><b>Statut matrimonial : </b>'.$statut_matrimonial : '';
			$titre .= isset($composition_foyerA)?'<br/><b>Composition foyer : </b>'.$composition_foyer : '';
			$titre .= isset($noteA)?'<br/><b>Note : </b>'.$note: '';

				
			$evenement = Event::where('_idRdv', '=', $idencode)->first();
			if(isset($evenement)){
				if (($statut=='Rendez-vous brut') || ($statut=='Rendez-vous refusé') || ($statut=='Rendez-vous Réception d’appels brut') || ($statut=='Rendez-vous Réception d’appels envoyé') || ($statut=='Rendez-vous Demande de devis brut') || ($statut=='Rendez-vous Demande de devis envoyé')){
					$evenement->delete();
				}else{
					$evenement->title = $titre;
					$evenement->client_priv = $client_priv; 
					$evenement->titre_details = $titre_details; 
					$evenement->adresse_details = $adresse2; 
					// $evenement->note_details = $note; 
					$evenement->note_details = $note_details; 
					$evenement->start = $dateagenda;
					$evenement->end = $dateagenda2;
					$evenement->backgroundColor = $couleur_rdv;
					$evenement->borderColor = $couleur_rdv;
					$evenement->save();
				}
			}else{
				if (($statut=='Rendez-vous envoyé') || ($statut=='Rendez-vous confirmé') || ($statut=='Rendez-vous annulé') || ($statut=='Rendez-vous en attente') || ($statut=='Rendez-vous validé')){
					$agenda = new Event([
						'_idRdv' => $idencode,  
						'client_priv' => $client_priv,  
						'titre_details' => $titre_details,  
						'adresse_details' => $adresse2,  
						'note_details' => $note_details,  
						'title' => $titre,  
						'start' => $dateagenda,  
						'end' => $dateagenda2,  
						'backgroundColor' => $couleur_rdv,  
						'borderColor' => $couleur_rdv		
					]);
					$agenda->save();
				}
			}
			
			$responsableMail = User::findOrFail($rdv->user_id);
			$clientMail = User::findOrFail($rdv->compte_id);
			$prenom = $request->get('user_prenom');
			$id_staff = auth()->user()->_id;
			$staff = User::findOrFail($id_staff);
			// $destinataireemail = 'heryaddams@yahoo.fr';
			// $bccemail = 'heryaddams@gmail.com';
			$bccemail = 'contact@crmmetier.com';
			$destinataireemailresponsable = $responsableMail->email;
			// $destinataireemailresponsable = 'heryaddams@yahoo.fr';
			$destinataireemailcli = $request->get('client_emailpriv');
			$date_rendezvousedit_details = $request->get('date_rendezvousedit');
			$heure_rendezvousedit_details = $request->get('heure_rendezvousedit');
			$reference = substr($idencode,3,-16);
				
			if ($request->get('statut')=='Rendez-vous refusé'){
				/************** MAIL ******************/
				Mail::send('rdvs.mail_RdvRefuse', compact('rdv','responsableMail','prenom'), function($message)use($destinataireemailresponsable, $bccemail, $reference) {
					$message
						// ->from('contact@crmmetier.com','CRM métier')
						->from('contact@crmmetier.com')
						// ->replyTo('contact@crmmetier.com','CRM métier')
						->to($destinataireemailresponsable)
						->bcc($bccemail)
						->subject('Le rendez-vous référence '.$reference.' a été refusé');
				}); 		
			}elseif ($request->get('statut')=='Rendez-vous relancer'){
				/************** MAIL ******************/
				Mail::send('rdvs.mail_RdvRefuse', compact('rdv','responsableMail','prenom'), function($message)use($destinataireemailresponsable, $bccemail, $reference) {
					$message
						// ->from('contact@crmmetier.com','CRM métier')
						->from('contact@crmmetier.com')
						// ->replyTo('contact@crmmetier.com','CRM métier')
						->to($destinataireemailresponsable)
						->bcc($bccemail)
						->subject('Le rendez-vous référence '.$reference.' a été refusé');
				}); 		
			}elseif ($request->get('statut')=='Rendez-vous envoyé'){ 
				/************** MAIL ******************/
					Mail::send('rdvs.mail_RdvEnvoye', compact('rdv','clientMail','prenom','dateagenda','adresse2','titre_details','note_details','heure_rendezvousedit_details','date_rendezvousedit_details'), function($message)use($destinataireemailcli, $bccemail, $reference) {
					// Mail::send('rdvs.mail_SuperviseurAgent', compact('rdv','client','staff'), function($message)use($email, $bccemail, $client2) {
						$message
							// ->from('contact@lacentraledurdv.com','La centrale du rendez-vous')
							// ->replyTo('contact@lacentraledurdv.com','La centrale du rendez-vous')
							->from('contact@crmmetier.com')
							->to($destinataireemailcli)
							->bcc($bccemail)
							->subject('Vous avez un nouveau rendez-vous - référence : '.$reference);
					}); 
			}elseif ($request->get('statut')=='Rendez-vous confirmé'){
					Mail::send('rdvs.mail_RdvConfirme', compact('rdv','reference','clientMail','prenom','dateagenda','adresse2','titre_details','note_details','heure_rendezvousedit_details','date_rendezvousedit_details'), function($message)use($destinataireemailcli, $bccemail, $reference) {
					// Mail::send('rdvs.mail_SuperviseurAgent', compact('rdv','client','staff'), function($message)use($email, $bccemail, $client2) {
						$message
							// ->from('contact@lacentraledurdv.com','La centrale du rendez-vous')
							// ->replyTo('contact@lacentraledurdv.com','La centrale du rendez-vous')
							->from('contact@crmmetier.com')
							->to($destinataireemailcli)
							->bcc($bccemail)
							->subject('Le rendez-vous référence : '.$reference.' est confirmé');
					});			
			}elseif ($request->get('statut')=='Rendez-vous annulé'){
					Mail::send('rdvs.mail_RdvAnnule', compact('rdv','reference','clientMail','prenom','dateagenda','adresse2','titre_details','note_details','heure_rendezvousedit_details','date_rendezvousedit_details'), function($message)use($destinataireemailcli, $bccemail, $reference) {
					// Mail::send('rdvs.mail_SuperviseurAgent', compact('rdv','client','staff'), function($message)use($email, $bccemail, $client2) {
						$message
							// ->from('contact@lacentraledurdv.com','La centrale du rendez-vous')
							// ->replyTo('contact@lacentraledurdv.com','La centrale du rendez-vous')
							->from('contact@crmmetier.com')
							->to($destinataireemailcli)
							->bcc($bccemail)
							->subject('Le rendez-vous référence : '.$reference.' est annulé');
					}); 	
			}elseif ($request->get('statut')=='Rendez-vous en attente'){
					Mail::send('rdvs.mail_RdvAttente', compact('rdv','reference','clientMail','prenom','dateagenda','adresse2','titre_details','note_details','heure_rendezvousedit_details','date_rendezvousedit_details'), function($message)use($destinataireemailcli, $bccemail, $reference) {
					// Mail::send('rdvs.mail_SuperviseurAgent', compact('rdv','client','staff'), function($message)use($email, $bccemail, $client2) {
						$message
							// ->from('contact@lacentraledurdv.com','La centrale du rendez-vous')
							// ->replyTo('contact@lacentraledurdv.com','La centrale du rendez-vous')
							->from('contact@crmmetier.com')
							->to($destinataireemailcli)
							->bcc($bccemail)
							->subject('Le rendez-vous référence : '.$reference.' est en attente');
					});	
			}elseif ($request->get('statut')=='Rendez-vous validé'){
				/* Mail::send('rdvs.mail_RdvValide', compact('rdv','reference','clientMail','prenom','dateagenda','adresse2','titre_details','note_details','heure_rendezvousedit_details','date_rendezvousedit_details'), function($message)use($destinataireemailcli, $bccemail, $reference) {
				// Mail::send('rdvs.mail_SuperviseurAgent', compact('rdv','client','staff'), function($message)use($email, $bccemail, $client2) {
					$message
						->from('contact@lacentraledurdv.com','La centrale du rendez-vous')
						->replyTo('contact@lacentraledurdv.com','La centrale du rendez-vous')
						->to($destinataireemailcli)
						->bcc($bccemail)
						->subject('Le rendez-vous référence : '.$reference.' est validé');
				}); */		
			}

		  
		  // return view('rdvs.mail', compact('rdv','client'));
				

			// return redirect('/rendez-vous/mail')->with('success', 'Rdv modifiée!');
			
			return redirect('/rendez-vous/tout')->with('success', 'Rdv modifiée!');
			// return redirect('/rdvs')->with('success', 'Rdv modifiée!');
		}
    	
	}
	
	
    public function modifaudio(Request $request, $idencode)
	{
		print_r("id: ".$idencode);
	}
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $rdv
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Rdv $rdv)
    public function destroy($id)
    {
		// $rdv->delete();
		
        $rdv = Rdv::findOrFail($id);
		$rdv->delete(); 
		
		$evenement = Event::where('_idRdv', '=', $id)->first();
		$evenement->delete(); 

		return redirect('/rendez-vous/tout')->with('success', 'Rdv supprimée!');
    }    
	
	/**
    * @return \Illuminate\Support\Collection
    */

    public function exportexcel() 
    {
        $rdv = Rdv::all();
        // return Excel::download(User::all(), 'rendezvous.xlsx');
        return Excel::download(new RdvsExport, 'rendezvous.xlsx');
    }

    public function exportpdf($idencode) 
    {
        $rdv = Rdv::find($idencode);
		
		// $pdf = PDF::loadView('rdvs.pdf', compact('rdv'))->setPaper('a4', 'landscape');
		$pdf = PDF::loadView('rdvs.pdf', compact('rdv'))->setPaper('a4', 'portrait');
		// Sauvegarder le fichier dans le dossier storage
		$pdf->save(storage_path('pdf/ficherdv.pdf'));
		// Enfin, vous pouvez télécharger le fichier en utilisant la fonction de téléchargement
		return $pdf->download('ficherdv.pdf'); 
    }


}
