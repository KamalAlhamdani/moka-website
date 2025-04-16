{{-- <input type="text" name="search" id="search" />
<div id="container_domains"></div> --}}
<!-- ==========  Search wrapper ========== -->

<div class="search-wrapper" style="overflow-x: auto; max-height: 360px;">

    <!-- Search form -->
    <input class="form-control" name="search" id="search" placeholder="{{ __('_moka_nav.search_for_product') }}..." autocomplete="off" spellcheck="false" />
    {{-- <button class="btn btn-main btn-search">{{ __('_moka_nav.go') }}</button> --}}

    {{-- TODO: realtime search below is an example --}}
    <!-- Search results - live search -->
    <div class="search-results">
        <div id="container_domains"></div>
        <div class="search-result-items">
            <div class="title h4">{{__('_moka_home.products')}} <a href="{{ route('products') }}" class="btn btn-clean-dark btn-xs">{{ __('_moka_products.all')}}</a></div>
            <ul id="search-products-result">
                {{-- <li><a href="#"><span class="id">42563</span> <span class="name">Green corner</span> <span class="category">Sofa</span></a></li>
                <li><a href="#"><span class="id">42563</span> <span class="name">Laura</span> <span class="category">Armchairs</span></a></li>
                <li><a href="#"><span class="id">42563</span> <span class="name">Nude</span> <span class="category">Dining tables</span></a></li>
                <li><a href="#"><span class="id">42563</span> <span class="name">Aurora</span> <span class="category">Nightstands</span></a></li>
                <li><a href="#"><span class="id">42563</span> <span class="name">Dining set</span> <span class="category">Kitchen</span></a></li>
                <li><a href="#"><span class="id">42563</span> <span class="name">Seat chair</span> <span class="category">Bar sets</span></a></li> --}}
            </ul>
        </div> <!--/search-result-items-->
        {{-- <div class="search-result-items">
            <div class="title h4">Blog <a href="#" class="btn btn-clean-dark btn-xs">View all</a></div>
            <ul>
                <li><a href="#"><span class="id">01 Jan</span> <span class="name">Creating the Perfect Gallery Wall </span> <span class="category">Interior ideas</span></a></li>
                <li><a href="#"><span class="id">12 Jan</span> <span class="name">Making the Most Out of Your Kids Old Bedroom</span> <span class="category">Interior ideas</span></a></li>
                <li><a href="#"><span class="id">28 Dec</span> <span class="name">Have a look at our new projects!</span> <span class="category">Modern design</span></a></li>
                <li><a href="#"><span class="id">31 Sep</span> <span class="name">Decorating When You're Starting Out or Starting Over</span> <span class="category">Best of 2017</span></a></li>
                <li><a href="#"><span class="id">22 Sep</span> <span class="name">The 3 Tricks that Quickly Became Rules</span> <span class="category">Tips for you</span></a></li>
            </ul>
        </div> <!--/search-result-items--> --}}
    </div> <!--/search-results-->
</div>