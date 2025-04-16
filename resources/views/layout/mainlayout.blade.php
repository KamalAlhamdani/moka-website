<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layout.partials.head')
    </head>
    <body>
{{--        <div class="page-loader"></div>--}}

        <div class="wrapper" {{ app()->getLocale() == 'ar' ? 'dir=rtl' : '' }}>
        @include('layout.partials.nav')
        @include('layout.partials.header')
        @yield('content')
        @include('layout.partials.footer')
        @include('layout.partials.footer-scripts')
        @stack('footer-script-stack')

        {{-- This is for search because it used in whole pages --}}
        @include('layout.partials.scriptes.search-wrapper-ajax')
        </div> <!--/wrapper-->
        {{-- This data for logged in users--}}
        @if(Auth::check())

        @endif
    </body>
</html>
