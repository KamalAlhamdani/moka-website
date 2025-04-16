{{-- Not Used --}}
<section class="product">
    <div class="main">
        <div class="container">
            <div class="row product-flex">

                <!-- product flex is used only for mobile order -->
                <!-- on mobile 'product-flex-info' goes bellow gallery 'product-flex-gallery' -->

                <div class="col-md-4 col-sm-12 product-flex-info">
                    <div class="clearfix">

                        <!-- === product-title === -->

                        {{-- //TODO: use data-title to show large overlay title --}}
                        {{-- <h1 class="title" data-title="{{ $product_details->name }}">{{ $product_details->name }}</h1> --}}
                        <h1 class="title" data-title="">{{ $product_details->name }}</h1>

                        <div class="clearfix">

                            <!-- === price wrapper === -->

                            <div class="price">
                                    @foreach ($product_details->prices as $price)
                                    <div class="info-box info-box-addto-stopped">
                                        <span><strong>{{$price->unitName}}</strong></span>
                                        <span>
                                            <form id="add_product_{{  $price->id }}" action="{{ route('web.cart.post') }}" method="post">
                                                @csrf
                                                {{-- TODO: selected price --}}
                                                <input type="hidden" name="id" value='{{ $price->id }}'>
                                                <input type="hidden" name="type" value="{{ 'product' }}">
                                                {{-- use the unary plus operator to convert quantities to numbers first.  --}}
                                                {{-- <input class="form-control form-quantity" name="quantity" type="number" value="1" min="0" onchange="+(document.getElementById('product-quantity').value) += +(this.value))">
                                                <input id="product-quantity" name="quantity" type="hidden" value="2" min="0"> --}}
                                                <input id="product-quantity" name="quantity" type="number" value="1" min="1">
                                            </form>
                                            {{ $price->price }} &nbsp;
                                            {{-- <i class="icon icon-cart"></i>{{ __('_moka_products.add_to_cart') }} --}}
                                            {{-- <i class="add"><i class="fa fa-heart-o"></i> {{ __('_moka_products.add_to_favorites') }}</i>
                                            <i class="added"><i class="fa fa-heart"></i> {{ __('_moka_products.remove_from_favorites') }}</i> --}}
                                        </span>
                                    </div>
                                    <a href="{{ route('web.cart.post') }}" onclick="event.preventDefault();document.getElementById('add_product_{{  $price->id }}').submit();">
                                        <button type="button" form="add_product_{{  $price->id }}" class="btn btn-block btn-main">
                                            <i class="icon icon-cart"></i>{{ __('_moka_products.add_to_cart') }}
                                        </button>
                                    </a>
                                    @endforeach
                                </div>
                                <hr>
                            {{-- TODO: if needed more details about the product--}}
                            {{--<!-- === info-box === -->

                            <div class="info-box">
                                <span><strong>Maifacturer</strong></span>
                                <span>Brand name</span>
                            </div>

                            <!-- === info-box === -->

                            <div class="info-box">
                                <span><strong>Materials</strong></span>
                                <span>Wood, Leather, Acrylic</span>
                            </div>

                            <!-- === info-box === -->

                            <div class="info-box">
                                <span><strong>Availability</strong></span>
                                <span><i class="fa fa-check-square-o"></i> In stock</span>
                                <span class="hidden"><i class="fa fa-truck"></i> Out of stock</span>
                            </div>

                            <hr />--}}


                            {{-- @include('_moka.categories.products.details.add-to-fav') --}}

                            {{-- TODO: 2 if needed more details about the product--}}
                            {{--<div class="info-box info-box-addto">
                                <span><strong>Wishlist</strong></span>
                                <span>
                                        <i class="add"><i class="fa fa-eye-slash"></i> Add to Watch list</i>
                                        <i class="added"><i class="fa fa-eye"></i> Remove from Watch list</i>
                                    </span>
                            </div>

                            <div class="info-box info-box-addto">
                                <span><strong>Collection</strong></span>
                                <span>
                                        <i class="add"><i class="fa fa-star-o"></i> Add to Collection</i>
                                        <i class="added"><i class="fa fa-star"></i> Remove from Collection</i>
                                    </span>
                            </div>

                            <hr />

                            <!-- === info-box === -->

                            <div class="info-box">
                                <span><strong>Available Colors</strong></span>
                                <div class="product-colors clearfix">
                                    <span class="color-btn color-btn-red"></span>
                                    <span class="color-btn color-btn-blue checked"></span>
                                    <span class="color-btn color-btn-green"></span>
                                    <span class="color-btn color-btn-gray"></span>
                                    <span class="color-btn color-btn-biege"></span>
                                </div>
                            </div>

                            <!-- === info-box === -->

                            <div class="info-box">
                                <span><strong>Choose size</strong></span>
                                <div class="product-colors clearfix">
                                        <span class="color-btn color-btn-biege">
                                            <span class="product-size" data-text="">S</span>
                                        </span>
                                    <span class="color-btn color-btn-biege checked">M</span>
                                    <span class="color-btn color-btn-biege">XL</span>
                                    <span class="color-btn color-btn-biege">XXL</span>
                                </div>
                            </div>--}}

                        </div> <!--/clearfix-->
                    </div> <!--/product-info-wrapper-->
                </div> <!--/col-md-4-->
                <!-- === product item gallery === -->

                <div class="col-md-8 col-sm-12 product-flex-gallery">

                    <!-- === add to cart === -->
                    {{-- TODO: selected price --}}
                    {{-- <form action="{{ route('web.cart.post') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product_details->prices }}">
                        <input type="hidden" name="type" value="{{ 'product' }}">
                        <input type="hidden" name="quantity" value="{{ $product_details->id }}">

                        <button type="submit" class="btn btn-buy" data-text="{{ __('_moka_products.add_to_cart') }}"></button>
                    </form> --}}


                    <!-- === product gallery === -->

                    <div class="owl-product-gallery open-popup-gallery">
                        <a href="{{ domainAsset('storage/thumbnail/'.$product_details->image) }}"><img loading="lazy" class="products-details" src="{{domainAsset('storage/thumbnail/'.$product_details->image)}}"
                                                                                                       alt="" height="500"
                                                                                                       onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'"/></a>
                        {{-- TODO: if there multi image --}}
                        {{--<a href="assets/images/product-1.png"><img loading="lazy" src="{{domainAsset('moka-assets/assets/images/products/3J3A2998.jpg')}}" alt="" height="500" /></a>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- === product-info === -->

    <div class="info">
        <div class="container">
            <div class="row">

                {{--<!-- === product-designer === -->

                <div class="col-md-4">
                    <div class="designer">
                        <div class="box">
                            <div class="image">
                                <img loading="lazy" src="assets/images/user-1.jpg" alt="Alternate Text" />
                            </div>
                            <div class="name">
                                <div class="h3 title">John Doe <small>Arhitect</small></div>
                                <hr />
                                <p><a href="mailto:johndoe@mail.com"><i class="icon icon-envelope"></i> johndoe@mail.com</a></p>
                                <p><a href="tel:002255858"><i class="icon icon-phone-handset"></i> +002255858</a></p>
                                <p>
                                    <a href="#" class="btn btn-main btn-xs"><i class="icon icon-user"></i></a>
                                    <a href="#" class="btn btn-main btn-xs"><i class="icon icon-printer"></i></a>
                                    <a href="#" class="btn btn-main btn-xs"><i class="icon icon-layers"></i></a>
                                </p>
                            </div> <!--/name-->
                        </div> <!--/box-->
                        <div class="btn btn-add">
                            <i class="icon icon-phone-handset"></i>
                        </div>
                    </div> <!--/designer-->
                </div> <!--/col-md-4-->--}}
                <!-- === nav-tabs === -->

                {{--<div class="col-md-8"></div>    --}}
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#designer" aria-controls="designer" role="tab" data-toggle="tab">
                                <i class="icon icon-product"></i>
                                <span>{{ __('_moka_products.related_products') }}</span>
                            </a>
                        </li>
                        {{-- TODO: if needed more tabs --}}
                        {{--<li role="presentation">
                            <a href="#design" aria-controls="design" role="tab" data-toggle="tab">
                                <i class="icon icon-sort-alpha-asc"></i>
                                <span>Specification</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#rating" aria-controls="rating" role="tab" data-toggle="tab">
                                <i class="icon icon-thumbs-up"></i>
                                <span>Rating</span>
                            </a>
                        </li>--}}
                    </ul>

                    <!-- === tab-panes === -->

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="designer">
                            <div class="content">

                                <!-- === designer collection title === -->

                                <h3>{{ __('_moka_products.related_products') }}</h3>

                                <div class="products">
                                    <div class="row">

                                        {{-- @for ($i = 0 ; $i < 7 ; $i++) --}}
                                        @foreach ($product_related->slice(0, 8) as $i)
                                        <!-- === product-item === -->

                                        <div class="col-md-3 col-xs-3">
                                            <article>
                                                <div class="figure-grid">
                                                    <div class="image">
                                                        {{--<a href="#productid1" class="mfp-open">--}}
                                                        <a href="{{ route('products.details', $i->id) }}">
                                                            <img loading="lazy" src="{{domainAsset('storage/thumbnail/'.$i->image)}}" alt="" width="360"
                                                                 onerror="this.src='{{asset('moka-assets/assets/images/defualt.png')}}'"/>
                                                        </a>
                                                    </div>
                                                    <div class="text">
                                                        <h4 class="title"><a href="{{ route('products.details', $i->id) }}"> {{ $i->name }} </a></h4>
                                                        {{--<sup>Designer collection</sup>
                                                        <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>--}}
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        {{-- @endfor --}}
                                        @endforeach

                                    </div> <!--/row-->
                                </div> <!--/products-->
                            </div> <!--/content-->
                        </div> <!--/tab-pane-->
                        {{-- TODO: 2 if needed more tabs --}}
                        {{--<!-- ============ tab #2 ============ -->

                        <div role="tabpanel" class="tab-pane" id="design">
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3>Dimensions</h3>
                                        <p>
                                            <img loading="lazy" class="full-image" src="assets/images/specs.png" alt="Alternate Text" width="350" />
                                        </p>
                                        <hr />
                                        <p>
                                            <img loading="lazy" class="full-image" src="assets/images/specs.png" alt="Alternate Text" width="350" />
                                        </p>
                                    </div>
                                    <div class="col-md-8">
                                        <h3>Product Specification</h3>
                                        <p>
                                            Sofa Laura is a casual, contemporary collection that your family is sure to love.
                                            The plush pillows and soft sloped arms create the ultimate combination for relaxation and comfort.
                                        </p>
                                        <p>
                                            The collection is tailored with rounded padded arms, box-welted seat cushions, and loose back cushions.
                                            Comfort is provided by high density seat cushions supported with a hardwood frame construction.
                                            This collection is built for comfort and style!
                                        </p>
                                        <p>
                                            Sofa is fun and elegant with beauty and style that will stay cutting-edge trendy through the years.
                                            It is completely padded, including the back and outside arms - combining comfort and value to make rewarding relaxatio.
                                        </p>
                                    </div>

                                </div> <!--/row-->
                            </div> <!--/content-->
                        </div> <!--/tab-pane-->
                        <!-- ============ tab #3 ============ -->

                        <div role="tabpanel" class="tab-pane" id="rating">

                            <!-- ============ ratings ============ -->

                            <div class="content">
                                <h3>Rating</h3>

                                <div class="row">

                                    <!-- === comments === -->

                                    <div class="col-md-12">
                                        <div class="comments">

                                            <!-- === rating === -->

                                            <div class="rating clearfix">
                                                <div class="rate-box">
                                                    <strong>Quality</strong>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>3</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>5</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>0</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>2</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>1</span>
                                                    </div>
                                                </div>

                                                <!-- rate -->
                                                <div class="rate-box">
                                                    <strong>Design</strong>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <span>3</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <span>5</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <span>0</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>2</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star active"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>1</span>
                                                    </div>
                                                </div>

                                                <!-- rate -->
                                                <div class="rate-box">
                                                    <strong>General</strong>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>3</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>5</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>0</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>2</span>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <span>1</span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="comment-wrapper">

                                                <!-- === comment === -->

                                                <div class="comment-block">
                                                    <div class="comment-user">
                                                        <div><img loading="lazy" src="assets/images/user-2.jpg" alt="Alternate Text" width="70" /></div>
                                                        <div>
                                                            <h5>
                                                                <span>John Doe</span>
                                                                <span class="pull-right">
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    </span>
                                                                <small>03.05.2017</small>
                                                            </h5>
                                                        </div>
                                                    </div>

                                                    <!-- comment description -->

                                                    <div class="comment-desc">
                                                        <p>
                                                            In vestibulum tellus ut nunc accumsan eleifend. Donec mattis cursus ligula, id
                                                            iaculis dui feugiat nec. Etiam ut ante sed neque lacinia volutpat. Maecenas
                                                            ultricies tempus nibh, sit amet facilisis mauris vulputate in. Phasellus
                                                            tempor justo et mollis facilisis. Donec placerat at nulla sed suscipit. Praesent
                                                            accumsan, sem sit amet euismod ullamcorper, justo sapien cursus nisl, nec
                                                            gravida
                                                        </p>
                                                    </div>

                                                    <!-- comment reply -->

                                                    <div class="comment-block">
                                                        <div class="comment-user">
                                                            <div><img loading="lazy" src="assets/images/user-2.jpg" alt="Alternate Text" width="70" /></div>
                                                            <div>
                                                                <h5>Administrator<small>08.05.2017</small></h5>
                                                            </div>
                                                        </div>
                                                        <div class="comment-desc">
                                                            <p>
                                                                Curabitur sit amet elit quis tellus tincidunt efficitur. Cras lobortis id
                                                                elit eu vehicula. Sed porttitor nulla vitae nisl varius luctus. Quisque
                                                                a enim nisl. Maecenas facilisis, felis sed blandit scelerisque, sapien
                                                                nisl egestas diam, nec blandit diam ipsum eget dolor. Maecenas ultricies
                                                                tempus nibh, sit amet facilisis mauris vulputate in.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!--/reply-->
                                                </div>

                                                <!-- === comment === -->

                                                <div class="comment-block">
                                                    <div class="comment-user">
                                                        <div><img loading="lazy" src="assets/images/user-2.jpg" alt="Alternate Text" width="70" /></div>
                                                        <div>
                                                            <h5>
                                                                <span>John Doe</span>
                                                                <span class="pull-right">
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star active"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                    </span>
                                                                <small>03.05.2017</small>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="comment-desc">
                                                        <p>
                                                            Cras lobortis id elit eu vehicula. Sed porttitor nulla vitae nisl varius luctus.
                                                            Quisque a enim nisl. Maecenas facilisis, felis sed blandit scelerisque, sapien
                                                            nisl egestas diam, nec blandit diam ipsum eget dolor. In vestibulum tellus
                                                            ut nunc accumsan eleifend. Donec mattis cursus ligula, id iaculis dui feugiat
                                                            nec. Etiam ut ante sed neque lacinia volutpat. Maecenas ultricies tempus
                                                            nibh, sit amet facilisis mauris vulputate in. Phasellus tempor justo et mollis
                                                            facilisis. Donec placerat at nulla sed suscipit. Praesent accumsan, sem sit
                                                            amet euismod ullamcorper, justo sapien cursus nisl, nec gravida
                                                        </p>
                                                    </div>
                                                </div>

                                            </div><!--/comment-wrapper-->

                                            <div class="comment-header">
                                                <a href="#" class="btn btn-clean-dark">12 comments</a>
                                            </div> <!--/comment-header-->
                                            <!-- === add comment === -->

                                            <div class="comment-add">

                                                <div class="comment-reply-message">
                                                    <div class="h3 title">Leave a Reply </div>
                                                    <p>Your email address will not be published.</p>
                                                </div>

                                                <form action="#" method="post">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" value="" placeholder="Your Name" />
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="name" value="" placeholder="Your Email" />
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea rows="10" class="form-control" placeholder="Your comment"></textarea>
                                                    </div>
                                                    <div class="clearfix text-center">
                                                        <a href="#" class="btn btn-main">Add comment</a>
                                                    </div>
                                                </form>

                                            </div><!--/comment-add-->
                                        </div> <!--/comments-->
                                    </div>


                                </div> <!--/row-->
                            </div> <!--/content-->
                        </div> <!--/tab-pane-->--}}
                    </div> <!--/tab-content-->
                </div>
            </div> <!--/row-->
        </div> <!--/container-->
    </div> <!--/info-->
</section>
