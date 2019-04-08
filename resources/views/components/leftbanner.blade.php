<div class="newest-section">
	@foreach($latest as $item)
	<div class="row">
		<div class="col-md-12">
			<a href="/oglas/{{$item->slug}}/{{$item->id}}" style="text-decoration: none;">
			<div class="najnovije-box">
				<div class="najnovije-img" style="float:left;">
					@if(empty($item->images))         
					<img data-src="{{asset('storage/images/no-image.png')}}"  class="lazyload" alt="{{$item->name}}" width="80px" height="80px" >         
					@else
					<img data-src="{{asset(smallImage($item->images[0]))}}"  class="lazyload" alt="{{$item->name}}" width="80px" height="80px" >        
					@endif
				</div>

				<div class="najnovije-desc" style="padding-top: 5px;float: left;padding-left: 10px;max-width: 175px;">
					<!-- NASLOV -->
					<div class="title" style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">
						<span>{{ str_limit($item->name,20)}}</span>
					</div>
					<!-- TIP -->
					@if($item->noprice)
					<!--NEMA CENU -->
					<div class="pricebox " style="font-size: 13px;text-transform: uppercase;margin-top: 5px;">Dogovor</div>
					@else
					<div class="pricebox">
						{{$item->price}} <span style="color:#90A4AE;font-size: 12px;">RSD</span>
					</div>
					@endif		
					<div class="tip-left {{strtolower($item->used)}}">{{$item->used}}</div>
				</div>
			</div>
			</a>
		</div>
	</div>
	<!-- <br> -->
	@endforeach
</div>