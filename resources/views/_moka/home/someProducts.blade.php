{{--TODO: add most sell products section--}}

<!-- ========================  Products widget ======================== -->
<section class="products">

        <div class="container">

            <!-- === header title === -->

            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        {{-- <h2 class="title">@moka_ucwords('_moka_home.some_of_our')</h2> --}}
                        {{-- <div class="text">
                            <p>@moka_strtoupper(__('_moka_home.we_are_happy_to_satisfy_you'))</p>
                        </div> --}}
                    </div>
                </div>
            </header>
            @if ( Config::get('app.locale') == 'ar')
                <style>
                    .products article .info a:hover:after {
                        right: -175%;
                        top: 5px;
                    }
                </style>
            @endif
            <div class="row" dir="ltr">
                @if($errors->any() && !$errors->has('product_error'))
                    <div class="alert alert-warning">
                        {{$errors->first()}}
                    </div>
                @endif
            </div>
            <div class="row" dir="ltr">
            @foreach($some_products->slice(0, 6) as $product)
                <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">
                        {{-- {{ dump('user id '.auth()->user()->id) }} --}}
                        {{-- {{ dump('product id '.$product->id) }} --}}
                        {{-- {{ dump($product->favorite) }} --}}
                        {{-- {{ dump($product) }} --}}
                        <article  dir="ltr">
                            <div dir="ltr" class="figure-grid">
                                <div class="image">
                                    <a href="#someProductid{{ $product->id }}" class="mfp-open">
                                        <img loading="lazy" src="{{domainAsset('storage/thumbnail/360/'.$product->image)}}" alt="" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'" width="360"  class="image-product"/>
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4">
                                            <a href="{{ route('products').'/'.$product->id }}">{{ $product->name }}</a>
                                            <br/>
                                            <div class="is-new">
                                                @if($product->is_new)<span class="label label-warning">{{ __('_moka_products.new') }}</span>@endif
{{--                                                <span class="label label-warning">{{ __('_moka_products.new') }}</span>--}}
                                            </div>
                                    </h2>
                                    {{-- TODO: if neede old price --}}
                                    {{-- <sub>$ 1499,-</sub> --}}
                                    {{-- TODO: product price --}}
                                    {{--<sup>$ 1099,-</sup>--}}
                                    {{-- TODO: mostSell product describtion --}}
                                    <span class="description clearfix">{{ $product->name }} {{ $product->name }} {{ $product->name }} {{ $product->name }}</span>
                                </div>
                            </div>
                            <div dir="ltr" class="info">
                                @auth
                                @include('_moka.home.addToFavorate')
                                @endauth
                                <span>
                                    <a href="#someProductid{{ $product->id }}" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            {{-- Add the product price only not product --}}
                            {{-- @include('_moka.home.addProductButton') --}}

                        </article>
                    </div>
                @endforeach
            </div> <!--/row-->

            <!-- === button more === -->

            <div class="wrapper-more">
                <a href="{{ route('products') }}" class="btn btn-main">{{ __('_moka_home.show_more') }}</a>
            </div>

        @foreach($some_products->slice(0, 6) as $product)
            <!-- ========================  Product info popup - quick view ======================== -->
                <div class="popup-main mfp-hide" id="someProductid{{ $product->id }}">

                    <!-- === product popup === -->

                    <div class="product">

                        <!-- === popup-title === -->

                        <div class="popup-title">
                            <div class="h1 title">{{ $product->name }}
                                <small>{{ $product->category->name }}</small>
                            </div>
                        </div>

                        <!-- === product gallery === -->

                        <div class="owl-product-gallery">
                            {{-- TODO: if needed add more images --}}
                            {{--<img loading="lazy" src="http://moka.api/storage/offers/slider/gallery-1.png" alt="" width="640" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'/>
                            <img loading="lazy" src="http://moka.api/storage/offers/slider/gallery-1.png" alt="" width="640" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'/>
                            <img loading="lazy" src="http://moka.api/storage/offers/slider/gallery-1.png" alt="" width="640" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'/>--}}
                            <img loading="lazy" src="{{domainAsset('storage/thumbnail/640/'.$product->image)}}" alt="" width="640" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'"/>

                        </div>

                        <!-- === product-popup-info === -->

                        <div class="popup-content">
                            <div class="product-info-wrapper">
                                <div class="row">

                                    <!-- === left-column === -->

                                    {{-- TODO: if needed more details --}}
                                    {{--<div class="col-sm-6">
                                        <div class="info-box">
                                            <strong>Maifacturer</strong>
                                            <span>Brand name</span>
                                        </div>
                                        <div class="info-box">
                                            <strong>Materials</strong>
                                            <span>Wood, Leather, Acrylic</span>
                                        </div>
                                        <div class="info-box">
                                            <strong>Availability</strong>
                                            <span><i class="fa fa-check-square-o"></i> in stock</span>
                                        </div>
                                    </div>--}}

                                    <!-- === right-column === -->

                                    {{-- TODO: if needed more details --}}
                                    {{--<div class="col-sm-6">
                                        <div class="info-box">
                                            <strong>Available Colors</strong>
                                            <div class="product-colors clearfix">
                                                <span class="color-btn color-btn-red"></span>
                                                <span class="color-btn color-btn-blue checked"></span>
                                                <span class="color-btn color-btn-green"></span>
                                                <span class="color-btn color-btn-gray"></span>
                                                <span class="color-btn color-btn-biege"></span>
                                            </div>
                                        </div>
                                        <div class="info-box">
                                            <strong>Choose size</strong>
                                            <div class="product-colors clearfix">
                                                <span class="color-btn color-btn-biege">S</span>
                                                <span class="color-btn color-btn-biege checked">M</span>
                                                <span class="color-btn color-btn-biege">XL</span>
                                                <span class="color-btn color-btn-biege">XXL</span>
                                            </div>
                                        </div>
                                    </div>--}}

                                    {{-- BySwadi custom more details --}}
                                    <div class="col-sm-12">
                                        <div class="info-box moka-prices-title">
                                            <strong>{{ __('_moka_home.available_prices') }}</strong>
                                            <div class="product-colors moka-prices clearfix">
                                                 {{--TODO: add to cart from here --}}
                                                {{--<span class="color-btn color-btn-biege checked">M</span>--}}
                                                @foreach($product->prices as $price)
                                                <span class="color-btn color-btn-biege">{{ $price->unitName }} <br> {{ $price->price }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div> <!--/row-->
                            </div> <!--/product-info-wrapper-->
                        </div> <!--/popup-content-->
                        <!-- === product-popup-footer === -->

                        <div class="popup-table">
                            <div class="popup-cell">
                                {{--<div class="price">
                                    <span class="h3">$ 1999,00 <small>$ 2999,00</small></span>
                                </div>--}}
                            </div>
                            <div class="popup-cell">
                                <div class="popup-buttons">
                                    <a href="{{ route('products.details' , $product->id) }}"><span class="icon icon-eye"></span> <span class="hidden-xs">{{ __('_moka_home.show_more') }}</span></a>
                                    {{--<a href="javascript:void(0);"><span class="icon icon-cart"></span> <span class="hidden-xs">Buy</span></a>--}}
                                </div>
                            </div>
                        </div>

                    </div> <!--/product-->
                </div> <!--popup-main-->
            @endforeach
        </div> <!--/container-->
    </section>
