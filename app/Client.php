<?php

namespace App;

/***************************** MySQL *********************
use Illuminate\Database\Eloquent\Model;

class Client extends Model
*/

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Client extends Eloquent //MongoDB
{
	protected $connection = 'mongodb'; //MongoDB
	protected $collection = 'clients'; //MongoDB    
	protected $guarded = [];
    protected $primarykey = "_id";
	
    protected $fillable = [
        'societe', 'societe2', 'adresse', 'cp', 'ville', 'pays', 'telephone', 'email', 'service', 'note', 'client_id', 'compte_id'
    ];
	
    /**
     * Obtenir les utilisateurs pour le compte client.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'users');
    }
	
}
