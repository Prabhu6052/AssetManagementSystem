@extends('layouts.app')

@section('content')
<div class="container">
<title>LeaseOut details</title>
<body style = "background-color: 	#f0f8ff">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">



         <form name = "form"  class="form-horizontal" role="form" method="POST" action="/leaseoutuser/leaseout/status/update">
          {{ csrf_field() }}

               <label for="name" class="col-md-4 control-label">User Name</label>
                           <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                                </div> <br> <br>  

                    <div class="form-group">
                             
                        <label for="asset" class="col-md-4 control-label">Leased Out Devices </label>
                                  <div class="col-md-6">
                                   <select id="asset" class="form-control" name ="id" readonly>
                     <?php  
                          foreach($result as $key) {
                               
                           echo "<option value = '$key->id'>  ($key->asset_name), ($key->os), ($key->processor), ($key->ram), ($key->harddisk) </option>";      

                          }
                     ?>
                     </select>
                     </div></div>  
                    <div class="form-group">
             <label for="name" class="col-md-4 control-label">Returning DateAndTime</label> 
                              <div class="col-md-6">
                                     <input type="datetime-local" class="form-control" name="return_time">
                                   </div> </div><br><br>
                 
                        
                 <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value ="update">                   

          </form>
                
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