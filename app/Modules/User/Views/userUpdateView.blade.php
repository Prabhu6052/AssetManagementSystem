
@extends('layouts.app')
@section('content')

<?php 
    use App\Modules\User\Models\UserModel;
    
       $model = new UserModel();
       $role = $model->getRoles();
       $asset = $model->getAllAvailableAsset();
      
      
     $name = $user_id = $employee_id = $email = $pass = "";
       foreach ($user as $key ) {
           $user_id = $key->id;
           $name =$key->name;
           $employee_id = $key->employee_id;
           $email = $key->email;
           $pass = $key->password;
           
       }
           
       ?>
<html>
<head>
<title>update users information</title>
<script>
 function validate() {
     
     var pass = document.form.password.value;
     var cpass = document.form.password_confirmation.value;
     if(pass != cpass) {
         document.getElementById("password-conf").innerHTML="give same confrom password";
         return false;
     }
     return true;
 }
 </script>
</head>
<body style = "background-color: 	#f0f8ff">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update User Information</div>
                <div class="panel-body">
                    <form onsubmit = "return validate()" name="form" class="form-horizontal" role="form" method="POST" action='/user/update'>
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo $name;?>" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group">
                             <label for="userid-form" class="col-md-4 control-label">Employee Id</label>

                                  <div class="col-md-6">
                                      <input id="userid-confirm" type="text" class="form-control" value="<?php echo $employee_id;?>" name="userid" required>
                                 </div>
                         </div>
                         
                        <div class="form-group">
                             <label for="email" class="col-md-4 control-label">User Role</label>
                                 <div class="col-md-6">
                         
                                     <select id = "role" class = "form-control" name = "role"  required>
                                          <option value='0'>User</option>
                                          <option value='1'>Leaseout User</option>
                                     </select>
                                 </div>
                        </div>
                      

                        <div class="form-group">
                             <label for="asset" class="col-md-4 control-label">Asset </label>
                                  <div class="col-md-6">
                                   <select id="asset" class="form-control" name ="assetinformation_id" required>
                                        <?php foreach($asset as $key) {
                                               echo "<option value = '$key->id'>  ($key->asset_name), ($key->os), ($key->processor), ($key->ram), ($key->harddisk) </option>";
                                        }
                                               ?>
                                           </select>
                                           </div>
                                        </div>       
                                 
                                    
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo $email;?>" readonly>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                
                      <input type="submit" class="btn btn-primary" value ="update">
                            </div>
                        </div>
                         <input type="hidden" value ="<?php echo $user_id;?>" name="user_id">    
                        
                                 
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 </body>
 </html>
@endsection
