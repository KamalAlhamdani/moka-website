<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


class CartDetail extends Pivot
{
    protected $table = 'cart_details';
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at",
     ];
}
