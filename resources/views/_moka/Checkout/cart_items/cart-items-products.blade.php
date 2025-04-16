@foreach ( $getCartProductItems as $item)
    <div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
        <div class="image">
            <a href="{{ route('products.details', $item->product->id) }}"><img loading="lazy" src="{{domainAsset('storage/thumbnail/360/'.$item->product->image) }}" alt="{{$item->product->name}}" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';" /></a>
        </div>
        <div class="title" style="padding: 0 50px;">
            <div class="h4"><a href="{{ route('products.details', $item->product->id) }}">{{$item->product->name}}</a></div>
            {{-- <div>{{$item->price->unitName}}</div> --}}
            <div>{{$item->tasteName}}</div>
            <div>{{$item->unit->name}}</div>
        </div>
        <form action="{{ route('web.cart.post') }}" method="post">
            @csrf
            {{-- <input type="hidden" name="id" value='{{ $item->price->id}}'> --}}
            <input type="hidden" name="id" value='{{ $item->id}}'>
            <input type="hidden" name="type" value="{{ 'product' }}">
            <div class="quantity">
                <input type="number" name="quantity" value="{{$item->quantity}}" class="form-control form-quantity" min="1"/>
            </div>
            <div class="quantity">
                <input type="submit" value="{{__('update')}}" class="form-control form-quantity btn btn-checkout btn-main" />
            </div>
        </form>

        <div class="price">
            {{-- <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->price->price}}</span> --}}
            <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->price}}</span>
            {{-- TODO: if needed descount --}}
            {{-- <span class="discount">$ 2.666</span> --}}
        </div>
        <!--delete-this-item-->
        {{-- <form id="delete_cart_item_{{$item->product->id}}" action="{{ route('web.cart.delete', $item->cart_item_id) }}" method="post"> --}}
        <form id="delete_cart_item_{{$item->pivot->id}}" action="{{ route('web.cart.delete', $item->pivot->id) }}" method="post">
            @csrf
            {{-- <input type="hidden" name="id" value="{{$item->cart_item_id}}"> --}}
            <input type="hidden" name="id" value="{{$item->id}}">
        </form>
        {{-- <a href="{{ route('web.cart.delete', $item->cart_item_id) }}" onclick="event.preventDefault();document.getElementById('delete_cart_item_{{$item->product->id}}').submit();"> --}}
        <a href="{{ route('web.cart.delete', $item->pivot->id) }}" onclick="event.preventDefault();document.getElementById('delete_cart_item_{{$item->pivot->id}}').submit();">
            <span class="icon icon-cross icon-delete">
                {{-- <button type="button" form="delete_cart_item_{{$item->product->id}}" class="hidden btn btn-block btn-main"></button> --}}
                <button type="button" form="delete_cart_item_{{$item->pivot->id}}" class="hidden btn btn-block btn-main"></button>
            </span>
        </a>
    </div>
@endforeach
