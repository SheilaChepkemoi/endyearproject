<?php

namespace Jowath\Helper;

use Jowath\Exception\DatabaseException;

/**
 * 
 */
class Database
{
	//Database credentials
	private $dbName = 'jowath';
	private $dbHost;
	private $dbPassword;
	private $dbUsername;

	private $cxn;
	
	public function __construct($dbName = NULL)
	{
	    if($dbName !== NULL){
            $this->dbName = $dbName;
        }

		$this->dbHost = "localhost";
		$this->dbPassword = "";
		$this->dbUsername = "root";
	}

    /**
     * connects to the database
     * @throws DatabaseException
     */
	public function connect(){

		 @$this->cxn = mysqli_connect($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);

		 if(!$this->cxn){
		     throw new DatabaseException("Database connection failed: " . mysqli_connect_error());
		 }

		 //end of connect
	}

    /**
     * disconnects from the database
     */
	public function disconnect(){

		if($this->cxn!==NULL && is_resource($this->cxn))
			mysqli_close($this->cxn);

		//end of disconnect
	}

    /**
     * runs sql queries
     * @param $sql
     * @param string $line
     * @param bool $rollBack
     * @return bool|mysqli_result
     * @throws DatabaseException
     */
	public function runQuery($sql, $line="0", $rollBack = false){

		$result = mysqli_query($this->cxn, $sql);

		if($result === false){

		    if($rollBack){
                $sql = "ROLLBACK";
                mysqli_query($this->cxn,$sql);
            }

		    throw new DatabaseException(mysqli_error($this->cxn) . " on line ".$line.". Query: ".$sql);
        }

		return $result;
	}

    /**
     * starts a transaction
     * @param $line
     * @param $rollBack
     * @throws DatabaseException
     */
	public function startTransaction($line, $rollBack = false){
	    $sql = "START TRANSACTION";
	    $this->runQuery($sql,$line,$rollBack);
    }

    /**
     * commits a transaction
     * @param $line
     * @throws DatabaseException
     */
    public function commitTransaction($line){
        $sql = "COMMIT";
        $this->runQuery($sql,$line);
    }

    /**
     * @return mixed
     */
    public function getCxn()
    {
        return $this->cxn;
    }
	//end of class
}
