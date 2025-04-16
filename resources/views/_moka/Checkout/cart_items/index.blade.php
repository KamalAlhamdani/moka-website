{{--checkout-1.html--}}
@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - صندوق الدفع')
@else
    @php($page_title = 'Moka Sweets - Checkout')
@endif
@extends('layout.mainlayout')
@section('content')
    <!-- ========================  Main header ======================== -->

    @php(app()->getLocale() == 'ar' ? $section_name = 'محتويات السلة' : $section_name   = 'Cart Items')
    @php($page_step = 1)
    @include('_moka.Checkout.partials.head')
    @include('_moka.Checkout.cart_items.content')

@endsection
