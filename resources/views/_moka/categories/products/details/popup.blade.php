@foreach ($product_details->prices as $price)
<!-- ========================  Product info popup - quick view ======================== -->
<div class="popup-main mfp-hide" id="productid{{ $price->id }}">

    <!-- === product popup === -->

    <div class="product">

        <!-- === popup-title === -->

        <div class="popup-title">
            <div class="h1 title">{{ $product_details->name }}
                <small>{{ $product_details->category->name }}</small>
            </div>
        </div>

        <!-- === product gallery === -->

        <div class="owl-product-gallery">
            {{-- TODO: if needed add more images --}}
            {{--<img loading="lazy" src="http://moka.api/storage/offers/slider/gallery-1.png" alt="" width="640"/>
            <img loading="lazy" src="http://moka.api/storage/offers/slider/gallery-1.png" alt="" width="640"/>--}}
            {{-- <img loading="lazy" src="http://moka.api/storage/offers/slider/gallery-1.png" alt="" width="640"/> --}}
            {{-- <img loading="lazy" src="{{domainAsset('storage/thumbnail/'.$product->image)}}" alt="" width="640"/> --}}
            <img loading="lazy" src="{{Str::contains($price->image_path, ['jpg', 'png', 'jpeg', 'gif']) == null ? asset('moka-assets/assets/images/defualt.png') : $price->image_path}}" alt="" width="640">

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
                                <span class="color-btn color-btn-biege">{{ $price->tasteName }}</span>
                                <span class="color-btn color-btn-biege">{{ $price->unitName }}</span>
                                <span class="color-btn color-btn-biege">{{ $price->price }}</span>
                            </div>
                        </div>
                    </div>

                </div> <!--/row-->
            </div> <!--/product-info-wrapper-->
        </div> <!--/popup-content-->
        <!-- === product-popup-footer === -->

        <div class="popup-table">
            <div class="popup-cell" style="height: 50px">
                <div class="price">
                    <span class="h3"> {{ $price->price }}
                    {{-- <small>{{ $price->old_price ?? '' }}</small> --}}
                    </span>
                </div>
            </div>
            @if(config('app.internet_order'))
            <div class="popup-cell">
                <div class="popup-buttons">
                        <form id="add_product_{{ $price->id }}" action="{{ route('web.cart.post') }}" method="post">
                            @csrf
                            {{-- TODO: selected price --}}
                            <input type="hidden" name="id" value='{{ $price->id }}'>
                            <input type="hidden" name="type" value="{{ 'product' }}">
                            {{-- use the unary plus operator to convert quantities to numbers first.  --}}
                            {{-- <input class="form-control form-quantity" name="quantity" type="number" value="1" min="0" onchange="+(document.getElementById('product-quantity').value) += +(this.value))"> --}}
                        </form>
                    <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('add_product_{{  $price->id }}').submit();"><span class="icon icon-cart"></span> <span class="hidden-xs">Buy</span></a>
                </div>
            </div>
            @endif
        </div>

    </div> <!--/product-->
</div> <!--popup-main-->
@endforeach
