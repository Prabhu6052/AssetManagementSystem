@extends('layouts.app')

@section('content')
<title>leaseout screen</title>
 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


 <?php 
        use App\Modules\User\Models\UserModel;
        $model = new UserModel();
       //getting all available and testable asset information 
        $asset = $model->getAllAvailableAndTestableAsset();    
  ?>         
 <form name = "form"  class="form-horizontal" role="form" method="POST" action="/leaseout">
          {{ csrf_field() }}

          <label for="name" class="col-md-4 control-label">User Name</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                  </div>

                     <input type="hidden" name="user_id" value="{{Auth::user()->id}}"><br><br>

                  <div class="form-group">
                             <label for="asset" class="col-md-4 control-label">Asset </label>
                                  <div class="col-md-6">
                                   <select id="asset" class="form-control" name ="assetinformation_id" required>
                                        <?php 
                                                  foreach($asset as $key) {
                                                         echo "<option value = '$key->id'>  ($key->asset_name), ($key->os), ($key->processor), ($key->ram), ($key->harddisk) </option>";
                                                   }
                                         ?>
                                    </select>
                                   </div>
                         </div>

                           <label for="name" class="col-md-4 control-label">Recieved DateAndTime</label> 
                              <div class="col-md-6">
                                     <input type="datetime-local" class="form-control" name="taken_time">
                                   </div>  <br><br>

                            
                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value ="INSERT">
                                 
                                
                            </div>
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