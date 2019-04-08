@extends('layouts.blog')

@section('meta_tags')
	<title>{{ucfirst($cat_name)}} | Kategorija | Moja Odeća Magazin</title>
    <meta name='description' itemprop='description' content='Vesti iz kategorije {{ucfirst($cat_name)}}'/>
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
	            "@id":"{{url('/magazin')}}/",
	            "name":"Magazin"
	         }
	      },
	      {  
	         "@type":"ListItem",
	         "position":3,
	         "item":{  
	            "@id":"{{url('/magazin')}}/{{Request::segment(2)}}",
	            "name":"{{ucfirst($cat_name)}}"
	         }
	      }
	   ]
	}
	</script>
@endsection

@section('content')

<div class="related-articles">
	<div class="container">
		<div class="row">
			@foreach($articles as $article)	
			<a href="/magazin/{{$article->id}}/{{$article->slug}}">
			    <div class="col-md-4">
			        <img src="{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}" style="width: 100%;">
			        <div class="article-index-cat {{$article->category->name}}"><a href="magazin/{{$article->category->name}}">{{$article->category->name}}</a></div>
			        <h3 class="related-title">{{$article->title}}</h3>
			        <p>{{ str_limit($article->description, $limit = 80, $end = '...') }}</p>
			        <a href="/magazin/{{$article->id}}/{{$article->slug}}" title="6 Creative Ways to Use Instagram Stories Polls" class="read-more">Saznaj više<span class="glyphicon glyphicon-chevron-right "></span></a>
				</div>
			</a>
		    @endforeach
		</div>
	</div>
</div>




@endsection