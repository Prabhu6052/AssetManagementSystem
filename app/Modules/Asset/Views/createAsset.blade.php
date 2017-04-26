
@extends('layouts.app')

@section('content')
        <body style = "background-color:#f0f8ff">
           <div class="container">
               <div class="row">
                     <div class="col-md-8 col-md-offset-2">




        @if (session('status')) 
              <h1>{{session('status')}}</h1>
        @endif

</doctype html>
<html>
     <head>
           <title>creating asset information</title>   
           <script src="{{ asset('js/asset.js') }}"></script>   
      </head>
      <body>
           <div class = "create">
           <fieldset>   
           <form name="form" action = "/asset/add" method = "post" onsubmit = " return validate()">
           <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
           Enter Type:<select name = "assetType_id" id="mySelect" onchange="getvalue()">
          <?php  
                if(isset($type)) {
                   foreach ($type as $key) {

                        echo  " <option value = '$key->id'>$key->type</option>";
                    }
                }
          ?>
          </select><span class = "err" id = "type">*</span><br><br>
           Asset Sl_No :<input type ="text" name="sl_no"><span class = "err" id = "sl_no">*</span><br><br>
           Testable device: Yes<input class = "test" type = "checkbox" value="1" name ="testing">
                            No<input  class = "test" type ="checkbox" value="0" name = "testing"><span class = "err" id = "testing">*</span><br><br>
           Enter AssetType Name:<input type = "text" name = "name1"><span class = "err" id = "namu">*</span><br><br>
           Enter Operating system:  <input type = "text" name = "os1" ><span class = "err" id = "os">*</span><br><br>
           Enter processor:   <input type = "text" name = "processor"><span class = "err" id = "proces">*</span><br><br>
           Enter RAM:   <input type ="text" name = "ram1"><span class = "err" id = "ram">*</span><br><br>
           Enter Harddisk: <input type="text" name = "hd1"><span class = "err" id = "hd">*</span><br><br>
 <span id="s"></span>
           <input type = "submit"  class = "btn btn-primary" value = "CREATE"/>
           <a href="{{ url()->previous() }}" class="btn btn-primary ">Back</a>
          
           </form>
           </fieldset>
           </div>
         
           </body>
            
           </html>
     </div>
     </div>
     </div>
      
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script >
    

     function getvalue() {
           var x = document.getElementById("mySelect").value;
            
     }
            
     </script>
     @endsection