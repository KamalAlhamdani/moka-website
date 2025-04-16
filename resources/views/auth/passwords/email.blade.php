@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - تسجيل الدخول')
@else
    @php($page_title = 'Moka Sweets - Login')
@endif
@extends('layout.mainlayout')

@section('content')

<!-- ========================  Main header ======================== -->
@php(app()->getLocale() == 'ar' ? $category_name = 'صفحة المستخدم' : $category_name = 'Customer Page')
<section class="main-header" style="
/* background-image:url({{url('moka-assets/assets/images/headers/categories.png')}}) */
">
    <header>
        <div class="container text-center">
            {{-- <h2 class="h2 title">{{ $category_name }}</h2> --}}
            <ol class="breadcrumb breadcrumb-inverted">
                <li><a href="index.html"><span class="icon icon-home"></span></a></li>
                {{-- <li><a class="active" href="login.html">{{__('_moka_nav.sign_in')}} &amp; {{__('_moka_nav.dont_have_account')}}</a></li> --}}
                <li><a class="activea" href="login.html">{{__('_moka_nav.sign_in')}}</a></li>
            </ol>
        </div>
    </header>
</section>
@php($active_form = 'emaila')
@include('auth.passwords.login-form')
@endsection
