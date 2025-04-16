<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OfferDetail extends Pivot
{
    protected $table = 'offer_details';

    public function offerProduct()
    {
        return $this->belongsTo('App\Product');
    }
}
