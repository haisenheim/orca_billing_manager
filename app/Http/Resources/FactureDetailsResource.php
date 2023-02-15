<?php

namespace App\Http\Resources;

use App\Models\Paiement;
use Illuminate\Http\Resources\Json\JsonResource;

class FactureDetailsResource extends JsonResource
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
            'montant'=> number_format($this->montant,0,',','.'),
            'encaissement'=> number_format($this->encaissement,0,',','.'),
            'solde'=> number_format($this->solde,0,',','.'),
            'dt'=>$this->delivered_at?date_format($this->delivered_at,'d/m/Y'):'non definie',
            'echeances'=>EcheanceResource::collection($this->echeances),
            'paiements'=>PaiementResource::collection($this->paiements),
            'raw'=>EcheanceRawResource::collection($this->echeances),

        ];
    }
}
