<?php if (session('status')) {
    
         echo  "<h1>".session('status')."</h1>" ;
    
        }
?>
</doctype html>
<html>
     <head>
           <title>creating asset information</title>
           <script src="{{ asset('js/asset.js') }}"></script>
           <link rel = "stylesheet" href = "{{ asset('css/asset.css')}}">
      </head>
      <body>
          
           <h2 style = "color:red;text-align:center">Creating Asset Information</h2>
           <div class = "create">
           <fieldset>
               <legend style = "color:blue">new asset information</legend>
           <form name="form" action = "/asset/add" method = "post" onsubmit = " return validate()">
           <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
           Enter Type:<select name = "type">
                      <option value = "">---select asset type---</option>
                      <option value = "Desktop">Desktop</option>
                      <option value = "Laptop">Laptop</option>
                      <option value = "Ipad">Ipad</option>
                      <option value = "Android">Android</option>
                      <option value = "IPhone">Iphone</option>
                      <option value = "Tablet">Tablet</option>
                      </select><span class = "err" id = "type">*</span><br><br>
           Enter Operating system:  <input type = "text" name = "os1" ><span class = "err" id = "os">*</span><br><br>
           Enter processor:   <input type = "text" name = "processor"><span class = "err" id = "proces">*</span><br><br>
           Enter RAM:   <input type ="text" name = "ram1"><span class = "err" id = "ram">*</span><br><br>
           Enter Harddisk: <input type="text" name = "hd1"><span class = "err" id = "hd">*</span><br><br>

           <input type = "submit" value = "CREATE"/>
           </form>
           </fieldset>
           </div>
           </body>
           </html>
          