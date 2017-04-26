
@extends('layouts.app')

@section('content')

   <body style = "background-color: 	#f0f8ff">
             <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
        
 <?php 

      $asset_id =  $name = $os = $processor = $ram = $hd = "";
      if (Request::is('asset/view/*')) {
          foreach($asset as $key) {
              $asset_id = $key->id;
              $name = $key->asset_name;
              $os = $key->os;
              $processor = $key->processor;
              $ram = $key->ram;
              $hd = $key->harddisk;
         }

     } else {
         $error = "ooops not updated ";
         echo "<h1 style = 'text-align:bottom'>ooops not updated</h1>";
     }

  ?>


</doctype html>
<html>
     <head>
           <title>updating asset information</title>      
           <script src="{{ asset('js/assetUpdate.js') }}"></script>
     </head>
       <body>    
           <div class = "create">
           <fieldset>   
           <form name="form" action = '/asset/update/' method = "post" onsubmit = " return validate()">
           <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
           Enter AssetType Name:<input type = "text" name = "name1" value ="<?php echo $name;?> "><span class = "err" id = "namu">*</span><br><br>
           Enter Operating system:  <input type = "text" name = "os1" value = "<?php echo $os;?>" ><span class = "err" id = "os">*</span><br><br>
           Enter processor:   <input type = "text" name = "processor"value = "<?php echo $processor;?>"><span class = "err" id = "proces">*</span><br><br>
           Enter RAM:   <input type ="text" name = "ram1" value = "<?php echo $ram;?>"><span class = "err" id = "ram">*</span><br><br>
           Enter Harddisk: <input type="text" name = "hd1" value = "<?php echo $hd;?>"><span class = "err" id = "hd">*</span><br><br>
                          <input type="hidden" name ="asset_id" value = "<?php echo $asset_id;?> ">     
                          <input type = "submit" class="btn btn-info" value = "UPDATE"/> 
                          <a href="{{ url()->previous() }}" class="btn btn-primary ">Back</a>
           </form>
           </fieldset>
           </div>          
           </body>
           </html>
      </div>    
    </div>
</div>
@endsection
