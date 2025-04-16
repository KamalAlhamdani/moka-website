<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Lang;

class ProductCollection extends ResourceCollection
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
            'success'=>true,
            'data' => $this->collection->transform(function ($page) {
                // return route('product.show', ['id' => $page->id]);
                // $page->link = route('product.show', ['id' => $page->id]);
                // $page->favorite = $page->favorite->count() > 0 ? true : $this-> false; //BySwadi: to fix issue that products which are not in user_favorite table with a user, arise a pagination error.
                $favorite = $page->favorite->count() > 0 ? true : false; // This is the fixing of the problem

                //add by moath
                $more_pricese = $page->prices->count() == 1 ? false : true;
                $price        = $more_pricese ? null : $page->prices->first()->price;
                $priceId      = $more_pricese ? null : $page->prices->first()->id;

                return [
                    "id"           => $page->id,
                    "name"         => $page->name,
                    // TODO: It shows the name only in blade _moka.home.newProducts.blade.php, so if you change the storage/thumnail do the same change in the blade
                    "image"        => domainAsset('storage/thumbnail/'.$page->image),//$page->image,
                    "image64"      => domainAsset('storage/thumbnail/64/'.$page->image),//$page->image,
                    "image150"     => domainAsset('storage/thumbnail/150/'.$page->image),//$page->image,
                    "image360"     => domainAsset('storage/thumbnail/360/'.$page->image),//$page->image,
                    "image640"     => domainAsset('storage/thumbnail/640/'.$page->image),//$page->image,
                    "favorite"     => $favorite,
                    "is_new"       => (bool) $page->is_new,
                    "status"       => (boolean) $page->status,
                    "type"         => $page->type,
                    "prices"       => $page->prices, //modified
                    "more_pricese" => $more_pricese,
                    "price"        => $price,
                    "priceId"      => $priceId
                    
                    // Stop link because: Missing required parameters for [Route: product.show] [URI: api/product/{product}].
                    // "link"=> isset($page->link) ? $page->link : 'N/A',
             ];
            }
        ),
        ];
    }
}
