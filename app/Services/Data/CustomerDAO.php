<?php
namespace App\Services\Data;

use App\Models\CustomerModel;
use Carbon\Exceptions\Exception;
use App\Services\DatabaseService;

class CustomerDAO
{
    private DatabaseService $dbs;
    
    public function __construct()
    {
        $this->dbs = new DatabaseService("cst256_act3");
    }

    /**
     * Adds the customer data to the database
     * @param CustomerModel $customer
     * @return boolean
     */
    public function addCustomer(CustomerModel $customer)
    {
        try 
        {
            $this->dbs->setDBAutoCommit(TRUE);
            // Create a sql query
            $query = "INSERT INTO customer (FisrtName, LastName)
                  VALUES (" . $customer->getFirstName() . ", "
                      . $customer->getLastName() . ")";
                      
            // Query the sql query
            $result = mysqli_query($this->dbs->getLink(), $query);
                      
            mysqli_close($this->link);
                      
            if($result) return TRUE;
            else return FALSE;
        } 
        catch (Exception $e) 
        {
            
        }
    }
    
    /**
     * Gets the customer model data from the database by the customer id
     * @param int $id : customer ID
     * @return boolean|CustomerModel : FALSE-Model was not found | The requested model
     */
    public function getCustomerModelbyID(int $id)
    {
        // Create a sql query
        $query = "SELECT *
                  FROM customer
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
        return new CustomerModel($row["ID"],$row["FirstName"],$row["LastName"]);
    }
    
    /**
     * Gets customer ids that match the 
     * @param CustomerModel $customer
     * @return boolean|int[] : FALSE-No customer was found | int array of ids
     */
    public function getCustomerIDByModelWithoutID(CustomerModel $customer)
    {
        // Create a sql query
        $query = "SELECT ID 
                  FROM customer 
                  WHERE FirstName='" . $customer->getFirstName() . "'
                  AND LastName='" . $customer->getLastName() . "'";
        
        // Query the sql query
        $result = mysqli_query($this->dbs->getLink(), $query);
        
        
        // Get the number of rows from the result
        $numRows = mysqli_num_rows($result);
        
        // Check to see if there is no rows in the result
        if($numRows == 0) return FALSE;
        
        // Crate output array
        $idResults = array();
        
        // loop through the query results
        $i = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            // Add id to results array
            $idResults[$i] = $row["ID"];
            $i++;
        }
        
        // Return results
        return $idResults;
    }
    
    /**
     * Checks to see if the customer exists by ID number
     * @param int $id : customer ID
     * @return boolean : TRUE-Customer exists | FALSE-Customer doesn't exist
     */
    public function doesCustomerExist(int $id)
    {
        // Create a sql query
        $query = "SELECT ID FROM customer WHERE ID='" . $id . "'";
        
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

