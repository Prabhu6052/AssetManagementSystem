  @include('Asset::ff')

 <body style= "  background-color: 	#F0F8FF">

      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

          <nav class="navbar navbar-default navbar-static-top">
      
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
             <ul class="nav nav-tabs" role="tablist">
                   <li class="active"><a href="/">Asset Management System</a></li>
                   <li><a href="/asset/create">CreateAssetInformation</a></li>
                <!--   <li><a href="/asset/leaseoutscreen">LeaseOutScreen</a></li> -->
                   <li><a href="/leaseoutdetails">LeaseOutDetails</a></li>
                   <li><a href="/usersinformation">UsersInformation</a></li>  

                  <ul class="nav navbar-nav navbar-right">
                         <li class="dropdown">
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="position:relative; padding-left:50px">
                          <img src="/uploads/images/{{Auth::user()->image}}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%;">
                          {{ Auth::user()->name }}<span class="caret"></span></a>
                         <ul class="dropdown-menu" role="menu" >
                                <li><a href="{{ route('profile') }}"><span class="glyphicon glyphicon-user"></span> profile</a></li>
                                <li>  <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-in">
                                            Logout</span></a></li>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}</form>                               
                           </ul>
                   </ul>
            </li>
    
         </ul>
      </ul>
  
   </div>
 </nav>