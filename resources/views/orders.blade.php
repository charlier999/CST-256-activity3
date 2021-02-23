@extends('layouts.appmaster')
@section('title', 'Login Page')
@section('content')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Orders</title>
    </head>
    <body>
    
        <form action="addorder" method="POST">
        	<input type="hidden" name="_token" value="<?php echo csrf_token()?>">
    		<h2>Customer</h2>
    		<table>
    			<tr>
    				
    				<td>Product: </td>
    				<td><input type="text" name="product"/></td>
    			</tr>
    			<tr>
    				<td>Customer ID:</td>
    				<td><input type="text" name="custID"/></td>
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