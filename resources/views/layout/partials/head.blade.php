        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5QVZ3Q6');</script>
        <!-- End Google Tag Manager -->


        {{-- Additionally, paste this code immediately after the opening <body> tag: --}}
        {{-- <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5QVZ3Q6"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) --> --}}

        <!-- Mobile Web-app fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <!-- Meta tags -->
        @include('layout.partials.meta')
{{--        @gsv("oQuoAqnv4bLBV6bNkaQqOPUj-cq-3I_L4FfSdrAv_OY")--}}

        <!-- ./Meta tags -->

        <!--My tries-->
        {{--<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">--}}
        <!-- favicon -->
        {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{asset('moka-assets/favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('moka-assets/favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('moka-assets/favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('moka-assets/favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('moka-assets/favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('moka-assets/favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('moka-assets/favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('moka-assets/favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('moka-assets/favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('moka-assets/favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('moka-assets/favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('moka-assets/favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('moka-assets/favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('moka-assets/favicon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('moka-assets/favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff"> --}}

        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
        <link rel="manifest" href="/site.webmanifest">

        <!--CSS styles-->
        {{-- <link rel="stylesheet" media="all" href="{{asset('compressed/style.css')}}" /> --}}
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/bootstrap.min.css')}}" /> {{--in compressed/style.css--}}
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/animate.min.css')}}" />
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/font-awesome.min.css')}}" />
        {{--removed--}}
        {{-- <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/furniture-icons.min.css')}}" /> --}}
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/linear-icons.min.css')}}" />
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/magnific-popup.min.css')}}" />
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/owl.carousel.min.css')}}" />
        {{--in compressed/style.css--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/ion-range-slider.min.css')}}" />
        {{--in compressed/style.css--}}
{{--        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/theme.min.css')}}" />--}}
        <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/theme.css')}}" />

        <!-- Moka -->
        {{-- <link rel="stylesheet" media="all" href="{{asset('moka-assets/css/moka-font.css')}}" /> --}}
        <link rel="stylesheet" media="all" href="{{asset('moka-assets/css/_moka_style.css')}}" />
        <!--RTL Support -->
{{--        <link rel="stylesheet"  media="all" href="{{asset('moka-assets/css/mobile/style.css')}}">--}}

        @if ( Config::get('app.locale') == 'ar')
            <link rel="stylesheet" media="all" href="{{asset('theme-assets/css/theme-rtl.min.css')}}" />
        @endif

        @include('layout.partials.components.additional-css')
        @if(config('app.autodark-theme'))
        @include('layout.partials.components.autodark-css')
        @endif
        <!--Google fonts-->
        {{--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&amp;subset=latin-ext" rel="stylesheet">--}}
        {{--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">--}}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

