<?php

namespace Jowath;

use Jowath\Exception\DatabaseException;
use Jowath\Helper\Cipher;
use Jowath\Helper\Database;

class Authenticator
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function authenticate($params){

        //error checking
        //trim
        foreach ($params as $key => $param){
            if(is_string($param)){
                $params[$key] = trim($param);
            }
        }

        //strip tags
        foreach ($params as $key => $param){
            if(is_string($param)){
                $params[$key] = strip_tags($param);
            }
        }

        //check for empty values
        foreach ($params as $key => $param){

            if(!is_string($param)){
                continue;
            }

            if(empty($param)){
                return APIHandler::formatResponse("FAILED","Server received an empty value",$key);
            }
        }

        //escape data
        foreach ($params as $key => $param){
            if(is_string($param)){
                $params[$key] = mysqli_real_escape_string($this->db->getCxn(), $param);
            }
        }

        $email = $params['email'];
        $password = $params['password'];

        //check if email exists and get the password
        $sql = "SELECT password FROM client WHERE email_address = '$email'";

        try {
            $result = $this->db->runQuery($sql, __LINE__);
        } catch (DatabaseException $e) {
            return APIHandler::formatResponse("FAILED","Database error occurred",$e->getMessage());
        }

        if(mysqli_num_rows($result) < 1){
            return APIHandler::formatResponse("FAILED","Invalid email or password",NULL);
        }

        //get the stored password
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        //decrypt the password
        $cipher = new Cipher();
        $stored_password = $cipher->decryptAES($stored_password);

        //compare passwords
        if($password === $stored_password){
            session_start();
            $_SESSION['email'] = $email;
            return APIHandler::formatResponse("SUCCESS","Login successful",NULL);
        }else{
            return APIHandler::formatResponse("FAILED","Invalid email or password",NULL);
        }

    }

    //end of class
}