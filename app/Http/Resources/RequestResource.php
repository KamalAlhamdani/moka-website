<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CartResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class RequestResource extends ResourceCollection
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

            'success' => true,
            'data' => $this->collection->transform(function ($page) {
                return [
                    'id'=> $page->id,
                    'payment_type' => $page->payment_type,
                    'receiving_type' => $page->receiving_type,
                    'request_note' => $page->note,
                    'request_carrier' => $page->carrier_id,
                    'status' => $page->status,
                    'cart_id' => $page->cart_id,
                    'payment_sum' => $page->payment_sum,
                    'deliveryPrice' => $page->deliveryPrice,
                    'remain_amount' => $page->cache_payment,
                    'created_at' => $page->created_at,
                    'updated_at' => $page->updated_at,
                    'request_items' => new CartResource($page->requestItems),
                    'user' => $page->requestItems->user,
                    "coupon" => $page->coupon,
                    // "address" => $page->address,
                    "address" => $page->addressWithTrashed,
                    "branch" => $page->branch,

                ];
            }),
        ];
    }
}
