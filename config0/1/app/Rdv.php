<?php

namespace App;


/***************************** MySQL *********************
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
*/

use Jenssegers\Mongodb\Eloquent\Model as Eloquent; //MongoDB

class Rdv extends Eloquent //MongoDB
{
	protected $connection = 'mongodb'; //MongoDB

	protected $collection = 'rdvs'; //MongoDB
	
    protected $fillable = [
		'client_nompriv', 
		'client_prenompriv', 
		'user_nom', 
		'user_prenom', 
		'id_groupe', 
		'cli', 
		'statut', 
		'client_id', 
		'centreappel_societe',
		'responsableagent',
		'client_societe',
		'compte_id', 
		'user_statut', 
		'user_id', 
		'typerdv', 
		'couleur_rdv', 
		'nom', 
		'prenom', 
		'adresse', 
		'cp', 
		'ville', 
		'telephone', 
		'mobile', 
		'email', 
		'activitesociete', 
		'age', 
		'profession', 
		'proprietaireoulocataire', 
		'protectionsociale', 
		'mutuellesante', 
		'montant_impots_annuel', 
		'taux_endettement', 
		'statut_matrimonial', 
		'composition_foyer',
		'nomprenomcontact', 
		'date_rendezvous', 
		'heure_rendezvous', 
		'audio', 
		'note',
		'noteconfidentielle',
		'notestaff',
		'societe', 
		'surface_total_societe', 
		'surface_bureau', 
		'sous_contrat', 
		'date_anniversaire_contrat',
		'nom_personne_rendezvous', 
		'mutuelle_entreprise', 
		'nom_mutuelle', 
		'montant_mutuelle_actuelle', 
		'seul_sur_contrat',
		'question_1', 
		'question_2', 
		'question_3', 
		'question_4', 
		'question_5'
    ];
}
