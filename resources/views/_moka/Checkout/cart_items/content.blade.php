{{-- {!! var_dump($cart) !!} --}}
{{-- {!! dd(\Cart::getCartProductItems()) !!} --}}
{{-- {!! dd(\Cart::getCartOfferItems()) !!} --}}
{{-- {!! dd(\Cart::getCartSpecialItems()) !!} --}}
{{-- {!! dd(\Cart::getCartHospitalityItems()) !!} --}}


<section class="checkout">

        <div class="container">

            <header class="hidden-stopped">
                <h3 class="h3 title">{{__('_moka_checkout.cart_items')}}</h3>
            </header>
            @if (session('cart_status'))
                <div class="alert alert-warning">
                    {{ session('cart_status') }}
                </div>
            @endif
            <!-- ========================  Cart wrapper ======================== -->

            <div class="cart-wrapper">
                <!--cart header -->

                <div class="cart-block cart-block-header clearfix">
                    <div>
                        <span>{{__('_moka_checkout.item')}}</span>
                    </div>
                    <div>
                        <span>&nbsp;</span>
                    </div>
                    <div>
                        <span>{{__('_moka_checkout.quantity')}}</span>
                    </div>
                    <div class="text-right">
                        <span>{{__('_moka_checkout.price')}}</span>
                    </div>
                </div>

                <!--cart items-->

                <div class="clearfix">
                    @if(\Cart::getItemCount() <= 0)
                    {{-- TODO: No items yet --}}
                    @else
                        @include('_moka.Checkout.cart_items.cart-items-products')
                        @include('_moka.Checkout.cart_items.cart-items-offer')
                        @include('_moka.Checkout.cart_items.cart-items-special')
                        @include('_moka.Checkout.cart_items.cart-items-hospitality')
                    @endif
                </div>

                <!--cart prices -->

                <div class="clearfix">
                    <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                        <div>
                            <span class="checkbox">
                                <form action="{{ route('web.coupon.check') }}" method="post">
                                    @csrf
                                    <input type="checkbox" id="couponCodeID" autocomplete="off">
                                    <label for="couponCodeID">{{ __('_moka_checkout.have_coupon') }}</label>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <input type="text" name="coupon" class="form-control form-coupon" value="" placeholder=" {{ __('_moka_checkout.enter_your_coupon_code')}}"/>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <span>&nbsp;&nbsp;</span>
                                    <input type="submit" class="form-control form-coupon" value="{{__('_moka_checkout.use')}}" />
                                </form>
                            </span>
                        </div>
                        <div>
                            {{-- Show this price if coupon entered --}}
                            {{-- TODO: add remove coupon --}}
                            @if(null !== Session::get('coupon_number'))
                            <div class="h2 title {{ app()->getLocale() == 'en' ?: 'text-right' }}">
                                <label class="label label-{{Session::get('coupon_number') ? 'primary' : 'warning'}}" style="padding-top: 0.6em;">
                                    {{
                                        !Session::get('coupon_number') ?
                                        __('_moka_checkout.coupon_not_valid')
                                        : Session::get('coupon_price')
                                    }}
                                </label>
                                <form id="remove-coupon-form" action="{{ route('web.coupon.remove') }}" method="post" style="display: inline; padding:5px;">
                                    @csrf
                                    <input type="hidden" name="coupon" class="form-control form-coupon" value="0"/>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('remove-coupon-form').submit();">
                                        <label class="label label-{{Session::get('coupon_number') ? 'primary' : 'warning'}}" style="padding-top: 0.6em;">
                                            <span class="icon icon-trash" style="margin-top:5px;"></span>
                                        </label>
                                    </a>
                                </form>
                            </div>
                            @endif
                    </div>
                    </div>

                    {{-- TODO: add note form --}}
                    <div class="cart-block cart-block-footer clearfix">
                        <div>
                            <strong>{{__('_moka_checkout.cart_note_add')}}</strong>
                        </div>
                        <div>
                            <form id="add-note-form" action="{{ route('web.note.add') }}" method="post" style="display: inline; padding:5px;">
                                @csrf
                                <textarea name="user_note" id="user_note" class="form-control" cols="30" rows="10" style="min-width: 540px" minlength="540" autocomplete="off">{{Session::get('user_note')}}</textarea>

                                <a href="#" onclick="event.preventDefault();document.getElementById('add-note-form').submit();">
                                    <label class="form-control slabel label-defaultd" style="padding-top: 0.6em;">
                                        <span class="icon icon-add" style="margin-top:5px;"></span>{{__('_moka_checkout.cart_note_add')}}
                                    </label>
                                </a>
                                {{-- <span {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>
                                </span> --}}
                            </form>
                        </div>
                    </div>

                    {{-- <div class="cart-block cart-block-footer clearfix">
                        <div>
                            <strong>Discount 15%</strong>
                        </div>
                        <div>
                            <span {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>$ 159,00</span>
                        </div>
                    </div> --}}

                    <div class="cart-block cart-block-footer clearfix">
                        <div>
                            <strong>{{__('_moka_checkout.cart_price')}}</strong>
                        </div>
                        <div>
                            <span {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ \Cart::getTotalItemsPrice() }}</span>
                        </div>
                    </div>

                    @if(Session::get('coupon_number'))
                    <div class="cart-block cart-block-footer clearfix">
                        <div>
                            <strong>{{__('_moka_checkout.coupon_price')}}</strong>
                        </div>
                        <div>
                            <span {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ Session::get('coupon_price') }}</span>
                        </div>
                    </div>
                    @endif

                </div>

                <!--cart final price -->

                <div class="clearfix">
                    <div class="cart-block cart-block-footer cart-block-footer-price clearfix">
                        <div>
                            <div class="h2 title">
                                <strong>{{ __('_moka_home.total_price') }}
                                    <small>{{ null !== Session::get('coupon_price') && Session::get('coupon_price') != 0 ? __('_moka_checkout.coupon_included') : '' }}</small>
                                </strong>
                            </div>

                        </div>
                        <div>
                            {{-- Show the coupon price if entered --}}
                            <div class="h2 title" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ Session::get('coupon_number') ? (\Cart::getTotalItemsPrice() - Session::get('coupon_price') < 0 ? 0 : \Cart::getTotalItemsPrice() ) : \Cart::getTotalItemsPrice() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================  Cart navigation ======================== -->

            <div class="clearfix">
                {{-- TODO: fix rtl issue --}}
                @if( app()->getLocale() == 'ar' )
                    <div class="row">
                        <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-right' }}">
                            <a href="{{ route('web.checkout.delivery') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.proceed_to_delivery')}} </a>
                        </div>
                        <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                            <a href="{{ route('products') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-right"></span> {{ __('_moka_checkout.shop_more') }}</a>
                        </div>
                    </div>
                @else
                <div class="row">
                    <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                        <a href="{{ route('products') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> {{ __('_moka_checkout.shop_more') }}</a>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                        <a href="{{ route('web.checkout.delivery') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.proceed_to_delivery')}}</a>
                    </div>
                </div>
                @endif
            </div>
{{--
            <div class="clearfix">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="#" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> Shop more</a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="checkout-2.html" class="btn btn-main"><span class="icon icon-cart"></span> Proceed to delivery</a>
                    </div>
                </div>
            </div> --}}

        </div> <!--/container-->

    </section>
