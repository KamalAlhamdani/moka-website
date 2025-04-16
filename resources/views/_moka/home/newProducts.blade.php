<!-- ========================  Stretcher widget ======================== -->

<section class="stretcher-wrapper">
    <!-- === stretcher header === -->

    <header class="hidden-stop">
        <!--remove class 'hidden'' to show section header -->
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 text-center">
                    <h1 class="h2 title">{{ __('_moka_home.latest_products') }}</h1>
                    {{-- <div class="text">
                        <p>
                            {{ __('_moka_home.latest_products_phrase') }}
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </header>
    <!-- === stretcher === -->

    <ul class="stretcher" style="background: linear-gradient(145deg, #349aed 50%, #34d8ed 100%) !important;">

    @foreach($new_products->slice(0, 4) as $new_product)
        <!-- === stretcher item === -->

            <li class="stretcher-item"
                style="background-image:url({{domainAsset('storage/thumbnail/640/'.$new_product->image)}})
                /* ,url({{asset('moka-assets/assets/images/defualt.png')}}) */
                ;">
                <!--logo-item-->
                <div class="stretcher-logo">
                    <div class="text">
                        {{--<span class="f-icon moka-paklava-xx-large"></span>--}}
                        <span class="text-intro">{{ $new_product->name }}</span>
                    </div>
                </div>
                <!--main text-->
                <figure>
                    <h4>{{ $new_product->name }}</h4>
                    {{--<figcaption>New furnishing ideas</figcaption>--}}
                </figure>
                <!--anchor-->
                <a href="{{ route('products').'/'.$new_product->id }}">{{ __('_moka_home.show_more') }}</a>
            </li>
    @endforeach

    {{--

                    <!-- === stretcher item === -->

                    <li class="stretcher-item" style="background-image:url({{asset('moka-assets/assets/images/categories/backlava.jpg')}});">
                        <!--logo-item-->
                        <div class="stretcher-logo">
                            <div class="text">
                                <span class="f-icon moka-paklava-xx-large"></span>
                                <span class="text-intro">{{ __('_moka_nav.paklava') }}</span>
                            </div>
                        </div>
                        <!--main text-->
                        <figure>
                            <h4>{{ __('_moka_nav.paklava') }}</h4>
                            --}}
    {{--<figcaption>New furnishing ideas</figcaption>--}}{{--

                        </figure>
                        <!--anchor-->
                        <a href="#">Anchor link</a>
                    </li>

                    <!-- === stretcher item === -->

                    <li class="stretcher-item" style="background-image:url({{asset('moka-assets/assets/images/categories/gatue.jpg')}});">
                        <!--logo-item-->
                        <div class="stretcher-logo">
                            <div class="text">
                                <span class="f-icon moka-Gateau-xx-large"></span>
                                <span class="text-intro">{{ __('_moka_nav.gateau') }}</span>
                            </div>
                        </div>
                        <!--main text-->
                        <figure>
                            <h4>{{ __('_moka_nav.gateau') }}</h4>
                            --}}
    {{--<figcaption>New furnishing ideas</figcaption>--}}{{--

                        </figure>
                        <!--anchor-->
                        <a href="#">Anchor link</a>
                    </li>

                    <!-- === stretcher item === -->

                    <li class="stretcher-item" style="background-image:url({{asset('moka-assets/assets/images/categories/puffpastry.jpg')}});">
                        <!--logo-item-->
                        <div class="stretcher-logo">
                            <div class="text">
                                <span class="f-icon moka-Puff-Pastry-xx-large"></span>
                                <span class="text-intro">{{ __('_moka_nav.puff_pastry') }}</span>
                            </div>
                        </div>
                        <!--main text-->
                        <figure>
                            <h4>{{ __('_moka_nav.puff_pastry') }}</h4>
                            --}}
    {{--<figcaption>New furnishing ideas</figcaption>--}}{{--

                        </figure>
                        <!--anchor-->
                        <a href="#">Anchor link</a>
                    </li>

                    <!-- === stretcher item === -->

                    <li class="stretcher-item" style="background-image:url({{asset('moka-assets/assets/images/categories/tart.jpg')}});">
                        <!--logo-item-->
                        <div class="stretcher-logo">
                            <div class="text">
                                <span class="f-icon moka-tort-xx-large"></span>
                                <span class="text-intro">{{ __('_moka_nav.tart') }}</span>
                            </div>
                        </div>
                        <!--main text-->
                        <figure>
                            <h4>{{ __('_moka_nav.tart') }}</h4>
                            --}}
    {{--<figcaption>New furnishing ideas</figcaption>--}}{{--

                        </figure>
                        <!--anchor-->
                        <a href="#">Anchor link</a>
                    </li>

    --}}

    <!-- === stretcher item more=== -->

        <li class="stretcher-item more">
            <div class="more-icon">
                <span data-title-show="{{__('_moka_home.show_more')}}" data-title-hide="-"></span>
            </div>
            <a href="{{ route('products').'?is_new=1' }}"></a>
        </li>

    </ul>
</section>
