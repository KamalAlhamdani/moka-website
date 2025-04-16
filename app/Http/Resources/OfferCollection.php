<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Lang;

class OfferCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'data' => $this->collection->transform(
                function ($page) {
                    return [
                        "id" => $page->id,
                        "old_price" => $page->old_price,
                        /* TODO: It shows the name only in 
                         * blade _moka.home.newProducts.blade.php, 
                         * so if you change the storage/thumbnail 
                         * do the same change in the blade
                         */
                        "price" =>  $page->price,
                        // "image_path" => domainAsset('storage/offers/slider/' . $page->image),
                        "image_path" => domainAsset('storage/' . $page->image),
                        "name" => $page->name,
                        "type" => $page->type,
                        "offer_product" => $page->offerProduct, //modified
                    ];
                }
            ),
        ];
    }
}
