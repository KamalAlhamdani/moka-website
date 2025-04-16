{{-- This used in list.blade.php --}}
@if(Auth::check())
<form id="add_product_fav" action="{{ !$product_details->favorite->count() ? route('web.favorite.post') : route('web.favorite.del', $product_details->id) }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value='{{ $product_details->id }}'>
</form>
<span class="add-favorite {{ !$product_details->favorite->count() ?'': 'added'}}">
    <a dir="rtl"
    href="javascript:void(0);"
    data-title="Add to favorites"
    data-title-added="Added to favorites list"
    onclick="event.preventDefault();document.getElementById('add_product_fav').submit();">
    <i class="icon icon-heart"></i></a>
</span>
@endif
