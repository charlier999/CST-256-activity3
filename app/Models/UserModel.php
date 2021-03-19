<?php
namespace App\Models;

class UserModel implements \JsonSerializable
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
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }



    
    
}

