<!DOCTYPE html>
<html lang="rs">
<head>

    @if(View::hasSection('ads'))
        @yield('ads')
    @else
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-5503948606321438",
            enable_page_level_ads: true
          });
        </script>
    @endif
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87367061-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-87367061-2');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- META tag -->
    @if(View::hasSection('meta_tags'))
        @yield('meta_tags')
    @else
        <title>Moja Odeća | Magazin | Moda Poznati Zdravlje Nega </title>
        <meta name='description' itemprop='description' content='Lifestyle magazin , saveti i trkovi za savršen život | Polovna i nova garderoba odeća '/>
        <meta property="og:title" content="Moja Odeća | Magazin | Moda Poznati Zdravlje Nega " />
        <meta property="og:description" content="MojaOdeca.com je sajt za kupovinu prodaju ili zamenu polovne i nove odeće. Na jednom mestu obnovite ormar sa novim stvarima." />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{env('SITE_URL', 'Moja odeca')}}" />
        <meta property="og:image" content="{{asset('img/fb_logo.png')}}"/>
    @endif
    <!-- Canonical -->
    <link rel="canonical" href="{{ URL::current() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/blog.css') }}">
    <style type="text/css">

    	
    </style>
    
    <script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "WebSite",
      "name": "Moja Odeća",
      "url": "http://mojaodeca.com",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "http://mojaodeca.com/pretraga?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/hr_HR/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-fixed-top" style="min-height:70px;background:white;">
            <div class="container">
                <div class="navbar-header"> 

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/magazin') }}">
                       <img src="{{asset('img/logo3.png')}}" alt="logo image" style="max-height: 50px;">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class=                     "nav navbar-nav navbar-right navbefore" style="text-align:center;">
                        <!-- Authentication Links -->
                        <li class="mobnav dodaj-oglas-mob"><a href="/">MOJA ODEĆA OGLASI</a></li>
                        @guest
                            <li class="pocetnaPrijava mobhide"><a class="singin" href="{{ route('login') }}">Prijava</a></li>
                            <li class="pocetnaPrijava mobhide"><a class="singup" href="{{ route('register') }}">Registruj se</a></li>
                            <li>
                                <a class="mobnav mob-login" href="{{ route('login') }}">Prijava</a>
                                <a class="mobnav mob-register" href="{{ route('register') }}">Registruj se</a>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" style="color: #4c83ff;">
                                    Moj nalog <span class="caret mobhide" style=" background: url('/img/userpic.png');box-shadow:4px 5px 6px 0px rgba(0, 0, 0, 0.2);"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>  
                                        <a href="/">Moja Odeca Prodavnica</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>  
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        
                        <li class="mobnav hamburger-naslov">KATEGORIJE</li>
                        <li class="mobnav">
                            <a href="/magazin/moda">Moda</a>
                        </li>
                        <li class="mobnav">
                            <a href="/magazin/poznati">Poznati</a>
                        </li>
                        <li class="mobnav">
                            <a href="/magazin/fitnes">Fitnes</a>
                        </li>
                        <li class="mobnav">
                            <a href="/magazin/nega">Nega</a>
                        </li>
                        <li class="mobnav">
                            <a href="/magazin/život">Život</a>
                        </li>
                        <li class="mobnav">
                            <a href="/magazin/razno">Razno</a>
                        </li>
                        
                        <li></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div style="margin-top: 30px;">
                <a href="http://mojaodeca.com">
                    <img src="{{asset('img/indexBanner.png')}}" style="width: 100%;">
                </a>
             </div>
        </div>
        @yield('content')
    </div>
    <!-- Scripts -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>
    <script>
     WebFont.load({
        google: {
          families: ['Poppins:300,400,500,600','Source Sans Pro:400,600']
        }
      });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('script')
</body>
</html>
