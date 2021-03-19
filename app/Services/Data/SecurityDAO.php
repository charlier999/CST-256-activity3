<?php
namespace App\Services\Data;

use App\Models\UserModel;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;

class SecurityDAO
{

    /**
     * @var string : The username to mySQLServer.
     */
    private string $DBuserName = "root";
    /**
     * @var string : The password to mySQLServer.
     */
    private string $DBpassword = "root";
    /**
     * @var string : The name of the database.
     */
    private string $DBname = "cst256_act2";
    /**
     * @var string : The host to mySQLServer.
     */
    private string $DBhost = "localhost";
    /**
     * @var int : The port to mySQLServer.
     */
    private int $DBport = 3306;
    
    // [Server Values]
    /**
     * The link to the MySQL server
     */
    private $link;
    /**
     * The connection to the MySQL server
     */
    private $connect;
    
    public function __construct()
    {
        // Link to the server
        $this->link = mysqli_init();
        
        // Connect to the server
        $this->connect = mysqli_real_connect
        (
            $this->link,
            $this->DBhost,
            $this->DBuserName,
            $this->DBpassword,
            $this->DBname,
            $this->DBport
        );        
    }
    
    public function DoesUserExist(UserModel $user)
    {
        Log::info("Entered DoesUserExist()");
        try {
            // Create a sql query
            $query = "SELECT * FROM user WHERE UserName='" . $user->getUsername() . "'AND Password='" . $user->getPassword() . "'";
            
            Log::info("Querrying database in DoesUserExist() with: ". $query);
            
            // Query the sql query
            $result = mysqli_query($this->link, $query);
            
            // Get the number of rows from the result
            $numRows = mysqli_num_rows($result);
            
            Log::info("The number of rows retrived by query '" . $query . "' is " . $numRows);
            
            // Check to see if there is no rows in the result
            if($numRows == 0) return FALSE;
            else if($numRows == 1) return TRUE;
            else return FALSE;
            
            if($result) return TRUE;
            else return FALSE;
        } 
        catch (Exception $e)
        {
            Log::error("EXCEPTION: DoesUserExist()");
            return FALSE;
        }
        
    }

    public function FindUserByID(int $id)
    {
        Log::info("Entered DoesUserExist()");
        try {
            // Create a sql query
            $query = "SELECT * FROM user WHERE ID='" . $id . "'";
            
            Log::info("Querrying database in FindUserByID() with: ". $query);
            
            // Query the sql query
            $result = mysqli_query($this->link, $query);
            
            // Get the number of rows from the result
            $numRows = mysqli_num_rows($result);
            
            Log::info("The number of rows retrived by query '" . $query . "' is " . $numRows);
            
            // Check to see if there is no rows in the result
            if($numRows == 0) return FALSE;
            else if($numRows == 1)
            {
                $row = mysqli_fetch_array($result);
                return new UserModel($row[1], $row[2]);
            }
            else return FALSE;
        }
        catch (Exception $e)
        {
            Log::error("EXCEPTION: FindUserByID()");
            return FALSE;
        }
    }

    public function FindAllUsers()
    {
        Log::info("Entered FindAllUsers()");
        try {
            
            // Create a sql query
            $query = "SELECT * FROM user";
            
            Log::info("Querrying database in FindAllUsers with: ". $query);
            
            // Query the sql query
            $result = mysqli_query($this->link, $query);

            
            // Get the number of rows from the result
            $numRows = mysqli_num_rows($result);
            
            Log::info("The number of rows retrived by query '" . $query . "' is " . $numRows);
            
            
            // Check to see if the num of rows is 0
            if($numRows == 0) return FALSE;
            
            
            // Convert the mySQL result into an array
            $data = array();
            while($row = mysqli_fetch_assoc($result))
            {
                print_r($row);
                $dataR['UserName'] = $row['UserName'];
                $dataR['Password'] = $row['Password'];
                array_push($data, $dataR);
            }
            
            // Convert data array into UserModel List
            $users = array();
            foreach ($data as $user) 
            {
                array_push($users, new UserModel($user['UserName'], $user['Password']));
            }
            
            // Return User list
            return $users;
            
        }
        catch (Exception $e)
        {
            Log::error("EXCEPTION: FindAllUsers()");
            return FALSE;
        }
    }

}

