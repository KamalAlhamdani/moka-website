<!-- ========================  Header content ======================== -->
@include('.layout.partials.scriptes.offer-slider-data')

<section class="header-content offer-content-slider">

    <div class="owl-slider offer-slider">

        {{--
        used classes
        div.offer-image-1
        h2.offer-name-1
        span.offer-price-1
        i.offer-old-price-1
        --}}

        {{-- {{$advertisements}} --}}
        {{-- {{dd('s')}} --}}
    <!-- === slide item === -->
    @if(count($advertisements) <= 0)
    {{-- <div class="item" style="height: 360px; display: block"> --}}
    <div class="item" style="
    background-image:url({{asset('moka-assets/assets/images/slider/default/gallery-2.jpg')}}),
    url({{asset('moka-assets/assets/images/slider/default/gallery-1.jpg')}});
    background-color: #232529">
        <div class="box">
            <div class="container">
                {{-- <h2 class="title animated h1" data-animation="fadeInDown">{{ $offer->name }}</h2> --}}
                <div class="animated" data-animation="fadeInUp">
                    {{--<span class="borderd-text">{!! __('_moka_home.subtitle-'.$offer->id.'') !!}</span>--}}
                </div>
                <div class="animated" data-animation="fadeInUp">
                    {{-- <a href="{{ route('offers.details', $offer->id) }}" target="_blank" class="btn btn-main" ><i class="icon icon-diamond"></i> {{__('_moka_offer.browes_offer')}}</a> --}}
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- @foreach($offers->slice(0, 3) as $offer) --}}
    @foreach($advertisements as $offer)
        <div class="item" style="background-image:url({{url($offer->image_path)}})">
            <div class="box">
                <div class="container">
                    {{--<h2 class="title animated h1" data-animation="fadeInDown">{{ $offer->name }}</h2>--}}
                    <div class="animated" data-animation="fadeInUp">
                        {{--<span class="borderd-text">{!! __('_moka_home.subtitle-'.$offer->id.'') !!}</span>--}}
                    </div>
                    <div class="animated" data-animation="fadeInUp">
                        {{-- <a href="{{ route('offers.details', $offer->id) }}" target="_blank" class="btn btn-main" ><i class="icon icon-diamond"></i> {{__('_moka_offer.browes_offer')}}</a> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div> <!--/owl-slider-->
</section>

@include('.layout.partials.components.owl-categories-icons')

{{--<hr class="categories-icons-main-page-devider">--}}

{{-- JS Ajax for slider --}}
{{--@include('.layout.partials.scriptes.offer-slider-data')--}}
