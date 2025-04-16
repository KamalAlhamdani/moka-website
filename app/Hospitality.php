<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Hospitality extends Model
{
    use Notifiable;

    protected $fillable = [
        'name','desc','date','boxing_type_id','total_price','details','user_id','quantity'
    ];

    public $appends = ['quantity'];
    protected $hidden = [
        'user_id',
        'created_at',
        "updated_at",
        "deleted_at",
        'status',
        'quantity',
    ];

    public function hospitalityDetail()
    {
        return $this->belongsToMany('App\Product','hospitality_details')->using('App\Hospitality_Detail');
    }

    public  function getQuantityAttribute()
    {
        return $this->pivot->quantity+0;
    }

    /**
     * To use other notification table
     */
    public function notifications()
    {
        return $this->morphMany(\App\SystemNotification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }
}
