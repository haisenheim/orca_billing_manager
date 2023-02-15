<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EcheanceRawResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date'=> date_format($this->dt,'Y-m-d'),
            'montant'=>$this->montant,
            'remove'=>$this->encaissement?false:true,
        ];
    }
}
