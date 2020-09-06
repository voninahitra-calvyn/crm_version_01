<?php

namespace App;

/***************************** MySQL *********************
use Illuminate\Database\Eloquent\Model;

class Home extends Model
*/

use Jenssegers\Mongodb\Eloquent\Model as Eloquent; //MongoDB

class Home extends Eloquent //MongoDB
{
	protected $connection = 'mongodb'; //MongoDB

	protected $collection = 'homes'; //MongoDB
	
    protected $fillable = ['note1','note2'];
	
	

}
