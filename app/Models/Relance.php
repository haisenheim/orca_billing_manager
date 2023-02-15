<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relance extends Model
{
    //
    protected $guarded = [];

    public function echeance(){
        return $this->belongsTo('App\Models\Echeance');
    }

    public function etape(){
        return $this->belongsTo('App\Models\Etape');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function facture(){
        return $this->belongsTo('App\Models\Facture');
    }

    public function canal(){
        return $this->belongsTo('App\Models\Canal');
    }


}
