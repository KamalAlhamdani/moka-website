@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - المنتجات')
@else
    @php($page_title = 'Moka Sweets - Products')
@endif
@extends('layout.mainlayout')
@section('content')

    <!-- ======================== Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $product_name = 'المنتجات' : $product_name = 'Products')
    @php(app()->getLocale() == 'ar' ? $category_name = 'أقسام المنتجات' : $category_name = 'Categories')
    <section class="main-header" style="filter: brightness(0.9);
    /* background-image:url({{asset('moka-assets/assets/images/headers/categories.png')}}) */
    ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $product_name }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="{{ url('/') }}"><span class="icon icon-home"></span></a></li>
                    <li><a href="{{ url('/categories') }}">{{ $category_name }}</a></li>
                    <li><a class="active" href="#">{{ $product_name }}</a></li>
                </ol>
            </div>
        </header>
    </section>

    <style>
        .owl-icons-wrapper.owl-icons-frontpage {
            margin-top: 0;
        }
        @media screen and (min-width: 992px) {
            .toggle-filters-mobile, .close-filter{
                display: none;
            }

        }
    </style>
    @include('.layout.partials.components.owl-categories-icons')

    <!-- ======================== Products ======================== -->
    <section class="products">
        <div class="container">

            <header class="text-center">
                {{-- <h1 class="h1 title">{{ $product_name }}</h1> --}}
                <span class="pull-right">
                <a href="javascript:void(0);" class="toggle-filters-mobile"><i class="fa fa-search"></i></a>
            </span>
            </header>


            <div class="row">

                <!-- === product-filters === -->

                <div class="col-md-3 col-xs-12 @if(app()->getLocale() == 'ar') pull-right @endif">
                    <div class="filters">
                    {{-- @include('_moka.categories.products.filters.price') --}}
                    {{--<!--Availability-->
                    <div class="filter-box active">
                        <div class="title">
                            Availability
                        </div>
                        <div class="filter-content">
                                <span class="checkbox">
                                    <input type="radio" name="radiogroup-stock" id="availableId1" checked="checked">
                                    <label for="availableId1">In stock <i>(152)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-stock" id="availableId2">
                                    <label for="availableId2">1 Week <i>(100)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-stock" id="availableId3">
                                    <label for="availableId3">2 Weeks <i>(80)</i></label>
                                </span>
                        </div>
                    </div> <!--/filter-box-->--}}
                    {{--<!--Discount-->
                    <div class="filter-box active">
                        <div class="title">
                            Discount
                        </div>
                        <div class="filter-content">
                                <span class="checkbox">
                                    <input type="radio" id="discountId1" name="discountPrice" checked="checked">
                                    <label for="discountId1">Discount price</label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" id="discountId2" name="discountPrice">
                                    <label for="discountId2">Regular price</label>
                                </span>
                        </div>
                    </div> <!--/filter-box-->--}}
                    <!--Type-->

                        <div class="filter-box close-filter">
                            <div style="padding: 10px; background-color: #fff">
                                <a href="#" onclick="closeFilter()">
                                    <i class="icon icon-cross"></i>
                                </a>
                            </div>
                        </div>

                        {{-- TODO: add active class to initially open the panel when an item selected --}}
                        <div class="filter-box {{ \App\Helpers\Utilities::inArrayOrObject($selected_category, $categories) ?: ' active ' }}">
                            <div class="title">
                                {{ __('_moka_products.category') }}
                            </div>
                            @if(Config::get('app.locale') == 'ar')
                                <style>
                                    .filters .filter-content i {
                                        float: left;
                                    }
                                </style>
                            @endif
                            <div class="filter-content">
                                <span class="checkbox">
                                        <input type="radio" name="radiogroup-type" checked id="typeId0" value="" onclick="displayRadioValue()">
                                        {{-- TODO: return the quantity of products in specified category --}}
                                        <label for="typeId0">{{ __('_moka_products.all') }} {{--<i>(54)</i>--}} </label>
                                    </span>
                                @foreach( $categories as $category )
                                    <span class="checkbox">
                                        {{--<input type="radio" name="radiogroup-type" @if(isset($products->all()[0]->category_id) && $products->all()[0]->category_id == $category->id) checked @endif id="typeId1{{ ($category->id) }}" value="{{ ($category->id) }}" onclick="displayRadioValue()">--}}
                                        <input type="radio" name="radiogroup-type" @if(isset($selected_category) && $selected_category == $category->id) checked @endif id="typeId1{{ ($category->id) }}" value="{{ ($category->id) }}" onclick="displayRadioValue()">
                                        {{-- TODO: return the quantity of products in specified category --}}
                                        <label for="typeId1{{ ($category->id) }}">{{ ($category->name) }} <i>({{$category->product->count()}})</i> </label>
                                    </span>
                                @endforeach
                            </div>
                        </div> <!--/filter-box-->
                        <div class="filter-box {{ !(isset($is_selected_new) && $is_selected_new == 1) ?: ' active ' }}">
                            <div class="title">
                                {{ __('_moka_products.new') }}
                            </div>
                            @if(Config::get('app.locale') == 'ar')
                                <style>
                                    .filters .filter-content i {
                                        float: left;
                                    }
                                </style>
                            @endif
                            <div class="filter-content">
                                <span class="checkbox">
                                    <input type="radio" name="radiogroup-is-new" checked id="isnewall" value="" onclick="displayRadioValue()">
                                    {{-- TODO: return the quantity of products in specified category --}}
                                    <label for="isnewall">{{ __('_moka_products.all') }} {{--<i>(54)</i>--}} </label>
                                </span>
                                <span class="checkbox">
                                    <input type="radio" name="radiogroup-is-new" {{ !(isset($is_selected_new) && $is_selected_new == 1) ?: ' checked ' }} id="isnew" value="1" onclick="displayRadioValue()">
                                    {{-- TODO: return the quantity of products in specified category --}}
                                    <label for="isnew">{{ __('_moka_products.new') }} {{--<i>(54)</i>--}} </label>
                                </span>
                            </div>
                        </div> <!--/filter-box-->
                    {{--<!--Material-->
                    <div class="filter-box active">
                        <div class="title">
                            Material
                        </div>
                        <div class="filter-content">
                                <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matIdAll">
                                    <label for="matIdAll">All <i>(450)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId1">
                                    <label for="matId1">Blend <i>(11)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId2">
                                    <label for="matId2">Leather <i>(12)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId3">
                                    <label for="matId3">Wood <i>(80)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId4">
                                    <label for="matId4">Shell <i>(80)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId5">
                                    <label for="matId5">Metal <i>(80)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId6">
                                    <label for="matId6">Aluminium <i>(80)</i></label>
                                </span>
                            <span class="checkbox">
                                    <input type="radio" name="radiogroup-material" id="matId7">
                                    <label for="matId7">Acrilic <i>(80)</i></label>
                                </span>
                        </div>
                    </div> <!--/filter-box-->--}}
                    <!--close filters on mobile / update filters-->
                        <form id="filter-product-form" action="{{ route('products') }}" method="GET" style="display: none;">
                            {{-- USE CSRF if form method is POST --}}
                            {{--@csrf--}}
                            <input id="category_id" type="hidden" name="category_id">
                            <input id="is_new" type="hidden" name="is_new">
                        </form>
                        <a href="{{ route('products') }}" onclick="event.preventDefault();document.getElementById('filter-product-form').submit();">
                            <button type="button" form="filter-product-form" class="btn btn-block btn-main">
{{--                                <div class="toggle-filters-close btn btn-main">--}}
                                    {{ __('_moka_products.filter') }}
{{--                                </div>--}}
                            </button>
                        </a>
                        <script>
                            function closeFilter() {
                                $('.filters').removeClass('active');
                            }
                            function displayRadioValue() {
                                /* Category */
                                var ele = document.getElementsByName('radiogroup-type');
                                for(i = 0; i < ele.length; i++) {
                                    if(ele[i].checked)
                                        document.getElementById("category_id").value = ele[i].value;
                                }

                                /* IsNew */
                                var is_new = document.getElementsByName('radiogroup-is-new');
                                for(i = 0; i < is_new.length; i++) {
                                    if(is_new[i].checked)
                                        document.getElementById("is_new").value = is_new[i].value;
                                }
                            }
                        </script>


                    </div> <!--/filters-->
                </div>


                <!--product items-->

                <div class="col-md-9 col-xs-12 ">

                    {{--<div class="sort-bar clearfix">
                        <div class="sort-results pull-left">
                            <!--Showing result per page-->
                            <select>
                                <option value="1">10</option>
                                <option value="2">50</option>
                                <option value="3">100</option>
                                <option value="4">All</option>
                            </select>
                            <!--Items counter-->
                            <span>Showing all <strong>50</strong> of <strong>3,250</strong> items</span>
                        </div>
                        <!--Sort options-->
                        <div class="sort-options pull-right">
                            <span class="hidden-xs">Sort by</span>
                            <select>
                                <option value="1">Name</option>
                                <option value="2">Popular items</option>
                                <option value="3">Price: lowest</option>
                                <option value="4">Price: highest</option>
                            </select>
                            <!--Grid-list view-->
                            <span class="grid-list">
                                    <a href="products-grid.html"><i class="fa fa-th-large"></i></a>
                                    <a href="products-list.html"><i class="fa fa-align-justify"></i></a>
                                    <a href="javascript:void(0);" class="toggle-filters-mobile"><i class="fa fa-search"></i></a>
                                </span>
                        </div>
                    </div>--}}

                    <div id="boxes" class="row">
                    @php($items = $is_most_sell ? $most_sells : $products)
                    {{--{{ dd($items->all()[0]->image) }}--}}

                    {{-- User_id --}}
                    {{-- {{ dd( $items->all()[1]->favorite[0]->id ) }} --}}
                    {{-- {{ dd( $items->all()[1]->favorite[0]->pivot->product_id ) }} --}}

                    @foreach($items->all() as $i)
                    {{-- {{ dd( $i->favorite[0]->pivot->product_id ) }} --}}
{{-- {{dd($i->prices)}} --}}
                        <!-- === product-item === -->

                            <div class="col-md-6 col-xs-6 @if(app()->getLocale() == 'ar') pull-right @endif">
                                <article>
                                    <div class="info">
                                        {{-- <span class="add-favorite"> --}}
                                            {{-- /* TODO: moka add to favorites if loged in */ --}}
                                            {{-- <i href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></i> --}}
                                            @auth
                                            @include('_moka.categories.products.product-add-to-fav')
                                            @endauth
                                        {{-- </span> --}}
                                        <span>
                                        {{-- /* TODO: moka Show the details as modal */ --}}
                                            {{--<a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>--}}
                                    </span>
                                    </div>
                                    {{-- {{ count($i->prices) == 1 ? 'true: '.$i->prices[0]->id : false }} --}}
                                    {{-- Add the product price only not product --}}
                                    {{-- @include('_moka.categories.products.product-add-to-cart') --}}
                                    <div class="figure-grid">
                                        {{-- /* TODO: add new label if the product is new */ --}}
                                        {{--<span class="label label-warning">New</span>--}}
                                        <div class="image">
                                            {{--<a href="#productid1" class="mfp-open">--}}
                                            <a href="{{ route('products.details', $i->id) }}" class="img-card-product">
                                                <img loading="lazy" src="{{domainAsset('').'storage/thumbnail/360/'.$i->image}}"
                                                     onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'"
                                                     class="image-product"
                                                     width="360" />
                                            </a>
                                        </div>
                                        <div class="text sup-none">
                                            <h2 class="title h4"><a href="{{ route('products.details', $i->id) }}">{{ $i->name }}</a></h2>
                                            @if($i->is_new)<span class="label label-warning min-sup">{{ __('_moka_products.new') }}</span>@endif
                                            <sup  style="margin-top: 40px;margin-right: -10px;">
{{--                                            <div style="margin-top: 40px;">--}}
                                                @if($i->is_new)<span class="label label-warning">{{ __('_moka_products.new') }}</span>@endif
{{--                                            </div>--}}
                                            </sup>
                                            <br>
{{--                                        @foreach($i->prices as $item)--}}
{{--                                                <sup>--}}
{{--                                                    @if($item->unitName == 'لايوجد بيانات' or $item->unitName == 'no data')--}}
{{--                                                        ''--}}
{{--                                                    @else--}}
{{--                                                        {{ $item->unitName }}--}}
{{--                                                    @endif--}}
{{--                                                </sup>--}}
{{--                                                <br>--}}
{{--                                            @endforeach--}}
                                            {{-- TODO: if needed description for the product --}}
                                            {{-- <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span> --}}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div><!--/row-->
                    <!--Pagination-->
                    <div class="pagination-wrapper">
                        {{ $items->appends($pagination_links)->links() }}
                        {{--{{ $items->render() }}--}}
                    </div>
                    <br>
                    <br>
                </div> <!--/product items-->

            </div><!--/row-->
            <!-- ========================  Product info popup - quick view ======================== -->

            {{-- TODO: if needed popup details of product --}}
            {{-- <div class="popup-main mfp-hide" id="productid1">

                <!-- === product popup === -->

                <div class="product">

                    <!-- === popup-title === -->

                    <div class="popup-title">
                        <div class="h1 title">Laura <small>product category</small></div>
                    </div>

                    <!-- === product gallery === -->

                    <div class="owl-product-gallery">
                        <img loading="lazy" src="{{domainAsset('moka-assets/assets/images/categories/icecream.jpg')}}" alt="" width="640" />
                        <img loading="lazy" src="{{domainAsset('moka-assets/assets/images/categories/icecream.jpg')}}" alt="" width="640" />
                        <img loading="lazy" src="{{domainAsset('moka-assets/assets/images/categories/icecream.jpg')}}" alt="" width="640" />
                        <img loading="lazy" src="{{domainAsset('moka-assets/assets/images/categories/icecream.jpg')}}" alt="" width="640" />
                    </div>

                    <!-- === product-popup-info === -->

                    <div class="popup-content">
                        <div class="product-info-wrapper">
                            <div class="row">

                                <!-- === left-column === -->

                                <div class="col-sm-6">
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
                                </div>

                                <!-- === right-column === -->

                                <div class="col-sm-6">
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
                                </div>

                            </div><!--/row-->
                        </div> <!--/product-info-wrapper-->
                    </div><!--/popup-content-->
                    <!-- === product-popup-footer === -->

                    <div class="popup-table">
                        <div class="popup-cell">
                            <div class="price">
                                <span class="h3">$ 1999,00 <small>$ 2999,00</small></span>
                            </div>
                        </div>
                        <div class="popup-cell">
                            <div class="popup-buttons">
                                <a href="product.html"><span class="icon icon-eye"></span> <span class="hidden-xs">View more</span></a>
                                <a href="javascript:void(0);"><span class="icon icon-cart"></span> <span class="hidden-xs">Buy</span></a>
                            </div>
                        </div>
                    </div>

                </div> <!--/product-->
            </div> <!--popup-main--> --}}
        </div><!--/container-->
    </section>

@endsection
@push('footer-script-stack')
<script>

</script>
@endpush
