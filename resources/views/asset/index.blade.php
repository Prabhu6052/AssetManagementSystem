<!doctype html>
<html>
    <head>
         <title>Index Page</title>
          <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">
         <link rel = "stylesheet" href = "{{ asset('css/indexpage.css')}}">
    </head>
    <body>
         <h1 style = "text-align: center;color: red">WELCOME</h1>
         <a  href = "{{ url('/login')}}"><span class = "top-right">LOGIN</span></a>
         <br>
         <hr style = "color: blue">
         <div class = "register">
         <h2>Click Below To Register</h2> 
         <a href = "{{ url('/register') }}"><span>REGISTER</span></a>
         <h2>Click Below to Add information about Asset</h2>
         <a  href = "{{ url('/asset/create') }}"><span>CREATE</span></a>
          <h2>Click Below to see information about Asset</h2>
         <a  href = "{{ url('/asset/read') }}"><span>Read</span></a>
         </div>
         
    </body>
  </html>  