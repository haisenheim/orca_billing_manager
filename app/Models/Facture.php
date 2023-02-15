<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    //
    protected $guarded = [];
    protected $dates =['delivered_at'];

    public function paiements()
    {
        return $this->hasMany('App\Models\Paiement');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function echeances()
    {
        return $this->hasMany('App\Models\Echeance');
    }

    public function getEncaissementAttribute(){
        return $this->paiements->reduce(function($carry,$item){
            return $carry + $item->montant;
        });
    }

    public function getSoldeAttribute(){
        return $this->montant - $this->encaissement;
    }

    public function getImpayeAttribute(){
        $echeances = $this->echeances;
        return $echeances->reduce(function($carry, $item){
            return $carry + $item->impaye;
        });
    }

    public function getSoldeeAttribure(){
        return ($this->encaissement >= $this->montant);
    }


}
