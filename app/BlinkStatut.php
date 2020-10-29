<?php
/**
 * Created by PhpStorm.
 * User: Valandrainy
 * Date: 10/10/2020
 * Time: 19:43
 */

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class BlinkStatut extends Eloquent //MongoDB
{
    protected $connection = 'mongodb'; //MongoDB

    protected $collection = 'blinkstatut'; //MongoDB
    protected $fillable = ['typerdv','isunread'];

}