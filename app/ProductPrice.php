<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use App\Product;

class ProductPrice extends Model
{


    use  Notifiable;

    use SoftDeletes;
    //protected $with = ['product'];
    public $appends = ['productName','productNumber','unitName', 'tasteName','productLink','quantity', 'image_path'];



    protected $hidden = [
        'product_id',
        'taste_id',
        'unit_id',
        'quantity',
        'unit',
        'taste',
        'note',
        "created_at",
        "updated_at",
        "deleted_at",
        "product"
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
    public function taste()
    {
        return $this->belongsTo('App\Taste');
    }


    public function getProductNameAttribute()
    {
        return $this->product->name;

    }public function getProductNumberAttribute()
    {
        return $this->product->number;

    }

    public function getUnitNameAttribute()
    {
        return $this->unit->name;
    }
    public function getTasteNameAttribute()
    {
        return $this->taste->taste;
    }
    // public function getProductNameAttribute()
    // {
    //     return $this->product->name;
    // }
    public function getProductLinkAttribute()
    {
        return domainAsset('storage/thumbnail/'.$this->product->image);

    }

    public  function getQuantityAttribute()
    {
        if (isset($this->pivot))
            return $this->pivot->quantity + 0;
        $this->addHidden(['quantity']);
    }
    public  function getImagePathAttribute()
    {
        return domainAsset('storage/' . $this->image);
    }

    /**
     * Scope a query to only include available products for order.
     * status 1 = available, status 0 = unavailable
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean                               $status
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @BySwadi important
     */
    public function scopeOrderAvailability($query, $status = 1)
    {
        return
        isset($status)
        ? $query->where('order_availability', $status)
        : $query;
    }
}
