@if($active_form == 'login')
    @php($upBtn = 'btn-login')
    @php($upForm = 'login-block-signup')
    @php($downBtn = 'btn-register')
    @php($downForm = 'login-block-signin')
    @if($upBtn == 'btn-register')
        @php($display_none = 'style=display:none;')
    @else
        @php($display_none = 'style')
    @endif
@else
    @php($upBtn = 'btn-register')
    @php($upForm = 'login-block-signin')
    @php($downBtn = 'btn-login')
    @php($downForm = 'login-block-signup')
    @if($upBtn == 'btn-login')
        @php($display_none = 'style=display:none;')
    @else
        @php($display_none = 'style')
    @endif
@endif

<section class="login-wrapper login-wrapper-page">
    <div class="container">

        <header class="hidden">
            <h3 class="h3 title">{{__('_moka_nav.sign_in')}}</h3>
        </header>

        <div class="row">

            <!-- === left content === -->

            <div class="col-md-6 col-md-offset-3">

                <!-- === signin-wrapper === -->

                <div class="signin-wrapper">

                    <div class="white-block">

                        <!--signin-->
                        <div class="login-block {{ $upForm }}" {{ $display_none }}>

                            <div class="h4">{{__('_moka_nav.sign_in')}} 
                                @if (Route::has('password.request'))
                                <a href="javascript:void(0);" class="btn btn-main btn-xs {{ $upBtn }} pull-right">{{__('_moka_home.reset_password')}}</a>
                                @endif
                            </div>

                            <hr>

                            <div class="row">
                                <form id="login-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" value="" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="{{__('_moka_nav.phone')}}" pattern="[0-9]{9}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password" value="" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('_moka_nav.password')}}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <span class="checkbox">
                                            {{-- <input type="checkbox" id="checkBoxId3"> --}}
                                            <input id="checkBoxId3" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                            <label for="checkBoxId3">{{__('_moka_nav.remember_me')}}</label>
                                        </span>
                                    </div>

                                    <div class="col-xs-6 text-right">
                                        <a href="#" onclick="event.preventDefault();document.getElementById('login-form').submit();">
                                            <button type="button" form="logout-form" class="btn btn-block btn-main">{{ __('_moka_nav.sign_in') }}</button>
                                        </a>
                                    </div>
    
                                    @if (Route::has('password.request'))
                                    <div class="h3">
                                        <div class="h3 {{app()->getLocale() == 'ar' ? 'pull-right' : 'pull-left'}}">
                                            <a href="javascript:void(0);" class="btn btn-link {{ $upBtn }} btn-reset-password">{{ __('_moka_nav.forget_password') }}</a>
                                            {{-- <a href="javascript:void(0);" class="btn btn-link btn-register btn-reset-password">{{ __('_moka_nav.forget_password') }}</a> --}}
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div> <!--/signin-->
                        <!--signup-->

                        @if (Route::has('password.request'))
                        {{-- Reset --}}
                        <div class="login-block {{ $downForm }}" {{ $display_none }}>
                        {{-- <div class="login-block login-block-resetpassword" style=""> --}}
                            <div class="h4">{{__('_moka_home.reset_password')}} 
                                <a href="javascript:void(0);" class="btn btn-main btn-xs {{ $downBtn }} pull-right">{{__('_moka_nav.sign_in')}}</a>
                            </div>
                            <form class="p-a30 dez-form text-center"   method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <h3 class="form-title m-t0">{{__('_moka_nav.forget_password')}}</h3>
                                <div class="dez-separator-outer m-b5">
                                    <div class="dez-separator bg-primary style-liner"></div>
                                </div>
                                <p>{{__('_moka_contact.email')}}</p>
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" name="email" title="{{ __('_moka_contact.email') }}" value="{{ old('email') }}" >
                                    @if ($errors->has('email'))
                                        <span style="display:block;" class="i i-close"></span>
                                        <span style="font-size:14px;"> {{ $errors->first('email') }} </span>
                                    @endif
                                </div>
                                <div class="form-group text-left"> 
                                {{-- <div class="form-group text-left"> <a class="site-button btn-login outline gray" data-toggle="tab" href="{{URL::to('login')}}">{{__('_moka_nav.sign_in')}}</a> --}}
                                    <button class="site-button pull-right btn btn-block btn-main">{{__('_moka_contact.send_email')}}</button>
                                </div>
                                <div class="h3">
                                    <div class="h3 {{app()->getLocale() == 'ar' ? 'pull-right' : 'pull-left'}}">
                                        <a class="btn btn-link {{ $downBtn }} btn-reset-password" data-toggle="tab" href="{{URL::to('login')}}">{{__('_moka_nav.sign_in')}}</a>
                                    </div><br>
                                </div>
                            </form>
                        </div>
                        @endif
                        {{-- <div class="login-block login-block-signup" style="">

                            <div class="h4">Register now <a href="javascript:void(0);" class="btn btn-main btn-xs btn-login pull-right">Log in</a></div>

                            <hr>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="First name: *">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Last name: *">
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Company name:">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Zip code: *">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="City: *">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Email: *">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" value="" class="form-control" placeholder="Phone: *">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <span class="checkbox">
                                        <input type="checkbox" id="checkBoxId1">
                                        <label for="checkBoxId1">I have read and accepted the <a href="#">terms</a>, as well as read and understood our terms of <a href="#">business contidions</a></label>
                                    </span>
                                    <span class="checkbox">
                                        <input type="checkbox" id="checkBoxId2">
                                        <label for="checkBoxId2">Subscribe to exciting newsletters and great tips</label>
                                    </span>
                                    <hr>
                                </div>

                                <div class="col-md-12">
                                    <a href="#" class="btn btn-main btn-block">Create account</a>
                                </div>

                            </div>
                        </div> <!--/signup--> --}}
                    </div>
                </div> <!--/login-wrapper-->
            </div> <!--/col-md-6-->

        </div>

    </div>
</section>
<script>
$(function () {

    "use strict";

    // Checkout login / register
    // ----------------------------------------------------------------

    var loginWrapper = $('.login-wrapper'),
        loginBtn = loginWrapper.find('.btn-login'),
        regBtn = loginWrapper.find('.btn-register'),
        signUp = loginWrapper.find('.login-block-signup'),
        signIn = loginWrapper.find('.login-block-signin');

        // signIn.slideDown();
        // signUp.slideUp();

        signIn.slideUp();
        signUp.slideDown();

    // loginBtn.on('click', function () {
    //     signIn.slideDown();
    //     signUp.slideUp();
    // });

    // regBtn.on('click', function () {
    //     signIn.slideUp();
    //     signUp.slideDown();
    // });
    
});

</script>
