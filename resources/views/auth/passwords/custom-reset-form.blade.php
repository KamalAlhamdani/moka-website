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

                        <div class="login-block login-block-resetpassword" style="">
                            <div class="h4">{{__('_moka_home.reset_password')}}
                            </div>
                            <form class="p-a30 dez-form text-center"   method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                
                                <h3 class="form-title m-t0">{{__('_moka_nav.forget_password')}}</h3>
                                <div class="dez-separator-outer m-b5">
                                    <div class="dez-separator bg-primary style-liner"></div>
                                </div>
                                
                                <p>{{__('_moka_contact.email')}}</p>
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" name="email" title="{{ __('_moka_contact.email') }}" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <span style="display:block;" class="i i-close"></span>
                                        <span style="font-size:14px;"> {{ $message }} </span>
                                    </span>
                                    @enderror
                                </div>
                                
                                <p>{{__('_moka_nav.password')}}</p>
                                <div class="form-group">
                                    <input type="password" id="password" class="form-control" name="password" title="{{ __('_moka_nav.password') }}" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <span style="display:block;" class="i i-close"></span>
                                        <span style="font-size:14px;"> {{ $message }} </span>
                                    </span>
                                    @enderror
                                </div>
                                
                                <p>{{__('_moka_nav.password')}}</p>
                                <div class="form-group">
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" title="{{ __('_moka_nav.password') }}" required autocomplete="new-password">
                                </div>
                                    
                                <button class="site-button pull-right btn btn-block btn-main" type="submit">{{__('_moka_contact.send_email')}}</button>
                            </form>
                        </div>
                    </div>
                </div> <!--/login-wrapper-->
            </div> <!--/col-md-6-->

        </div>

    </div>
</section>