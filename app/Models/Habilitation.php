<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilitation extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User');
    }



}
