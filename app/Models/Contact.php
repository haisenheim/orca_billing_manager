<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $guarded = [];

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function poste(){
        return $this->belongsTo('App\Models\Poste');
    }

    public function getNameAttribute(){
        return $this->firstname.' '.$this->lastname;
    }

}
