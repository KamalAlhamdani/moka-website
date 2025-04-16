{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '419')
@section('message', __('Not Found'))
 --}}

@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا')
@else
    @php($page_title = 'Moka Sweets')
@endif
@extends('layout.mainlayout')
@section('content')
<section class="main-header" style="filter: brightness(0.9);
/* background-image:url(http://127.0.0.1:2012/moka-assets/assets/images/headers/categories.png) */
">
    <header>
        <div class="container">
            {{-- <h1 class="h2 title">419</h1> --}}
            <ol class="breadcrumb breadcrumb-inverted">
                <li><a href="/"><span class="icon icon-home"></span></a></li>

                <li><a class="active" href="#">419</a></li>
            </ol>
        </div>
    </header>
</section>
<div style="width: 35rem; width: 65vh; text-align: center; margin: 12rem auto 2rem; margin: 24vh auto 2vh;">
    <img loading="lazy" src="{{asset('moka-assets/assets/images/error-codes/419-min.png')}}" alt="" style="width: inherit;">
    <h2>{{__('419')}}</h2>
</div>
@endsection

