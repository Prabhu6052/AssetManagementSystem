@extends('layouts.app')

@section('content')

<?php 
    use App\Modules\Asset\Models\AssetModel;
      
        $model = new AssetModel();
        $role = $model->getAllRole();
           
       ?>
<html>
<head>
<title>register</title>
<script src = "{{asset('js/user.js')}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form name = "form" onsubmit="return validate()" class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                                      <input id="userid-confirm" type="text" class="form-control" name="userid" required>
                                 </div>
                         </div>
                         
                        <div class="form-group">
                             <label for="role" class="col-md-4 control-label">User Role</label>
                                 <div class="col-md-6">
                         
                                     <select id = "role" class = "form-control" name = "role"  required>
                                          <?php   foreach($role as $key) {
                                              echo  " <option value = '$key->role'>$key->role</option>";
                                                } 
                                          ?>
                                     </select>
                                 </div>
                        </div>
                              <div class="form-group">
                              <label for="isleaseout" class="col-md-4 control-label">IsLeaseoutuser </label>
                               <div class="col-md-6">
                                 yes  <input class="test" type = "checkbox" name="isleaseout" value="1">
                                 no    <input class= "test" type = "checkbox" name="isleaseout" value="0">
                                  @if ($errors->has('isleaseout'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isleaseout') }}</strong>
                                    </span>
                                @endif
                                 <span id="testing"></span>
                           </div>
                           </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                               
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="submit" class="btn btn-primary" value="Register">
                                  
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
