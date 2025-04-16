
        <div class="navigation navigation-top clearfix">
            <ul>
                <!--add active class for current page-->

                @if(config('app.enable_social_nav_top'))
                <li><a href="{{ config('app.facebook_link') }}"><i class="fa fa-facebook"></i></a></li>
                <li><a href="{{ config('app.youtube_link') }}"><i class="fa fa-youtube"></i></a></li>
                <li><a href="{{ config('app.instagram_link') }}"><i class="fa fa-instagram"></i></a></li>
                @endif

            <!--Language selector-->

                <li class="nav-settings nav-icon">
                    <a href="javascript:void(0);" onclick="onChangeLang({{ app()->getLocale() == 'ar' ? 'eng' : 'arb' }})" class="nav-settings-value"> {{ Config::get('app.locale') == 'ar'? 'EN' : 'عرب'}}</a>
                    <ul class="nav-settings-list">
                        <li id="arb" onclick="onChangeLang(this)">عرب</li>
                        <li id="eng" onclick="onChangeLang(this)">EN</li>
                    </ul>
                </li>
                <script>

                    function onChangeLang(obj) {
                        var id= $(obj).attr("id");
                        switch(id){
                            case "arb":
                                window.location.href="/lang/ar";
                                break;

                            case "eng":
                                window.location.href="/lang/en";
                                break;
                        }
                    }

                </script>
                @if(Route::has('login'))
                    <li><a href="javascript:void(0);" class="open-login"><i class="icon {{ \Illuminate\Support\Facades\Auth::check() ? 'icon-user' : 'icon-users' }} nav-icon"></i></a></li>

                    @if(Illuminate\Support\Facades\Auth::check())
                        {{-- TODO: get cart items number--}}
                        <li><a href="javascript:void(0);" class="open-cart"><i class="icon icon-cart"></i> <span>{{ \Cart::getItemCount() }}</span></a></li>
                    @endif
                @endif
                <li><a href="javascript:void(0);" class="open-search"><i class="icon icon-magnifier nav-icon"></i></a></li>

            </ul>
        </div> <!--/navigation-top-->
