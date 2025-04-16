{{-- This used in details.blade.php --}}
@if(Auth::check())
    <div class="info-box info-box-addto {{ !$product_details->favorite->count() ?'': 'added'}} ">
        {{-- TODO: make ajax request for favorite adding and removing --}}
        <form id="add_product_fav" action="{{ !$product_details->favorite->count() ? route('web.favorite.post') : route('web.favorite.del', $product_details->id) }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value='{{ $product_details->id }}'>
        </form>
        <span><strong>{{ __('_moka_products.favorite') }}</strong></span>
        {{-- <a href="javascript:{}" onclick="event.preventDefault();document.getElementById('add_product_fav').submit();"> --}}
            <span>
                <i class="add"   onclick="event.preventDefault();document.getElementById('add_product_fav').submit();"><i class="fa fa-heart-o"></i> {{ __('_moka_products.add_to_favorites') }}</i>
                <i class="added" onclick="event.preventDefault();document.getElementById('add_product_fav').submit();"><i class="fa fa-heart"></i> {{ __('_moka_products.remove_from_favorites') }}</i>
            </span>
        {{-- </a> --}}

    </div>
@endif
