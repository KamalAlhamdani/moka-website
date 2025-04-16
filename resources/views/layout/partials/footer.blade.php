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

        footer .footer-showroom::before {
            display: none;
        }
    </style>
@endif
<!-- ================== Footer  ================== -->
<style>
    ul.ul-custom {
        list-style: none; /* Remove HTML bullets */
        padding: 0;
        margin: 0;
    }

    .ul-custom li {
        padding-left: 16px;
    }

    .ul-custom li::before {
        content: "•"; /* Insert content that looks like bullets */
        padding: 8px;
    }

    @media screen and (min-width: 767px) {
        .infinitecloud-img{
            width: 80px;
            height: auto;
        }
        .infinitecloud-a{
            margin: auto 80px
        }
    }

    .infinitecloud-img:hover {
        filter: brightness(0) invert(0.7);
        transition: all 0.3s;
    }

    .infinitecloud-img {
        filter: none;
    }

</style>
<footer>
    <div class="container">
        <!--<div class="div"></div>-->
        <!--footer showroom-->
        <div class="footer-showroom"
             @if ( Config::get('app.locale') == 'en') style=" background-position-x: 86%;"@endif>
            <div class="row" style="margin-bottom: 60px; margin-top: 60px;">
                <div class="col-md-1 col-xs-12 p-q"></div>
                @if(config('app.mobile_section'))
                    {{-- TODO: make a better design for footer --}}
                    {{-- @include('layout.partials.footer-internetOrder') --}}
                @endif
                <div class="col-md-4 col-xs-12">
                    <h2>@moka_strtoupper(__('_moka_content.الرؤية'))</h2>
                    <p>@moka_ucfirst(__('_moka_content.محتوى الرؤية'))</p>
                    <h2>@moka_strtoupper(__('_moka_content.الرسالة'))</h2>
                    <p>@moka_ucfirst(__('_moka_content.محتوى الرسالة'))</p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <h2>أهدافنا:</h2>
                    <ul class="ul-custom" style="font-size: 19px">
                        <li> التوسع في عدد الفروع ونقاط البيع.</li>
                        <li> تطوير المنتجات وفق معايير الجودة الأوروبية.</li>
                        <li> تحقيق ثقة العملاء.</li>
                        <li> تطوير البنية التحتية والمؤسسية للشركة.</li>
                        <li> تعزيز قدرات ومهارات الكوادر البشرية للشركة.</li>
                        <li> عقد اتفاقيات وشراكات مع شركات عالمية.</li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <h2>قيمنا:</h2>
                    <ul class="ul-custom" style="font-size: 19px">
                        <li>رضى العاملين.</li>
                        <li>ثقة العميل.</li>
                        <li>الولاء الوظيفي.</li>
                        <li>ثقافة الجودة.</li>
                        <li>العمل بروح الفريق.</li>
                    </ul>
                </div>

                {{--                <div class="col-md-3 col-xs-12">--}}
                {{--                    <h2>تواصل معنا</h2>--}}
                {{--                    <p>774411357</p>--}}
                {{--                </div>--}}
            </div>
        </div>

        <div class="footer-social">
            <div class="row">
                {{--                        <div class="col-sm-6 col-xs-12" style="text-align: left">--}}

                <div class="col-sm-4 links">
                    <ul>
                        <li><a href="{{ config('app.facebook_link') }}"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ config('app.youtube_link') }}"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="{{ config('app.instagram_link') }}"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="{{ config('app.android_app_link') }}"> <img loading="lazy" style="height: 30px"
                                                                                 src="{{asset('moka-assets/assets/images/social-app-links/white-google-min.png')}}"></img></a>
                        </li>
                        <li><a href="{{ config('app.ios_app_link') }}"> <img loading="lazy" style="height: 30px"
                                                                             src="{{asset('moka-assets/assets/images/social-app-links/white-app-min.png')}}"></img></a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8" style="font-size: 20px ">
                    {{-- TODO: privacy policy --}}
                    {{-- <a href="#">Privacy policy</a>
                    &nbsp; |  --}}
                    @if(app()->getLocale() == 'ar')
                        @if(env('display_terms', true))
                            &nbsp;<a href="{{url('terms')}}">{{__('_moka_home.terms')}}</a> &nbsp; |
                        @endif
                        @if(env('display_policy', true))
                            &nbsp; <a href="{{url('policy')}}">{{__('_moka_home.policy')}}</a> &nbsp; |
                        @endif
                        &nbsp;<a href="{{url('sitemap')}}">{{__('_moka_home.sitemap')}}</a>
                        &nbsp;  &nbsp;
                            <a class="infinitecloud-a" href="https://www.infinitecloud.co/"target="_blank">بُني
                            مع &nbsp;<i class="fa fa-heart" style="color: #FFC107"></i> &nbsp;بواسطة <img loading="lazy"
                                                                                   class="infinitecloud-img"
                                                                                   height="24px" alt="InfiniteCloud.co"
                                                                                   style="position: absolute;margin: 0 7px;"
                                                                                   src="{{asset('infinitecloud.png')}}"></a>
                    @else
                        &nbsp;  &nbsp;<a href="{{url('sitemap')}}">{{__('_moka_home.sitemap')}}</a>
                        @if(env('display_terms', true))
                            &nbsp; | &nbsp;<a href="{{url('terms')}}">{{__('_moka_home.terms')}}</a>
                        @endif
                        @if(env('display_policy', true))
                            &nbsp; | &nbsp;<a href="{{url('policy')}}">{{__('_moka_home.policy')}}</a>
                        @endif
                        &nbsp; <br> &nbsp;<a class="infinitecloud-a" href="https://www.infinitecloud.co/"
                                             target="_blank">بُني
                            مع &nbsp;<i class="fa fa-heart"></i> &nbsp;بواسطة <img loading="lazy"
                                                                                   class="infinitecloud-img"
                                                                                   height="24px" alt="InfiniteCloud.co"
                                                                                   style="position: absolute;margin: 0 7px;"
                                                                                   src="{{asset('infinitecloud.png')}}"></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
