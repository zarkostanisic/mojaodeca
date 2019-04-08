@foreach($products as $product)
	<div class="col-md-3 col-xs-6" style="min-height: 260px; padding-top: 15px; padding-bottom: 30px;">
		<div class="boxBody">
			<a href="/oglas/{{$product->slug}}/{{$product->id}}" style="text-decoration: none;">
			<!-- SLIKA -->
			<div class="box-img" style="width: 100%;max-height:180px;">
				<div class="tip {{strtolower($product->used)}}">{{$product->used}}</div>
				@if(empty($product->images))         
				<img data-src="{{asset('storage/images/no-image.png')}}" class="lazyload" style="height: 180px;width:100%;border-top-right-radius:7px;border-top-left-radius: 10px;">         
				@else
				<img data-src="{{asset(smallImage($product->images[0]))}}"  class="lazyload" alt="{{$product->name}} prodaj odeca zamena kupi garderoba obuca" style="width:100%;
max-height:180px;border-top-right-radius:10px;border-top-left-radius: 10px;">        
				@endif
			</div>
<!-- 			<div class="tip">polovno</div>
 -->			<div class="details">
				<!-- NASLOV -->
				<div class="title" style="padding-top: 3px;">
						<span>{{ str_limit($product->name,21)}}</span>
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
			</a>
		</div>
	</div>
@endforeach