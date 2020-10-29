<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\PasswordReset;
/***************************** MySQL *********************
use Illuminate\Foundation\Auth\User as Authenticatable;
*/
use Jenssegers\Mongodb\Auth\User as Authenticatable; //MongoDB
use DB; //MongoDB


class User extends Authenticatable
{
    use Notifiable;

    protected $collection = 'users'; //MongoDB
	
    protected $primarykey = "_id";
	 protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
	 
    protected $fillable = [
        'type', 
		'name', 
		'username', 
		'email', 
		'password', 
		'nom', 
		'prenom', 
		'telephone', 
		'statut', 
		'audio', 
        'agendapriv',
        'agendaoutlook',
        'agendaprivadmin',
        'agendapub',
		'note', 
		'etat',
		'noteconfidentielle',
		'administrateur_id', 
		'centreappel_id', 
		'client_id', 
		'societe2',
        'plage_horaire'
    ];
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	
	public function clients()
	{
		return $this->belongsTo("Client", 'client_id');
	}


    public function days(){
        return $this->belongsToMany('App\Day','workhours')->withPivot('start_time', 'end_time');
    }

}
