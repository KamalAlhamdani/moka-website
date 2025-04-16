<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CartProductResource;
use App\Http\Resources\CartOfferResource;
use App\Http\Resources\CartSpecialProductResource;
use App\Http\Resources\CartSpecialHospitalityResource;


class CartResource extends JsonResource
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
            "price_sum"=> $this->price_sum,
            /** TODO: do you want Hospitality to counted */
            "items_count"=>
                count(CartProductResource::collection($this->cartProductItems))
                +count(CartOfferResource::collection($this->cartOfferItems))
                +count(CartSpecialProductResource::collection($this->cartSpecialItems)),
            "cart_id"=>$this->id,
            'cart_product_items'=>CartProductResource::collection($this->cartProductItems),
            "cart_offer_items"=> CartOfferResource::collection($this->cartOfferItems),
            "cart_special_items"=> CartSpecialProductResource::collection($this->cartSpecialItems),
            "cart_hospitality_items"=> CartSpecialHospitalityResource::collection($this->cartHospitalityItems),
    ];
    }
}
