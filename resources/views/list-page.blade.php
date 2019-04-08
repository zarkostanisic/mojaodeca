@extends('layouts.app')

@section('meta_tags')
        <title>{{ucfirst($category_name)}} | besplatni oglasi | nova i polovna odeća</title>
        <meta name='description' itemprop='description' content='{{ucfirst($category_name)}} | Kupite, prodajte ili zamenite polovnu i novu odeću.Veliki broj haljina patika satova obuće jakni majica i drugog. Objavite oglas besplatno.'/>
        <meta name='keywords' content=' besplatni oglasi garderoba haljine patike satovi odeca' />
        <meta property="og:title" content="Moja Odeca | Besplatni oglasi | Polovna i nova garderoba haljine patike satovi obuca" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{env('SITE_URL', 'Moja odeca')}}" />
        <meta property="og:image" content="{{asset('img/fb_logo.png')}}"/>
@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3 filter-bar">
      <div class="search">

        <div class="row">
          <div class="col-md-12" id="filter-mob-close">
           <strong>X</strong>&nbsp; ZATVORI
          </div>
        </div>

        <div class="row">
            <a href="/pretraga">
              <div class="col-md-12 button-reset">
                <h5 >PONIŠTI PARAMETRE</h5>
            </div>
          </a>
        </div>
        
        <div class="row">
          <div class="col-md-12" style="margin-top:15px;">
            <h3 class="naslov"><span>KATEGORIJE</span></h3>
          </div>
        </div>

          <ul style="padding: 0px;">
          @foreach($categories as $category)

          <a href="/{{urlencode($category->name)}}" id="filter-check"><li style="{{$category->id === $cat_id ? 'color:#000;list-style:square;':''}};">{{$category->name}}</li></a>

          @endforeach
          </ul>
          <!-- <hr> -->

        <form id='search-form' action="" method="GET">

        @if($subcategories && !$subcategories->isEmpty())
          <div class="row">
          <div class="col-md-12" style="margin-top:15px;">
            <h3 class="naslov"><span>GRUPA</span></h3>
          </div>
        </div>
          <div class="subcategories-scroll">
            @foreach($subcategories as $subcategory)
              @if(Request::get('gender_id'))
                @if (Request::get('gender_id') != $subcategory->gender_id && $subcategory->gender_id != 0 )
                  @continue
                @endif
              @endif
              <label id="filter-check" class="subcategory-check">
                  <input type="checkbox" name="subcategory_id" value="{{$subcategory->id}}" {{ Request::get('subcategory_id') == $subcategory->id ? "checked" : "" }}>
                  &emsp;{{$subcategory->name}}
              </label>
            @endforeach
          </div>
        @endif

        <div class="row">
          <div class="col-md-12" style="margin-top:15px;">
              <h3 class="naslov"><span>POL</span></h3>
          </div>
        </div>
          
        <label id="filter-check" class="gender-check">
            <input type="checkbox" name="gender_id" value="1" {{ Request::get('gender_id') == 1 ? "checked" : "" }}>
              &emsp;Muški
        </label>

        <label id="filter-check" class="gender-check">
            <input type="checkbox" name="gender_id" value="2" {{ Request::get('gender_id') == 2 ? "checked" : "" }}>
              &emsp;Ženski
        </label>

        @if($used)
        <div class="row">
            <div class="col-md-12" style="margin-top:15px;">
                <h3 class="naslov"><span>STANJE</span></h3>
            </div>
          </div>
        
            <label id="filter-check" class="used-check">
              <input type="checkbox" name="used" value="0" {{ Request::get('used') == '0' ? "checked" : "" }}>
              &emsp;Nekorišćeno
            </label>
            
            <label id="filter-check" class="used-check">
              <input type="checkbox" name="used" value="1" {{ Request::get('used') == '1' ? "checked" : "" }}>
              &emsp;Korišćeno
            </label>
        @endif
        
        <div class="row">
          <div class="col-md-12" style="margin-top:15px;">
            <h3 class="naslov"><span>GRAD</span></h3>
          </div>
        </div>
          <div class="subcategories-scroll">
            @foreach($countries as $country)
              <label id="filter-check" class="subcategory-check">
                  <input type="checkbox" name="country_id" value="{{$country->id}}" {{ Request::get('country_id') == $country->id ? "checked" : "" }}>
                  &emsp;{{$country->name}}
              </label>
            @endforeach
          </div>
        </form>
      </div>
    </div>

    
    <div id="filter-mob">FILTER OGLASA</div>
    
    
    <div class="col-md-9 rezultati-div">
      <div class="rezultati">
        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="sortiranje">
              <div class="row">
                <div class="col-md-4 col-xs-12 pull-right">
                 <div class="form-group">

                  <div class="row">
                    <label for="name" class="col-md-4" style="font-size: 13px;letter-spacing: 0.3px; color:#3e3e3e;text-align:right;padding-top:7px;padding-right: 0px;margin-bottom: 0px;">Sortiraj :</label>
                    <div class="col-md-8">
                      <select class="order form-control">
                        <option value="relev"{{ Request::get('order') == 'relev' ? "selected" : "" }}>Najpopularnije</option>
                        <option value="date"{{ Request::get('order') == 'date' ? "selected" : "" }}>Najnovije</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      
        @if(count($products))
        <div class="row">
          @component('components.homelist', ['products' => $products])@endcomponent
        </div>
        @else
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="no-result">
                        <span>Trenutno nema traženih oglasa</span>
                        <a href="/">Vratite se na početnu stranu </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="text-center">
          {{ $products->appends(Request::except('page'))->links() }}
        </div>
       </div>
    </div>
  </div>
</div>
@component('components.footer',['categories'=>$categories])@endcomponent

@endsection