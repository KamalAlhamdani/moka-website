<section class="checkout">
    <div class="container">

        <header class="hidden-stopped">
            <h3 class="h3 title">{{__('_moka_checkout.payment')}}</h3>
        </header>
        @if (session('cart_status'))
            <div class="alert alert-warning">
                {{ session('cart_status') }}
            </div>
        @endif

        <!-- ========================  Cart navigation ======================== -->

        <div class="clearfix">
            {{-- TODO: fix rtl issue --}}
            @if( app()->getLocale() == 'ar' )
            <div class="row">
                    <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-right' }}">
                        {{-- <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}} </a> --}}
                        <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main" onclick="event.preventDefault();document.getElementById('request-order-form').submit();">
                            <span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}}
                        </a>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                        <a href="{{ route('web.checkout.delivery') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-right"></span> {{ __('_moka_checkout.back_to_delivery') }}</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                    <a href="{{ route('web.checkout.delivery') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> {{ __('_moka_checkout.back_to_delivery') }}</a>
                </div>
                <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                    {{-- <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}}</a> --}}
                    <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main" onclick="event.preventDefault();document.getElementById('request-order-form').submit();">
                        <span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}}
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- ========================  Delivery ======================== -->

        <div class="cart-wrapper">

            <div class="note-block">
                <div class="row">
                    <!-- === right content === -->

                    <div class="col-md-6">

                            <div class="white-block deliver-wrapper">
    
                                <div class="h4"> @moka_strtoupper(__('_moka_checkout.choose_payment')) </div>
    
                                <hr />
    
                                <span class="checkbox"><!--deliver-->
                                    <input class="radiogroup_payment_type" value="cash" type="radio" id="deliveryId2" name="deliveryOption" autocomplete="off" checked>
                                    <label class="deliveryId2" for="deliveryId2">{{ __('_moka_checkout.cash')}}</label>
                                </span>
    
                                <span class="checkbox"><!--from_branch-->
                                    <input class="radiogroup_payment_type" value="fromWallet" type="radio" id="deliveryId1" name="deliveryOption" autocomplete="off">
                                    <label class="deliveryId1" for="deliveryId1"> {{ __('_moka_checkout.from_balance')}} </label>
                                </span>
    
    
                                <br />
    
                                {{-- TODO: if needed explain each method of delivery --}}
                                <div class="clearfix">
                                    <div class="h4">@moka_strtoupper(__('_moka_checkout.delivery_info'))</div>

                                    <hr />
        
                                    <div class="row">
        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>{{__('_moka_nav.name')}}</strong> <br />
                                                <span>{{auth()->user()->name}}</span>
                                            </div>
                                        </div>
        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>{{__('_moka_nav.phone')}}</strong><br />
                                                <span>{{auth()->user()->phone}}</span>
                                            </div>
                                        </div>
        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>{{__('_moka_nav.email')}}</strong><br />
                                                <span>{{auth()->user()->email}}</span>
                                            </div>
                                        </div>
        
                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <strong>{{__('_moka_nav.address')}}</strong><br />
                                                <span>795 Folsom Ave, Suite 600</span>
                                            </div>
                                        </div> --}}
        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(Session::get('receiving_type') === 'fromBranch')
                                            {{-- عنوان الاستلام --}}
                                            <strong>{{__('_moka_checkout.receiving_address')}}</strong><br /> {{ \CheckoutUtilities::getSelectedBranchAddress(Session::get('deliver_location_id')) }}
                                            @elseif(Session::get('receiving_type') === 'delivery')
                                            {{-- توصيل إلى --}}
                                            <strong>{{__('_moka_checkout.delivery_to')}}</strong><br /> {{ \CheckoutUtilities::getSelectedUserAddress(Session::get('deliver_location_id')) }}
                                            @else
                                            {{__('_moka_checkout.no_delivery_info')}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>

                    <!-- === left content === -->

                    <div class="col-md-6">

                        <!-- === delivery-wrapper === -->

                        <div class="delivery-wrapper">

                            <div class="white-block">

                                <!--deliver-->

                                <div class="delivery-block delivery-block-signin">

                                    <div class="h4">
                                        @moka_strtoupper(__('_moka_checkout.cash'))
                                        {{-- <a href="javascript:void(0);" class="btn btn-main btn-xs btn-register pull-right">create an account</a> --}}
                                    </div>

                                    <hr />

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label type="submit" class="label label-primary"> {{__('_moka_checkout.amount_to_be_paid')}} </label>
                                            {{-- TODO: this price used at bottom of cart review --}}
                                            <input readonly autocomplete="off" class="form-control text-center" value="{{ \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label type="submit" class="label label-primary"> {{__('_moka_checkout.amount_to_be_paid')}} </label>
                                        </div> 
                                    </div> --}}
                                </div> <!--/deliver-->
                                <!--from_branch-->

                                <div class="delivery-block delivery-block-signup">

                                    <div class="h4">
                                        @moka_strtoupper(__('_moka_checkout.from_balance'))
                                        {{-- <a href="javascript:void(0);" class="btn btn-main btn-xs btn-login pull-right">Log in</a> --}}
                                    </div>

                                    <hr />

                                    {{-- TODO: add use this balance --}}
                                    <form class="row" method="GET" action="#">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputEmail3"> {{__('_moka_checkout.balance_state')}} 
                                                    @if( \CheckoutUtilities::getUserBalance()->data->total_user_balance < \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') )
                                                    <span class="label label-warning">{{__('_moka_checkout.your_balance_insufficient')}}</span>
                                                    @endif
                                                    @if( \CheckoutUtilities::getUserBalance()->data->total_user_balance >= \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') )
                                                    <span class="label label-danger">{{__('_moka_checkout.your_balance_sufficient')}}</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                @if( \CheckoutUtilities::getUserBalance()->data->total_user_balance < \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') )
                                                <label type="submit" class="label label-warning"> {{__('_moka_checkout.balance_amount')}} </label>
                                                @else
                                                <label type="submit" class="label label-danger"> {{__('_moka_checkout.balance_amount')}} </label>
                                                @endif
                                                <input readonly autocomplete="off" class="form-control text-center" value="{{\CheckoutUtilities::getUserBalance()->data->total_user_balance}}">
                                            </div>
                                        </div>
                                        @if(\CheckoutUtilities::getUserBalance()->data->total_user_balance - \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price')  < 0)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label type="submit" class="label label-primary"> {{__('_moka_checkout.amount_to_be_paid')}} </label>
                                                <input readonly autocomplete="off" class="form-control text-center" value="{{ \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price')  - \CheckoutUtilities::getUserBalance()->data->total_user_balance}}">
                                            </div>
                                        </div>
                                        @endif
                                    </form>
                                </div> <!--/from_branch-->
                            </div>
                        </div> <!--/delivery-wrapper-->
                    </div> <!--/col-md-6-->
                    
                </div>
            </div>
        </div>
        

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
                    <span>{{__('_moka_home.price')}}</span>
                </div>
            </div>

            <!--cart items-->

            <div class="clearfix">
                @include('_moka.Checkout.delivery.delivery-products')
                @include('_moka.Checkout.delivery.delivery-offer')
                @include('_moka.Checkout.delivery.delivery-special')
                @include('_moka.Checkout.delivery.delivery-hospitality')
            </div>

            <!--cart prices -->

            <div class="clearfix">
                <div class="cart-block cart-block-footer clearfix">
                    <div>
                        <strong> {{ __('_moka_checkout.cart_price') }} </strong>
                    </div>
                    <div>
                        <span  {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ \Cart::getTotalItemsPrice() }}</span>
                    </div>
                </div>

                {{-- TODO: show this if coupon used --}}
                {{-- @if(null !== Session::get('coupon_price') || Session::get('coupon_price') != 0) --}}
                @if(Session::get('coupon_price') != 0)
                <div class="cart-block cart-block-footer clearfix">
                    <div>
                        <strong> {{ __('_moka_checkout.coupon_price') }} </strong>
                    </div>
                    <div>
                        <span  {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ Session::get('coupon_price') }}</span>
                    </div>
                </div>
                @endif
                
                @if(Session::get('receiving_type') == 'delivery' && Session::get('delivery_price') != 0)
                <div class="cart-block cart-block-footer clearfix">
                    <div>
                        <strong> {{ __('_moka_checkout.delivery_price') }} </strong>
                    </div>
                    <div>
                        <span  {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ Session::get('delivery_price') }}</span>
                    </div>
                </div>
                @endif

                {{-- <div class="cart-block cart-block-footer clearfix">
                    <div>
                        <strong>Shipping</strong>
                    </div>
                    <div>
                        <span>$ 30,00</span>
                    </div>
                </div> --}}

                {{-- <div class="cart-block cart-block-footer clearfix">
                    <div>
                        <strong>VAT</strong>
                    </div>
                    <div>
                        <span>$ 59,00</span>
                    </div>
                </div> --}}
            </div>

            <!--cart final price -->

            <div class="clearfix">
                <div class="cart-block cart-block-footer clearfix">
                    <div>
                        {{-- TODO: coupon included label if coupon used, total price only of coupon not used --}}
                        <div class="h2 title"><strong>{{ __('_moka_home.total_price') }} <small>{{ null !== Session::get('coupon_price') && Session::get('coupon_price') != 0 ? __('_moka_checkout.coupon_included') : '' }}</small></strong></div>
                    </div>
                    <div>
                        {{-- TODO: this price used at top when use cash payment and calculate of fromWallet --}}
                        <div class="h2 title" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') < 0 ? 0 : \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') }}</div>
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
                        {{-- <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}} </a> --}}
                        <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main" onclick="event.preventDefault();document.getElementById('request-order-form').submit();">
                            <span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}}
                        </a>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                        <a href="{{ route('web.checkout.delivery') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-right"></span> {{ __('_moka_checkout.back_to_delivery') }}</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                    <a href="{{ route('web.checkout.delivery') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> {{ __('_moka_checkout.back_to_delivery') }}</a>
                </div>
                <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                    {{-- <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}}</a> --}}
                    <a href="{{ route('web.checkout.receipt') }}" class="btn btn-main" onclick="event.preventDefault();document.getElementById('request-order-form').submit();">
                        <span class="icon icon-cart"></span> {{__('_moka_checkout.order_now')}}
                    </a>
                </div>
            </div>
            @endif
        </div>
        <form id="request-order-form" action="{{ route('web.request.order') }}" method="post" style="display: inline; padding:5px;">
            @csrf{{--TODO: dont use this info [coupon, total_price--}}
            <input type="hidden" name="payment_type"        value="cash" id="payment_type">
            <input type="hidden" name="receiving_type"      value="">
            <input type="hidden" name="deliver_location_id" value="">
            <input type="hidden" name="confirm"             value="">
            @if(session('coupon_number') !== null && session('coupon_number') != 0)
            <input type="hidden" name="coupon_number"       value="{{ session('coupon_number') }}">
            @endif
            <input type="hidden" name="cart_id"             value="">
            <input type="hidden" name="delivery_price_id"   value="">
            <input type="hidden" name="note"                value="">
            {{-- Used in receipt page --}}
            <input type="hidden" name="cart_items_count"    value="{{ \Cart::getItemCount() }}">
            <input type="hidden" name="amount_to_be_paid"   value="{{ \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') }}">
            <input type="hidden" name="cart_price"          value="{{ \Cart::getTotalItemsPrice() }}">
            @if(Session::get('coupon_price') != 0)
            <input type="hidden" name="coupon_price"        value="{{ Session::get('coupon_price') }}">
            @endif
            @if(Session::get('receiving_type') == 'delivery' && Session::get('delivery_price') != 0)
            <input type="hidden" name="delivery_price"      value="{{ Session::get('delivery_price') }}">
            @endif
            <input type="hidden" name="total_price"         value="{{ \Cart::getTotalItemsPrice() - Session::get('coupon_price') + Session::get('delivery_price') }}">
        </form>
        <script>
            const paymentType = document.getElementById("payment_type");
            const inputs = document.querySelectorAll('.radiogroup_payment_type');

            /* A simple function to handle the click event for each input. */
            /* const clickHandler = i => { */
            const clickHandler = function(i) {
                paymentType.value = i.getAttribute("value");
            };

            /* Possibly even less code again.  */
            inputs.forEach(i => i.onclick = () => clickHandler(i));
        </script>


    </div> <!--/container-->

</section>
