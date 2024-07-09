<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Primary Meta Tags -->
    <title>{{ __('messages.Pojecttitle') }}</title>

    <meta name="title" content=" PRISM-H" />
    <meta name="description" content="Platform for Research, Integrated Surveillance and Management of Health" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://mcwaredemo.in/prismh/login" />
    <meta property="og:title" content=" PRISM-H" />
    <meta property="og:description" content="Platform for Research, Integrated Surveillance and Management of Health" />
    <meta property="og:image" content="{{ asset('favicon.ico') }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="https://mcwaredemo.in/prismh/login" />
    <meta property="twitter:title" content=" PRISM-H" />
    <meta property="twitter:description" content="Platform for Research, Integrated Surveillance and Management of Health" />
    <meta property="twitter:image" content="{{ asset('favicon.ico') }}" />

    <!-- Meta Tags Generated with https://metatags.io -->
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="manifest" href="{{ url('public/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('public/app/icons/icon-192x192.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/fonts/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/styles/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('public/styles/style.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">

    <!--Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    <style>
        .lan-btn span 
        {
            position: absolute;
            right: 10px;
            top: 9px;
        }
        .language a
        {
            border-bottom: 0px solid !important;
        }
        .main-logo
        {
            font-size: 22px !important;
            line-height: 30px;
            color: #FFF;
            font-weight: 600 !important;
        }
    </style>

    @yield('style')
  </head>

  <body class="theme-light" data-highlight="grass">

    <!-- <div class="position-absolute" style="z-index:10;right:78px;top:29px;">
      <select class="form-control p-0 px-2 m-0" id="" onchange="window.location.href=this.value">
        <option value="{{ route('asha_worker.app_locale') }}?lang=en" {{app()->getLocale() == 'en' ? 'selected' : ''}}>EN</option>
        <option value="{{ route('asha_worker.app_locale') }}?lang=ka" {{app()->getLocale() == 'ka' ? 'selected' : ''}}>KN</option>
      </select>
    </div> -->

    <div id="preloader">
      <div class="spinner-border color-highlight" role="status">
      </div>
    </div>
    @include('workers.layout.right_sidebar')
    <div id="page">
      <div class="header header-fixed header-auto-show header-logo-app">
          <a href="{{route('field-executive.dashboard')}}" class="header-title">{{ __('messages.Pojecttitle') }}</a>
      </div>
      <div class="page-content" style="padding-bottom:0px;">
        @yield('content')
        @include('workers.layout.footer')
      </div>
      @include('workers.layout.footerbar')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ url('public/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('public/scripts/custom.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".s-alrt").fadeTo(2000, 500).fadeOut(1000, function(){
          $(".s-alrt").fadeOut(1000);
        });
      });
    </script>
    @yield('script')
  </body>
</html>