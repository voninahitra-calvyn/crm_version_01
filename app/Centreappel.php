<?php

namespace App;


/***************************** MySQL *********************
use Illuminate\Database\Eloquent\Model;

class Centreappel extends Model
*/
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Centreappel extends Eloquent //MongoDB

{

	protected $connection = 'mongodb'; //MongoDB

	protected $collection = 'centreappels'; //MongoDB
	
    //
    protected $fillable = [
        'societe', 'adresse', 'cp', 'ville', 'pays', 'telephone', 'email', 'effectif', 'horaireprod',
        'campagnefavorite', 'noteconfidentielle', 'note', 'etat'
    ];
	
    /**
     * Obtenir les utilisateurs pour le compte centre d'appels.
     */
    public function users()
    {
        return $this->hasMany(User::class);
	}
}
