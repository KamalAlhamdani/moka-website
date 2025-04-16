@foreach ( \Cart::getCartProductItems() as $item)
<div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
    <div class="image">
        <a href="{{ route('products.details', $item->product->id) }}"><img loading="lazy" src="{{domainAsset('storage/thumbnail/'.$item->product->image) }}" alt="{{$item->product->name}}" /></a>
    </div>
    <div class="title" style="padding: 0 50px;">
        <div class="h4"><a href="{{ route('products.details', $item->product->id) }}">{{$item->product->name}}</a></div>
        <div>{{$item->price->unitName}}</div>
    </div>
    <div class="quantity">
        <strong>{{$item->quantity}}</strong>
    </div>
    <div class="price">
        <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->price->price}}</span>
        {{-- TODO: if needed descount --}}
        {{-- <span class="discount">$ 2.666</span> --}}
    </div>
</div>
@endforeach

@foreach( \Cart::getCartOfferItems() as $item)
<div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
    <div class="image">
        <a href="{{ route('offers.details', $item->product->id) }}"><img loading="lazy" src="{{ $item->product->image_path }}" alt="{{$item->product->name}}" /></a>
    </div>
    <div class="title" style="padding: 0 50px;">
        <div class="h4"><a href="{{ route('offers.details', $item->product->id) }}">{{$item->product->name}}</a></div>
        {{-- TODO: offer type --}}
        {{-- <div>{{$item->price->unitName}}</div> --}}
    </div>
    <div class="quantity">
            <strong>{{$item->quantity}}</strong>
    </div>
    <div class="price">
        <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->product->price}}</span>
        {{-- TODO: if needed descount --}}
        {{-- <span class="discount">$ 2.666</span> --}}
    </div>
</div>
@endforeach

@foreach( \Cart::getCartSpecialItems() as $item)
<div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
    <div class="image">
        <a href="#"><img loading="lazy" src="{{ $item->product->image_path }}" alt="{{$item->product->name}}" /></a>
    </div>
    <div class="title" style="padding: 0 50px;">
        <div class="h4"><a href="#">{{$item->product->name}}</a></div>
        {{-- TODO: offer type --}}
        {{-- <div>{{$item->price->unitName}}</div> --}}
    </div>
    <div class="quantity">
        <strong>{{$item->quantity}}</strong>
    </div>
    <div class="price">
        <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->product->price}}</span>
        {{-- TODO: if needed descount --}}
        {{-- <span class="discount">$ 2.666</span> --}}
    </div>
</div>
@endforeach

@foreach( \Cart::getCartHospitalityItems() as $item)
<div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
    <div class="image">
        <a href="#"><img loading="lazy" src="{{ $item->product->image_path }}" alt="{{$item->product->name}}" /></a>
    </div>
    <div class="title" style="padding: 0 50px;">
        <div class="h4"><a href="#">{{$item->product->name}}</a></div>
        {{-- TODO: offer type --}}
        {{-- <div>{{$item->price->unitName}}</div> --}}
    </div>
    <div class="quantity">
        <strong>{{$item->quantity}}</strong>
    </div>
    <div class="price">
        <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->product->price}}</span>
        {{-- TODO: if needed descount --}}
        {{-- <span class="discount">$ 2.666</span> --}}
    </div>
</div>
@endforeach
