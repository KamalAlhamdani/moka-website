<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Offer extends Model implements TranslatableContract
{
    use Translatable;


    use  Notifiable;

    use SoftDeletes;

    public $translatedAttributes = ['name','image'];

    public $with = ['type',];
    public $appends = ['quantity', 'note', 'image_path'];


    protected $hidden = [
        'status',
        'translations',
        'start_date',
        "end_date",
        "type_id",
        "created_at",
        "updated_at",
        "deleted_at",
        'quantity',
    ];

    public function type()
    {
        return $this->belongsTo('App\OfferType');
    }

    public function cartDetail()
    {
        return $this->belongsToMany('App\Cart','cart_details')->using('App\CartDetail');
    }

    public function offerProduct()
    {
        return $this->belongsToMany('App\Product','offer_details')->using('App\OfferDetail');
    }
    // protected $appends = ['type'];
    public  function getQuantityAttribute()
    {
        return $this->pivot->quantity+0;
    }

    public  function getNoteAttribute()
    {
        return $this->pivot->note;
    }
    public  function getImagePathAttribute()
    {
        return domainAsset('storage/'.$this->image);
    }
    // public  function getTypeAttribute()
    // {
    //     return $this->type();
    // }
}
