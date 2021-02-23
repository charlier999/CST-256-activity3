<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\User;
use App\Models\UserModel;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // Usage of path method
        $path = $request->path();
        echo 'Path Method:' . $path;
        echo '<br>';
        
        // Usage of url method
        $url = $request->url();
        echo 'URL method: '.$url;
        echo '<br>';
        
        // Usage of is method
        $method = $request->isMethod('get') ? "GET" : "POST";
        echo 'GET or POST Method: '.$method;
        echo '<br>';
        
        $userName = $request->input('userName');
        $password = $request->input('password');
        echo "Username: " . $userName . " Password: " . $password;
        echo '<br>';
        
        $user = new UserModel($userName, $password);
        $secSer = new SecurityService();  
        
        $result = $secSer->login($user);
        echo "Account is real: " . $request;
        
        $data = ['user' => $user];
        if($request) return view('loginPassed2')->with($data);
        else return view('loginFailed');
            
        
    }
}
