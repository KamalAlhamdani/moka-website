@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - المنتجات')
@else
    @php($page_title = 'Moka Sweets - Products')
@endif
@extends('layout.mainlayout')
@section('content')

    <!-- ======================== Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $product_name = 'النماذج' : $product_name = 'Samples')
    @php(app()->getLocale() == 'ar' ? $showcase_name = 'النماذج' : $showcase_name = 'Samples')
    <section class="main-header" style="filter: brightness(0.9);
    /* background-image:url({{asset('moka-assets/assets/images/headers/categories.png')}}) */
    ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $product_name }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="{{ url('/') }}"><span class="icon icon-home"></span></a></li>
                    <li><a class="active" href="{{ url('/samples') }}">{{ $showcase_name }}</a></li>
                    {{-- <li><a class="active"href="#">{{ $product_name }}</a></li> --}}
                </ol>
            </div>
        </header>
    </section>

    <style>
        .owl-icons-wrapper.owl-icons-frontpage {
            margin-top: 0;
        }
        @media screen and (min-width: 992px) {
            .toggle-filters-mobile, .close-filter{
                display: none;
            }

        }
        @media (min-width: 768px) {
            .products article .figure-block .text {
                padding: 0px;
            }
        }
        .products article .image {
            padding: 2rem;
            padding-bottom: 0px;
        }
    </style>
    @include('.layout.partials.components.owl-categories-icons')

    <!-- ======================== Products ======================== -->
    <section class="products">
        <div class="container">

            <header>
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center">
                        <h2 class="title">{{__('_moka_nav.samples')}}</h2>
                    </div>
                </div>
            </header>

            <div class="row categories-items">

            @foreach($showcases as $showcase)
                <!-- === product-item === -->
                    <div class="col-md-3 col-xs-6">
                        <article>
                            <div class="figure-block">
                                <div class="image">
                                    {{--<a href="{{ route("samples") }}?showcase_id={{ $showcase->id }}">--}}
                                        <img loading="lazy" src="{{domainAsset('storage/'.$showcase->image)}}" alt="" width="360"
                                             onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';"/>
                                    {{-- </a> --}}
                                </div>
                                <div class="text">
                                    <h2 class="title h4">
                                           {{-- {{ $showcase->id }} --}}
                                           <a href="{{ route('samples', $showcase->id) }}"> {{ $showcase->name  }} </a>
                                    </h2>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div><!--/row-->

        </div><!--/container-->
        {{-- TODO: make full image size modal --}}
    </section>

@endsection
@push('footer-script-stack')
<script>

</script>
@endpush
