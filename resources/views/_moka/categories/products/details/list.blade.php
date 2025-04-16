{{-- Used --}}
<section class="product products">
    <div class="main">
        <div class="container">
            <div class="row product-flex">
                {{-- <header class="hidden">
                    <h3 class="h3 title">Product category list</h3>
                    <img loading="lazy" width="64px" src="{{ domainAsset('storage/thumbnail/64/'.$product_details->image) }}"
                        onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'" />
                </header> --}}

                <div class="row">
                    <!-- === Product image === -->
                    <div class="col-md-5 col-xs-12 hidden1-md product-flex-info @if( Config::get('app.locale') == 'ar') pull-right @endif" >
                        <div class="image">
                            {{-- <a href="#productid1"> --}}
                            <a href="#" style="margin-right: 7px;margin-left: 7px">
                                <img loading="lazy" src="{{ domainAsset('storage/thumbnail/360/'.$product_details->image) }}" alt="" class="details-image"
                                     onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'">
                            </a>
                        </div>
                    </div><!--/product image-->

                    <!-- === product items === -->

                    <div class="col-md-7 col-xs-12 product-flex-gallery">

                        <div class="row">
                            @foreach ($product_details->prices as $price)
                            <!-- === product-item === -->

                            <div class="col-md-12">

                                <article>
                                    <div class="info" style="background-color: transparent;">
                                        {{-- @include('_moka.categories.products.details.list-add-to-fav') --}}
                                    {{-- <span>
                                            <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                        </span> --}}
                                    </div>
                                    {{-- <div class="btn btn-add" style="transform: translate3d(0, 0, 0);display:inherit;"> --}}
                                        @if(config('app.internet_order'))
                                        @include('_moka.categories.products.details.list-add-to-cart')
                                        @endif
                                    <div class="figure-list">
                                        <div class="image">
                                            <a href="#productid{{ $price->id }}" class="mfp-open">
                                                <img loading="lazy" src="{{Str::contains($price->image_path, ['jpg', 'png', 'jpeg', 'gif']) == null ? asset('moka-assets\assets\images\products\default\product.png') : $price->image_path}}"
                                                     alt="" style="min-height: 150px"
                                                     onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'">
                                            </a>
                                        </div>
                                        <div class="text">
                                            <style>
                                                .product-prices {
                                                    display: inline !important;
                                                }
                                            </style>
{{--                                            <span class="product-prices">&nbsp;&nbsp;&nbsp;</span>--}}
                                            <h2 class="title h4 product-prices">
                                                <span><strong>{{$product_details->name}}</strong></span>
                                            </h2>
{{--                                            <span class="product-prices">&nbsp;&nbsp;&nbsp;</span>--}}
                                            <h2 class="title h4 product-prices">
                                                <span>
                                                    <strong>
{{--                                                        @if($price->tasteName=='لايوجد بيانات' or $price->tasteName='no data')--}}
                                                            {{$price->tasteName}}
{{--                                                        @else--}}
{{--                                                        @endif--}}
                                                    </strong>
                                                </span>
                                            </h2>
{{--                                            <span class="product-prices">&nbsp;&nbsp;&nbsp;</span>--}}
                                            <h2 class="title h4 product-prices">
                                                <span><strong>{{$price->unitName}}</strong></span>
                                            </h2>
{{--                                            <span class="product-prices">&nbsp;&nbsp;&nbsp;</span>--}}
                                            <h2 class="title h3 product-prices">
                                                <span><b>{{$price->price}}</b></span>
                                            </h2>
                                            {{-- <sub>{{$price->price}}</sub> --}}
                                            {{-- <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span> --}}

                                                {{-- <a href="http://moka.api/checkout" onclick="event.preventDefault();document.getElementById('add_product_5').submit();">
                                                    <button type="button" form="add_product_5" class="btn btn-block btn-main">
                                                        <i class="icon icon-cart"></i>
                                                    </button>
                                                </a> --}}

                                        </div>
                                    </div>
                                </article>
                            </div>
                            @endforeach

                        </div><!--/row-->
                        {{-- <!--Pagination-->
                        <div class="pagination-wrapper">

                        </div> --}}

                    </div> <!--/product items-->


                </div><!--/row-->
            </div>
            @include('_moka.categories.products.details.popup')
        </div><!--/container-->
    </div>
    @include('_moka.categories.products.details.related')
</section>
