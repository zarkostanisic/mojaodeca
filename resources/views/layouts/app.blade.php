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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,minimum-scale=1">
    <meta name="theme-color" content="#5889e4">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- META tag -->
    @if(View::hasSection('meta_tags'))
        @yield('meta_tags')
    @else
        <title>Moja Odeća | Besplatni oglasi | Nova i polovna garderoba odeća muška ženska dečija jeftina obuća</title>
        <meta name='description' itemprop='description' content='Kupite, prodajte polovnu i novu garderobu.Veliki broj haljina patika satova obuće jakni majica i drugog. Ženska, muška, dečija odeća. Objavite oglas besplatno.'/>
        <meta property="og:title" content="Moja Odeca | Besplatni mali oglasi | Polovna i nova garderoba haljine patike satovi obuća" />
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
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('slick-css')
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
<div id="app">
    @stack('fbshare')
    <a id="scrollUp" href="#top">
        <img src="{{asset('img/top.png')}}" alt="icon" style="width: 100%;">
    </a>

        <div id="list-overlay">
          <img src="{{asset('img/loading-gif.gif')}}" alt="loading gif" id="loadingImg" style="position: fixed; top: 50%;left: 50%;margin-left: -128px;margin-top: -128px;">
        </div>
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

                    <a href="/inbox" id="inbox-alert" class="mobnav" role="button"><span class="glyphicon glyphicon-envelope"></span></a> 

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       <img src="{{asset('img/logo2.png')}}" alt="logo image">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right navbefore" style="text-align:center;">
                        <!-- Authentication Links -->
                        <a href="/create" class="button-add-index mobhide">
                            <div class="add-icon" style="background: url('{{ asset('img/addicon.png')}}'); background-size: 100%;"></div>
                            <span >DODAJ OGLAS</span>
                        </a>
                        <li class="mobnav dodaj-oglas-mob"><a href="/create">DODAJ OGLAS</a></li>
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
                                        <a href="{{ route('inbox') }}">Moje poruke</a>
                                        <a href="{{ route('admin-user') }}">Moji oglasi</a>
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
                        @foreach($categories as $category)
                            <li class="mobnav">
                                <a href="/{{urlencode($category->name)}}">{{$category->name}}</a>
                            </li>
                        @endforeach 
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>
    <script>
     WebFont.load({
        google: {
          families: ['Montserrat:600', 'Open Sans:300,700','Poppins:300,400,600','Quicksand:500','Raleway:600']
        }
      });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('slick-js')
    @stack('script')
    @stack('owl')
    <!-- <script type="text/javascript">
      var subscribersSiteId = 'f6d3c549-8d68-4788-8273-1cb78e7acfb0';
    </script>
    <script type="text/javascript" src="https://cdn.subscribers.com/assets/subscribers.js"></script> -->
</body>
</html>
