@extends('layouts.blog')

@section('meta_tags')
    <title>Edit magazin ADMIN</title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>
		(function() {
		    var editor_id = "";
		    tinymce.PluginManager.add('instagram', function(editor, url) {
		        // Add a button that opens a window
		        editor.addButton('instagram', {
		            text: 'Instagram',
		            icon: false,
		            onclick: function() {
		                // Open window
		                editor.windowManager.open({
		                    title: 'Instagram Embed',
		                    body: [
		                        {   type: 'textbox',
		                            size: 40,
		                            height: '100px',
		                            name: 'instagram',
		                            label: 'instagram'
		                        }
		                    ],
		                    onsubmit: function(e) {
		                        // Insert content when the window form is submitted
		                        console.log(e.data.instagram);
		                        var embedCode = e.data.instagram;
		                        var script = embedCode.match(/<script.*<\/script>/)[0];
		                        var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];
		                        console.log(script, scriptSrc);

		                        var sc = document.createElement("script");
		                        sc.setAttribute("src", scriptSrc);
		                        sc.setAttribute("type", "text/javascript");

		                        var iframe = document.getElementById(editor_id + "_ifr");
		                        var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

		                        tinyMCE.activeEditor.insertContent(e.data.instagram);
		                        iframeHead.appendChild(sc);
		                        setTimeout(function() {
		                        	iframe.contentWindow.instgrm.Embeds.process();
		                        }, 1000)
		                        // editor.insertContent('Title: ' + e.data.title);
		                    }
		                });
		            }
		        });
		    });
		    tinymce.init({
		    	height: 600,
		        selector:'textarea',
		        toolbar: 'bold italic | alignleft aligncenter alignright alignjustify | undo redo | link image media | code preview | fullscreen | instagram',
		        plugins: "wordcount fullscreen link image code preview media instagram",
		        extended_valid_elements : "script[language|type|async|src|charset]",
		        setup: function (editor) {
		            console.log(editor);
		            editor.on('init', function (args) {
		                editor_id = args.target.id;
		            });
		        }
		    });
		})();
	</script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection

@section('content')
	
<div class="container" style="padding-top: 50px;">
	<a href="/">
		<button type="button" class="btn btn-dark">Povratak</button>
	</a>
	<hr>

	@if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      <hr>
  	@endif
  	
	<form enctype="multipart/form-data" method="POST" action="/magazin/update/{{$article->id}}">
 		{!! csrf_field() !!}

 		<div class="form-group">
			<label for="main_image">Slika artikla</label>
			<input type="file" name="main_image"/>
			<img src="{{asset('storage/images/blog/thumbnail/'.$article->main_image)}}">
		</div>

		 <div class="form-group">
            <label for="sel1">Kategorija:</label>
            <select class="form-control" name="cat_id">
            @foreach($magazin_categories as $category) 
                <option {{ $article->cat_id == $category->id ? "selected" : "" }} value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            </select>
        </div>

 		<div class="form-group">
			<label for="title">Naslov oglasa :</label>
			<input type="text" class="form-control" name="title" value="{{$article->title}}">
		</div>

		<div class="form-group">
			<label for="description">Kratak uvod :</label>
			<input type="text" class="form-control" name="description" value="{{$article->description}}">
		</div>

		<div class="form-group">
			<label for="body">Tekst:</label>
			<textarea class="form-control" name="body">{{$article->body}}</textarea>
		</div>

		<button type="submit" class="btn btn-default button-create" style="width: 100%;margin-top: 5px;">OBJAVI </button>
	</form>
</div>

@endsection
