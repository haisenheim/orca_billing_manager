<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    //
    protected $guarded = [];
    //protected $table = "produits";
    public $timestamps = false;



    public function ville()
    {
        return $this->belongsTo('App\Models\Ville','ville_id');
    }

    public function scenarios()
    {
        return $this->hasMany('App\Models\Scenario');
    }

    public function clients(){
        return $this->hasMany('App\Models\Client');
    }

}
