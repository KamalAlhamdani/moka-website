<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class Request extends Model
{
    use Notifiable;

    protected $fillable = [
        'payment_type', 'receiving_type', 'address_id', 'branch_id', 'cart_id', 'note', 'delivery_price_id', 'cache_payment', 'coupon_id'
    ];


    protected $hidden = [
        'is_active', 'note', 'deleted_at',
        //"updated_at",
        "branch_id", "admin_id", "carrier_id", "address_id", "coupon_id",
        "laravel_through_key",'status',
    ];

    protected $with = ['requestItems', 'coupon', 'address', 'addressWithTrashed', 'branch', 'requestItems.user'];

    protected $appends = ['payment_sum', 'deliveryPrice'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function requestItems()
    {
        return $this->belongsTo('App\Cart', "cart_id");
    }

    public function payment()
    {
        return $this->hasMany('App\BalanceTransaction');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Coupon', "coupon_id");
    }

    public function address()
    {
        return $this->belongsTo('App\UserAddress', "address_id");
    }
    public function addressWithTrashed()
    {
        return $this->belongsTo('App\UserAddress', "address_id")->withTrashed();
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', "branch_id");
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin', "admin_id");
    }

    public function carrier()
    {
        return $this->belongsTo('App\Carrier', "carrier_id");
    }
    public function deliveryPriceings()
    {
        return $this->belongsTo('App\DeliveryPricing', "delivery_price_id");
    }

    public function getPaymentSumAttribute()
    {
        return $this->payment()->sum('amount');
    }
    public function getDeliveryPriceAttribute()
    {
        return $this->deliveryPriceings()->sum('price');
    }

    //BySwadi: search for delivered and updated_at
    public function scopeOfDeliveredAt($query, $request)
    {
        if (!empty($request)) {
            $searchFields = ['updated_at'];
            $searchWildcard = '%' . $request->updated_at . '%';
            // return  $query->where($searchFields,'like', $searchWildcard);
            return  $query->where($searchFields, $request);
            // return  $query->whereDate('updated_at', '=', Carbon::today()->toDateString());
        }

        // if(isset($request->search))
        // return $query->where('name','like', '$request->search');
        return $query;
    }

    /**
     * To use other notification table
     */
    public function notifications()
    {
        return $this->morphMany(\App\SystemNotification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }

    /**
     * To Get rating status
     */
    public function rated()
    {
        $rates = Rate::where('request_id', $this->id)->first();
        return $rates == null ? 0 : 1;
    }
}
