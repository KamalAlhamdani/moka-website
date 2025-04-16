<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Notifications\Notifiable;
class SpecialProduct extends Model
{
    use SoftDeletes, Notifiable;
    
    protected $fillable = [
        'name', 'desc', 'user_id',"image" , 'date','show_case_id',
    ];
    public $appends = ['quantity','image_path', 'table_name'];

    protected $hidden = [
        'user_id',
        'created_at',
        "updated_at",
        "deleted_at",
        'status',
        'image',
        'quantity',
    ];

    public  function getQuantityAttribute()
    {
        return $this->pivot->quantity+0;
    }

    public  function getImagePathAttribute()
    {
        return domainAsset('storage/'.$this->image);
    }

    /**
     * Get This Table name
     * 
     * @return string
     */
    public function getTableNameAttribute()
    {
        return $this->table();
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
