<!-- ========================  Banner ======================== -->

{{-- <section class="banner" style="background-image:url({{asset('moka-assets/assets/images/aboutus/header.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 text-center">
                <h2 class="title">{{ __('_moka_content.we_making_happiness_since') }} 1991</h2>
                <p>
                    {!! __('_moka_content.The new form of management Content') !!}
                </p>
               <p>
                   @if(config('app.internet_order'))
                   <a href="{{ route('categories') }}" class="btn btn-clean"><span class="icon icon-cart"></span> @moka_ucfirst(__('_moka_home.order_now'))</a>
                   @endif
                </p>
            </div>
        </div>
    </div>
</section> --}}

<section class="banner" style="background-image:url({{asset('moka-assets/assets/images/aboutus/header.jpg')}})">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 text-center">
                <h2 class="title">{{ __('_moka_content.The Story') }} 1991</h2>
                <p>
                    {!! __('_moka_content.The Story Content') !!}
                </p>
               <p>
                @if(config('app.internet_order'))
                   <a href="{{ route('categories') }}" class="btn btn-clean"><span class="icon icon-cart"></span> @moka_ucfirst(__('_moka_home.order_now'))</a>
                @endif
                </p>
            </div>
        </div>
    </div>
</section>
