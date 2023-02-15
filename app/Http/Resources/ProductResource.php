<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'ref'=>$this->ref,
            'photo'=>$this->photo,
            'quantity'=>$this->quantity,
            'price'=>$this->price?$this->price:0,
            'description'=>$this->description,
            'category'=>new CategoryListResource($this->category),
        ];
    }
}
