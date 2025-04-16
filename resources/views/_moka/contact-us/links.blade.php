<style>
    .icons-fa{
        font-size: 155px;
        color: #FBB615;
    }
    @media screen and (max-width: 892px) {
        .icons-fa {
            /*padding-top: 20px;*/
            font-size: 100px !important;
        }
        @media screen and (max-width: 691px) {
            @media screen and (max-width: 360px) {
                .title .h5{
                    margin: 0;
                    font-size: 12px !important;
                }
            }
            .icons-fa {
                font-size: 51px !important;
            }
        }
    }
</style>
@php($youtube_image = asset('moka-assets/assets/images/social-app-links/YT.ICON-min.png'))
@php($instegram_image = asset('moka-assets/assets/images/social-app-links/INST-ICON-min.png'))
@php($facebook_image = asset('moka-assets/assets/images/social-app-links/FB-ICON-min.png'))
@php($email_image = asset('moka-assets/assets/images/social-app-links/E.ICON-min.png'))
@php($email = 'info@Mokasweets.com')
@php($email_url = 'mailto:'.$email.'?Subject=Contact%20Us')
@php($youtube_url = env('YOUTUBE_LINK', '#'))
@php($instegram_url = env('INSTAGRAM_LINK', '#'))
@php($facebook_url = env('FACEBOOK_LINK', '#'))
<div class="col-xs-12">
    <div style="justify-content: start;display: flex;">
        <img loading="lazy" style="height: 30px" src="{{$email_image}}" alt="email"/>&nbsp;&nbsp;&nbsp; <h2 class="h3" style="display: inline;margin: auto 0;">{{__('_moka_contact.email')}}</h2>&nbsp; :&nbsp; <a href="{{ $email_url }}" target="_top">{{$email}}</a>
    </div>
</div>
<br>
<br>
<div class="col-xs-4 col-md-4">
    <article>
        <a href="{{ $youtube_url }}" target="_top">
            <div class="image" style="height: 115px; text-align: center;background-image:url({{$youtube_image}});background-size: contain;background-repeat: no-repeat;">
            </div>
            <div class="entry entry-table">
                <div class="title">
                    <h2 class="h5">{{__('_moka_contact.youtube')}}</h2>
                </div>
            </div>
            <div class="show-more">
                <a href="{{ $youtube_url }}" target="_top">
                <span class="btn btn-main btn-block">{{__('_moka_contact.visit')}}</span>
                </a>
            </div>
        </a>
    </article>
</div>
<div class="col-xs-4 col-md-4">
    <article>
        <a href="{{ $instegram_url }}" target="_top">
            <div class="image" style="height: 115px; text-align: center;background-image:url({{$instegram_image}});background-size: contain;background-repeat: no-repeat;">
            </div>
            <div class="entry entry-table">
                <div class="title">
                    <h2 class="h5">{{__('_moka_contact.instegram')}}</h2>
                </div>
            </div>
            <div class="show-more">
                <a href="{{ $instegram_url }}" target="_top">
                <span class="btn btn-main btn-block">{{__('_moka_contact.visit')}}</span>
                </a>
            </div>
        </a>
    </article>
</div>
<div class="col-xs-4 col-md-4">
    <article>
        <a href="{{ $facebook_url }}" target="_top">
            <div class="image" style="height: 115px; text-align: center;background-image:url({{$facebook_image}});background-size: contain;background-repeat: no-repeat;">
            </div>
            <div class="entry entry-table">
                <div class="title">
                    <h2 class="h5">{{__('_moka_contact.facebook')}}</h2>
                </div>
            </div>
            <div class="show-more">
                <a href="{{ $facebook_url }}" target="_top">
                <span class="btn btn-main btn-block">{{__('_moka_contact.visit')}}</span>
                </a>
            </div>
        </a>
    </article>
</div>

