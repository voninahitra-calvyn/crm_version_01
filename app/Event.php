<?php

namespace App;

/***************************** MySQL *********************
use Illuminate\Database\Eloquent\Model;

class Event extends Model
*/

use Jenssegers\Mongodb\Eloquent\Model as Eloquent; //MongoDB

class Event extends Eloquent //MongoDB
{
	protected $connection = 'mongodb'; //MongoDB

	protected $collection = 'events'; //MongoDB
    // protected $primarykey = "_idRdv";
	
    protected $fillable = [
		'_idRdv',
		'user_statut',
		'agendapro_statut',
		'client_priv',
		'titre_details',
		'adresse_details',
		'note_details',
		'title',
		'start',
		'end',
		'backgroundColor',
		'borderColor', 
		'googleuid'
	];
	
    /**
     * Obtenir les rendez-vous pour l'agenda.
     */
    public function rdvs()
    {
        return $this->hasMany(RDV::class, 'rdvs');
    }
}
