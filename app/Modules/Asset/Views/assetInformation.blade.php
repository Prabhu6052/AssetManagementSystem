
@extends('Asset::header')
<html>
<head>
 <title>ASset Information</title>
     <meta name="csrf-token" content="{{ csrf_token() }}"></meta>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 </head>
 <body style = "background-color: 	#f0f8ff">

<h1 style = "text-align:center;color:red">ASSET INFORMATION</h1>
<a href="{{ url()->previous() }}" class="btn btn-primary btn-xs">Back</a>
 <a  href = "{{ URL::to('/home')}}"><span style= "float:right">HOME PAGE</span></a>
 
 <br>
 <hr>  
      
         
<?php   
       echo '<div class="alert alert-success">';
        echo '<div id="successMessage">';  
       if(session('status')) {
           echo "<h2 id='successMessage'>".session('status')."</h2>";
       }
        echo "</div>";
        echo "</div>";
      //   if (isset($_SESSION['status']) ) {
            
            
       //  echo  "<h1>".$_SESSION['status']."</h1>" ;
         
    
       // }
    echo    '<a style="height:30px" id="btn-add" href = "/asset/create" name="btn-add" class="btn btn-primary btn-xs">Add New Asset Information</a>';
      $i=1;
      echo "<table style = 'border-colapse:colapse' border = '2' class='table'>
                 <tr><th>Sl_No</th>
                 <th>Asset_Type</th>
                 <th>AssetType_Name</th>
                 <th>Operating System</th>
                 <th>Processor</th>
                 <th>Ram</th>
                <th>HardDisk</th><th>Actions</th></tr>";
     foreach($read as $key ) {

        
        echo "<tr><td>".$i++."</td><td>".$key->type."</td><td>".
        $key->asset_name."</td><td>".
        $key->os."</td><td>".$key->processor."</td><td>".$key->ram."</td><td>".$key->harddisk."</td><td>".
       '<a href = "/asset/view/'.$key->id.'">'."Edit</a>".
        " | "."<button type = 'button' onclick='deleteAsset('.$key->id.')' id='del'>Delete</button>"."</td></tr>";
  
      }
     echo "</table><br><br>";
        
?>
<script>
function deleteAsset(id) {
}
$(document).ready(function(){
   
                     setTimeout(function() {
                       $('#successMessage').fadeOut('fast');
                    }, 500); 
        });

 $(".delete").on("click", function(){
   
        var _this = $(this);
        var id = $(this).data("id");
       
        var token = $(this).data("token");
        $.ajax(
        {
            url: "/asset/delete",
            type: 'get',
            data: {
                "id": id,
            },
            success: function (data)
            {
                console.log(data);

              _this.parent().parent().remove();
              
                document.getElementById("successMessage").innerHTML="<h1>deleted succesfully</h1>";
                
            }
        });
             
        console.log(data);

    });

    $(".assign").on("click",function(){
             
    });

</script>

</body>
</html>


