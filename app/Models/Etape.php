<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    //
    protected $guarded = [];



    public function scenario()
    {
        return $this->belongsTo('App\Models\Scenario','scenario_id');
    }

    public function canal()
    {
        return $this->belongsTo('App\Models\Canal','canal_id');
    }

    public function modele()
    {
        return $this->belongsTo('App\Models\Modele','modele_id');
    }

    public function relances(){
        return $this->belongsToMany('App\Models\Canal','canal_etapes','canal_id','etape_id');
    }

    public function types(){
        return $this->hasMany('App\Models\CanalEtape','etape_id');
    }

    public function interlocuteur(){
        return $this->belongsTo('App\Models\Poste','interlocuteur_id');
    }


}
