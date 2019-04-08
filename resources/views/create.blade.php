@extends('layouts.app')


@push('script')
<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

<script type="text/javascript">

  var category_form = $("#select-category");
  var subcategory_select = $("#select-subcategory select");

  function ajax_subcategories(argument) {

    var option = category_form.find(":selected").val();

    if (option == -1) {
      return;
    }

    $.ajax({
      url:'/subcategories/'+option,
      dataType:'json',
      type:'GET',
      success:onSuccess1
    });
  }

  function onSuccess1(data, status, jqXHR){

                if(data.length == 0){
                    $("#select-subcategory").hide();
                    return;
                };

                var current_id = $("#select-subcategory select").data("id");

                subcategory_select.empty();
                $.each(data, function(index, value){
                    var opt = document.createElement('option');
                    var selected=false;

                    if(current_id == value.id){selected=true};

                    subcategory_select.append($('<option>', {
                        value: value.id,
                        text: value.name,
                        'selected': selected
                    }));
                    
                });
                $("#select-subcategory").show();
            }


    ajax_subcategories();

    var submit=false;
    Dropzone.autoDiscover = false;
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Kliknite ovde za unos slika";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Izbrisi sliku";

        Dropzone.options.myAwesomeDropzone = {
          acceptedFiles: 'image/jpeg,image/png',
          maxFilesize: 10,
          maxFiles: 4,
          parallelUploads: 1,
          autoProcessQueue : false,
          uploadMultiple: false,
          addRemoveLinks: true,
          init: function() {
              this.on("maxfilesexceeded", function(file){
                  alert("No more files please!");
              });
              this.on("success", function(file, response) { 
                  $("#create-form").append($('<input type="hidden" ' + 'name="images[]" ' + 'value="' + response.path + '">'));
                  this.options.autoProcessQueue=true;
              });
              this.on("queuecomplete", function (file) {
                submit=true;
                $('#create-form').submit();
              });
              this.on('error', function(file, response) {
                alert('Neuspesno unosenje slike');
                // location.reload();
              });
              },
        url: "/image-upload"
    };

        $(document).ready(function(){
            var myDropzone = new Dropzone("#my-awesome-dropzone");
            
            $('#create-form').submit(function () {
              if(myDropzone.files.length < 1){
                    alert('Morate uneti bar jednu sliku');
                    return false;
                  };
                $('#create-overlay').fadeIn(500);
                if(!submit){
                  event.preventDefault();
                  myDropzone.processQueue();
                }
            });

            $('#dogovor').change(function(){
                if ($('#dogovor').is(':checked') == true){
                  $('#price').prop('disabled', true);
               } else {
                 $('#price').prop('disabled', false);
               }
            });


            category_form.on('change', function() {
                subcategory_select.val('-1');
               ajax_subcategories();
            });

          });
</script>
  
@endpush

@section('ads')

@endsection

@section('content')



<div class="container" style="background:white;">
<div id="create-overlay">
  <img src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/04de2e31234507.564a1d23645bf.gif" id="loadingImg" style="position: fixed; top: 50%;left: 50%;margin-left: -128px;margin-top: -128px;">
</div>

  <div class="forma-create" style="padding: 15px;">


  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div class="heder-form" style="margin-bottom: 15px;">
    <h3> DODAJ SLIKE </h3>
    <div style="height: 5px; background:linear-gradient(135deg, rgb(252, 207, 49) 0%, rgb(245, 85, 85) 100%);"></div>
    <br>
    <div class="alert alert-warning" style="font-family: Popins,sans-serif;" role="alert">
      Maksimalno 4 slike
    </div>
  </div>


  <form method="post" action="/image-upload"
      enctype="multipart/form-data"
      class="dropzone"
      id="my-awesome-dropzone">
      <input type="hidden" name="_token" value="{{csrf_token()}}">  
  </form>

<br>
 
  <form name="create-form" action="/create" method="POST" id="create-form" >
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-8">
        <div class="heder-form" style="margin-bottom: 25px;">
          <h3> OPIS PROIZVODA </h3>
          <div style="height: 5px; background:linear-gradient(135deg, #fccf31 0%,#f55555 100%);"></div>
        </div>

        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <label for="title">Naslov oglasa :</label>
              <input type="text" class="form-control" name="name" id="title" placeholder="Max. 40 karaktera" required maxlength="40">
            </div>

            <div class="form-group">
              <label>Stanje : </label>
              <select class="form-control" name="used">
                <option value="0">Nekorišćeno</option>
                <option value="1">Korišćeno</option>
              </select>
            </div>

            <div class="form-group">
              <label for="description">Tekst oglasa:</label>
              <textarea class="form-control" name="description" id="description" rows="9">
              </textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="sel1">Kategorija:</label>
                <select class="form-control" name="category_id" id="select-category">
                  @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group" id="select-subcategory" style="display: none">
              <label for="sel1">Podkategorija:</label>
              <select class="form-control" name="subcategory_id"></select>
            </div>

            <div class="form-group">
              <label for="sel1">Pol:</label>
                <select class="form-control" name="gender_id">
                  <option value="1">Muški</option>
                  <option value="2">Ženski</option>
                </select>
            </div>

            <div class="form-group">
              <label for="description">Velicina:</label>
              <input type="text" class="form-control" name="size" id="size" maxlength="20">
            </div>

            <label for="description">Cena:</label>
            <div class="input-group">
              <input type="number" class="form-control" name="price" id="price" maxlength = "10" placeholder="Nisu dozvoljeni znakovi">
              <span class="input-group-addon">RSD</span>
           </div>

           <div style="padding-top: 10px">
              <input type="checkbox" name="noprice" value="1" id="dogovor">Dogovor<br>
           </div>

          </div>
          
        </div>
      </div>

      <div class="col-md-4">
       <div class="heder-form" style="margin-bottom: 30px;">
        <h3> KONTAKT INFORMACIJE</h3>
        <div style="height: 5px; background:linear-gradient(135deg, rgb(252, 207, 49) 0%, rgb(245, 85, 85) 100%);"></div>
      </div>

      <div class="form-group">
        <label for="sel1">Grad\Mesto:</label>
        <select class="form-control" name="country_id">
          @foreach($countries as $country)
          <option value="{{$country->id}}">{{$country->name}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="description">Telefon:</label>
        <input type="text" class="form-control" name="phone" id="phone" required maxlength="30">
      </div>
      <button id="submit-oglas" type="submit" class="btn btn-default button-create" style="width: 100%;margin-top: 5px;">OBJAVI </button>
    </div>

    </div>
  </form>
  </div>
</div>

@endsection