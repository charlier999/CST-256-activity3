<?php
namespace App\Services\Data;

use App\Models\UserModel;

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
        // Create a sql query
        $query = "SELECT * FROM user WHERE UserName='" . $user->getUsername() . "' 
                    AND Password='" . $user->getPassword() . "'";
        
        // Query the sql query
        $result = mysqli_query($this->link, $query);
        
        // Get the number of rows from the result
        //$numRows = mysqli_num_rows($result);
        
        // Check to see if there is no rows in the result
        //if($numRows == 0) return FALSE;
        //else if($numRows == 1) return TRUE;
        //else return FALSE;
        
        if($result) return TRUE;
        else return FALSE;
    }
}

