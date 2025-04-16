@foreach ( \Cart::getCartProductItems() as $item)
    <div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
        <div class="image">
            <a href="{{ route('products.details', $item->product->id) }}"><img loading="lazy" src="{{domainAsset('storage/thumbnail/'.$item->product->image) }}" alt="{{$item->product->name}}" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';" /></a>
        </div>
        <div class="title" style="padding: 0 50px;">
            <div class="h4"><a href="{{ route('products.details', $item->product->id) }}">{{$item->product->name}}</a></div>
            {{-- <div>{{$item->price->unitName}}</div> --}}
            <div>{{$item->tasteName}}</div>
            <div>{{$item->unit->name}}</div>
        </div>
        <div class="quantity">
            <strong>{{$item->quantity}}</strong>
        </div>
        <div class="price">
            {{-- <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->price->price}}</span> --}}
            <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->price}}</span>
            {{-- TODO: if needed descount --}}
            {{-- <span class="discount">$ 2.666</span> --}}
        </div>
    </div>
@endforeach
