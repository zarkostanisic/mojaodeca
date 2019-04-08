<!--
     This is the minimum valid AMP HTML document. Type away
     here and the AMP Validator will re-check your document on the fly.
-->
<!doctype html>
<html ⚡>
<head>
  <meta charset="utf-8">
  <title>{{$article->title}}</title>
  <link rel="canonical" href="{{ url($non_amp) }}">
  <meta name="viewport" content="width=device-width,minimum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Source+Sans+Pro" rel="stylesheet">
  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
  @if($instagram)
  <script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
  @endif
  <script async custom-element="amp-auto-ads"
        src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage": "http://cdn.ampproject.org/article-metadata.html",
    "headline": "{{$article->title}}",
    "datePublished": "{{$article->created_at}}",
    "dateModified": "{{$article->updated_at}}",
    "description": "{{ str_limit($article->description, $limit = 280, $end = '...') }}",
    "author": {
      "@type": "Person",
      "name": "Moja Odeća Tim"
    },
    "publisher": {
      "@type": "Organization",
      "name": "Moja Odeća",
      "logo": {
        "@type": "ImageObject",
        "url": "{{asset('img/logo3.png')}}",
        "width": 180,
        "height": 72
      }
    },
    "image": {
      "@type": "ImageObject",
      "url": "{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}",
      "height": 230,
      "width": 350
    }
  }
</script>
<style amp-custom>
    body{
      overflow-wrap: break-word;
    }
  	amp-sidebar {
  	  background: #ffffff;
      width: 250px;
    }
    .amp-sidebar-image {
      line-height: 100px;
      vertical-align:middle;
    }
    .amp-close-image {
       top: 15px;
       left: 225px;
       cursor: pointer;
    }
    li {
      margin-bottom: 20px;
      margin-left: 10px;
      margin-right: 10px;
      list-style: none;
    }
    p{
    	font-family: Source Sans Pro,sans-serif;
    	color: #323b43;
    	line-height: 1.6;
    	font-size: 19px;
    	font-weight: 400;

    }
    p, h1,h2,h3{
    	padding-left: 1rem;
    	padding-right: 1rem;
    }
    h1,h2,h3{
		font-family: 'Poppins',sans-serif;
		line-height: 1.2;
		font-size: 2rem;
		font-weight: 600;
		color: #323b43;
	}
	h2{
		font-size: 24px;

	}
  h3{
    margin: 0px;
    padding: 20px;
    font-size: 17px;

  }
	#top-banner, .article-info{
		margin: 20px 0px;
	}
	.život a{
	color: #00eda4;
	}
	.zdravlje a{
		color: #ffb404;
	}
	.nega a{
		color: #ff8585;
	}
	.razno a{
		color: #444;
	}
	.poznati a{
		color: #F44336;
	}
	.moda a{
		color: #512DA8;
	}
	.article-info{
		padding: 5px 1rem;
		font-family: 'Poppins',sans-serif;
		border-bottom: 1px solid #dce4ec;
		color: #7b8994;
		font-size: 14px;
	}
	.article-cat{
		display: inline-block;
	    float: left;
	    text-transform: uppercase;
	}
	.article-cat a{
		font-family: 'Poppins',sans-serif;
		font-weight: 600;
		text-decoration: none;
	}
	#cat{
		display: block;
		font-family: 'Poppins',sans-serif;
		padding-left: 15px;
		padding-top: 15px;
	}
	.sidebar-cat a{
		font-size: .875rem;
		font-family: 'Poppins',sans-serif;
		font-weight: 600;
		color: #555;
		text-decoration: none;
		text-transform: uppercase;
	}
	.oglasi span{
		color: #f63;
	}
	.article-cat:after {
    	color: #7b8994;
    	content: "|";
    	margin-left: 10px;
    	margin-right: 10px;
	}
	.header_nav{
	    position: relative;
    	width: 100%;
    	padding: 0;
    	height: 60px;
    	z-index: 999;
    	box-shadow: 0 0 5px 2px rgba(0,0,0,.1);
	}
	.header_logo{
		position: absolute;
    	height: 60px;
    	width: auto;
    	left: 50%;
    	padding: 0;
    	transform: translateX(-50%);
    	z-index: 3;
	}
	.logo{
		display: inline-block;
    	width: 120px;
    	position: relative;
    	top: 50%;
    	float: left;
    	transform: translateY(-50%);
	}
	#hamburger{
	    display: inline-block;
    	float: left;
    	font-size: 2rem;
    	margin-left: 15px;
    	margin-top: 5px;
	}
  .related{
    padding: 30px 20px;
  }
  .related a{
    text-decoration:none;
  }
  .related h2{
    text-align: center;
    padding-bottom: 30px;
    font-size: 16px;
  }
  .related-item{
    border-radius: 5px;
    box-shadow: 0 0 15px rgba(30, 30, 30, .1);
    margin-bottom: 27px;
  }
 
</style>
</head>
<body>
<amp-auto-ads type="adsense"
    data-ad-client="ca-pub-5503948606321438">
</amp-auto-ads>

<amp-sidebar id="sidebar1" layout="nodisplay" side="left">
  <span id="cat">Kategorije</span>
  <hr>	
  <ul>
  	@foreach($magazin_categories as $category)
    <li class="sidebar-cat"><a href="/magazin/{{$category->name}}">{{ucfirst($category->name)}}</a></li>
    @endforeach
    <li class="sidebar-cat oglasi"><a href="/">MOJA ODEĆA - <span> OGLASI</span></a></li>

  </ul>
</amp-sidebar>

<header>
		
    <!-- <button on="tap:sidebar1.open" class="ampstart-btn caps m2">Open sidebar</button> -->
	<div class="header_nav">
		<div role="button" id="hamburger" aria-label="open sidebar" on="tap:sidebar1.open" tabindex="0">☰
    	</div>
		<div class="header_logo">
			<a href="{{ url('/magazin') }}" class="logo" target="_blank">
				<amp-img src="{{asset('img/logo3.png')}}" alt="logo image" width="140" height="52" layout="responsive"></amp-img>
			</a>
		</div>
	</div>
    
    <h1>{{$article->title}}</h1>
    <div class="article-info">
		<div class="article-cat {{$article->category->name}}"><a href="/magazin/{{$article->category->name}}">{{$article->category->name}}</a></div>
		<div class="article-date">Nov 9, 2018</div>
		<span style="clear: left;"></span>
	</div>
  	<p>{{$article->description}}</p>
 	<amp-img alt="{{$article->title}}" src="{{asset('storage/images/blog/'.$article->main_image)}}" width="1080" height="610" layout="responsive"></amp-img>
</header>
<div class="main-article">
{!! $article->body !!}
</div>
<div id="top-banner">
    <a href="http://mojaodeca.com">
       <amp-img src="{{asset('img/indexBanner.png')}}" width="1020" height="300" layout="responsive"></amp-img>
    </a>
</div>

<div class="related">
	<h2>Svideće ti se i ovo ...</h2>
	@foreach($relatedArticles as $article)
  <a href="{{ url('/magazin/'.$article->id.'/'.$article->slug.'') }}">
  	<div class="related-item">
  		<amp-img alt="{{$article->title}}" src="{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}" width="350" height="230" layout="responsive"></amp-img>
  		<h3>{{$article->title}}</h3>
  	</div>
  </a>
	@endforeach
</div>


</body>
</html>
