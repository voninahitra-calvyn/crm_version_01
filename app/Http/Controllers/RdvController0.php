<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
// use App\Hashids\Hashids;
// use Hashids\Hashids;

use App\Http\Controllers\Input;
use Intervention\Image\Facades\Image;
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
    public function index()
    {
		$comptes = User::where('statut', '=', 'Responsable')
			->orWhere('statut', '=', 'Commercial')
            ->get();
				
		return view('rdvs.ajoutrdv', compact('comptesj'));
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
				->get();
			$rdvsbrut = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('client_id', '=', $id_client)
				->where('statut', '=', 'Rendez-vous refusé')
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
				->get();
			$rdvsbrut = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous brut')
				->get();
			$rdvsrefuse = Rdv::where('compte_id', '=', $id_user)
				->where('statut', '=', 'Rendez-vous refusé')
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
		return view('rdvs.liste', compact('typerdv','rendezvoustout','statutrdv','rdvsbrut','rdvsrefuse','rdvsenvoye','rdvsconfirme','rdvsannule','rdvsenattente','rdvsvalide','appelsbrut','appelsenvoye','devisbrut','devisenvoye','rendezvous','rdvsdefiscalisation','rdvsdefiscalisation','rdvsnettoyagepro','rdvsassurancepro','rdvsmutuellesantesenior','rdvsautre','appels','devis'));  
    
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
		// $rdv->user_nom = $request->get('user_nom'); //cocomodif
		// $rdv->user_prenom = $request->get('user_prenom'); //cocomodif
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
		$rdv->date_rendezvous = $request->get('date_rendezvousedit'); 
		$rdv->heure_rendezvous = $request->get('heure_rendezvousedit'); 
		$rdv->note = $request->get('note');
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
	  $email = $request->get('email');
	  $client2 = $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe');
	  $societe = $request->get('nom');
      $data = array('societe'=>$societe);
		// Mail::send('rdvs.mail', $data, function($message) {
		if ($request->get('statut')=='Rendez-vous envoyé'){
			/************** MAIL ******************
			try{
				Mail::send('rdvs.mail', compact('rdv','client'), function($message)use($email, $client2) {
					$message->to($email, $client2)->subject('Nouveau rendez-vous de lacentraledurdv.com');
					// $message->to('heryaddams@yahoo.fr', 'RAZAFIMAHEFA Heriniaina')->subject('Nouveau rendez-vous de lacentraledurdv.com');
					// $message->to($request->get('email'), $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'))->subject('Nouveau rendez-vous de lacentraledurdv.com');
					$message->from('ohmycrmadmn@gmail.com','La centrale du rendez-vous');
				});  
			}
			catch (Swift_TransportException $STe) {
				// logging error
				$string = date("Y-m-d H:i:s")  . ' - ' . $STe->getMessage() . PHP_EOL;
				// send error note to user
				$errorMsg = "the mail service has encountered a problem. Please retry later or contact the site admin.";
				 print_r($errorMsg);
			}
			catch(Exception $e){
				// Never reached
			} */
		   /* $agenda = new Event([
				'titre' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'),  
				'start' => $request->get('date_rendezvous').' '.$request->get('heure_rendezvous'),  
				'backgroundColor' => '#00c0ef',  
				'borderColor' => '#00c0ef'		
		   ]); */	
/*		   
		   // $dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvous'));
		   $dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
		   // $dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvous'));
		   // $dateagenda2 = $dateagenda->add(15, 'minute');
 			
			if($request->get('heure_rendezvous')==null){
				$start = $dateagenda->format('yy-m-d H:i:s');
				$end = $dateagenda->format('yy-m-d H:i:s');
				// $end = $dateagenda->add(15, 'minute')->format('yy-m-d H:i:s');
			}else{
				// $start = $dateagenda->format('yy-m-d H:i:s').' '.$request->get('heure_rendezvous');
				// $start = $request->get('date_rendezvous').' '.$request->get('heure_rendezvousedit')->format('yy-m-d H:i:s');
				$start = $dateagenda->format('yy-m-d H:i:s');
				$end = $dateagenda->format('yy-m-d H:i:s').' '.$request->get('heure_rendezvousedit');
				// $end = $dateagenda2->format('yy-m-d H:i:s').' '.$request->get('heure_rendezvous');
				// $end = $dateagenda->add(15, 'minute')->format('yy-m-d H:i:s');
			} 
*/
			$dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$start = $dateagenda->format('yy-m-d H:i:s');
			$end = $dateagenda->format('yy-m-d H:i:s');
		   
			$agenda = new Event([
				// 'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe').'<br/>Boring event<br/>Desolate venue',  
				// 'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'),  
				'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe').' / '.$request->get('nom_personne_rendezvous').'<br/>'.$request->get('adresse').' '.$request->get('cp').' '.$request->get('ville'),  
				// 'start' => $request->get('date_rendezvous').' '.$request->get('heure_rendezvous'),  
				'start' => $start,  
				'end' => $end,  
				'backgroundColor' => '#999',  
				'borderColor' => '#999'		
		   ]);
			$agenda->save(); 
			
		}elseif ($request->get('statut')=='Rendez-vous confirmé'){
			/* try{
				Mail::send('rdvs.mail', compact('rdv','client'), function($message)use($email, $client2) {
					$message->to($email, $client2)->subject('Confirmation rendez-vous de lacentraledurdv.com');
					// $message->to('heryaddams@yahoo.fr', 'RAZAFIMAHEFA Heriniaina')->subject('Confirmation rendez-vous de lacentraledurdv.com');
					// $message->to($request->get('email'), $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'))->subject('Confirmation rendez-vous de lacentraledurdv.com');
					$message->from('ohmycrmadmn@gmail.com','La centrale du rendez-vous');
				});  
			}
			catch(Exception $e){
				// Never reached
			} */
			
			$dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			$agenda = new Event([
				'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe').' / '.$request->get('nom_personne_rendezvous').'<br/>'.$request->get('adresse').' '.$request->get('cp').' '.$request->get('ville'),  
				'start' => $dateagenda,  
				'end' => $dateagenda,  
				'backgroundColor' => '#00a65a',  
				'borderColor' => '#00a65a'		
		   ]);
			$agenda->save();  
		}elseif ($request->get('statut')=='Rendez-vous annulé'){
			/* try{
				Mail::send('rdvs.mail', compact('rdv','client'), function($message)use($email, $client2) {
					$message->to($email, $client2)->subject('Annulation rendez-vous de lacentraledurdv.com');
					// $message->to('heryaddams@yahoo.fr', 'RAZAFIMAHEFA Heriniaina')->subject('Annulation rendez-vous de lacentraledurdv.com');
					$message->to($request->get('email'), $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'))->subject('Annulation rendez-vous de lacentraledurdv.com');
					$message->from('ohmycrmadmn@gmail.com','La centrale du rendez-vous');
				});  
			}
			catch(Exception $e){
				// Never reached
			} */
			
			$dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			$agenda = new Event([
				'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe').' / '.$request->get('nom_personne_rendezvous').'<br/>'.$request->get('adresse').' '.$request->get('cp').' '.$request->get('ville'),  
				'start' => $dateagenda,  
				'end' => $dateagenda,  
				'backgroundColor' => '#dd4b39',  
				'borderColor' => '#dd4b39'		
		   ]);
			$agenda->save(); 	
		}elseif ($request->get('statut')=='Rendez-vous en attente'){
			/* try{
				Mail::send('rdvs.mail', compact('rdv','client'), function($message)use($email, $client2) {
					$message->to($email, $client2)->subject('Annulation rendez-vous de lacentraledurdv.com');
					// $message->to('heryaddams@yahoo.fr', 'RAZAFIMAHEFA Heriniaina')->subject('Annulation rendez-vous de lacentraledurdv.com');
					$message->to($request->get('email'), $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'))->subject('Annulation rendez-vous de lacentraledurdv.com');
					$message->from('ohmycrmadmn@gmail.com','La centrale du rendez-vous');
				});  
			}
			catch(Exception $e){
				// Never reached
			} */
			
			$dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			$agenda = new Event([
				'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe').' / '.$request->get('nom_personne_rendezvous').'<br/>'.$request->get('adresse').' '.$request->get('cp').' '.$request->get('ville'),  
				'start' => $dateagenda,  
				'end' => $dateagenda,  
				'backgroundColor' => '#3c8dbc',  
				'borderColor' => '#3c8dbc'		
		   ]);
			$agenda->save(); 	
		}elseif ($request->get('statut')=='Rendez-vous validé'){
			/* try{
				Mail::send('rdvs.mail', compact('rdv','client'), function($message)use($email, $client2) {
					$message->to($email, $client2)->subject('Annulation rendez-vous de lacentraledurdv.com');
					// $message->to('heryaddams@yahoo.fr', 'RAZAFIMAHEFA Heriniaina')->subject('Annulation rendez-vous de lacentraledurdv.com');
					$message->to($request->get('email'), $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe'))->subject('Annulation rendez-vous de lacentraledurdv.com');
					$message->from('ohmycrmadmn@gmail.com','La centrale du rendez-vous');
				});  
			}
			catch(Exception $e){
				// Never reached
			} */
			
			$dateagenda = \Carbon\Carbon::parse($request->get('date_rendezvousedit').' '.$request->get('heure_rendezvousedit'));
			$dateagenda = $dateagenda->format('yy-m-d H:i:s');
			$agenda = new Event([
				'title' => $request->get('nom').' '.$request->get('prenom').' '.$request->get('societe').' / '.$request->get('nom_personne_rendezvous').'<br/>'.$request->get('adresse').' '.$request->get('cp').' '.$request->get('ville'),  
				'start' => $dateagenda,  
				'end' => $dateagenda,  
				'backgroundColor' => '#008d4c',  
				'borderColor' => '#008d4c'		
		   ]);
			$agenda->save(); 	
		}

	  
	  // return view('rdvs.mail', compact('rdv','client'));
			

        // return redirect('/rendez-vous/mail')->with('success', 'Rdv modifiée!');
		
        return redirect('/rendez-vous/tout')->with('success', 'Rdv modifiée!');
        // return redirect('/rdvs')->with('success', 'Rdv modifiée!');
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


}
