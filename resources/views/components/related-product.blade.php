<div class="row">
@foreach($products as $product)
	<div class="col-md-2 col-xs-6" style="min-height: 260px; padding-top: 15px;">
		<a href="/oglas/{{$product->slug}}/{{$product->id}}" style=" text-decoration: none;" >
			<div class="boxBody">
				<!-- SLIKA -->
				<div>
				@if(empty($product->images))         
					<img src="" alt="{{$product->name}}" style="width:100%;height: 100%;border-top-right-radius:10px;border-top-left-radius: 10px;">         
				@else
					<img src="{{asset(smallImage($product->images[0]))}}" alt="{{$product->name}}" style="width:100%;height: 100%;border-top-right-radius:10px;border-top-left-radius: 10px;">        
				@endif
				</div>
				<!-- BOX -->
				<div class="details">
					<!-- NASLOV -->
					<div class="title" style="padding-top: 2px;">
						<span style="font-family: 'Poppins', sans-serif;font-size:13px; font-weight: 500; color: #848194;">{{ str_limit($product->name,19)}}</span>
					</div>
					@if($product->noprice)
						<!-- NEMA CENU -->
						<div class="pricebox " style="font-size: 13px;text-transform: uppercase;margin-top: 5px;">Dogovor</div>
					 @else
					 <!-- CENA -->
						<div class="pricebox">
							{{$product->price}} <span style="color:#90A4AE;font-size: 12px;">RSD</span>
						</div>
					 @endif
				</div>
			</div>
		</a>
	</div>
@endforeach
</div>
