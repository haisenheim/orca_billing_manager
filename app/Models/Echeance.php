<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Echeance extends Model
{
    //
    protected $guarded = [];
    protected $dates=['dt'];

    public function facture(){
        return $this->belongsTo('App\Models\Facture');
    }

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function paiements(){
        return $this->hasMany('App\Models\Paiement');
    }

    public function getEncaissementAttribute(){
        return $this->paiements->reduce(function($carry,$item){
            return $carry + $item->montant;
        });
    }

    public function getSoldeeAttribure(){
        return ($this->encaissement >= $this->montant);
    }

    public function getRestetotalAttribute(){
        $paiements = $this->paiements;
        $ps = $paiements->reduce(function($carry, $item){
            return $carry + $item->montant;
        });

        return $this->montant - $ps;
    }

    public function getResteAttribute(){
        $paiements = $this->paiements;
        $ps = $paiements->reduce(function($carry, $item){
            return $carry + $item->montant;
        });
        if($this->dt >= Carbon::today()){
            if($ps >= $this->montant){
                return 0;
            }else{
                return $this->montant - $ps;
            }
        }else{
            return 0;
        }
    }



    public function getImpayeAttribute(){
        $paiements = $this->paiements;
        $ps = $paiements->reduce(function($carry, $item){
            return $carry + $item->montant;
        });
        if($this->dt < Carbon::today()){
            if($ps >= $this->montant){
                return 0;
            }else{
                return $this->montant - $ps;
            }
        }else{
            return 0;
        }

    }


}
