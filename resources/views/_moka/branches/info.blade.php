<section class="blog">

    <div class="container">

        <!-- === blog header === -->

        <header>
            <div class="row">
                <div class="col-md-offset-2 col-md-8 text-center">
                    {{-- <h1 class="h2 title">{{$name}}</h1> --}}
                    {{-- <div class="text">
                        <p>{{ $page_title }}</p>
                    </div> --}}
                </div>
            </div>
        </header>
        <div class="row">
            {{-- @include('_moka.contact-us.links') --}}
        </div> <!--/row-->
        <div class="row">
            @include('_moka.branches.table')
        </div>
    </div> <!--/container-->
</section>
