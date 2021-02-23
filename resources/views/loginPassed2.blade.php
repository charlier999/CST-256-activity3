@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Login Passed</title>
    </head>
    <body>
    	<h3>Login Passed</h3>
    	
    	@if($user->getUsername() == 'mark')
        	<h3>Mark you have logged in successfully.</h3>
    	@else
        	<h3>Someone besides mark logged in successfully.</h3>
    	@endif
    	
    </body>
</html>
@endsection