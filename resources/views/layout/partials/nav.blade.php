<!--Use class "navbar-fixed" or "navbar-default" -->
<!--If you use "navbar-fixed" it will be sticky menu on scroll (only for large screens)-->

<!-- ======================== Navigation ======================== -->
{{-- {{
dd(
    \Cart::getItemCount(),
    \Cart::getItemCount(),
)
}} --}}
<nav class="navbar-fixed">

    <div class="container">

        <!-- ==========  Top navigation ========== -->
        @include('layout.partials.nav-navigation-main')
        @include('layout.partials.nav-navigation-top')

        <!-- ==========  Main navigation ========== -->

        

        @include('layout.partials.search-wrapper')

        @if(Route::has('login'))
        @include('layout.partials.login-wrapper')
        @endif

        {{-- TODO: details of cart goes here --}}
        <!-- ==========  Cart wrapper ========== -->

        @include('layout.partials.nav-cart-wrapper')
        @include('layout.partials.general-error-message')
    </div> <!--/container-->
</nav>
