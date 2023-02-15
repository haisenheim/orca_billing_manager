<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;


    public function profil()
    {
        return $this->belongsTo('App\Models\Profil','profil_id');
    }
    public function canal()
    {
        return $this->belongsTo('App\Models\Canal','canal_id');
    }

    public function etapes()
    {
        return $this->hasMany('App\Models\Etape');
    }
}
