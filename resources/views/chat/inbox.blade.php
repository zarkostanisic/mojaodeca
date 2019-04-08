@extends('layouts.app')

@section('ads')

@endsection

@section('content')

<div class="container container-mobile">
	<div class="row">
		<div class="col-xs-12 col-md-10 col-md-offset-1">
			<div class="panel inbox">
				<div class="chat-head">
					<span class="back"><a href="/"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a></span>
					<span>Sve poruke</span>
				</div>
				<ul class="list-group" id="contact-list">
					@foreach($users as $user)
					@if($user->user_from_id == $user_id)
					<a href="chat/{{$user->user_to_id}}">
					@else
					<a href="chat/{{$user->user_from_id}}">
					@endif
					<li class="list-group-item message-item">
						<div class="col-md-2 col-xs-2 message-image">
							@if($user->user_from_id != $user_id && $user->seen == 1)
							<img src="{{asset('img/message.png')}}" alt="Scott Stevens" class="img-responsive img-circle" />
							@else
							<img src="{{asset('img/no-message.png')}}" alt="Scott Stevens" class="img-responsive img-circle" />
							@endif
						</div>
						<div class=" col-md-10 col-xs-10" style="padding-top: 5px;">
							<span class="name">{{ucfirst($user->name)}}</span><br/>
							<span class="text-muted">{{ str_limit($user->chat, $limit = 20, $end = '...') }}</span>
							@if($user->created_at)
							<span class="text-muted message-time">{{$user->created_at->diffForHumans()}}</span>
							@endif
						</div>
						<div class="clearfix"></div>
					</li>
					</a>
					@endforeach
				</ul>
				<div class="text-center">
					{{ $users->links() }}
				</div>	
			</div>
		</div>
	</div>
</div>

@endsection