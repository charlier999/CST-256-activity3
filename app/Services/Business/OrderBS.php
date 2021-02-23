<?php
namespace App\Services\Business;

use App\Services\Data\CustomerDAO;
use App\Services\Data\OrderDAO;
use App\Models\CustomerModel;
use App\Models\OrderModel;

class OrderBS
{
    private CustomerDAO $custDAO;
    private OrderDAO $orderDAO;
    
    public function __construct()
    {
        $this->custDAO = new CustomerDAO();
        $this->orderDAO = new OrderDAO();
    }
    
    public function createOrder($firstName, $lastName, $prodcut)
    {
        // Create a customer model from the entered values
        $model = new CustomerModel(0, $firstName, $lastName);
        
        // Check to see if the customer exists
        $custID = $this->custDAO->getCustomerIDByModelWithoutID($model);
        
        // If customer doesn't exist
        if($custID == FALSE)
        {
            // If the customer was added to the customer table
            if($this->custDAO->addCustomer($model))
            {
                // Get the customer id from the model
                $id = $this->custDAO->getCustomerIDByModelWithoutID($model);
                
                // Get the customer model from the id
                $model = $this->custDAO->getCustomerModelbyID($id[0]);
            }
            else 
            {
                // Send a error msg to admins
                // {code}
                
                // Return false
                return FALSE;
            }
        }
        // If customer does exist
        else 
        {
            // Get the customer model from the id
            $model = $this->custDAO->getCustomerModelbyID($custID[0]);
        }
        
        // Create a model for the order
        $orderModel = new OrderModel(0, $model->getId(), $prodcut);
        
        // Add the order to the order table
        $result = $this->orderDAO->addOrder($orderModel);
        
        // Check to see if the result is valid
        if($result)
        {
            return TRUE;
        }
        else 
        {
            // Send a error msg to admins
            // {code}
            
            // Return false
            return FALSE;
        }
        
    }
    
    
    
}

