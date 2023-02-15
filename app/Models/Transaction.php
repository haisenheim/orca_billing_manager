<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $guarded = [];


    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function paiement(){
        return $this->belongsTo('App\Models\Paiement');
    }

    public function avoir(){
        return $this->belongsTo('App\Models\Avoir');
    }

    public function facture(){
        return $this->belongsTo('App\Models\Facture');
    }

    public function getTypeAttribute(){
        $data = ['name'=>'inconnu','num'=>'-','montant'=>'0','color'=>'danger'];
        if($this->facture){
            $data = ['name'=>'facture','num'=>$this->facture->name,'montant'=>$this->facture->montant,'color'=>'info'];
        }

        if($this->paiement){
            $data = ['name'=>'paiement','num'=>$this->paiement->name,'montant'=>$this->paiement->montant,'color'=>'success'];
        }

        if($this->avoir){
            $data = ['name'=>'avoir','num'=>$this->avoir->name,'montant'=>$this->avoir->montant,'color'=>'warning'];
        }

        return $data;
    }

}
