@extends('layouts.app')

@section('content')

        <title>Admin page</title>
      <body style= "  background-color: 	#F0F8FF">
      
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
 
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="{{ asset('js/assetUpdate.js') }}"></script>
           <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                   <div class="navbar-header">
      
                </div>
             <ul class="nav nav-tabs" role="tablist" id="myTabs" >
                   <li class="active"><a href="/">Asset Management System</a></li>
                  <li><a href="/asset/create">CreateAssetInformation</a></li> 
                <!--   <li><a href="/asset/leaseoutscreen">LeaseOutScreen</a></li> -->
                   <li><a href="/leaseoutdetails">LeaseOutDetails</a></li>
                   <li><a href="/usersinformation">UsersInformation</a></li>  
 
                  <ul class="nav navbar-nav navbar-right">
                         <li class="dropdown">
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="position:relative; padding-left:50px">
                          <img src="/uploads/images/{{Auth::user()->image}}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%;">
                          {{ Auth::user()->name }}<span class="caret"></span></a>
                         <ul class="dropdown-menu" role="menu" >
                                <li><a href="{{ route('profile') }}"><span class="glyphicon glyphicon-user"></span> profile</a></li>
                                <li>  <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-in">
                                            Logout</span></a></li>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}</form>                               
                           </ul>
                   </ul>
            </li>
    
         </ul>
      </ul>
  
   </div>
 </nav>

   <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2"> 
           <strong>  Welcome Admin!! <span style = "color:red;"><font size = "5">{{ Auth::user()->name }}</font></span></strong>
          <br><br>

    

<?php  
 
     use Illuminate\Support\Facades\Route; 
     echo '<div id="successMessage">';  
     if (session('status')) {
         echo "<h2 id='successMessage' style='color: 	#fffff;'>".session('status')."</h2>";
     }
     echo "</div>";
     echo '<div class="successMessage">'; 
     echo "<h2 id='successMessage'> </h2>";          
     echo "</div>";
     echo    '<h1 style="height:30px" id="btn-add"  name="btn-add" class="btn btn-primary btn-xs">Assets Information</h1>';
     $i=1;
     echo "<table   class='table table-bordered'>
                 <tr><th>Sl_No</th>
                 <th>Asset_Type</th>
                 <th>AssetType_Name</th>
                 <th>Operating System</th>
                 <th>Processor</th>
                 <th>Ram</th>
                <th>HardDisk</th><th>Actions</th></tr>";
     foreach ($read as $key ) {
         echo "<tr><td>".$i++."</td><td>".$key->type."</td><td>".
              $key->asset_name."</td><td>".
             $key->os."</td><td>".$key->processor."</td><td>".$key->ram."</td><td>".$key->harddisk."</td><td>".
              '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick='."fun_edit(".$key->id.")".' href="#"  >Edit</button>'." ".
             "<a class='btn btn-danger' href='#' onclick=".'deleteAsset('.$key->id.')'." id='del'>Delete</a>"."</td></tr>";
      
    }
    echo "</table><br><br>";
                
?>
  {!! $read->render() !!}
 
  
    <div class="modal fade" id="editModal" role="dialog">
      <div class="modal-dialog">
       
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Asset Record</h4>
          </div>
          <div class="modal-body">
<fieldset>   
           <form name="form" action = '/asset/update/' method = "post" onsubmit = "return validate()">
           <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
           Enter AssetType Name:<input type = "text" name = "name1" id="name" > <span class = "err" id = "namu">*</span><br><br>
           Enter Operating system:  <input type = "text" name = "os1" id="os1"><span class = "err" id = "os">*</span><br><br>
           Enter processor:   <input type = "text" name = "processor" id="pro"><span class = "err" id = "proces">*</span><br><br>
           Enter RAM:   <input type ="text" name = "ram1" id="ram1" ><span class = "err" id = "ram">*</span><br><br>
           Enter Harddisk: <input type="text" name = "hd1" id="hd1"><span class = "err" id = "hd">*</span><br><br>
                          <input type="hidden" name ="asset_id" id="asset_id" >     
                          
                          
         
      <div class="modal-footer">
            <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
            <input type = "submit" class="btn btn-info" value = "UPDATE"/> 
          </div>
          </form> 
           
           </fieldset>
        </div>
        
      </div>
    </div>


<script type="text/javascript">
$(document).ready(function(){
  
                     setTimeout(function() {
                       $('#successMessage').fadeOut('fast');
                    }, 500); 
        });
  function fun_edit(id)
    { 
    
      
      $.ajax({
        url: '/asset/view/',
        type:"GET", 
        data: {"id":id}, 
        success: function(result){
          //console.log(result);
        
        
         
          $("#asset_id").val(result[0]['id']);
          $("#name").val(result[0]['asset_name']);
          $("#os1").val(result[0]['os']);
          $("#pro").val(result[0]['processor']);
          $('#ram1').val(result[0]['ram']);
          $('#hd1').val(result[0]['harddisk']);
        }
      });
    }




function deleteAsset(id) { 
  var r = confirm("Are you sure you want to delete this  Asset ");

  if(r == true) {

    $.ajax({
    url: '/asset/delete',
    data: { "_token": "{{ csrf_token() }}" },
    type: 'GET',
    data: {
                "id": id,
            },
    success: function(result) {
        if(result == "true") {
         $("h2").html("Deleted succesfully!!");
             setInterval(function() {
                    window.location.reload();
                }, 100);
        } else {
           jQuery(".successMessage").fadeIn(1000 , function() {
       $("h2").append('This asset is assigned to some user !!<br> <a href = "/asset/unassign/'+result+'"  >'+'Unassigned It </a> and then delete ' );
     }).fadeOut( 10000 );  
        }

       
    }
});
  } else {
    window.location="admin";
  }
}


</script>

          </div>
    </div>
</div>

@endsection
@include('User::footer')
<!--href = "/asset/view/'.$key->id.'"-->