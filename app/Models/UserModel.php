<?php
namespace App\Models;

class UserModel
{

    private string $username;
    
    private string $password;
    
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


    
    
}

