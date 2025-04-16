{{--products-grid.html--}}
@if ( Config::get('app.locale') == 'ar')
    @php($page_title = 'حلويات موكا  - خريطة الموقع')
@else
    @php($page_title = 'Moka Sweets - Sitemap')
@endif
@extends('layout.mainlayout')
@section('content')
    <!-- ========================  Main header ======================== -->
    @php(app()->getLocale() == 'ar' ? $sitemap = 'خريطة الموقع' : $sitemap = 'Sitemap')
    <section class="main-header"
             style="filter: brightness(0.9);
             /* background-image:url({{url('moka-assets/assets/images/headers/categories.png')}}) */
             ">
        <header>
            <div class="container">
                {{-- <h1 class="h2 title">{{ $sitemap }}</h1> --}}
                <ol class="breadcrumb breadcrumb-inverted">
                    <li><a href="/"><span class="icon icon-home"></span></a></li>
                    {{--<li><a href="category.html">Category</a></li>--}}
                    <li><a class="active" href="#">{{ $sitemap }}</a></li>
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
                        <h2 class="title">{{ $sitemap }}</h2>
                    </div>
                </div>
            </header>

            <div class="row categories-items" style="text-align: {{app()->getLocale() == 'ar' ? 'right': 'left'}}" dir="{{app()->getLocale() == 'ar' ? 'rtl': 'ltr'}}">
              <div>
                <ul>
                  <li>
                    <a href="https://mokasweets.com">
                    {{__('_moka_nav.home')}}
                    </a>
                  </li>
                </ul>
                <ul>
                  <li>
                    <a href="https://mokasweets.com/about">
                    {{__('_moka_nav.about')}}
                    </a>
                  </li>
                </ul>
                <ul>
                  <li>
                    <a href="https://mokasweets.com/categories">
                      {{-- {{__('_moka_nav.categories')}} --}}
                      {{__('_moka_nav.products')}}
                    </a>
                  </li>
                </ul>

                <ul>
                  <li>
                    <a href="https://mokasweets.com/offers">
                      {{__('_moka_nav.offers')}}
                    </a>
                  </li>
                </ul>
                {{-- <ul>
                  <li>
                    <a href="https://mokasweets.com/password/reset">
                      {{__('_moka_home.reset_password')}}
                    </a>
                  </li>
                </ul> --}}
                <ul>
                  <li>
                    <a href="https://mokasweets.com/products">
                      {{__('_moka_nav.products')}}
                    </a>
                  </li>
                </ul>
                {{-- <ul>
                  <li>
                    <a href="https://mokasweets.com/checkout">
                      {{__('Check Out')}}
                    </a>
                  </li>
                </ul> --}}
                <ul>
                  <li>
                    <a href="https://mokasweets.com/contact-us">
                      {{__('_moka_nav.contact')}}
                    </a>
                  </li>
                </ul>
                {{-- <ul>
                  <li>
                    <a href="https://mokasweets.com/login">
                      {{__('login')}}
                    </a>
                  </li>
                </ul> --}}
              </div>

            </div><!--/row-->

        </div><!--/container-->
    </section>
@endsection
{{-- @push('footer-script-stack') --}}
    {{-- @include('_moka.categories.categories-index-backup') --}}
{{-- @endpush --}}
{{-- <div>
  <ul>
    <li>
      <a href="https://mokasweets.com">
      https://mokasweets.com
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/about">
      https://mokasweets.com/about
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/categories">
      https://mokasweets.com/categories
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/checkout">
      https://mokasweets.com/checkout
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/contact-us">
      https://mokasweets.com/contact-us
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/login">
      https://mokasweets.com/login
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/offers">
      https://mokasweets.com/offers
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/password/reset">
      https://mokasweets.com/password/reset
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="https://mokasweets.com/products">
      https://mokasweets.com/products
      </a>
    </li>
  </ul>
</div>
 --}}
