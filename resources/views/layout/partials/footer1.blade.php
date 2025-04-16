@if(Config::get('app.locale') == 'ar')
    <style>
        .footer-showroom .col-md-1,
        .footer-showroom .col-md-2,
        .footer-showroom .col-md-3,
        .footer-showroom .col-md-4,
        .footer-showroom .col-md-5,
        .footer-showroom .col-md-6,
        .footer-showroom .col-md-7,
        .footer-showroom .col-md-8,
        .footer-showroom .col-md-9,
        .footer-showroom .col-md-10,
        .footer-showroom .col-md-11,
        .footer-showroom .col-md-12,
        .footer-links .col-md-1,
        .footer-links .col-md-2,
        .footer-links .col-md-3,
        .footer-links .col-md-4,
        .footer-links .col-md-5,
        .footer-links .col-md-6,
        .footer-links .col-md-7,
        .footer-links .col-md-8,
        .footer-links .col-md-9,
        .footer-links .col-md-10,
        .footer-links .col-md-11,
        .footer-links .col-md-12 {
            float: right;
        }
    </style>
@endif
<!-- ================== Footer  ================== -->
<footer>
    <div class="container">
        <!--footer showroom-->
        <div class="footer-showroom">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <h2>@moka_strtoupper(__('_moka_content.الرؤية'))</h2>
                    <p>@moka_ucfirst(__('_moka_content.محتوى الرؤية'))</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <h2>@moka_strtoupper(__('_moka_content.الرسالة'))</h2>
                    <p>@moka_ucfirst(__('_moka_content.محتوى الرسالة'))</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="col-sm-12">
                        <h2>@moka_strtoupper(__('_moka_home.online_application'))</h2>
                        <p>@moka_ucfirst(__('_moka_home.have_a_party'))</p>
                        <p>@moka_ucfirst(__('_moka_home.plan_to_impress_your_guests'))</p>
                    </div>
                    @if(config('app.internet_order'))
                    <div class="col-sm-12 text-center-so">
                        <a href="{{ route('categories') }}" class="btn btn-clean"><span class="icon icon-cart"></span>
                            @moka_ucfirst(__('_moka_home.order_now'))
                        </a>
                        {{--<div class="call-us h4"><span class="icon icon-phone-handset"></span> 333.278.06622</div>--}}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!--footer links-->
{{--        <div class="footer-links">--}}
            {{-- If there is alot of content --}}
            {{--
            <div class="row">
                <div class="col-sm-4 col-md-2">
                    <h5>Browse by</h5>
                    <ul>
                        <li><a href="#">Brand</a></li>
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-2">
                    <h5>Recources</h5>
                    <ul>
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Sales</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-2">
                    <h5>Our company</h5>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h5>Sign up for our newsletter</h5>
                    <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>
                    <div class="form-group form-newsletter">
                        <input class="form-control" type="text" name="email" value="" placeholder="Email address" />
                        <input type="submit" class="btn btn-clean btn-sm" value="Subscribe" />
                    </div>
                </div>
            </div>
            --}}

            {{-- If there is little content --}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-4 col-md-2">--}}
{{--                    --}}{{--<h5>Browse by</h5>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('about')}}">@moka_ucwords('_moka_home.about')</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 col-md-2">--}}
{{--                    --}}{{--<h5>Recources</h5>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('products')}}">@moka_ucwords('_moka_home.products')</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 col-md-2">--}}
{{--                    --}}{{--<h5>Our company</h5>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('categories')}}">@moka_ucwords('_moka_home.order')</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 col-md-2">--}}
{{--                    --}}{{--<h5>Our company</h5>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('contactUs')}}">@moka_ucwords('_moka_home.contact')</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="col-sm-4 col-md-2">--}}
{{--                    --}}{{--<h5>Our company</h5>--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{env('JOBS_SYSTEM_URL')}}">@moka_ucwords('_moka_home.jobs')</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                --}}{{--<div class="col-sm-12 col-md-6">--}}
{{--                    <h5>Sign up for our newsletter</h5>--}}
{{--                    <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>--}}
{{--                    <div class="form-group form-newsletter">--}}
{{--                        <input class="form-control" type="text" name="email" value="" placeholder="Email address" />--}}
{{--                        <input type="submit" class="btn btn-clean btn-sm" value="Subscribe" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!--footer social-->

        <div class="footer-social">
            <div class="row">
                {{--                        <div class="col-sm-6 col-xs-12" style="text-align: left">--}}
                <div class="col-sm-4 links">
                    <ul>
                        <li><a href="{{ config('app.facebook_link') }}"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ config('app.youtube_link') }}"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="{{ config('app.instagram_link') }}"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-sm-8" style="font-size: 20px ">
                    {{-- TODO: privacy policy --}}
                    {{-- <a href="#">Privacy policy</a>
                    &nbsp; |  --}}
                    @if(app()->getLocale() == 'ar')
                        <a href="{{url('policy')}}">{{__('_moka_home.policy')}}</a>&nbsp; | &nbsp;
                        <a href="{{url('terms')}}">{{__('_moka_home.terms')}}</a>&nbsp; | &nbsp;
                        &nbsp;<a href="#">{{__('_moka_home.sitemap')}}</a>
                        &nbsp; | &nbsp;<a class="infinitecloud-a" href="https://www.infinitecloud.co/" target="_blank">بُني
                            مع &nbsp;<i class="fa fa-heart"></i> &nbsp;بواسطة <img loading="lazy" class="infinitecloud-img"
                                                                                   height="24px" alt="InfiniteCloud.co"
                                                                                   src="{{asset('infinitecloud.png')}}"></a>
                    @else
                        &nbsp;<a class="infinitecloud-a" href="https://www.infinitecloud.co/" target="_blank">Built with
                            &nbsp;<i class="fa fa-heart"></i> &nbsp;by <img loading="lazy" class="infinitecloud-img" height="24px"
                                                                            alt="InfiniteCloud.co"
                                                                            src="{{asset('infinitecloud.png')}}"></a>
                        &nbsp; | &nbsp;<a href="#">{{__('_moka_home.sitemap')}}</a>
                        &nbsp; | &nbsp;<a href="{{url('terms')}}">{{__('_moka_home.terms')}}</a>
                        &nbsp; | &nbsp;<a href="{{url('policy')}}">{{__('_moka_home.policy')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
