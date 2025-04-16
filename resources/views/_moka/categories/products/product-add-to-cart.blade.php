{{-- Add the product price only not product --}}
@if(config('app.internet_order'))
<div class="btn btn-add">
    <i class="icon icon-cart"></i>
    {{-- This condition to chack if the product has prices or not --}}

    @if(isset($product->prices[0]))
        <form id="add_product_{{  $i->id }}" action="{{ route('web.cart.post') }}" method="post">
            @csrf
            {{-- TODO: selected price --}}
            <input type="hidden" name="id" value='{{ $i->prices[0]->id }}'>
            <input type="hidden" name="type" value="{{ 'product' }}">
            {{-- use the unary plus operator to convert quantities to numbers first.  --}}
            {{-- <input class="form-control form-quantity" name="quantity" type="number" value="1" min="0" onchange="+(document.getElementById('product-quantity').value) += +(this.value))">
            <input id="product-quantity" name="quantity" type="hidden" value="1" min="0"> --}}
            <input id="product-quantity" name="quantity" type="hidden" value="1" min="1">
        </form>
        {{-- <a href="{{ route('web.cart.post') }}" onclick="event.preventDefault();document.getElementById('add_product_{{  $i->id }}').submit();">
            <button type="button" form="add_product_{{  $i->id }}" class="btn btn-block btn-main">
                <i class="icon icon-cart"></i>
            </button>
        </a> --}}


        @if(count($i->prices) == 1)
        <a href="{{ route('web.cart.post') }}" onclick="event.preventDefault();document.getElementById('add_product_{{  $i->id }}').submit();">
            <i class="icon icon-cart"></i>
        </a>
        @else
        <a href="{{ route('products.details', $i->id) }}">
            <i class="icon icon-cart"></i>
        </a>
        @endif

    @endif
    @endif
</div>
@endif
