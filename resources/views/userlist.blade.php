<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	 <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	 <!--  <script src="{{asset('js/jquery.js')}}"></script>
	<script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>


      <script>
  $(function () {
    $("#example1").DataTable();
 
  });
</script> -->
</head>
<body>
<?php //echo "<pre>"; print_r($list); exit; ?>
<!-- Main content -->
    <section class="content">
  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
                <div class="error" style="color:red;">
                <center></center>
                </div>
            <h3>{{ Session::get('emailid')}}</h3>
           	<h5><a href="{{'logout'}}">Logout</a></h5>
            <div><center> <a href="{{url('practice')}}"><span class="glyphicon glyphicon-plus">Add New</span></a></center>
           

            <?php $serialno=0; ?>
            <div class="box-body">
               <!-- /.box-body-header -->
            @if(Session::has('message'))
           <div style="color:red;"><center>{{Session::get('message')}}</center></div>
              @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
             @foreach($list as $list)
              
                <tr>
                  <td>{{$serialno++}}</td>
                  <td>{{$list->name}}</td>
                  <td>{{$list->email}}</td>
                  <td><a href="edit/{{ $list->id }}"><span class="glyphicon glyphicon-edit"></span></a> <a href="delete/{{ $list->id}}" onclick="return confirm('Are you sure you want to delete?')"><span class="glyphicon glyphicon-trash"></span></a><a href="mail/{{ $list->id }}"><span class="fa fa-fighter-jet"></span></a></td>
                </tr>
                @endforeach
               </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- DataTables -->
      </section>

<!-- <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
             @foreach($entry as $entry)
             {{ ++$serialno }}
                <tr>
                  <td>{{$serialno}}</td>
                  <td>{{$entry->filename}}</td>
                  <td> <img src="{{route('getentry', $entry->filename)}}" alt="ALT NAME" class="img-responsive" style="width: 200px;, height:250px;"/></td>
                  <td><a href="{{ route('remove', $entry->id )}}" onclick="return confirm('Are you sure you want to delete?')"><span class="glyphicon glyphicon-trash"></span></a></span></a></td>
                </tr>
                @endforeach
               </tbody>
              </table>
 -->



      </body>
      </div>
      </div>
      </div></div></section></body>

      <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script >
$(document).ready(function(){
	
$('#example1').DataTable();
});
</script>
