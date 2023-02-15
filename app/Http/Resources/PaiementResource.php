<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaiementResource extends JsonResource
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
            'name' => $this->name,
            'date'=>date_format($this->done_at,'d/m/Y'),
            'montant'=> number_format($this->montant,0,',','.'),
            'echeance'=>$this->echeance?new EcheanceResource($this->echeance):null,
            'mode'=>$this->mode?$this->mode->name:'-',
        ];
    }
}
