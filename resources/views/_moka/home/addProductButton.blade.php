{{-- Add the product price only not product --}}
<div class="btn btn-add">
    {{-- This condition to chack if the product has prices or not --}}
    @if(isset($product->prices[0]))
    <form id="add_product_{{  $product->id }}" action="{{ route('web.cart.post') }}" method="post">
        @csrf
        {{-- TODO: selected price --}}
        <input type="hidden" name="id" value='{{ $product->prices[0]->id }}'>
        <input type="hidden" name="type" value="{{ 'product' }}">
        {{-- use the unary plus operator to convert quantities to numbers first.  --}}
        {{-- <input class="form-control form-quantity" name="quantity" type="number" value="1" min="0" onchange="+(document.getElementById('product-quantity').value) += +(this.value))">
        <input id="product-quantity" name="quantity" type="hidden" value="1" min="0"> --}}
        <input id="product-quantity" name="quantity" type="hidden" value="1" min="1">
    </form>
    {{-- <a href="{{ route('web.cart.post') }}" onclick="event.preventDefault();document.getElementById('add_product_{{  $product->id }}').submit();">
        <button type="button" form="add_product_{{  $product->id }}" class="btn btn-block btn-main">
            <i class="icon icon-cart"></i>
        </button>
    </a> --}}
    @endif
    @if(count($product->prices) == 1)
    <a href="{{ route('web.cart.post') }}" onclick="event.preventDefault();document.getElementById('add_product_{{  $product->id }}').submit();">
        <i class="icon icon-cart"></i>
    </a>
    @else
    <a href="{{ route('products.details', $product->id) }}">
        <i class="icon icon-cart"></i>
    </a>
    @endif
</div>
