<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class DebiteurResource extends JsonResource
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
            'link'=>'/admin/suivi/client/'.$this->id,
            'montant'=>number_format($this->montant_facture - $this->montant_paye,0,',','.')
        ];
    }
}
