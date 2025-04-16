<!-- ==========  Login wrapper ========== -->
<div class="login-wrapper">

    @if(Auth::check())

        <div style="text-align: center; background-color: #fff">
            {{-- TODO: if needed show user image [ensure that the user can modify his/her image ]--}}
            {{--<img loading="lazy" style="border-radius: 50%; height: 256px" src="{{ url('storage/'.auth()->user()->image) }}">--}}
            <div style="height: 5px"></div>
            <h4>
                <i class="icon icon-user"></i> {{ auth()->user()->name }}
            </h4>
            <span class="alert alert-warning h5">
                {{ auth()->user()->status_message }}
            </span>
            <hr>
            <p>
                {{ auth()->user()->email }}
            </p>
            <p>
                {{ auth()->user()->address }}
            </p>
            <style>
                .user-info-box
                {
                    padding: 5px;
                }
                .user-info-details
                {
                    margin: 5px;
                    padding: 0 10px;
                }
            </style>
            <div class="user-info-box">
                <span class="user-info-details">{{ auth()->user()->phone }}</span>
                <span class="user-info-details">{{ auth()->user()->birth_date->format('Y-m-d') }}</span>
            </div>

        </div>
        <div style="text-align: center">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <button type="button" form="logout-form" class="btn btn-block btn-main">{{ __('_moka_nav.logout') }}</button>
            </a>
        </div>
    @else
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="h4 text-center">{{ __('_moka_nav.sign_in') }}</div>
            <div class="form-group">
                <input type="text" value="" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="{{__('_moka_nav.phone')}}" pattern="[0-9]{9}">
                {{-- <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" id="exampleInputEmail1" placeholder="{{ __('_moka_nav.phone') }}" > --}}
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" value="" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('_moka_nav.password')}}">
                {{-- <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" name="password" placeholder="{{ __('_moka_nav.password') }}"> --}}
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('_moka_nav.remember_me') }}
                </label>
            </div>
            <div class="form-group text-center">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" class="open-popup" href="{{ route('password.request') }}">
                        {{ __('_moka_nav.forget_password') }}
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-block btn-main">{{ __('_moka_nav.sign_in') }}</button>
        </form>
    @endif
</div>
