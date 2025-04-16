<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
// dd($this->offerProduct);
        return [
            "cart_item_id"=> $this->pivot->id,
            "product_price_id"=> $this->pivot->special_product_id,
            "quantity"=> $this->pivot->quantity,
            "product"=> [
                "id"=> $this->id,
                "old_price"=> $this->old_price,
                "price"=> $this->price,
                "name"=> $this->name,
                "image_path"=> $this->image_path,
                //by sara mohammed
                'type'=>$this->type,
                'offer_product'=>$this->offerProduct
            ],
            "hasChanged"=>false
    ];
    }
}
