<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Models\DTO;

class UsersRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ss = new SecurityService();
        $users = $ss->findAllUsers();
        
        $errorCode = "0";
        $errorMsg = "No Error";
        
        if($users == FALSE)
        {
            $errorCode = "1";
            $errorMsg = "No Users Found";
        }
        
        return new DTO($errorCode, $errorMsg, $users);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ss = new SecurityService();
        $user = $ss->findUserByID($id);
        
        $errorCode = "0";
        $errorMsg = "No Error";
        
        if($user == FALSE)
        {
            $errorCode = "2";
            $errorMsg = "User was not found";
        }
        
        return new DTO($errorCode, $errorMsg, $user);
    }

    
}
