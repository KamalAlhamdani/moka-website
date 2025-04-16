@foreach( \Cart::getCartOfferItems() as $item)
    <div class="cart-block cart-block-item clearfix">
        <div>
            <!--delete-this-item-->
            {{-- <form id="delete_cart_item_{{$item->product->id}}" action="{{ route('web.cart.delete', $item->cart_item_id) }}" method="post"> --}}
            <form id="delete_cart_item_{{$item->id}}" action="{{ route('web.cart.delete', $item->pivot->id) }}" method="post">
                @csrf
                {{-- <input type="hidden" name="id" value="{{$item->cart_item_id}}"> --}}
                <input type="hidden" name="id" value="{{$item->pivot->id}}">
            </form>
            {{-- <a href="{{ route('web.cart.delete', $item->cart_item_id) }}" onclick="event.preventDefault();document.getElementById('delete_cart_item_{{$item->product->id}}').submit();"> --}}
            <a href="{{ route('web.cart.delete', $item->pivot->id) }}" onclick="event.preventDefault();document.getElementById('delete_cart_item_{{$item->id}}').submit();">
                <span class="icon icon-cross icon-delete">
                    {{-- <button type="button" form="delete_cart_item_{{$item->product->id}}" class="hidden btn btn-block btn-main"></button> --}}
                    <button type="button" form="delete_cart_item_{{$item->id}}" class="hidden btn btn-block btn-main"></button>
                </span>
            </a>
        </div>
        <div class="image">
            {{-- <a href="{{ route('offers.details', $item->product->id) }}"><img loading="lazy" src="{{ $item->product->image_path }}" alt="{{$item->product->name}}" /></a> --}}
            <a href="{{ route('offers.details', $item->id) }}"><img loading="lazy" src="{{ $item->image_path }}" alt="{{$item->name}}" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';" /></a>
        </div>
        <div class="title">
            {{-- <div><a href="{{ route('offers.details', $item->product->id) }}">{{$item->product->name}}</a></div> --}}
            <div><a href="{{ route('offers.details', $item->id) }}">{{$item->name}}</a></div>
            {{-- TODO: offer type --}}
            {{-- <small>{{$item->price->unitName}}</small> --}}
        </div>
        <div class="quantity">
            {{-- <span class="final">{{ $item->quantity }}</span> --}}
            <input disabled type="number" min="0" value="{{$item->quantity}}" class="form-control form-quantity" style="width: 100px;"/>
        </div>
        <div class="price">
            {{-- <span class="final">{{$item->product->price}}</span> --}}
            <span class="final">{{$item->price}}</span>
        </div>

    </div>
@endforeach
