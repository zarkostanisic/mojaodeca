@extends('layouts.app')

@section('meta_tags')
        <title>{{$cat_name}} | @if($single_product->subcategory){{$single_product->subcategory->name}} | @endif {{$single_product->used}} | {{$single_product->name}} | besplatni oglasi {{$single_product->country->name}}</title>
        <meta name='description' itemprop='description' content='{{ str_limit($single_product->description, $limit = 280, $end = '...') }}' />
        <meta name='keywords' content=' besplatni oglasi garderoba haljine patike satovi odeca' />
        <meta property="og:title" content="Moja Odeća | {{$cat_name}} | {{$single_product->used}} | {{$single_product->name}}" />
         <meta property="og:description" content="Besplatni oglasi | {{str_limit($single_product->description,300)}}" />
        <meta property="og:url" content="{{url()->current()}}" />
        <meta property="og:type" content="product" />
        <meta property="og:site_name" content="{{env('SITE_URL', 'Site Name')}}" />
		<meta property="og:image" content="{{asset($single_product->images[0])}}"/>
		<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "BreadcrumbList",
		  "itemListElement": [{
		    "@type": "ListItem",
		    "position": 1,
		    "name": "Početna",
		    "item": "{{url('/')}}"
		  },{
		    "@type": "ListItem",
		    "position": 2,
		    "name": "{{$cat_name}}",
		    "item": "{{url('/')}}/{{$cat_name}}"
		  },{
		    "@type": "ListItem",
		    "position": 3,
		    "name": "{{$single_product->name}}",
		    "item": "{{url()->current()}}"
		  }]
		}
		</script>


@endsection

@push('slick-css')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{$single_product->name}}",
  "image": "{{asset($single_product->images[0])}}",
  "description": "{{$single_product->description}}",
  "offers": {
    "@type": "Offer",
    "priceCurrency": "RSD",
    "price": "{{$single_product->price}}",
    "itemCondition": "http://schema.org/UsedCondition",
    "seller": {
      "@type": "Place",
      "name": "{{$single_product->country->name}}"
    }
  }
}
</script>

@endpush

@push('slick-js')
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
	 	$('.slider-for').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: false,
		  fade: true,
		  asNavFor: '.slider-nav',
		  adaptiveHeight: false
		});
		$('.slider-nav').slick({
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  asNavFor: '.slider-for',
		  dots: false,
		  centerMode: false,
		  focusOnSelect: true
		});
	});
 </script>
@endpush

@section('content')



<div class="container">
	<div id="breadcrumb">
	<!-- <div class="container"> -->
		<a href="/">Početna</a>
		&nbsp; > &nbsp;
		<a href="/{{urlencode($cat_name)}}">{{$cat_name}}</a>
		@if($single_product->subcategory)
		&nbsp; > &nbsp;
		<a href="/{{urlencode($cat_name)}}/?subcategory_id={{$single_product->subcategory_id}}">{{$single_product->subcategory->name}}</a>
		@endif
		&nbsp; > &nbsp;Oglas ID : <span style="color: red;">{{$single_product->id}}</span>

	<!-- </div> -->
	</div>
	<div class="single-product">


		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="row">
					<div class="col-md-12">
						<div class="slider slider-for">
							@if($single_product->images)
								@foreach($single_product->images as $key => $value)
								<div class="slick-main"><img src="{{asset($value)}}" alt="{{$single_product->name}} besplatni oglasi odeca garderoba novo polovno second hand"></div>
								@endforeach
							@endif	
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 ">
						<div class="slider slider-nav">
							@if($single_product->images)
								@foreach($single_product->images as $key => $value)
								<div class="slick-item"><img src="{{asset(smallImage($value))}}" alt="{{$single_product->name}} besplatni oglasi odeca novo polovno garderoba"></div>
								@endforeach
							@endif	
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="product-detail">
					<div class="product-action">
						<span id="single_id">Oglas ID: &nbsp; {{$single_product->id}}</span>
						<span>Broj pregleda : {{$single_product->views_num}}</span>
						<a  href="/profil/user/{{$single_product->user_id}}">Svi oglasi prodavca&nbsp; > </a>
					</div>
					<hr>
					<div class="product-action">
						<p>Rejting prodavca : <span id="single-rating">{{$rating}} <span class="glyphicon glyphicon-star glyphicon-custom"></span></span></p>
					</div>
					<hr>
					<h1>{{$single_product->name}}</h1>

						 @if($single_product->noprice)
							<!-- NEMA CENU -->
							<div class="pricebox " style="color: #ff2929;font-size: 18px;text-transform: uppercase;margin-top: 5px;">
						 	Dogovor
						 </div>
						 @else
						 	<!-- IMA CENU -->
						 	<div class="pricebox" style="font-family: 'Open Sans', sans-serif;font-weight: 700;font-size:30px;color:#ff3f13;">
								{{$single_product->price}} <span style="color: #666;font-size: 15px;">rsd</span>
							</div>
						 @endif

						
						<br>
						<div class="row">

							<div class="col-md-6 col-xs-6">
								<div class="second-description type-info">
									<h5>Stanje</h5>
									<p>{{$single_product->used}}</p>
								</div>
								<div class="second-description gender-info">
									<h5>Pol</h5>
									<p>{{$single_product->gender->name}}</p>
								</div>
								<div class="second-description size-info">
									<h5>Veličine</h5>
									<p>{{$single_product->size}}</p>
								</div>
							</div>

							<div class="col-md-6 col-xs-6">
								<div class="second-description cat-info">
									<h5>Kategorija</h5>
									<p>
										<a href="/{{urlencode($cat_name)}}">{{$cat_name}}</a>
										@if($single_product->subcategory)
										&nbsp; > &nbsp;
										<a href="/{{urlencode($cat_name)}}/?subcategory_id={{$single_product->subcategory_id}}">{{$single_product->subcategory->name}}</a>
										@endif
									</p>
								</div>
								<div class="second-description size-info">
									<h5>Grad</h5>
									@if($single_product->country)
										<p>{{$single_product->country->name}}</p>
									@else
										<p>Beograd</p>	
									@endif	
								</div>
								<div class="second-description date-info">
									<h5>Objavljeno</h5>
									<p>{{$single_product->created_at->format('d.m.Y')}}</p>
								</div>
							</div>

						</div>


						
						<div id="showPhone" class="phone" style="cursor: pointer;">Kliknite za broj telefona</div>
						<a href="tel:{{$single_product->phone}}" id="phone" style="display: none;"><div class="phone">Tel :  {{$single_product->phone}}</div></a>
						<a href="/chat/{{$single_product->user_id}}" style="text-decoration:none;"><div class="chat-link">Pošaljite poruku prodavcu<span class="glyphicon glyphicon-chevron-right chat-link-icon"></span></div></a>
						<br>
						<div class="second-description description">
							<h5>Opis</h5>
							<p>{!! nl2br(e($single_product->description)) !!}</p>
						</div>
				</div>
			</div>

		</div>
	</div>
	
	<div class="row">
        <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
            <h3 class="naslov"><span>OSTALI OGLASI</span> IZ KATEGORIJE</h3>
    	</div>
    </div>
	@component('components.related-product', ['products' => $related_product])@endcomponent

</div>

     @component('components.footer',['categories'=>$categories])@endcomponent


@endsection