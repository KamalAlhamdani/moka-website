<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitality_Detail extends Model
{
    protected $fillable = [
        'hospitality_id','product_price_id','product_quantity'
    ];

    protected $table = 'hospitality_details';
}
