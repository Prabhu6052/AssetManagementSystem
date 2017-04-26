@extends('layouts.app')

@section('content')
<title>profile page</title>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <img src="/uploads/images/{{$user->image}}" style="width:150px;height:150px;float:left;border-radius:50px;margin-right:25px">
           <h2> {{$user->name}}'s profile</h2>
           <form enctype="multipart/form-data" action="/profiles" method="post">
             {{ csrf_field() }}
           <label>Update Profile Image</label>
           <input type="file" name="image">
           <input type="submit" value="submit" class="pull-right btn btn-sm btn-primary">
           </form>
        </div>
    </div>
</div>
@endsection