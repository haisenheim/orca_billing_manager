<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['done_at'];

    public function facture(){
        return $this->belongsTo('App\Models\Facture');
    }

    public function echeance(){
        return $this->belongsTo('App\Models\Echeance');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode');
    }

}
