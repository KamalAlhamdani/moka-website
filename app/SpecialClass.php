<?php
/**
 * Models
 * php version 7.3.1.
 *
 * @category Apis
 *
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 *
 * @link     Moka_Sweets https://www.mokasweets.com/
 */

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Models
 * php version 7.3.1.
 *
 * @category Apis
 *
 * @author   BySwadi <muath.ye@gmail.com>
 * @license  IC https://www.infinitecloud.co
 *
 * @link     Moka_Sweets https://www.mokasweets.com/
 */
class SpecialClass extends Model implements TranslatableContract
{
    use Translatable;
    use Notifiable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'special_classes';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'translations',
        'created_at',
        'updated_at',
        'deleted_at',
        'image',
    ];

    /**
     * The attributes that are translated.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'details', 'image'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_path'];

    /**
     * Get image path.
     *
     * @return string
     */
    public function getImagePathAttribute()
    {
        return is_null($this->image) ? '' : domainAsset($this->image);
    }
}
