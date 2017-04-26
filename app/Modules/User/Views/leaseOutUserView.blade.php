@extends('layouts.app')

@section('content')
       <title>LeaseoutUser page</title>
       <body style= "  background-color: 	#F0F8FF">
 
           <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
           <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
           <div class="navbar-header">
      
         </div>
        <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="/">Asset Management System</a></li>
        <li><a href="/leaseoutuser/leaseoutscreen">LeaseOutScreen</a></li>
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

</nav>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          
    
             <strong>  Welcome LeaseOutUser!! <span style = "color:red;"><font size = "5">{{ Auth::user()->name }}</font></span><strong>
                    <br><br>
<?php   

     
       
       if (isset($result) == false || $result == false)  {

           echo "<h2 style = 'color:#40E0D0' id='successMessage'>"."you Don't Have any Asset to Show Information" ."</h2>";
       } else { 
       
             $i=1;
             echo    '<h1 style="height:30px" id="btn-add"  name="btn-add" class="btn btn-primary btn-xs"> Assets Information</h1>';
             echo "<table style = 'border-colapse:colapse' border = '2' class='table'>
                 <tr><th>Sl_No</th>
                 <th>Employee_Name</th>
                 <th>Employee_Id</th>
                 <th>Employee_Email</th>
                 <th>Asset_Type</th>
                 <th>Asset_Name</th>
                 <th>Operating System</th>
                <th>Processor</th>
                <th>Harddisk</th>
                 </tr>";

             foreach ($result as $key ) {

        
                 echo "<tr><td>".$i++."</td><td>".$key->name."</td><td>".
                 $key->employee_id."</td><td>".
                 $key->email."</td><td>".$key->type."</td><td>".$key->asset_name."</td><td>".
                 $key->os."</td><td>".$key->processor."</td><td>".$key->harddisk."</td></tr>";
        
      
             }

            echo "</table><br><br>";
    }
?>
<script>
$(document).ready(function(){
   
                     setTimeout(function() {
                       $('#successMessage').fadeOut('fast');
                    }, 5000); 
        });
 

</script>
</div>
</div>
</div>
@endsection

 