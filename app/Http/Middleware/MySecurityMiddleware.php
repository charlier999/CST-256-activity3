<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;
use App\Services\Business\SecurityService;
use Illuminate\Support\Facades\Cookie;

class MySecurityMiddleware
{
    private $nonSecurePages = array
    (
        '/',
        'login3',
        'dologin3',
        'usersrest',
        'usersrest/*',
        'loggingservice'
    );
    
    private function DoesRequestRequireSecure($request)
    {
        
        // loop through nonSecurePages array to see if request is that page
        foreach ($this->nonSecurePages as $page)
        {
            // Is request a non secure page
            if($request->is($page)) return FALSE;
        }
        return TRUE;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->path();
        
        Log::info("SecureityMiddleware: Entering My Security 
             Middleware in handle() at path: " . $path);
        
        // Check to see if the $request needs secure service
        $secureCheck = $this->DoesRequestRequireSecure($request);
        
        if($secureCheck)
        {
            $ss = new SecurityService();
            
            // Check to see if the cookie has been assigend and 
            // the cookie userID is not a user 
            if(!Cookie::has('userID') && 
                !$ss->DoesUserExistByID(Cookie::get('userID')))
                return redirect('/login3');
        }
        Log::info($secureCheck ? 
            "Security Middleware in handle().....Needs Security" : 
            "Security Middleware in handle().....No Security Required");
        
        return $next($request);
    }
}
