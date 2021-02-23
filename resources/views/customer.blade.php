@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Customer</title>
    </head>
    <body>
    
        <form action="addcustomer" method="POST">
        	<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
    		<h2>Customer</h2>
    		<table>
    			<tr>
    				
    				<td>First Name: </td>
    				<td><input type="text" name="firstName"/></td>
    			</tr>
    			<tr>
    				<td>Last Name:</td>
    				<td><input type="text" name="lastName"/></td>
    			</tr>
    			
    			<tr>
    				<td colspan="2" align="center">
    					<input type="submit" value="Submit"/>
    				</td>
    			</tr>
    		</table>
    	</form>
    </body>
</html>

@endsection

