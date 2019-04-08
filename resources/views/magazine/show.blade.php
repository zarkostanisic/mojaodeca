@extends('layouts.blog')

@section('meta_tags')
 	<title>{{$article->title}}</title>
    <meta name='description' itemprop='description' content='{{ str_limit($article->description, $limit = 280, $end = '...') }}' />
	<link rel="amphtml" href="{{ url('/magazin/amp/'.$article->id.'/'.$article->slug) }}">
	<meta property="og:url" content="{{url()->current()}}" />
	<meta property="og:type"  content="article" />
	<meta property="og:title" content="{{$article->title}} - Moja Odeća Magazin" />
	<meta property="og:description" content="{{$article->description}}" />
	<meta property="og:image" content="{{asset($article->main_image)}}" />

	<script type="application/ld+json">
	{
	  "@context": "http://schema.org",
	  "@type": "NewsArticle",
	  "mainEntityOfPage": {
	    "@type": "WebPage",
	    "@id": "{{url()->current()}}"
	  },
	  "headline": "{{$article->title}} - Moja Odeća Magazin",
	  "image": [
	    "{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}"
	   ],
	  "datePublished": "{{$article->created_at}}",
	  "dateModified": "{{$article->updated_at}}",
	  "author": {
	    "@type": "Organization",
	    "name": "Moja Odeća Tim"
	  },
	   "publisher": {
	    "@type": "Organization",
	    "name": "Moja Odeća",
	    "logo": {
	      "@type": "ImageObject",
	      "url": "{{asset('img/logo2.png')}}"
	    }
	  },
	  "description": "{{$article->description}}"
	}
	</script>
	<script type='application/ld+json'>
	{  
	   "@context":"https://schema.org",
	   "@type":"BreadcrumbList",
	   "itemListElement":[  
	      {  
	         "@type":"ListItem",
	         "position":1,
	         "item":{  
	            "@id":"{{url('')}}",
	            "name":"Početna"
	         }
	      },
	      {  
	         "@type":"ListItem",
	         "position":2,
	         "item":{  
	            "@id":"{{url('magazin/')}}",
	            "name":"Magazin"
	         }
	      },
	      {  
	         "@type":"ListItem",
	         "position":3,
	         "item":{  
	            "@id":"{{url('magazin/')}}/{{$article->category->name}}/",
	            "name":"{{ucfirst($article->category->name)}}"
	         }
	      },
	      {  
	         "@type":"ListItem",
	         "position":4,
	         "item":{  
	            "@id":"{{url()->current()}}/",
	            "name":"{{$article->title}}"
	         }
	      }
	   ]
	}
	</script>
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9 col-sx-12 article">
			<div class="article-main">
				<div class="article-head">
					<h1>{{$article->title}}</h1>
					<div class="article-info">
						<div class="article-cat {{$article->category->name}}"><a href="magazin/{{$article->category->name}}">{{$article->category->name}}</a></div>
						<div class="article-date">{{$article->created_at->toFormattedDateString()}}</div>
						<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Podijeli</a></div>
						<br style="clear: left;" />
					</div>
				</div>
				<div class="article-body">
					<p>{{$article->description}}</p>
					<p>
						<img src="{{asset('storage/images/blog/'.$article->main_image)}}">
					</p>
				</div>
			</div>

			<div class="article-body">
				{!! $article->body !!}
			</div>
		</div>
		<!-- SIDE BAR -->
		<div class="col-md-3 article-sidebar mobhide">
			<div class="cat-sidebar">
				<div class="row">
	          		<div class="col-md-12" style="margin-top:15px;">
	            	<h3 class="naslov"><span style="color: #000;">KATEGORIJE</span></h3>
	          		</div>
	        	</div>
				<div class="magazin-cat-list">
					<ul>
					@foreach($magazin_categories as $category)
                  		<a href="/magazin/{{$category->name}}"><li>{{ucfirst($category->name)}}</li></a>
                  	@endforeach
					</ul>
				</div>
			</div>
			
			<!-- Najnoviji clanci -->
			<div class="row">
	          		<div class="col-md-12" style="margin-top:15px;">
	            	<h3 class="naslov"><span>NAJNOVIJI</span> ČLANCI</h3>
	          		</div>
	        	</div>
	        	<div>
					@foreach($latest as $article)
					<div class="row">
						<a href="/magazin/{{$article->id}}/{{$article->slug}}">
			    		<div class="col-md-12">
			        		<img src="{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}" style="width: 100%;">
			        		<h3 class="latest-title">{{$article->title}}</h3>
			        		<hr>
						</div>
						</a>
					</div>
					@endforeach
				</div>
		</div>				
			</div>
		</div>

	</div>
</div>


<div class="related-articles">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ">
				<h3>Svideće vam se i ovo ...</h3>
			</div>
		</div>
		<div class="row">
			@foreach($relatedArticles as $article)	
			<div class="col-md-4 col-xs-12 related-articles index-article">

					<a href="/magazin/{{$article->id}}/{{$article->slug}}" style="text-decoration: none;">
						<img src="{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}" style="width: 100%;">
					</a>	

					<div class="index-article-body">
						
						<div class="article-index-cat {{$article->category->name}}"><a href="magazin/{{$article->category->name}}">{{$article->category->name}}</a></div>
				
						<a href="/magazin/{{$article->id}}/{{$article->slug}}" style="text-decoration: none;">
							<h3 class="related-title">{{$article->title}}</h3>
						</a>

						<p>{{ str_limit($article->description, $limit = 80, $end = '...') }}</p>
						<a href="/magazin/{{$article->id}}/{{$article->slug}}" title="6 Creative Ways to Use Instagram Stories Polls" class="read-more">Saznaj više<span class="glyphicon glyphicon-chevron-right "></span></a>
					</div>
				</div>
		    @endforeach
		</div>
	</div>
</div>




@endsection