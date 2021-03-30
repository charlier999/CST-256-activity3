<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use App\Services\Business\SecurityService;
use App\Models\UserModel;
use Carbon\Exceptions\Exception;

class Login3Controller extends Controller
{
    public function __constructor()
    {
        try {} catch (Exception $e) 
        {
            Log::error("Exception Occured in Login3Controller constructor. Exception:" . $e);
        }
    }
    
    public function index(Request $request)
    {
        Log::info("Entering LoginController::index()");
        
        $userName = $request->input('userName');
        $password = $request->input('password');
        
        Log::info("Parameters are: ", array("username" => $userName, "password"=>$password));
        
        if($userName == null || $password == null)
        {
            Log::info("Exit LoginController::index() with login failing");
            
            
            if($userName == null)
            {
                $cache = Cache::get('mydata');
                if($cache == null)
                    Log::info("Username in Cache not available.");
                else 
                    Log::info("Username: " . $cache . " was found in Cache.");
            }
            return view('loginFailed');
        }
        
        // Cahs the username in Laravel File Cache
        Cache::put('mydata', $userName, 60);
        Log::info("Username: " . $userName ." was put into Laravel File Cache for 60 seconds.");
        
        
        // Validate the Form Data 
        // Will redirect user back to login view if there are errors
        
        Log::info("Form validation is disabled");
        //Log::info("Form data starts being validated");
        //$this->validateForm($request);
        //Log::info("Form data finnishes being validated");
        
        $user = new UserModel($userName, $password);
        $secSer = new SecurityService();  
        
        Log::info("User creditals are being checked against the user table");
        $result = $secSer->login($user);
        echo "Account is real: " . $result;
        
        Log::info("Security Service returns " . $result);
        
        $data = ['user' => $user];
        if($result) 
        {
            Log::info("Exit LoginController::index() with login passing");
            Cookie::forever('userID', $secSer->FindUserIDByUNnPW($userName, $password));
            return view('loginPassed2')->with($data);
        }
        else 
        {
            Log::info("Exit LoginController::index() with login failing");
            return view('loginFailed');
        }
    }
    
    private function validateForm(Request $request)
    {
        // Data Validation Rules
        $rules = 
        [
            //'username' => 'Required | Between:4,10 | Alpha',
            'username' => 'Required | Between:4,10',
            'password' => 'Required | Between:4,10'
        ];
        Log::info("Current Validation Rules: ", $rules);
        // Run Data Validation Rules
        Log::info("Validation Rules result: ", $this->validate($request, $rules));
    }
    
    
}
