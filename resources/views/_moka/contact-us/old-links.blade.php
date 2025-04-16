<div class="col-xs-4 col-md-4">
    <article>
        @php($whatsapp_chat_url = 'https://api.whatsapp.com/send?phone=967771546320')
        @php($whatsapp_chat_image = asset('image/social/whatsapp.png'))
        <a href="{{ $whatsapp_chat_url }}" target="_blank">
            {{-- TODO: image should be 360x220 --}}
            <div class="image" style="text-align: center">
                <i class="fa fa-whatsapp icons-fa"></i>
{{--                            <img loading="lazy" src="{{$whatsapp_chat_image}}" alt="" style="height:100%">--}}
            </div>
            <div class="entry entry-table">
                {{-- <div class="date-wrapper">
                    <div class="date">
                        <span>MAR</span>
                        <strong>08</strong>
                        <span>2017</span>
                    </div>
                </div> --}}
                <div class="title">
                    <h2 class="h5">{{__('_moka_contact.whatsapp')}}</h2>
                </div>
            </div>
            <div class="show-more">
                <a href="{{ $whatsapp_chat_url }}" target="_blank">
                <span class="btn btn-main btn-block">{{__('_moka_contact.start_whatsapp_chat')}}</span>
                </a>
            </div>
        </a>
    </article>
</div>
<div class="col-xs-4 col-md-4">
    <article>
        @php($email_url = 'mailto:info@Mokasweets.com?Subject=Contact%20Us')
        @php($email_image = asset('image/social/message.png'))
        <a href="{{ $email_url }}" target="_top">
            {{-- TODO: image should be 360x220 --}}
            <div class="image" style="text-align: center;background-image:url({{$email_image}});background-size: contain;background-repeat: no-repeat;">
                <i class="fa fa-envelope-o icons-fa"></i>
                {{-- <img loading="lazy" src="{{$email_image}}" alt="" style="height:100%"> --}}
            </div>
            <div class="entry entry-table">
                {{-- <div class="date-wrapper">
                    <div class="date">
                        <span>MAR</span>
                        <strong>08</strong>
                        <span>2017</span>
                    </div>
                </div> --}}
                <div class="title">
                    <h2 class="h5">{{__('_moka_contact.email')}}</h2>
                </div>
            </div>
            <div class="show-more">
                <a href="{{ $email_url }}" target="_top">
                <span class="btn btn-main btn-block">{{__('_moka_contact.send_email')}}</span>
                </a>
            </div>
        </a>
    </article>
</div>
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
<div class="col-xs-4 col-md-4">
    <article>
        @php($phone_url = 'tel:771546320')
        @php($phone_image = asset('image/social/phone-call.png'))
        <a href="{{ $phone_url }}" target="_top">
            {{-- TODO: image should be 360x220 --}}
            <div class="image" style="text-align: center;background-image:url({{$phone_image}});background-size: contain;background-repeat: no-repeat;">
                <i class="fa fa-phone icons-fa"></i>
                {{-- <img loading="lazy" src="{{$phone_image}}" alt="" style="height:100%"> --}}
            </div>
            <div class="entry entry-table">
                {{-- <div class="date-wrapper">
                    <div class="date">
                        <span>MAR</span>
                        <strong>08</strong>
                        <span>2017</span>
                    </div>
                </div> --}}
                <div class="title">
                    <h2 class="h5">{{__('_moka_contact.phone')}}</h2>
                </div>
            </div>
            <div class="show-more">
                <a href="{{ $phone_url }}" target="_top">
                <span class="btn btn-main btn-block">{{__('_moka_contact.make_call')}}</span>
                </a>
            </div>
        </a>
    </article>
</div>
