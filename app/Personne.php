<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Personne extends Authenticatable
{
    //

    use  Notifiable;


    protected $guard = 'personne';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'mobileno', 'email', 'password', 'dob', 'gender', 'category_id', 'class_id', 'is_active'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
    


    public function category(){
        return $this->belongsTo('App\Category');
    }


}
