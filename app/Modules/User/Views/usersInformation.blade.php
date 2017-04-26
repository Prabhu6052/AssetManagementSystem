

@extends('layouts.app')

@section('content')
 <title>Users Information</title>
 <body style = "background-color: 	#f0f8ff">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <div class="container">
 <div class="row">
 <div class="col-md-10 col-md-offset-2">

  
         
<?php   
    
       
        echo '<div id="successMessage">';
         
        if (session('status')) {
            echo "<h2 id='successMessage' style='color:blue;'>".session('status')."</h2>";
        }
         
        echo "</div>";
        echo '<div class="successMessage">';
      
        echo "<span id='successMessage'> </span>";
                     echo "</div>";
     
     
        echo  '<span style="height:30px;width:150px" id="btn-add"  name="btn-add" class="btn btn-primary btn-xs">users Information</span>';
      $i=1;
      echo "<table style = 'border-colapse:colapse' border = '2' class='table'>
                <thead>
                 <tr><th>Sl_No</th>
                 <th>Employee_Name</th>
                 <th>Employee_Id</th>
                 <th>Employee_Role</th>
                <th>Employee_Email</th>
                <th>Action</th>
                </thead>
                 </tr>";
      foreach ($users as $key ) {

        
          echo "<tr><td>".$i++."</td><td>".$key->name."</td><td>".
          $key->employee_id."</td><td>";
          if($key->isleaseout == 0) {
            echo "user</td><td>";   
          } else if ($key->isleaseout == 1) {
              echo "leaseoutUser</td><td>";
          }
          echo $key->email."</td><td>".
          '<a class="btn btn-warning" href = "/user/view/'.$key->id.'">'."Edit</a>"." ".
        //  '<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick='."fun_edit(".$key->id.")".' href="#"  >Edit</button>'.
          "<a class='btn btn-danger' href='#' onclick=".'deleteUser('.$key->id.')'." id='del'>Delete</a>"."</td></tr>";
      
     }

     echo "</table><br><br>";
        
?>
 {!! $users->render() !!}

 <div class="modal fade" id="editModal" role="dialog">
      <div class="modal-dialog">
       
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update User Record</h4>
          </div>
          <div class="modal-body">
           <form onsubmit = "return validate()" name="form" class="form-horizontal" role="form"
                 method="POST" action='/user/update'>
             {{ csrf_field() }} 
            Name :<input type="text" name="name" ><br><br>

         

<script>
function fun_edit(id) {
   
}
function deleteUser(id) {
   var r = confirm("Are you sure you want to delete this user ");
   if (r == true) {
    $.ajax({
    url: '/user/delete',
    data: { "_token": "{{ csrf_token() }}" },
    type: 'GET',
    data: {
                "id": id,
            },
    success: function(result) {
        
          if(result == "true") {
         $("span").html("Deleted succesfully!!");
             setInterval(function() {
                    window.location.reload();
                }, 100);
        } else {
            $("span").html(" not Deleted something went wrong!!");
             setInterval(function() {
                    window.location.reload();
                }, 100);
            
        }

       
    }

  });
   } else {
        window.location="/usersinformation";
   }
}

$(document).ready(function(){
   
                     setTimeout(function() {
                       $('#successMessage').fadeOut('fast');
                    }, 500); 
        });

   
</script>



</div>
</div>
</div>
@endsection

