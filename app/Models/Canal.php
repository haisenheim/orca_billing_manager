<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    //
    protected $guarded = [];
    protected $table ='canaux';

    public function modeles()
    {
        return $this->hasMany('App\Models\Modeles');
    }


}
