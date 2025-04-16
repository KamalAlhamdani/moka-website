{{--checkout-2.html--}}
@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - صندوق الدفع')
@else
    @php($page_title = 'Moka Sweets - Checkout')
@endif
@extends('layout.mainlayout')
@section('content')
    <!-- ========================  Main header ======================== -->

    @php(app()->getLocale() == 'ar' ? $section_name = 'استلام الطلب' : $section_name   = 'Receive Request')
    @php($page_step = 3)
    @include('_moka.Checkout.partials.head')
    @include('_moka.Checkout.payment.content')

@endsection
