@if ( Config::get('app.locale') == 'ar')
@php($page_title = 'حلويات موكا  ')
@else
@php($page_title = 'Moka Sweets')
@endif
@extends('layout.mainlayout')
@section('content')

@php(app()->getLocale() == 'ar' ? $name = 'تواصل معنا' : $name = 'Contact Us')
@include('_moka.contact-us.header')
@include('_moka.contact-us.info')
@include('_moka.home.map')

@endsection
