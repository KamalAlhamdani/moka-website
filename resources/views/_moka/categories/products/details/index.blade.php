@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - تفاصيل المنتج')
@else
    @php($page_title = 'Moka Sweets - Product Details')
@endif
@extends('layout.mainlayout')
@section('content')

    <!-- ======================== Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $product_name = 'المنتجات' : $product_name = 'Products')
    @php(app()->getLocale() == 'ar' ? $category_name = 'أقسام المنتجات' : $category_name = 'Categories')
    <section class="main-header" style="filter: brightness(0.9);
    /* background-image:url({{asset('moka-assets/assets/images/headers/categories.png')}}) */
    ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $product_name }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="{{ url('/') }}"><span class="icon icon-home"></span></a></li>
                    <li><a href="{{ url('/categories') }}">{{ $category_name }}</a></li>
                    <li><a class="active" href="#">{{ $product_name }}</a></li>
                </ol>
            </div>
        </header>
    </section>

    <!-- ========================  Product ======================== -->

    @if(count($product_details->prices) == 1 && 0)
    @include('_moka.categories.products.details.details')
    @else
    @include('_moka.categories.products.details.list')
    @endif

@endsection
@push('footer-script-stack')
@endpush
