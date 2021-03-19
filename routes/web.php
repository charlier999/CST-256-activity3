<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/whoami','WhatsMyNameController@index'); 
Route::get('/askme', function () { return view('whoami'); }); 

Route::get('/login', function () { return view('login'); });
Route::post('/dologin','LoginController@index'); 

Route::get('/login2', function () { return view('login2'); });

Route::get('/login3', function () { return view('login3'); });
Route::post('/dologin3', 'Login3Controller@index');

Route::get('/customer', function () { return view('customer'); });
Route::post('/addcustomer', 'CustomerController@addCustomer');

Route::get('/neworder', function () { return view('orders'); });
Route::post('/addorder', 'OrderController@addOrder');

Route::resource('/usersrest', 'UsersRestController');
Route::get('/usersrest', 'UsersRestController@index');
Route::get('/usersrest/{id}', 'UsersRestController@show');

Route::resource('/resttest', 'RestClientControlelr');
Route::get('/resttest', 'RestClientControlelr@index');
Route::get('/resttest/{id}', 'RestClientControlelr@show');

