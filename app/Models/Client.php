<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    use HasFactory;

    protected $guarded = [];

    public function ville(){
        return $this->belongsTo('App\Models\Ville');
    }

    public function profil(){
        return $this->belongsTo('App\Models\Profil');
    }

    public function factures(){
        return $this->hasMany('App\Models\Facture');
    }

    public function paiements(){
        return $this->hasMany('App\Models\Paiement');
    }

    public function avoirs(){
        return $this->hasMany('App\Models\Avoir');
    }

    public function getTotalAvoirsAttribute(){
        return $this->avoirs->reduce(function($carry,$item){
            return $carry + $item->montant;
        });
    }

    public function getSoldeAvoirsAttribute(){
        return $this->avoirs->reduce(function($carry,$item){
            return $carry + $item->solde;
        });
    }

    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }

    public function getMontantFactureAttribute(){
        $factures = $this->factures;
        return $factures->reduce(function($carry,$item){
            return $carry + $item->montant;
        });
    }

    public function getMontantPayeAttribute(){
        $paiements = $this->paiements;
        return $paiements->reduce(function($carry,$item){
            return $carry + $item->montant;
        });

    }

    public function getMontantDuAttribute(){
        return $this->montant_facture -$this->montant_paye;

    }

    public function getImpayeAttribute(){
        $echeances = $this->factures;
        return $echeances->reduce(function($carry, $item){
            return $carry + $item->impaye;
        });
    }

    public function getTauxRecoveryAttribute(){
        return $this->montant_facture?round($this->montant_paye * 100/$this->montant_facture,1):0;
    }

}
