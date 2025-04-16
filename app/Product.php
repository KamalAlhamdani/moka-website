<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Notifications\Notifiable;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use Translatable;


    use  Notifiable;

    use SoftDeletes;

    public $translatedAttributes = ['name', 'details', 'image', 'taste'];

    public  function getQuantityAttribute()
    {
        return $this->pivot->quantity + 0;
    }

    public  function getLinkAttribute()
    {
        return  route('product.show', ['id' => $this->id]);
    }

    public  function getIsFavAttribute()
    {
        return  $this->id;
    }


    // commented to solve many request issue
    // TODO: try to come here if you face a problem with products
    //protected $with = ['category', 'prices', 'favorite'];

    protected $appends = ['link'];

    protected $hidden = [
        'status',
        "type",
        "category_id",
        "created_at",
        "updated_at",
        "deleted_at",
        'pivot',
        'translations'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }



    public function prices()
    {
        return $this->hasMany('App\ProductPrice')
            ->orderAvailability();
    }

    public function favorite()
    {
        return $this->belongsToMany('App\User', 'user_favorites')->using('App\UserFavorite')
            ->withPivot([
                'product_id',
                'user_id'
            ]);
    }


    public function scopeNew($query)
    {
        return $query->where('is_new', 1);
    }

    public function scopeOfSearch($query, $request)
    {
        if (!empty($request->search)) {
            $searchFields = ['name'];
            return  $query
            ->available()
            ->ofActiveCategory()
            ->where(function ($query) use ($request, $searchFields) {
                $searchWildcard = '%' . $request->search . '%';
                foreach ($searchFields as $field) {
                    $query->whereTranslationLike($field,  $searchWildcard);
                }
            });
        }

        // if(isset($request->search))
        // return $query->where('name','like', '$request->search');
        return $query;
    }

    public function cartDetail()
    {
        return $this->belongsToMany('App\Cart', 'cart_details')->using('App\CartDetail')->withPivot(
            'quantity'
        )->orderBy('quantity', 'desc');;
    }

    public function cartDetail1()
    {
        return $this->hasOneThrough('App\Product', 'App\Cart');
    }

    public function mostSellProduct()
    {
        return $this->belongsToMany('App\Cart', 'cart_details')->using('App\CartDetail')
            ->selectRaw('count(quantity) as aggregate')
            ->groupBy('product_id');
    }




    /**
     * Already defined
     * -------------------------------------------------------------------
     * Scope a query to only include products of a given [product.is_new].
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @function scopeOfSearch()
     */

    /**
     * Already defined[needed]
     * -------------------------------------------------------------------
     * Scope a query to only include products of a given [product.is_new].
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean                               $is_new
     *
     * @return   \Illuminate\Database\Eloquent\Builder
     * @function scopeNew() used for api
     * @BySwadi  for filters in products page
     */
    public function scopeIsNew($query, $is_new)
    {
        return isset($is_new->is_new) && $is_new->is_new !== 0 ? $query->where('is_new', 1) : $query;
    }

    /**
     * Scope a query to only include products of a given [product.type].
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $type
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @BySwadi for filters in products page
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include products of a given [product.category_id].
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $category_id
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @BySwadi for filters in products page
     */
    public function scopeOfCategory($query, $category_id)
    {
        return
        isset($category_id->category_id) && $category_id->category_id !== 0
        ? $query->where('category_id', $category_id->category_id)
        : $query;
    }

    /**
     * Scope a query to only include available products.
     * status 1 = available, status 0 = unavailable
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean                               $status
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @BySwadi important
     */
    public function scopeAvailable($query, $status = 1)
    {
        return
        isset($status)
        ? $query->where('status', $status)
        : $query;
    }

    /**
     * Scope a query to only include public products.
     * type 1 = public, type 0 = private
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean                               $type
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @BySwadi important
     */
    public function scopePublic($query, $type = 1)
    {
        return
        isset($type)
        ? $query->where('type', $type)
        : $query;
    }

    /**
     * Retrieve the products that are from active category
     *
     * @param \Illuminate\Database\Eloquent\Builder $query .
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfActiveCategory($query)
    {
        $categories_id = Category::where('status', 1)->pluck('id');

        return $query->whereIn('category_id', $categories_id);
    }
}
