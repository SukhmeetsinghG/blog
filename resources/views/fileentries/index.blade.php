<!DOCTYPE html>
<html> 
<head>

  <style type="text/css">

    #mymap {

      border:1px solid red;

      width: 800px;

      height: 500px;

    }

  </style>
<script src="http://maps.google.com/maps/api/js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

  </head>
  
<body> 
    <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="file" name="filefield">
       {{ $errors->first('filefield')}}
        <input type="submit">
    </form>
  @if(Session::has('message'))
           <div style="color:red;"><center>{{Session::get('message')}}</center></div>
              @endif
 <h1> Pictures list</h1>
 <div class="row">
        <ul class="thumbnails">
 @foreach($entries as $entry)
            <div class="col-md-2">
                <div class="thumbnail">
                    <img src="{{route('getentry', $entry->filename)}}" alt="ALT NAME" class="img-responsive" style="width: 200px;, height:250px;"/>
                    <a href="remove/{{ $entry->id }}" > Delete </a>
                    <div class="caption">
                        <p>{{$entry->original_filename}}</p>
                    </div>
                </div>
            </div>
 @endforeach
 </ul>
 </div>

 <h1>Google map integration </h1>

  <div id="mymap"></div>
 

  <script>
    var mymap = new GMaps({

      el: '#mymap',

      lat: 21.170240,

      lng: 72.831061,

      zoom:6

    });


    mymap.addMarker({

      lat: 21.170240,

      lng: 72.831061,

      title: 'Surat',

      click: function(e) {

        alert('This is surat, gujarat from India.');

      }

    });


  </script>
</body>
</html>