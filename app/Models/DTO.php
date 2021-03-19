<?php
namespace App\Models;

class DTO implements \JsonSerializable
{

    private $errorCode, $errorMessage, $data;
    
    public function __construct($errorCode, $errorMessage, $data)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->data = $data;
    }
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}

