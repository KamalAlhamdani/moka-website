@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - تفاصيل العرض')
@else
    @php($page_title = 'Moka Sweets - Offer Details')
@endif
@extends('layout.mainlayout')
@section('content')

    <!-- ======================== Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $sub_sub_link = 'تفاصيل العرض' : $sub_sub_link = 'Offer Details')
    @php(app()->getLocale() == 'ar' ? $sub_link = 'العروض' : $sub_link = 'Offers')
    <section class="main-header" style="filter: brightness(0.9);
    /* background-image:url({{asset('moka-assets/assets/images/headers/categories.png')}}) */
    ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $sub_sub_link }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="{{ url('/') }}"><span class="icon icon-home"></span></a></li>
                    <li><a href="{{ url('/offers') }}">{{ $sub_link }}</a></li>
                    <li><a class="active" href="#">{{ $sub_sub_link }}</a></li>
                </ol>
            </div>
        </header>
    </section>

    <!-- ========================  Product ======================== -->

    <section class="product">
        <div class="main">
            <div class="container">
                <div class="row product-flex">

                    <!-- product flex is used only for mobile order -->
                    <!-- on mobile 'product-flex-info' goes bellow gallery 'product-flex-gallery' -->

                    <div class="col-md-4 col-sm-12 product-flex-info">
                        <div class="clearfix">

                            <!-- === product-title === -->

                            {{-- TODO: if needed classification name of offers --}}
                            {{-- <h1 class="title" data-title="{{ $offers[$id]->type->name  }}">{{ $offers[$id]->name }}</h1> --}}
                            <h1 class="title" data-title="{{ ''  }}">{{$offer->name }}</h1>

                            <div class="clearfix">

                                <!-- === price wrapper === -->

                                <div class="price price-details">
                                    <span class="h3">
                                        {{ __('_moka_home.price').': ' }}
                                        <span>{{$offer->price}}</span>
                                        {{-- TODO: if needed old price--}}
                                        <small>{{$offer->old_price}}</small>
                                    </span>
                                </div>
                                <hr />

                                @foreach ($offer_products as $product)
                                    <div class="info-box info-box-addto">
                                        <span><strong><a href="{{ route('products.details', $product['id']) }}">{{ $product['name'] }}</a></strong></span>
                                        <span><strong>{{ $product->note }}</strong></span>
                                    </div>
                                @endforeach
                                {{-- TODO: if needed more details about the product--}}
                                {{-- @include('_moka.offers.details.more-offer-details') --}}

                            </div> <!--/clearfix-->
                        </div> <!--/product-info-wrapper-->
                    </div> <!--/col-md-4-->
                    <!-- === product item gallery === -->

                    <div class="col-md-8 col-sm-12 product-flex-gallery">

                        {{--access nested json data with php--}}

                        <!-- === add to cart === -->
                        @if(config('app.internet_order'))
                        <form action="{{ route('web.cart.post') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $offer->id }}">
                            <input type="hidden" name="type" value="{{ 'offer' }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" class="btn btn-buy" data-text="{{ __('_moka_products.add_to_cart') }}"></button>
                        </form>
                        @endif
                        <!-- === product gallery === -->

                        <div class="owl-product-gallery open-popup-gallery">
                            <a href="{{asset($offer->image_path)}}"><img loading="lazy" class="products-details" src="{{asset($offer->image_path)}}" alt="" height="500" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'" /></a>
                            {{-- TODO: if there multi image --}}
                            {{-- <a href="assets/images/product-1.png"><img loading="lazy" src="{{asset('moka-assets/assets/images/products/3J3A2998.jpg')}}" alt="" height="500" /></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('footer-script-stack')
@endpush
