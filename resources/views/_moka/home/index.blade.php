        @if ( Config::get('app.locale') == 'ar')
            {{-- @php($page_title = 'حلويات موكا  - اليمن -  معجنات ، آيس كريم ، بقلاوة ، تجهيز الحفلات والمناسبات') --}}
            @php($page_title = 'حلويات موكا')
        @else
            @php($page_title = 'Mokasweets')
        @endif
        @extends('layout.mainlayout')
        @section('content')

        @include('_moka.home.slider')

        @include('_moka.home.products')

        {{-- @include('_moka.home.map') --}}

        @endsection
