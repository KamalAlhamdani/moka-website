<section class="checkout">
    <div class="container">

        <header class="hidden">
            <h3 class="h3 title">{{__('_moka_checkout.receipt')}}</h3>
        </header>

        <!-- ========================  Cart navigation ======================== -->
        
        <div class="clearfix">
            {{-- TODO: fix rtl issue --}}
            @if( app()->getLocale() == 'ar' )
            <div class="row">
                    <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-right' }}">
                            <span class="h2 title">@moka_strtoupper(__('_moka_checkout.your_order_is_completed'))</span>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                            <a onclick="window.print()" class="btn btn-main"><span class="icon icon-printer"></span> {{__('_moka_checkout.print')}}</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                        <a onclick="window.print()" class="btn btn-main"><span class="icon icon-printer"></span> {{__('_moka_checkout.print')}}</a>
                </div>
                <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                        <span class="h2 title">@moka_strtoupper(__('_moka_checkout.your_order_is_completed'))</span>
                </div>
            </div>
            @endif
        </div>
        
        <!-- ========================  Delivery ======================== -->

        <div class="cart-wrapper">

            <div class="note-block">

                <div class="row">
                    <!-- === left content === -->

                    <div class="col-md-6">

                        <div class="white-block">

                            <div class="h4">@moka_strtoupper(__('_moka_checkout.recipient_data'))</div>

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
{{-- 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>{{__('_moka_nav.address')}}</strong><br />
                                        <span>795 Folsom Ave, Suite 600</span>
                                    </div>
                                </div> --}}

                                
                            </div>

                        </div> <!--/col-md-6-->

                    </div>

                    <!-- === right content === -->

                    <div class="col-md-6">
                        <div class="white-block">

                            <div class="h4">@moka_strtoupper(__('_moka_checkout.delivery_info'))</div>

                            <hr />

                            <div class="row">
                                @if(Session::get('receiving_type') === 'fromBranch')
                                {{-- عنوان الاستلام --}}
                                {!! app()->getLocale() == 'ar' ? '<div class="col-md-6"></div>' : '' !!}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.receiving_address')}}</strong> <br />
                                        <span>{{ \CheckoutUtilities::getSelectedBranchAddress(Session::get('deliver_location_id')) }}</span>
                                    </div>
                                </div>
                                @elseif(Session::get('receiving_type') === 'delivery')
                                {{-- توصيل إلى --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.delivery_to')}}</strong> <br />
                                        <span>{{\CheckoutUtilities::getSelectedUserAddress(Session::get('deliver_location_id'))}}</span>
                                    </div>
                                </div>
                                
                                {{-- TODO: delivery price --}}
                                {{-- سعر التوصيل --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.delivery_price')}}</strong> <br />
                                        <span>{{ __('_moka_checkout.free') }}</span>
                                    </div>
                                </div>
                                @else
                                <li>{{__('_moka_checkout.no_delivery_info')}}</li>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.no_delivery_info')}}</strong> <br />
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="h4">@moka_strtoupper(__('_moka_checkout.payment_details'))</div>

                            <hr />

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.payment_type')}}</strong> <br />
                                        <span>{{__('_moka_checkout.'.Session::get('payment_type'))}}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.amount_to_be_paid')}}</strong><br />
                                        <span>{{Session::get('amount_to_be_paid')}}</span>
                                    </div>
                                </div>                           
{{-- 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>Cart details</strong><br />
                                        <span>**** **** **** 5446</span>
                                    </div>
                                </div> --}}

                                {{-- TODO: fix show items count --}}
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{__('_moka_checkout.cart_items_count')}}</strong><br />
                                        <span>{{ Session::get('cart_items_count') }}</span>
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <!-- ========================  Cart wrapper ======================== -->

        <div class="cart-wrapper">
            <!--cart header -->

            <div class="cart-block cart-block-header clearfix">
                {{-- <div>
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
                </div> --}}
            </div>

            <!--cart items-->

            {{-- TODO: get items from request history --}}
            {{-- <div class="clearfix">
                @include('_moka.Checkout.receipt.cart_items')
            </div> --}}

            <!--cart prices -->

            <div class="clearfix">
                <div class="cart-block cart-block-footer clearfix">
                    <div>
                        <strong> {{ __('_moka_checkout.cart_price') }} </strong>
                    </div>
                    <div>
                        <span  {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ Session::get('cart_price') }}</span>
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
                        <div class="h2 title" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{Session::get('total_price')}}</div>
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
                            <span class="h2 title">@moka_strtoupper(__('_moka_checkout.your_order_is_completed'))</span>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                            <a onclick="window.print()" class="btn btn-main"><span class="icon icon-printer"></span> {{__('_moka_checkout.print')}}</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                        <a onclick="window.print()" class="btn btn-main"><span class="icon icon-printer"></span> {{__('_moka_checkout.print')}}</a>
                </div>
                <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                        <span class="h2 title">@moka_strtoupper(__('_moka_checkout.your_order_is_completed'))</span>
                </div>
            </div>
            @endif
        </div>


    </div> <!--/container-->

</section>
