@extends('layouts.app')

@push('script')

	<script type="text/javascript"> 

        function deleteProduct(id){
            var result = confirm("Want to delete?");
            if (result) {
                window.location.href = "/admin/product/delete/"+id;
            }
          }
    </script>

@endpush

@section('content')

<div class="container">
  <div class="row">   

    <div class="col-md-12" style="margin-top:30px;margin-bottom: 40px;">
      <h3 class="naslov"><span>LISTA SVIH VAŠIH OGLASA</span></h3>
    </div>

    <div class="col-md-12">
      <form method="GET" action="" class="forma_id_admin"> 
      <span style="font-weight: bold;">ID : </span><input type="number" name="id" placeholder="{{ Request::get('id')}}">
      <button type="submit" >Traži</button>  
      <a href="/admin/user"><button>Reset</button></a>
      </form>
      <br>
    </div>
                
    <div class="col-md-12 col-xs-12">
    
      <table class="table admin-table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Naslov</th>
            <th scope="col">Pregleda</th>
            <th scope="col">Objavljeno</th>
            <th scope="col">Akcija</th>
          </tr>    
        </thead>
                    
        <tbody>
        @foreach($products as $product)
    	     <tr>
      	     <td scope="row">{{$product->id}}</td>
      	     <td>
                <a href="/oglas/{{$product->slug}}/{{$product->id}}">{{$product->name}}</a>
             </td>
      	     <td>{{$product->views_num}}</td>
      	     <td>Pre {{$product->created_at->diffInDays()}} dana</td>
      	     <td><a href="javascript:deleteProduct({{$product->id}});">Delete</a>&nbsp; | &nbsp;<a href="/edit/{{$product->id}}">Edit</a></td>
    	     </tr>
        @endforeach
        </tbody>
      </table>

      <div class="text-center">
        {{ $products->links() }}
      </div>
                  
      <hr>
      <br>
      
    </div>
  </div>
</div>




@endsection