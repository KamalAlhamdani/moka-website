<form id="add_product_{{  $price->id }}" action="{{ route('web.cart.post') }}" method="post">
    @csrf
    {{-- TODO: selected price --}}
    <input type="hidden" name="id" value='{{ $price->id }}'>
    <input type="hidden" name="type" value="{{ 'product' }}">
    {{-- use the unary plus operator to convert quantities to numbers first.  --}}
    {{-- <input class="form-control form-quantity" name="quantity" type="number" value="1" min="0" onchange="+(document.getElementById('product-quantity').value) += +(this.value))"> --}}
    <input id="product-quantity" name="quantity" type="hidden" value="1" min="1">
    {{-- <input id="product-quantity" name="quantity" type="number" value="1" min="1"> --}}
</form>
<div class="btn btn-add" style="display:inherit;">
    <a href="{{ route('web.cart.post') }}" onclick="event.preventDefault();document.getElementById('add_product_{{  $price->id }}').submit();">
        <i class="icon icon-cart"></i>
    </a>
</div>
