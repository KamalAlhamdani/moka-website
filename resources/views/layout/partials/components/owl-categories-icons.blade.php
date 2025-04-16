<!-- ========================  Icons slider ======================== -->


<section class="owl-icons-wrapper owl-icons-frontpage">

    <!-- === header === -->

    <header class="hidden text-center">
        <h2>{{__('_moka_home.products_categories')}}</h2>
    </header>

    <div class="container">

        <div class="owl-icons">

        @foreach($categories as $category)
            <!-- === icon item === -->

                <a href="{{ route("products") }}?category_id={{ $category->id }}">
                    <figure>
                        <i class="f-icon card-img-slider"><img loading="lazy" class="img-slider"
                                                               src="{{domainAsset($category->image)}}"
                                                               alt="{{ $category->name }}"
                                                               onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}';"/></i>
                        <figcaption class="nav-img-name">{{ $category->name }}</figcaption>
                    </figure>
                </a>
        @endforeach

        </div> <!--/owl-icons-->
    </div> <!--/container-->
</section>
