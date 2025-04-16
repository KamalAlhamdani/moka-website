        @if ( Config::get('app.locale') == 'ar')
            @php($page_title = 'حلويات موكا  - عنا')
        @else
            @php($page_title = 'Moka Sweets - about us')
        @endif
        @extends('layout.mainlayout')
        @section('content')


        @include('_moka.about.our-story-1')

        @include('_moka.about.begin-start')
        {{-- @include('_moka.about.begin-1') --}}
        @include('_moka.about.begin-2')
        @include('_moka.about.begin-3')
        @include('_moka.about.begin-4')
        @include('_moka.about.begin-5')
        @include('_moka.about.begin-6')
        @include('_moka.about.begin-end')

{{--        @include('_moka.about.creative')--}}
        {{--@include('_moka.about.our-story-2')--}}
        @include('_moka.about.our-story-3')
        @include('_moka.home.map')

        @endsection
