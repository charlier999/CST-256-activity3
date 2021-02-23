<?php
namespace App\Services;

class DatabaseService
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
    private string $DBname = "";
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
    
    
    
    //--------------------------------[Constructor]-------------------------------------------------------
    
    /**
     * @desc Default Constructor. Connects to the mySQL server
     *      if it has yet to connect yet.
     */
    public function __construct(string $dbName)
    {

        // assign the database name property
        $this->DBname = $dbName;
        
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
    //--------------------------------[Functions]-------------------------------------------------------
    
    //--------------------------------[Getters/Setters]-------------------------------------------------------
    
    /**
     * @return mixed : The mySQL server Link.
     */
    public function getLink()
    {
        return $this->link;
    }
    
    /**
     * @return mixed : The mySQL connection.
     */
    public function getConnect()
    {
        return $this->connect;
    }
    
    /**
     * Sets the autocommit property for the current connection
     * @param bool $val
     */
    public function setDBAutoCommit(bool $val)
    {
        $this->link->autocommit($val);
    }
    
    /**
     * Close database connection
     */
    public function closeDBConnect()
    {
        $this->connect->close();
    }
    
    /**
     * Begins the transaction to the database
     */
    public function beginTransaction()
    {
        $this->connect->begin_transaction();
    }
    
    /**
     * Ends the transaction to the database
     */
    public function endTransaction()
    {
        mysqli_commit($this->link);
    }
    
    /**
     * Rolls back the transactions
     */
    public function rollbackTransaction()
    {
        $this->connect->rollback();
    }
}

