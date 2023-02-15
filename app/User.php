<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function getNameAttribute(){
        return $this->first_name . "  ". $this->last_name;
    }



    public function role(){
       return $this->belongsTo('App\Models\Role');
    }

    public function getStatusAttribute(){
        $data = ['name'=>'bloqué','color'=>'danger'];
        if($this->active){
            $data = ['name'=>'actif','color'=>'success'];
        }
        return $data;
    }

    public function habilitations()
    {
        return $this->hasMany('App\Models\Habilitation');
    }



}
