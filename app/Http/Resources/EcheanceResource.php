<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EcheanceResource extends JsonResource
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
            'name' => date_format($this->dt,'d/m/Y').' - '.number_format($this->montant,0,',','.'),
            'date'=> date_format($this->dt,'d/m/Y'),
            'montant'=>number_format($this->montant,0,',','.'),
            'versement'=>number_format($this->encaissement,0,',','.'),
            'reste'=>number_format($this->reste,0,',','.'),
            'impaye'=>number_format($this->impaye,0,',','.'),
            'reste_total'=>$this->reste_total,
            'facture'=>new FactureResource($this->facture)

        ];
    }
}
