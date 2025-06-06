<!-- ========================  Banner ======================== -->
@if(app()->getLocale() == 'ar' || true) {{-- TODO: translate into english --}}
<section class="banner" style="background-image:url(assets/images/gallery-4.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center">
                <h2 class="title">Our story</h2>
                <p>
                    We believe in creativity as one of the major forces of progress. With this idea, we traveled throughout Italy to find exceptional
                    artisans and bring their unique handcrafted objects to connoisseurs everywhere.
                </p>
                <p><a href="about.html" class="btn btn-clean">Read full story</a></p>
            </div>
        </div>
    </div>
</section>
@else
<section class="banner" style="background-image:url(assets/images/gallery-4.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center">
                <h2 class="title">Our story</h2>
                <p>
                    We believe in creativity as one of the major forces of progress. With this idea, we traveled throughout Italy to find exceptional
                    artisans and bring their unique handcrafted objects to connoisseurs everywhere.
                </p>
                <p><a href="about.html" class="btn btn-clean">Read full story</a></p>
            </div>
        </div>
    </div>
</section>
@endif
