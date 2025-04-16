<div class="col-md-4 col-xs-12 p-q">
    <h2>@moka_strtoupper(__('_moka_home.online_application'))</h2>
    <p>@moka_ucfirst(__('_moka_home.have_a_party'))</p>
    <p>@moka_ucfirst(__('_moka_home.plan_to_impress_your_guests')) | @moka_ucfirst(__('_moka_home.download_the_app_now'))</p>
    <div class="app_btn_area">
        <a href="{{ config('app.android_app_link') ?? "#" }}" class="app_btn_area-href">
            <img src="{{ asset('moka-assets/assets/images/social-app-links/white-google-min.png') }}" style="height: 3rem; border-radius: 5px;padding: 5px 0 0 15px;"/>
        </a>
        <a href="{{ config('app.ios_app_link') ?? "#"}}" class="app_btn_area-href">
            <img src="{{ asset('moka-assets/assets/images/social-app-links/white-app-min.png') }}" style="height: 3rem; border-radius: 5px;padding: 5px 0 0 15px;"/>
        </a>
    </div>
</div>
