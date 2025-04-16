{{-- TODO: fix rtl problem of the tooltip --}}

@php($is_favorited = !is_null(\App\UserFavorite::where('user_id', Auth::user()->id)->where('product_id', $i->id)->first()) ? true : false)

@if(Auth::check())
<form id="add_product_fav_{{$i->id}}" action="{{ !$is_favorited ? route('web.favorite.post') : route('web.favorite.del', $i->id) }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value='{{ $i->id }}'>
</form>
<span class="add-favorite {{ !$is_favorited ? '' : 'added'}}">
    <a dir="rtl"
    href="javascript:void(0);"
    data-title="Add to favorites"
    data-title-added="Added to favorites list"
    onclick="event.preventDefault();document.getElementById('add_product_fav_{{$i->id}}').submit();">
    <i class="icon icon-heart"></i></a>
</span>
@endif

{{-- <input type="hidden" name="product_id" value='{{ $i->id }}'> --}}
{{-- <input type="hidden" name="product_id" value='{{ $i->pivot->product_id }}'> --}}
{{-- {{$i->pivot}}
@if(Auth::check())
<form id="add_product_fav" action="{{ !$i->favorite->count() ? route('web.favorite.post') : route('web.favorite.del', $i->id) }}" method="post">
    @csrf

</form>
<span class="add-favorite {{ !$i->favorite->count() ?'': 'added'}}">
    <a dir="rtl"
    href="javascript:void(0);"
    data-title="Add to favorites"
    data-title-added="Added to favorites list"
    onclick="event.preventDefault();document.getElementById('add_product_fav').submit();">
    <i class="icon icon-heart"></i></a>
</span>
@endif --}}
