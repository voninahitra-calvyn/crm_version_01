<?php

namespace App;


/***************************** MySQL *********************
use Illuminate\Database\Eloquent\Model;

class Support extends Model
*/

use Jenssegers\Mongodb\Eloquent\Model as Eloquent; //MongoDB

class Support extends Eloquent //MongoDB
{
	protected $connection = 'mongodb'; //MongoDB

	protected $collection = 'supports'; //MongoDB
	
    protected $fillable = [
		'user_id', 
		'support_id', 
		'repondu', 
		'vu', 
		'nom', 
		'prenom', 
		'user_idE', 
		'user_idR', 
		'nomE', 
		'prenomE', 
		'statutE', 
		'message', 
		'statut', 
		'user_id1', 
		'user_id2', 
		'date_message', 
    ];
}
