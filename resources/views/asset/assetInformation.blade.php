<html>
<head>
 <title>ASset Information</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       
  
 </head>
 <body>

<h1 style = "text-align:center;color:red">ASSET INFORMATION</h1>
 <a  href = "{{ URL::to('/')}}"><span style= "float:right">HOME PAGE</span></a>
 <br>
 <hr>
 
<?php               
            
         if (session('status')) {
    
         echo  "<h1>".session('status')."</h1>" ;
    
        }
      $i=1;
      echo "<table style = 'border-colapse:colapse' border = '2' >
                 <tr><th>Sl_No</th>
                 <th>Asset_Type</th><th>OperatingSystem</th>
                 <th>Processor</th>
                 <th>Ram</th>
                <th>HardDisk</th><th>Actions</th></tr>";
     foreach($read as $key ) {
       
        echo "<tr><td>".$i++."</td><td>".$key->type."</td><td>".
        $key->os."</td><td>".$key->processor."</td><td>".$key->ram."</td><td>".$key->harddisk.
        "</td><td>".'<a href = "/user/asset/">'."Assign</a>"." | " .
        '<a href = "/asset/view/'.$key->asset_id.'">'."Edit</a>".
        " | "."<a href='#' data-id ='$key->asset_id' value = '$key->asset_id' class ='delete'>delete</a>"."</td></tr>";
       
      }
     echo "</table>";
         
?>
<script>
 $(".delete").on("click", function(){
   
        var _this = $(this);
        var id = $(this).data("id");
        var token = $(this).data("token");
        $.ajax(
        {
            url: "/asset/delete",
            type: 'get',
            dataType: "JSON",
            data: {
                "id": id,
            },
            success: function ()
            {
              _this.parent().parent().remove();
                console.log("it Work");
            }
        });

        console.log("It failed");
    });

</script>


</body>
</html>


