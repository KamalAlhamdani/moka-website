
        @include('._moka.home.cards')
        @if(config('app.mobile_section'))
        @include('._moka.home.mobile')
        @endif
        @if(config('app.internet_order'))
        @include('._moka.home.orderNow')
        @endif
        @include('._moka.home.someProducts')

        {{-- Don't display --}}
        {{-- @include('._moka.home.mostSell') --}}

        @include('._moka.home.newProducts')
