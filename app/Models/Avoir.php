<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avoir extends Model
{
    //
    protected $guarded = [];

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode');
    }

    public function paiements()
    {
        return $this->hasMany('App\Models\Paiement');
    }

    public function echeances()
    {
        return $this->hasMany('App\Models\Echeance');
    }

    public function getSoldeAttribute(){
        $total = $this->paiements->reduce(function($carry,$item){
            return $carry + $item->montant;
        });

        return $this->montant - $total;
    }

}
