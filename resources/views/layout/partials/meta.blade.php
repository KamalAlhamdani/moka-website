{{--        @php($meta_default_social_image = asset('moka-share2.jpg') ?? '')--}}
        @php($meta_default_social_image = 'https://mokasweets.com/moka-share2.jpg' ?? '')
        @php($meta_default_title = 'حلويات موكا')
        @php($meta_default_describtion = 'حلويات ومخابز "موكا " بدأت في تحضير عجينتها الأولى في العام 1991 ومنذ ذلك الوقت بات لعشاق التذوق مكاناً يقصُدونه، حمل التطبيق واحصل على توصيل مجاني')
        @php($meta_default_describtion = 'حلويات ومخابز "موكا " بدأت في تحضير عجينتها الأولى في العام 1991 ومنذ ذلك الوقت بات لعشاق التذوق مكاناً يقصُدونه')
        <!-- Primary Meta Tags -->
        <title>{{ $page_title }}</title>
        <meta name="title" content="{{$meta_title ?? $meta_default_title}}">
        <meta name="description" content="{{$meta_describtion ?? $meta_default_describtion}}">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://mokasweets.com/{{$meta_url ?? ''}}">
        <meta property="og:title" content="{{$meta_title ?? $meta_default_title}}">
        <meta property="og:description" content="{{$meta_describtion ?? $meta_default_describtion}}">
{{--        <meta property="og:image" content="{{$meta_social_image ?? $meta_default_social_image }}">--}}
        <meta property="og:image" content="{{$meta_default_social_image }}">
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:title" content="{{$meta_title ?? $meta_default_title}}">
        <meta property="twitter:url" content="https://mokasweets.com/{{$meta_default_social_image ?? '' }}">
        <meta property="twitter:description" content="{{$meta_describtion ?? $meta_default_describtion}}">
        <meta property="twitter:image" content="{{$meta_default_social_image ?? '' }}">
        <meta property="twitter:site" content="@MokasweetsYemen">
        <meta property="twitter:creator" content="@MokasweetsYemen">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{$meta_title ?? $meta_default_title}}">
        <meta name="twitter:url" content="https://mokasweets.com/{{$meta_default_social_image ?? '' }}">
        <meta name="twitter:description" content="{{$meta_describtion ?? $meta_default_describtion}}">
        <meta name="twitter:image" content="{{$meta_default_social_image ?? '' }}">
        <meta name="twitter:site" content="@MokasweetsYemen">
        <meta name="twitter:creator" content="@MokasweetsYemen">
