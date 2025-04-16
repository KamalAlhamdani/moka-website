{{--products-grid.html--}}
@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - المنتجات')
@else
    @php($page_title = 'Moka Sweets - Categories')
@endif
@extends('layout.mainlayout')
@section('content')
    <!-- ========================  Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $category_name = 'أقسام المنتجات' : $category_name = 'Category')
    <section class="main-header"
             style="filter: brightness(0.9);
             /* background-image:url({{url('moka-assets/assets/images/headers/categories.png')}}) */
             ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $category_name }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="/"><span class="icon icon-home"></span></a></li>
                    {{--<li><a href="category.html">Category</a></li>--}}
                    <li><a class="active" href="#">{{ $category_name }}</a></li>
                </ol>
            </div>
        </header>
    </section>

    <!-- ========================  Products ======================== -->

    <section class="products">
        <div class="container">

            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2 class="title">{{__('_moka_home.products_categories')}}</h2>
                        {{-- <div class="text">
                            <p>{{__('_moka_home.choose_category_to_shop')}}</p>
                        </div> --}}
                    </div>
                </div>
            </header>

            <div class="row categories-items">

            @foreach($categories as $category)
                <!-- === product-item === -->
                    <div class="col-md-3 col-xs-6">
                        <article>
                            <div class="figure-block">
                                <div class="image">
                                    <a href="{{ route("products") }}?category_id={{ $category->id }}">
                                        <img loading="lazy" src="{{domainAsset($category->image)}}" alt="" width="360"
                                             onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';"/>
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="{{ route("products") }}?category_id={{ $category->id }}">
                                           {{ $category->name }}
                                        </a></h2>
                                    {{-- <sup>{{ $category->name }}</sup> --}}
                                    {{-- <span class="description clearfix">{{ $category->details }}</span> --}}
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div><!--/row-->

        </div><!--/container-->
    </section>
@endsection
{{-- @push('footer-script-stack') --}}
    {{-- @include('_moka.categories.categories-index-backup') --}}
{{-- @endpush --}}
