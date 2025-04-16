<div class="cart-wrapper" style="overflow: scroll;height: 480px;">
        <div class="checkout">
            @if(Auth::check())

            <div class="clearfix">

                <!--cart item-->

                <div class="row">
                    @if(\Cart::getItemCount() <= 0)
                        {{-- TODO: No items yet --}}
                    @else
                        @include('layout.partials.nav-cart-wrapper.nav-cart-items-products')
                        @include('layout.partials.nav-cart-wrapper.nav-cart-items-offers')
                        @include('layout.partials.nav-cart-wrapper.nav-cart-items-special')
                        @include('layout.partials.nav-cart-wrapper.nav-cart-items-hospitality')
                    @endif
                </div>

                <hr />

                <!--cart prices -->

                <div class="clearfix">
                    <div class="cart-block cart-block-footer clearfix">
                        <div>
                            <strong> {{ __('_moka_home.total_price') }} </strong>
                        </div>
                        <div>
                            <span>{{ \Cart::getTotalItemsPrice() }}</span>
                        </div>
                    </div>
                    {{-- TODO: enter note --}}
                    {{-- <div class="cart-block cart-block-footer clearfix">
                        <span>
                            <strong>ادخل ملاحظة</strong>
                            <div>
                                <form action="">

                                    <textarea class="form-control" type="text" placeholder="note" style="max-width: 100%; max-height: 240px; overflow-scrolling: auto"></textarea>
                                </form>
                            </div>
                        </span>

                    </div> --}}

                    {{-- TODO: Coupon input --}}
                    {{-- <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                        <div>
                            <span class="checkbox">
                                <input type="checkbox" id="couponCodeID">
                                <label for="couponCodeID">{{ __('لديك كوبون؟') }}</label>
                                &nbsp;
                                <input type="text" maxlength="6" class="form-control form-coupon" value="" style="display: none;">
                            </span>
                        </div>
                    </div> --}}


                </div>

                <hr />

                <!--cart final price -->

                {{-- <div class="clearfix">
                    <div class="cart-block cart-block-footer clearfix">
                        <div>
                            <strong>{{ __('_moka_home.price') }}</strong>
                        </div>
                        <div>
                            {{-- TODO: minimize coupon from total price --}}
                            {{-- <div class="h4 title">{{ (\Cart::getTotalItemsPrice())-(15000) }}</div>
                        </div>
                    </div>
                </div> --}}


                <!--cart navigation -->

                <div class="cart-block-buttons clearfix">
                    <div class="row">

                        <div class="col-xs-12 text-right">
                            <a href="{{ route('web.checkout.items') }} " class="btn btn-main"><span class="icon icon-cart"></span> Checkout</a>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div> <!--/checkout-->
    </div> <!--/cart-wrapper-->