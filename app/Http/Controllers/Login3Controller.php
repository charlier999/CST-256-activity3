<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\User;
use App\Models\UserModel;

class Login3Controller extends Controller
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
        
        // Validate the Form Data 
        // Will redirect user back to login view if there are errors
        $this->validateForm($request);
        
        $user = new UserModel($userName, $password);
        $secSer = new SecurityService();  
        
        $result = $secSer->login($user);
        echo "Account is real: " . $result;
        
        $data = ['user' => $user];
        if($result) return view('loginPassed2')->with($data);
        else return view('loginFailed');
    }
    
    private function validateForm(Request $request)
    {
        // Data Validation Rules
        $rules = 
        [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10'
        ];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
    
}
