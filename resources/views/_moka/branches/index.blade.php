@if ( Config::get('app.locale') == 'ar')
@php($page_title = 'حلويات موكا  ')
@else
@php($page_title = 'Moka Sweets')
@endif
@extends('layout.mainlayout')
@section('content')

@php(app()->getLocale() == 'ar' ? $name = 'الفروع' : $name = 'Branches')
@include('_moka.branches.header')
@include('_moka.branches.info')
@include('_moka.home.map')

@endsection
