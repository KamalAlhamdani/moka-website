<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProductResource extends JsonResource
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
            return [
                "cart_item_id"=> $this->pivot->id,
                "product_price_id"=> $this->pivot->product_price_id,

                //by sara mohammed
                "price"=>$this->product->prices->where('id',$this->pivot->product_price_id)->first(),
                "quantity"=> $this->pivot->quantity,
                "product"=> $this->product,
                "hasChanged"=>false
        ];
    }
}
