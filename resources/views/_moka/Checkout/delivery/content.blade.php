<section class="checkout">
    <div class="container">

        <header class="hidden-stopped">
            <h3 class="h3 title">{{__('_moka_checkout.delivery')}}</h3>
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
                        <a href="{{ route('web.checkout.payment') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.go_to_payment')}} </a>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                        <a href="{{ route('web.checkout.items') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-right"></span> {{ __('_moka_checkout.back_to_cart') }}</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                    <a href="{{ route('web.checkout.items') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> {{ __('_moka_checkout.back_to_cart') }}</a>
                </div>
                <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                    <a href="{{ route('web.checkout.payment') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.go_to_payment')}}</a>
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
    
                                <div class="h4"> @moka_strtoupper(__('_moka_checkout.choose_delivery')) </div>
    
                                <hr />

                                {{-- TODO: auto focus on selected method with sliding --}}
                                <span class="checkbox"><!--deliver-->
                                    <input type="radio" id="deliveryId2" name="deliveryOption" checked>
                                    <label class="deliveryId2" for="deliveryId2">{{ __('_moka_checkout.deliver')}}</label>
                                </span>
    
                                <span class="checkbox"><!--from_branch-->
                                    <input type="radio" id="deliveryId1" name="deliveryOption"  @if(\CheckoutUtilities::getSelectedBranchAddress(Session::get('receiving_type')) == 'fromBranch') checked @endif>
                                    <label class="deliveryId1" for="deliveryId1"> {{ __('_moka_checkout.from_branch')}} </label>
                                </span>
    
    
                                <hr />
    
                                {{-- TODO: if needed explain each method of delivery --}}
                                <div class="clearfix">
                                    <p>{{__('_moka_checkout.your_current_delivery_info')}}</p>
                                    <ul>
                                        @if(Session::get('receiving_type') === 'fromBranch')
                                        {{-- عنوان الاستلام --}}
                                        <li><strong>{{__('_moka_checkout.receiving_address')}}</strong> {{ \CheckoutUtilities::getSelectedBranchAddress(Session::get('deliver_location_id')) }} </li>
                                        @elseif(Session::get('receiving_type') === 'delivery')
                                        {{-- توصيل إلى --}}
                                        <li><strong>{{__('_moka_checkout.delivery_to')}}</strong> {{ \CheckoutUtilities::getSelectedUserAddress(Session::get('deliver_location_id')) }} </li>
                                        
                                        {{-- TODO: delivery price --}}
                                        {{-- سعر التوصيل --}}
                                        <li><strong>{{__('_moka_checkout.delivery_price')}}</strong> {{ __('_moka_checkout.free') }} </li>
                                        @else
                                        <li>{{__('_moka_checkout.no_delivery_info')}}</li>
                                        @endif
                                    </ul>
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
                                        @moka_strtoupper(__('_moka_checkout.deliver'))
                                        {{-- <a href="javascript:void(0);" class="btn btn-main btn-xs btn-register pull-right">create an account</a> --}}
                                    </div>

                                    <hr />

                                    {{-- TODO: add use this location --}}
                                    {{-- <form class="row" method="GET" action="#"> --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputEmail3"> {{__('_moka_checkout.choose_location')}} 
                                                    @if(!count(\CheckoutUtilities::getUserAddresses()->data))
                                                    <span class="label label-warning">{{__('_moka_checkout.you_dont_have_location')}}</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        @if(count(\CheckoutUtilities::getUserAddresses()->data))
                                        <form id="use-delivery-address" action="{{ route('web.deliver.address.post') }}" method="post" style="display: inline; padding:5px;">
                                            @csrf
                                            <input type="hidden" name="type" class="form-control form-coupon" value="delivery"/>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="id" class="form-control text-center" id="sel1">
                                                        @foreach ( \CheckoutUtilities::getUserAddresses()->data as $item)   
                                                            <option class="text-center" value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="#" onclick="event.preventDefault();document.getElementById('use-delivery-address').submit();">
                                                        <button type="submit" class="btn btn-main btn-block"> {{__('_moka_checkout.use_location')}} </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                    {{-- </form> --}}
                                </div> <!--/deliver-->
                                <!--from_branch-->

                                <div class="delivery-block delivery-block-signup">

                                    <div class="h4">
                                        @moka_strtoupper(__('_moka_checkout.from_branch'))
                                        {{-- <a href="javascript:void(0);" class="btn btn-main btn-xs btn-login pull-right">Log in</a> --}}
                                    </div>

                                    <hr />

                                    {{-- TODO: add use this branch --}}
                                    {{-- <form class="row" method="GET" action="#"> --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputEmail3"> {{__('_moka_checkout.choose_branch')}} 
                                                    @if(!count(\CheckoutUtilities::getBranchesAddress()->data))
                                                    <span class="label label-warning">{{__('_moka_checkout.there_is_no_available_branch')}}</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        @if(count(\CheckoutUtilities::getBranchesAddress()->data))
                                        <form id="use-branch-address" action="{{ route('web.deliver.address.post') }}" method="post" style="display: inline; padding:5px;">
                                            @csrf
                                            <input type="hidden" name="type" class="form-control form-coupon" value="fromBranch"/>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="id" class="form-control text-center" id="sel1">
                                                        @foreach ( \CheckoutUtilities::getBranchesAddress()->data as $item)   
                                                            <option class="text-center" value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="#" onclick="event.preventDefault();document.getElementById('use-branch-address').submit();">
                                                        <button type="submit" class="btn btn-main btn-block"> {{__('_moka_checkout.use_branch')}} </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                    {{-- </form> --}}
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
                        <span  {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{\Cart::getTotalItemsPrice()}}</span>
                    </div>
                </div>

                {{-- Show this if coupon used --}}
                @if(Session::get('coupon_number'))
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
                        <div class="h2 title" {{ app()->getLocale() == 'en' ?: 'style=float:left' }}>{{ Session::get('coupon_number') ? (\Cart::getTotalItemsPrice() - Session::get('coupon_price') < 0 ? 0 : \Cart::getTotalItemsPrice() ) : \Cart::getTotalItemsPrice()}}</div>
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
                        <a href="{{ route('web.checkout.payment') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.go_to_payment')}} </a>
                    </div>
                    <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-left' }}">
                        <a href="{{ route('web.checkout.items') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-right"></span> {{ __('_moka_checkout.back_to_cart') }}</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-xs-6 {{ app()->getLocale() == 'en' ?: 'text-left' }}">
                    <a href="{{ route('web.checkout.items') }}" class="btn btn-clean-dark"><span class="icon icon-chevron-left"></span> {{ __('_moka_checkout.back_to_cart') }}</a>
                </div>
                <div class="col-xs-6 {{ app()->getLocale() == 'ar' ?: 'text-right' }}">
                    <a href="{{ route('web.checkout.payment') }}" class="btn btn-main"><span class="icon icon-cart"></span> {{__('_moka_checkout.go_to_payment')}}</a>
                </div>
            </div>
            @endif
        </div>


    </div> <!--/container-->

</section>
