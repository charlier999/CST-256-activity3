<?php
namespace App\Models;

class CustomerModel
{
    /**
     * Customer ID
     * @var int
     */
    private int $id;
    /**
     * Customer First Name
     * @var string
     */
    private string $firstName;
    /**
     * Customer Last Name
     * @var string
     */
    private string $lastName;
    
    
   
    /**
     * Default Constructor
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(int $id, string $firstName, string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    
    /**
     * @return int : customer ID
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string : customer first name
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * @return string : customer last name
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}

