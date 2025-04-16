@foreach( \Cart::getCartHospitalityItems() as $item)
    <div class="cart-block cart-block-item clearfix" style="padding: 15px 10px;">
        <div class="image">
            <label type="submit" class="label label-primary"> {{__('_moka_checkout.hospitality_order')}} </label>
            {{-- <a href="#"><img loading="lazy" src="{{ $item->image_path ?? asset('moka-assets/assets/images/defualt.png') }}" alt="{{$item->name}}" /></a> --}}
        </div>
        <div class="title" style="padding: 0 50px;">
            <div class="h4"><a href="#">{{$item->name}}</a></div>
            {{-- TODO: offer type --}}
            {{-- <div>{{$item->price->unitName}}</div> --}}
        </div>
        <div class="quantity">
            <strong>{{$item->quantity}}</strong>
        </div>
        <div class="price">
            <span class="final h3" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{$item->price}}</span>
            {{-- TODO: if needed descount --}}
            {{-- <span class="discount">$ 2.666</span> --}}
        </div>
    </div>
@endforeach
