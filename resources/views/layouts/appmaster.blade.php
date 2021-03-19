<html lang="en">
    <head>
        <meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    	<title>TestProject</title>
    	<link rel="stylesheet" href="../resources/assets/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="../resources/assets/css/Navigation-with-Button.css">
    	<link rel="stylesheet" href="../resources/assets/css/styles.css">
    </head>
    
    <body>
    	@include('layouts.header')
    	<div>
    		<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
       			<div class="container">
       				<a class="navbar-brand" href="#">Welcome to Activity 5</a>
       				<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
           				<span class="sr-only">Toggle navigation</span>
           				<span class="navbar-toggler-icon"></span>
       				</button>
            		<div class="collapse navbar-collapse" id="navcol-1">
                		<ul class="navbar-nav mr-auto">
                    		<li class="nav-item">
                    			<a class="nav-link" href="http://www.gcu.edu" target="_blank">
                    				GCU
                    			</a>
                    		</li>
                		</ul>
                		<span class="navbar-text actions"> 
                			<a class="login" href="login3">Log In</a>
                			<a class="btn btn-light action-button" role="button" href="/">Log Off</a>
                		</span>
            		</div>
       		 	</div>
    		</nav>
    		<script src="../resources/assets/js/jquery.min.js"></script>
    		<script src="../resources/assets/bootstrap/js/bootstrap.min.js"></script>
    	</div>
        <div align="center">
            @yield('content')
        </div>
        @include('layouts.footer')
    </body>
</html>