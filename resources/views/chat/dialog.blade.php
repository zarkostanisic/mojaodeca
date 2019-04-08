@extends('layouts.app')

@push('slick-css')

<style type="text/css">
.container-mobile{
	padding:0px;
}
.chat-head span.back a:hover{
	text-decoration:none;
}
.chatlogs {
	padding: 10px;
	width: 100%;
	height: 570px;
	overflow-x: hidden;
	overflow-y: scroll;
}
.chatlogs::-webkit-scrollbar {
	width: 10px;
}
.chatlogs::-webkit-scrollbar-thumb {
	border-radius: 5px;
	background: rgba(0,0,0,.1);
}
.chat {
	overflow: auto;
	word-wrap: break-word;
	position: relative;
	width: 70%;
	right: 0px;
	height: auto;
	display: inline-block;
	padding: 15px 10px;
	margin: 10px 10px 0;
	border-radius: 10px;
	color: #fff;
	font-size: 13px;
}

span.friend{
	background: #fff;
	color: rgba(60,51,176,1);
	box-shadow: 2px 2px 20px -2px rgba(60,51,176,0.2);
}
span.self {
	box-shadow: 2px 2px 20px -2px rgba(60,51,176,0.2);
	background: #1ddced;
	float: right;
}

div.chat-form {
	margin-top: 5px;
    width: 100%;
    border-top:1px solid #ccc;
    border-bottom:1px solid #ccc;
}
div.chat-form .ip-msg {
	width: 70%;
	float: left;
	font-size: 14px;
	padding: 15px;
	color: rgba(60,51,176,0.9);
	border:none;
}
.chat-form button {
	width: 29%;
	background: #1ddced;
	padding: 5px 15px;
	font-size: 25px;
	color: #fff;
	border: none;
	margin-left:4px;
	cursor: pointer;
}

.chat-form button:hover {
	background: #13c8d9;
}
</style>

@endpush

@section('ads')

@endsection

@section('content')

<meta name="_token" content="{{ csrf_token() }}"/>

<div class="container" >
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<div class="chatbox">
				<div class="chat-head">
					<span class="back"><a href="/inbox"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a></span>
					<span>{{$name}}</span>
				</div>
				<div id="chat-window" class="chatlogs">
					<div class="alert alert-warning" role="alert" style="text-align:center;font-size: 13px;">
						U razgovoru sa prodavcem naglasite ID oglasa kako bi prodavac odmah znao o kojem proizvodu je reč.
					</div>
					@foreach($messagess as $message)
					<span class="chat {{$message->user_from_id == $self ? 'self' : 'friend' }}">{!! nl2br($message->chat) !!}</span>	
					@endforeach
				</div>
				<div class="chat-form">
							<textarea type="text" id="chat_text" rows="1" class="ip-msg" placeholder="Napiši nešto.."></textarea>
							<button id="chat_send">Send</button>
				</div>
			</div>	
		</div>
	</div>
</div>
@endsection

@push('script')

@push('script')

<script type="text/javascript">
  
  	$('#chat-window').scrollTop($('#chat-window')[0].scrollHeight);
	$("#chat_send").on("click", sendMessage);

 	function sendMessage() {
    	var text= $('#chat_text').val();
    	if(text === ""){ return; }
    	$.ajaxSetup({
      		headers: {
        		'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      		}
   		});

	    $.ajax({
	      url:'/chat/send',
	      data: { 
	        "user_from_id": {{$self}}, 
	        "user_to_id": {{$friend_id}},
	        "chat":text
	   	 },
	      dataType:'json',
	      type:'POST',
	      success:addMessage(text)
	    });
  	}

  	function addMessage(text){
  		$('#chat-window').append('<span class="chat self">'+text+'</span>');
  		$('#chat-window').scrollTop($('#chat-window')[0].scrollHeight);
  		$('#chat_text').val('');
  	}

</script>

@endpush
@endpush