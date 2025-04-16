<?php

namespace App;

use App\Http\Resources\CartProductResource;
use App\Http\Resources\CartOfferResource;
use App\Http\Resources\CartSpecialProductResource;
use App\Http\Resources\CartSpecialHospitalityResource;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id','status'
    ];
     public $with = ['cartProductItems','cartOfferItems','cartSpecialItems','cartHospitalityItems'];

     protected $hidden = [
         'id',
         'user_id',
        "created_at",
        "updated_at",
        "deleted_at",
     ];


    // public function product()
    // {
    //     return $this->hasOneThrough('App\ProductPrice', 'App\Product');
    // }
    protected $appends = ['price_sum', 'items_count', 'items_count_web'];
    public function cartProductItems()
    {
        //by sara mohammed
        return $this->belongsToMany('App\ProductPrice','cart_details')->using('App\CartDetail')->withPivot([
            'id','quantity','product_price_id'
        ]);
    }
    public function cartProductItemsSys()
    {
        //by sara mohammed
        return $this->belongsToMany('App\ProductPrice','cart_details')->using('App\CartDetail');
    }
    public function cartOfferItems()
    {
        return $this->belongsToMany('App\Offer','cart_details')->using('App\CartDetail')->withPivot([
            'id', 'quantity'
        ]);;
    }

    public function cartSpecialItems()
    {
        return $this->belongsToMany('App\SpecialProduct','cart_details')->using('App\CartDetail')->withPivot([
            'id', 'quantity'
        ]);;
    }

    public function cartHospitalityItems()
    {
        return $this->belongsToMany('App\Hospitality','cart_details')->using('App\CartDetail')->withPivot([
            'id', 'quantity'
        ]);
    }

    //problem solve http://192.168.191.1:8000/api/request/29
    //the request details did not appear and this is her solve
    public function getItemsCountAttribute(){

    $count = 0;
    $count = (
            count(CartProductResource::collection($this->cartProductItems))+
            count(CartOfferResource::collection($this->cartOfferItems))+
            count(CartSpecialProductResource::collection($this->cartSpecialItems))+
            count(CartSpecialHospitalityResource::collection($this->cartHospitalityItems))
            );


        return $count;
    }
    /**
     * This function count for web only cart products and offers
     */
    public function getItemsCountWebAttribute() {
         $count = 0;

         $count = (
                count(CartProductResource::collection($this->cartProductItems))+
                count(CartOfferResource::collection($this->cartOfferItems))
                );

         return $count;
    }



    public function getPriceSumAttribute()
    {
        return $this->cartProductItems->sum(function ($item) {
            return $item['price'] * $item['pivot']['quantity'];
        })
        + $this->cartOfferItems->sum(function ($item) {
            return $item['price'] * $item['pivot']['quantity'];
        })
        + $this->cartSpecialItems->sum(function ($item) {
            return $item['price'] * $item['pivot']['quantity'];
        })
        + $this->cartHospitalityItems->sum(function ($item) {
            return $item['total_price'];
        });

    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
