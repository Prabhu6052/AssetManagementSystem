
@extends('layouts.app')

@section('content')
<div class="container">
<title>LeaseOut details</title>
<body style = "background-color: 	#f0f8ff">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
<?php 
     use App\Modules\User\Models\UserModel;
    
        $model = new UserModel();
        //get leaseoutdetails from usermodel 
        $result =$model->getLeastOutDetails();
        $i=1;
        echo "<table style = 'border-colapse:colapse' border = '2' class='table'>
                 <tr><th>Sl_No</th>
                 <th>Employee_Name</th>
                 <th>Asset_name</th>
                <th>Employee_Email</th>
                 <th>Taken_time</th>
                 <th>Return_time</th>
                 <th>Status</th>
                 <th>Action</th>
                 </tr>";
        foreach ($result as $key) {
             echo "<tr><td>".$i++."</td><td>".$key->name."</td><td>".
                    $key->asset_name."</td><td>".
                    $key->email."</td><td>".
                    $key->taken_time."</td><td>".
                    $key->return_time."</td><td>"; 
              if ($key->return_time == null && $key->status !='leaseout') {
                   echo "Requested</td><td>";
                   echo "<a style='color:red' href= '/admin/leaseoutdetails/status/update/$key->id'>Update status </a></td></tr>";
               } else if ( $key->status == 'available' && $key->return_time != null ) {
                   echo "Available</td><td>";
                   echo "<span style='color:green'>Status  Updated </span></td></tr>";
               } else if ($key->status == 'leaseout' && $key->return_time == null) {
                   echo " leased out </td><td>";
                   echo "<span style='color:blue'> </span></td></tr>";
               } else if($key->return_time != null && $key->status == "leaseout" ) {
                   echo "leased out</td><td>";
                   echo "<a style='color:red' href= '/admin/leaseoutdetails/status/update/$key->id'>Update status </a></td></tr>";
               } 
      }

 ?>           
        </div>
    </div>
</div>
@endsection