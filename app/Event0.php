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
	
    protected $fillable = ['title','start','end','backgroundColor','borderColor'];
}
