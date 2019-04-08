@extends('layouts.app')
@section('content')
<div id="heroGradient" >
  <div class="container">
        <h1 >Slikaj, oglasi i prodaj <span class="mobhide">-</span> <span style="color:greenyellow;">besplatno. brzo. lako.</span></h1>
        <p class="mobhide">- Besplatni mali oglasi &nbsp | &nbsp Nova i polovna , markirana, i nemarkirana odeća,obuća i drugi odevni predmeti &nbsp | &nbsp Prodajte svoju garderobu ili kupite komad odeće za sebe -</p>
        <div id="header-search" class="ml-auto mr-auto col-md-10 col-md-offset-1 col-xs-12">
            <div class="row">
                <form action="pretraga" method="GET" name="search-index-form" id="search-index-form">
                <!-- <div id="header-search"> -->
                    <div class="col-xs-12 col-sm-4 col-md-3 search-col">
                        <select id="select-cat-index" class="form-control" name="category">
                            <option value="odeca" disabled selected>Kategorija</option>
                            @foreach($categories as $category)
                                <option value="{{$category->name}}">{{$category->name}}</option>
                            @endforeach
                      </select>
                   </div>
                   <div class="col-xs-12 col-sm-4 col-md-2 search-col">
                        <select name="used" class="form-control">
                            <option value="" disabled selected>Stanje</option>
                            <option value="1">Polovno</option>
                            <option value="0">Novo</option>
                      </select>
                   </div>
                   <div class="col-xs-12 col-sm-4 col-md-2 search-col">
                      <select name="gender_id" class="form-control">
                        <option value="" disabled selected>Pol</option>
                        <option value="1">Muško</option>
                        <option value="2">Žensko</option>
                      </select>
                   </div>
                    <div class="col-xs-12 col-sm-4 col-md-3 search-col">
                        <select name="country_id" class="form-control">
                        <option value="" disabled selected>Lokacija</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="col-xs-12 col-sm-4 col-md-2 search-col">
                      <button class="trazi">Traži</button>
                   </div>
                </form>
            </div>
        </div>
  </div>
</div>

<div class="container" >
  <!-- LEFT -->
  <div class="col-md-3 mobhide">
    <!-- NAV -->
    <div class="row negativ-margin">
    <div class="navleft">

        <span class="navleft-cat" style="padding: 10px 25px; display:block;border-bottom:1px solid #efede9;">Kategorije</span>

        @foreach($categories as $category)
        
        <a href="/{{urlencode($category->name)}}">
          
          <div class="navlist" style="display: block; padding: 10px; border: 0px; border-radius: 0px;text-transform: uppercase;font-family: 'Open Sans', sans-serif;color:#888;font-size:11px;font-weight: 600;letter-spacing: 1px;">
            
          <span style="margin-right: 5px;color: #ddd;"> > </span> {{$category->name}}
          
          </div>
        </a>
        
        @endforeach
      
  </div>
</div>
    <!-- @component('components.leftnav',['categories'=>$categories])@endcomponent -->
    <!-- LATEST -->

    <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
            <div class="naslov-novi newest">
                <h3><span>NAJNOVIJE</span> DODATO</h3>
                
             </div>
         </div>
     </div>
    @component('components.leftbanner',['latest'=>$latest])@endcomponent

     <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
            <div class="naslov-novi newest">
                <h3><span>PRIJATELJI</span> SAJTA</h3>
             </div>
         </div>
     </div>
     <a href="http://www.raskrsnica.com/">Raskrsnica</a><br>
     <a href="https://www.apartmani-crnagora.net" target="_blank">Izdavanje apartmana u Crnoj Gori </a><br>
     <a href="http://thetelescope.in/lifestyle/fashion/nush-clothing/" target="_blank">Fashion</a><br>   
  </div>

		<!-- MAIN -->
		<div class="col-md-9">

			<div class="row negativ-margin">
				<div class="col-md-9 col-xs-12 mobhide">
          <div class="row-fluid">
            <div class="col-md-12 col-xs-12 mz-div main-banner" style="background: url({{ asset('img/webbanner1.png')}});"></div>
          </div>
        </div>

        <div class="col-md-3 col-xs-12 mobhide" >
          <div class="row-fluid">
            <a href="pretraga?gender_id=1">
              <div class="col-md-12 mz-div" style="background: url('{{ asset('img/muskarci2.png')}}');background-repeat: no-repeat;">
              </div>
            </a>
          </div> 
          
          <br>

          <div class="row-fluid">
            <a href="pretraga?gender_id=2">
              <div class="col-md-12  mz-div mz-div-down" style="background: url('{{ asset('img/zene2.png')}}');background-repeat: no-repeat;"></div>
            </a>
          </div>
        </div>
      </div>  
      
      <!-- ODEĆA -->
      <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
          <div class="naslov-novi">
            <h3><span>ODEĆA</span> OGLASI</h3>
            <a href="/Odeća" class="svi-link">Prikaži sve&emsp;> </a>
          </div>
        </div>
        @component('components.homelist', ['products' => $home_clothing])@endcomponent
      </div>

      <!-- OBUĆA -->
      <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
          <div class="naslov-novi">
            <h3><span>OBUĆA</span> OGLASI</h3>
            <a href="/Obuća" class="svi-link">Prikaži sve&emsp;> </a>
          </div>
        </div>
        @component('components.homelist', ['products' => $home_shoes])@endcomponent
      </div>


      <!-- Magazin -->
      <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 15px;">
          <div class="naslov-novi">
            <h3><span>MAGAZIN</span></h3>
          </div>
        </div>
                <!-- Set up your HTML -->
        <div class="owl-carousel owl-theme col-md-12">
          @foreach($magazin as $item)
          <a href="/magazin/{{$item->id}}/{{$item->slug}}">
            <div> 
              <img style="width: 100%;" data-src="{{asset('storage/images/blog/thumbnail/'.$item->main_image)}}" class="lazyload">
              <div class="title" style="border-bottom-left-radius: 25px;border-top:6px solid #ffce5a;padding:20px 20px;color: white; font-size: 1.3em;background-color:#ffb403;max-height:135px;">{{$item->title}}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>

      <!-- AKSESOAR -->
      <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
          <div class="naslov-novi">
            <h3><span>AKSESOAR</span></h3>
          </div>
        </div>
        @component('components.homelist',['products'=>$aksesoar])@endcomponent
      </div>

      <!-- INSTAGRAM -->
      <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">  
          <div class="naslov-novi"><h3><span>ZAPRATI</span> NAS</h3></div>
        </div>
        <div class="col-md-12">
          <a href="https://www.instagram.com/mojaodeca/"><img data-src="{{ asset('img/instabaner.png')}}" class="lazyload" alt="Banner for promoting instagram acount @mojaodeca" style="width: 100%;height: auto;"></a>
        </div>
      </div>

      <!-- DECIJA ODECA -->
      <div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
          <div class="naslov-novi">
            <h3><span>DEČIJA</span> ODEĆA</h3>
          </div>
        </div>
        @component('components.homelist', ['products' => $home_kids])@endcomponent
      </div>

    </div>
		</div>

    @component('components.footer',['categories'=>$categories])@endcomponent
    @push('slick-css')
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    @endpush
    @push('owl')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
          loop:false,
          margin:10,
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:3
              },
              1000:{
                  items:2
              }
          }
        })
      }(jQuery));
    </script>
    @endpush
@endsection