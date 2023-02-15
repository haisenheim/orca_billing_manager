<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderLineResource extends JsonResource
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
            'quantity'=>$this->quantity,
            'price'=>$this->price?$this->price:0,
            'product'=>new ProductResource($this->article),
            'total'=>$this->total,
        ];
    }
}
