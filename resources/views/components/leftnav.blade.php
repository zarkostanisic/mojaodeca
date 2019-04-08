<div class="row">
		<div class="navleft">

				<span class="navleft-cat" style="padding: 10px 25px; display:block;border-bottom:1px solid #efede9;">Kategorije</span>

				@foreach($categories as $category)
				
				
				<a href="{{$category->name}}">
					
					<div class="navlist" style="display: block; padding: 10px; border: 0px; border-radius: 0px;text-transform: uppercase;font-family: 'Open Sans', sans-serif;color:#888;font-size:11px;font-weight: 600;letter-spacing: 1px;">
						
					<span style="margin-right: 5px;color: #ddd;"> > </span> {{$category->name}}

					
					</div>
				</a>
				
				@endforeach
			
	</div>
</div>