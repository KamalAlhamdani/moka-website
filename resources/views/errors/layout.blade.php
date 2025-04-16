@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا')
@else
    @php($page_title = 'Moka Sweets')
@endif
@extends('layout.mainlayout')
@section('content')
<div style="width: 35rem; width: 65vh; text-align: center; margin: 12rem auto 2rem; margin: 24vh auto 2vh;">
    <img loading="lazy" src="{{asset('moka-assets/assets/images/error-codes/404-min.png')}}" alt="" style="width: inherit;">
    <h2>{{__('404')}}</h2>
</div>
@endsection
