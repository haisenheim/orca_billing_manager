<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scenario extends Model
{
    //
    protected $guarded = [];
    //protected $table = "produits";
    public $timestamps = false;



    public function profil()
    {
        return $this->belongsTo('App\Models\Profil','profil_id');
    }

    public function etapes()
    {
        return $this->hasMany('App\Models\Etape');
    }

    public function getStatusAttribute(){
        $data =['name'=>'Arreté','color'=>'danger'];
        if($this->active){
            $data =['name'=>'En cours','color'=>'success'];
        }
        return $data;
    }


}
