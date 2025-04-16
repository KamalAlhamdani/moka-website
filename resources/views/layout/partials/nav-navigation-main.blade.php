<div class="navigation navigation-main">

    <!-- Setup your logo here-->

    {{-- <input type="hidden" id="navWhiteLogo" url="{{ asset('moka-assets/assets/images/logo.png') }}"> --}}
    <style>
        .nav.navbar-sticked {
             background-color: #1e7e75 !important;
                box-shadow: 0 0 30px rgba(16,14,23,.25);

        }
        /*.navbar-sticked > div.container > div.navigation.navigation-main {*/
        /*    box-shadow: 0 0 30px rgba(16,14,23,.25);*/

        /*}*/
        .navbar-sticked > div.container > div.navigation.navigation-main a.logo {
            filter: brightness(0) invert(1);
        }
        @media (max-width: 991px) {
            div.container > div.navigation.navigation-main a.logo {
                /*filter: brightness(0) invert(1);*/
            }
        }
    </style>
    <style>
        @media (min-width: 990px) {
            nav .navigation .logo img {
                filter: brightness(0) invert(1);
            }
        }
    </style>
    <input type="hidden" id="navWhiteLogo" url="{{ asset('moka-assets/assets/images/moka-logo1.svg') }}">
    <input type="hidden" id="navColoredLogo" url="{{ asset('moka-assets/assets/images/moka-logo1.svg') }}">

    {{-- <a href="{{route('index')}}" class="logo"><img loading="lazy" src="{{ asset('moka-assets/assets/images/logo.svg') }}" alt="" /></a> --}}
    <a href="{{route('index')}}" class="logo" style="height: 60px;"><img loading="lazy" src="{{ asset('moka-assets/assets/images/moka-logo1.svg') }}" alt="" style="margin-top: 10px;margin-bottom: 10px;"></a>

    <!-- Mobile toggle menu -->

    <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>

    <!-- Convertible menu (mobile/desktop)-->

    <div class="floating-menu">

        <!-- Mobile toggle menu trigger-->

        <div class="close-menu-wrapper">
            <span class="close-menu"><i class="icon icon-cross"></i></span>
        </div>

        <ul>
            <li>
                <a href="{{route('index')}}">{{__('_moka_nav.home')}}</a>
            </li>

            <!-- Moka icons in dropdown-->

            <li>

                <a href="{{ route('categories') }}">{{ __('_moka_nav.products') }}{{-- __('_moka_nav.categories') --}} <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                <div class="navbar-dropdown">
                    <div class="navbar-box">
                        <!-- box-1 (left-side)-->

                        <div class="box-1">
{{--                                    <style>--}}
{{--                                        .image img{--}}
{{--                                            /*height: 200px;*/--}}
{{--                                            overflow: hidden;--}}
{{--                                            display: flex;--}}
{{--                                            text-align: center;--}}
{{--                                        }--}}
{{--                                    </style>--}}
                            <div class="image">
                                <img loading="lazy" src="{{asset('moka-assets/assets/images/categories/backlava.jpg')}}" alt="backlava" />
                            </div>
                            <div class="box">
                                <div class="h3" style="font-size: 24px">{{ __('_moka_content.The types of customers, and what Moka offers') }}</div>
                                <div class="clearfix">
                                    <p class="lead">
                                        {!! __('_moka_content.The types of customers, and what Moka offers Content') !!}
                                    </p>
                                    @if(config('app.internet_order'))
                                    <a class="btn btn-clean btn-big" href="{{ route('categories') }}">{{ __('_moka_home.online_application') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div> <!--/box-1-->
                        <!-- box-2 (right-side)-->

                        <div class="box-2" {{ app()->getLocale() == 'ar' ? 'dir=rtl' : '' }}>
                            <div class="clearfix categories">
                                <div class="row categories-nav">

                                    <!--icon item-->
                                    @include('layout.partials.components.nav-bar-categories')


                                </div> <!--/row-->

                            </div> <!--/categories-->
                        </div> <!--/box-2-->
                    </div> <!--/navbar-box-->
                </div> <!--/navbar-dropdown-->
            </li>

        <!-- Simple menu link-->

            <li><a href="{{ route('offers') }}">{{ __('_moka_nav.offers') }}</a></li>

            <li><a href="{{ route('about') }}">{{ __('_moka_nav.about') }}</a></li>

            <li><a href="{{route('contactUs')}}">{{ __('_moka_nav.contact') }}</a></li>

            @if(config('app.internet_order'))
            <li><a href="{{ route('categories') }}">{{ __('_moka_nav.order') }}</a></li>
            @endif

            <li><a href="{{route('samples-categories')}}">{{ __('_moka_nav.samples') }}</a></li>
            <li><a href="{{route('branches')}}">{{ __('_moka_home.branches') }}</a></li>
            <li><a href="{{env('JOBS_SYSTEM_URL')}}">{{ __('_moka_home.jobs') }}</a></li>
        </ul>
    </div> <!--/floating-menu-->
</div> <!--/navigation-main-->
