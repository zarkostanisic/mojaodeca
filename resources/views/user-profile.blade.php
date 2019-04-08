@extends('layouts.app')

@section('meta_tags')
        <title>Svi oglasi korisnika: {{$user_name}}</title>
        <meta name='description' itemprop='description' content='Svi oglasi korisnika: {{$user_name}} | Besplatni oglasi | Nova i polovna odeća'/>
@endsection

@section('content')

<meta name="_token" content="{{ csrf_token() }}"/>



<div class="container">


  <div class="row">
    <div class="col-md-3">
      <div class="search">
        
         <div class="row">
          <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
              <h3 class="naslov"><span>SVI OGLASI KORISNIKA &emsp; </span></h3>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" style="margin-top:15px;margin-bottom: 10px;">
            <div style="box-shadow: rgba(0, 0, 0, 0.1) -9px 10px 41px 0px;padding-top: 20px;border-radius: 8px;text-align:center;">
              <div class="user-img">
                <img src="{{asset('img/user.png')}}">
              </div>
              <h4>{{$user_name}}</h4>
              <hr>
                <div class="product-action" style="padding-bottom:10px;">
                  <p>Rejting : <span id="single-rating">{{$rating}} <span class="glyphicon glyphicon-star glyphicon-custom"></span></span></p>
                </div>
              @auth
              @if ($vote)
              <hr>
              <div style="padding-bottom:20px;">
                Vaša ocena:
                <select id="rating-number" style="margin-left: 5px;border: 1px solid #ccc;border-radius: 10px;padding: 8px 15px;">
                  <option value="5" {{ $vote == 6 ? "selected" : "" }}disabled >-</option>
                  <option value="1" {{ $vote == 1 ? "selected" : "" }}>1</option>
                  <option value="2" {{ $vote == 2 ? "selected" : "" }}>2</option>
                  <option value="3" {{ $vote == 3 ? "selected" : "" }}>3</option>
                  <option value="4" {{ $vote == 4 ? "selected" : "" }}>4</option>
                  <option value="5" {{ $vote == 5 ? "selected" : "" }}>5</option>
                </select>
              </div>
              @endif
              @endauth
              <a href="/chat/{{$user_id}}" style="text-decoration:none;"><div id="user-profile-chat">Pošaljite poruku prodavcu<span class="glyphicon glyphicon-chevron-right chat-link-icon"></div></a>
            </div>  
          </div>
        </div>


      </div>
    </div>
    <div class="col-md-9 rezultati-div">
      <div class="rezultati">
        <div class="row">
        @component('components.homelist', ['products' => $products])@endcomponent
        </div>
         <div class="text-center">
          {{ $products->appends(Request::except('page'))->links() }}
        </div>
       </div>
    </div>
  </div>
 
 
  <!-- {{ $products->links() }} -->

</div>


@push('script')

<script type="text/javascript">
  
  $("#rating-number").on("change", voteAction);

  function voteAction() {
    var vote=$( "#rating-number option:selected" ).val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

     $.ajax({
      url:'/vote',
      data: { 
        "vote": vote, 
        "user_id": {{$user_id}}
      },
      dataType:'json',
      type:'POST',
      success:alert('Zahvaljujemo na oceni.')
    });
  }
</script>

@endpush

@endsection