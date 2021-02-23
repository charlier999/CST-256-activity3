<?php
namespace App\Models;

class OrderModel
{
    private int $id = -1;
    
    private int $custID = -1;
    
    private string $product = "";
    
    

    public function __construct(int $id, int $custID, string $product)
    {
        $this->id = $id;
        $this->custID = $custID;
        $this->product = $product;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return int
     */
    public function getCustID()
    {
        return $this->custID;
    }
    
    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @param int $custID
     */
    public function setCustID($custID)
    {
        $this->custID = $custID;
    }
    
    /**
     * @param string $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }
    
}

