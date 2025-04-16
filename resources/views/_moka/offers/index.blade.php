{{--products-grid.html--}}
@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - العروض')
@else
    @php($page_title = 'Moka Sweets - Offers')
@endif
@extends('layout.mainlayout')
@section('content')
<style>
    @media (min-width: 990px) {
        nav .navigation .logo img {
            filter: brightness(0) invert(1);
        }
    }
</style>
    <!-- ========================  Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $category_name = 'العروض' : $category_name = 'Offers')
    <section class="main-header"
             style="filter: brightness(0.9);
             /* background-image:url({{url('moka-assets/assets/images/headers/categories.png')}}) */
             ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $category_name }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="/"><span class="icon icon-home"></span></a></li>
                    {{--<li><a href="category.html">Category</a></li>--}}
                    <li><a class="active" href="#">{{ $category_name }}</a></li>
                </ol>
            </div>
        </header>
    </section>

    <!-- ========================  Products ======================== -->

    <section class="products">
        <div class="container">

            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center figure-block">
                        <h2 class="title">{{__('_moka_nav.offers')}}</h2>
                        <br>
                        {{-- TODO: if needed classification of offers --}}
                        {{-- <article>
                        <div class="text">
                            <div class="col-xs-12 text-center">
                            </div>
                            <div class="col-xs-3 text-center">
                                    <a href="{{route('offers')}}" class="btn-sm btn btn-{{!isset($offerType) ? 'primary' : 'clean-dark'}}">{{ __('_moka_products.all') }}</a>
                                </div>
                            @foreach ($offers as $offer)
                            <div class="col-xs-3 text-center">
                                <a href="{{route('offers.type', $offer->type->id)}}" class="btn-sm btn btn-{{isset($offerType) ? $offer->type->id == $current_type ? 'primary' : 'clean-dark' : 'clean-dark'}}">{{ $offer->type->name }}</a>
                            </div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                        </article> --}}
                    </div>
                </div>
            </header>

            <div class="row categories-items">

            @forelse (isset($offerType) ? $offerType : $offers as $offer)
                <!-- === product-item === -->

                    <div class="col-md-3 col-xs-6">
                        <article>
                            <div class="figure-block">
                                <div class="image">
                                    <a href="{{route('offers.details', $offer->id)}}">
                                        <img loading="lazy" src="{{asset($offer->image_path)}}" alt="" width="360" onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'"/>
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="{{route('offers.details', $offer->id)}}">{{ $offer->name }}</a></h2>
                                    <sup>{{ $offer->price }}</sup>
                                    {{--<span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>--}}
                                    {{-- TODO: if needed classification of offers --}}
                                    {{-- <span class="description clearfix">{{ $offer->type->name }}</span> --}}
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                <div class="row text-center">
                    <img loading="lazy" width="128px" class="image" src="{{asset('moka-assets/assets/images/عروض-min.png')}}"/>
                    <p class="text-center">{{__('_moka_offer.there_is_no_offer')}}</p>
                </div>
                @endforelse
            </div><!--/row-->

        </div><!--/container-->
    </section>
@endsection
