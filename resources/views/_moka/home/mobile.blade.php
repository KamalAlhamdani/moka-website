<section class="interior_area" style="background-color: #f8f9fa">
    <div class="container">
        <div class="interior_inner row">
            <div class="col-md-6 div-imag-mobile  @if ( Config::get('app.locale') == 'en') pull-right @endif">
                {{--                        <img loading="lazy" class="img-fluid" src="{{asset('interior-2.png')}}" alt="">--}}
                <img loading="lazy" class="img-fluid" width="450" src="{{asset('moka-assets\assets\images\MOBILE-SECTION-min.png')}}" alt="" style="margin-top: 10px">
            </div>
            <div class="col-md-5 offset-lg-1">
                <div class="interior_text">
                    @if ( Config::get('app.locale') == 'ar')
                    <h1>حمل تطبيق موكا</h1>
                        <p style="text-align: start">تصفح واطلب كافة المنتجات التي نقدمها لكم،يمكنك وبكل سهولة إنشاء حسابك الخاص على التطبيق والتعرف اكثر على منتجاتنا.</p>
                        <h5>حمل التطبيق الآن</h5>

                    @else
                    <h1>Download Moka application</h1>
                        <p style="text-align: start">Browse and order all the products that we offer you, you can easily create your own account on the application and learn more about our products.</p>
                        <h5>Download the app now</h5>


                    @endif
                    {{--                            <p style="text-align: start">يتوفّر الآن إصــــدار أكثر تطوّرًا وأمانًا وسهولةً في الاستخــدام بإمكانكم الآن تصفح جميع منتجــات وحلويات موكا والطلب عبر الإنترنت ويوجد كذالك خدمة التوصيل للمنازل</p>--}}
{{--                    <p class="p-mobile">--}}
{{--                        <a href="#"><img loading="lazy" class="png-btn-app" src="@if ( Config::get('app.locale') == 'ar') {{asset('moka-assets/css/mobile/unnamed (3).png')}} @else {{asset('moka-assets/css/mobile/unnamed (5).png')}} @endif"></a>--}}
{{--                        <a href="#"><img loading="lazy" class="png-btn-play" src="@if ( Config::get('app.locale') == 'ar') {{asset('moka-assets/css/mobile/unnamed (4).png')}} @else {{asset('moka-assets/css/mobile/unnamed (6).png')}} @endif"></a>--}}
{{--                    </p>--}}

                        <style>
                            .btn-get-it:hover {
                                background-color: #fff;
                                /*background-color: #002581;*/
                                color: #002581;
                                border-color: #002581;
                            }
                            .btn-get-it {
                                width: 125px;
                                margin:5px;
                            }

                            @media (max-width: 400px) {
                                .btn-get-it {
                                    width: 115px;
                                    margin:1px;
                                }
                            }
                        </style>
                        <div class="app_btn_area">
                            <a href="{{ config('app.android_app_link') ?? "#" }}" class="app_btn_area-href">
                                <img src="{{ asset('moka-assets\assets\images\2store-min.png') }}" style="height: 3rem; border-radius: 5px;padding: 5px 0 0 15px;"/>
                            </a>
                            <a href="{{ config('app.ios_app_link') ?? "#"}}" class="app_btn_area-href">
                                <img src="{{ asset('moka-assets\assets\images\1store-min.png') }}" style="height: 3rem; border-radius: 5px;padding: 5px 0 0 15px;"/>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
