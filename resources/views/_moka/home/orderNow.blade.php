
<!-- ========================  Order now ======================== -->

<!-- ========================  Banner ======================== -->
<style>
    .banner:before {
        content:"";
        position: absolute;
        top:0;
        left:0;
        height:100%;
        width:100%;
        background: rgba(0,0,0,0.5);
    }
    @media (min-width: 992px) {
        /*large screens*/
        .categories-icons-main-page-devider {
            margin-top: -6px;
        }
    }
    @media (max-width: 991px) {
        /*small screens*/
        .categories-icons-main-page-devider {
            margin-top: -17px;
        }
    }
</style>
<section class="banner categories-icons-main-page-devider" style="padding-top: 20px;padding-bottom: 20px;background-image:url({{ asset('moka-assets/assets/images/order-section/cakes.png') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center">
                <h2 class="title">@moka_strtoupper(__('_moka_home.online_application'))</h2>
                <p>@moka_ucfirst(__('_moka_home.have_a_party'))</p>
                <p>@moka_ucfirst(__('_moka_home.plan_to_impress_your_guests'))</p>
                <p><a href="{{ route('categories') }}" class="btn btn-clean"><span class="icon icon-cart"></span> @moka_ucfirst(__('_moka_home.order_now'))</a></p>
            </div>
        </div>
    </div>
</section>

