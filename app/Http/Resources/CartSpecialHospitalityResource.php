<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartSpecialHospitalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "cart_item_id"=> $this->pivot->id,
            "product_price_id"=> $this->pivot->special_product_id,
            "quantity"=> $this->pivot->quantity,
            "product"=> [
                "id"=> $this->id,
                "name"=> $this->name,
                "desc"=> $this->desc,
                "price"=> $this->total_price,
                "note"=> $this->note,
                "image_path"=> $this->image_path,
            ],
            "hasChanged"=>false
    ];
    }
}
