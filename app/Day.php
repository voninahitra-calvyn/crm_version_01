<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Day extends Eloquent
{
    //
    protected $connection = 'mongodb'; //MongoDB

    protected $collection = 'days'; //MongoDB
    // protected $primarykey = "_idRdv";

    protected $fillable = [
        'name'
    ];
}
