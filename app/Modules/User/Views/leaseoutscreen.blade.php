@extends('layouts.app')

@section('content')
<title>leaseout screen</title>
 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
         @if(notify()->ready())
          ready 
          @endif
<?php 
  
    use App\Modules\User\Models\UserModel;
        
         $user_id = Auth::user()->id;
         $model = new UserModel();
         //getting leaseoutassetinformation details 
         $leaseoutdetail = $model->getLeaseOutDetailsByUserId($user_id);   
       //getting all available and testable asset information 
        $asset = $model->getAllAvailableAndTestableAsset();
      
      

 ?>  
      {{ $status = ""}}
       {{ $return_time = ""}}
       {{ $leaseout_id =""}}
       @foreach($leaseoutdetail as $key )
           
           <?php
            $leaseout_id = $key->id;
            $return_time = $key->return_time;
            $status = $key->status;?>

       @endforeach
    
         @if (Request::is('admin/leaseoutdetails/status/update/*')) 
            
            <?php
                    
                  $model = new UserModel();
                  $details = $model->getLeaseOutDetailsById($id);  
                    
            ?>
           <form name = "form"  class="form-horizontal" role="form" method="POST" action="/admin/leaseout/status/update">
          {{ csrf_field() }}
                    <div class="form-group">
                    <?php foreach($details as $key) {
                        echo  '<label for="email" class="col-md-4 control-label">User Name</label>
                                 <div class="col-md-6">
                               <input id="name" type="text" class="form-control" name="name" value="'.$key->name.'" readonly></div><br>';
                        echo  '<br><label for="email" class="col-md-4 control-label">User Email</label>
                                 <div class="col-md-6">
                               <input id="name" type="text" class="form-control" name="name" value="'.$key->email.'" readonly></div><br>';

                        echo  '<br><label for="email" class="col-md-4 control-label">Asset Name</label>
                                 <div class="col-md-6">
                               <input id="name" type="text" class="form-control" name="name" value="'.$key->asset_name.'" readonly></div><br>';              
                         
                        echo  '<br><label for="email" class="col-md-4 control-label">Recieved Time Of Asset</label>
                                 <div class="col-md-6">
                               <input id="name" type="text" class="form-control" name="name" value="'.$key->taken_time.'" readonly></div><br>'; 

                       echo  '<br><label for="email" class="col-md-4 control-label">Returned Time Of Asset</label>
                                 <div class="col-md-6">
                               <input id="name" type="text" class="form-control" name="name" value="'.$key->return_time.'" readonly></div>';         
                         echo ' <input type="hidden" value="'.$key->assetInformation_id.'" name="asset_id">'; 
                         echo ' <input type="hidden" value="'.$key->id.'" name="leaseout_id">';  
                    }
                      ?> 
                       </div> 
                        <div class="form-group">
                             <label for="email" class="col-md-4 control-label">Update Status</label>
                                 <div class="col-md-6">
                         
                                <select id="status" class="form-control" name="status">
                                  <option value="leaseout">Leaseout</option>
                                  <option value="available">Available</option>
                                  </select>      
                                  
                                  
                               
                                   </div> 
                                   
                                
                                   </div><br><br>
                                    
                 <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value ="update"> 
                </div>
             </form>



         @else 
           

             
            <?php 
               
               if (count($leaseoutdetail) !=0  ) {
                   echo    '<h1 style="height:30px" id="btn-add"  name="btn-add" class="btn btn-primary btn-xs">LeaseOutASset INformation</h1>';
                   $i=1;
                   echo "<table style = 'border-colapse:colapse' border = '2' class='table'>
                        <tr><th>Sl_No</th>
                         <th>Asset_Name</th>
                         <th>Operating System</th>
                        <th>Ram</th>
                        <th>Hard Disk</th>
                        <th>Received Time</th>
                        <th>Returned Time</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>";
                   foreach ($leaseoutdetail as $key) {
                         echo "<tr><td>".$i++."</td><td>".$key->asset_name."</td><td>".
                           $key->os."</td><td>".$key->ram."</td><td>".
                           $key->harddisk."</td><td>".$key->taken_time."</td><td>". 
                           $key->return_time."</td><td>";

                         if ($key->status =='available' ) {
                             echo "Available</td><td>";
                             echo "<span style ='color:green'>--</span></td></tr>";
                         } elseif ($key->status == 'requested' && $key->return_time == null) {
                             echo "Requested</td><td>";
                             echo "<span style ='color:blue'>Admin Not updated status</span></td></tr>";
                         } elseif ($key->status == 'requested' && $key->return_time !=null) {
                             echo "Available</td><td>";
                             echo "<span style ='color:green'>--</span></td></tr>";
                         } elseif ($key->status == 'leaseout' && $key->return_time == null) {
                            echo "leaseout</td><td>"; 
                            echo "<a style='color:red' href= '/leaseoutuser/leaseoutdetails/status/update/$key->id'>Return Asset </a></td></tr>"; 
                         }   elseif ($key->status == 'leaseout' && $key->return_time != null) {
                            echo "leaseout</td><td>";
                            echo "<span style ='color:blue'>Admin Not updated status</span></td></tr>";
                         } 
                       
                  }
                 echo "</table>";
               } else {
                   echo "<span style='color:brown'>you still not leaseout any asset</span>";
               } 


            ?> 
          
         <h3> <a href="/leaseoutuser/leaseoutAssetScreen" >Leaseout The  Asset</a> </h3>
    @endif
     
  
               

</div>
    </div>
</div>
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
  webshims.setOptions('waitReady', false);
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
</script>
@endsection
