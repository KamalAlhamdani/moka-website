{{-- TODO: fix rtl problem of the tooltip --}}

@php($is_favorited = !is_null(\App\UserFavorite::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first()) ? true : false)

@if(Auth::check())
<form id="add_product_fav_{{$product->id}}" action="{{ !$is_favorited ? route('web.favorite.post') : route('web.favorite.del', $product->id) }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value='{{ $product->id }}'>
</form>
<span class="add-favorite {{ !$is_favorited ? '' : 'added'}}">
    <a dir="rtl"
    href="javascript:void(0);"
    data-title="Add to favorites"
    data-title-added="Added to favorites list"
    onclick="event.preventDefault();document.getElementById('add_product_fav_{{$product->id}}').submit();">
    <i class="icon icon-heart"></i></a>
</span>
@endif
