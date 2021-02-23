<?php
namespace App\Services\Data;

use App\Services\DatabaseService;
use App\Models\OrderModel;
use Carbon\Exceptions\Exception;

class OrderDAO
{
    private DatabaseService $dbs;
    
    public function __construct()
    {
        $this->dbs = new DatabaseService("cst256_act3");
    }
    
    /**
     * Adds the order to the database
     * @param OrderModel $order
     * @return boolean
     */
    public function addOrder(OrderModel $order)
    {
        try
        {
            //$this->dbs->setDBAutoCommit(FALSE);
            // Create a sql query
            $query = "INSERT INTO order ('CustomerID', 'Product')
                  VALUES ('". $order->getCustID() . "','" . $order->getProduct() . "')";
                      
            echo $query;
            // Query the sql query
            $result = mysqli_query($this->dbs->getLink(), $query);
          
            if($result) return TRUE;
            else return FALSE;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    /**
     * Gets the order model data from the database by the order id 
     * @param int $id : order ID
     * @return boolean|OrderModel
     */
    public function getOrderModelbyID(int $id)
    {
        // Create a sql query
        $query = "SELECT *
                  FROM order
                  WHERE ID='" . $id . "'";
        
        // Query the sql query
        $result = mysqli_query($this->dbs->getLink(), $query);
        
        
        // Get the number of rows from the result
        $numRows = mysqli_num_rows($result);
        
        // Check to see if there is no rows in the result
        if($numRows == 0) return FALSE;
        
        // Fetch the row from the qurry result
        $row = mysqli_fetch_assoc($result);
        
        // translate data to model and return model
        return new OrderModel($row["ID"], $row["CustomerID"], $row["Product"]);
    }
    
    
    public function getOrderModelsbyCustomerID(int $id)
    {
        // Create a sql query
        $query = "SELECT *
                  FROM order
                  WHERE CustomerID='" . $id . "'";
        
        // Query the sql query
        $result = mysqli_query($this->dbs->getLink(), $query);
        
        
        // Get the number of rows from the result
        $numRows = mysqli_num_rows($result);
        
        // Check to see if there is no rows in the result
        if($numRows == 0) return FALSE;
               
        // Create output array
        $orderResults = array();
        
        // loop through the query results
        $i = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            $orderResults[$i] = new OrderModel($row["ID"], $row["CustomerID"], $row["Product"]);
            $i++;
        }
        
        // return data
        return $orderResults;
    }
    
    /**
     * Checks to see if the order exists by ID number
     * @param int $id : order ID
     * @return boolean
     */
    public function doesOrderExist(int $id)
    {
        // Create sql query
        $query = "SELECT ID FROM order WHERE ID='" . $id . "'";
        
        // Query the sql query
        $result = mysqli_query($this->dbs->getLink(), $query);
        
        
        // Get the number of rows from the result
        $numRows = mysqli_num_rows($result);
        
        // Check to see if there is no rows in the result
        if($numRows == 0) return FALSE;
        else if($numRows == 1) return TRUE;
        else return FALSE;
    }
}

