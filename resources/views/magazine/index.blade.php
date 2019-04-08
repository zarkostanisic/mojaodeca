@extends('layouts.blog')
@section('content')


<div class="container">
	<div class="row">

	<div class="col-md-8 col-sx-12 index-article-top">
		<div class="row">
			@foreach($articles as $article)	
				<div class="col-md-6 col-xs-12 related-articles index-article">

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
	<!-- SIDE BAR -->
	<div class="col-md-4 article-sidebar index-sidebar">
		<div class="row">
			<div class="col-md-12">
				<div id="popular-head">Najčitanije</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="index-sidebar-items">
					@foreach($latest as $article)
					<a href="/magazin/{{$article->id}}/{{$article->slug}}" style="text-decoration: none;">
						<div style="padding: 1px 20px;">
							<h3 class="related-title">{{$article->title}}</h3>
							<p>{{ str_limit($article->description, $limit = 80, $end = '...') }}</p>
						</div>
					</a>
					<hr>
					@endforeach
				</div>
			</div>	
		</div>
	
	</div>
	</div>


		
		<div class="row">
			<div id="fitness">
			@foreach($fitness as $article)
			<div class="col-md-4 col-cx-12 fitness-item">
				<img src="{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}" style="width: 100%;">
				<h3 class="related-title">{{$article->title}}</h3>
			</div>
			@endforeach
		</div>
		</div>
	

	<div class="row">
		<div class="col-4 col-sm-3"></div>
	</div>

	<div class="col-md-12 col-sx-12 article">
		<div class="row">
			@foreach($secondArticles as $article)	
				<div class="col-md-4 col-xs-12 related-articles index-article">

					<a href="/magazin/{{$article->id}}/{{$article->slug}}" style="text-decoration: none;">
						<img src="{{asset('img/blog/thumbnail/'.$article->main_image)}}" style="width: 100%;">
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