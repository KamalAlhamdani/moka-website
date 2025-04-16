<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class PointHistory extends Model 
{
    
    use  Notifiable;

    use SoftDeletes;

    protected $hidden = [
        "updated_at",
        "deleted_at",
    ];

    protected $fillable = [
        'user_id', 'gain_method_id','price'
    ];
    public $with = ['GainMethod'];

    public function GainMethod()
    {
        //return $this->hasManyThrough('App\GainType','App\GainMethod' );
        return $this->belongsTo('App\GainMethod','gain_method_id');
    }
    
}
