{{-- <!--JS files--> --}}
{{-- <script src="{{asset('compressed/main.js')}}"></script> --}}
{{--in compressed/main.css--}}
{{-- <script src="{{asset('theme-assets/js/jquery.min.js')}}"></script> --}}
<script src="{{asset('moka-assets/js/jquery-3.5.1.min.js')}}"></script>

{{-- Both are stoped --}}
{{-- @include('.layout.partials.scriptes.offer-slider-data') --}}
{{-- @include('.layout.partials.scriptes.categories-nav-data') --}}

{{--in compressed/main.css--}}
{{-- <script src="{{asset('theme-assets/js/jquery.bootstrap.min.js')}}"></script> --}}
<script src="{{asset('moka-assets/js/jquery.bootstrap.min.js')}}"></script>
{{--in compressed/main.css--}}
<script acync src="{{asset('theme-assets/js/jquery.magnific-popup.min.js')}}"></script>
{{--in compressed/main.css--}}
<script src="{{asset('theme-assets/js/jquery.owl.carousel.min.js')}}"></script>
{{--in compressed/main.css--}}
<script acync src="{{asset('theme-assets/js/jquery.ion.rangeSlider.min.js')}}"></script>
{{--in compressed/main.css--}} {{-- Its works without 'theme-assets/js/jquery.isotope.pkgd.min.js' --}}
<script acync src="{{asset('theme-assets/js/jquery.isotope.pkgd.min.js')}}"></script>

{{-- masonry.pkgd.min.js Is not found --}}
{{-- <script  src="{{asset('theme-assets/js/masonry.pkgd.min.js')}}"></script> --}}
<script src="{{asset('theme-assets/js/main.js')}}"></script>
<script src="{{asset('moka-assets/js/main.js')}}"></script>

@if(($page_title == 'حلويات موكا  - تسجيل الدخول' || $page_title == 'Moka Sweets - Login') && 1)
    <script>
        $(function () {

            "use strict";

            var loginWrapper = $('.signin-wrapper'),
                loginBtn = loginWrapper.find('.btn-login'),
                // regBtn = loginWrapper.find('.btn-register'),
                resetPasswordBtn = loginWrapper.find('.btn-reset-password'), //
                signUp = loginWrapper.find('.login-block-signup'),
                signIn = loginWrapper.find('.login-block-signin');
                resetPassword = loginWrapper.find('.login-block-resetpassword');

            loginBtn.on('click', function () {
                signIn.slideDown();
                // signUp.slideUp();
                resetPassword.slideUp();
            });

            // regBtn.on('click', function () {
            //     signIn.slideUp();
            //     // signUp.slideDown();
            //     resetPassword.slideDown();
            // });

            resetPasswordBtn.on('click', function () {
                signIn.slideUp();
                // signUp.slideDown();
                resetPassword.slideDown();
            });


            // Checkout delivery method form
            // ----------------------------------------------------------------
        });
    </script>
@endif
@if($page_title == 'حلويات موكا  - صندوق الدفع' || $page_title == 'Moka Sweets - Checkout')

    @if(\CheckoutUtilities::getSelectedBranchAddress(Session::get('receiving_type')) == 'fromBranch')
    <script>
    $(function () {
        "use strict";

        // Checkout delivery method form
        // ----------------------------------------------------------------

        var deliveryWrapper = $('.delivery-wrapper'),
            DeliverWrapper = $('.deliver-wrapper'),
            deliveryBtn = DeliverWrapper.find('.deliveryId2'), //deliver option
            branchBtn = DeliverWrapper.find('.deliveryId1'), //from_branch option
            signUp = deliveryWrapper.find('.delivery-block-signup'), //branch form
            signIn = deliveryWrapper.find('.delivery-block-signin'); //deliver form

        // Initial the state of the forms
        signUp.slideUp();
        signIn.slideDown();

        deliveryBtn.on('click', function () {
            signIn.slideDown();
            signUp.slideUp();
        });

        branchBtn.on('click', function () {
            signIn.slideUp();
            signUp.slideDown();
        });
    });
    </script>
    @else
    <script>
        $(function () {

            "use strict";

            // Checkout delivery method form
            // ----------------------------------------------------------------

            var deliveryWrapper = $('.delivery-wrapper'),
                DeliverWrapper = $('.deliver-wrapper'),
                deliveryBtn = DeliverWrapper.find('.deliveryId2'), //deliver option
                branchBtn = DeliverWrapper.find('.deliveryId1'), //from_branch option
                signUp = deliveryWrapper.find('.delivery-block-signup'), //branch form
                signIn = deliveryWrapper.find('.delivery-block-signin'); //deliver form

            // Initial the state of the forms
            signIn.slideDown();
            signUp.slideUp();

            deliveryBtn.on('click', function () {
                signIn.slideDown();
                signUp.slideUp();
            });

            branchBtn.on('click', function () {
                signIn.slideUp();
                signUp.slideDown();
            });
        });
    </script>
    @endif
@endif
