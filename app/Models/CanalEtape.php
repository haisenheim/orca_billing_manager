<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalEtape extends Model
{
    //
    protected $guarded = [];



    public function etape()
    {
        return $this->belongsTo('App\Models\Etape','etape_id');
    }

    public function canal()
    {
        return $this->belongsTo('App\Models\Canal','canal_id');
    }

    public function modele()
    {
        return $this->belongsTo('App\Models\Modele','modele_id');
    }



}
