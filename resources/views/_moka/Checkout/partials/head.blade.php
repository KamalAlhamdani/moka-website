@php(app()->getLocale() == 'ar' ? $page_name = 'صندوق الدفع' : $page_name = 'Checkout')
<section class="main-header" style="filter: brightness(0.9);
/* background-image:url({{url('moka-assets/assets/images/headers/products.jpg')}}) */
">
    <header>
        <div class="container text-center">
            {{-- <h1 class="h2 title">{{ $page_name }}</h1> --}}
            <ol class="breadcrumb breadcrumb-inverted">
                <li><a href="{{url('')}}"><span class="icon icon-home"></span></a></li>
                <li><a @if($page_step == 1) class="active" @endif href="{{ route('web.checkout.items') }}"> {{__('_moka_checkout.cart_items')}} </a></li>
                <li><a @if($page_step == 2) class="active" @endif href="{{ route('web.checkout.delivery') }}"> {{__('_moka_checkout.delivery')}} </a></li>
                <li><a @if($page_step == 3) class="active" @endif href="{{ route('web.checkout.payment') }}"> {{__('_moka_checkout.payment')}} </a></li>
                <li><a @if($page_step == 4) class="active" @endif href="{{ route('web.checkout.receipt') }}"> {{__('_moka_checkout.receipt')}} </a></li>
            </ol>
        </div>
    </header>
</section>

<!-- ========================  Checkout ======================== -->

<div class="step-wrapper">
        <div class="container text-center">
            <div class="stepper">
                {{-- TODO: try to fix dir=rtl using {{ app()->getLocale() == 'ar' ? 'dir=rtl' : 'dir=ltr' }} attribute --}}
                @if(app()->getLocale() == 'ar')
                <ul class="row">
                    <li class="col-md-3 @if($page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.receipt')}}"></span>
                    </li>
                    <li class="col-md-3 @if($page_step == 3 || $page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.payment')}}"></span>
                    </li>
                    <li class="col-md-3 @if($page_step == 2 || $page_step == 3 || $page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.delivery')}}"></span>
                    </li>
                    <li class="col-md-3 @if($page_step == 1 || $page_step == 2 || $page_step == 3 || $page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.cart_items')}}"></span>
                    </li>
                </ul>
                @else
                <ul class="row">
                    <li class="col-md-3 @if($page_step == 1 || $page_step == 2 || $page_step == 3 || $page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.cart_items')}}"></span>
                    </li>
                    <li class="col-md-3 @if($page_step == 2 || $page_step == 3 || $page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.delivery')}}"></span>
                    </li>
                    <li class="col-md-3 @if($page_step == 3 || $page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.payment')}}"></span>
                    </li>
                    <li class="col-md-3 @if($page_step == 4) active @endif">
                        <span data-text="{{__('_moka_checkout.receipt')}}"></span>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>

