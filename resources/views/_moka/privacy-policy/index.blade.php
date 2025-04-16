@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - سياسة الخصوصية')
@else
    @php($page_title = 'Moka Sweets - Privacy Policy')
@endif
@extends('layout.mainlayout')
@section('content')
<style>
    @media (min-width: 990px) {
        nav .navigation .logo img {
            filter: brightness(0) invert(1);
        }
    }
</style>
    <section class="main-header"
             style="filter: brightness(0.9);
             /* background-image:url({{asset('moka-assets/assets/images/slider/policy-term.jpg')}}) */
             ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title" style="text-transform: uppercase">{{__('_moka_home.about')}}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="http://127.0.0.1:1000"><span class="icon icon-home"></span></a></li>
                    <li><a class="active" href="#">{{__('_moka_home.policy')}}</a></li>
                </ol>
            </div>
        </header>
    </section>
    @include('_moka.privacy-policy.privacy-policy')
@endsection
